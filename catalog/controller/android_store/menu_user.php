<?php
class ControllerAndroidStoreMenuUser extends Controller { 
	public function index() {
		$this->load->language('android_store/menu_user');

		$data['text_login'] = $this->language->get('text_login');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_logout'] = $this->language->get('text_logout');
		
		$data['text_home'] = $this->language->get('text_home');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_checkout'] = $this->language->get('text_checkout');
		
		$data['text_language'] = $this->language->get('text_language');
		$data['text_currency'] = $this->language->get('text_currency');
		
		$data['text_special'] = $this->language->get('text_special');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_contact'] = $this->language->get('text_contact');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_download'] = $this->language->get('text_download');		
		$data['text_reward'] = $this->language->get('text_reward');		
		$data['text_return'] = $this->language->get('text_return');				
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_recurring'] = $this->language->get('text_recurring');		

		$data['login'] = $this->url->link('android_store/login', '', true);
		$data['register'] = $this->url->link('android_store/register', '', true);
		$data['logout'] = $this->url->link('android_store/logout', '', true);
		
		$data['home'] = $this->url->link('android_store/home');
		$data['account'] = $this->url->link('android_store/account', '', true);
		$data['shopping_cart'] = $this->url->link('android_store/cart');
		$data['checkout'] = $this->url->link('android_store/checkout', '', true);
		
		$data['edit'] = $this->url->link('android_store/edit', '', true);
		$data['password'] = $this->url->link('android_store/password', '', true);
		$data['address'] = $this->url->link('android_store/address', '', true);
		$data['wishlist'] = $this->url->link('android_store/wishlist', '', true);
		$data['order'] = $this->url->link('android_store/order', '', true);
		$data['download'] = $this->url->link('android_store/download', '', true);
		$data['reward'] = $this->url->link('android_store/reward', '', true);
		$data['return'] = $this->url->link('android_store/return', '', true);
		$data['transaction'] = $this->url->link('android_store/transaction', '', true);
		$data['newsletter'] = $this->url->link('android_store/newsletter', '', true);
		$data['recurring'] = $this->url->link('android_store/recurring', '', true);
		
		$data['special'] = $this->url->link('android_store/special', '', true);
		
		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('android_store/information', 'information_id=' . $result['information_id'])
				);
			}
		}
		
		$data['contact'] = $this->url->link('android_store/contact');
		
		$data['logged'] = $this->customer->isLogged();
		$data['customer_name'] = $this->customer->getFirstName() . ' ' . $this->customer->getLastName();	
		
		$data['language'] = $this->load->controller('android_store/language');
		$data['currency'] = $this->load->controller('android_store/currency');
		
		return $this->load->view('android_store/menu_user', $data);
	}
}