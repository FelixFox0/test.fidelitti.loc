<?php
class ControllerAccountSignup extends Controller {
	private $error = array();
	public $data = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->xtensions->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$this->load->language('account/register');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('account/customer');
		$this->data =  $this->xtensions->getData();
		$modData = $this->data['modData'];
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate($modData)) {
			$customer_id = $this->model_account_customer->addCustomer($this->xtensions->getRegisterPostData($this->request->post));
			$this->customer->login($this->request->post['email'], $this->request->post['password']);

			unset($this->session->data['guest']);
			if($isOpencartTwo){
				// Clear any previous login attempts for unregistered accounts.
				if (method_exists($this->model_account_customer, 'deleteLoginAttempts')){
					$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
				}
				// Add to activity log
				$this->load->model('account/activity');
				if($modData['f_name_show'] || $modData['l_name_show']){
					$name = (isset($this->request->post['firstname'])?$this->request->post['firstname'].' ':''). '' . (isset($this->request->post['lastname'])?$this->request->post['lastname']:'');
				}else{
					$name = $this->request->post['email'];
				}
				$activity_data = array('customer_id' => $customer_id,'name'=> $name);
				$this->model_account_activity->addActivity('register', $activity_data);
			}else{
				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_country_id'] = isset($this->request->post['country_id'])?$this->request->post['country_id']:"";
					$this->session->data['shipping_zone_id'] = isset($this->request->post['zone_id'])?$this->request->post['zone_id']:"";
					$this->session->data['shipping_postcode'] = isset($this->request->post['postcode'])?$this->request->post['postcode']:"";
				}
				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_country_id'] = isset($this->request->post['country_id'])?$this->request->post['country_id']:"";
					$this->session->data['payment_zone_id'] = isset($this->request->post['zone_id'])?$this->request->post['zone_id']:"";
				}
			}

			$this->xtensions->redirect($this->url->link('account/success'));
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('account/register', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', 'SSL'));
		$this->data['text_your_details'] = $this->language->get('text_your_details');
		$this->data['text_your_address'] = $this->language->get('text_your_address');
		$this->data['text_your_password'] = $this->language->get('text_your_password');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_loading'] = $this->language->get('text_loading');

		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$this->data['entry_password'] = $this->language->get('entry_password');
		$this->data['entry_confirm'] = $this->language->get('entry_confirm');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_upload'] = $this->language->get('button_upload');

		if(!$isOpencartTwo){
			$title='%s';
			$this->document->setTitle($this->language->get('heading_title'));
			$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');

			$this->data['entry_company_id'] = $this->language->get('entry_company_id');
			$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');

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
			// Company ID
			if (isset($this->request->post['company_id'])) {
				$this->data['company_id'] = $this->request->post['company_id'];
			} else {
				$this->data['company_id'] = '';
			}

			// Tax ID
			if (isset($this->request->post['tax_id'])) {
				$this->data['tax_id'] = $this->request->post['tax_id'];
			} else {
				$this->data['tax_id'] = '';
			}
		}else{
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
			$title='data-toggle="tooltip" data-placement="top" title ="%s"';
		}

		$this->language->load('account/xtensions');
		$this->data['title_firstname'] = ($this->language->get('title_firstname')?sprintf($title,$this->language->get('title_firstname')):'');
		$this->data['title_lastname'] = ($this->language->get('title_lastname')?sprintf($title,$this->language->get('title_lastname')):'');
		$this->data['title_email'] = ($this->language->get('title_email')?sprintf($title,$this->language->get('title_email')):'');
		$this->data['title_telephone'] = ($this->language->get('title_telephone')?sprintf($title,$this->language->get('title_telephone')):'');
		$this->data['title_fax'] = ($this->language->get('title_fax')?sprintf($title,$this->language->get('title_fax')):'');
		$this->data['title_company'] = ($this->language->get('title_company')?sprintf($title,$this->language->get('title_company')):'');
		$this->data['title_company_id'] = ($this->language->get('title_company_id')?sprintf($title,$this->language->get('title_company_id')):'');
		$this->data['title_address_1'] = ($this->language->get('title_address_1')?sprintf($title,$this->language->get('title_address_1')):'');
		$this->data['title_address_2'] = ($this->language->get('title_address_2')?sprintf($title,$this->language->get('title_address_2')):'');
		$this->data['title_postcode'] = ($this->language->get('title_postcode')?sprintf($title,$this->language->get('title_postcode')):'');
		$this->data['title_city'] = ($this->language->get('title_city')?sprintf($title,$this->language->get('title_city')):'');
		$this->data['title_password'] = ($this->language->get('title_password')?sprintf($title,$this->language->get('title_password')):'');
		$this->data['title_confirm'] = ($this->language->get('title_confirm')?sprintf($title,$this->language->get('title_confirm')):'');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

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

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
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

		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}

		$this->data['action'] = $this->url->link('account/signup', '', 'SSL');

		$this->data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$this->data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->request->post['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$this->data['fax'] = $this->request->post['fax'];
		} else {
			$this->data['fax'] = '';
		}

		if (isset($this->request->post['company'])) {
			$this->data['company'] = $this->request->post['company'];
		} else {
			$this->data['company'] = '';
		}

		if (isset($this->request->post['address_1'])) {
			$this->data['address_1'] = $this->request->post['address_1'];
		} else {
			$this->data['address_1'] = '';
		}

		if (isset($this->request->post['address_2'])) {
			$this->data['address_2'] = $this->request->post['address_2'];
		} else {
			$this->data['address_2'] = '';
		}

		if (isset($this->request->post['postcode'])) {
			$this->data['postcode'] = $this->request->post['postcode'];
		} elseif (isset($this->session->data['shipping_address']['postcode'])) {
			$this->data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$this->data['postcode'] = '';
		}

		if (isset($this->request->post['city'])) {
			$this->data['city'] = $this->request->post['city'];
		} else {
			$this->data['city'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$this->data['country_id'] = $this->request->post['country_id'];
		} elseif (!$modData['country_show'] && $modData['def_country']) {
			$this->data['country_id'] = $modData['def_country'];
		} elseif (isset($this->session->data['shipping_country_id'])) {
			$this->data['country_id'] = $this->session->data['shipping_country_id'];
		} else {
			$this->data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$this->data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!$modData['state_show'] && $modData['def_state']) {
			$this->data['zone_id'] = $modData['def_state'];
		} elseif (isset($this->session->data['shipping_zone_id'])) {
			$this->data['zone_id'] = $this->session->data['shipping_zone_id'];
		} else {
			$this->data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/xcustom_field');

		$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields();

		if (isset($this->request->post['custom_field'])) {
			if (isset($this->request->post['custom_field']['account'])) {
				$account_custom_field = $this->request->post['custom_field']['account'];
			} else {
				$account_custom_field = array();
			}

			if (isset($this->request->post['custom_field']['address'])) {
				$address_custom_field = $this->request->post['custom_field']['address'];
			} else {
				$address_custom_field = array();
			}

			$this->data['register_custom_field'] = $account_custom_field + $address_custom_field;
		} else {
			$this->data['register_custom_field'] = array();
		}

		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$this->data['confirm'] = $this->request->post['confirm'];
		} else {
			$this->data['confirm'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$this->data['newsletter'] = $this->request->post['newsletter'];
		} else {
			$this->data['newsletter'] = 1;
		}
		$this->data['captcha'] = '';
		if($this->xtensions->isNewCustomerPath()){
			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
				$this->data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
			}
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$this->data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/'.($isOpencartTwo?'agree':'info'), 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} else {
				$this->data['text_agree'] = '';
			}
		} else {
			$this->data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$this->data['agree'] = $this->request->post['agree'];
		} else {
			$this->data['agree'] = false;
		}
		$children = array('common/column_left', 'common/column_right', 'common/content_top','common/content_bottom', 'common/footer', 'common/header');
		$this->data += $this->xtensions->getChildren($children);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/signup.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/signup.tpl';
		} else {
			$this->template = 'default/template/account/xtensions/'.$this->xtensions->viewVersion().'/signup.tpl';
		}

		$this->response->setOutput($this->xtensions->renderView($this));
	}

	public function validate($modData) {
		if ($modData['f_name_req'] && $modData['f_name_show']  && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ($modData['l_name_req'] && $modData['l_name_show'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ($modData['mob_req'] && $modData['mob_show'] && ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32))) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if (!$modData['show_address'] && $modData['address1_req'] && $modData['address1_show'] && ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128))) {
			$this->error['address_1'] = $this->language->get('error_address_1');
		}

		if (!$modData['show_address'] && $modData['city_req'] && $modData['city_show'] && ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128))) {
			$this->error['city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');
		if(!$modData['show_address'] && $modData['pin_req'] && $modData['pin_show'] )
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if (((!$modData['show_address'] && $modData['pin_req'] && $modData['pin_show'] )) && $country_info) {
			if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
				$this->error['postcode'] = $this->language->get('error_postcode');
			}
		}

		if (!$modData['show_address'] && $modData['country_req'] && $modData['country_show'] && $this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (((!$modData['show_address'] && $modData['state_req'] && $modData['state_show'] )) && (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '')) {
			$this->error['zone'] = $this->language->get('error_zone');
		}

		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/xcustom_field');

		$custom_fields = $this->model_account_xcustom_field->getCustomFields($customer_group_id);
		foreach ($custom_fields as $custom_field) {
			if($custom_field['location'] == 'account'){
				if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']]))) {
					$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
				}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
					$field =  $this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']];
					if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
						$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
					}
				}
			}
		}
		if(!$modData['show_address'] ){
			foreach ($custom_fields as $custom_field) {
				if($custom_field['location'] == 'address'){
					if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']]))) {
						$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
					}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
						$field =  $this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']];
						if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
							$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
						}
					}
				}
			}
		}

		if(utf8_strlen($this->request->post['password']) < 4 || utf8_strlen($this->request->post['password']) > 20){
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($modData['passconf_show'] && $this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		if($this->xtensions->isNewCustomerPath()){
			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$this->error['captcha'] = $captcha;
				}
			}
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		return !$this->error;
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/xcustom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_xcustom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}