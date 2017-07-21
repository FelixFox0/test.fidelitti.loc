<?php 
class ControllerAndroidStoreDeviceRegister extends Controller {
	private $error = array();
	      
  	public function index() {
		$this->load->model('android_store/device');
		
		if (isset($this->request->get['device_token'])) {
			if ($this->model_android_store_device->getTotalDevicesByRegID($this->request->get['device_token']) == 0) {
				$this->model_android_store_device->registerDevice($this->request->get);
			}
		} 		
  	}	
}
?>