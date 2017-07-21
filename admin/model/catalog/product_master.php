<?php
class ModelCatalogProductMaster extends Model {
	public function addLink($data)
	{
		$this->db->query("INSERT INTO "
		. DB_PREFIX . "product_master "
		. "SET product_id = '" . (int)$data['product_id'] . "'"
		. ", master_product_id = '" . (int)$data['master_product_id'] . "'"
		. ", special_attribute_group_id = '" . (int)$data['special_attribute_group_id'] . "'");
		
		$this->cache->delete('product_master');
	}
	
	public function editLink($data)	
	{
		$this->db->query("DELETE FROM "
		. DB_PREFIX . "product_master "
		. " WHERE product_id = '" . (int)$data['product_id'] . "'");
	
		return $this->addLink($data);
	}
	
	public function deleteLink($data)	
	{
		$this->db->query("UPDATE "
		. DB_PREFIX . "product_master "
		. " SET master_product_id = '-1' "
		. " WHERE master_product_id = '" . (int)$data['product_id'] . "'");
		
		$data['master_product_id'] = '-1';
		$data['special_attribute_group_id'] = '-1';
		
		return $this->editLink($data);
	}
	
	//return list of products that can be selected as master product
	public function getAllMasterableProducts($special_attribute_group_id)
	{
		$query = $this->db->query("SELECT p.product_id, pd.name AS 'product_name' FROM "		
		. DB_PREFIX . "product p"
		. " LEFT JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id "
		. " LEFT JOIN " . DB_PREFIX . "product_master pm ON pm.product_id = p.product_id "
		. " WHERE pm.master_product_id = 0 "
		. " AND pm.special_attribute_group_id = '" . (int)$special_attribute_group_id . "' "
		. " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
		. " ORDER BY pd.name ASC");
		
		return $query->rows;
	}
	
	//check if a product can be selected as master product
	public function isMasterable($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT COUNT(*) AS 'total' FROM "		
		. DB_PREFIX . "product p "
		. " LEFT JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id "
		. " WHERE p.product_id NOT IN"
		. " (SELECT product_id FROM " . DB_PREFIX . "product_master"
		. " WHERE special_attribute_group_id = '" . (int)$special_attribute_group_id . "'"
		. " AND master_product_id > 0)"
		. " AND p.product_id = '" . (int)$product_id . "'"
		. " ORDER BY pd.name ASC");
		
		return (int)($query->row['total']) > 0;
	}
	
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
	
	//check if a product is a master product
	public function isMaster($product_id, $special_attribute_group_id)
	{
		$query = $this->db->query("SELECT master_product_id FROM "		
		. DB_PREFIX . "product_master "
		. " WHERE product_id = '" . (int)$product_id . "' "
		. " AND special_attribute_group_id = '" . (int)$special_attribute_group_id . "'");

		if(count($query->rows) > 0)	
			return (int)($query->row['master_product_id']) == 0;
		
		return false;
	}
	
	public function createProductSeries($product_ids, $special_attribute_group_id)
	{
		//insert product|master product
		$this->load->model('catalog/product');
		
		if(sizeof($product_ids) == 0) return;
		
		//copy the 1st product and set as product series
		$data = $this->getProductData($product_ids[0]);
		
		if (isset($data)) {
			//append " Series" to name			
			foreach ($data['product_description'] as &$product_desc) { //& is for reference
				$product_desc['name'] .= ' Series';
			}
		
			//append " Series" to model
			$data['model'] .= ' Series';
			
			$master_product_id = $this->model_catalog_product->addProduct($data);
					
			$this->editLink(array(
				'product_id' => $master_product_id,
				'master_product_id' => '0', //0 is master
				'special_attribute_group_id' => '2' //2 is image
			));
		}
		
		$this->load->model('catalog/product_special_attribute');
		$data = array(
			'product_series_image' => '',
			'special_attribute_group_id' => '2' //2 is image
		);
		
		foreach($product_ids as $product_id)
		{
			//update set product master
			$psa = $this->model_catalog_product_special_attribute->getProductSpecialAttribute($product_id, '2');
			
			if(!isset($psa))
			{			
				$this->load->model('catalog/special_attribute');
				$this->model_catalog_product_special_attribute->editProductSpecialAttribute(array(
					'product_id' => $product_id,
					'special_attribute_id' => $this->model_catalog_special_attribute->getImageId($data)
				));
			}
			
			$this->editLink(array(
				'product_id' => $product_id,
				'master_product_id' => $master_product_id,
				'special_attribute_group_id' => '2' //2 is image
			));
		}
		
		$this->cache->delete('product');
	}
	
	public function getProductData($product_id)
	{		
		$this->load->model('catalog/product');
	
		$data = $this->model_catalog_product->getProduct($product_id);
		
		if (isset($data)) {
			
						
			$data = array_merge($data, array('product_attribute' => $this->model_catalog_product->getProductAttributes($product_id)));
			$data = array_merge($data, array('product_description' => $this->model_catalog_product->getProductDescriptions($product_id)));			
			$data = array_merge($data, array('product_discount' => $this->model_catalog_product->getProductDiscounts($product_id)));
			$data = array_merge($data, array('product_image' => $this->model_catalog_product->getProductImages($product_id)));		
			$data = array_merge($data, array('product_option' => $this->model_catalog_product->getProductOptions($product_id)));
			$data = array_merge($data, array('product_related' => $this->model_catalog_product->getProductRelated($product_id)));
			$data = array_merge($data, array('product_reward' => $this->model_catalog_product->getProductRewards($product_id)));
			$data = array_merge($data, array('product_special' => $this->model_catalog_product->getProductSpecials($product_id)));
			$data = array_merge($data, array('product_category' => $this->model_catalog_product->getProductCategories($product_id)));
			$data = array_merge($data, array('product_download' => $this->model_catalog_product->getProductDownloads($product_id)));
			$data = array_merge($data, array('product_layout' => $this->model_catalog_product->getProductLayouts($product_id)));
			$data = array_merge($data, array('product_store' => $this->model_catalog_product->getProductStores($product_id)));
			
			return $data;
		}
		
		return null;
	}
			
	public function getMasterProductIdFromData($data)
	{
		if(!isset($data['color_series_type']))
			return -1;
			
		if($data['color_series_type'] == 'singleItem')
			return -1;
		else if($data['color_series_type'] == 'colorSeriesMaster')
			return 0;
		else
		{
			if(isset($data['master_product']))
				return (int)$data['master_product'];
			else
				return -1;
		}
	}
	
	//check if a product can be selected as slave product
	public function isSlavable($product_id, $special_attribute_group_id)
	{
		//must not be a master product (master_product_id = 0)
		//must not belong to any series (master_product_id > 0)
	
		$query = $this->db->query("SELECT COUNT(*) AS 'total'"		
		. " FROM " . DB_PREFIX . "product p "
		. " LEFT JOIN " . DB_PREFIX . "product_master pm ON pm.product_id = p.product_id "
		. " WHERE pm.special_attribute_group_id = '" . (int)$special_attribute_group_id . "'"
		. " AND p.product_id = '" . (int)$product_id . "'"
		. " AND (pm.master_product_id = 0"
		. " OR pm.master_product_id > 0)");
		
		return (int)($query->row['total']) == 0;
	}
	
	public function getLinkedProducts($product_id, $special_attribute_group_id)
	{
		$linked_product_data = array();
		
		$master_product_id = $this->getMasterProductId($product_id, $special_attribute_group_id);
		
		if($master_product_id == -1) //single item
		{
			//do nothing
		}
		else
		{
			if($master_product_id == 0) //this product is a master product
			{
				$master_product_id = $product_id;
			}
			
			//get all slave products of above master product
			$query = $this->db->query("SELECT p.product_id, "
			. " p.image, "
			. " p.model AS 'product_model', "
			. " pd.name AS 'product_name', "
			. " sa.special_attribute_name, "
			. " sa.special_attribute_value "
			. " FROM " . DB_PREFIX . "product p "
			. " LEFT JOIN " . DB_PREFIX . "product_master pm on pm.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "product_description pd on pd.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "product_special_attribute psa ON psa.product_id = p.product_id"
			. " LEFT JOIN " . DB_PREFIX . "special_attribute sa ON sa.special_attribute_id = psa.special_attribute_id"
			. " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
			. " WHERE (pm.master_product_id = '" . (int)$master_product_id . "') AND sa.special_attribute_group_id = '" . (int)$special_attribute_group_id . "' "
			. " ORDER BY p.sort_order ASC, pd.name ASC");
		
			foreach ($query->rows as $result) {
				$linked_product_data[] = $result;
			}
		}
		
		return $linked_product_data;
	}
}
?>