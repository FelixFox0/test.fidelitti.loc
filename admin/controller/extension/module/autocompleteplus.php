<?php
################################################################
#     AutocompletePlus 1.03 for Opencart 2.3.0.x by AlexDW 	   #
################################################################
class ControllerExtensionModuleAutocompleteplus extends Controller {

	private $error = array(); 

	public function index() {   
		$this->load->language('extension/module/autocompleteplus');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('autocompleteplus', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$text_strings = array(
				'heading_title',
				'text_module',
				'text_edit',
				'text_search',
				'text_show',
				'text_enabled',
				'text_disabled',

				'entry_image',
				'entry_field',
				'entry_price',
				'entry_limit',
				'entry_status',
				'entry_model',
				'entry_sku',
				'entry_upc',
				'entry_ean',
				'entry_jan',
				'entry_isbn',
				'entry_mpn',
				'entry_location',

				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove'
		);

		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}

		$config_data = array(
				'autocompleteplus_status',
				'autocompleteplus_image',
				'autocompleteplus_field',
				'autocompleteplus_price',
				'autocompleteplus_model',
				'autocompleteplus_sku',
				'autocompleteplus_upc',
				'autocompleteplus_ean',
				'autocompleteplus_jan',
				'autocompleteplus_isbn',
				'autocompleteplus_mpn',
				'autocompleteplus_location',
				'autocompleteplus_limit'
		);

		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				$data[$conf] = $this->config->get($conf);
			}
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['fields'] = array(
				'model',
				'sku',
				'upc',
				'ean',
				'jan',
				'isbn',
				'mpn',
				'location'
		);

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/autocompleteplus', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/autocompleteplus', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/autocompleteplus', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/autocompleteplus')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
}
?>