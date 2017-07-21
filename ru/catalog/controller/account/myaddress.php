<?php
class ControllerAccountMyAddress extends Controller {
	private $error = array();
	public $data = array();
	private $isOpencartTwo;
	private $modData;
	public function __construct($registry){
		parent::__construct($registry);
		$this->isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->modData = $this->xtensions->getModData();
		$this->data['modData'] = $this->modData;
		$this->data['isOpencartTwo'] = $this->isOpencartTwo;
	}
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/myaddress', '', 'SSL');

			$this->xtensions->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/address');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('account/address');

		$this->getList();
	}

	public function add() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/myaddress', '', 'SSL');
			$this->xtensions->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/address');

		$this->document->setTitle($this->language->get('heading_title'));
		if($this->isOpencartTwo){
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		}

		$this->load->model('account/address');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_account_address->addAddress($this->request->post);
			if($this->isOpencartTwo){
				// Add to activity log
				$this->load->model('account/activity');

				$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);

				$this->model_account_activity->addActivity('address_add', $activity_data);
				$this->session->data['success'] = $this->language->get('text_add');
			}else{
				$this->session->data['success'] = $this->language->get('text_insert');
			}
			$this->xtensions->redirect($this->url->link('account/myaddress', '', 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/myaddress', '', 'SSL');
			$this->xtensions->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/address');

		$this->document->setTitle($this->language->get('heading_title'));
		if($this->isOpencartTwo){
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		}

		$this->load->model('account/address');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_account_address->editAddress($this->request->get['address_id'], $this->request->post);
			if($this->isOpencartTwo){
				// Default Shipping Address
				if (isset($this->session->data['shipping_address']['address_id']) && ($this->request->get['address_id'] == $this->session->data['shipping_address']['address_id'])) {
					$this->session->data['shipping_address'] = $this->xtensions->getAddress($this,$this->request->get['address_id']);

					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}

				// Default Payment Address
				if (isset($this->session->data['payment_address']['address_id']) && ($this->request->get['address_id'] == $this->session->data['payment_address']['address_id'])) {
					$this->session->data['payment_address'] = $this->xtensions->getAddress($this,$this->request->get['address_id']);

					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
				}
				// Add to activity log
				$this->load->model('account/activity');

				$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);
				$this->model_account_activity->addActivity('address_edit', $activity_data);
				$this->session->data['success'] = $this->language->get('text_edit');
			}else{
				if (isset($this->session->data['shipping_address_id']) && ($this->request->get['address_id'] == $this->session->data['shipping_address_id'])) {
					$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
					$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
					$this->session->data['shipping_postcode'] = $this->request->post['postcode'];

					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}

				// Default Payment Address
				if (isset($this->session->data['payment_address_id']) && ($this->request->get['address_id'] == $this->session->data['payment_address_id'])) {
					$this->session->data['payment_country_id'] = $this->request->post['country_id'];
					$this->session->data['payment_zone_id'] = $this->request->post['zone_id'];

					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
				}
				$this->session->data['success'] = $this->language->get('text_update');
			}
			$this->xtensions->redirect($this->url->link('account/myaddress', '', 'SSL'));
		}
		$this->getForm();
	}

	public function delete() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/myaddress', '', 'SSL');

			$this->xtensions->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/address');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('account/address');

		if (isset($this->request->get['address_id']) && $this->validateDelete()) {
			$this->model_account_address->deleteAddress($this->request->get['address_id']);
			if($this->isOpencartTwo){
				// Default Shipping Address
				if (isset($this->session->data['shipping_address']['address_id']) && ($this->request->get['address_id'] == $this->session->data['shipping_address']['address_id'])) {
					unset($this->session->data['shipping_address']);
					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}

				// Default Payment Address
				if (isset($this->session->data['payment_address']['address_id']) && ($this->request->get['address_id'] == $this->session->data['payment_address']['address_id'])) {
					unset($this->session->data['payment_address']);
					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
				}

				// Add to activity log
				$this->load->model('account/activity');

				$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);

				$this->model_account_activity->addActivity('address_delete', $activity_data);
			}else{
				// Default Shipping Address
				if (isset($this->session->data['shipping_address_id']) && ($this->request->get['address_id'] == $this->session->data['shipping_address_id'])) {
					unset($this->session->data['shipping_address_id']);
					unset($this->session->data['shipping_country_id']);
					unset($this->session->data['shipping_zone_id']);
					unset($this->session->data['shipping_postcode']);
					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
					
				// Default Payment Address
				if (isset($this->session->data['payment_address_id']) && ($this->request->get['address_id'] == $this->session->data['payment_address_id'])) {
					unset($this->session->data['payment_address_id']);
					unset($this->session->data['payment_country_id']);
					unset($this->session->data['payment_zone_id']);
					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
				}
			}
			$this->session->data['success'] = $this->language->get('text_delete');
			$this->xtensions->redirect($this->url->link('account/myaddress', '', 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/address', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_address_book'] = $this->language->get('text_address_book');
		$this->data['text_empty'] = $this->language->get('text_empty');

		$this->data['button_new_address'] = $this->language->get('button_new_address');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_back'] = $this->language->get('button_back');

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

		$this->data['addresses'] = array();

		$results = $this->xtensions->getAddresses($this);

		foreach ($results as $result) {
			$this->data['addresses'][] = array(
				'address_id' => $result['address_id'],
				'address'    => $result['formatted_address'],
				'update'     => $this->url->link('account/myaddress/edit', 'address_id=' . $result['address_id'], 'SSL'),
				'delete'     => $this->url->link('account/myaddress/delete', 'address_id=' . $result['address_id'], 'SSL')
			);
		}

		$this->data['add'] = $this->url->link('account/myaddress/add', '', 'SSL');
		$this->data['insert'] = $this->url->link('account/myaddress/add', '', 'SSL');
		$this->data['back'] = $this->url->link('account/account', '', 'SSL');

		$children = array('common/column_left', 'common/column_right', 'common/content_top','common/content_bottom', 'common/footer', 'common/header');
		$this->data += $this->xtensions->getChildren($children);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/address_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/address_list.tpl';
		} else {
			$this->template = 'default/template/account/address_list.tpl';
		}
		if($this->isOpencartTwo){
			$this->response->setOutput($this->load->view($this->template, $this->data));
		}else{
			$this->response->setOutput($this->render());
		}
	}

	protected function getForm() {

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
        	'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/address', '', 'SSL'),        	
        	'separator' => $this->language->get('text_separator')
		);

		if (!isset($this->request->get['address_id'])) {
			$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_edit_address'),
				'href'      => $this->url->link('account/address/add', '', 'SSL'),       		
        		'separator' => $this->language->get('text_separator')
			);
		} else {
			$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_edit_address'),
				'href'      => $this->url->link('account/address/edit', 'address_id=' . $this->request->get['address_id'], 'SSL'),       		
        		'separator' => $this->language->get('text_separator')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_edit_address'] = $this->language->get('text_edit_address');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_loading'] = $this->language->get('text_loading');
		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_default'] = $this->language->get('entry_default');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');
		$this->data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$this->data['error_lastname'] = $this->error['lastname'];
		} else {
			$this->data['error_lastname'] = '';
		}

		if (isset($this->error['address_1'])) {
			$this->data['error_address_1'] = $this->error['address_1'];
		} else {
			$this->data['error_address_1'] = '';
		}

		if (isset($this->error['city'])) {
			$this->data['error_city'] = $this->error['city'];
		} else {
			$this->data['error_city'] = '';
		}

		if (isset($this->error['postcode'])) {
			$this->data['error_postcode'] = $this->error['postcode'];
		} else {
			$this->data['error_postcode'] = '';
		}

		if (isset($this->error['country'])) {
			$this->data['error_country'] = $this->error['country'];
		} else {
			$this->data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$this->data['error_zone'] = $this->error['zone'];
		} else {
			$this->data['error_zone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$this->data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$this->data['error_custom_field'] = array();
		}

		if (!isset($this->request->get['address_id'])) {
			$this->data['action'] = $this->url->link('account/myaddress/add', '', 'SSL');
		} else {
			$this->data['action'] = $this->url->link('account/myaddress/edit', 'address_id=' . $this->request->get['address_id'], 'SSL');
		}

		if (isset($this->request->get['address_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$address_info = $this->xtensions->getAddress($this,$this->request->get['address_id']);
		}

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($address_info)) {
			$this->data['firstname'] = $address_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($address_info)) {
			$this->data['lastname'] = $address_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['company'])) {
			$this->data['company'] = $this->request->post['company'];
		} elseif (!empty($address_info)) {
			$this->data['company'] = $address_info['company'];
		} else {
			$this->data['company'] = '';
		}

		if (isset($this->request->post['address_1'])) {
			$this->data['address_1'] = $this->request->post['address_1'];
		} elseif (!empty($address_info)) {
			$this->data['address_1'] = $address_info['address_1'];
		} else {
			$this->data['address_1'] = '';
		}

		if (isset($this->request->post['address_2'])) {
			$this->data['address_2'] = $this->request->post['address_2'];
		} elseif (!empty($address_info)) {
			$this->data['address_2'] = $address_info['address_2'];
		} else {
			$this->data['address_2'] = '';
		}

		if (isset($this->request->post['postcode'])) {
			$this->data['postcode'] = $this->request->post['postcode'];
		} elseif (!empty($address_info)) {
			$this->data['postcode'] = $address_info['postcode'];
		} else {
			$this->data['postcode'] = '';
		}

		if (isset($this->request->post['city'])) {
			$this->data['city'] = $this->request->post['city'];
		} elseif (!empty($address_info)) {
			$this->data['city'] = $address_info['city'];
		} else {
			$this->data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$this->data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($address_info['country_id'])) {
			$this->data['country_id'] = $address_info['country_id'];
		} elseif (!$this->modData['country_show_edit'] && $this->modData['def_country']) {
			$this->data['country_id'] = $this->modData['def_country'];
		} else {
			$this->data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$this->data['zone_id'] = $this->request->post['zone_id'];
		}  elseif (!empty($address_info['zone_id'])) {
			$this->data['zone_id'] = $address_info['zone_id'];
		} elseif (!$this->modData['state_show_edit'] && $this->modData['def_state']) {
			$this->data['zone_id'] = $this->modData['def_state'];
		}  else {
			$this->data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		// Custom fields
		$this->load->model('account/xcustom_field');
		if($this->isOpencartTwo){
			$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->customer->getGroupId());
		}else{
			$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->customer->getCustomerGroupId());
		}

		if (isset($this->request->post['custom_field'])) {
			$this->data['address_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($address_info)) {
			$this->data['address_custom_field'] = $address_info['custom_field'];
		} else {
			$this->data['address_custom_field'] = array();
		}

		if (isset($this->request->post['default'])) {
			$this->data['default'] = $this->request->post['default'];
		} elseif (isset($this->request->get['address_id'])) {
			$this->data['default'] = $this->customer->getAddressId() == $this->request->get['address_id'];
		} else {
			$this->data['default'] = false;
		}
		$title='data-toggle="tooltip" data-placement="top" title ="%s"';
		if(!$this->isOpencartTwo){
			$this->data['entry_company_id'] = $this->language->get('entry_company_id');
			$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
			$this->data['title_company_id'] = $this->language->get('title_company_id');
			if (isset($this->error['company_id'])) {
				$this->data['error_company_id'] = $this->error['company_id'];
			} else {
				$this->data['error_company_id'] = '';
			}

			if (isset($this->error['tax_id'])) {
				$this->data['error_tax_id'] = $this->error['tax_id'];
			} else {
				$this->data['error_tax_id'] = '';
			}
			if (isset($this->request->post['company_id'])) {
				$this->data['company_id'] = $this->request->post['company_id'];
			} elseif (!empty($address_info)) {
				$this->data['company_id'] = $address_info['company_id'];
			} else {
				$this->data['company_id'] = '';
			}

			if (isset($this->request->post['tax_id'])) {
				$this->data['tax_id'] = $this->request->post['tax_id'];
			} elseif (!empty($address_info)) {
				$this->data['tax_id'] = $address_info['tax_id'];
			} else {
				$this->data['tax_id'] = '';
			}

			$this->load->model('account/customer_group');

			$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());

			if ($customer_group_info) {
				$this->data['company_id_display'] = $customer_group_info['company_id_display'];
			} else {
				$this->data['company_id_display'] = '';
			}

			if ($customer_group_info) {
				$this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
			} else {
				$this->data['tax_id_display'] = '';
			}
			$title='%s';			
		}	

		$this->language->load('account/xtensions');
		$this->data['title_firstname'] = ($this->language->get('title_firstname')?sprintf($title,$this->language->get('title_firstname')):'');
		$this->data['title_lastname'] = ($this->language->get('title_lastname')?sprintf($title,$this->language->get('title_lastname')):'');
		$this->data['title_company'] = ($this->language->get('title_company')?sprintf($title,$this->language->get('title_company')):'');
		$this->data['title_company_id'] = ($this->language->get('title_company_id')?sprintf($title,$this->language->get('title_company_id')):'');
		$this->data['title_address_1'] = ($this->language->get('title_address_1')?sprintf($title,$this->language->get('title_address_1')):'');
		$this->data['title_address_2'] = ($this->language->get('title_address_2')?sprintf($title,$this->language->get('title_address_2')):'');
		$this->data['title_postcode'] = ($this->language->get('title_postcode')?sprintf($title,$this->language->get('title_postcode')):'');
		$this->data['title_city'] = ($this->language->get('title_city')?sprintf($title,$this->language->get('title_city')):'');
		$this->data['back'] = $this->url->link('account/myaddress', '', 'SSL');

		$children = array('common/column_left', 'common/column_right', 'common/content_top','common/content_bottom', 'common/footer', 'common/header');
		$this->data += $this->xtensions->getChildren($children);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/myaddress_form.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/myaddress_form.tpl';
		} else {
			$this->template = 'default/template/account/xtensions/'.$this->xtensions->viewVersion().'/myaddress_form.tpl';
		}
		$this->response->setOutput($this->xtensions->renderView($this));
	}

	protected function validateForm() {
		$modData = $this->modData;

		if ($modData['f_name_req_edit'] && $modData['f_name_show_edit']  && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ($modData['l_name_req_edit'] && $modData['l_name_show_edit'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
		if ($modData['address1_req_edit'] && $modData['address1_show_edit'] && ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128))) {
			$this->error['address_1'] = $this->language->get('error_address_1');
		}

		if ($modData['city_req_edit'] && $modData['city_show_edit'] && ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128))) {
			$this->error['city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');

		if($modData['pin_req_edit'] && $modData['pin_show_edit'] && $modData['country_show_edit'])
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($modData['pin_req_edit'] && $modData['pin_show_edit'] && $modData['country_show_edit'] && $country_info) {
			if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
				$this->error['postcode'] = $this->language->get('error_postcode');
			}
		}

		if ($modData['country_req_edit'] && $modData['country_show_edit'] && $this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if ($modData['state_req_edit'] && $modData['state_show_edit'] && $modData['country_show_edit'] && (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '')) {
			$this->error['zone'] = $this->language->get('error_zone');
		}

		// Custom field validation
		$this->load->model('account/xcustom_field');

		if($this->xtensions->isOpencartTwo()){
			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->customer->getGroupId());
		}else{
			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->customer->getCustomerGroupId());
		}

		foreach ($custom_fields as $custom_field) {
			if($custom_field['location'] == 'address'){
				if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']]))) {
					$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
				}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
					$field =   $this->request->post['custom_field'][$custom_field['custom_field_id']];
					if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
						$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
					}
				}
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if ($this->model_account_address->getTotalAddresses() == 1) {
			$this->error['warning'] = $this->language->get('error_delete');
		}

		if ($this->customer->getAddressId() == $this->request->get['address_id']) {
			$this->error['warning'] = $this->language->get('error_default');
		}

		return !$this->error;
	}
}