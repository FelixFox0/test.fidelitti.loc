<?php
class ModelCatalogProductMaster extends Model {
	public function getMasterProductId($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT master_product_id FROM "
		. DB_PREFIX . "product_master "
		. " WHERE product_id = '" . (int)$product_id . "' "
		. " AND special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");
	
		if(count($query->rows) > 0)	
			return $query->row['master_product_id'];
		
		return '-1';
	}
	
	public function isMaster($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT master_product_id FROM "		
		. DB_PREFIX . "product_master "
		. " WHERE product_id = '" . (int)$product_id . "' "
		. " AND special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");

		if(count($query->rows) > 0)	
			return (int)($query->row['master_product_id']) == 0;
		
		return 0;
	}
	
	public function getLinkedProducts($product_id, $special_attribute_group_id, $include_master_product)
	{
		$linked_product_data = array();
		
		$master_product_id = $this->getMasterProductId($product_id, $special_attribute_group_id);
		
		if($master_product_id == -1) //single item
		{
			//do nothing
		}
		else
		{
			if($master_product_id == 0) //master product
			{
				$master_product_id = $product_id;
			}
			
			//get all slave products of above master product
			$sql = "SELECT DISTINCT p.product_id, "
			. " p.model, "
			. " p.image, "
			. " pd.name, "
			. " sa.special_attribute_name, "
			. " sa.special_attribute_value "
			. " FROM " . DB_PREFIX . "product p "
			. " LEFT JOIN " . DB_PREFIX . "product_master pm "
			. " ON pm.product_id = p.product_id "
			. " LEFT JOIN " . DB_PREFIX . "product_description pd "
			. " ON pd.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa "
			. " ON psa.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "special_attribute sa "
			. " ON sa.special_attribute_id = psa.special_attribute_id "
			. " LEFT JOIN " . DB_PREFIX . "product_to_store p2s "
			. " ON p2s.product_id = p.product_id "
			. " WHERE (pm.master_product_id = '" . (int)$master_product_id . "' ";
			
			if($include_master_product)
			{
				$sql .= " OR p.product_id = '" . (int)$master_product_id . "' ";
			}
			
			$sql .= " ) "
			. " AND sa.special_attribute_group_id = '" . (int)$special_attribute_group_id . "' "
			. " AND p.status = '1' "
			. " AND p.date_available <= NOW() "
			. " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
			. " AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' "
			. " ORDER BY p.sort_order ASC ";
			
			$query = $this->db->query($sql);
			
			foreach ($query->rows as $result) {
				$linked_product_data[] = $result;
			}
		}
		
		return $linked_product_data;
	}
	
	public function getAllLinkedProducts($special_attribute_group_id)
	{
		$query = $this->db->query("SELECT pm.master_product_id, "
		. " p.product_id, "	
		. " p.image, "	
		. " p.model AS 'product_model', "
		. " pd.name AS 'product_name', "
		. " sa.special_attribute_name, "
		. " sa.special_attribute_value "
		. " FROM " . DB_PREFIX . "product_master pm "
		. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa "
		. " ON psa.product_id = pm.product_id "
		. " LEFT JOIN " . DB_PREFIX . "special_attribute sa "
		. " ON sa.special_attribute_id = psa.special_attribute_id "
		. " LEFT JOIN " . DB_PREFIX . "product p "
		. " ON p.product_id = pm.product_id "
		. " LEFT JOIN " . DB_PREFIX . "product_description pd "
		. " ON pd.product_id = p.product_id"
		. " LEFT JOIN " . DB_PREFIX . "product_to_store p2s "
		. " ON p2s.product_id = p.product_id "
		. " WHERE sa.special_attribute_group_id = '" . (int)$special_attribute_group_id . "' "
		. " AND p.status = '1' "
		. " AND p.date_available <= NOW() "
		. " AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' "
		. " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
		. " ORDER BY p.sort_order ASC, sa.special_attribute_id ASC ");
		
		$linked_product_data = array();
		foreach ($query->rows as $result) {
			$linked_product_data[] = $result;
		}
		
		return $linked_product_data;
	}
}
?>