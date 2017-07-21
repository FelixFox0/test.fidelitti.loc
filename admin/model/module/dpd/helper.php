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
 * this helper is used for calling the api methods implemented further in the Zitec_Dpd_Api library
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @author     Zitec COM <magento@zitec.ro>
 */
class ModelModuleDpdHelper extends Model
{

    const DPD_SHIPPING_METHOD_CODE = 'zitec_dpd';
    const DPD_MODULE_VERSION = '1.1.0';

    protected $_store = null;


    public function install()
    {

        $this->db->query("
                CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "zitec_dpd_manifest` (
                  `manifest_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `dpd_manifest_id` int(11) DEFAULT NULL,
                  `transaction_id` int(11) DEFAULT NULL,
                  `manifestReferenceNumber` varchar(45) DEFAULT NULL,
                  `manifestName` varchar(45) DEFAULT NULL,
                  `manifestPrintData` varchar(45) DEFAULT NULL,
                  `pdfManifestFile` longblob,
                  `error` varchar(150) DEFAULT NULL,
                  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                  `shipments` text,
                  PRIMARY KEY (`manifest_id`),
                  KEY `dpd_manifest_id` (`dpd_manifest_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
		");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "zitec_dpd_shipment` (
              `shipment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `order_id` int(10) unsigned DEFAULT NULL,
              `save_shipment_call` mediumtext,
              `save_shipment_response` mediumtext,
              `dpd_shipment_reference_number` varchar(45) DEFAULT NULL,
              `dpd_shipment_id` int(11) DEFAULT NULL,
              `shipping_labels` longblob,
              `manifest` int(11) DEFAULT NULL,
              `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`shipment_id`),
              KEY `order_id` (`order_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
		");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "zitec_dpd_shipment_tracking` (
              `tracking_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `shipment_id` int(11) DEFAULT NULL,
              `refference_tracking_id` int(11) DEFAULT NULL,
              `tracking_url` varchar(255) DEFAULT NULL,
              `shipment_status_response` blob,
              PRIMARY KEY (`tracking_id`),
              KEY `shipment_id` (`shipment_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
		");

        $this->db->query("
                CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "zitec_dpd_tablerate` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `store` int(11) DEFAULT NULL,
                  `dest_country` varchar(3) DEFAULT NULL,
                  `dest_region` varchar(70) DEFAULT NULL,
                  `dest_postcode` varchar(10) DEFAULT NULL,
                  `dpd_service` int(6) NOT NULL,
                  `condition` int(1) DEFAULT '0',
                  `shipping_method_enabled` int(1) DEFAULT '0',
                  `condition_threshold` float DEFAULT '0',
                  `shipping_price_calculation` int(1) DEFAULT '0',
                  `shipping_price_value` float DEFAULT '0',
                  `cod_surcharge_calculation` int(1) DEFAULT '0',
                  `cod_surcharge_amount` float DEFAULT '0',
                  `cod_surcharge_min_amount` float DEFAULT '0',
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `tablerate_UNIQUE` (`dest_country`,`dest_postcode`,`dest_region`,`dpd_service`,`store`,`condition_threshold`,`condition`)
                ) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
		");

        $this->load->model('module/dpd/tablerate');
        $this->model_module_dpd_tablerate->updateUsingTableRatesFlag();


        $this->load->model('module/dpd/settings');
        $this->load->model('setting/setting');

        $fields = $this->model_module_dpd_settings->saveSettings(
            array(
                'shipmentUrlPart' => 'ShipmentServiceImpl?wsdl',
                'manifestUrlPart' => 'ManifestServiceImpl?wsdl',
                'pickupUrlPart'   => 'PickupOrderServiceImpl?wsdl',
            ),
            0,
            'shipping'
        );

        // setting payment settings
        $this->model_module_dpd_settings->saveSettings(
            array(
                'dpd_cod_status' => 1
            ),
            0,
            'payment'
        );


        $this->model_module_dpd_settings->saveSettings(
            array(
                'dpd_payment_status' => 1
            ),
            0,
            'total'
        );

        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'total/dpd_payment');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'dpd/shipment');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'dpd/shipment_list');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'dpd/manifest');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'shipping/zitec_dpd');
        //$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'dpd/postcode');

        $this->load->model('extension/extension');
        $this->model_extension_extension->uninstall('total', 'dpd_payment');
        $this->model_extension_extension->install('total', 'dpd_payment');

        $this->model_extension_extension->uninstall('payment', 'dpd_cod');
        $this->model_extension_extension->install('payment', 'dpd_cod');

    }


    public function upgrade()
    {
        $currentVersion = $this->_getSettingsModel()->getSettings('version','ZITEC_DPD_GEOPOST');

        // changes made in version 1.1.0
        if (version_compare('1.1.0' , $currentVersion, '>')) {

            $this->load->model('user/user_group');
            $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'dpd/postcode');
            $this->session->data['success'] = $this->language->get('DPD Module version 1.1.0 was installed.<br>');
        }

        $array = array(
            'ZITEC_DPD_GEOPOST' =>
                array('version'=>self::DPD_MODULE_VERSION)
        );
        $this->_getSettingsModel()->saveSettings($array);

    }

    public function getCurrentVersion(){
        return self::DPD_MODULE_VERSION;
    }


    public function uninstall()
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "zitec_dpd_tablerate`;");
    }




    /**
     * include the api file and library autoloader
     */
    public static function  requireApiFile()
    {
        $apiClassFile = DIR_SYSTEM . 'library' . DIRECTORY_SEPARATOR . 'Zitec' . DIRECTORY_SEPARATOR . 'Dpd' . DIRECTORY_SEPARATOR . 'Api.php';
        if (file_exists($apiClassFile)) {
            require_once($apiClassFile);
        }
    }


    /**
     * create shipping label and create the pdf content
     *
     * @param int    $dpdShipmentId
     * @param string $dpdShipmentReferenceNumber
     *
     * @return string
     * @throws Exception
     */
    public function getNewPdfShipmentLabelsStr($dpdShipmentId, $dpdShipmentReferenceNumber, $order_info = null)
    {
        $store_id            = (isset($order_info) && !empty($order_info['store_id']) ? $order_info['store_id'] : 0);
        $apiParams           = $this->getShipmentParams($store_id);
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_GET_LABEL;
        $dpdApi              = new Zitec_Dpd_Api($apiParams);
        $dpdLabel            = $dpdApi->getApiMethodObject();

        $dpdLabel->setShipment($dpdShipmentId, $dpdShipmentReferenceNumber);
        try {
            $dpdLabel->execute();
        } catch (Exception $e) {
            throw $e;
        }
        $labelResponse = $dpdLabel->getResponse();
        /* @var $labelResponse Zitec_Dpd_Api_Shipment_GetLabel_Response */
        if ($labelResponse->hasError()) {
            throw new Exception($labelResponse->getErrorText());
        }

        return $labelResponse->getPdfFile();
    }


    /**
     * this method is used for tracking the order shipment
     * in the response of this method will be a url on dpd website
     *
     * @param $saveShipmentResponse
     *
     * @return mixed
     */
    public function getShipmentStatus($DpdShipmentId, $DpdShipmentReferenceNumber)
    {

        $apiParams           = $this->getShipmentParams();
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_GET_SHIPMENT_STATUS;


        $dpdApi            = new Zitec_Dpd_Api($apiParams);
        $getShipmentStatus = $dpdApi->getApiMethodObject();

        $getShipmentStatus->setShipment($DpdShipmentId, $DpdShipmentReferenceNumber);


        $getShipmentStatus->execute();
        $statusResponse = $getShipmentStatus->getShipmentStatusResponse();

        return $statusResponse;
    }


    /**
     * remove the shipment tracking code form DPD system
     * after this action pdf content will be set to null
     * but the shipment will still exist in magento admin interface
     *
     * @param $shipment
     * @param $saveShipmentResponse
     *
     * @return mixed
     */
    public function deleteWsShipment($shipment, $saveShipmentResponse)
    {

        $apiParams           = $this->getShipmentParams($shipment->getStore());
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_DELETE;


        $dpdApi         = new Zitec_Dpd_Api($apiParams);
        $deleteShipment = $dpdApi->getApiMethodObject();

        $deleteShipment->addShipmentReference($saveShipmentResponse->getDpdShipmentId(), $saveShipmentResponse->getDpdShipmentReferenceNumber());


        $deleteShipment->execute();
        $wsResult = $deleteShipment->getDeleteShipmentResponse();

        return $wsResult;
    }


    /**
     *
     * @param mixed $store
     *
     * @return array
     */
    public function getShipmentParams($store = null)
    {
        $params                             = $this->_getConnectionParams($store);
        $params[Zitec_Dpd_Api_Configs::URL] = $this->_getUrlShipment();

        return $params;
    }

    /**
     *
     * @param mixed $store
     *
     * @return array
     */
    public function getManifestParams($store = null)
    {
        $params                             = $this->_getConnectionParams($store);
        $params[Zitec_Dpd_Api_Configs::URL] = $this->_getUrlManifest();

        return $params;
    }

    /**
     *
     * @param mixed $store
     *
     * @return array
     */
    public function getPickupParams($store = null)
    {
        $params                             = $this->_getConnectionParams($store);
        $params[Zitec_Dpd_Api_Configs::URL] = $this->_getUrlPickup();

        return $params;
    }

    /**
     *
     * @param mixed $store
     *
     * @return array
     */
    protected function _getConnectionParams($store = null)
    {
        $this->_store = $store;
        return array(
            Zitec_Dpd_Api_Configs::CONNECTION_TIMEOUT => $this->_getConnectionTimeout(),
            Zitec_Dpd_Api_Configs::WS_USER_NAME       => $this->_getWsUserName(),
            Zitec_Dpd_Api_Configs::WS_PASSWORD        => $this->_getWsPassword(),
            Zitec_Dpd_Api_Configs::SENDER_ADDRESS_ID  => $this->_getSenderAddressId(),
            Zitec_Dpd_Api_Configs::PAYER_ID           => $this->_getPayerId(),
            Zitec_Dpd_Api_Configs::DEBUG_MODE         => $this->_getDebugMode(),
            Zitec_Dpd_Api_Configs::DEBUG_LOGGER       => $this->_getDebugLogger()
        );
    }

    /**
     *
     * @return int
     */
    protected function _getConnectionTimeout()
    {
        return $this->_getConfigData("ws_connection_timeout", 'shipping');
    }

    protected function _getDebugMode()
    {
        return $this->_getConfigData("debug", 'shipping');
    }

    protected function _getDebugLogger()
    {
        $file = $this->_getConfigData("debugfile", 'shipping');
        if($file === '') {
            return false;
        } else {
            return new Zitec_Dpd_Api_Logger_Opencart2($file);
        }
    }

    /**
     *
     * @return type
     */
    protected function _getWsUserName()
    {
        return $this->_getConfigData("ws_username", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getWsPassword()
    {
        return $this->_getConfigData("ws_password", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getSenderAddressId()
    {
        return $this->_getConfigData("sender_id", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getPayerId()
    {
        return $this->_getConfigData("payer_id", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getUrlShipment()
    {
        return $this->_getWsUrl("shipmentUrl", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getUrlManifest()
    {
        return $this->_getWsUrl("manifestUrl", 'shipping');
    }

    /**
     *
     * @return string
     */
    protected function _getUrlPickup()
    {
        return $this->_getWsUrl("pickupUrl", 'shipping');
    }

    /**
     *
     * @param string $field
     *
     * @return mixed
     */
    public function _getConfigData($field, $path = null)
    {
        return $this->_getSettingsModel()->getSettings($field, $path, $this->_store);
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

    /**
     *
     * @param string $dateStr
     *
     * @return string|boolean
     */
    public function convertDPDDate($dateStr)
    {
        if (!is_string($dateStr) || strlen($dateStr) != 8) {
            return false;
        }

        return substr($dateStr, 0, 4) . '-' . substr($dateStr, 4, 2) . '-' . substr($dateStr, -2);
    }

    /**
     *
     * @param string $timeStr
     *
     * @return string|boolean
     */
    public function convertDPDTime($timeStr)
    {
        if (!is_string($timeStr) || strlen($timeStr) != 6) {
            return false;
        }

        return substr($timeStr, 0, 2) . ':' . substr($timeStr, 2, 2) . ':' . substr($timeStr, -2);
    }


    /**
     *
     * @return array|boolean
     */
    public function getPickupAddress()
    {
        $address                                               = array();
        $address[Zitec_Dpd_Api_Pickup_Create::NAME]            = $this->_getPickupAddressConfig("name");
        $address[Zitec_Dpd_Api_Pickup_Create::ADDITIONAL_NAME] = $this->_getPickupAddressConfig("additionalname", false);
        $address[Zitec_Dpd_Api_Pickup_Create::COUNTRY_CODE]    = $this->_getPickupAddressConfig("country");
        $address[Zitec_Dpd_Api_Pickup_Create::CITY]            = $this->_getPickupAddressConfig("city");
        $address[Zitec_Dpd_Api_Pickup_Create::STREET]          = $this->_getPickupAddressConfig("street");
        $address[Zitec_Dpd_Api_Pickup_Create::POSTCODE]        = $this->_getPickupAddressConfig("postcode");
        $address[Zitec_Dpd_Api_Pickup_Create::PHONE]           = $this->_getPickupAddressConfig("phone");
        $address[Zitec_Dpd_Api_Pickup_Create::EMAIL]           = $this->_getPickupAddressConfig("email");

        return !in_array(false, $address, true) ? $address : false;
    }

    /**
     *
     * @param string  $field
     * @param boolean $mandatory
     *
     * @return string|false
     */

    protected function _getPickupAddressConfig($field, $mandatory = true)
    {
        $value = Mage::getStoreConfig("shipping/zitec_pickupaddress/$field");

        return $value || !$mandatory ? $value : false;
    }

    /**
     * @param $urlType
     *
     * @return mixed|string
     */
    protected function _getWsUrl($urlType)
    {
        $wsCountry = $this->_getConfigData("wscountry", 'shipping');
        $mode      = $this->_getConfigData("zitecdpd_mode", 'shipping') ? "1" : "0";
        if ($mode) {
            $url = $this->_getConfigData("wsurl_production", 'shipping');
        } else {
            $url = $this->_getConfigData("wsurl_test", 'shipping');
        }

        if (!$url) {
            return "";
        }

        $urlServicePart = $this->_getConfigData("{$urlType}Part", 'shipping');
        $url            = $url . $urlServicePart;

        return $url;
    }

    /**
     *
     * @param string $countryId
     *
     * @return boolean
     */
    public function hasWsUrls($countryId)
    {
        return $this->hasWsProductionUrl($countryId) || $this->hasWsTestUrl($countryId);
    }

    /**
     *
     * @param string $countryId
     *
     * @return boolean
     */
    public function hasWsTestUrl($countryId)
    {
        return $this->_getConfigData("wsurl_{$countryId}_test", 'shipping') ? true : false;
    }

    /**
     *
     * @param string $countryId
     *
     * @return boolean
     */
    public function hasWsProductionUrl($countryId)
    {
        return $this->_getConfigData("wsurl_{$countryId}_production", 'shipping') ? true : false;
    }


    /**
     * @param $dpdServiceCode -   saved service code
     */
    public function extractDpdDeliveryServiceId($dpdServiceCode)
    {
        $service_codes = explode('.', $dpdServiceCode);
        if (empty($service_codes[1])) {
            return false;
        }
        $part2          = $service_codes[1];
        $explodedString = explode($this->getShippingMethodCode(), $part2);
        if (empty($explodedString[1])) {
            return false;
        }
        $serviceCode = $explodedString[1];

        return $serviceCode;
    }


    public function getShippingMethodCode()
    {
        return self::DPD_SHIPPING_METHOD_CODE;
    }

    /**
     * return true if the order was placed using a DPD service
     *
     * @param $order_info
     *
     * @return bool
     */
    public function orderHasDPDShippingMethod($order_info)
    {
        if (empty($order_info) || empty($order_info['shipping_code'])) {
            return false;
        }
        $shippingCode = $order_info['shipping_code'];
        if (strpos($shippingCode, 'zitec_dpd') !== false) {
            return true;
        }

        return false;
    }


}