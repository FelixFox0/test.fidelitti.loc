<?php
class ControllerExtensionModuleASSpecial extends Controller {
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

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);		
		
		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('android_store_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('android_store/product', 'product_id=' . $result['product_id']),
				);
			}
			
			$data['module'] = $module++;
			
			return $this->load->view('extension/module/as_special', $data);
		}
	}
}