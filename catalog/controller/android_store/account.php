<?php
class ControllerAndroidStoreAccount extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('android_store/account', '', true);

			$this->response->redirect($this->url->link('android_store/login', '', true));
		}

		$this->load->language('account/account');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('android_store/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('android_store/account', '', true)
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_my_account'] = $this->language->get('text_my_account');
		$data['text_my_orders'] = $this->language->get('text_my_orders');
		$data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
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

		$data['edit'] = $this->url->link('android_store/edit', '', true);
		$data['password'] = $this->url->link('android_store/password', '', true);
		$data['address'] = $this->url->link('android_store/address', '', true);
		
		$data['credit_cards'] = array();
		
		$files = glob(DIR_APPLICATION . 'controller/android_store/credit_card_*.php');
		
		foreach ($files as $file) {
			$code = str_replace("credit_card_", "", basename($file, '.php'));
			
			if ($this->config->get($code . '_status') && $this->config->get($code)) {
				$this->load->language('extension/credit_card/' . $code);

				$data['credit_cards'][] = array(
					'name' => $this->language->get('heading_title'),
					'href' => $this->url->link('android_store/credit_card_' . $code, '', true)
				);
			}
		}		
		
		$data['wishlist'] = $this->url->link('android_store/wishlist');
		$data['order'] = $this->url->link('android_store/order', '', true);
		$data['download'] = $this->url->link('android_store/download', '', true);
		$data['return'] = $this->url->link('android_store/return', '', true);
		$data['transaction'] = $this->url->link('android_store/transaction', '', true);
		$data['newsletter'] = $this->url->link('android_store/newsletter', '', true);
		$data['recurring'] = $this->url->link('android_store/recurring', '', true);

		$data['back'] = $this->url->link('android_store/home', '', true);

		if ($this->config->get('reward_status')) {
			$data['reward'] = $this->url->link('android_store/reward', '', true);
		} else {
			$data['reward'] = '';
		}

		$data['column_left'] = false;
		$data['column_right'] = false;
		$data['content_top'] = $this->load->controller('android_store/content_top');
		$data['content_bottom'] = $this->load->controller('android_store/content_bottom');
		$data['footer'] = $this->load->controller('android_store/footer');
		$data['header'] = $this->load->controller('android_store/header');

		$this->response->setOutput($this->load->view('android_store/account', $data));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}