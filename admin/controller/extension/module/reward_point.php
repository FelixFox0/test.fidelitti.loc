<?php
class ControllerExtensionModuleRewardPoint extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/reward_point');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('view/stylesheet/switch_button.css');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('reward_point', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_registration'] = $this->language->get('entry_registration');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_firstorder'] = $this->language->get('entry_firstorder');
		$data['entry_reviews'] = $this->language->get('entry_reviews');
		$data['entry_unsubscribe'] = $this->language->get('entry_unsubscribe');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['help_registration'] = $this->language->get('help_registration');
		$data['help_newsletter'] = $this->language->get('help_newsletter');
		$data['help_firstorder'] = $this->language->get('help_firstorder');
		$data['help_reviews'] = $this->language->get('help_reviews');
		$data['help_unsubscribe'] = $this->language->get('help_unsubscribe');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/reward_point', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/reward_point', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->post['reward_point_registration'])){
			$data['reward_point_registration'] = $this->request->post['reward_point_registration'];
		} else {
			$data['reward_point_registration'] = $this->config->get('reward_point_registration');
		}

		if (isset($this->request->post['reward_point_registration_status'])) {
			$data['reward_point_registration_status'] = $this->request->post['reward_point_registration_status'];
		} else {
			$data['reward_point_registration_status'] = $this->config->get('reward_point_registration_status');
		}
		
		if (isset($this->request->post['reward_point_newsletter'])){
			$data['reward_point_newsletter'] = $this->request->post['reward_point_newsletter'];
		} else {
			$data['reward_point_newsletter'] = $this->config->get('reward_point_newsletter');
		}

		if (isset($this->request->post['reward_point_newsletter_status'])) {
			$data['reward_point_newsletter_status'] = $this->request->post['reward_point_newsletter_status'];
		} else {
			$data['reward_point_newsletter_status'] = $this->config->get('reward_point_newsletter_status');
		}
		
		if (isset($this->request->post['reward_point_firstorder'])){
			$data['reward_point_firstorder'] = $this->request->post['reward_point_firstorder'];
		} else {
			$data['reward_point_firstorder'] = $this->config->get('reward_point_firstorder');
		}

		if (isset($this->request->post['reward_point_firstorder_status'])) {
			$data['reward_point_firstorder_status'] = $this->request->post['reward_point_firstorder_status'];
		} else {
			$data['reward_point_firstorder_status'] = $this->config->get('reward_point_firstorder_status');
		}
		
		if (isset($this->request->post['reward_point_reviews'])){
			$data['reward_point_reviews'] = $this->request->post['reward_point_reviews'];
		} else {
			$data['reward_point_reviews'] = $this->config->get('reward_point_reviews');
		}

		if (isset($this->request->post['reward_point_reviews_status'])) {
			$data['reward_point_reviews_status'] = $this->request->post['reward_point_reviews_status'];
		} else {
			$data['reward_point_reviews_status'] = $this->config->get('reward_point_reviews_status');
		}
		
		if (isset($this->request->post['reward_point_unsubscribe'])){
			$data['reward_point_unsubscribe'] = $this->request->post['reward_point_unsubscribe'];
		} else {
			$data['reward_point_unsubscribe'] = $this->config->get('reward_point_unsubscribe');
		}

		if (isset($this->request->post['reward_point_status'])) {
			$data['reward_point_status'] = $this->request->post['reward_point_status'];
		} else {
			$data['reward_point_status'] = $this->config->get('reward_point_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/reward_point', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/reward_point')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
