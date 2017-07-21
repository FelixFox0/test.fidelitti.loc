<?php
class ControllerXCheckoutXPaymentMethod extends Controller {
	public $data = array();
	public function index() {
		unset($this->session->data['payment_method']);
		unset($this->session->data['payment_methods']);
		$this->session->data['agree'] = true;
		$this->language->load('account/xtensions');
		$this->language->load('checkout/checkout');
		$this->data['text_nopayments']= $this->language->get('text_nopayments');
		$this->data['text_change_address']= $this->language->get('text_change_address');
		$this->data['text_change_shipping']= $this->language->get('text_change_shipping');
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$payment_address = array();
		if($isOpencartTwo && isset($this->session->data['payment_address'])){
			$payment_address = $this->session->data['payment_address'];
		}else if(!$isOpencartTwo){
			if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
				$payment_address = $this->xtensions->getAddress($this,$this->session->data['payment_address_id']);
			} elseif (isset($this->session->data['guest']) && isset($this->session->data['guest']['payment'])) {
				$payment_address = $this->session->data['guest']['payment'];
			}
		}

		$shipping_address = $payment_address;
		$this->data['shipping_address_title']= $this->language->get('text_paddress');
		if($this->cart->hasShipping()){
			if($isOpencartTwo && isset($this->session->data['shipping_address'])){
				$shipping_address = $this->session->data['shipping_address'];
			}else if(!$isOpencartTwo){
				if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
					$shipping_address = $this->xtensions->getAddress($this,$this->session->data['shipping_address_id']);
				} elseif (isset($this->session->data['guest']) && isset($this->session->data['guest']['shipping'])) {
					$shipping_address = $this->session->data['guest']['shipping'];
				}
			}
			$this->data['shipping_address_title']= $this->language->get('text_saddress');
			$this->data['shipping_method_title']= $this->language->get('text_smethod');
			$this->data['shipping_method']= $this->session->data['shipping_method']['title'];
		}

		$this->data['shipaddress'] =$shipping_address['formatted_address'];

		$this->session->data['comment']=isset($this->session->data['comment'])?$this->session->data['comment']:'';
		if (!empty($payment_address)) {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();
			if($isOpencartTwo){
				$this->load->model('extension/extension');
				$results = $this->model_extension_extension->getExtensions('total');
			}else{
				$this->load->model('setting/extension');
				$results = $this->model_setting_extension->getExtensions('total');
			}

			$sort_order = array();



			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}


			// Payment Methods
			$method_data = array();
			if($isOpencartTwo){
				$results = $this->model_extension_extension->getExtensions('payment');
				$cart_has_recurring = $this->cart->hasRecurringProducts();
			}else{
				$results = $this->model_setting_extension->getExtensions('payment');
				if(VERSION == '1.5.5' || VERSION == '1.5.5.1'){
					$cart_has_recurring = false;
				}else{
					$cart_has_recurring = $this->cart->hasRecurringProducts();
				}
			}


			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('payment/' . $result['code']);

					$method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

					if ($method) {
						if($cart_has_recurring > 0){
							if (method_exists($this->{'model_payment_' . $result['code']},'recurringPayments')) {
								if($this->{'model_payment_' . $result['code']}->recurringPayments() == true){
									$method_data[$result['code']] = $method;
								}
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['payment_methods'] = $method_data;

		}



		$this->data['text_payment_method'] = $this->language->get('text_payment_method');

		$this->data['button_continue'] = $this->language->get('button_continue');

		if (empty($this->session->data['payment_methods'])) {
			$this->data['error_payment_warning'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact'));
		} else {
			$this->data['error_payment_warning'] = '';
		}

		if (isset($this->session->data['payment_methods'])) {
			$this->data['payment_methods'] = $this->session->data['payment_methods'];
		} else {
			$this->data['payment_methods'] = array();
		}

		if (isset($this->session->data['payment_method']['code'])) {
			$this->data['code'] = $this->session->data['payment_method']['code'];
		} else {
			$this->data['code'] = '';
		}

		$this->template = 'xtensions/template/checkout/xpayment_method.tpl';
		$this->response->setOutput($this->xtensions->renderView($this));
	}

	public function validate() {
		$this->language->load('checkout/checkout');

		$json = array();

		// Validate if payment address has been set.
		$this->load->model('account/address');
		if($this->xtensions->isOpencartTwo()){
			$payment_address = (isset($this->session->data['payment_address'])?$this->session->data['payment_address']:'');
		}else{
			if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
				$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
			} elseif (isset($this->session->data['guest'])) {
				$payment_address = $this->session->data['guest']['payment'];
			}
		}
		if (empty($payment_address)) {
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

		if (!$json) {
			if (!isset($this->request->post['payment_method'])) {
				$json['error']['warning_payment'] = $this->language->get('error_payment');
			} elseif (!isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
				$json['error']['warning_payment'] = $this->language->get('error_payment');
			}
			if (!$json) {
				$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>