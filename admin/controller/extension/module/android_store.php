<?php
class ControllerExtensionModuleAndroidStore extends Controller {
	private $error = array();
	private $version = '4.0';	
	
	public function install() {
		$this->load->model('extension/module/android_store');
		$this->model_extension_module_android_store->createTables();	
		$this->model_extension_module_android_store->createAndroidStoreLayout();	
	}
	
	public function index() {   
		$this->load->language('extension/module/android_store');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addScript('view/javascript/jquery/bootstrap-colorpicker/bootstrap-colorpicker.js');
		$this->document->addStyle('view/stylesheet/bootstrap-colorpicker.css');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('android_store', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
		
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_splash_screen'] = $this->language->get('tab_splash_screen');
		$data['tab_promote_application'] = $this->language->get('tab_promote_application');
		$data['tab_help'] = $this->language->get('tab_help');
		
		$data['legend_product'] = $this->language->get('legend_product');		
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_promote_info'] = $this->language->get('text_promote_info');
		$data['text_promote_bar'] = $this->language->get('text_promote_bar');
		$data['text_menu_user'] = $this->language->get('text_menu_user');
		$data['text_menu_category_user'] = $this->language->get('text_menu_category_user');
		
		$data['entry_template'] = $this->language->get('entry_template');
		$data['entry_menu_type'] = $this->language->get('entry_menu_type');
		$data['entry_push_api_key'] = $this->language->get('entry_push_api_key');
		$data['entry_catalog_limit'] = $this->language->get('entry_catalog_limit');
		$data['entry_description_length'] = $this->language->get('entry_description_length');
		
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image_thumb'] = $this->language->get('entry_image_thumb');
		$data['entry_image_popup'] = $this->language->get('entry_image_popup');
		$data['entry_image_product'] = $this->language->get('entry_image_product');
		$data['entry_image_related'] = $this->language->get('entry_image_related');
		$data['entry_image_cart'] = $this->language->get('entry_image_cart');
		$data['entry_image_location'] = $this->language->get('entry_image_location');
		
		$data['entry_status'] = $this->language->get('entry_status');		
		$data['entry_splash_logo'] = $this->language->get('entry_splash_logo');		
		$data['entry_background_color'] = $this->language->get('entry_background_color');		

		$data['entry_google_play_link'] = $this->language->get('entry_google_play_link');		
		$data['entry_promote_message'] = $this->language->get('entry_promote_message');		
		$data['entry_promote_background'] = $this->language->get('entry_promote_background');		
		$data['entry_promote_color'] = $this->language->get('entry_promote_color');		
		
		$data['help_splash_logo'] = $this->language->get('help_splash_logo');
		$data['help_catalog_limit'] = $this->language->get('help_catalog_limit');
		$data['help_description_length'] = $this->language->get('help_description_length');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['catalog_limit'])) {
			$data['error_catalog_limit'] = $this->error['catalog_limit'];
		} else {
			$data['error_catalog_limit'] = '';
		}

		if (isset($this->error['description_length'])) {
			$data['error_description_length'] = $this->error['description_length'];
		} else {
			$data['error_description_length'] = '';
		}		
		
		if (isset($this->error['image_thumb'])) {
			$data['error_image_thumb'] = $this->error['image_thumb'];
		} else {
			$data['error_image_thumb'] = '';
		}

		if (isset($this->error['image_popup'])) {
			$data['error_image_popup'] = $this->error['image_popup'];
		} else {
			$data['error_image_popup'] = '';
		}

		if (isset($this->error['image_product'])) {
			$data['error_image_product'] = $this->error['image_product'];
		} else {
			$data['error_image_product'] = '';
		}

		if (isset($this->error['image_related'])) {
			$data['error_image_related'] = $this->error['image_related'];
		} else {
			$data['error_image_related'] = '';
		}

		if (isset($this->error['image_cart'])) {
			$data['error_image_cart'] = $this->error['image_cart'];
		} else {
			$data['error_image_cart'] = '';
		}

		if (isset($this->error['image_location'])) {
			$data['error_image_location'] = $this->error['image_location'];
		} else {
			$data['error_image_location'] = '';
		}

		if (isset($this->error['google_play_link'])) {
			$data['error_google_play_link'] = $this->error['google_play_link'];
		} else {
			$data['error_google_play_link'] = array();
		}
		
		if (isset($this->error['promote_message'])) {
			$data['error_promote_message'] = $this->error['promote_message'];
		} else {
			$data['error_promote_message'] = array();
		}		
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_extension'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/android_store', 'token=' . $this->session->data['token'], true)
   		);
		
		$data['action'] = $this->url->link('extension/module/android_store', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true);

		$this->update_check();
		
		if (isset($this->error['update'])) {
			$data['update'] = $this->error['update'];
		} else {
			$data['update'] = '';
		}		
		
		if (isset($this->request->post['android_store_template'])) {
			$data['android_store_template'] = $this->request->post['android_store_template'];
		} elseif ($this->config->get('android_store_template')) {
			$data['android_store_template'] = $this->config->get('android_store_template');
		} else {
			$data['android_store_template'] = 'android_store_default';
		}
		
		// -- Get all themes that start with "android_store"
		$data['templates'] = array();

		$directories = glob(DIR_CATALOG . 'view/theme/*', GLOB_ONLYDIR);

		foreach ($directories as $directory) {
			if (strpos(basename($directory), "android_store") !== false) {
				$data['templates'][] = basename($directory);
			}	
		}
		// -- Stop get all themes that start with "android_store"	

		if (isset($this->request->post['android_store_menu_type'])) {
			$data['android_store_menu_type'] = $this->request->post['android_store_menu_type'];
		} elseif ($this->config->get('android_store_menu_type')) {
			$data['android_store_menu_type'] = $this->config->get('android_store_menu_type');
		} else {
			$data['android_store_menu_type'] = '';
		}
		
		if (isset($this->request->post['android_store_push_api_key'])) {
			$data['android_store_push_api_key'] = $this->request->post['android_store_push_api_key'];
		} elseif ($this->config->get('android_store_push_api_key')) {
			$data['android_store_push_api_key'] = $this->config->get('android_store_push_api_key');
		} else {
			$data['android_store_push_api_key'] = '';
		}

		if (isset($this->request->post['android_store_catalog_limit'])) {
			$data['android_store_catalog_limit'] = $this->request->post['android_store_catalog_limit'];
		} elseif ($this->config->get('android_store_catalog_limit')) {
			$data['android_store_catalog_limit'] = $this->config->get('android_store_catalog_limit');
		} else {
			$data['android_store_catalog_limit'] = 4;
		}

		if (isset($this->request->post['android_store_description_length'])) {
			$data['android_store_description_length'] = $this->request->post['android_store_description_length'];
		} elseif ($this->config->get('android_store_description_length')) {
			$data['android_store_description_length'] = $this->config->get('android_store_description_length');
		} else {
			$data['android_store_description_length'] = 100;
		}		
		
		if (isset($this->request->post['android_store_image_thumb_width'])) {
			$data['android_store_image_thumb_width'] = $this->request->post['android_store_image_thumb_width'];
		} elseif ($this->config->get('android_store_image_thumb_width')) {
			$data['android_store_image_thumb_width'] = $this->config->get('android_store_image_thumb_width');
		} else {
			$data['android_store_image_thumb_width'] = $this->config->get($this->config->get('config_theme') . '_image_thumb_width');
		}

		if (isset($this->request->post['android_store_image_thumb_height'])) {
			$data['android_store_image_thumb_height'] = $this->request->post['android_store_image_thumb_height'];
		} elseif ($this->config->get('android_store_image_thumb_height')) {
			$data['android_store_image_thumb_height'] = $this->config->get('android_store_image_thumb_height');
		} else {
			$data['android_store_image_thumb_height'] = $this->config->get($this->config->get('config_theme') . '_image_thumb_height');
		}

		if (isset($this->request->post['android_store_image_popup_width'])) {
			$data['android_store_image_popup_width'] = $this->request->post['android_store_image_popup_width'];
		} elseif ($this->config->get('android_store_image_popup_width')) {
			$data['android_store_image_popup_width'] = $this->config->get('android_store_image_popup_width');
		} else {
			$data['android_store_image_popup_width'] = $this->config->get($this->config->get('config_theme') . '_image_popup_width');
		}

		if (isset($this->request->post['android_store_image_popup_height'])) {
			$data['android_store_image_popup_height'] = $this->request->post['android_store_image_popup_height'];
		} elseif ($this->config->get('android_store_image_popup_height')) {
			$data['android_store_image_popup_height'] = $this->config->get('android_store_image_popup_height');
		} else {
			$data['android_store_image_popup_height'] = $this->config->get($this->config->get('config_theme') . '_image_popup_height');
		}

		if (isset($this->request->post['android_store_image_product_width'])) {
			$data['android_store_image_product_width'] = $this->request->post['android_store_image_product_width'];
		} elseif ($this->config->get('android_store_image_product_width')) {
			$data['android_store_image_product_width'] = $this->config->get('android_store_image_product_width');
		} else {
			$data['android_store_image_product_width'] = $this->config->get($this->config->get('config_theme') . '_image_product_width');
		}

		if (isset($this->request->post['android_store_image_product_height'])) {
			$data['android_store_image_product_height'] = $this->request->post['android_store_image_product_height'];
		} elseif ($this->config->get('android_store_image_product_height')) {
			$data['android_store_image_product_height'] = $this->config->get('android_store_image_product_height');
		} else {
			$data['android_store_image_product_height'] = $this->config->get($this->config->get('config_theme') . '_image_product_height');
		}

		if (isset($this->request->post['android_store_image_related_width'])) {
			$data['android_store_image_related_width'] = $this->request->post['android_store_image_related_width'];
		} elseif ($this->config->get('android_store_image_related_width')) {
			$data['android_store_image_related_width'] = $this->config->get('android_store_image_related_width');
		} else {
			$data['android_store_image_related_width'] = $this->config->get($this->config->get('config_theme') . '_image_related_width');
		}

		if (isset($this->request->post['android_store_image_related_height'])) {
			$data['android_store_image_related_height'] = $this->request->post['android_store_image_related_height'];
		} elseif ($this->config->get('android_store_image_related_height')) {
			$data['android_store_image_related_height'] = $this->config->get('android_store_image_related_height');
		} else {
			$data['android_store_image_related_height'] = $this->config->get($this->config->get('config_theme') . '_image_related_height');
		}

		if (isset($this->request->post['android_store_image_cart_width'])) {
			$data['android_store_image_cart_width'] = $this->request->post['android_store_image_cart_width'];
		} elseif ($this->config->get('android_store_image_cart_width')) {
			$data['android_store_image_cart_width'] = $this->config->get('android_store_image_cart_width');
		} else {
			$data['android_store_image_cart_width'] = $this->config->get($this->config->get('config_theme') . '_image_cart_width');
		}

		if (isset($this->request->post['android_store_image_cart_height'])) {
			$data['android_store_image_cart_height'] = $this->request->post['android_store_image_cart_height'];
		} elseif ($this->config->get('android_store_image_cart_height')) {
			$data['android_store_image_cart_height'] = $this->config->get('android_store_image_cart_height');
		} else {
			$data['android_store_image_cart_height'] = $this->config->get($this->config->get('config_theme') . '_image_cart_height');
		}

		if (isset($this->request->post['android_store_image_location_width'])) {
			$data['android_store_image_location_width'] = $this->request->post['android_store_image_location_width'];
		} elseif ($this->config->get('android_store_image_location_width')) {
			$data['android_store_image_location_width'] = $this->config->get('android_store_image_location_width');
		} else {
			$data['android_store_image_location_width'] = $this->config->get($this->config->get('config_theme') . '_image_location_width');
		}

		if (isset($this->request->post['android_store_image_location_height'])) {
			$data['android_store_image_location_height'] = $this->request->post['android_store_image_location_height'];
		} elseif ($this->config->get('android_store_image_location_height')) {
			$data['android_store_image_location_height'] = $this->config->get('android_store_image_location_height');
		} else {
			$data['android_store_image_location_height'] = $this->config->get($this->config->get('config_theme') . '_image_location_height');
		}
		
		if (isset($this->request->post['android_store_splash_status'])) {
			$data['android_store_splash_status'] = $this->request->post['android_store_splash_status'];
		} else { 
			$data['android_store_splash_status'] = (string)$this->config->get('android_store_splash_status');
		} 		
		
		if (isset($this->request->post['android_store_splash_logo'])) {
			$data['android_store_splash_logo'] = $this->request->post['android_store_splash_logo'];
		} elseif ($this->config->get('android_store_splash_logo')) { 
			$data['android_store_splash_logo'] = (string)$this->config->get('android_store_splash_logo');
		} else {
			$data['android_store_splash_logo'] = '';
		}
		
		$this->load->model('tool/image');
		
		if ($data['android_store_splash_logo'] ){
			$data['splash_logo'] = $this->model_tool_image->resize($data['android_store_splash_logo'], 200, 200);
		} else {
		    $data['splash_logo'] = $this->model_tool_image->resize('placeholder.png', 200, 200);
		}		
		
		$data['placeholder_logo'] = $this->model_tool_image->resize('placeholder.png', 200, 200);

		if (isset($this->request->post['android_store_splash_background_color'])) {
			$data['android_store_splash_background_color'] = $this->request->post['android_store_splash_background_color'];
		} elseif ($this->config->get('android_store_splash_background_color')) {
			$data['android_store_splash_background_color'] = $this->config->get('android_store_splash_background_color');
		} else {
			$data['android_store_splash_background_color'] = '#F2F2F2';
		}		
		
		if (isset($this->request->post['android_store_promote_status'])) {
			$data['android_store_promote_status'] = $this->request->post['android_store_promote_status'];
		} else { 
			$data['android_store_promote_status'] = (string)$this->config->get('android_store_promote_status');
		} 

		if (isset($this->request->post['android_store_google_play_link'])) {
			$data['android_store_google_play_link'] = $this->request->post['android_store_google_play_link'];
		} else { 
			$data['android_store_google_play_link'] = (string)$this->config->get('android_store_google_play_link');
		}		
		
		if (isset($this->request->post['android_store_promote_message'])) {
			$data['android_store_promote_message'] = $this->request->post['android_store_promote_message'];
		} elseif ($this->config->get('android_store_promote_message')) {
			$data['android_store_promote_message'] = $this->config->get('android_store_promote_message');
		} else {
			$data['android_store_promote_message'] = array();
		}

		if (isset($this->request->post['android_store_promote_background'])) {
			$data['android_store_promote_background'] = $this->request->post['android_store_promote_background'];
		} elseif ($this->config->get('android_store_promote_background')) { 
			$data['android_store_promote_background'] = (string)$this->config->get('android_store_promote_background');
		} else {
			$data['android_store_promote_background'] = '#007EB5';
		}	

		if (isset($this->request->post['android_store_promote_color'])) {
			$data['android_store_promote_color'] = $this->request->post['android_store_promote_color'];
		} elseif ($this->config->get('android_store_promote_color')) { 
			$data['android_store_promote_color'] = (string)$this->config->get('android_store_promote_color');
		} else {
			$data['android_store_promote_color'] = '#FFFFFF';
		}		
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['token'] = $this->session->data['token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/android_store', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/android_store')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['android_store_catalog_limit']) {
			$this->error['catalog_limit'] = $this->language->get('error_catalog_limit');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}

		if (!$this->request->post['android_store_description_length']) {
			$this->error['description_length'] = $this->language->get('error_description_length');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_setting'));
		}		
		
		if (!$this->request->post['android_store_image_thumb_width'] || !$this->request->post['android_store_image_thumb_height']) {
			$this->error['image_thumb'] = $this->language->get('error_image_thumb');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}

		if (!$this->request->post['android_store_image_popup_width'] || !$this->request->post['android_store_image_popup_height']) {
			$this->error['image_popup'] = $this->language->get('error_image_popup');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}

		if (!$this->request->post['android_store_image_product_width'] || !$this->request->post['android_store_image_product_height']) {
			$this->error['image_product'] = $this->language->get('error_image_product');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}

		if (!$this->request->post['android_store_image_related_width'] || !$this->request->post['android_store_image_related_height']) {
			$this->error['image_related'] = $this->language->get('error_image_related');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}

		if (!$this->request->post['android_store_image_cart_width'] || !$this->request->post['android_store_image_cart_height']) {
			$this->error['image_cart'] = $this->language->get('error_image_cart');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}

		if (!$this->request->post['android_store_image_location_width'] || !$this->request->post['android_store_image_location_height']) {
			$this->error['image_location'] = $this->language->get('error_image_location');
			$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_image'));
		}
		
		if ($this->request->post['android_store_promote_status'] == 1) {
			foreach ($this->request->post['android_store_promote_message'] as $language_id => $value) {
				if (utf8_strlen($value['message']) < 1) {
					$this->error['promote_message'][$language_id] = $this->language->get('error_message');
					$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_promote_application'));
				}
			}
			
			if (utf8_strlen($this->request->post['android_store_google_play_link']) < 1 ){
				$this->error['google_play_link'] = $this->language->get('error_google_play_link');
				$this->error['warning'] = sprintf($this->language->get('error_in_tab'), $this->language->get('tab_promote_application'));
			}
			
			if (utf8_strlen($this->request->post['android_store_promote_background']) > 1 && utf8_strlen($this->request->post['android_store_promote_color']) > 1 && strtolower($this->request->post['android_store_promote_background']) == strtolower($this->request->post['android_store_promote_color'])){
				$this->error['warning'] = sprintf($this->language->get('error_same_color'), $this->language->get('tab_promote_application'));
			}
		}		
				
		return !$this->error;
	}
	
	private function update_check() {
		$data = 'v=' . $this->version . '&ex=16&e=' . $this->config->get('config_email') . '&ocv=' . VERSION;
        $curl = false;
        
        if (extension_loaded('curl')) {
			$ch = curl_init();
			
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);
			
			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}
            
			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			if ($http_code == 200) {
				$result = json_decode($result);
				
                if ($result) {
                    $curl = true;
                }
                
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
        
        if (!$curl) {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);
			
			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}	
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;
			
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				
				if ($at_start) {
					$at_start = false;
					
					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}
					
					$http_code = $m[2];
					continue;
				}
				
				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}
					
					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}
					
					continue;
				}
				
                $response .= $line;
			}
					
			fclose($fp);
			
			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}
				
				$result = json_decode($response);
				
                if ( isset($result->version) && ($result->version > $this->version) ) {
				    $this->error['update'] = 'A new version of this extension is available. <a target="_blank" href="' . $result->url . '">Click here</a> to see the Changelog.';
				}
			}
		}
	}
	
	public function push_notification() {   
		$this->load->language('extension/module/push_notification');

		$this->document->setTitle($this->language->get('heading_title'));
				
		$this->load->model('extension/module/android_store');		
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validatePushNotification()) {		
			$this->model_extension_module_android_store->addPushNotification($this->request->post);
			
			$notification_id = $this->model_extension_module_android_store->getLastNotificationID();
				
			$push_notification_info = $this->model_extension_module_android_store->getPushNotification($notification_id);
				
			if ($push_notification_info) {
				$push_data = $this->model_extension_module_android_store->generatePushData($push_notification_info);
				
				$firebase_cloud_messaging = new FirebaseCloudMessaging($this->config->get('android_store_push_api_key'));
				
				$firebase_cloud_messaging->setTopic("android-store-push-notification");
				$firebase_cloud_messaging->send($push_data);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
			}
		}
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_device'] = sprintf($this->language->get('text_device'), $this->model_extension_module_android_store->getTotalRegisteredDevices());
		$data['text_api_key'] = sprintf($this->language->get('text_api_key'), $this->config->get('android_store_push_api_key'));
		$data['text_home'] = $this->language->get('text_home');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_product'] = $this->language->get('text_product');
		
		$data['entry_title'] = $this->language->get('entry_title');		
		$data['entry_short_description'] = $this->language->get('entry_short_description');		
		$data['entry_extended_description'] = $this->language->get('entry_extended_description');		
		$data['entry_redirect'] = $this->language->get('entry_redirect');		
		$data['entry_category'] = $this->language->get('entry_category');		
		$data['entry_product'] = $this->language->get('entry_product');		
		
		$data['help_title'] = $this->language->get('help_title');		
		$data['help_short_description'] = $this->language->get('help_short_description');		
		$data['help_extended_description'] = $this->language->get('help_extended_description');		
		$data['help_redirect'] = $this->language->get('help_redirect');		
		$data['help_category'] = $this->language->get('help_category');		
		$data['help_product'] = $this->language->get('help_product');	
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}		
		
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}

		if (isset($this->error['short_description'])) {
			$data['error_short_description'] = $this->error['short_description'];
		} else {
			$data['error_short_description'] = '';
		}

		if (isset($this->error['extended_description'])) {
			$data['error_extended_description'] = $this->error['extended_description'];
		} else {
			$data['error_extended_description'] = '';
		}	

		if (isset($this->error['category'])) {
			$data['error_category'] = $this->error['category'];
		} else {
			$data['error_category'] = '';
		}	

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}		
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/android_store/push_notification', 'token=' . $this->session->data['token'], true)
   		);
		
		$data['action'] = $this->url->link('extension/module/android_store/push_notification', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);	
		
		
		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} else { 
			$data['title'] = '';
		} 		

		if (isset($this->request->post['short_description'])) {
			$data['short_description'] = $this->request->post['short_description'];
		} else { 
			$data['short_description'] = '';
		} 

		if (isset($this->request->post['extended_description'])) {
			$data['extended_description'] = $this->request->post['extended_description'];
		} else { 
			$data['extended_description'] = '';
		}
		
		if (isset($this->request->post['redirect_route'])) {
			$data['redirect_route'] = $this->request->post['redirect_route'];
		} else { 
			$data['redirect_route'] = '';
		}		

		$data['product_info'] = array();	
		$data['category_info'] = array();

		if (isset($this->request->post['redirect_route'])){
			if ($this->request->post['redirect_route'] == 'product'){
				if (isset($this->request->post['selected_product'])) {
					$this->load->model('catalog/product');
					
					$data['product_info'] = $this->model_catalog_product->getProduct($this->request->post['selected_product']);
				}
			}
			
			if ($this->request->post['redirect_route'] == 'category'){
				if (isset($this->request->post['selected_category'])) {
					$this->load->model('catalog/category');
					
					$data['category_info'] = $this->model_catalog_category->getCategory($this->request->post['selected_category']);
				}
			}			
		}	
		
		$data['token'] = $this->session->data['token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/push_notification', $data));
	}
	
	private function validatePushNotification() {
		if (!$this->user->hasPermission('modify', 'extension/module/android_store')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (utf8_strlen($this->config->get('android_store_push_api_key')) < 5) {
			$this->error['warning'] = sprintf($this->language->get('error_api_key'), $this->url->link('extension/extension', 'token=' . $this->session->data['token']));
		}		
		
		if ($this->model_extension_module_android_store->getTotalRegisteredDevices() == 0) {
			$this->error['warning'] = $this->language->get('error_device');
		}
		
		if (utf8_strlen($this->request->post['title']) < 5 || utf8_strlen($this->request->post['title']) > 128) {
			$this->error['title'] = $this->language->get('error_title');
		}
		
		if (utf8_strlen($this->request->post['short_description']) < 5 || utf8_strlen($this->request->post['short_description']) > 128) {
			$this->error['short_description'] = $this->language->get('error_short_description');
		}		
		
		if (utf8_strlen(html_entity_decode($this->request->post['extended_description'], ENT_QUOTES, 'UTF-8')) < 20) {
			$this->error['extended_description'] = $this->language->get('error_extended_description');
		}		
		
		if ($this->request->post['redirect_route']) {
			if ($this->request->post['redirect_route'] == 'product') {
				if (!isset($this->request->post['selected_product']) || utf8_strlen($this->request->post['selected_product']) < 1){
					$this->error['product'] = $this->language->get('error_product');
				}
			}

			if ($this->request->post['redirect_route'] == 'category') {
				if (!isset($this->request->post['selected_category']) || utf8_strlen($this->request->post['selected_category']) < 1){
					$this->error['category'] = $this->language->get('error_category');
				}
			}			
		}
				
		return !$this->error;
	}	
}
?>