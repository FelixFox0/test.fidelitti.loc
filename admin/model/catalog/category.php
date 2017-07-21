<?php
class ModelCatalogCategory extends Model {
	public function addCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `power_ct_block` = '" . (isset($data['power_ct_block']) ? (int)$data['power_ct_block'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$category_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape($data['image']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//dop images
		if (isset($data['imagetwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwo = '" . $this->db->escape($data['imagetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//dop images
		if (isset($data['top_tab_icon'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon = '" . $this->db->escape($data['top_tab_icon']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//dop images
		if (isset($data['top_tab_icon_two'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon_two = '" . $this->db->escape($data['top_tab_icon_two']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//dop images
		if (isset($data['top_tab_icon_three'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon_three = '" . $this->db->escape($data['top_tab_icon_three']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//dop images
		if (isset($data['imagethree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethree = '" . $this->db->escape($data['imagethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgone'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgone = '" . $this->db->escape($data['productimgone']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwo = '" . $this->db->escape($data['productImgTwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThree = '" . $this->db->escape($data['productImgThree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images three

		//
		///
		////
		/////
		//dop images
		if (isset($data['imagetwotwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwotwo = '" . $this->db->escape($data['imagetwotwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images

		//dop images
		if (isset($data['imagethreetwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethreetwo = '" . $this->db->escape($data['imagethreetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgonetwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgonetwo = '" . $this->db->escape($data['productimgonetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwotwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwotwo = '" . $this->db->escape($data['productImgTwotwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThreetwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThreetwo = '" . $this->db->escape($data['productImgThreetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images three
		/////
		////
		///
		//

		//
		///
		////
		/////
		//dop images
		if (isset($data['imagetwothree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwothree = '" . $this->db->escape($data['imagetwothree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//dop images
		if (isset($data['imagethreethree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethreethree = '" . $this->db->escape($data['imagethreethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgonethree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgonethree = '" . $this->db->escape($data['productimgonethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwothree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwothree = '" . $this->db->escape($data['productImgTwothree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThreethree'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThreethree = '" . $this->db->escape($data['productImgThreethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		/////
		////
		///
		//
		//category banner in product 
		if (isset($data['categoryBanner'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET categoryBanner = '" . $this->db->escape($data['categoryBanner']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end category banner in product
		//category banner in product two
		if (isset($data['categoryBannerTwo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET categoryBannerTwo = '" . $this->db->escape($data['categoryBannerTwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end category banner in product e
		foreach ($data['category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', textbuttom = '" . $this->db->escape($value['textbuttom']) . "', linkbuttom = '" . $this->db->escape($value['linkbuttom']) . "', descbannerone = '" . $this->db->escape($value['descbannerone']) . "', titletwo = '" . $this->db->escape($value['titletwo']) . "', nameimgthree = '" . $this->db->escape($value['nameimgthree']) . "', prodNameImgOne = '" . $this->db->escape($value['prodNameImgOne']) . "', nameTabCategory = '" . $this->db->escape($value['nameTabCategory']) . "', prodDescImgOne = '" . $this->db->escape($value['prodDescImgOne']) . "', prodNameImgTwo = '" . $this->db->escape($value['prodNameImgTwo']) . "', prodDescImgTwo = '" . $this->db->escape($value['prodDescImgTwo']) . "', linkButProdTwo = '" . $this->db->escape($value['linkButProdTwo']) . "', NameButProdTwo = '" . $this->db->escape($value['NameButProdTwo']) . "' , description_two = '" . $this->db->escape($value['description_two']) . "', description_twotwo = '" . $this->db->escape($value['description_twotwo']) . "', description_twothree = '" . $this->db->escape($value['description_twothree']) . "', textbuttomtwo = '" . $this->db->escape($value['textbuttomtwo']) . "', linkbuttomtwo = '" . $this->db->escape($value['linkbuttomtwo']) . "', descbanneronetwo = '" . $this->db->escape($value['descbanneronetwo']) . "', titletwotwo = '" . $this->db->escape($value['titletwotwo']) . "', nameimgthreetwo = '" . $this->db->escape($value['nameimgthreetwo']) . "', prodNameImgOnetwo = '" . $this->db->escape($value['prodNameImgOnetwo']) . "', nameTabCategorytwo = '" . $this->db->escape($value['nameTabCategorytwo']) . "', prodDescImgOnetwo = '" . $this->db->escape($value['prodDescImgOnetwo']) . "', prodNameImgTwotwo = '" . $this->db->escape($value['prodNameImgTwotwo']) . "', prodDescImgTwotwo = '" . $this->db->escape($value['prodDescImgTwotwo']) . "', linkButProdTwotwo = '" . $this->db->escape($value['linkButProdTwotwo']) . "', NameButProdTwotwo = '" . $this->db->escape($value['NameButProdTwotwo']) . "' , meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['category_filter'])) {
			foreach ($data['category_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET category_id = '" . (int)$category_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['category_store'])) {
			foreach ($data['category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this category
		if (isset($data['category_layout'])) {
			foreach ($data['category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('category');

		return $category_id;
	}

	public function editCategory($category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `power_ct_block` = '" . (isset($data['power_ct_block']) ? (int)$data['power_ct_block'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape($data['image']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//dop images
		if (isset($data['imagetwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwo = '" . $this->db->escape($data['imagetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images	
		//dop images
		if (isset($data['top_tab_icon'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon = '" . $this->db->escape($data['top_tab_icon']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//dop images
		if (isset($data['top_tab_icon_two'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon_two = '" . $this->db->escape($data['top_tab_icon_two']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images	
		//dop images
		if (isset($data['top_tab_icon_three'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET top_tab_icon_three = '" . $this->db->escape($data['top_tab_icon_three']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images			
		//dop images
		if (isset($data['imagethree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethree = '" . $this->db->escape($data['imagethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgone'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgone = '" . $this->db->escape($data['productimgone']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwo = '" . $this->db->escape($data['productImgTwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThree = '" . $this->db->escape($data['productImgThree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images three

		//
		///
		////
		/////
		//dop images
		if (isset($data['imagetwotwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwotwo = '" . $this->db->escape($data['imagetwotwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images		
		//dop images
		if (isset($data['imagethreetwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethreetwo = '" . $this->db->escape($data['imagethreetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgonetwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgonetwo = '" . $this->db->escape($data['productimgonetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwotwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwotwo = '" . $this->db->escape($data['productImgTwotwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThreetwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThreetwo = '" . $this->db->escape($data['productImgThreetwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images three
		/////
		////
		///
		//

		//
		///
		////
		/////
		//dop images
		if (isset($data['imagetwothree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagetwothree = '" . $this->db->escape($data['imagetwothree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images		
		//dop images
		if (isset($data['imagethreethree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET imagethreethree = '" . $this->db->escape($data['imagethreethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end dop images
		//product images one
		if (isset($data['productimgonethree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productimgonethree = '" . $this->db->escape($data['productimgonethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images one
		//product images two
		if (isset($data['productImgTwothree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgTwothree = '" . $this->db->escape($data['productImgTwothree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images two 
		//product images three
		if (isset($data['productImgThreethree'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET productImgThreethree = '" . $this->db->escape($data['productImgThreethree']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end product images three
		/////
		////
		///
		//
		//category banner in product 
		if (isset($data['categoryBanner'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET categoryBanner = '" . $this->db->escape($data['categoryBanner']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end category banner in product 
		//category banner in product two
		if (isset($data['categoryBannerTwo'])) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET categoryBannerTwo = '" . $this->db->escape($data['categoryBannerTwo']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}
		//end category banner in product two
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");

		foreach ($data['category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', description_two = '" . $this->db->escape($value['description_two']) . "', description_twotwo = '" . $this->db->escape($value['description_twotwo']) . "', description_twothree = '" . $this->db->escape($value['description_twothree']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', textbuttom = '" . $this->db->escape($value['textbuttom']) . "', nameimgthree = '" . $this->db->escape($value['nameimgthree']) . "', prodNameImgOne = '" . $this->db->escape($value['prodNameImgOne']) . "', nameTabCategory = '" . $this->db->escape($value['nameTabCategory']) . "', linkbuttom = '" . $this->db->escape($value['linkbuttom']) . "', descbannerone = '" . $this->db->escape($value['descbannerone']) . "', titletwo = '" . $this->db->escape($value['titletwo']) . "', prodDescImgOne = '" . $this->db->escape($value['prodDescImgOne']) . "', prodNameImgTwo = '" . $this->db->escape($value['prodNameImgTwo']) . "', prodDescImgTwo = '" . $this->db->escape($value['prodDescImgTwo']) . "', linkButProdTwo = '" . $this->db->escape($value['linkButProdTwo']) . "', NameButProdTwo = '" . $this->db->escape($value['NameButProdTwo']) . "', textbuttomtwo = '" . $this->db->escape($value['textbuttomtwo']) . "', nameimgthreetwo = '" . $this->db->escape($value['nameimgthreetwo']) . "', prodNameImgOnetwo = '" . $this->db->escape($value['prodNameImgOnetwo']) . "', nameTabCategorytwo = '" . $this->db->escape($value['nameTabCategorytwo']) . "', linkbuttomtwo = '" . $this->db->escape($value['linkbuttomtwo']) . "', descbanneronetwo = '" . $this->db->escape($value['descbanneronetwo']) . "', titletwotwo = '" . $this->db->escape($value['titletwotwo']) . "', prodDescImgOnetwo = '" . $this->db->escape($value['prodDescImgOnetwo']) . "', prodNameImgTwotwo = '" . $this->db->escape($value['prodNameImgTwotwo']) . "', prodDescImgTwotwo = '" . $this->db->escape($value['prodDescImgTwotwo']) . "', linkButProdTwotwo = '" . $this->db->escape($value['linkButProdTwotwo']) . "', NameButProdTwotwo = '" . $this->db->escape($value['NameButProdTwotwo']) . "', textbuttomthree = '" . $this->db->escape($value['textbuttomthree']) . "', nameimgthreethree = '" . $this->db->escape($value['nameimgthreethree']) . "', prodNameImgOnethree = '" . $this->db->escape($value['prodNameImgOnethree']) . "', nameTabCategorythree = '" . $this->db->escape($value['nameTabCategorythree']) . "', linkbuttomthree = '" . $this->db->escape($value['linkbuttomthree']) . "', descbanneronethree = '" . $this->db->escape($value['descbanneronethree']) . "', titletwothree = '" . $this->db->escape($value['titletwothree']) . "', prodDescImgOnethree = '" . $this->db->escape($value['prodDescImgOnethree']) . "', prodNameImgTwothree = '" . $this->db->escape($value['prodNameImgTwothree']) . "', prodDescImgTwothree = '" . $this->db->escape($value['prodDescImgTwothree']) . "', linkButProdTwothree = '" . $this->db->escape($value['linkButProdTwothree']) . "', NameButProdTwothree = '" . $this->db->escape($value['NameButProdTwothree']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE path_id = '" . (int)$category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' AND level < '" . (int)$category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_path['category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['category_filter'])) {
			foreach ($data['category_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET category_id = '" . (int)$category_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['category_store'])) {
			foreach ($data['category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['category_layout'])) {
			foreach ($data['category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_layout SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('category');
	}

	public function deleteCategory($category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_path WHERE category_id = '" . (int)$category_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_path WHERE path_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteCategory($result['category_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_category WHERE category_id = '" . (int)$category_id . "'");

		$this->cache->delete('category');
	}

	public function repairCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $category) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category['category_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category['category_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category['category_id'] . "', `path_id` = '" . (int)$category['category_id'] . "', level = '" . (int)$level . "'");

			$this->repairCategories($category['category_id']);
		}
	}

	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getCategoriesByParentId($parent_id = 0) {
		$query = $this->db->query("SELECT *, (SELECT COUNT(parent_id) FROM " . DB_PREFIX . "category WHERE parent_id = c.category_id) AS children FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name");

		return $query->rows;
	}

	public function getCategories($data = array()) {
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order, c1.status,(select count(product_id) as product_count from " . DB_PREFIX . "product_to_category pc where pc.category_id = c1.category_id) as product_count FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.category_id";

		$sort_data = array(
			'product_count',
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCategoryDescriptions($category_id) {
		$category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'textbuttom'       => $result['textbuttom'],//name title button
				'linkbuttom'       => $result['linkbuttom'],//link button
				'descbannerone'    => $result['descbannerone'],//title two
				'titletwo'         => $result['titletwo'],//title two
				'nameimgthree'     => $result['nameimgthree'],//name images three
				'prodNameImgOne'   => $result['prodNameImgOne'],//product name image one
				'nameTabCategory'   => $result['nameTabCategory'],//product name image one
				'prodDescImgOne'   => $result['prodDescImgOne'],//product desc image one
				'prodNameImgTwo'   => $result['prodNameImgTwo'],//product name image two
				'prodDescImgTwo'   => $result['prodDescImgTwo'],//product desc image one
				'linkButProdTwo'   => $result['linkButProdTwo'],//link button product two
				'NameButProdTwo'   => $result['NameButProdTwo'],//link button product two
				'textbuttomtwo'       => $result['textbuttomtwo'],//name title button
				'linkbuttomtwo'       => $result['linkbuttomtwo'],//link button
				'descbanneronetwo'    => $result['descbanneronetwo'],//title two
				'titletwotwo'         => $result['titletwotwo'],//title two
				'nameimgthreetwo'     => $result['nameimgthreetwo'],//name images three
				'prodNameImgOnetwo'   => $result['prodNameImgOnetwo'],//product name image one
				'nameTabCategorytwo'   => $result['nameTabCategorytwo'],//product name image one
				'prodDescImgOnetwo'   => $result['prodDescImgOnetwo'],//product desc image one
				'prodNameImgTwotwo'   => $result['prodNameImgTwotwo'],//product name image two
				'prodDescImgTwotwo'   => $result['prodDescImgTwotwo'],//product desc image one
				'linkButProdTwotwo'   => $result['linkButProdTwotwo'],//link button product two
				'NameButProdTwotwo'   => $result['NameButProdTwotwo'],//link button product two
				'textbuttomthree'       => $result['textbuttomthree'],//name title button
				'linkbuttomthree'       => $result['linkbuttomthree'],//link button
				'descbanneronethree'    => $result['descbanneronethree'],//title two
				'titletwothree'         => $result['titletwothree'],//title two
				'nameimgthreethree'     => $result['nameimgthreethree'],//name images three
				'prodNameImgOnethree'   => $result['prodNameImgOnethree'],//product name image one
				'nameTabCategorythree'   => $result['nameTabCategorythree'],//product name image one
				'prodDescImgOnethree'   => $result['prodDescImgOnethree'],//product desc image one
				'prodNameImgTwothree'   => $result['prodNameImgTwothree'],//product name image two
				'prodDescImgTwothree'   => $result['prodDescImgTwothree'],//product desc image one
				'linkButProdTwothree'   => $result['linkButProdTwothree'],//link button product two
				'NameButProdTwothree'   => $result['NameButProdTwothree'],//link button product two
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description_two'  => $result['description_two'],//description two
				'description_twotwo'  => $result['description_twotwo'],//description two
				'description_twothree'  => $result['description_twothree'],//description two
				'description'      => $result['description']
			);
		}

		return $category_description_data;
	}
	
	public function getCategoryPath($category_id) {
		$query = $this->db->query("SELECT category_id, path_id, level FROM " . DB_PREFIX . "category_path WHERE category_id = '" . (int)$category_id . "'");

		return $query->rows;
	}
	
	public function getCategoryFilters($category_id) {
		$category_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$category_filter_data[] = $result['filter_id'];
		}

		return $category_filter_data;
	}

	public function getCategoryStores($category_id) {
		$category_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_store WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$category_store_data[] = $result['store_id'];
		}

		return $category_store_data;
	}

	public function getCategoryLayouts($category_id) {
		$category_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_layout WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$category_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $category_layout_data;
	}

	public function getTotalCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category");

		return $query->row['total'];
	}

	public function getAllCategories() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  ORDER BY c.parent_id, c.sort_order, cd.name");

		$category_data = array();
		foreach ($query->rows as $row) {
			$category_data[$row['parent_id']][$row['category_id']] = $row;
		}

		return $category_data;
	}
	
	public function getTotalCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
