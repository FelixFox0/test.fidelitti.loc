<?php
class ControllerAndroidStoreCartTop extends Controller {
	public function index() {
		$data['text_items'] = $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0);

		$data['cart'] = $this->url->link('android_store/cart');

		return $this->load->view('android_store/cart_top', $data);
	}

	public function info() {
		$this->response->setOutput($this->index());
	}
}