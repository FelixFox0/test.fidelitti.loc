<?php
/**
 * Zitec_Dpd – shipping carrier extension
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
class ModelModuleDpdTablerate extends Model
{

    /**
     * to be defined
     *
     * @param $data
     *
     * @return bool
     */
    public function isValid($data)
    {
        return true;
    }

    /**
     *  insert a new table rate entry
     *
     * @param $data
     *
     * @return mixed
     */
    public function save($data)
    {
        $sql = "INSERT INTO " . DB_PREFIX . "zitec_dpd_tablerate SET
                                        `store` = '" . $this->db->escape($data['store']) . "',
                                        `dest_country` = '" . $this->db->escape($data['dest_country']) . "',
                                        `dest_region` = '" . $this->db->escape($data['dest_region']) . "',
                                        `dest_postcode` = '" . $this->db->escape($data['dest_postcode']) . "',
                                        `dpd_service` = '" . $this->db->escape($data['dpd_service']) . "',
                                        `condition` = '" . $this->db->escape($data['condition']) . "',
                                        `shipping_method_enabled` = '" . $this->db->escape($data['shipping_method_enabled']) . "',
                                        `condition_threshold` = '" . $this->db->escape($data['condition_threshold']) . "',
                                        `shipping_price_calculation` = '" . $this->db->escape($data['shipping_price_calculation']) . "',
                                        `shipping_price_value` = '" . $this->db->escape($data['shipping_price_value']) . "',
                                        `cod_surcharge_calculation` = '" . $this->db->escape($data['cod_surcharge_calculation']) . "',
                                        `cod_surcharge_amount` = '" . $this->db->escape($data['cod_surcharge_amount']) . "',
                                        `cod_surcharge_min_amount` = '" . $this->db->escape($data['cod_surcharge_min_amount']) . "'
                                        ON DUPLICATE KEY UPDATE
                                        `condition` = '" . $this->db->escape($data['condition']) . "',
                                        `shipping_method_enabled` = '" . $this->db->escape($data['shipping_method_enabled']) . "',
                                        `condition_threshold` = '" . $this->db->escape($data['condition_threshold']) . "',
                                        `shipping_price_calculation` = '" . $this->db->escape($data['shipping_price_calculation']) . "',
                                        `shipping_price_value` = '" . $this->db->escape($data['shipping_price_value']) . "',
                                        `cod_surcharge_calculation` = '" . $this->db->escape($data['cod_surcharge_calculation']) . "',
                                        `cod_surcharge_amount` = '" . $this->db->escape($data['cod_surcharge_amount']) . "',
                                        `cod_surcharge_min_amount` = '" . $this->db->escape($data['cod_surcharge_min_amount']) . "'
                                        ";

        $this->db->query($sql);

        $rate_id = $this->db->getLastId();

        $this->updateUsingTableRatesFlag();

        return $rate_id;
    }


    /**
     * update an existing table rate
     *
     * @param $data
     *
     * @return mixed
     */
    public function update($data)
    {
        $sql = "UPDATE " . DB_PREFIX . "zitec_dpd_tablerate SET
                                        `store` = '" . $this->db->escape($data['store']) . "',
                                        `dest_country` = '" . $this->db->escape($data['dest_country']) . "',
                                        `dest_region` = '" . $this->db->escape($data['dest_region']) . "',
                                        `dest_postcode` = '" . $this->db->escape($data['dest_postcode']) . "',
                                        `dpd_service` = '" . $this->db->escape($data['dpd_service']) . "',
                                        `condition` = '" . $this->db->escape($data['condition']) . "',
                                        `shipping_method_enabled` = '" . $this->db->escape($data['shipping_method_enabled']) . "',
                                        `condition_threshold` = '" . $this->db->escape($data['condition_threshold']) . "',
                                        `shipping_price_calculation` = '" . $this->db->escape($data['shipping_price_calculation']) . "',
                                        `shipping_price_value` = '" . $this->db->escape($data['shipping_price_value']) . "',
                                        `cod_surcharge_calculation` = '" . $this->db->escape($data['cod_surcharge_calculation']) . "',
                                        `cod_surcharge_amount` = '" . $this->db->escape($data['cod_surcharge_amount']) . "',
                                        `cod_surcharge_min_amount` = '" . $this->db->escape($data['cod_surcharge_min_amount']) . "'
                                        WHERE id =  '" . $this->db->escape($data['id']) . "'
                    ";
        $this->updateUsingTableRatesFlag();
        return $this->db->query($sql);
    }

    /**
     * remove more table rates in the same time
     *
     * @param $ids - array
     *
     * @return mixed
     */
    public function delete($ids)
    {
        foreach ($ids as &$id) {
            $id = $this->db->escape($id);
        }
        $sql    = "DELETE FROM " . DB_PREFIX . "zitec_dpd_tablerate WHERE id IN (" . implode(',', $ids) . ") ;";
        $return = $this->db->query($sql);

        $this->updateUsingTableRatesFlag();

        return $return;
    }

    /**
     * get rate by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function getRate($id)
    {
        $query = $this->db->query("select * from " . DB_PREFIX . "zitec_dpd_tablerate where id = '" . $this->db->escape($id) . "'");

        return $query->row;
    }

    /**
     * return all rates
     *
     * @return mixed
     */
    public function getRates()
    {
        $query = $this->db->query("select * from " . DB_PREFIX . "zitec_dpd_tablerate");

        return $query->rows;
    }

    /**
     * check if at least one table rate entry was defined
     * if yes, is meaning that the module is using table rates
     *
     * @return bool
     */
    public function isUsingTableRates()
    {
        $this->load->model('setting/setting');
        $settings = $this->model_setting_setting->getSetting('z_settings');

        return !empty($settings['z_settings_use_table_rates']);
    }


    /**
     * it is used to update the flag of using table rates
     * the status is checked at each insert or delete
     *
     *
     * @return bool
     */
    public function updateUsingTableRatesFlag()
    {
        $query = $this->db->query("select count(*) AS count from " . DB_PREFIX . "zitec_dpd_tablerate ");
        $count = $query->row['count'];
        $this->load->model('setting/setting');

        if ($count == 0 && $this->isUsingTableRates()) {
            $this->model_setting_setting->editSetting('z_settings', array('z_settings_use_table_rates' => '0'));
        } elseif ($count > 0 && !$this->isUsingTableRates()) {
            $this->model_setting_setting->editSetting('z_settings', array('z_settings_use_table_rates' => '1'));
        }

        return true;
    }


    /**
     * get the proper rate for the request
     *
     * @param $request
     *
     * @return mixed
     */
    public function getRatesByRequest($request)
    {
        if (isset(
            $request['store'],
            $request['country'],
            $request['region'],
            $request['postcode']
        )) {

            $query = "SELECT * FROM " . DB_PREFIX . "zitec_dpd_tablerate  WHERE
                    ( store = " . $this->db->escape($request['store']) . " OR store = 0)
                    AND (
                            ( dest_country = '" . $this->db->escape($request['country']) . "' AND dest_region = '" . $this->db->escape($request['region']) . "'  AND dest_postcode = '" . $this->db->escape($request['postcode']) . "' )
                            OR ( dest_country = '" . $this->db->escape($request['country']) . "' AND dest_region = '" . $this->db->escape($request['region']) . "'  AND (dest_postcode = '' OR dest_postcode = '*') )
                            OR ( dest_country = '" . $this->db->escape($request['country']) . "' AND dest_region = ''  AND (dest_postcode = '' OR dest_postcode = '*') )
                            OR ( dest_country = '' AND dest_region = '' AND (dest_postcode = '' OR dest_postcode = '*') )
                    )
                    AND (
                            (`condition` = 1 AND `condition_threshold` <= " . $this->db->escape($request['price']) . "  )
                            OR (`condition` = 0 AND `condition_threshold` <= " . $this->db->escape($request['weight']) . "  )
                    )
                    ORDER BY dest_country DESC, dest_region DESC, dest_postcode DESC, dpd_service DESC

            ";

            $query = $this->db->query($query);

            if (count($query->rows)) {
                return $query->rows;
            }

        }

    }

    /**
     * return the default table rate if no one was profided manually
     *
     * this will contain an array for each dpd service
     *
     * @return array
     */
    public function getDefaultRates()
    {
        $sampleRate    = array(
            'store'                      => '0',
            'dest_country'               => '',
            'dest_region'                => '',
            'dest_postcode'              => '',
            'dpd_service'                => '1',
            'condition'                  => '0',
            'shipping_method_enabled'    => '1',
            'condition_threshold'        => '0',
            'shipping_price_calculation' => '1',
            'shipping_price_value'       => '0',
            'cod_surcharge_calculation'  => '0',
            'cod_surcharge_amount'       => '0',
            'cod_surcharge_min_amount'   => '0',
        );
        $servicesRates = array();

        $services = $this->_getSettingsModel()->getAvailableDpdServices($this->config->get('config_store_id'));

        foreach ($services as $key => $serviceId) {
            $sampleRate['dpd_service'] = $serviceId;

            $servicesRates[] = $sampleRate;
        }

        return $servicesRates;
    }


    /**
     *
     * @return Zitec_Dpd_Helper_Data
     */
    protected function _getSettingsModel()
    {
        if (empty($this->model_module_dpd_settings)) {
            $this->load->model('module/dpd/settings');
        }

        return $this->model_module_dpd_settings;
    }

}
