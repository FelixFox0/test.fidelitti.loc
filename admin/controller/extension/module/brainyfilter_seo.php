<?php
/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
class ControllerExtensionModuleBrainyFilterSeo extends Controller {
	private $error = array(); 
    private $_data = array();
	
    private $default = array(
        'enabled' => 0,
        'transliteration' => 1,
        'lowercase' => 1,
        'separator' => array(
            'next_filter'  => '/',
            'values_start' => '[',
            'values_end'   => ']',
            'range_separator'   => '-',
            'list_separator'   => ',',
        ),
        'param_name' => 'bfilter',
        'rules' => array(
            //array(enabled, target, replacement, descr)
        ),
    );
    
    /**
     * @var ModelExtensionModuleBrainyFilterSeo
     */
    protected $model;
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->model('extension/module/brainyfilter_seo');
        
        $this->model = new ModelExtensionModuleBrainyFilterSeo($this->registry);
    }
    
    public function install() {
        $this->model->createSefTermsTable();

        $this->load->model('extension/modification');
        $xml = file_get_contents(DIR_APPLICATION . '../ocmod/brainyfilter_seo.ocmod.xml');
        $data = array(
            'name' => 'Brainy Filter SEO URLs plugin',
            'code' => 'brainyfilter_seo',
            'author' => 'Giant Leap Lab',
            'version' => '1.0.2 OC2.3',
            'xml' => $xml,
            'link' => '',
            'status' => '1',
        );
        $this->model_extension_modification->addModification($data);
        
        $this->load->model('extension/event');
        $this->model_extension_event->addEvent('brainyfilter_seo', 'admin/model/catalog/product/addProduct/after', 'extension/module/brainyfilter_seo/eventEditProduct');
        $this->model_extension_event->addEvent('brainyfilter_seo', 'admin/model/catalog/product/editProduct/after', 'extension/module/brainyfilter_seo/eventEditProduct');
        $this->model_extension_event->addEvent('brainyfilter_seo', 'admin/model/catalog/product/deleteProduct/after', 'extension/module/brainyfilter_seo/eventEditProduct');
    }
    
    public function uninstall() {
        $this->load->model('extension/event');
        
        $this->model->dropSefTermsTable();
        $this->load->model('extension/modification');
        $mod = $this->model_extension_modification->getModificationByCode('brainyfilter_seo');
        if ($mod) {
            $this->model_extension_modification->deleteModification($mod['modification_id']);
        }
        $this->model_extension_event->deleteEvent('brainyfilter_seo');
    }
    
    public function eventEditProduct($productId)
    {
        $args = func_get_args();
        if (count($args) > 1) {
            $productId = $args[2];
        }
        $this->model->updateTermsRelativeToProduct($productId);
    }
    
    /**
     * @todo: implement onDelete Brainy Filter extension handler
    **/
    
    public function index()
    {
        $this->load->model('setting/setting');
        $this->load->model('extension/module');
	    $this->load->model('localisation/stock_status');
        $this->load->model('localisation/language');
        $this->load->model('catalog/category');
        $this->load->model('extension/extension');
        $this->_setupLanguage();
        $this->_data['legacyMode'] = !isset($this->_data['lang']->top_menu_basic_settings);
        
		$this->document->addScript('view/javascript/jquery.autocomplete.min.js');
        $this->document->addScript('view/javascript/brainyfilter.js');
        if ($this->_data['legacyMode']) {
            $this->document->addScript('view/javascript/brainyfilter.legacy.js');
        }
        
        $this->document->addScript('view/javascript/brainyfilter_seo.js');
        $isMijoShop = class_exists('MijoShop') && defined('JPATH_MIJOSHOP_OC');
        if ($isMijoShop) {
            $this->document->addStyle('admin/view/stylesheet/brainyfilter.css');
            $this->document->addStyle('admin/view/stylesheet/brainyfilter_seo.css');
        } else {
            $this->document->addStyle('view/stylesheet/brainyfilter.css');
            $this->document->addStyle('view/stylesheet/brainyfilter_seo.css');
        }
        
        if (isset($this->request->post['bf'])) {
            $post = $this->_parsePostData();
            $replacements = isset($post['replacements']) ? $post['replacements'] : array();
            unset($post['replacements']);
            if ($this->_validate($post)) {
                $this->model->settings = $this->_saveSettings($post);
                $this->model->generateSefTerms();
                $this->model->saveCustomReplacements($replacements);
//                $this->model->fixDuplicates();
                $this->session->data['success'] = $this->language->get('message_success_save');

                if ($this->request->post['action'] == 'apply') {
                    $this->response->redirect($this->url->link('extension/module/brainyfilter_seo', 'token=' . $this->session->data['token'], 'SSL'));
                } else {
                    $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
                }
            }
        }
        
        $this->document->setTitle($this->language->get('heading_title_text'));
        
        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('module'),
            'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('bf_heading_title'),
            'href'      => $this->url->link('extension/module/brainyfilter', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('seo_urls'),
            'href'      => $this->url->link('extension/module/brainyfilter/seourls', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }
        
        $extensions = $this->model_extension_extension->getInstalled('module');
        if (!in_array('brainyfilter', $extensions)) {
            $this->error[] = $this->language->get('brainyfilter_not_istalled');
        }
        
        $duplicates = $this->model->checkForDuplicates();
        $this->_data['warning'] = array();
        if (count($duplicates)) {
            $warning = $this->language->get('seo_duplicates_found_warning');
            foreach ($duplicates as $duplicate) {
                if (isset($duplicate['filter_group_name'])) {
                    $warning .= sprintf($this->language->get('seo_filter_has_duplicates'), 
                            $this->language->get('seo_select_' . $duplicate['filter_group_type']),
                            $duplicate['filter_group_name'],
                            $duplicate['duplicate']
                        );
                } elseif (isset($duplicate['filter_group_type'])) {
                    $warning .= sprintf($this->language->get('seo_section_has_duplicates'), 
                            $this->language->get('seo_select_' . $duplicate['filter_group_type']), 
                            $duplicate['duplicate']
                        );
                } else {
                    $warning .= sprintf($this->language->get('seo_filter_duplicate'), $duplicate['duplicate']);
                }
            }
            $this->error[] = $warning;
        }
        
        $this->_data['settings']      = $this->_applySettings();
        $this->_data['settings']['replacements'] = $this->model->getCustomReplacements();
        $this->_data['seoUrl']        = $this->url->link('extension/module/brainyfilter_seo', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['cancel']        = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['modules']       = $this->model_extension_module->getModulesByCode('brainyfilter');
        $this->_data['bfModuleUrl']   = $this->url->link('extension/module/brainyfilter', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['autocompleteUrl'] = $this->url->link('extension/module/brainyfilter_seo/autocomplete', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['mbModuleEnabled'] = function_exists('mb_strtolower');
        
        $this->_data['error_warning'] = $this->error;
        
        $this->_data['header']        = $this->load->controller('common/header');
        $this->_data['footer']        = $this->load->controller('common/footer');
        $this->_data['column_left']   = $this->load->controller('common/column_left');
        
        $this->response->setOutput($this->load->view('extension/module/brainyfilter_seo.tpl', $this->_data));
    }
    
    public function autocomplete()
    {
        $filters = $this->model->findFilters($this->request->get['type'], $this->request->get['query']);
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($filters));

    }
    
    private function _getRequestParam($name, $default = null)
    {
        if (isset($this->request->get[$name])) {
            return $this->request->get[$name];
        }
        return $default;
    }

	/**
	 * Data validation
	 * The method validates the given POST data
	 * @todo Implement the method
	 * @return boolean
	 */
    private function _validate($data) {
        if (!$this->user->hasPermission('modify', 'extension/module/brainyfilter_seo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
        
        if (!$this->error) {
			return true;
		} else {
			return false;
		}	
    }
    
	/**
	 * Apply Settings
	 *
	 * @return extension settings 
	 */
    private function _applySettings() 
    {
        if (isset($this->request->post['bf']) && is_array($this->request->post['bf'])) {
            $this->default = self::_arrayReplaceRecursive($this->default, $this->request->post['bf']);
            return $this->default;
        } elseif ($this->config->get('brainyfilter_seo')) {
            return $this->config->get('brainyfilter_seo');
        }
        return $this->default;
    }

    private function _parsePostData() {
        if(get_magic_quotes_gpc()){
            $this->request->post['bf'] = stripslashes($this->request->post['bf']);
        }
        $json = str_replace('&quot;', '"', $this->request->post['bf']);
        $data = json_decode($json, true);
        
        self::_fixHtmlEntityEncoding($data);
        
        return $data;
    }
    
    private static function _fixHtmlEntityEncoding(&$data) 
    {
        if (is_string($data)) {
            $data = html_entity_decode($data);
        } elseif (is_array($data)) {
            foreach ($data as &$item) {
                self::_fixHtmlEntityEncoding($item);
            }
        }
    }

    private function _saveSettings($data) 
    {
        $this->load->model('setting/setting');
        $this->load->language('extension/module/brainyfilter_seo');
        
        $fullSettings = $this->model_setting_setting->getSetting('brainyfilter');
        $fullSettings['brainyfilter_seo'] = $data;
        $this->model_setting_setting->editSetting('brainyfilter', $fullSettings);
        $bfSettings = $this->model_setting_setting->getSetting('brainyfilter');
        return $bfSettings['brainyfilter_seo'];
    }
	
	/**
	 * Set Up Language variables
	 * 
	 * @return void
	 */
	private function _setupLanguage()
	{
        $lang = array_merge(
                $this->load->language('extension/module/brainyfilter'),
                $this->load->language('extension/module/brainyfilter_seo')
            );
        $langObj = new stdClass();
        if (count($lang)) {
            foreach ($lang as $var => $val) {
                $langObj->$var = $val;
            }
        }
        // language variables from other files
		$langObj->yes = $this->language->get('text_yes');
		$langObj->no  = $this->language->get('text_no');
        // compatibility with BF <= 4.7.2
        $map = array(
            'disable_all'   => 'text_disable_all',
            'enable_all'    => 'text_enable_all',
            'default'       => 'entry_default',
        );
        $this->_setupLanguageLegacy($langObj, $map);
        
        $this->_data['lang'] = $langObj;
	}
    
    private function _setupLanguageLegacy($langObj, $map)
    {
        foreach ($map as $newKey => $oldKey) {
            if (!isset($langObj->{$newKey}) && isset($langObj->{$oldKey})) {
                $langObj->{$newKey} = $langObj->{$oldKey};
            }
        }
    }
    
    /**
     * An alternative of PHP native function array_replace_recursive(), which is designed
     * to bring similar functionality for PHP versions lower then 5.3. <br>
     * <b>Note</b>: unlike PHP native function the method holds only two arrays as parameters.
     * @param array $array An original array
     * @param array $array1 Replacement
     * @return array
     */
    private static function _arrayReplaceRecursive($array, $array1)
    {
        foreach ($array1 as $key => $value) {
            if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                $array[$key] = array();
            }

            if (is_array($value)) {
                $value = self::_arrayReplaceRecursive($array[$key], $value);
            }
            $array[$key] = $value;
        }
        return $array;
    }
}