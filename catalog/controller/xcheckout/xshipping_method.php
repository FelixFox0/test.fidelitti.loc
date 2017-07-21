<?php
class ControllerXCheckoutXShippingMethod extends Controller {
	public $data= array();
	public function index() {
		$this->language->load('checkout/checkout');
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$shipping_address = array();
		if($isOpencartTwo && isset($this->session->data['shipping_address'])){
			$shipping_address = $this->session->data['shipping_address'];
		}else if(!$isOpencartTwo){
			if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
				$shipping_address = $this->xtensions->getAddress($this,$this->session->data['shipping_address_id']);
			} elseif (isset($this->session->data['guest']) && isset($this->session->data['guest']['shipping'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		}
		if (!empty($shipping_address)) {
			// Shipping Methods
			$quote_data = array();
			if($isOpencartTwo){
				$this->load->model('extension/extension');
				$results = $this->model_extension_extension->getExtensions('shipping');
			}else{
				$this->load->model('setting/extension');
				$results = $this->model_setting_extension->getExtensions('shipping');
			}

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('shipping/' . $result['code']);

					$quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);

					if ($quote) {
						$quote_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'], 
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error']
						);
					}
				}
			}

			$sort_order = array();

			foreach ($quote_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $quote_data);

			$this->session->data['shipping_methods'] = $quote_data;
		if($quote_data && !isset($this->session->data['shipping_method'])){
				foreach ($quote_data as $quote) {
					foreach ($quote['quote'] as $quote) {
						$shippings = $quote['code'];
						break;
					}
					break;
				}
				$shipping = explode('.', $shippings);
				$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
			}else if(!$quote_data){
				unset($this->session->data['shipping_method']);
			}else if(isset($this->session->data['shipping_method']) && isset($this->session->data['shipping_method']['code'])){
				$shipping = explode('.', $this->session->data['shipping_method']['code']);
				if(!isset($quote_data[$shipping[0]])){
					foreach ($quote_data as $quote) {
						foreach ($quote['quote'] as $quote) {
							$shippings = $quote['code'];
							break;
						}
						break;
					}
					$shipping = explode('.', $shippings);
					$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];						
				}
			}		
		}
		if (empty($this->session->data['shipping_methods'])) {
			$this->data['error_shipping_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		} else {
			$this->data['error_shipping_warning'] = '';
		}
			
		if (isset($this->session->data['shipping_methods'])) {
			$this->data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$this->data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$shipping1 = explode('.', $this->session->data['shipping_method']['code']);
			if (!isset($shipping1[0]) || !isset($shipping1[1]) || !isset($this->session->data['shipping_methods'][$shipping1[0]]) || !isset($this->session->data['shipping_methods'][$shipping1[0]]['quote'][$shipping1[1]])) {
				$this->data['shipping_code'] = '';
			}else{
				$this->data['shipping_code'] = $this->session->data['shipping_method']['code'];
			}
		} else {
			$this->data['shipping_code'] = '';
		}
		$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$this->template = 'xtensions/template/checkout/xshipping_method.tpl';
		return $this->xtensions->renderView($this);
	}

	public function validate() {
		$this->language->load('checkout/checkout');

		$json = array();

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate if shipping address has been set.
		$this->load->model('account/address');
		if($this->xtensions->isOpencartTwo()){
			if (isset($this->session->data['shipping_address'])) {
				$shipping_address =  $this->session->data['shipping_address'];
			}
		}else{
			if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
				$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
			} elseif (isset($this->session->data['guest'])) {
				$shipping_address = $this->session->data['guest']['shipping'];
			}
		}

		if (empty($shipping_address)) {
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
		if (!isset($json['redirect'])) {
			if (!isset($this->request->post['shipping_method']) && !isset($this->session->data['shipping_method'])) {
				$json['error']['warning'] = $this->language->get('error_shipping');
			} else {
				if(isset($this->request->post['shipping_method'])){
					$shipping_method = $this->request->post['shipping_method'];
				}else{
					$shipping_method =  $this->session->data['shipping_method']['code'];
				}
				$shipping = explode('.', $shipping_method);

				if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
					$json['error']['warning'] = $this->language->get('error_shipping');
				}
			}

			if (!isset($json['redirect']) && !isset($json['error'])) {				
				$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];						
			}
		}
		$json['shipping_method']= $this->index();
		$json['shipping_methods']= $this->session->data['shipping_methods']?true:false;
		$json['warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
		$json += $this->xtensions->getChildren(array('xcheckout/xcvc/xtotals'));
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>