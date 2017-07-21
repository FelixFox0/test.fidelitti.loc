<?php
class ControllerExtensionModuleASFeatured extends Controller {
	public function index($setting) {
		static $module = 0; 
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/androidstore_owl_carousel.js');
		
		// custom css
		if (file_exists(DIR_TEMPLATE . $this->config->get('android_store_template') . '/stylesheet/owl.theme.androidstore-module.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('android_store_template') . '/stylesheet/owl.theme.androidstore-module.css');
		} else {
			$this->document->addStyle('catalog/view/theme/android_store_default/stylesheet/owl.theme.androidstore-module.css');
		}
		
		$heading_titles = $setting['title'];		
		
		if (isset($heading_titles[$this->config->get('config_language_id')])) {
			$data['heading_title'] = $heading_titles[$this->config->get('config_language_id')];
		} else {
			$data['heading_title'] = '';
		}
		
		$data['button_cart'] = $this->language->get('button_cart');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}

					if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$data['products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('android_store_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('android_store/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		}	

		$data['module'] = $module++;
		
		if ($data['products']) {
			return $this->load->view('extension/module/as_featured', $data);
		}
	}
}