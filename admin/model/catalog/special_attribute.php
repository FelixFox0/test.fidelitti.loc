<?php
class ModelCatalogSpecialAttribute extends Model {
	public function doesExist($special_attribute_name, $special_attribute_group_id)	
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "special_attribute WHERE special_attribute_name = '" . $special_attribute_name . "' AND special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");

		return (int)($query->row['total']) > 0;
	}

	public function getAllSpecialAttribute($special_attribute_group_id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_attribute WHERE special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");
		
		return $query->rows;
	}
	
	public function addSpecialAttribute($data) {
		$this->db->query("INSERT INTO "
		. DB_PREFIX . "special_attribute "
		. "SET special_attribute_name = '" . $data['special_attribute_name'] . "'"
		. ", special_attribute_value = '" . $data['special_attribute_value'] . "'"
		. ", special_attribute_group_id = '" . $data['special_attribute_group_id'] . "'");
			
		$special_attribute_id = $this->db->getLastId();
		
		$this->cache->delete('special_attribute');
		
		return $special_attribute_id;
	}
	
	public function getImageId($data)
	{
		$special_att_id = $this->getFirstId($data['product_series_image'], $data['special_attribute_group_id']);
	
		if($special_att_id == -1)
		{
			$special_att_id = $this->addSpecialAttribute(array(
				'special_attribute_name' => $data['product_series_image'],
				'special_attribute_value' => $data['product_series_image'],
				'special_attribute_group_id' => '2'
			));
		}
	
		return $special_att_id;
	}
	
	public function getFirstId($special_attribute_name, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "special_attribute WHERE special_attribute_name = '" . $special_attribute_name . "' AND special_attribute_group_id = '" . (int)$special_attribute_group_id . "' LIMIT 1");

		if(count($query->rows) > 0)	
			return (int)($query->row['special_attribute_id']);
		
		return -1;
	}
}
?>