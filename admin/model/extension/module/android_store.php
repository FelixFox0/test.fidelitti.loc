<?php
class ModelExtensionModuleAndroidStore extends Model {
	public function createTables() {
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "as_device` (
				  `device_id` int(11) NOT NULL AUTO_INCREMENT,
				  `device_token` varchar(256) CHARACTER SET utf8 NOT NULL,
				  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  PRIMARY KEY (`device_id`)
				);";
		
		$this->db->query($sql);
		
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "as_push_notification` (
				  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
				  `short_title` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `short_description` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `extended_description` text CHARACTER SET utf8 NOT NULL,
				  `redirect_route` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `redirect_param` varchar(255) CHARACTER SET utf8 NOT NULL,
				  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  PRIMARY KEY (`notification_id`)
				);";
		
		$this->db->query($sql);
	}
	
	public function createAndroidStoreLayout(){
		$store_id = (int)$this->config->get('config_store_id');
		
		$as_layouts = array(
					array(
						'name'   =>  'Android Store - Home',
						array(
							'store_id'  => $store_id,
							'route'     => 'android_store/home'
						)
					),
					array(
						'name'   =>  'Android Store - Product',
						array(
							'store_id'  => $store_id,
							'route'     => 'android_store/product'
						)
					),
					array(
						'name'   =>  'Android Store - Search',
						array(
							'store_id'  => $store_id,
							'route'     => 'android_store/search'
						)
					),
					array(
						'name'   =>  'Android Store - Category',
						array(
							'store_id'  => $store_id,
							'route'     => 'android_store/category'
						)
					)
		);
	
	
		foreach($as_layouts as $as_layout) {
			if ( $this->getLayoutByRoute($as_layout[0]['route']) == 0 ) {  // check if route already exist
				$this->load->model('design/layout');
				
				$layout_route = array();
				$layout_route[0] =  array (
						'store_id' => $store_id,
						'route'    => $as_layout[0]['route']
					);
				
				$data = array(
					'name'         => $as_layout['name'],
					'layout_route' => $layout_route
				);
				
				$this->model_design_layout->addLayout($data);
			}
		}	
	}
	
	public function getLayoutByRoute($route){
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "layout_route WHERE route='" . $route . "'";
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	// PUSH NOTIFICATION
	public function addPushNotification($data) {
		$sql = "INSERT INTO " . DB_PREFIX . "as_push_notification
				SET short_title            = '" . $this->db->escape($data['title']) . "',
					short_description      = '" . $this->db->escape($data['short_description']) . "',
					extended_description   = '" . $this->db->escape($data['extended_description']) . "',
					redirect_route         = '" . $this->db->escape($data['redirect_route']) . "', ";
		
		if ($data['redirect_route'] == "product") {
			$sql .= "redirect_param ='" . $this->db->escape($data['selected_product']) . "', ";
		}
		
		if ($data['redirect_route'] == "category") {
			$sql .= "redirect_param ='" . $this->db->escape($data['selected_category']) . "', ";
		}
					
		$sql .= "date_added        = NOW()";
					
		$this->db->query($sql);	
	}
	
	public function getPushNotification($notification_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "as_push_notification WHERE notification_id = '" . $notification_id . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function getLastNotificationID() {
		$sql = "SELECT notification_id FROM " . DB_PREFIX . "as_push_notification ORDER BY notification_id DESC LIMIT 0,1";
		
		$query = $this->db->query($sql);
		
		return $query->row['notification_id'];
	}
	
	public function getRegisteredDevices() {
		$registered_devices = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "as_device");
		
		if ($query->num_rows) {
			foreach($query->rows as $device) {
				$registered_devices[] = $device['device_token']; 
			}
		}
		
		return $registered_devices;
	}
	
	public function getTotalRegisteredDevices() {
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "as_device");
		
		return $query->row['total'];
	}
	
	public function generatePushData($push_notification_info) {
		
		$push_data = array(
			'notification_id'   => $push_notification_info['notification_id'],
			'short_title'       => html_entity_decode($push_notification_info['short_title'], ENT_QUOTES, 'UTF-8'),
			'short_description' => html_entity_decode($push_notification_info['short_description'], ENT_QUOTES, 'UTF-8'),
			'redirect_route'    => $push_notification_info['redirect_route'],
			'redirect_param'    => $push_notification_info['redirect_param']
		);
		
		return $push_data;
	}
}
?>