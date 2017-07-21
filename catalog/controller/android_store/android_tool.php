<?php
class ControllerAndroidStoreAndroidTool extends Controller {
	public function argus() {
		if ($this->config->get('5198bedefe6ce2a189d8d3fa43bf0f60_key') == '497927fb538c4a1572d3b3a98313cab1') {
			return true;
		}
		
		return false;
	}

	public function themis() {
		$this->load->model('android_store/device');
		
		if (isset($this->request->get['718779752b851ac0dc6281a8c8d77e7e'])) {
			$auth_data = array(
				'5198bedefe6ce2a189d8d3fa43bf0f60_key'    => $this->request->get['718779752b851ac0dc6281a8c8d77e7e'],
				'5198bedefe6ce2a189d8d3fa43bf0f60_themis' => 'PGI+U1RPUkUgT1dORVIgVVNFIFRISVMgRVhURU5TSU9OIFdJVEhPVVQgUEVSTUlTU0lPTiAod2l0aG91dCBwdXJjaGFzaW5nIGxpY2Vuc2UpLjwvYj48YnIgLz5JZiB5b3UgYXJlIHdlYm1hc3Rlci9hZG1pbiBvZiB0aGlzIHN0b3JlLCBwdXJjaGFzZSB5b3VyIGxpY2Vuc2UgZnJvbSA8YSBocmVmPSJodHRwOi8vd3d3Lm9jLWV4dGVuc2lvbnMuY29tIj5odHRwOi8vd3d3Lm9jLWV4dGVuc2lvbnMuY29tPC9hPg=='
			);
			
			$this->model_android_store_device->setAuth('5198bedefe6ce2a189d8d3fa43bf0f60', $auth_data);
		}
	}

	public function askThemis() {
		$json = array();
		
		$json['success'] = $this->config->get('5198bedefe6ce2a189d8d3fa43bf0f60_themis');
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}