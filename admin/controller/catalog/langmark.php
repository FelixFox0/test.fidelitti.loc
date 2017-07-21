<?php
class ControllerCatalogLangmark extends Controller
{
	private $error = array();
	protected $data;

	public function index()
	{
		 $this->config->set("blog_work", true);


		$this->language->load('module/blog');
		$this->data['oc_version'] = str_pad(str_replace(".", "", VERSION), 7, "0");
		$this->load->model('setting/setting');

		$this->data['blog_version']       = '*';
		$this->data['blog_version_model'] = '*';

		$settings_admin                   = $this->model_setting_setting->getSetting('ascp_version', 'ascp_version');
		foreach ($settings_admin as $key => $value) {
			$this->data['blog_version'] = $value;
		}

		$settings_admin_model = $this->model_setting_setting->getSetting('ascp_version_model', 'ascp_version_model');
		foreach ($settings_admin_model as $key => $value) {
			$this->data['blog_version_model'] = $value;
		}

		$this->data['blog_version'] = $this->data['blog_version'] . ' ' . $this->data['blog_version_model'];
		$this->data['tab_general']  = $this->language->get('tab_general');
		$this->data['tab_list']     = $this->language->get('tab_list');

        $this->cont('agooa/adminmenu');
        $this->data['agoo_menu'] = $this->controller_agooa_adminmenu->index();

		$this->language->load('catalog/langmark');

		$langmark_version = $this->language->get('langmark_version');

		$this->data['langmark_version'] = '*.*';
		$settings_admin = $this->model_setting_setting->getSetting('asc_langmark_version', 'asc_langmark_version');

		foreach ($settings_admin as $key => $value) {
			$this->data['langmark_version'] = $value;
		}

		if ($this->data['langmark_version'] != $langmark_version) {
			$this->data['text_update'] = $this->language->get('text_update');
		}

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		if (file_exists(DIR_APPLICATION . 'view/stylesheet/seocmspro.css')) {
			$this->document->addStyle('view/stylesheet/seocmspro.css');
		}
		if (file_exists(DIR_APPLICATION . 'view/javascript/jquery/tabs.js')) {
			$this->document->addScript('view/javascript/jquery/tabs.js');
		} else {
			if (file_exists(DIR_APPLICATION . 'view/javascript/blog/tabs/tabs.js')) {
				$this->document->addScript('view/javascript/blog/tabs/tabs.js');
			}
		}
		if (file_exists(DIR_APPLICATION . 'view/javascript/blog/seocmspro.js')) {
			$this->document->addScript('view/javascript/blog/seocmspro.js');
		}

		if (SC_VERSION < 20) {
				$this->document->addStyle('view/javascript/seocms/bootstrap/css/bootstrap.css');
				//$this->document->addScript('view/javascript/seocms/bootstrap/jquery-2.1.1.min.js');
				//$this->document->addScript('view/javascript/seocms/bootstrap/js/bootstrap.min.js');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->cache->delete('langmark');
			$this->cache->delete('html');
			$this->model_setting_setting->editSetting('asc_langmark', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
				if (SC_VERSION < 20) {
					$this->redirect($this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL'));
				} else {
					$this->response->redirect($this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL'));
				}
		}

		$this->data['token'] = $this->session->data['token'];
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['entry_langmark_template'] = $this->language->get('entry_langmark_template');
  		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_list'] = $this->language->get('tab_list');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['url_langmark'] = $this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_record'] = $this->url->link('catalog/record', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_fields'] = $this->url->link('catalog/fields', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_comment'] = $this->url->link('catalog/comment', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_create'] = $this->url->link('catalog/langmark/createtables', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_delete'] = $this->url->link('catalog/langmark/deletesettings', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_modules'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_modules_text'] = $this->language->get('url_modules_text');
		$this->data['url_langmark_text'] = $this->language->get('url_langmark_text');
		$this->data['url_record_text'] = $this->language->get('url_record_text');
		$this->data['url_fields_text'] = $this->language->get('url_fields_text');
		$this->data['url_comment_text'] = $this->language->get('url_comment_text');
		$this->data['url_create_text'] = $this->language->get('url_create_text');
		$this->data['url_delete_text'] = $this->language->get('url_delete_text');
		$this->data['url_options'] = $this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_schemes'] = $this->url->link('catalog/langmark/schemes', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['url_widgets'] = $this->url->link('catalog/langmark/widgets', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['action'] = $this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		foreach ($this->data['languages'] as $code => $language) {
			if (!isset($language['image'])) {
            	$this->data['languages'][$code]['image'] = "language/".$code."/".$code.".png";
			} else {
                $this->data['languages'][$code]['image'] = "view/image/flags/".$language['image'];
			}
			if (!file_exists(DIR_APPLICATION.$this->data['languages'][$code]['image'])) {
				$this->data['languages'][$code]['image'] = "view/image/seocms/sc_1x1.png";
			}
		}

        $this->data['config_language_id'] = $this->config->get('config_language_id');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}


		$this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' / '
		);
		if (isset($this->request->post['asc_langmark'])) {
			$this->data['asc_langmark'] = $this->request->post['asc_langmark'];
		} else {
			$this->data['asc_langmark'] = $this->config->get('asc_langmark');
		}

		if (isset($this->request->post['asc_langmark']['get_pagination'])) {
			$this->data['asc_langmark']['get_pagination'] = $this->request->post['asc_langmark']['get_pagination'];
		} else {
			if (isset($this->data['asc_langmark']['get_pagination'])) {
				$this->data['asc_langmark']['get_pagination'] = $this->data['asc_langmark']['get_pagination'];
			} else {
				$this->data['asc_langmark']['get_pagination'] = 'tracking';
			}
		}

		$this->data['modules'] = array();
		if (isset($this->request->post['langmark_module'])) {
			$this->data['modules'] = $this->request->post['langmark_module'];
		} elseif ($this->config->get('langmark_module')) {
			$this->data['modules'] = $this->config->get('langmark_module');
		}

		if (isset($this->request->post['asc_langmark']['desc_type'])) {
              foreach ($this->request->post['asc_langmark']['desc_type'] as $type_id => $desc_type) {
                 if ($desc_type ['title']=='') {
                   $this->request->post['asc_langmark']['desc_type'][$desc_type ['type_id']] ['title'] = 'Type-'.$desc_type ['type_id'];
              	 }

              	 if ($type_id != $desc_type ['type_id']) {
              	 	unset($this->request->post['asc_langmark']['desc_type'][$type_id]);
              	 	$this->request->post['asc_langmark']['desc_type'][$desc_type ['type_id']] = $desc_type;
              	 }
              }
		}

		 if (!isset($this->data['asc_langmark']['desc_type']) || empty($this->data['asc_langmark']['desc_type'])) {
			 $this->data['asc_langmark']['desc_type'] =
			 array( '1' =>
			 		array( 'type_id' => '1',
			 				'title' => 'product/category.tpl'
			 			 ),
					'2' =>
			 		array( 'type_id' => '2',
			 				'title' =>  'product/manufacturer_info.tpl'
			 			 ),
					'3' =>
			 		array( 'type_id' => '3',
			 				'title' => 'information/information.tpl'
			 			 )
			 );
		 }



		if (!isset($this->data['asc_langmark']['ex_multilang_route'])) {
        	$this->data['asc_langmark']['ex_multilang_route'] = "quickview|api/|common/simple_connector|search|assets|captcha";
		}
		if (!isset($this->data['asc_langmark']['ex_multilang_uri'])) {
        	$this->data['asc_langmark']['ex_multilang_uri'] = "flycart";
		}

		if (!isset($this->data['asc_langmark']['ex_url_route'])) {
        	$this->data['asc_langmark']['ex_url_route'] = "quickview|api/|common/simple_connector|assets|captcha";
		}
		if (!isset($this->data['asc_langmark']['ex_url_uri'])) {
        	$this->data['asc_langmark']['ex_url_uri'] = "flycart";
		}




  		$this->language->load('localisation/currency');
  		$this->load->model('localisation/currency');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'title';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		$data = array(
			'sort'  => $sort,
			'order' => $order,
		);
		$results = $this->model_localisation_currency->getCurrencies($data);

		foreach ($results as $result) {
			$this->data['currencies'][] = array(
				'currency_id'   => $result['currency_id'],
				'title'         => $result['title'] . (($result['code'] == $this->config->get('config_currency')) ? $this->language->get('text_default') : null),
				'code'          => $result['code'],
				'value'         => $result['value'],
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified']))
			);
		}

		$this->load->model('design/layout');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->data['this']     = $this;
		$this->template         = 'catalog/langmark.tpl';
		$this->children         = array(
			'common/header',
			'common/footer'
		);
		$this->data['registry'] = $this->registry;
		$this->data['language'] = $this->language;
		$this->data['config']   = $this->config;


		if (SC_VERSION < 20) {
			$this->data['column_left'] = '';
			$html                      = $this->render();
		} else {
			$this->data['header']      = $this->load->controller('common/header');
			$this->data['menu']        = $this->load->controller('common/menu');
			$this->data['footer']      = $this->load->controller('common/footer');
			$this->data['column_left'] = $this->load->controller('common/column_left');
			$html                      = $this->load->view($this->template, $this->data);
		}
		$this->response->setOutput($html);

	}
/***************************************/
	public function cont($cont)
	{
		$file  = DIR_CATALOG . 'controller/' . $cont . '.php';
		if (file_exists($file)) {
           $this->cont_loading($cont, $file);
		} else {
			$file  = DIR_APPLICATION . 'controller/' . $cont . '.php';
            if (file_exists($file)) {
             	$this->cont_loading($cont, $file);
            } else {
				trigger_error('Error: Could not load controller ' . $cont . '!');
				exit();
			}
		}
	}
/***************************************/
	private function cont_loading ($cont, $file)
	{
			$class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $cont);
			include_once($file);
			$this->registry->set('controller_' . str_replace('/', '_', $cont), new $class($this->registry));
	}
/***************************************/
	private function validate()
	{
		$this->language->load('catalog/langmark');
		if (!$this->user->hasPermission('modify', 'catalog/langmark')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			$this->request->post = array();
			return false;
		}
	}

/***************************************/
	public function deletesettings()
	{
	    if (($this->request->server['REQUEST_METHOD'] == 'GET') && $this->validate()) {
		    $html = "";
			$this->language->load('catalog/langmark');
			$this->load->model('setting/setting');

			$this->model_setting_setting->deleteSetting('asc_langmark');
			$this->model_setting_setting->deleteSetting('asc_langmark_version');

			$html =  $this->language->get('text_success');

			$this->response->setOutput($html);
		} else {

			$html = $this->language->get('error_permission');

			$this->response->setOutput($html);
		}
	}

/***************************************/
	public function createTables()
	{
         if (($this->request->server['REQUEST_METHOD'] == 'GET') && $this->validate()) {
            $html = "";
			$this->language->load('catalog/langmark');
			$this->data['langmark_version'] = $this->language->get('langmark_version');
			$this->load->model('setting/setting');

			$setting_version = Array(
				'asc_langmark_version' => $this->data['langmark_version']
			);
			$this->model_setting_setting->editSetting('asc_langmark_version', $setting_version);


			$msql = "SELECT * FROM `" . DB_PREFIX . "layout_route` WHERE `route`='product/search'";
			$query = $this->db->query($msql);
			if (count($query->rows) <= 0) {
				$msql = "INSERT INTO `" . DB_PREFIX . "layout` (`name`) VALUES  ('Search');";
				$query = $this->db->query($msql);
				$msql = "INSERT INTO `" . DB_PREFIX . "layout_route` (`route`, `layout_id`) VALUES  ('product/search'," . $this->db->getLastId() . ");";
				$query = $this->db->query($msql);
			}


		if ($this->config->get('config_seo_url_type')!='seo_url') {
			$devider = true;
		} else {
			$devider = false;
		}

		if (!$this->config->get('asc_langmark') && !is_array($this->config->get('asc_langmark'))) {
            $aoptions = Array(
            	'switch' => true,
            	'cache_widgets' => false,
            	'pagination' => false,
            	'pagination_prefix' => 'page',
            	'hreflang_status' => true,
            	'url_close_slash' => $devider,
            	'description_status' => true,
             	'ex_multilang_route' => "quickview|api/|common/simple_connector|search|assets|captcha|module/language",
             	'ex_multilang_uri' => "flycart",
             	'ex_url_route' => "quickview|api/|common/simple_connector|assets|captcha|module/language",
             	'ex_url_uri' => "flycart"
            );


            $this->load->model('localisation/language');
			$languages = $this->model_localisation_language->getLanguages();
			foreach ($languages as $language) {

				$prefix = $language['code'].'/';
				if ($this->config->get('config_language') == $language['code']) {
					$prefix = '';
				}
				$aoptions['prefix'][$language['code']] = $prefix;
				$aoptions['hreflang'][$language['code']] = $language['code'];

				$pagination_title = $this->language->get('text_pagination_title');

				if ($language['code'] == 'ru') {
					$pagination_title = $this->language->get('text_pagination_title_russian');
				}
				if ($language['code'] == 'ua') {
					$pagination_title = $this->language->get('text_pagination_title_ukraine');
				}

				$aoptions['pagination_title'][$language['code']] = $pagination_title;
			}

			$settings = Array(
				'asc_langmark' => $aoptions
			);
			$this->model_setting_setting->editSetting('asc_langmark', $settings);

			$html .= $this->language->get('text_install_ok');

		} else {
            $html .= $this->language->get('text_install_already');
		}


		$this->response->setOutput($html);
		}  else {
			$html = $this->language->get('error_permission');
			$this->response->setOutput($html);
		}
	}

/***************************************/

}
