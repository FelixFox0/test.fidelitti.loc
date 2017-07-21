<?php
class ControllerAndroidStoreLogout extends Controller {
	public function index() {
		if ($this->customer->isLogged()) {
			$this->customer->logout();

			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_address']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			$this->event->trigger('post.customer.logout');

			$this->response->redirect($this->url->link('android_store/logout', '', true));
		}

		$this->load->language('account/logout');

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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_logout'),
			'href' => $this->url->link('android_store/logout', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = $this->language->get('text_message');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('android_store/home');

		$data['column_left'] = false;
		$data['column_right'] = false;
		$data['content_top'] = $this->load->controller('android_store/content_top');
		$data['content_bottom'] = $this->load->controller('android_store/content_bottom');
		$data['footer'] = $this->load->controller('android_store/footer');
		$data['header'] = $this->load->controller('android_store/header');

		$this->response->setOutput($this->load->view('android_store/success', $data));
	}
}