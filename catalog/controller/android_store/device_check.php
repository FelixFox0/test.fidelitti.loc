<?php
class ControllerAndroidStoreDeviceCheck extends Controller { 
	public function index() {
		$data = array();
		
		return $this->load->view('android_store/device_check', $data);
	}
}