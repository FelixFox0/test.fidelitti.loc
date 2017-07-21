<?php
class ControllerAndroidStoreNotification extends Controller {
	public function index() {
		
		$show_notification = false;
		
		if (isset($this->request->get['notification_id']) && (!isset($this->session->data['notification_id']) || $this->session->data['notification_id'] != $this->request->get['notification_id'])) {			
			$this->load->model('android_store/device');
			
			$notification_info = $this->model_android_store_device->getPushNotification($this->request->get['notification_id']);
			
			if ($notification_info) {
				$data['notification_title'] = html_entity_decode($notification_info['short_title'], ENT_QUOTES, 'UTF-8'); 
				$data['notification_extended_description'] = html_entity_decode($notification_info['extended_description'], ENT_QUOTES, 'UTF-8'); 
			}
			
			$this->session->data['notification_id'] = $this->request->get['notification_id'];
			$show_notification = true;			
		}

		if ($show_notification) {
			return $this->load->view('android_store/notification', $data);
		}	
	}
}