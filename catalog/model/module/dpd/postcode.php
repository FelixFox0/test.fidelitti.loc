<?php
/**
 * Zitec_Dpd – shipping carrier extension - postcode validation
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @author     Zitec COM <magento@zitec.ro>
 */
class ModelModuleDpdPostcode extends Model
{

    const CACHE_TABLE_NAME = 'zitec_dpd_postcode_address';


    /**
     * require zipcode entry point library
     *
     * @return int
     */
    public static function  requireApiFile()
    {
        if (class_exists('Zitec_Dpd_Postcode_Search', false)) {
            return true;
        }
        $apiClassFile = DIR_SYSTEM . 'library' . DIRECTORY_SEPARATOR . 'Zitec' . DIRECTORY_SEPARATOR . 'Dpd' . DIRECTORY_SEPARATOR . 'Postcode' . DIRECTORY_SEPARATOR . 'Search.php';
        if (file_exists($apiClassFile)) {
            require_once($apiClassFile);
        }

        return 1;
    }

    protected function normalizeAddress($address)
    {
        if (!array_key_exists('postcode', $address)) {
            $address['postcode'] = null;
        }
        if (!array_key_exists('country', $address) && array_key_exists('country_id', $address)) {
            $this->load->model('localisation/country');
            $country = $this->model_localisation_country->getCountry($address['country_id']);
            if (!empty($country)) {
                $countryName = $country['name'];
                $address['country'] = $countryName;
            } else {
                $address['country'] = '';
            }
        }
        if (!array_key_exists('region', $address) && array_key_exists('region_id', $address)) {
            $this->load->model('localisation/zone');
            $region = $this->model_localisation_zone->getZone($address['region_id']);
            if (!empty($region)) {
                $regionName = $region['name'];
                $address['region'] = $regionName;
            } else {
                $regions = $this->getSearchPostcodeModel()->identifyRegionByCity($address['city']);
                if ($regions && count($regions) == 1) {
                    $address['region'] = array_pop($regions);
                } else {
                    $address['region'] = '';
                }
            }
        }
        return $address;
    }

    public function search($request, $relevance = null ){
        $request = $this->normalizeAddress($request);
        //filter input variable
        $address     = array(
            'country'  => (strtolower($request['country']) == 'ro') ? 'romania' : strtolower($request['country']),
            'region'   => $request['region'],
            'city'     => $request['city'],
            'address'  => $request['address'],
            'postcode' => $request['postcode']
        );
        $postcodeSearch = $this->getSearchPostcodeModel();
        if (is_null($relevance)) {
            $relevance = new stdClass();
        }
        $postCode = $postcodeSearch->getModel()->search($address, $relevance);
        return $postCode;
    }


    public function findAndCachePostCode($request, $relevance = null)
    {
        $request = $this->normalizeAddress($request);
        //filter input variable
        $address     = array(
            'country'  => (strtolower($request['country']) == 'ro') ? 'romania' : strtolower($request['country']),
            'region'   => $request['region'],
            'city'     => $request['city'],
            'address'  => $request['address'],
            'postcode' => $request['postcode']
        );
        $countryName = $address['country'];
        $postCode    = $request['postcode'];

        if ($this->isEnabledAutocompleteForPostcode($countryName)) {

            $currentHash = $this->generateAddressHash($address);

            $cachedPostcode = $this->getPostcodeCache($currentHash);
            if (!empty($cachedPostcode) && $cachedPostcode->num_rows === 1) {
                if ($cachedPostcode->row['relevance'] == 1) {
                    $relevance->percent = 100;
                } else {
                    $relevance->percent = 0;
                }

                return $cachedPostcode->row['auto_postcode'];
            }
            //check for postcode validation info
            $postcodeSearch = $this->getSearchPostcodeModel();
            if (is_null($relevance)) {
                $relevance = new stdClass();
            }
            $postCode = $postcodeSearch->getModel()->search($address, $relevance);
            if ($this->isValid($postCode, $relevance)) {
                $customRelevance = 1;
                $this->setPostcodeCache($currentHash, $postCode, 0, $customRelevance);
            } else {
                $this->setPostcodeCache($currentHash, $postCode);
            }

        } else {
            $postCode = $request['postcode'];
        }

        return $postCode;
    }


    /**
     * checkk if postcode extension is enabled
     *
     * @param $countryName
     *
     * @return bool
     */
    public function isEnabledAutocompleteForPostcode($countryName)
    {
        $isValid = $this->getSearchPostcodeModel()->isEnabled($countryName);
        if (empty($isValid)) {
            return false;
        }
        $this->load->model('module/dpd/settings');
        $store_id            = $this->config->get('config_store_id');
        $autocompleteEnabled = $this->model_module_dpd_settings->getShippingSettings('postcode_autocomplete', $store_id);

        return !empty($autocompleteEnabled);
    }


    /**
     * this hash will be used for trigger the postcode expiration
     *
     * @param $address
     *
     * @return string
     */
    protected function generateAddressHash($address)
    {
        if (!is_array($address)) {
            return '';
        }
        unset($address['postcode']);
        foreach ($address as &$item) {
            $item = strtolower(trim($item));
        }
        $hash = implode('', $address);

        return md5($hash);
    }


    /**
     * test if found postcode relevance is enough for considering the postcode useful in the rest of checkout process
     *
     * @param          $postCode
     * @param stdClass $relevance
     *
     * @return int
     */
    public function isValid($postCode, stdClass $relevance = null)
    {
        if (empty($relevance)) {
            return 0;
        }
        if (!empty($relevance->percent) && $relevance->percent > Zitec_Dpd_Postcode_Search::SEARCH_RESULT_RELEVANCE_THRESHOLD_FOR_VALIDATION) {
            return 1;
        }

        return 0;
    }


    /**
     * include the lib files if not included and create an instance of the model
     *
     * @return Zitec_Dpd_Postcode_Search
     */
    public function getSearchPostcodeModel()
    {
        $registry       = new Registry();
        $postcodeSearch = $registry->get('postcodeSearch');
        if (empty($postcodeSearch)) {
            //check for postcode validation info
            $this->requireApiFile();
            $postcodeSearch = new Zitec_Dpd_Postcode_Search('mysql', $this->db);
            $registry->set('postcodeSearch', $postcodeSearch);
        }

        return $postcodeSearch;
    }


    /**
     * it is used to create a list of relevant addresses for given address.
     * used in admin panel to validate the postcode
     *
     * @param array $address The content will be the edit form for address from admin
     *                       $address contain next keys
     *                       MANDATORY
     *                       country
     *                       city
     *
     * OPTIONAL
     *      region
     *      address
     *      street
     */
    public function findAllSimilarAddressesForAddress($address)
    {
        if (!empty($address['country'])) {
            $countryName = $address['country'];
        }
        if (!empty($address['country_id'])) {
            $this->load->model('localisation/country');
            $country = $this->model_localisation_country->getCountry($address['country_id']);
            if (!empty($country)) {
                $countryName = $country['name'];
                $address['country'] = $countryName;
            }
        }

        if ($this->isEnabledAutocompleteForPostcode($countryName)) {
            if ($address['region_id']) {
                $this->load->model('localisation/zone');
                $region = $this->model_localisation_zone->getZone($address['region_id']);
                if (!empty($region)) {
                    $regionName = $region['name'];
                }
                $address['region'] = $regionName;
            }
            if (empty($address['region'])) {
                $regions = $this->getSearchPostcodeModel()->identifyRegionByCity($address['city']);
                if ($regions && count($regions) == 1) {
                    $address['region'] = array_pop($regions);
                }
            }
            try {
                $foundAddresses = $this->getSearchPostcodeModel()->searchSimilarAddresses($address);
            } catch (Exception $e) {
                return array();
            }

            return $foundAddresses;
        }

        return false;
    }


    /**
     * cache the postcode correction using an hash created by address city region and country fields
     *
     * @param     $hash
     * @param     $postcode
     * @param int $addressId
     * @param int $customRelevance
     *
     * @return mixed
     */
    public function setPostcodeCache($hash, $postcode, $addressId = 0, $customRelevance = 0)
    {
        $session = $this->session;
        if (!empty($session) && isset($session->data['shipping_address_id'])) {
            $addressId = $session->data['shipping_address_id'];
        }

        $sql = 'INSERT INTO `' . DB_PREFIX . self::CACHE_TABLE_NAME . '` SET ' .
            "`hash` = '" . $this->db->escape($hash) . "',
                                `auto_postcode` = '" . $this->db->escape($postcode) . "',
                                `id_address` = '" . $addressId . "',
                                `relevance` = '" . $customRelevance . "',
                                `date_add` = CURRENT_TIMESTAMP(),
                                `date_upd` = CURRENT_TIMESTAMP()
                                ";

        return $this->db->query($sql);
    }

    /**
     * return the stored cache entry of postcode correction
     *
     * @param $hash
     *
     * @return array
     */
    public function getPostcodeCache($hash)
    {
        $sql = '
                SELECT * FROM `' . DB_PREFIX . self::CACHE_TABLE_NAME . '`
                WHERE `hash` = \'' . $hash . '\' ORDER BY `date_upd` DESC LIMIT 1
        ';

        return $this->db->query($sql);

    }

    /**
     * update the cached postcode and mark it as valid
     *
     * @param $orderId
     * @param $data
     *
     * @return mixed
     */
    public function afterOrderUpdate($orderId, $data)
    {

        try {
            $postcode  = $data['shipping_postcode'];
            $countryId = $data['shipping_country_id'];
            $zoneId    = $data['shipping_zone_id'];

            $this->load->model('localisation/country');
            $country = $this->model_localisation_country->getCountry($countryId);

            $countryName = '';
            if (!empty($country)) {
                $countryName = $country['name'];
            }

            $this->load->model('localisation/zone');
            $region = $this->model_localisation_zone->getZone($zoneId);

            $regionName = '';
            if (!empty($region)) {
                $regionName = $region['name'];
            }

            $address = array(
                'country'  => (strtolower($countryName) == 'ro') ? 'romania' : strtolower($countryName),
                'region'   => $regionName,
                'city'     => $data['shipping_city'],
                'address'  => $data['shipping_address_1'] . ' ' . $data['shipping_address_2'],
                'postcode' => $data['shipping_postcode']
            );

            $currentHash = $this->generateAddressHash($address);

            $sql = 'UPDATE `' . DB_PREFIX . self::CACHE_TABLE_NAME . '` SET ' .
                "`auto_postcode` = '" . $this->db->escape($postcode) . "',
                relevance = 1
                 WHERE `hash` = '" . $currentHash . "' LIMIT 1
                ";

            return $this->db->query($sql);
        } catch (Exception $e) {
            //this is nice to have feature
            //it may not run properly because of VQMOD module
        }
    }


    /**
     * put postcode auto=correction into order table if the correction algorithm has no problem
     *
     * @param $data
     */
    public function afterCheckoutOrderSave($order_id, $data)
    {
        try {
            $postcode    = $data['shipping_postcode'];
            $countryName = '';
            $regionName  = '';
            $countryId   = $data['shipping_country_id'];
            $zoneId      = $data['shipping_zone_id'];

            $this->load->model('localisation/country');
            $country = $this->model_localisation_country->getCountry($countryId);
            if (!empty($country)) {
                $countryName = $country['name'];
            }

            $this->load->model('localisation/zone');
            $region = $this->model_localisation_zone->getZone($zoneId);
            if (!empty($region)) {
                $regionName = $region['name'];
            }

            $address = array(
                'country'  => (strtolower($countryName) == 'ro') ? 'romania' : strtolower($countryName),
                'region'   => $regionName,
                'city'     => $data['shipping_city'],
                'address'  => $data['shipping_address_1'] . ' ' . $data['shipping_address_2'],
                'postcode' => $data['shipping_postcode']
            );

            $currentHash = $this->generateAddressHash($address);

            $relevance = new stdClass();
            $postcode  = $this->findAndCachePostCode($address, $relevance);
            if ($this->isValid($postcode, $relevance)) {
                $sql = "UPDATE `" . DB_PREFIX . "order` SET `shipping_postcode` = '" . $postcode . "' WHERE `order_id` = '" . (int)$order_id . "';";
                $this->db->query($sql);
            }
        } catch (Exception $e) {
            //this is nice to have feature
            //it may not run properly because of VQMOD module
        }
    }

    /**
     * is called by install script of the module
     *
     * @return bool
     */
    public function install()
    {
        $sql = '
                CREATE TABLE `' . DB_PREFIX . self::CACHE_TABLE_NAME . '` (
                  `dpd_postcode_id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_address` int(11) NOT NULL,
                  `hash` varchar(100) DEFAULT NULL,
                  `auto_postcode` varchar(6) DEFAULT NULL,
                  `relevance` int(2) DEFAULT NULL,
                  `date_add` datetime DEFAULT NULL,
                  `date_upd` datetime DEFAULT NULL,
                  PRIMARY KEY (`dpd_postcode_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
        ';

        try {
            return $this->db->query($sql);
        } catch (Exception $e) {
            //probably the table already exists
        }

        return true;
    }

    /**
     * is called by uninstall script of the module
     *
     * @return bool
     */
    public function uninstall()
    {
        $sql = '
                DROP TABLE `' . DB_PREFIX . self::CACHE_TABLE_NAME . '`;
        ';

        try {
            return $this->db->query($sql);
        } catch (Exception $e) {
            //probably the table does not exits
        }

        return true;
    }


}
