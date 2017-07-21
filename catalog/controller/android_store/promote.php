<?php
class ControllerAndroidStorePromote extends Controller {
	public function index() {
		$show_promote = false;
		
		if ($this->config->get('android_store_promote_status') && isset($this->request->server['HTTP_USER_AGENT']) && (!isset($this->session->data['promote']) || $this->session->data['promote'] == 1)) {
			$browser = new Browser($this->request->server['HTTP_USER_AGENT']);
			
			if ( $browser->getPlatform() == 'Android') {
				$promote_messages = $this->config->get('android_store_promote_message');
				
				if (isset($promote_messages[$this->config->get('config_language_id')]['message'])) {
					$data['message'] = $promote_messages[$this->config->get('config_language_id')]['message'];
					$data['link'] = $this->config->get('android_store_google_play_link');
				
					$this->session->data['promote'] = 1;
					$show_promote = true;
				}
			}
		}
		
		$data['background_color'] = $this->config->get('android_store_promote_background');
		$data['text_color'] = $this->config->get('android_store_promote_color');

		if ($show_promote) {
			return $this->load->view('android_store/promote', $data);
		}
	}
	
	public function disable() {
		$json =  array();
		
		if (isset($this->session->data['promote'])){
			$this->session->data['promote'] = 0;
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}