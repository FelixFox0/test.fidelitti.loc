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
class ModelModuleDpdSettings extends Model
{

    protected $_data = null;

    //appending the path to the array keys so that it saves in db
    public function appendPath($array, $path) {
        $result = array();
        foreach($array as $key => $value) {
            $result[$path . '_' .$key] = $value;
        }
        return $result;
    }

    //this array is used to determine
    //which data will be saved in the database without checking the data format and type
    public static $_fields = array(
        'method_title',
        'dpd_enabled',
        'postcode_autocomplete',
        'zitecdpd_mode',
        'wsurlproduction',
        'wsurltest',
        'ws_username',
        'ws_password',
        'ws_connection_timeout',
        'payer_id',
        'sender_id',
        'dpd_services',
        'dpd_services_predict',
        'ws_username',
        'entry_enabled',

        'sender_name',
        'additional_name',
        'street',
        'city_name',
        'postcode',
        'country',
        'telephone',
        'email_address',

        'description',


    );


    public function getFields()
    {
        return self::$_fields;
    }

    public static $_labels = array(
        'method_title_label',
        'dpd_enabled_label',
        'postcode_autocomplete_label',
        'zitecdpd_mode_label',
        'wsurlproduction_label',
        'wsurltest_label',
        'ws_username_label',
        'ws_password_label',
        'ws_connection_timeout_label',
        'payer_id_label',
        'sender_id_label',
        'dpd_services',
        'dpd_services_predict',
        'ws_username_label',
        'button_save',
        'button_cancel',
        'button_remove',
        'entry_enabled',

        'sender_name_label',
        'additional_name_label',
        'street_label',
        'city_name_label',
        'postcode_label',
        'country_label',
        'telephone_label',
        'email_address_label',

        'description_label',
        'debug_label',
        'debug_file_label'


    );


    public function getLabels()
    {
        return self::$_labels;
    }

    /**
     * the open cart is looking to zitec_dpd_status
     * settings when is enabling the shipping method on frontend
     *
     * for this reason we have to update this setting every time we change enable/disable input
     *
     * @param $value
     */
    protected function  syncShippingMethodStatus($value)
    {
        $this->model_setting_setting->editSetting('zitec_dpd', array('zitec_dpd_status' => $value));
    }


    /**
     * save settings into the database
     *
     *  if one of the array item is also an array
     *  and the key is not one of the defined fields in this class
     *  then the function will be called recursively
     *  else the value will be saved serialized or not depending on the data type
     *
     * @param      $data
     * @param null $stores
     * @param null $path
     *
     * @return bool
     */
    public function saveSettings($data, $stores = null, $path = null)
    {
        if (is_array($data)) {
            foreach ($data as $key => $child_data) {
                if ($key === 'dpd_enabled') {
                    $this->syncShippingMethodStatus($child_data);
                }
                if (is_array($child_data) && !in_array($key, self::$_fields)) {
                    $this->saveSettings($child_data, $stores, $key);
                    unset($data[$key]);
                }
            }
            $this->load->model('setting/setting');
            if ($this->isValid($data)) {
                if (!empty($path)) {
                    $path = 'z_settings_' . $path;
                } else {
                    $path = 'z_settings';
                }
                if (is_array($stores)) {
                    foreach ($stores as $store) {
                        $savedSettings = $this->getSettings(null, $path, $store);
                        $data = $this->appendPath($data,$path);
                        $data          = array_merge($savedSettings, $data);
                        $this->model_setting_setting->editSetting($path, $data, $store);
                    }
                } else {
                    $savedSettings = $this->getSettings(null, $path);
                    $data = $this->appendPath($data,$path);
                    $data          = array_merge($savedSettings, $data);
                    $this->model_setting_setting->editSetting($path, $data);
                }

            }
        }

        return true;

    }

    public function isValid($data)
    {
        return true;
    }


    /**
     * return the saved settings considering key, path or store id
     *  key and path are not mandatory
     *  if one is missing an array wil be returned
     *
     * @param null $key
     * @param null $path
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getSettings($key = null, $path = null, $storeId = null)
    {
        if (strpos($path, 'z_settings') === false || strpos($path, 'z_settings') < 0) {
            if (!empty($path)) {
                $path = 'z_settings_' . $path;
            } else {
                $path = 'z_settings';
            }
        }
        $this->load->model('setting/setting');

        if (is_null($storeId)) {
            if (!empty($this->registry->get('request')->get['store_id'])) {
                $storeId = $this->registry->get('request')->get['store_id'];
            } else {
                $storeId = 0;
            }
        }
        if (empty($this->_data)){
            $data        = $this->model_setting_setting->getSetting($path, $storeId);
            $this->_data = $data;
        }

        if (is_array($this->_data) && !empty($key)) {
            if (!empty($this->_data[$path .'_'. $key])) {
                return $this->_data[$path .'_'. $key];
            }

            return false;
        }


        return $this->_data;

    }

    /**
     * return settings on frontend with fallback on default store 0
     *
     */
    public function getFrontendSettings($key = null, $path = null, $storeId = null)
    {
        if (is_null($storeId)) {
            $storeId = $this->config->get('config_store_id');
            $result  = $this->getSettings($key, $path, $storeId);
            if (!is_null($result)) {
                return $result;
            }
        }

        return $this->getSettings($key, $path, $storeId);
    }


    /**
     * return the sender settings
     *
     * @param null $key
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getSenderSettings($key = null, $storeId = null)
    {
        return $this->getSettings($key, 'sender', $storeId);
    }


    /**
     * return the settings made from shipping settings page
     *
     * @param null $key
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getShippingSettings($key = null, $storeId = null)
    {
        return $this->getSettings($key, 'shipping', $storeId);
    }

    /**
     * return the settings saved on payment settings page
     *
     * @param null $key
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getPaymentSettings($key = null, $storeId = null)
    {
        return $this->getSettings($key, 'payment', $storeId);
    }

    /**
     * return the selected services, marked as available from settings page
     *
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getAvailableDpdServices($storeId = null)
    {
        return $this->getAvailableDpdServices('dpd_services', $storeId);
    }

    /**
     * return the label for the shipping service method
     *
     * @param      $serviceId
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getShippingServiceLabel($serviceId, $storeId = null)
    {
        $string = $this->getShippingSettings('dpd_service_' . $serviceId, $storeId);
        if (is_null($string) && is_null($storeId)) {
            $storeId = $this->config->get('config_store_id');
            $string  = $this->getShippingSettings('dpd_service_' . $serviceId, $storeId);
        }
        if (strlen($string) <= 0) {
            $this->load->model('module/dpd/data/services_source');
            $options = $this->model_module_dpd_data_services_source->getOptions();
            $string  = $options[$serviceId];
        }

        return $string;
    }


    /**
     * return the label for the payment service method
     *
     * @param      $serviceId
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getPaymentMethodTitle($serviceId, $storeId = null)
    {
        $string = $this->getPaymentSettings('dpd_service_' . $serviceId, $storeId);

        return $string;
    }

    /**
     * return the payment method will be used at delivery
     *
     * @param null $storeId
     *
     * @return array|bool|null
     */
    public function getCodPaymentMethod($storeId = null)
    {
        $string = $this->getPaymentSettings('cod_methods', $storeId);
        if (empty($string)) {
            $this->load->model('module/dpd/data/payment_methods_source');

            return $this->model_module_dpd_data_payment_methods_source->getDefaultMethod();
        }

        return $string;
    }


}