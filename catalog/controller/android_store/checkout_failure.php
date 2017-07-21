<?php
class ControllerAndroidStoreCheckoutFailure extends Controller {
	public function index() {
		$this->load->language('checkout/failure');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('android_store/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('android_store/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('android_store/checkout', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_failure'),
			'href' => $this->url->link('android_store/failure')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));

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