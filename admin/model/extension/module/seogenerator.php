<?php

class ModelModuleSeogenerator extends Model {
	
	public function generateSEFCategories($selector, $update) {
		
		$categories = $this->db->query("SELECT c.category_id AS category_id, cd.name AS name FROM ".DB_PREFIX."category c LEFT JOIN ".DB_PREFIX."category_description cd ON (c.category_id=cd.category_id) WHERE cd.language_id ='".(int)$this->config->get('config_language_id')."'")->rows;

		$result = true;
		foreach ($categories as $category) {
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='category_id=".$category['category_id']."'");
			$row = $sql->row;
			$url = $this->generateURL($category['name'], $selector);
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'category_id=".$category['category_id']."'");
			if ($sql->row) { $url .= $selector.$category['category_id']; }
			if ($row) {
				if ((int)$update == 1) {
					$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
					if ($sql == false) {$result = $result && false;}
					$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='category_id=".$category['category_id']."', keyword='".$url."'");
					if ($sql == false) {$result = $result && false;}
				}
			} else {
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='category_id=".$category['category_id']."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		}
		
		return $result;
	}
	
	public function generateSEFProducts($selector, $update) {
		
		$products = $this->db->query("SELECT p.product_id AS product_id, pd.name AS name FROM ".DB_PREFIX."product p LEFT JOIN ".DB_PREFIX."product_description pd ON (p.product_id=pd.product_id) WHERE pd.language_id ='".(int)$this->config->get('config_language_id')."'")->rows;

		$result = true;
		foreach ($products as $product) {
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='product_id=".$product['product_id']."'");
			$row = $sql->row;
			$url = $this->generateURL($product['name'], $selector);
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'product_id=".$product['product_id']."'");
			if ($sql->row) { $url .= $selector.$product['product_id']; }
			$url .= $this->config->get('config_seo_url_postfix');
			if ($row) {
				if ((int)$update == 1) {
					$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
					if ($sql == false) {$result = $result && false;}
					$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='product_id=".$product['product_id']."', keyword='".$url."'");
					if ($sql == false) {$result = $result && false;}
				}
			} else {
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='product_id=".$product['product_id']."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		}
		
		return $result;
	}
	
	public function generateSEFManufacturers($selector, $update) {
		
		$manufacturers = $this->db->query("SELECT manufacturer_id, name FROM ".DB_PREFIX."manufacturer")->rows;

		$result = true;
		foreach ($manufacturers as $manufacturer) {
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='manufacturer_id=".$manufacturer['manufacturer_id']."'");
			$row = $sql->row;
			$url = $this->generateURL($manufacturer['name'], $selector);
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'manufacturer_id=".$manufacturer['manufacturer_id']."'");
			if ($sql->row) { $url .= $selector.$manufacturer['manufacturer_id']; }
			if ($row) {
				if ((int)$update == 1) {
					$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
					if ($sql == false) {$result = $result && false;}
					$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='manufacturer_id=".$manufacturer['manufacturer_id']."', keyword='".$url."'");
					if ($sql == false) {$result = $result && false;}
				}
			} else {
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='manufacturer_id=".$manufacturer['manufacturer_id']."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		}
		
		return $result;
	}
	
	public function generateSEFInformations($selector, $update) {
		
		$informations = $this->db->query("SELECT i.information_id AS information_id, id.title AS name FROM ".DB_PREFIX."information i LEFT JOIN ".DB_PREFIX."information_description id ON (i.information_id=id.information_id) WHERE id.language_id ='".(int)$this->config->get('config_language_id')."'")->rows;

		$result = true;
		foreach ($informations as $information) {
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='information_id=".$information['information_id']."'");
			$row = $sql->row;
			$url = $this->generateURL($information['name'], $selector);
			$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'information_id=".$information['information_id']."'");
			if ($sql->row) { $url .= $selector.$information['information_id']; }
			if ($row) {
				if ((int)$update == 1) {
					$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
					if ($sql == false) {$result = $result && false;}
					$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='information_id=".$information['information_id']."', keyword='".$url."'");
					if ($sql == false) {$result = $result && false;}
				}
			} else {
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='information_id=".$information['information_id']."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		}
		
		return $result;
	}
	
	public function generateSEFCategory($category_id, $name, $selector, $update) {
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='category_id=".$category_id."'");
		$row = $sql->row;
		$url = $this->generateURL($name, $selector);
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'category_id=".$category_id."'");
		if ($sql->row) { $url .= $selector.$category_id; }
		if ($row) {
			if ((int)$update == 1) {
				$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='category_id=".$category_id."', keyword='".$url."'");
			}
		} else {
			$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='category_id=".$category_id."', keyword='".$url."'");
		}
	}
	
	public function generateSEFProduct($product_id, $name, $selector, $update) {
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='product_id=".$product_id."'");
		$row = $sql->row;
		$url = $this->generateURL($name, $selector);
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'product_id=".$product_id."'");
		if ($sql->row) { $url .= $selector.$product_id; }
		$url .= $this->config->get('config_seo_url_postfix');
		if ($row) {
			if ((int)$update == 1) {
				$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
				if ($sql == false) {$result = $result && false;}
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='product_id=".$product_id."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		} else {
			$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='product_id=".$product_id."', keyword='".$url."'");
			if ($sql == false) {$result = $result && false;}
		}
	}
	
	public function generateSEFManufacturer($manufacturer_id, $name, $selector, $update) {
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='manufacturer_id=".$manufacturer_id."'");
		$row = $sql->row;
		$url = $this->generateURL($name, $selector);
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'manufacturer_id=".$manufacturer_id."'");
		if ($sql->row) { $url .= $selector.$manufacturer_id; }
		if ($row) {
			if ((int)$update == 1) {
				$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
				if ($sql == false) {$result = $result && false;}
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='manufacturer_id=".$manufacturer_id."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		} else {
			$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='manufacturer_id=".$manufacturer_id."', keyword='".$url."'");
			if ($sql == false) {$result = $result && false;}
		}
	}
	
	public function generateSEFInformation($information_id, $name, $selector, $update) {
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE query='information_id=".$information_id."'");
		$row = $sql->row;
		$url = $this->generateURL($name, $selector);
		$sql = $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE keyword='".$url."' AND query<>'information_id=".$information_id."'");
		if ($sql->row) { $url .= $selector.$information_id; }
		if ($row) {
			if ((int)$update == 1) {
				$sql = $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE url_alias_id='".(int)$row['url_alias_id']."'");
				if ($sql == false) {$result = $result && false;}
				$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET url_alias_id='".(int)$row['url_alias_id']."', query='information_id=".$information_id."', keyword='".$url."'");
				if ($sql == false) {$result = $result && false;}
			}
		} else {
			$sql = $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query='information_id=".$information_id."', keyword='".$url."'");
			if ($sql == false) {$result = $result && false;}
		}
	}
	
	public function generateURL($url, $selector) {
		$urls = array(
			'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
			'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
			'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu',
			'я' => 'ya', 'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g', '&quot;' => '', '&nbsp;' => ' '
		);
		
		$url = mb_strtolower($url,'UTF-8');
		foreach ($urls as $key => $value) {
			$url = str_replace($key, $value, $url);	
		}		
		$url = preg_replace('/[^0-9a-z_\s]+/', '', $url);
		//$url = mb_substr($url, 0, 50, 'UTF-8'); //Обрезать до 50 символов
		$url = trim($url);
		$url = preg_replace('/[\s]+/', $selector, $url);
		
		return $url;
	}
	
}