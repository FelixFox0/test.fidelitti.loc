<?php
class ControllerXCheckoutXCVC extends Controller {
	public $data='';
	public function index() {
		$this->language->load('checkout/checkout');
		$this->data['text_comments'] = $this->language->get('text_comments');
		$this->data['button_continue'] = $this->language->get('button_continue');

		if (isset($this->session->data['comment'])) {
			$this->data['comment'] = $this->session->data['comment'];
		} else {
			$this->data['comment'] = '';
		}
		$points = $this->customer->getRewardPoints();

		$points_total = 0;

		foreach ($this->cart->getProducts() as $product) {
			if ($product['points']) {
				$points_total += $product['points'];
			}
		}
		$this->data['reward_status'] = ($points && $points_total && $this->config->get('reward_status'));
		if (isset($this->session->data['reward'])) {
			$this->data['reward_value'] = $this->session->data['reward'];
		} else {
			$this->data['reward_value'] = '';
		}
		if($this->xtensions->isOpencartTwo()){
			if($this->xtensions->isNewCustomerPath()){
				$this->language->load('total/reward');
			}else{
				$this->language->load('checkout/reward');
			}
			$this->data['text_use_reward'] = sprintf($this->language->get('heading_title'), $points);
		}else{
			$this->language->load('checkout/cart');
			$this->data['text_use_reward'] = sprintf($this->language->get('text_use_reward'), $points);
		}
		$this->data['entry_reward'] = sprintf($this->language->get('entry_reward'), $points_total);

		$this->language->load('account/xtensions');
		$this->data['coupon_apply_text'] = $this->language->get('coupon_apply_text');
		$this->data['coupon_text'] = $this->language->get('coupon_text');
		$this->data['coupon_placeholder'] = $this->language->get('coupon_placeholder');
		$this->data['voucher_apply_text'] = $this->language->get('voucher_apply_text');
		$this->data['voucher_text'] = $this->language->get('voucher_text');
		$this->data['voucher_placeholder'] = $this->language->get('voucher_placeholder');
		$this->data['reward_apply_text'] = $this->language->get('reward_apply_text');
		$this->data['reward_text'] = $this->language->get('reward_text');
		$this->data['comment_apply_text'] = $this->language->get('comment_apply_text');
		$this->data['comment_text'] = $this->language->get('comment_text');

		if(!empty($this->session->data['voucher'])){
			$this->data['voucher_value']=$this->session->data['voucher'];
		}else{
			$this->data['voucher_value']='';
		}
			
		if(!empty($this->session->data['coupon'])){
			$this->data['coupon_value']=$this->session->data['coupon'];
		}else{
			$this->data['coupon_value']='';
		}

		$this->template = 'xtensions/template/checkout/xcvc.tpl';

		return $this->xtensions->renderView($this);
	}

	public function xoptions(){
		$this->data['modData'] = $this->xtensions->getModData();
		$this->language->load('account/xtensions');
		$this->data['text_options'] = $this->language->get('text_options');
		$this->data['coupon_apply_text'] = $this->language->get('coupon_apply_text');
		$this->data['coupon_text'] = $this->language->get('coupon_text');
		$this->data['voucher_apply_text'] = $this->language->get('voucher_apply_text');
		$this->data['voucher_text'] = $this->language->get('voucher_text');
		$this->data['reward_apply_text'] = $this->language->get('reward_apply_text');
		$this->data['reward_text'] = $this->language->get('reward_text');
		$this->data['comment_apply_text1'] = $this->language->get('comment_apply_text1');
		$this->data['comment_text'] = $this->language->get('comment_text');

		$points = $this->customer->getRewardPoints();

		$points_total = 0;

		foreach ($this->cart->getProducts() as $product) {
			if ($product['points']) {
				$points_total += $product['points'];
			}
		}
		$this->data['reward_status'] = ($points && $points_total && $this->config->get('reward_status'));
		$this->template = 'xtensions/template/checkout/xoptions.tpl';
		return $this->xtensions->renderView($this);
	}

	public function xtotals(){
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->language->load('account/xtensions');
		$this->data['text_totals'] = $this->language->get('text_totals');
		$this->language->load('checkout/checkout');
		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();
		if($isOpencartTwo){
			$this->load->model('extension/extension');
			$results = $this->model_extension_extension->getExtensions('total');
		}else{
			$this->load->model('setting/extension');
			$results = $this->model_setting_extension->getExtensions('total');
		}
		$sort_order = array();

		foreach ($results as $key => $value) {
			$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
		}

		array_multisort($sort_order, SORT_ASC, $results);

		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {
				$this->load->model('total/' . $result['code']);

				$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
			}
		}

		$sort_order = array();

		foreach ($total_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $total_data);
		if($isOpencartTwo){
			$this->data['totals'] = array();
			foreach ($total_data as $total) {
				$this->data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value']),
				);
			}
		}else{
			$this->data['totals'] = $total_data;
		}
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_model'] = $this->language->get('column_model');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->template = 'xtensions/template/checkout/xtotals.tpl';
		return $this->xtensions->renderView($this);
	}



	public function validateCoupon() {
		$json = array();
		if($this->xtensions->isNewCustomerPath()){
			$this->load->model('total/coupon');
			$coupon_info = $this->model_total_coupon->getCoupon($this->request->post['coupon']);
		}else{
			$this->load->model('checkout/coupon');
			$coupon_info = $this->model_checkout_coupon->getCoupon($this->request->post['coupon']);
		}

		$this->language->load('account/xtensions');
		if ($coupon_info) {
			$this->session->data['coupon'] = $this->request->post['coupon'];
			$json['applied']=$this->language->get('coupon_successful');
		}else if(!empty($this->session->data['coupon']) && !$this->request->post['coupon']) {
			unset($this->session->data['coupon']);
			$json['applied']=$this->language->get('coupon_removed');
		}else if(!$this->request->post['coupon']) {
			unset($this->session->data['coupon']);
			$json['error']['error']=$this->language->get('coupon_blank');
		}else{
			unset($this->session->data['coupon']);
			$json['error']['error']=$this->language->get('coupon_invalid');
		}
		$child = $this->xtensions->getChildren(array('xcheckout/xcvc/xtotals'));
		$json['xtotals'] = $child['xtotals'];
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function validateVoucher() {
		$json = array();
		if($this->xtensions->isNewCustomerPath()){
			$this->load->model('total/voucher');
			$voucher_info = $this->model_total_voucher->getVoucher($this->request->post['voucher']);
		}else{
			$this->load->model('checkout/voucher');
			$voucher_info = $this->model_checkout_voucher->getVoucher($this->request->post['voucher']);
		}
		
		$this->language->load('account/xtensions');
		if ($voucher_info) {
			$this->session->data['voucher'] = $this->request->post['voucher'];
			$json['applied']=$this->language->get('voucher_successful');
		}else if(!empty($this->session->data['voucher']) && !$this->request->post['voucher']) {
			unset($this->session->data['voucher']);
			$json['applied']=$this->language->get('voucher_removed');
		}else if(!$this->request->post['voucher']) {
			unset($this->session->data['voucher']);
			$json['error']['error']=$this->language->get('voucher_blank');
		}else{
			unset($this->session->data['voucher']);
			$json['error']['error']=$this->language->get('voucher_invalid');
		}
		$child = $this->xtensions->getChildren(array('xcheckout/xcvc/xtotals'));
		$json['xtotals'] = $child['xtotals'];
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function validateReward() {
		$json = array();
		$this->language->load('account/xtensions');
		$points = $this->customer->getRewardPoints();

		$points_total = 0;

		foreach ($this->cart->getProducts() as $product) {
			if ($product['points']) {
				$points_total += $product['points'];
			}
		}

		if (empty($this->request->post['reward']) && isset($this->session->data['reward'])) {
			unset($this->session->data['reward']);
			$json['applied'] = $this->language->get('reward_removed');
		}else if(empty($this->request->post['reward'])){
			unset($this->session->data['reward']);
			$json['error']['error'] = $this->language->get('reward_blank');
		}else if ($this->request->post['reward'] > $points) {
			$json['error']['error'] = sprintf($this->language->get('reward_error_points'), $this->request->post['reward']);
		}else if ($this->request->post['reward'] > $points_total) {
			$json['error']['error'] = sprintf($this->language->get('reward_maximum'), $points_total);
		}else{
			$json['applied'] = $this->language->get('reward_successful');
			$this->session->data['reward'] = abs($this->request->post['reward']);
		}
		$child = $this->xtensions->getChildren(array('xcheckout/xcvc/xtotals'));
		$json['xtotals'] = $child['xtotals'];
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function addComment() {
		$json = array();
		$this->language->load('account/xtensions');
		$this->session->data['comment'] = strip_tags($this->request->post['comment']);
		$json['applied']=$this->language->get('comment_saved');
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>