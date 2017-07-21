<?php
class ControllerXCheckoutXLogin extends Controller {
	public $data='';
	public function index() {
		$this->language->load('checkout/checkout');
		$this->data['modData']=  $this->xtensions->getModData();
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->data['text_your_details'] = $this->language->get('text_your_details');
		$this->data['text_your_address'] = $this->language->get('text_your_address');
		$this->data['text_your_password'] = $this->language->get('text_your_password');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');

		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";
		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
		$this->language->load('account/xtensions');
		$this->data['text_login'] = $this->language->get('text_login');
		$this->data['title_firstname'] = $this->language->get('title_firstname');
		$this->data['title_lastname'] = $this->language->get('title_lastname');
		$this->data['title_email'] = $this->language->get('title_email');
		$this->data['title_telephone'] = $this->language->get('title_telephone');
		$this->data['title_fax'] = $this->language->get('title_fax');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['title_password'] = $this->language->get('title_password');
		$this->data['title_confirm'] = $this->language->get('title_confirm');
		$this->data['entry_confirm'] = $this->language->get('entry_confirm');
		$this->data['entry_newsletter'] = sprintf($this->language->get('entry_newsletter'), $this->config->get('config_name'));

		$this->data['text_new_customer'] = $this->language->get('text_new_customer');
		$this->data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$this->data['text_checkout'] = $this->language->get('text_checkout');
		$this->data['text_register'] = $this->language->get('text_register');
		$this->data['text_guest'] = $this->language->get('text_guest');
		$this->data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
		$this->data['text_register_account'] = $this->language->get('text_register_account');
		$this->data['text_forgotten'] = $this->language->get('text_forgotten');

		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_password'] = $this->language->get('entry_password');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['text_loading'] = $this->language->get('text_loading');
		$this->data['button_login'] = $this->language->get('button_login');
		if($isOpencartTwo){
			$this->data['checkout_guest'] = ($this->config->get('config_checkout_guest') && !$this->config->get('config_customer_price') && !$this->cart->hasDownload());
		}else{
			$this->data['checkout_guest'] = ($this->config->get('config_guest_checkout') && !$this->config->get('config_customer_price') && !$this->cart->hasDownload());
		}
		if (isset($this->session->data['account'])) {
			$this->data['account'] = $this->session->data['account'];
		} else {
			$this->data['account'] = 'login';
		}
		if (isset($this->session->data['guest']['firstname'])) {
			$this->data['firstname'] = $this->session->data['guest']['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->session->data['guest']['lastname'])) {
			$this->data['lastname'] = $this->session->data['guest']['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->session->data['guest']['email'])) {
			$this->data['email'] = $this->session->data['guest']['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->session->data['guest']['telephone'])) {
			$this->data['telephone'] = $this->session->data['guest']['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->session->data['guest']['fax'])) {
			$this->data['fax'] = $this->session->data['guest']['fax'];
		} else {
			$this->data['fax'] = '';
		}

		$this->data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups  as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$this->data['customer_groups'][] = $customer_group;
				}
			}
		}

		$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				if($isOpencartTwo){
					$this->data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
				}else{
					$this->data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/info', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
					$this->data['text_agree'] = str_replace('colorbox','agree',$this->data['text_agree']);
				}
			} else {
				$this->data['text_agree'] = '';
			}
		} else {
			$this->data['text_agree'] = '';
		}
		$this->load->model('account/xcustom_field');

		$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields();

		if (isset($this->session->data['guest']['custom_field'])) {
			$this->data['guest_custom_field'] = $this->session->data['guest']['custom_field'];
		} else {
			$this->data['guest_custom_field'] = array();
		}
		$this->data['captcha'] = '';
		if($this->xtensions->isNewCustomerPath()){
			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
				$this->data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
			}
		}

		$this->data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
		$children = array('xcheckout/xcvc/xoptions', 'xcheckout/xcvc/xtotals');
		$this->data += $this->xtensions->getChildren($children);
		$this->template = 'xtensions/template/checkout/xlogin.tpl';
		$this->response->setOutput($this->xtensions->renderView($this));
	}

	public function validate() {
		$this->language->load('checkout/checkout');
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$isNewCustomerModel = $this->xtensions->isNewCustomerPath();

		$json = array();
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		$this->load->model('account/customer');
		$modData = $this->xtensions->getModData();
		if($this->request->post['account']=='login'){
			$this->session->data['account'] = 'login';
			if (!$json) {
				if ($isOpencartTwo && method_exists($this->model_account_customer, 'getLoginAttempts')){
					// Check how many login attempts have been made.
					$login_info = $this->model_account_customer->getLoginAttempts($this->request->post['lemail']);

					if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
						$json['error']['warning'] = $this->language->get('error_attempts');
					}
				}else if(!$isOpencartTwo){
					if (!$this->customer->login($this->request->post['lemail'], $this->request->post['lpassword'])) {
						$json['error']['warning'] = $this->language->get('error_login');
					}
				}
				$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['lemail']);

				if ($customer_info && !$customer_info['approved']) {
					$json['error']['warning'] = $this->language->get('error_approved');
				}
				if ($isOpencartTwo && !isset($json['error'])) {
					if (!$this->customer->login($this->request->post['lemail'], $this->request->post['lpassword'])) {
						$json['error']['warning'] = $this->language->get('error_login');
						if (method_exists($this->model_account_customer, 'addLoginAttempt')){
							$this->model_account_customer->addLoginAttempt($this->request->post['lemail']);
						}
					} else {
						if (method_exists($this->model_account_customer, 'deleteLoginAttempts')){
							$this->model_account_customer->deleteLoginAttempts($this->request->post['lemail']);
						}
					}
				}
			}

			if (!$json) {
				if($isNewCustomerModel){
					// Trigger customer pre login event
					$this->event->trigger('pre.customer.login');
				}
				unset($this->session->data['guest']);
				unset($this->session->data['payment_address']);
				unset($this->session->data['shipping_address']);
				unset($this->session->data['agree']);
				// Default Addresses
				$this->load->model('account/address');

				$address_info = $this->xtensions->getAddress($this,$this->customer->getAddressId());
				if ($address_info) {
					if ($this->config->get('config_tax_customer') == 'shipping') {
						$this->session->data['shipping_country_id'] = $address_info['country_id'];
						$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
						$this->session->data['shipping_postcode'] = $address_info['postcode'];
						$this->session->data['shipping_address'] = $this->xtensions->getAddress($this,$this->customer->getAddressId());
					}

					if ($this->config->get('config_tax_customer') == 'payment') {
						$this->session->data['payment_country_id'] = $address_info['country_id'];
						$this->session->data['payment_zone_id'] = $address_info['zone_id'];
						$this->session->data['payment_address'] = $this->xtensions->getAddress($this,$this->customer->getAddressId());
					}
				} else {
					unset($this->session->data['shipping_country_id']);
					unset($this->session->data['shipping_zone_id']);
					unset($this->session->data['shipping_postcode']);
					unset($this->session->data['payment_country_id']);
					unset($this->session->data['payment_zone_id']);
					unset($this->session->data['payment_address']);
					unset($this->session->data['shipping_address']);
				}

				if($isOpencartTwo){
					// Add to activity log
					$this->load->model('account/activity');

					$activity_data = array(
						'customer_id' => $this->customer->getId(),
						'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
					);

					$this->model_account_activity->addActivity('login', $activity_data);
					if($isNewCustomerModel){
						// Wishlist
						if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
							$this->load->model('account/wishlist');

							foreach ($this->session->data['wishlist'] as $key => $product_id) {
								$this->model_account_wishlist->addWishlist($product_id);

								unset($this->session->data['wishlist'][$key]);
							}
						}
						// Trigger customer post login event
						$this->event->trigger('post.customer.login');
					}
				}

				$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
			}
		}elseif($this->request->post['account']!='login'){
			if (!$json && $this->request->post['account']=='register') {
				// Customer Group
				$this->load->model('account/customer_group');

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
						if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']]))) {
							$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
						}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
							$field =   $this->request->post['custom_field'][$custom_field['custom_field_id']];
							if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
								$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
							}
						}
					}
				}
				if ($modData['f_name_req'] && $modData['f_name_show'] && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
					$json['error']['firstname'] = $this->language->get('error_firstname');
				}

				if ($modData['l_name_req'] && $modData['l_name_show'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
					$json['error']['lastname'] = $this->language->get('error_lastname');
				}

				if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
					$json['error']['email'] = $this->language->get('error_email');
				}

				if ($modData['mob_req'] && $modData['mob_show'] && ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32))) {
					$json['error']['telephone'] = $this->language->get('error_telephone');
				}
				if( $this->request->post['account']=='register'){
					if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
						$json['error']['warningexists'] = $this->language->get('error_exists');
					}
					if(utf8_strlen($this->request->post['password']) < 4 || utf8_strlen($this->request->post['password']) > 20){
						$json['error']['password'] = $this->language->get('error_password');
					}

					if ($modData['passconf_show'] && $this->request->post['confirm'] != $this->request->post['password']) {
						$json['error']['confirm'] = $this->language->get('error_confirm');
					}
					if($isNewCustomerModel){
						// Captcha
						if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
							$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

							if ($captcha) {
								$json['error']['captcha'] = $captcha;
							}
						}
					}
					if ($this->config->get('config_account_id')) {
						$this->load->model('catalog/information');

						$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

						if ($information_info && !isset($this->request->post['agree'])) {
							$json['error']['warningagree'] = sprintf($this->language->get('error_agree'), $information_info['title']);
						}
					}
				}
				if(!$json){
					unset($this->session->data['guest']);
					unset($this->session->data['payment_address']);
					unset($this->session->data['shipping_address']);
					unset($this->session->data['agree']);
					$customer_id= $this->model_account_customer->addCustomer($this->xtensions->getRegisterPostData($this->request->post,'c'));
					// Clear any previous login attempts for unregistered accounts.
					if ($isOpencartTwo && method_exists($this->model_account_customer, 'deleteLoginAttempts')){
						$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
					}

					$this->session->data['account'] = 'register';
					$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
					if ($customer_group && !$customer_group['approval']) {
						$this->customer->login($this->request->post['email'], $this->request->post['password']);
						$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
					} else {
						$json['redirect'] = $this->url->link('account/success');
					}
					if($isOpencartTwo){
						// Add to activity log
						$this->load->model('account/activity');

						if($modData['f_name_show'] || $modData['l_name_show']){
							$name = (isset($this->request->post['firstname'])?$this->request->post['firstname'].' ':''). '' . (isset($this->request->post['lastname'])?$this->request->post['lastname']:'');
						}else{
							$name = $this->request->post['email'];
						}
						$activity_data = array(
							'customer_id' => $this->customer->getId(),
							'name'        => $name
						);

						$this->model_account_activity->addActivity('register', $activity_data);
					}
				}
			}
			if(!$json && $this->request->post['account']=='guest'){
				$this->load->model('account/customer_group');

				if (isset($this->request->post['gcustomer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['gcustomer_group_id'], $this->config->get('config_customer_group_display'))) {
					$customer_group_id = $this->request->post['gcustomer_group_id'];
				} else {
					$customer_group_id = $this->config->get('config_customer_group_id');
				}
				$this->load->model('account/xcustom_field');

				$custom_fields = $this->model_account_xcustom_field->getCustomFields($customer_group_id);

				foreach ($custom_fields as $custom_field) {
					if($custom_field['location'] == 'account'){
						if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['gcustom_field'][$custom_field['custom_field_id']]))) {
							$json['gerror']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
						}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
							$field =   $this->request->post['gcustom_field'][$custom_field['custom_field_id']];
							if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
								$json['gerror']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
							}
						}
					}
				}
				if ($modData['f_name_req_checkout'] && $modData['f_name_show_checkout'] && ((utf8_strlen($this->request->post['gfirstname']) < 1) || (utf8_strlen($this->request->post['gfirstname']) > 32))) {
					$json['error']['gfirstname'] = $this->language->get('error_firstname');
				}

				if ($modData['l_name_req_checkout'] && $modData['l_name_show_checkout'] && ((utf8_strlen($this->request->post['glastname']) < 1) || (utf8_strlen($this->request->post['glastname']) > 32))) {
					$json['error']['glastname'] = $this->language->get('error_lastname');
				}

				if ((utf8_strlen($this->request->post['gemail']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['gemail'])) {
					$json['error']['gemail'] = $this->language->get('error_email');
				}

				if ($modData['mob_req_checkout'] && $modData['mob_show_checkout'] && ((utf8_strlen($this->request->post['gtelephone']) < 3) || (utf8_strlen($this->request->post['gtelephone']) > 32))) {
					$json['error']['gtelephone'] = $this->language->get('error_telephone');
				}

				if($isNewCustomerModel){
					// Captcha
					if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
						$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

						if ($captcha) {
							$json['error']['gcaptcha'] = $captcha;
						}
					}
				}
				if(!$json){
					$this->session->data['guest']['customer_group_id'] = $customer_group_id;
					$this->session->data['guest']['firstname'] = (isset($this->request->post['gfirstname'])?$this->request->post['gfirstname']:'');
					$this->session->data['guest']['lastname'] = (isset($this->request->post['glastname'])?$this->request->post['glastname']:'');
					$this->session->data['guest']['email'] = $this->request->post['gemail'];
					$this->session->data['guest']['telephone'] = (isset($this->request->post['gtelephone'])?$this->request->post['gtelephone']:'');
					$this->session->data['guest']['fax'] = (isset($this->request->post['gfax'])?$this->request->post['gfax']:'');
					if (isset($this->request->post['gcustom_field'])) {
						$this->session->data['guest']['custom_field'] = $this->request->post['gcustom_field'];
					} else {
						$this->session->data['guest']['custom_field'] = array();
					}
					$this->session->data['account'] = 'guest';
					$child = $this->xtensions->getChildren(array('xcheckout/xguest/matter'));
					$json['next'] = $child['matter'];
					$json['guest'] = '1';
				}}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>