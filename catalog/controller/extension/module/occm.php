<?php
require_once(DIR_SYSTEM.'library/ecc12.php');

class ControllerExtensionModuleOccm extends ECController12 {

	public function __construct($registry) {

		parent::__construct($registry);
		$this->load->language('extension/module/occm');

	}

	public function index() {

		if (!$this->c('occm_status')) {
			return;
		}
		$productId = (int)$this->request->get['product_id'];
		$this->data['productInfo'] = false;
		if ($productId) {
			$this->data['productInfo'] = $this->m('catalog/product')->getProduct($productId);
			if ($this->data['productInfo']) {
				$this->data['productInfo']['image'] = $this->m('tool/image')->resize($this->data['productInfo']['image'], 
					$this->c('occm_image_size_x'), $this->c('occm_image_size_y'));
			}
		}
		$this->template = 'extension/module/occm';
		$this->response->setOutput($this->render());
	}

	public function add() {

		$this->load->language('checkout/cart');
		$json = array();
		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}
		$this->load->model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($product_id);
		if ($product_info) {
			if (isset($this->request->post['quantity'])) {
				$quantity = $this->request->post['quantity'];
			} else {
				$quantity = 1;
			}
			if (isset($this->request->post['option'])) {
				$option = array_filter($this->request->post['option']);
			} else {
				$option = array();
			}
			if (isset($this->request->post['profile_id'])) {
				$profile_id = $this->request->post['profile_id'];
			} else {
				$profile_id = 0;
			}
			$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);
			foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'),$product_option['name']);
				}
			}
			if (is_callable(array($this->model_catalog_product, 'getProfiles'))) {
				$profiles = $this->model_catalog_product->getProfiles($product_info['product_id']);
				if ($profiles) {
					$profile_ids = array();
					foreach ($profiles as $profile) {
						$profile_ids[] = $profile['profile_id'];
					}
					if (!in_array($profile_id,$profile_ids)) {
						$json['error']['profile'] = $this->language->get('error_profile_required');
					}
				}
			}
			if (!$json) {
				if (empty($this->request->post['occ_customer']) && empty($this->request->get['occ_customer'])) {
					if ($this->customer->isLogged()) {
						$json['success'] = 2;
					} else {
						$json['success'] = 1;
					}
				} elseif (isset($this->request->post['occ_customer'])) {
					foreach ($this->request->post['occ_customer'] as &$value) {
						$value = trim($value);
					}
					if (2 == $this->c('occm_name_field') && empty($this->request->post['occ_customer']['firstname'])) {
						$json['error'] = $this->l('Name is required!');
						$json['addErrorClass'][] = 'input[name="occ_customer[firstname]"]';
					} elseif (2 == $this->c('occm_phone_field') && empty($this->request->post['occ_customer']['telephone'])) {
						$json['error'] = $this->l('Telephone is required!');
						$json['addErrorClass'][] = 'input[name="occ_customer[telephone]"]';
					} elseif (2 == $this->c('occm_mail_field') && empty($this->request->post['occ_customer']['email'])) {
						$json['error'] = $this->l('Email is required!');
						$json['addErrorClass'][] = 'input[name="occ_customer[email]"]';
					} elseif (!empty($this->request->post['occ_customer']['telephone']) && !preg_match('/^\+?[-0-9() ]+$/', $this->request->post['occ_customer']['telephone'])) {
						$json['error'] = $this->l('Telephone is wrong!');
						$json['addErrorClass'][] = 'input[name="occ_customer[telephone]"]';
					} elseif (!empty($this->request->post['occ_customer']['email']) && !preg_match('/^[^@]+@[^@.]+\.[^@]+$/', $this->request->post['occ_customer']['email'])) {
						$json['error'] = $this->l('Email is wrong!');
						$json['addErrorClass'][] = 'input[name="occ_customer[email]"]';
					} else {
						$this->cart->clear();
						$this->cart->add($this->request->post['product_id'],$quantity,$option,$profile_id);
						$json['success'] = sprintf($this->l('Order complete - ID: %s'), $this->mOrder($this->request->post['occ_customer']));
						$this->cart->clear();
					}
				} elseif ($this->customer->isLogged()) {
					$this->cart->clear();
					$this->cart->add($this->request->post['product_id'],$quantity,$option,$profile_id);
					$json['success'] = sprintf($this->l('Order complete - ID: %s'), $this->mOrder(array()));
					$this->cart->clear();
				}
			}
		}
		$this->response->setOutput(json_encode($json));
	}

	public function js() {

		if (!$this->c('occm_status')) {
			$this->response->setOutput(' ');
			return;
		}
		$this->template = 'extension/module/occm_js';
		$this->response->addHeader("Content-type: text/javascript; charset=utf-8");
		$this->response->setOutput($this->render());
	}

	public function imageUrl($i) {
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return $this->config->get('config_ssl') . 'catalog/view/javascript/occm/images/' . $i;
		} else {
			return $this->config->get('config_url') . 'catalog/view/javascript/occm/images/' . $i;
		}
	}

	protected function mOrder($customer) {

		$total_data = array();
		$total      = 0;
		$taxes      = $this->cart->getTaxes();
		$sort_order = array();

		$results = $this->m('extension/extension')->getExtensions('total');

		foreach ($results as $key => $value) {
			$sort_order[$key] = $this->config->get($value['code'].'_sort_order');
		}
		array_multisort($sort_order,SORT_ASC,$results);
		foreach ($results as $result) {
			if ($this->config->get($result['code'].'_status')) {
				$this->load->model('extension/total/'.$result['code']);
				$this-> {
					'model_extension_total_'.$result['code']
				}->getTotal(array('totals' => &$total_data, 'total' => &$total, 'taxes' => &$taxes));
			}
		}
		$sort_order = array();
		foreach ($total_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}
		array_multisort($sort_order,SORT_ASC,$total_data);
		$data                   = array();
		$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$data['store_id']       = $this->config->get('config_store_id');
		$data['store_name']     = $this->config->get('config_name');
		if ($data['store_id']) {
			$data['store_url'] = $this->config->get('config_url');
		} else {
			$data['store_url'] = HTTP_SERVER;
		}
		if ($this->customer->isLogged()) {
			$data['customer_id']       = $this->customer->getId();

			if (defined('VERSION') && '2.' == substr(VERSION, 0, 2)) {
				$data['customer_group_id'] = $this->customer->getGroupId();
			} else {
				$data['customer_group_id'] = $this->customer->getCustomerGroupId();
			}

			$data['firstname']         = $this->customer->getFirstName();
			$data['lastname']          = $this->customer->getLastName();
			$data['email']             = $this->customer->getEmail();
			$data['telephone']         = $this->customer->getTelephone();
			$data['fax']               = $this->customer->getFax();
			$this->load->model('account/address');
			if (isset($this->session->data['payment_address_id'])) {
				$payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
			} else {
				$addressId = $this->s->cell("SELECT `address_id` FROM ".DB_PREFIX."address WHERE customer_id = :c: LIMIT 1", array('c' => $this->customer->getId()));
				$payment_address = $this->model_account_address->getAddress($addressId);
			}
		} else {
			$data['customer_id']       = 0;
			$data['customer_group_id'] = $this->c('config_customer_group_id');
			$data['firstname']         = empty($customer['firstname']) ? '' : $customer['firstname'];
			$data['lastname']          = '';
			$data['email']             = empty($customer['email']) ? $this->c('config_email') : $customer['email'];
			$data['telephone']         = empty($customer['telephone']) ? '' : $customer['telephone'];
			$data['fax']               = '';
			$payment_address = array(
				'firstname' => '',
				'lastname' => '',
				'company' => '',
				'company_id' => '',
				'tax_id' => '',
				'address_1' => '',
				'address_2' => '',
				'city' => '',
				'postcode' => '',
				'zone' => '',
				'zone_id' => '',
				'country' => '',
				'country_id' => '',
				'address_format' => '',
				);
		}
		$data['payment_firstname']      = $payment_address['firstname'];
		$data['payment_lastname']       = $payment_address['lastname'];
		$data['payment_company']        = $payment_address['company'];
		$data['payment_company_id']     = empty($payment_address['company_id']) ? '' : $payment_address['company_id'];
		$data['payment_tax_id']         = empty($payment_address['tax_id']) ? '' : $payment_address['tax_id'];
		$data['payment_address_1']      = $payment_address['address_1'];
		$data['payment_address_2']      = $payment_address['address_2'];
		$data['payment_city']           = $payment_address['city'];
		$data['payment_postcode']       = $payment_address['postcode'];
		$data['payment_zone']           = $payment_address['zone'];
		$data['payment_zone_id']        = $payment_address['zone_id'];
		$data['payment_country']        = $payment_address['country'];
		$data['payment_country_id']     = $payment_address['country_id'];
		$data['payment_address_format'] = $payment_address['address_format'];
		if (isset($this->session->data['payment_method']['title'])) {
			$data['payment_method'] = $this->session->data['payment_method']['title'];
		} else {
			$data['payment_method'] = '';
		}
		if (isset($this->session->data['payment_method']['code'])) {
			$data['payment_code'] = $this->session->data['payment_method']['code'];
		} else {
			$data['payment_code'] = '';
		}
		if ($this->cart->hasShipping()) {
			if ($this->customer->isLogged()) {
				$this->load->model('account/address');
				if (isset($this->session->data['shipping_address_id'])) {
					$shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
				} else {
					$addressId = $this->s->cell("SELECT `address_id` FROM ".DB_PREFIX."address WHERE customer_id = :c: LIMIT 1", array('c' => $this->customer->getId()));
					$shipping_address = $this->model_account_address->getAddress($addressId);
				}
			} else {
				$shipping_address = array(
					'firstname' => '',
					'lastname' => '',
					'company' => '',
					'address_1' => '',
					'address_2' => '',
					'city' => '',
					'postcode' => '',
					'zone' => '',
					'zone_id' => '',
					'country' => '',
					'country_id' => '',
					'address_format' => '',
					);
			}
			$data['shipping_firstname']      = $shipping_address['firstname'];
			$data['shipping_lastname']       = $shipping_address['lastname'];
			$data['shipping_company']        = $shipping_address['company'];
			$data['shipping_address_1']      = $shipping_address['address_1'];
			$data['shipping_address_2']      = $shipping_address['address_2'];
			$data['shipping_city']           = $shipping_address['city'];
			$data['shipping_postcode']       = $shipping_address['postcode'];
			$data['shipping_zone']           = $shipping_address['zone'];
			$data['shipping_zone_id']        = $shipping_address['zone_id'];
			$data['shipping_country']        = $shipping_address['country'];
			$data['shipping_country_id']     = $shipping_address['country_id'];
			$data['shipping_address_format'] = $shipping_address['address_format'];
			if (isset($this->session->data['shipping_method']['title'])) {
				$data['shipping_method'] = $this->session->data['shipping_method']['title'];
			} else {
				$data['shipping_method'] = '';
			}
			if (isset($this->session->data['shipping_method']['code'])) {
				$data['shipping_code'] = $this->session->data['shipping_method']['code'];
			} else {
				$data['shipping_code'] = '';
			}
		} else {
			$data['shipping_firstname']      = '';
			$data['shipping_lastname']       = '';
			$data['shipping_company']        = '';
			$data['shipping_address_1']      = '';
			$data['shipping_address_2']      = '';
			$data['shipping_city']           = '';
			$data['shipping_postcode']       = '';
			$data['shipping_zone']           = '';
			$data['shipping_zone_id']        = '';
			$data['shipping_country']        = '';
			$data['shipping_country_id']     = '';
			$data['shipping_address_format'] = '';
			$data['shipping_method']         = '';
			$data['shipping_code']           = '';
		}
		$product_data = array();
		foreach ($this->cart->getProducts() as $product) {

			$option_data = array();
			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					if (defined('VERSION') && '2.' == substr(VERSION, 0, 2)) {
						$value = $option['value'];
					} else {
						$value = $option['option_value'];
					}
				} else {
					if (defined('VERSION') && '2.' == substr(VERSION, 0, 2)) {
						$value = $this->encryption->decrypt($option['value']);
					} else {
						$value = $this->encryption->decrypt($option['option_value']);
					}
				}
				$option_data[] = array('product_option_id' => $option['product_option_id'],'product_option_value_id' => $option['product_option_value_id'],'option_id' => $option['option_id'],'option_value_id' => $option['option_value_id'],'name' => $option['name'],'value' => $value,'type' => $option['type']);
			}
			$product_data[] = array('product_id' => $product['product_id'],'name' => $product['name'],'model' => $product['model'],'option' => $option_data,'download' => $product['download'],'quantity' => $product['quantity'],'subtract' => $product['subtract'],'price' => $product['price'],'total' => $product['total'],'tax' => $this->tax->getTax($product['price'],$product['tax_class_id']),'reward' => $product['reward']);
		}

		$data['products'] = $product_data;
		$data['vouchers'] = array();
		$data['totals']   = $total_data;
		$data['comment']  = empty($customer['comment']) ? '' : $customer['comment'];
		$data['total']    = $total;
		if (isset($this->request->cookie['tracking'])) {
			$this->load->model('affiliate/affiliate');
			$affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);
			$subtotal = $this->cart->getSubTotal();
			if ($affiliate_info) {
				$data['affiliate_id'] = $affiliate_info['affiliate_id'];
				$data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
			} else {
				$data['affiliate_id'] = 0;
				$data['commission'] = 0;
			}
		} else {
			$data['affiliate_id'] = 0;
			$data['commission'] = 0;
		}
		$data['language_id']    = $this->config->get('config_language_id');
		$data['currency_id'] = $this->currency->getId($this->session->data['currency']);
		$data['currency_code'] = $this->session->data['currency'];
		$data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
		$data['ip']             = $this->request->server['REMOTE_ADDR'];
		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$data['forwarded_ip'] = '';
		}
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$data['user_agent'] = '';
		}
		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$data['accept_language'] = '';
		}

		$data['marketing_id'] = '';
		$data['tracking'] = '';

		$orderId = $this->m('checkout/order')->addOrder($data);
		
		$this->m('checkout/order')->addOrderHistory($orderId, $this->c('occm_order_status_id'));
		
		return $orderId;
	}
}
?>