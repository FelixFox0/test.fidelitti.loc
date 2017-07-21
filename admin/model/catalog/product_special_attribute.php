<?php
class ModelCatalogProductSpecialAttribute extends Model {
	public function addProductSpecialAttribute($data)	
	{
		$this->db->query("INSERT INTO "
		. DB_PREFIX . "product_special_attribute "
		. "SET product_id = '" . (int)$data['product_id'] . "'"
		. ", special_attribute_id = '" . (int)$data['special_attribute_id'] . "'");
		
		$this->cache->delete('product_special_attribute');
	}
	
	public function editProductSpecialAttribute($data)	
	{
		$this->deleteProductSpecialAttribute($data);	
		$this->addProductSpecialAttribute($data);
	}
	
	public function deleteProductSpecialAttribute($data)
	{
		$this->db->query("DELETE FROM "
		. DB_PREFIX . "product_special_attribute "
		. " WHERE product_id = '" . (int)$data['product_id'] . "'");
		
		$this->cache->delete('product_special_attribute');
	}
	
	public function getProductSpecialAttribute($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT * "
		. " FROM " . DB_PREFIX . "product_special_attribute psa"
		. " LEFT JOIN " . DB_PREFIX . "special_attribute sa"
		. " ON sa.special_attribute_id = psa.special_attribute_id"
		. " WHERE psa.product_id = '" . (int)$product_id . "'"
		. " AND sa.special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");
		
		if(count($query->rows) > 0)	
			return $query->row;
		
		return null;
	}
}
?>