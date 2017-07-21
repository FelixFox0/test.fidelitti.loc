<?php
class ControllerAndroidStoreMenuTop extends Controller { 
	public function index() {
		$this->load->language('android_store/menu_top');

		$data['name'] = $this->config->get('config_name');
		$data['text_looking_for'] = $this->language->get('text_looking_for');
		
		$data['home'] = $this->url->link('android_store/home');
		$data['category_list'] = $this->url->link('android_store/category_list');
		$data['shopping_cart'] = $this->url->link('android_store/cart');
		
		$data['cart_total_items'] = $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0);
		
		if ($this->config->get('android_store_menu_type')) {
			$data['menu_type'] = $this->config->get('android_store_menu_type');
		} else {
			$data['menu_type'] = 'user-name-search-category-cart'; 
		}
		
		return $this->load->view('android_store/menu_top', $data);
	}
}