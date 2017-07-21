<?php
class ControllerXCheckoutXPaymentAddress extends Controller {
	private $modData ;
	private $isOpencartTwo;
	public function __construct($registry){
		parent::__construct($registry);
		$this->modData = $this->xtensions->getModData();
		$this->isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->data['modData']= $this->modData;
		$this->data['isOpencartTwo']= $this->isOpencartTwo;
	}
	public $data=array();
	public function index() {
		$matter = $this->matter();
		$this->response->setOutput($matter);
	}
	public function matter(){
		$json = array();
		$this->language->load('account/address');
		$this->language->load('checkout/checkout');
		$this->data['cfname']= "";
		$this->data['clname']= "";
		if ($this->customer->isLogged()){
			$this->data['cfname']= $this->customer->getFirstName();
			$this->data['clname']= $this->customer->getLastName();
		}
		$this->load->model('account/xcustom_field');
		$account_custom_fields = $this->model_account_xcustom_field->getAccountCustomFields($this->customer->getId());
		$this->session->data['customer']['custom_field'] = $this->model_account_xcustom_field->getCustomFieldByIdentifier($account_custom_fields,'account',$this->config->get('config_customer_group_id'),'');

		$hasShipping = $this->cart->hasShipping();
		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";
		$this->data['entry_default'] = $this->language->get('entry_default');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$entry_delete = $this->language->get('button_delete');
		$this->data['text_address_existing'] = $this->language->get('text_address_existing');
		$this->data['text_address_new'] = $this->language->get('text_address_new');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_shipping'] = $this->language->get('entry_shipping');
		$this->data['shipping_required'] = $this->cart->hasShipping();

		$this->language->load('account/xtensions');
		$this->data['text_payment_continue'] = $this->language->get('text_payment_continue');
		$this->data['title_firstname'] = $this->language->get('title_firstname');
		$this->data['title_lastname'] = $this->language->get('title_lastname');
		$this->data['title_company'] = $this->language->get('title_company');
		$this->data['title_address_1'] = $this->language->get('title_address_1');
		$this->data['title_address_2'] = $this->language->get('title_address_2');
		$this->data['title_postcode'] = $this->language->get('title_postcode');
		$this->data['title_city'] = $this->language->get('title_city');
		$this->data['text_paddress'] = $this->language->get('text_paddress');
		$this->data['text_saddress'] = $this->language->get('text_saddress');
		$this->data['text_psaddress'] = $this->language->get('text_psaddress');
			
		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['text_loading'] = $this->language->get('text_loading');
		$this->data['addresses'] = array();

		$results = $this->xtensions->getAddresses($this);
		$sort_order = array();
		foreach ($results as $key => $value) {
			$sort_order[$key] = $value['address_id'];
		}
		$edit_address = '<a class="editAddress" href="%s" alt="%s"><i class="fa fa-edit"></i>%s</a>';
		$remove_address = '<a class="removeAddress xerror" href="%s" alt="%s">%s<i class="fa fa-times-circle"></i></a>';
		array_multisort($sort_order, SORT_ASC, $results);
		$this->load->model('account/customer');
		//fix
		$customer = $this->model_account_customer->getCustomer($this->customer->getId());
		foreach ($results as $result) {
			$edit = sprintf($edit_address, $this->url->link('xcheckout/xpayment_address/editAddress', 'address_id=' . $result['address_id'], 'SSL'), $this->language->get('text_edit_address'), $this->language->get('text_edit_address'));
			$delete = sprintf($remove_address, $this->url->link('xcheckout/xpayment_address/deleteAddress', 'address_id=' . $result['address_id'], 'SSL'), $this->language->get('button_delete'), $this->language->get('button_delete'));
			$default = $customer['address_id'] == $result['address_id'];
			$this->data['addresses'][$result['address_id']] = array(
        		'address_id' => $result['address_id'],
        		'address'    => $result['formatted_address'],
      			'edit' => $edit,
      			'default' => $default,
      			'delete' => $delete,       			    		
			);
		}

		if($this->isOpencartTwo){
			if (isset($this->session->data['payment_address']) && isset($this->data['addresses'][$this->session->data['payment_address']['address_id']])) {
				$this->data['address_id'] = $this->session->data['payment_address']['address_id'];
			} else if($customer['address_id']){
				$this->data['address_id'] = $customer['address_id'];
			} else if($results){
				foreach ($results as $result) {
					$this->data['address_id'] = $result['address_id'];
					break;
				}
			}else{
				$this->data['address_id'] = 0;
			}
			if($this->data['address_id']){
				$this->session->data['payment_address'] =  $this->xtensions->getAddress($this,$this->data['address_id']);
			}

			if($hasShipping){
				if (isset($this->session->data['shipping_address']) && isset($this->data['addresses'][$this->session->data['shipping_address']['address_id']])) {
					$this->data['shipping_address_id'] = $this->session->data['shipping_address']['address_id'];
				}else if($customer['address_id']){
					$this->data['shipping_address_id'] = $customer['address_id'];
				} else if($results){
					foreach ($results as $result) {
						$this->data['shipping_address_id'] = $result['address_id'];
						break;
					}
				}else{
					$this->data['shipping_address_id'] = 0;
				}
				if($this->data['shipping_address_id']){
					$this->session->data['shipping_address'] =  $this->xtensions->getAddress($this,$this->data['shipping_address_id']);
				}
			}
		}else{
			if (isset($this->session->data['payment_address_id']) && isset($this->data['addresses'][$this->session->data['payment_address_id']])) {
				$this->data['address_id'] = $this->session->data['payment_address_id'];
			} else if($this->customer->getAddressId()){
				$this->data['address_id'] = $this->customer->getAddressId();
			} else if($results){
				foreach ($results as $result) {
					$this->data['address_id'] = $result['address_id'];
					break;
				}
			}else{
				$this->data['address_id'] = 0;
			}
			if($this->data['address_id']){
				$this->session->data['payment_address_id'] =  $this->data['address_id'];
				$address_info = $this->xtensions->getAddress($this,$this->data['address_id']);
				if ($address_info) {
					$this->session->data['payment_country_id'] = $address_info['country_id'];
					$this->session->data['payment_zone_id'] = $address_info['zone_id'];
				}
			}

			if($hasShipping){
				if (isset($this->session->data['shipping_address_id']) && isset($this->data['addresses'][$this->session->data['shipping_address_id']])) {
					$this->data['shipping_address_id'] = $this->session->data['shipping_address_id'];
				}else if($this->customer->getAddressId()){
					$this->data['shipping_address_id'] = $this->customer->getAddressId();
				} else if($results){
					foreach ($results as $result) {
						$this->data['shipping_address_id'] = $result['address_id'];
						break;
					}
				}else{
					$this->data['shipping_address_id'] = 0;
				}
				if($this->data['shipping_address_id']){
					$this->session->data['shipping_address_id'] =  $this->data['shipping_address_id'];
					$address_info = $this->xtensions->getAddress($this,$this->data['shipping_address_id']);
					if ($address_info) {
						$this->session->data['shipping_country_id'] = $address_info['country_id'];
						$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
						$this->session->data['shipping_postcode'] = $address_info['postcode'];
					}
				}

			}
		}
		if (isset($this->session->data['sameAddress']) && $this->session->data['sameAddress']) {
			$this->data['same_address'] = 'true';
		} else if(isset($this->session->data['sameAddress']) && !$this->session->data['sameAddress']) {
			$this->data['same_address'] = '';
		} else {
			$this->data['same_address'] = 'true';
		}

		$this->load->model('account/customer_group');
		if($this->isOpencartTwo){
			$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getGroupId());
		}else{
			$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());
		}

		if(!$this->isOpencartTwo){
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
		}

		if (isset($this->session->data['payment_address']['country_id'])) {
			$this->data['country_id'] = $this->session->data['payment_address']['country_id'];
		} elseif (!$this->modData['country_show_checkout'] && $this->modData['def_country']) {
			$this->data['country_id'] = $this->modData['def_country'];
		} else {
			$this->data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->session->data['payment_address']['zone_id'])) {
			$this->data['zone_id'] =  $this->session->data['payment_address']['zone_id'];
		} elseif (!$this->modData['state_show_checkout'] && $this->modData['def_state']) {
			$this->data['zone_id'] = $this->modData['def_state'];
		} else {
			$this->data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->session->data['payment_address']['custom_field'])) {
			$this->data['payment_address_custom_field'] = $this->session->data['payment_address']['custom_field'];
		} else {
			$this->data['payment_address_custom_field'] = array();
		}

		if ($this->config->get('config_checkout_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_checkout_id'));

			if ($information_info) {
				$agree_text = '<a class="agree" href="%s" alt="%s"><b>%s</b></a>';
				if($this->isOpencartTwo){
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
		if($hasShipping && $this->data['shipping_address_id'] && !isset($this->data['addresses'][$this->data['shipping_address_id']])){
			$this->data['shipping_address_id'] = '';
		}
		$children = array('xcheckout/xcvc/xoptions');
		if($hasShipping && $this->data['shipping_address_id'] && isset($this->data['addresses'][$this->data['shipping_address_id']])){
			array_push($children,'xcheckout/xshipping_method');
		}else{
			$this->data['xshipping_method']  = '';
		}
		$this->data['shipping_error'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		array_push($children,'xcheckout/xcvc/xtotals');
			
		$this->data += $this->xtensions->getChildren($children);
		$this->template = 'xtensions/template/checkout/xpayment_address.tpl';
		return $this->xtensions->renderView($this);
	}

	public function validate() {
		$this->language->load('checkout/checkout');
		$json = array();
		$json1 = array();
		$json['error'] =array();
		$json1['error'] =array();
		$existing=true;
		$existing1=true;
		$shipping_same = false;
		$hasShipping = $this->cart->hasShipping();

		if(isset($this->request->post['xshipping_address_check']) && !empty($this->request->post['xshipping_address_check'])){
			$shipping_same = true;
			$this->session->data['sameAddress'] = true;
		}else{
			$this->session->data['sameAddress'] = false;
		}

		// Validate if customer is logged in.
		if (!$this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}

		// Validate minimum quantity requirments.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$json['redirect'] = $this->url->link('checkout/cart');

				break;
			}
		}
		$json1=$json;
		if (!$json['error']) {
			if (empty($this->request->post['address_id'])) {
				$json['error']['warning'] = $this->language->get('error_address');
			} elseif (!in_array($this->request->post['address_id'], array_keys($this->xtensions->getAddresses($this)))) {
				$json['error']['warning'] = $this->language->get('error_address');
			} else if(!$this->isOpencartTwo){
				$address_info = $this->xtensions->getAddress($this,$this->request->post['address_id']);
				if ($address_info) {
					$this->load->model('account/customer_group');
					$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());
					// Company ID
					if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && !$address_info['company_id']) {
						$json['error']['warning'] = $this->language->get('error_company_id');
					}
					// Tax ID
					if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && !$address_info['tax_id']) {
						$json['error']['warning'] = $this->language->get('error_tax_id');
					}
				}
			}

			if (!$json['error']) {
				if($this->isOpencartTwo){
					$this->session->data['payment_address'] = $this->xtensions->getAddress($this,$this->request->post['address_id']);
					$this->session->data['payment']['custom_field'] = $this->session->data['payment_address']['identified_data'];
					if (isset($this->request->post['agree'])) {
						$this->session->data['agree'] = true;
					}
					$existing = false;
					if($shipping_same && $hasShipping){
						$this->session->data['shipping_address'] = $this->session->data['payment_address'];
						$this->session->data['shipping']['custom_field'] = $this->session->data['payment']['custom_field'];
					}
				}else{
					$this->session->data['payment_address_id'] = $this->request->post['address_id'];
					if (isset($this->request->post['agree'])) {
						$this->session->data['agree'] = true;
					}
					$existing = false;
					if($shipping_same && $hasShipping){
						$this->session->data['shipping_address_id'] = $this->request->post['address_id'];
					}
					$address_info = $this->xtensions->getAddress($this,$this->request->post['address_id']);
					if ($address_info) {
						$this->session->data['payment_country_id'] = $address_info['country_id'];
						$this->session->data['payment_zone_id'] = $address_info['zone_id'];
						if($shipping_same && $hasShipping){
							$this->session->data['shipping_country_id'] = $address_info['country_id'];
							$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
							$this->session->data['shipping_postcode'] = $address_info['postcode'];
						}
					} else {
						unset($this->session->data['payment_country_id']);
						unset($this->session->data['payment_zone_id']);
						if($shipping_same && $hasShipping){
							unset($this->session->data['shipping_country_id']);
							unset($this->session->data['shipping_zone_id']);
							unset($this->session->data['shipping_postcode']);
						}
					}
				}
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);
			}
			//Xtensions Shipping Address
			if($hasShipping && !$shipping_same){
				if (empty($this->request->post['saddress_id'])) {
					$json1['error']['swarning'] = $this->language->get('error_address');
				} elseif (!in_array($this->request->post['saddress_id'], array_keys($this->xtensions->getAddresses($this)))) {
					$json1['error']['swarning'] = $this->language->get('error_address');
				} else if(!$this->isOpencartTwo){
					$address_info = $this->xtensions->getAddress($this,$this->request->post['saddress_id']);
				}
				if (!$json1['error']) {
					if($this->isOpencartTwo){
						$this->session->data['shipping_address'] = $this->xtensions->getAddress($this,$this->request->post['saddress_id']);
						$this->session->data['shipping']['custom_field'] = $this->session->data['shipping_address']['identified_data'];
					}else{
						$this->session->data['shipping_address_id'] = $this->request->post['saddress_id'];
						$existing1 = false;
						if ($address_info) {
							$this->session->data['shipping_country_id'] = $address_info['country_id'];
							$this->session->data['shipping_zone_id'] = $address_info['zone_id'];
							$this->session->data['shipping_postcode'] = $address_info['postcode'];
							$this->session->data['shipping']['custom_field'] = $address_info['identified_data'];
						} else {
							unset($this->session->data['shipping_country_id']);
							unset($this->session->data['shipping_zone_id']);
							unset($this->session->data['shipping_postcode']);
						}
					}
				}
				$json['error'] = array_merge($json['error'],$json1['error']);
			}

		}
		if(!$json){
			$json = $this->xtensions->getChildren(array('xcheckout/xshipping_method'));
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validateForm($modData){
		$json = array();
		if (!$this->customer->isLogged()){
			$json['redirect']=$this->url->link('checkout/checkout', '', 'SSL');
		}
		if ($modData['f_name_req_checkout'] && $modData['f_name_show_checkout']  && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
			$json['error']['firstname'] = $this->language->get('error_firstname');
		}

		if ($modData['l_name_req_checkout'] && $modData['l_name_show_checkout'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
			$json['error']['lastname'] = $this->language->get('error_lastname');
		}
		if(!$this->isOpencartTwo){
			$this->load->model('account/customer_group');
			$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());
			if ($customer_group_info) {
				// Company ID
				if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && empty($this->request->post['company_id'])) {
					$json['error']['company_id'] = $this->language->get('error_company_id');
				}
				// Tax ID
				if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && empty($this->request->post['tax_id'])) {
					$json['error']['tax_id'] = $this->language->get('error_tax_id');
				}
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
			if(!$this->isOpencartTwo){
				// VAT Validation
				$this->load->helper('vat');
				if ($this->config->get('config_vat') && !empty($this->request->post['tax_id']) && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
					$json['error']['tax_id'] = $this->language->get('error_vat');
				}
			}
		}

		if ($modData['country_req_checkout'] && $modData['country_show_checkout'] && $this->request->post['country_id'] == '') {
			$json['error']['country'] = $this->language->get('error_country');
		}
			
		if ($modData['state_req_checkout'] && $modData['state_show_checkout'] && (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '')) {
			$json['error']['zone'] = $this->language->get('error_zone');
		}
		// Custom field validation
		$this->load->model('account/xcustom_field');

		$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->config->get('config_customer_group_id'));

		foreach ($custom_fields as $custom_field) {
			if($custom_field['location'] == 'address'){
				if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']]))) {
					$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
				}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
					$field =   $this->request->post['custom_field'][$custom_field['custom_field_id']];
					if($custom_field['required'] && ((utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
						$json['error']['custom_field' . $custom_field['custom_field_id']]  = $custom_field['error'];
					}
				}
			}
		}
		return $json;
	}

	public function addAddress(){
		$this->language->load('checkout/checkout');
		$hasShipping = $this->cart->hasShipping();
		$json = $this->validateForm($this->modData);
		if(!$json){
			$this->load->model('account/address');
			$address_id = $this->model_account_address->addAddress($this->request->post);
			if($this->isOpencartTwo){
				$this->session->data['payment_address'] = $this->xtensions->getAddress($this,$address_id);
				$this->load->model('account/activity');
				$activity_data = array(
						'customer_id' => $this->customer->getId(),
						'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);
				$this->model_account_activity->addActivity('address_add', $activity_data);
				if($hasShipping){
					$this->session->data['shipping_address'] = $this->session->data['payment_address'];
				}
			}else{
				$this->session->data['payment_address_id'] = $address_id;
				$this->session->data['payment_country_id'] = $this->request->post['country_id'];
				$this->session->data['payment_zone_id'] = $this->request->post['zone_id'];
				if($hasShipping){
					$this->session->data['shipping_address_id'] = $this->session->data['payment_address_id'];
					$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
					$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
					$this->session->data['shipping_postcode'] = $this->request->post['postcode'];
				}
			}
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
		}
		if(!$json){
			$child = $this->xtensions->getChildren(array('xcheckout/xpayment_address/matter'));
			$json['xpayment_address'] = $child['matter'];
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function country(){
		$json = array();
		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->get['scountry_id']);
		if ($country_info) {
			$this->load->model('localisation/zone');
			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['scountry_id']),
				'status'            => $country_info['status']		
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function editAddress(){
		$this->language->load('account/address');
		$this->language->load('checkout/checkout');
		$json =array();

		if(!($this->request->server['REQUEST_METHOD'] == 'POST')){
			if (!$this->customer->isLogged()) {
				$json['redirect']=$this->url->link('checkout/checkout', '', 'SSL');
			}
			$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";
			$this->data['text_edit_address'] = $this->language->get('text_edit_address');
			$this->data['text_yes'] = $this->language->get('text_yes');
			$this->data['text_no'] = $this->language->get('text_no');
			$this->data['entry_default'] = $this->language->get('entry_default');
			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_none'] = $this->language->get('text_none');

			$this->data['entry_firstname'] = $this->language->get('entry_firstname');
			$this->data['entry_lastname'] = $this->language->get('entry_lastname');
			$this->data['entry_company'] = $this->language->get('entry_company');
			$this->data['entry_address_1'] = $this->language->get('entry_address_1');
			$this->data['entry_address_2'] = $this->language->get('entry_address_2');
			$this->data['entry_postcode'] = $this->language->get('entry_postcode');
			$this->data['entry_city'] = $this->language->get('entry_city');
			$this->data['entry_country'] = $this->language->get('entry_country');
			$this->data['entry_zone'] = $this->language->get('entry_zone');
			$this->data['entry_shipping'] = $this->language->get('entry_shipping');
			$this->data['shipping_required'] = $this->cart->hasShipping();

			$this->language->load('account/xtensions');
			$this->data['text_payment_continue'] = $this->language->get('text_payment_continue');
			$this->data['title_firstname'] = $this->language->get('title_firstname');
			$this->data['title_lastname'] = $this->language->get('title_lastname');
			$this->data['title_company'] = $this->language->get('title_company');
			$this->data['title_company_id'] = $this->language->get('title_company_id');
			$this->data['title_address_1'] = $this->language->get('title_address_1');
			$this->data['title_address_2'] = $this->language->get('title_address_2');
			$this->data['title_postcode'] = $this->language->get('title_postcode');
			$this->data['title_city'] = $this->language->get('title_city');
			$this->data['text_paddress'] = $this->language->get('text_paddress');
			$this->data['text_saddress'] = $this->language->get('text_saddress');
			$this->data['text_psaddress'] = $this->language->get('text_psaddress');

			$this->data['button_continue'] = $this->language->get('button_continue');
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['text_loading'] = $this->language->get('text_loading');

			$address_info = $this->xtensions->getAddress($this,$this->request->get['address_id']);

			if(!empty($address_info)){
				$this->data['address'] = $address_info;
				$this->data['address_custom_field'] = $address_info['custom_field'];
				if(!$this->isOpencartTwo){
					$this->data['entry_company_id'] = $this->language->get('entry_company_id');
					$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
					$this->data['title_company_id'] = $this->language->get('title_company_id');
					$this->load->model('account/customer_group');
					$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());
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
						$this->data['tax_id_required'] = $customer_group_info['tax_id_required'];
					} else {
						$this->data['tax_id_required'] = '';
					}
					if ($customer_group_info) {
						$this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
					} else {
						$this->data['tax_id_display'] = '';
					}
				}
				$this->load->model('account/customer');
				//fix
				$customer = $this->model_account_customer->getCustomer($this->customer->getId());
				$this->data['default'] = $customer['address_id'] == $address_info['address_id'];
				$this->load->model('localisation/country');
				$this->data['countries'] = $this->model_localisation_country->getCountries();
				// Custom fields
				$this->load->model('account/xcustom_field');
				$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->config->get('config_customer_group_id'));
			}else{
				$json['redirect']=$this->url->link('checkout/checkout', '', 'SSL');
			}
			if(!$json){
				$this->template = 'xtensions/template/checkout/xeditaddress.tpl';
				$json['editAddress'] =  $this->xtensions->renderView($this);
			}
		}
		else{
			$json = $this->validateForm($this->modData);
			if(!$json){
				$this->load->model('account/address');
				$this->model_account_address->editAddress($this->request->post['address_id'], $this->request->post);
				$hasShipping = $this->cart->hasShipping();
				if($this->isOpencartTwo){
					// Default Shipping Address
					if ($hasShipping && isset($this->session->data['shipping_address']['address_id']) && ($this->request->post['address_id'] == $this->session->data['shipping_address']['address_id'])) {
						$this->session->data['shipping_address'] = $this->xtensions->getAddress($this,$this->request->post['address_id']);
						unset($this->session->data['shipping_method']);
						unset($this->session->data['shipping_methods']);
					}
					// Default Payment Address
					if (isset($this->session->data['payment_address']['address_id']) && ($this->request->post['address_id'] == $this->session->data['payment_address']['address_id'])) {
						$this->session->data['payment_address'] = $this->xtensions->getAddress($this,$this->request->post['address_id']);
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
				}else{
					if ($hasShipping && isset( $this->session->data['shipping_address_id']) && ( $this->request->post['address_id'] == $this->session->data['shipping_address_id'])) {
						$this->session->data['shipping_address_id'] = $this->request->post['address_id'];
						$this->session->data['shipping_country_id'] = $this->request->post['country_id'];
						$this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
						$this->session->data['shipping_postcode'] = $this->request->post['postcode'];
						unset($this->session->data['shipping_method']);
						unset($this->session->data['shipping_methods']);
					}
					// Default Payment Address
					if (isset($this->session->data['payment_address_id']) && ($this->request->post['address_id'] == $this->session->data['payment_address_id'])) {
						$this->session->data['payment_address_id'] = $this->request->post['address_id'];
						$this->session->data['payment_country_id'] = $this->request->post['country_id'];
						$this->session->data['payment_zone_id'] = $this->request->post['zone_id'];
						$this->session->data['payment_postcode'] = $this->request->post['postcode'];
						unset($this->session->data['payment_method']);
						unset($this->session->data['payment_methods']);
					}
				}
				if(!$json){
					$child = $this->xtensions->getChildren(array('xcheckout/xpayment_address/matter'));
					$json['xpayment_address'] = $child['matter'];
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function deleteAddress() {
		$json = array();
		if (!$this->customer->isLogged()) {
			$json['redirect']= $this->url->link('account/login', '', 'SSL');
		}
		if (isset($this->request->get['address_id'])) {
			$this->load->model('account/address');
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
				if (isset($this->session->data['shipping_address_id']) && ($this->request->get['address_id'] == $this->session->data['shipping_address_id'])) {
					unset($this->session->data['shipping_address_id']);
					unset($this->session->data['shipping_country_id']);
					unset($this->session->data['shipping_zone_id']);
					unset($this->session->data['shipping_postcode']);
					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
				}
				// Default Payment Address
				if (isset($this->session->data['payment_address']['address_id']) && ($this->request->get['address_id'] == $this->session->data['payment_address']['address_id'])) {
					unset($this->session->data['payment_address_id']);
					unset($this->session->data['payment_country_id']);
					unset($this->session->data['payment_zone_id']);
					unset($this->session->data['payment_postcode']);
					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
				}
			}
		}else{
			$json['redirect']= $this->url->link('checkout/checkout', '', 'SSL');
		}
		$json['redirect']= $this->url->link('checkout/checkout', '', 'SSL');
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>