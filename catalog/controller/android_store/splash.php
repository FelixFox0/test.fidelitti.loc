<?php
class ControllerAndroidStoreSplash extends Controller {
	public function index() {
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		if (is_file(DIR_IMAGE . $this->config->get('android_store_splash_logo'))) {
			$splash_logo = $server . 'image/' . $this->config->get('android_store_splash_logo');
		} else {
			$splash_logo = '';
		}
		
		$data['show_splash'] = false;
		
		if ($this->config->get('android_store_splash_status') && isset($this->request->get['splash']) && !empty($splash_logo) && (!isset($this->session->data['splash']) || $this->session->data['splash'] != $this->request->get['splash'])) {
			$data['show_splash'] = true;
			$this->session->data['splash'] = $this->request->get['splash'];
		}
		
		$data['splash_logo'] = $splash_logo;
		$data['splash_background'] = $this->config->get('android_store_splash_background_color');

		return $this->load->view('android_store/splash', $data);
	}
}