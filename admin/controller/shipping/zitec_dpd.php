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
class ControllerShippingZitecDpd extends Controller
{
    protected $_data = array();

    /**
     * errors to be shown on template
     *
     * @var array
     */
    private $error = array();


    public function preDispatch()
    {
        $this->load->url = $this->url;
        $this->load->config = $this->config;
        $this->load->session = $this->session;

        //this is a hack in order to make config and session available in templates (done for OC 2.2)
        $this->_data['config'] = $this->config;
        $this->_data['session'] = $this->session;
        $this->_data['url'] = $this->url;

        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'zitec_dpd' AND `type` = 'shipping' ");

        if ($result->num_rows) {
            //extension installed it's ok
        } else {
            $this->session->data['success'] = $this->language->get('DPD - shipping module is not installed. Please install it by pressing the install button in shipping extensions list.');
            $this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }

    public function install()
    {
        $this->load->model('setting/setting');
        $this->load->model('module/dpd/settings');

        try {

            $this->load->model('module/dpd/helper');
            $this->model_module_dpd_helper->install();

            $this->load->model('module/dpd/postcode');
            $this->model_module_dpd_postcode->install();

            $this->model_setting_setting->editSetting('zitec_dpd', array('zitec_dpd_status' => 1));
            $this->model_setting_setting->editSetting('dpd_payment', array('dpd_payment_status' => 1));
            $this->model_setting_setting->editSetting('dpd_cod', array('dpd_cod_status' => 1));

            $this->model_module_dpd_postcode->requireApiFile();
            $postcodeSearch = new Zitec_Dpd_Postcode_Search('mysql', $this->db);
            $postcodeSearch->installPostcodeDatabase();

        } catch (Exception $e) {
            $this->model_setting_setting->editSetting('zitec_dpd', array('zitec_dpd_status' => 0));
            $this->session->data['error'] = $this->language->get('DPD module install - an error occurred: ' . $e->getMessage());
            return false;
        }

        $this->session->data['success'] = $this->language->get('DPD module - was successfully installed.');

    }

    public function uninstall()
    {
        try {

            $this->load->model('module/dpd/helper');
            $this->model_module_dpd_helper->uninstall();

            $this->load->model('module/dpd/postcode');
            $this->model_module_dpd_postcode->requireApiFile();
            $postcodeSearch = new Zitec_Dpd_Postcode_Search('mysql', $this->db);
            $postcodeSearch->uninstallPostcodeDatabase();

            $this->load->model('module/dpd/postcode');
            $this->model_module_dpd_postcode->uninstall();

            $this->load->model('setting/setting');
            $this->model_setting_setting->deleteSetting('z_settings_shipping');
            $this->model_setting_setting->deleteSetting('z_settings_payment');

            $this->model_setting_setting->editSetting('zitec_dpd', array('zitec_dpd_status' => 0));
            $this->model_setting_setting->editSetting('dpd_cod', array('dpd_cod_status' => 0));
            $this->model_setting_setting->editSetting('dpd_payment', array('dpd_payment_status' => 0));

            $this->load->model('extension/extension');
            $this->model_extension_extension->uninstall('total', 'dpd_payment');
            $this->model_extension_extension->uninstall('payment', 'dpd_cod');

        } catch (Exception $e) {
            $this->session->data['error'] = $this->language->get('DPD module uninstall - an error occurred: ' . $e->getMessage());

            return false;
        }

        $this->session->data['success'] = $this->language->get('DPD module- was successfully uninstalled.');
    }

    /**
     *  add to all actions in this controller a basic behavior
     *  for example add the basic breadcrumbs information
     *  init some models needed in all places
     */
    private function applyGeneralFeatures()
    {

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['heading_title'] = $this->language->get('heading_title');

        //ERROR handling

        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        if (isset($this->session->data['error_warning'])) {
            $this->_data['error_warning'] = $this->session->data['error_warning'];

            unset($this->session->data['error_warning']);
        } else {
            $this->_data['error_warning'] = '';
        }

        //Models init
        $this->_data['language'] = $this->language;

        $this->load->model('setting/store');

        $this->_data['stores'] = $this->model_setting_store->getStores();

        //partials and templates
        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');
    }

    /**
     * in various actions is needed to have all data sources initialized
     */
    private function loadSourceModelObjects()
    {
        $this->load->model('module/dpd/data/services_source');
        $this->_data['dppServicesSource'] = $this->model_module_dpd_data_services_source;

        $this->load->model('module/dpd/data/condition_source');
        $this->_data['conditionSource'] = $this->model_module_dpd_data_condition_source;

        $this->load->model('module/dpd/data/yesno_source');
        $this->_data['yesnoSource'] = $this->model_module_dpd_data_yesno_source;

        $this->load->model('module/dpd/data/shipping_price_source');
        $this->_data['shippingPriceSource'] = $this->model_module_dpd_data_shipping_price_source;

        $this->load->model('module/dpd/data/cod_surcharge_source');
        $this->_data['codSurchargeSource'] = $this->model_module_dpd_data_cod_surcharge_source;

        $this->load->model('module/dpd/data/payment_type_source');
        $this->_data['paymentTypeSource'] = $this->model_module_dpd_data_payment_type_source;

        $this->load->model('module/dpd/data/payment_methods_source');
        $this->_data['paymentMethodsSource'] = $this->model_module_dpd_data_payment_methods_source;
    }


    /**
     * list all table rates on the  grid mode without pagination
     */
    public function table_rates()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd/tablerates');

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['heading_title'] = $this->language->get('heading_title');

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        $this->_data['insert']   = $this->url->link('shipping/zitec_dpd/table_rates_form', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['delete']   = $this->url->link('shipping/zitec_dpd/table_rates_delete', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['language'] = $this->language;

        // get store items
        $this->load->model('setting/store');
        $this->load->model('module/dpd/tablerate');
        $rates = $this->model_module_dpd_tablerate->getRates();

        foreach ($rates as &$result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('Edit'),
                'href' => $this->url->link('shipping/zitec_dpd/table_rates_update_form', 'token=' . $this->session->data['token'] . '&rate_id=' . $result['id'], 'SSL')
            );

            $link             = $this->url->link('shipping/zitec_dpd/table_rates_remove_rate', 'token=' . $this->session->data['token'] . '&rate_id=' . $result['id'], 'SSL');
            $action[]         = array(
                'text'    => $this->language->get('Delete'),
                'onclick' => "var r = confirm('" . $this->language->get('Delete cannot be undone! Are you sure you want to do this? ') . "'); if(r == true){window.location = '$link'; }",
            );
            $result['action'] = $action;
        }
        $this->_data['rates'] = $rates;

        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }

        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        if (isset($this->session->data['error_warning'])) {
            $this->_data['error_warning'] = $this->session->data['error_warning'];

            unset($this->session->data['error_warning']);
        } else {
            $this->_data['error_warning'] = '';
        }

        $this->loadSourceModelObjects();
        $this->response->setOutput($this->load->view('shipping/zitec_dpd/tablerates.tpl', $this->_data));
    }

    /**
     * it will be a regular insert on duplicate action
     * that's why we pass control to table_rates_insert
     */
    public function  table_rates_update()
    {
        $this->table_rates_insert();
    }

    /**
     * Shwo the insert form with some particular data populated
     * this form will have the rate id on it
     *
     */
    public function  table_rates_update_form()
    {
        $rateId = 0;
        if (!empty($this->request->get['rate_id'])) {
            $rateId = $this->request->get['rate_id'];
        }

        $this->load->model('module/dpd/tablerate');
        $rateArray = $this->model_module_dpd_tablerate->getRate($rateId);

        if (is_array($rateArray)) {
            $this->session->data['form_data'] = $rateArray;
        }

        $this->table_rates_form();

        unset($this->session->data['form_data']);

    }

    /***
     * create a new table rate entry or update existing one
     * if a rate id exist in post values
     *
     */
    public function table_rates_insert()
    {
        $this->load->language('shipping/zitec_dpd/tablerates');

        $this->load->model('module/dpd/tablerate');
        $this->load->model('setting/store');

        $status = false;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->model_module_dpd_tablerate->isValid($this->request->post)) {
            if (!empty($this->request->post['id'])) {
                $status = $this->model_module_dpd_tablerate->update($this->request->post);
                if ($status) {
                    $this->session->data['success'] = $this->language->get('table_rates_update_text_success');
                } else {
                    $this->session->data['error'] = $this->language->get('table_rates_update_text_error');
                }
            } else {
                $status = $this->model_module_dpd_tablerate->save($this->request->post);
                if ($status) {
                    $this->session->data['success'] = $this->language->get('table_rates_insert_text_success');
                } else {
                    $this->session->data['error'] = $this->language->get('table_rates_insert_text_error');
                }
            }
        }

        $this->response->redirect($this->url->link('shipping/zitec_dpd/table_rates', 'token=' . $this->session->data['token'], 'SSL'));
    }


    /**
     * remove all selected rates
     * this will be looking for selected items ( array )on the post
     *
     */
    public function table_rates_delete()
    {
        $status='';
        $this->load->language('shipping/zitec_dpd/tablerates');

        $params = $this->request->post;
        if (empty($params['selected'])) {
            $this->session->data['error'] = $this->language->get('table_rates_delete_nothing_to_delete');
            $this->response->redirect($this->url->link('shipping/zitec_dpd/table_rates', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $selectedItems = $params['selected'];
        $this->load->model('module/dpd/tablerate');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->model_module_dpd_tablerate->isValid($this->request->post)) {
            $status = $this->model_module_dpd_tablerate->delete($selectedItems);
        }

        if ($status) {
            $this->session->data['form_data'] = array();
            $this->session->data['success'] = $this->language->get('table_rates_delete_text_success');
        } else {
            $this->session->data['error'] = $this->language->get('table_rates_delete_text_error');
        }

        $this->response->redirect($this->url->link('shipping/zitec_dpd/table_rates', 'token=' . $this->session->data['token'], 'SSL'));

    }


    /**
     * pass the controll to mass remove function with particular parameters
     */
    public function table_rates_remove_rate()
    {
        $this->request->server['REQUEST_METHOD'] = 'POST';
        $this->request->post['selected']         = array($this->request->get['rate_id']);
        $this->table_rates_delete();

    }

    /**
     * used session to store persistent data after redirect
     * 
     * it is used to insert or update a table rate entry
     */
    public function table_rates_form()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd/tablerates');

        $this->applyGeneralFeatures();

        $this->_data['cancel'] = $this->url->link('shipping/zitec_dpd/table_rates', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['action'] = $this->url->link('shipping/zitec_dpd/table_rates_insert', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('module/dpd/data/services_source');
        $this->_data['dpd_services_source'] = $this->model_module_dpd_data_services_source;

        $this->load->model('localisation/country');
        $this->_data['countryModel'] = $this->model_localisation_country;

        $this->_data['dpd_services_source'] = $this->model_module_dpd_data_services_source;

        $this->loadSourceModelObjects();

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('shipping/zitec_dpd/tablerates_form.tpl', $this->_data));
    }


    /**
     * save shipping settings values to the core opencart
     * settings table, it is working on a dynamicaly way: every field in the form will be saved
     *
     */
    public function shipping_settings_save()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd/shipping_settings');

        $this->load->model('module/dpd/settings');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $status = false;
        $stores = array($this->request->post['store']);

        if (empty($stores)) {
            $stores = array(0);
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $status = $this->model_module_dpd_settings->saveSettings($this->request->post, $stores);
        }

        if ($status) {
            $this->session->data['success'] = $this->language->get('save_settings_text_success');
        } else {
            $this->session->data['error'] = $this->language->get('save_settings_text_error');
        }

        $this->response->redirect($this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'));

    }


    /**
     * display the shipping settings form
     */
    public function shipping_settings()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd/shipping_settings');

        $this->load->model('module/dpd/settings');


        $fields = $this->model_module_dpd_settings->getLabels();
        $this->populateLanguageArray($this->_data, $fields);

        $this->_data['dpd_settings_model'] = $this->model_module_dpd_settings;
        $this->_data['language']           = $this->language;

        $this->document->setTitle($this->language->get('heading_title'));

        $this->_data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->error['warning'])) {
            $this->_data['error_warning'] = $this->error['warning'];
        } else {
            $this->_data['error_warning'] = '';
        }

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['action'] = $this->url->link('shipping/zitec_dpd/shipping_settings_save', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['cancel'] = $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['test']   = $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL');

        // get store items
        $this->load->model('setting/store');

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        $this->load->model('setting/store');

        $this->_data['stores'] = $this->model_setting_store->getStores();
        $this->_data['url']    = $this->url;

        if (!empty($this->request->get['store_id'])) {
            $this->session->data['form_data']['store'] = $this->request->get['store_id'];
        }

        $this->loadSourceModelObjects();
        $this->response->setOutput($this->load->view('shipping/zitec_dpd/shipping_settings.tpl', $this->_data));

        $this->session->data['form_data'] = array();
    }


    /**
     * display the sender settings form
     */
    public function sender_settings()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd/sender_settings');

        $this->load->model('module/dpd/settings');


        $fields = $this->model_module_dpd_settings->getLabels();
        $this->populateLanguageArray($this->_data, $fields);

        $this->_data['dpd_settings_model'] = $this->model_module_dpd_settings;
        $this->_data['language']           = $this->language;

        $this->document->setTitle($this->language->get('heading_title'));

        $this->_data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->error['warning'])) {
            $this->_data['error_warning'] = $this->error['warning'];
        } else {
            $this->_data['error_warning'] = '';
        }


        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/zitec_dpd/sender_settings', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['action'] = $this->url->link('shipping/zitec_dpd/shipping_settings_save', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['cancel'] = $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['test']   = $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL');

        // get store items
        $this->load->model('setting/store');

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        $this->load->model('setting/store');

        $this->_data['stores'] = $this->model_setting_store->getStores();
        $this->_data['url']    = $this->url;

        if (!empty($this->request->get['store_id'])) {
            $this->session->data['form_data']['store'] = $this->request->get['store_id'];
        }

        $this->loadSourceModelObjects();
        $this->response->setOutput($this->load->view('shipping/zitec_dpd/sender_settings.tpl', $this->_data));

        $this->session->data['form_data'] = array();

    }


    /**
     * display the payment settings form
     *
     */
    public function payment_settings()
    {
        $this->preDispatch();

        $this->load->language('shipping/zitec_dpd/payment_settings');

        $this->load->model('module/dpd/settings');

        $fields = $this->model_module_dpd_settings->getLabels();
        $this->populateLanguageArray($this->_data, $fields);

        $this->_data['dpd_settings_model'] = $this->model_module_dpd_settings;
        $this->_data['language']           = $this->language;

        $this->document->setTitle($this->language->get('heading_title'));

        $this->_data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->error['warning'])) {
            $this->_data['error_warning'] = $this->error['warning'];
        } else {
            $this->_data['error_warning'] = '';
        }

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['action'] = $this->url->link('shipping/zitec_dpd/shipping_settings_save', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['cancel'] = $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['test']   = $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL');

        // get store items
        $this->load->model('setting/store');

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        $this->load->model('setting/store');

        $this->_data['stores'] = $this->model_setting_store->getStores();
        $this->_data['url']    = $this->url;

        if (!empty($this->request->get['store_id'])) {
            $this->session->data['form_data']['store'] = $this->request->get['store_id'];
        }

        $this->loadSourceModelObjects();

        $this->response->setOutput($this->load->view('shipping/zitec_dpd/payment_settings.tpl', $this->_data));
        $this->session->data['form_data'] = array();
    }


    /**
     *  the landing page of the dpd shipping settings section
     */
    public function index()
    {
        $this->preDispatch();
        $this->load->language('shipping/zitec_dpd');

        $this->applyGeneralFeatures();
        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );



        $this->_data['action'] = $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['cancel']               = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['test']                 = $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['sender_settings_url']  = $this->url->link('shipping/zitec_dpd/sender_settings', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['table_rates_url']      = $this->url->link('shipping/zitec_dpd/table_rates', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['upgrade_url']          = $this->url->link('shipping/zitec_dpd/upgrade', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['payment_settings_url'] = $this->url->link('shipping/zitec_dpd/payment_settings', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['dpd_shipment_list_index'] = $this->url->link('dpd/shipment_list/index', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['text_shipment'] = $this->language->get('text_shipment');
        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('shipping/zitec_dpd.tpl', $this->_data));
    }


    public function upgrade()
    {
        $this->load->model('module/dpd/helper');
        $this->model_module_dpd_helper->upgrade();

        $this->session->data['success'] = $this->language->get('DPD Module: Database install was successfully executed.');
        $this->response->redirect($this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'));

    }


    /**
     * @param array $data
     * @param       $keys
     */
    public function populateLanguageArray(array &$data, $keys)
    {
        if (is_array($keys)) {
            foreach ($keys as $key) {
                $data[$key] = $this->language->get($key);
            }
        }
    }


    /**
     * validate if user has rights to edit shipping rates
     *
     * @return bool
     */
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'shipping/zitec_dpd')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}


