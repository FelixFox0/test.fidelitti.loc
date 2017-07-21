<?php
class ControllerXCheckoutXGuest extends Controller {
	public $data=array();
	public function index() {
		$this->response->setOutput($this->matter());
	}

	public function matter() {
		$this->language->load('checkout/checkout');

		$modData = $this->xtensions->getModData();
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->data['modData']= $modData;
		$this->data['isOpencartTwo']= $isOpencartTwo;
		$this->load->model('account/xcustom_field');
		$this->session->data['customer']['custom_field'] = $this->model_account_xcustom_field->getCustomFieldByIdentifier($this->session->data['guest']['custom_field'],'account',$this->session->data['guest']['customer_group_id']);

		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_address_new'] = $this->language->get('text_address_new');
		$this->data['text_your_details'] = $this->language->get('text_your_details');
		$this->data['text_your_account'] = $this->language->get('text_your_account');
		$this->data['text_your_address'] = $this->language->get('text_your_address');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_shipping'] = $this->language->get('entry_shipping');

		$this->language->load('account/xtensions');
		$this->data['title_firstname'] = $this->language->get('title_firstname');
		$this->data['title_lastname'] = $this->language->get('title_lastname');
		$this->data['title_email'] = $this->language->get('title_email');
		$this->data['title_telephone'] = $this->language->get('title_telephone');
		$this->data['title_fax'] = $this->language->get('title_fax');
		$this->data['title_company'] = $this->language->get('title_company');
		$this->data['title_address_1'] = $this->language->get('title_address_1');
		$this->data['title_address_2'] = $this->language->get('title_address_2');
		$this->data['title_postcode'] = $this->language->get('title_postcode');
		$this->data['title_city'] = $this->language->get('title_city');
		$this->data['text_paddress'] = $this->language->get('text_paddress');
		$this->data['text_saddress'] = $this->language->get('text_saddress');
		$this->data['text_psaddress'] = $this->language->get('text_psaddress');
		$this->data['text_add_paddress'] = $this->language->get('text_add_paddress');
		$this->data['text_add_saddress'] = $this->language->get('text_add_saddress');
		$this->data['text_edit_address'] = $this->language->get('text_edit_address');
			
		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['text_loading'] = $this->language->get('text_loading');
		if($isOpencartTwo && isset($this->session->data['payment_address'])){
			$payment_address = $this->session->data['payment_address'];
		}else if(!$isOpencartTwo && isset($this->session->data['guest']) && isset($this->session->data['guest']['payment'])){
			$payment_address = $this->session->data['guest']['payment'];
		}else{
			$payment_address = array();
		}
		$this->data['payment_address'] ='';
		$this->data['shipping_address1'] ='';
		if(isset($payment_address['formatted_address'])){
			$this->data['payment_address'] = $payment_address['formatted_address'];
		}
		if($isOpencartTwo && isset($this->session->data['shipping_address'])){
			$shipping_address = $this->session->data['shipping_address'];
		}else if(!$isOpencartTwo && isset($this->session->data['guest']) && isset($this->session->data['guest']['shipping'])){
			$shipping_address = $this->session->data['guest']['shipping'];
		}else{
			$shipping_address = array();
		}

		if(isset($shipping_address['formatted_address'])){
			$this->data['shipping_address1'] = $shipping_address['formatted_address'];
		}

		if (isset($payment_address['custom_field'])) {
			$this->data['guest_custom_field'] = $payment_address['custom_field'];
		} else {
			$this->data['guest_custom_field'] = array();
		}
		if (isset($shipping_address['custom_field'])) {
			$this->data['guest_shipping_custom_field'] = $shipping_address['custom_field'];
		} else {
			$this->data['guest_shipping_custom_field'] = array();
		}


		if (isset($payment_address['firstname'])) {
			$this->data['firstname'] =  $payment_address['firstname'];
		}else if (isset($this->session->data['guest']['firstname'])) {
			$this->data['firstname'] = $this->session->data['guest']['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($payment_address['lastname'])) {
			$this->data['lastname'] =  $payment_address['lastname'];
		}else if (isset($this->session->data['guest']['lastname'])) {
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

		if (isset($payment_address['company'])) {
			$this->data['company'] = $payment_address['company'];
		} else {
			$this->data['company'] = '';
		}

		if (isset($this->session->data['guest']['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		$this->load->model('account/customer_group');
		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->data['customer_group_id']);
			

		if (isset($payment_address['address_1'])) {
			$this->data['address_1'] = $payment_address['address_1'];
		} else {
			$this->data['address_1'] = '';
		}

		if (isset($payment_address['address_2'])) {
			$this->data['address_2'] = $payment_address['address_2'];
		} else {
			$this->data['address_2'] = '';
		}

		if (isset($payment_address['postcode'])) {
			$this->data['postcode'] = $payment_address['postcode'];
		} elseif (isset($this->session->data['shipping_postcode'])) {
			$this->data['postcode'] = $this->session->data['shipping_postcode'];
		} else {
			$this->data['postcode'] = '';
		}

		if (isset($payment_address['city'])) {
			$this->data['city'] = $payment_address['city'];
		} else {
			$this->data['city'] = '';
		}

		if (!$modData['country_show_checkout'] && $modData['def_country']) {
			$this->data['country_id'] = $modData['def_country'];
		} elseif (isset($payment_address['country_id'])) {
			$this->data['country_id'] = $payment_address['country_id'];
		} elseif (isset($this->session->data['shipping_country_id'])) {
			$this->data['country_id'] = $this->session->data['shipping_country_id'];
		} else {
			$this->data['country_id'] = $this->config->get('config_country_id');
		}

		if (!$modData['state_show_checkout'] && $modData['def_state']) {
			$this->data['zone_id'] = $modData['def_state'];
		} elseif (isset($payment_address['zone_id'])) {
			$this->data['zone_id'] = $payment_address['zone_id'];
		} elseif (isset($this->session->data['shipping_zone_id'])) {
			$this->data['zone_id'] = $this->session->data['shipping_zone_id'];
		} else {
			$this->data['zone_id'] = '';
		}
		if (isset($shipping_address['firstname'])) {
			$this->data['sfirstname'] = $shipping_address['firstname'];
		} else if (isset( $payment_address['firstname'])) {
			$this->data['sfirstname'] =  $payment_address['firstname'];
		}else if (isset($this->session->data['guest']['firstname'])) {
			$this->data['sfirstname'] = $this->session->data['guest']['firstname'];
		}else {
			$this->data['sfirstname'] = '';
		}

		if (isset($shipping_address['lastname'])) {
			$this->data['slastname'] = $shipping_address['lastname'];
		} else if (isset( $payment_address['lastname'])) {
			$this->data['slastname'] =  $payment_address['lastname'];
		}else if (isset($this->session->data['guest']['lastname'])) {
			$this->data['slastname'] = $this->session->data['guest']['lastname'];
		}else{
			$this->data['slastname'] = '';
		}

		if (isset($shipping_address['company'])) {
			$this->data['scompany'] = $shipping_address['company'];
		} else {
			$this->data['scompany'] = '';
		}

		if (isset($shipping_address['address_1'])) {
			$this->data['saddress_1'] = $shipping_address['address_1'];
		} else {
			$this->data['saddress_1'] = '';
		}

		if (isset($shipping_address['address_2'])) {
			$this->data['saddress_2'] = $shipping_address['address_2'];
		} else {
			$this->data['saddress_2'] = '';
		}

		if (isset($shipping_address['postcode'])) {
			$this->data['spostcode'] = $shipping_address['postcode'];
		} elseif (isset($this->session->data['shipping_postcode'])) {
			$this->data['spostcode'] = $this->session->data['shipping_postcode'];
		} else {
			$this->data['spostcode'] = '';
		}

		if (isset($shipping_address['city'])) {
			$this->data['scity'] = $shipping_address['city'];
		} else {
			$this->data['scity'] = '';
		}

		if (isset($shipping_address['country_id'])) {
			$this->data['scountry_id'] = $shipping_address['country_id'];
		} elseif (isset($this->session->data['shipping_country_id'])) {
			$this->data['scountry_id'] = $this->session->data['shipping_country_id'];
		} else {
			$this->data['scountry_id'] = $this->config->get('config_country_id');
		}

		if (isset($shipping_address['zone_id'])) {
			$this->data['szone_id'] = $shipping_address['zone_id'];
		} elseif (isset($this->session->data['shipping_zone_id'])) {
			$this->data['szone_id'] = $this->session->data['shipping_zone_id'];
		} else {
			$this->data['szone_id'] = '';
		}
		if(!$isOpencartTwo){
			$this->data['entry_company_id'] = $this->language->get('entry_company_id');
			$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
			$this->data['title_company_id'] = $this->language->get('title_company_id');
			if ($customer_group_info) {
				$this->data['company_id_display'] = $customer_group_info['company_id_display'];
			} else {
				$this->data['company_id_display'] = '';
			}

			if ($customer_group_info) {
				$this->data['company_id_required'] = $customer_group_info['company_id_required'];
			} else {
				$this->data['company_id_required'] = '';
			}

			if ($customer_group_info) {
				$this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
			} else {
				$this->data['tax_id_display'] = '';
			}

			if ($customer_group_info) {
				$this->data['tax_id_required'] = $customer_group_info['tax_id_required'];
			} else {
				$this->data['tax_id_required'] = '';
			}

			// Company ID
			if (isset($this->session->data['guest']['payment']['company_id'])) {
				$this->data['company_id'] = $this->session->data['guest']['payment']['company_id'];
			} else {
				$this->data['company_id'] = '';
			}

			// Tax ID
			if (isset($this->session->data['guest']['payment']['tax_id'])) {
				$this->data['tax_id'] = $this->session->data['guest']['payment']['tax_id'];
			} else {
				$this->data['tax_id'] = '';
			}
		}
		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->session->data['guest']['customer_group_id']);

		$this->data['shipping_required'] = $this->cart->hasShipping();
		if(isset($this->session->data['shipping_same_guest'])){
			$this->data['shipping_same'] = $this->session->data['shipping_same_guest'];
		}else{
			$this->data['shipping_same'] =  false;
		}

		if (isset($this->session->data['guest']['shipping_address'])) {
			$this->data['shipping_address'] = $this->session->data['guest']['shipping_address'];
		} else {
			$this->data['shipping_address'] = true;
		}

		if ($this->config->get('config_checkout_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_checkout_id'));

			if ($information_info) {
				$agree_text = '<a class="agree" href="%s" alt="%s"><b>%s</b></a>';
				if($isOpencartTwo){
					$this->data['text_agree'] = sprintf($agree_text, $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_checkout_id'), 'SSL'), $information_info['title'], $information_info['title']);
				}else{
					$this->data['text_agree'] = sprintf($agree_text, $this->url->link('information/information/info', 'information_id=' . $this->config->get('config_checkout_id'), 'SSL'), $information_info['title'], $information_info['title']);
				}
				$this->data['info_title'] = $information_info['title'];
				$this->data['agree_content'] = sprintf($this->language->get('agree_content'),$information_info['title']);
			} else {
				$this->data['text_agree'] = '';
				$this->data['info_title'] = '';
				$this->data['agree_content'] = '';
			}
		} else {
			$this->data['text_agree'] = '';
			$this->data['info_title'] = '';
			$this->data['agree_content'] = '';
		}

		if (isset($this->session->data['agree'])) {
			$this->data['agree'] = $this->session->data['agree'];
		} else {
			$this->data['agree'] = '';
		}
		$this->data['text_payment_continue'] = $this->language->get('text_payment_continue');

		$hasShipping = $this->cart->hasShipping();
		$children = array('xcheckout/xcvc/xoptions');
		if($hasShipping && $shipping_address){
			array_push($children,'xcheckout/xshipping_method');
		}else{
			$this->data['xshipping_method']  = '';
		}
		$this->data['shipping_error'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		array_push($children,'xcheckout/xcvc/xtotals');
		if(count($payment_address)){
			if(!$hasShipping || count($shipping_address)){
				$this->data['payment_next'] = true;
			}else{
				$this->data['payment_next'] = '';
			}
		}else{
			$this->data['payment_next'] = '';
		}

		$this->data += $this->xtensions->getChildren($children);
		$this->template = 'xtensions/template/checkout/xguest.tpl';
		return $this->xtensions->renderView($this);
	}

	public function addPAddress(){
		$this->language->load('checkout/checkout');
		$modData = $this->xtensions->getModData();
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$json = array();
		$shipping_same = false;
		$this->session->data['shipping_same_guest'] = false;
		$hasShipping = $this->cart->hasShipping();
		if(isset($this->request->post['xshipping_address_check']) && !empty($this->request->post['xshipping_address_check'])){
			$shipping_same = true;
			$this->session->data['shipping_same_guest'] = true;
		}
		// Validate if customer is logged in.
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Check if guest checkout is avaliable.
		if ($this->config->get('config_customer_price') || $this->cart->hasDownload()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}
		if (!$json) {
			if ($modData['f_name_req_checkout'] && $modData['f_name_show_checkout']  && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
				$json['error']['firstname'] = $this->language->get('error_firstname');
			}

			if ($modData['l_name_req_checkout'] && $modData['l_name_show_checkout'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
				$json['error']['lastname'] = $this->language->get('error_lastname');
			}

			// Customer Group
			$this->load->model('account/customer_group');

			if (isset($this->session->data['guest']['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->session->data['guest']['customer_group_id'], $this->config->get('config_customer_group_display'))) {
				$customer_group_id = $this->session->data['guest']['customer_group_id'];
			} else {
				$customer_group_id = $this->config->get('config_customer_group_id');
			}

			$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

			if (!$isOpencartTwo && $customer_group) {
				// Company ID
				if ($customer_group['company_id_display'] && $customer_group['company_id_required'] && empty($this->request->post['company_id'])) {
					$json['error']['company_id'] = $this->language->get('error_company_id');
				}

				// Tax ID
				if ($customer_group['tax_id_display'] && $customer_group['tax_id_required'] && empty($this->request->post['tax_id'])) {
					$json['error']['tax_id'] = $this->language->get('error_tax_id');
				}
			}

			if ($modData['address1_req_checkout'] && $modData['address1_show_checkout'] && ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128))) {
				$json['error']['address_1'] = $this->language->get('error_address_1');
			}

			if ($modData['city_req_checkout'] && $modData['city_show_checkout'] && ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128))) {
				$json['error']['city'] = $this->language->get('error_city');
			}

			$this->load->model('localisation/country');

			if($modData['pin_req_checkout'] && $modData['pin_show_checkout'])
			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

			if ($modData['pin_req_checkout'] && $modData['pin_show_checkout'] && $country_info) {
				if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
					$json['error']['postcode'] = $this->language->get('error_postcode');
				}

				// VAT Validation
				$this->load->helper('vat');

				if ($this->config->get('config_vat') && $this->request->post['tax_id'] && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
					$json['error']['tax_id'] = $this->language->get('error_vat');
				}
			}

			if ($modData['country_req_checkout'] && $modData['country_show_checkout'] && $this->request->post['country_id'] == '') {
				$json['error']['country'] = $this->language->get('error_country');
			}

			if ($modData['state_req_checkout'] && $modData['state_show_checkout'] && (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '')) {
				$json['error']['zone'] = $this->language->get('error_zone');
			}
			$this->load->model('account/xcustom_field');

			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->session->data['guest']['customer_group_id']);

			foreach ($custom_fields as $custom_field) {
				if($custom_field['location'] == 'address'){
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
		}
			
		if (!$json) {
			$payment_address['firstname'] = $this->request->post['firstname'];
			$payment_address['lastname'] = $this->request->post['lastname'];
			$payment_address['company'] = $this->request->post['company'];
			if(!$isOpencartTwo){
				if($customer_group['company_id_display']){
					$payment_address['company_id'] = $this->request->post['company_id'];
				}else{
					$payment_address['company_id'] = '';
				}
				if($customer_group['tax_id_display']){
					$payment_address['tax_id'] = $this->request->post['tax_id'];
				}else{
					$payment_address['tax_id'] = '';
				}
			}
			$payment_address['address_1'] = $this->request->post['address_1'];
			$payment_address['address_2'] = $this->request->post['address_2'];
			$payment_address['postcode'] = $this->request->post['postcode'];
			$payment_address['city'] = $this->request->post['city'];
			$payment_address['country_id'] = $this->request->post['country_id'];
			$payment_address['zone_id'] = $this->request->post['zone_id'];

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

			if ($country_info) {
				$payment_address['country'] = $country_info['name'];
				$payment_address['iso_code_2'] = $country_info['iso_code_2'];
				$payment_address['iso_code_3'] = $country_info['iso_code_3'];
				$payment_address['address_format'] = $country_info['address_format'];
			} else {
				$payment_address['country'] = '';
				$payment_address['iso_code_2'] = '';
				$payment_address['iso_code_3'] = '';
				$payment_address['address_format'] = '';
			}
			if (isset($this->request->post['custom_field'])) {
				$payment_address['custom_field'] = $this->request->post['custom_field'];
			} else {
				$payment_address['custom_field'] = array();
			}
			$this->load->model('localisation/zone');

			$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

			if ($zone_info) {
				$payment_address['zone'] = $zone_info['name'];
				$payment_address['zone_code'] = $zone_info['code'];
			} else {
				$payment_address['zone'] = '';
				$payment_address['zone_code'] = '';
			}

			$result = $payment_address;
			$result['identified_data'] = $this->model_account_xcustom_field->getCustomFieldByIdentifier($payment_address['custom_field'],'address');
			$payment_address['formatted_address'] = $this->model_account_xcustom_field->getFormattedAddress($result);
			if($isOpencartTwo){
				$this->session->data['payment_address'] = $payment_address;
			}else{
				$this->session->data['guest']['payment'] = $payment_address;
			}
			$this->session->data['payment']['custom_field'] = $result['identified_data'];

			if (!empty($this->request->post['agree'])) {
				$this->session->data['agree'] = true;
			} else {
				$this->session->data['agree'] = false;
			}

			// Default Payment Address
			$this->session->data['payment_country_id'] = $this->request->post['country_id'];
			$this->session->data['payment_zone_id'] = $this->request->post['zone_id'];
			$this->session->data['payment_postcode'] = $this->request->post['postcode'];

			if ($shipping_same && $hasShipping) {
				$shipping_address['firstname'] = $this->request->post['firstname'];
				$shipping_address['lastname'] = $this->request->post['lastname'];
				$shipping_address['company'] = $this->request->post['company'];
				$shipping_address['address_1'] = $this->request->post['address_1'];
				$shipping_address['address_2'] = $this->request->post['address_2'];
				$shipping_address['postcode'] = $this->request->post['postcode'];
				$shipping_address['city'] = $this->request->post['city'];
				$shipping_address['country_id'] = $this->request->post['country_id'];
				$shipping_address['zone_id'] = $this->request->post['zone_id'];

				if ($country_info) {
					$shipping_address['country'] = $country_info['name'];
					$shipping_address['iso_code_2'] = $country_info['iso_code_2'];
					$shipping_address['iso_code_3'] = $country_info['iso_code_3'];
					$shipping_address['address_format'] = $country_info['address_format'];
				} else {
					$shipping_address['country'] = '';
					$shipping_address['iso_code_2'] = '';
					$shipping_address['iso_code_3'] = '';
					$shipping_address['address_format'] = '';
				}

				if ($zone_info) {
					$shipping_address['zone'] = $zone_info['name'];
					$shipping_address['zone_code'] = $zone_info['code'];
				} else {
					$shipping_address['zone'] = '';
					$shipping_address['zone_code'] = '';
				}
				if (isset($this->request->post['custom_field'])) {
					$shipping_address['custom_field'] = $this->request->post['custom_field'];
				} else {
					$shipping_address['custom_field'] = array();
				}

				$shipping_address['formatted_address']=$payment_address['formatted_address'];
				if($isOpencartTwo){
					$this->session->data['shipping_address'] = $shipping_address;
				}else{
					$this->session->data['guest']['shipping'] = $shipping_address;
				}
				$this->session->data['shipping']['custom_field'] = $this->session->data['payment']['custom_field'];
				// Default Shipping Address
				$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
				$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
				$this->session->data['shipping_postcode'] = $this->request->post['postcode'];
			}
		}
		if(!$json){
			$child = $this->xtensions->getChildren(array('xcheckout/xguest/matter'));
			$json['xguest'] = $child['matter'];
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addSAddress(){
		$this->language->load('checkout/checkout');
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$modData = $this->xtensions->getModData();
		$this->session->data['shipping_same_guest'] = false;
		$json = array();

		// Validate if customer is logged in.
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Check if guest checkout is avaliable.
		if ($this->config->get('config_customer_price') || $this->cart->hasDownload()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}
		if (!$json) {
			$this->load->model('account/xcustom_field');

			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->session->data['guest']['customer_group_id']);

			foreach ($custom_fields as $custom_field) {
				if($custom_field['location'] == 'address'){
					if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['scustom_field'][$custom_field['custom_field_id']]))) {
						$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
					}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
						$field =   $this->request->post['scustom_field'][$custom_field['custom_field_id']];
						if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
							$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
						}
					}
				}
			}
			if ($modData['f_name_req_checkout'] && $modData['f_name_show_checkout']  && ((utf8_strlen($this->request->post['sfirstname']) < 1) || (utf8_strlen($this->request->post['sfirstname']) > 32))) {
				$json['error']['sfirstname'] = $this->language->get('error_firstname');
			}

			if ($modData['l_name_req_checkout'] && $modData['l_name_show_checkout'] && ((utf8_strlen($this->request->post['slastname']) < 1) || (utf8_strlen($this->request->post['slastname']) > 32))) {
				$json['error']['slastname'] = $this->language->get('error_lastname');
			}

			if ($modData['address1_req_checkout'] && $modData['address1_show_checkout'] && ((utf8_strlen($this->request->post['saddress_1']) < 3) || (utf8_strlen($this->request->post['saddress_1']) > 128))) {
				$json['error']['saddress_1'] = $this->language->get('error_address_1');
			}

			if ($modData['city_req_checkout'] && $modData['city_show_checkout'] && ((utf8_strlen($this->request->post['scity']) < 2) || (utf8_strlen($this->request->post['scity']) > 128))) {
				$json['error']['scity'] = $this->language->get('error_city');
			}

			$this->load->model('localisation/country');

			if($modData['pin_req_checkout'] && $modData['pin_show_checkout'])
			$country_info = $this->model_localisation_country->getCountry($this->request->post['scountry_id']);

			if ($modData['pin_req_checkout'] && $modData['pin_show_checkout'] && $country_info) {
				if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['spostcode']) < 2) || (utf8_strlen($this->request->post['spostcode']) > 10)) {
					$json['error']['spostcode'] = $this->language->get('error_postcode');
				}
			}

			if ($modData['country_req_checkout'] && $modData['country_show_checkout'] && $this->request->post['scountry_id'] == '') {
				$json['error']['scountry'] = $this->language->get('error_country');
			}

			if ($modData['state_req_checkout'] && $modData['state_show_checkout'] && (!isset($this->request->post['szone_id']) || $this->request->post['szone_id'] == '')) {
				$json['error']['szone'] = $this->language->get('error_zone');
			}
		}
		if (!empty($this->request->post['agree'])) {
			$this->session->data['agree'] = true;
		} else {
			$this->session->data['agree'] = false;
		}
		if (!$json) {
			$this->session->data['guest']['shipping_address'] = true;
			$shipping_address['firstname'] = $this->request->post['sfirstname'];
			$shipping_address['lastname'] = $this->request->post['slastname'];
			$shipping_address['company'] = $this->request->post['scompany'];
			$shipping_address['address_1'] = $this->request->post['saddress_1'];
			$shipping_address['address_2'] = $this->request->post['saddress_2'];
			$shipping_address['postcode'] = $this->request->post['spostcode'];
			$shipping_address['city'] = $this->request->post['scity'];
			$shipping_address['country_id'] = $this->request->post['scountry_id'];
			$shipping_address['zone_id'] = $this->request->post['szone_id'];

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['scountry_id']);
			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($this->request->post['szone_id']);

			if ($country_info) {
				$shipping_address['country'] = $country_info['name'];
				$shipping_address['iso_code_2'] = $country_info['iso_code_2'];
				$shipping_address['iso_code_3'] = $country_info['iso_code_3'];
				$shipping_address['address_format'] = $country_info['address_format'];
			} else {
				$shipping_address['country'] = '';
				$shipping_address['iso_code_2'] = '';
				$shipping_address['iso_code_3'] = '';
				$shipping_address['address_format'] = '';
			}

			if ($zone_info) {
				$shipping_address['zone'] = $zone_info['name'];
				$shipping_address['zone_code'] = $zone_info['code'];
			} else {
				$shipping_address['zone'] = '';
				$shipping_address['zone_code'] = '';
			}
			$this->session->data['shipping_country_id'] = $this->request->post['scountry_id'];
			$this->session->data['shipping_zone_id'] = $this->request->post['szone_id'];
			$this->session->data['shipping_postcode'] = $this->request->post['spostcode'];
			if (isset($this->request->post['scustom_field'])) {
				$shipping_address['custom_field'] = $this->request->post['scustom_field'];
			} else {
				$shipping_address['custom_field'] = array();
			}
			$result = $shipping_address;
			$result['identified_data'] = $this->model_account_xcustom_field->getCustomFieldByIdentifier($shipping_address['custom_field'],'address');
			$shipping_address['formatted_address'] = $this->model_account_xcustom_field->getFormattedAddress($result);
			if($isOpencartTwo){
				$this->session->data['shipping_address'] = $shipping_address;
			}else{
				$this->session->data['guest']['shipping'] = $shipping_address;
			}
			$this->session->data['shipping']['custom_field'] = $result['identified_data'];
		}
		if(!$json){
			$child = $this->xtensions->getChildren(array('xcheckout/xguest/matter'));
			$json['xguest'] = $child['matter'];
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function sameAddress(){
		$json = array();
		$shipping_same = false;
		$this->session->data['shipping_same_guest'] = false;
		$hasShipping = $this->cart->hasShipping();
		if(isset($this->request->post['xshipping_address_check']) && !empty($this->request->post['xshipping_address_check'])){
			$shipping_same = true;
			$this->session->data['shipping_same_guest'] = true;
		}
		// Validate if customer is logged in.
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Check if guest checkout is avaliable.
		if ($this->config->get('config_customer_price') || $this->cart->hasDownload()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}
			
		if (!$json) {
			if (!empty($this->request->post['shipping_address'])) {
				$this->session->data['guest']['shipping_address'] = true;
			} else {
				$this->session->data['guest']['shipping_address'] = false;
			}
			if (!empty($this->request->post['agree'])) {
				$this->session->data['agree'] = true;
			} else {
				$this->session->data['agree'] = false;
			}
			if($this->xtensions->isOpencartTwo()){
				if (isset($this->session->data['payment_address']) && $shipping_same && $hasShipping) {
					$this->session->data['shipping_address'] = $this->session->data['payment_address'];
					$this->session->data['shipping_country_id'] = $this->session->data['payment_country_id'];
					$this->session->data['shipping_zone_id'] = $this->session->data['payment_zone_id'];
					$this->session->data['shipping_postcode'] = $this->session->data['payment_postcode'];
					$this->session->data['shipping_address']['formatted_address']=$this->session->data['payment_address']['formatted_address'];
					$this->session->data['shipping']['custom_field'] = $this->session->data['payment']['custom_field'];
				}
			}else{
				if (isset($this->session->data['guest']['payment']) && $shipping_same && $hasShipping) {
					$this->session->data['guest']['shipping'] = $this->session->data['guest']['payment'];
					$this->session->data['shipping_country_id'] = $this->session->data['payment_country_id'];
					$this->session->data['shipping_zone_id'] = $this->session->data['payment_zone_id'];
					$this->session->data['shipping_postcode'] = $this->session->data['payment_postcode'];
					$this->session->data['guest']['shipping']['formatted_address']=$this->session->data['guest']['payment']['formatted_address'];
					$this->session->data['shipping']['custom_field'] = $this->session->data['payment']['custom_field'];
				}
			}
		}
		if(!$json){
			$child = $this->xtensions->getChildren(array('xcheckout/xguest/matter'));
			$json['xguest'] = $child['matter'];
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}

	public function zone() {
		$output = '<option value="">' . $this->language->get('text_select') . '</option>';

		$this->load->model('localisation/zone');

		$results = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);

		foreach ($results as $result) {
			$output .= '<option value="' . $result['zone_id'] . '"';

			if (isset($this->request->get['zone_id']) && ($this->request->get['zone_id'] == $result['zone_id'])) {
				$output .= ' selected="selected"';
			}

			$output .= '>' . $result['name'] . '</option>';
		}

		if (!$results) {
			$output .= '<option value="0">' . $this->language->get('text_none') . '</option>';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($output);
	}
}
?>
