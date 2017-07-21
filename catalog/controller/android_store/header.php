<?php
class ControllerAndroidStoreHeader extends Controller {
	public function index() {
		
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}		
		
		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}
		
		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		
		$data['name'] = $this->config->get('config_name');

		$data['menu_top'] = $this->load->controller('android_store/menu_top');
		
		if ($this->config->get('android_store_menu_type') == 'category-name-search-cart-user') {
			$data['menu_left'] = $this->load->controller('android_store/menu_category');
			$data['menu_right'] = $this->load->controller('android_store/menu_user');
		} else {
			$data['menu_left'] = $this->load->controller('android_store/menu_user');
			$data['menu_right'] = false;
		}
		
		// Filter menu for Category page
		$data['menu_filter'] = $this->load->controller('android_store/menu_filter');		
		
		$data['push_notification'] = $this->load->controller('android_store/notification');
		$data['device_check'] = $this->load->controller('android_store/device_check');
		$data['argus'] = $this->load->controller('android_store/android_tool/argus');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];				
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'android-store-home';
		}


		return $this->load->view('android_store/header', $data);
	}
}