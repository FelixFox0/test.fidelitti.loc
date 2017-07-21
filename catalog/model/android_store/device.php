<?php
class ModelAndroidStoreDevice extends Model {

	public function registerDevice($data = array()) {
		$sql = "INSERT INTO " . DB_PREFIX . "as_device
				SET device_token = '" . $this->db->escape($data['device_token']) . "',
					date_added   = NOW()";
					
		$this->db->query($sql);			
	}
	
	public function getTotalDevicesByRegID($device_token) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "as_device
				WHERE device_token = '" . $this->db->escape($device_token) . "'";

		$query = $this->db->query($sql);

		return $query->row['total'];	
	}
	
	public function getPushNotification($notification_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "as_push_notification WHERE notification_id = '" . $notification_id ."'";
	
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function setAuth($code, $data, $store_id = 0) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'");

		foreach($data as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
		}	
	}
}
?>