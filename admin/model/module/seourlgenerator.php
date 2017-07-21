<?php
class ModelModuleSeoUrlGenerator extends Model {
    
        public function seoUrlGenerateAjax($query_part,$seos,$only_to_latin = FALSE){
            $result = '';
            if($seos){
                foreach ($seos as $id => $name) {
                    $name = html_entity_decode($name,ENT_QUOTES);
                    $name = strip_tags($name);
                    $name = trim($name);
                    if($name){
                        $result = $this->generate($query_part,$name,array(),$only_to_latin);
                    }
                }
            }
            return $result;
        }
    
        public function seoUrlGenerate($query_part,$seos,$only_to_latin = FALSE){
            $result = array();
            if($seos){
                $url_part_last = array();
                foreach ($seos as $id => $keyword) {
                    $table = mb_strcut($query_part, 0, (mb_strlen($query_part, 'utf-8')-3), 'utf-8');
                    $lang = '';
                    if($table=='product' || $table=='category' || $table=='information' || $table=='simple_blog_category' || $table=='simple_blog_article'){
                        $table .= '_description';
                        $lang = "AND language_id = '" . (int)$this->config->get('config_language_id') . "'";
                    }
                    $sql = "SELECT * FROM `" . DB_PREFIX .$table. "` WHERE `".$query_part."`= ".$id." ".$lang;
                   
                    $query = $this->db->query($sql);
                    if(!$keyword && isset($query->row['name']) && $query->row['name']){
                        $result[$id] = $this->generate($query_part,$query->row['name'],$url_part_last,$only_to_latin);
                        $url_part_last[$result[$id]] = $result[$id];
                    }
                    //v.1.1
                    elseif (!$keyword && isset($query->row['title']) && $query->row['title']) {
                        $result[$id] = $this->generate($query_part,$query->row['title'],$url_part_last,$only_to_latin);
                        $url_part_last[$result[$id]] = $result[$id];
                    }
                    ///v.1.1
                    elseif (!$keyword && isset($query->row['article_title']) && $query->row['article_title']) {
                        $result[$id] = $this->generate($query_part,$query->row['article_title'],$url_part_last,$only_to_latin);
                        $url_part_last[$result[$id]] = $result[$id];
                    }
                    elseif (!$keyword && isset($query->row['category_title']) && $query->row['category_title']) {
                        $result[$id] = $this->generate($query_part,$query->row['article_title'],$url_part_last,$only_to_latin);
                        $url_part_last[$result[$id]] = $result[$id];
                    }
                }
            }
            
            return $result;
        }
        
        protected function generate($query_part,$name,$url_part_last=array(),$only_to_latin){
            $keyword = $this->validateUrl($name,$only_to_latin);
            $dublicate = '';
            if($keyword){
                //$where = " WHERE keyword='".$keyword."' AND query LIKE '".$this->db->escape($query_part)."%' ";
                $where = " WHERE keyword='".$keyword."' ";
                $sql = "SELECT * FROM " . DB_PREFIX . "url_alias ".$where;
                $query = $this->db->query($sql);
                if($query->row){
                    $url_part = explode('-', $query->row['keyword']);
                    $dublicate = TRUE;
                    if($url_part && is_array($url_part)){
                        $name = '';
                        if((int)end($url_part)>0){
                            $end = '-'.((int)end($url_part)+1);
                            array_pop($url_part);
                        }else{
                            $end = '-1';
                        }
                        $name = implode('-', $url_part);
                        
                    }else{
                        $end = '-1';
                    }
                    $name = $name.$end;
                    $keyword = $this->generate($query_part,$name,$url_part_last,$only_to_latin);
                }
                while (isset($url_part_last[$keyword])) {
                    $url_part = explode('-', $keyword);
                    if($url_part && is_array($url_part)){
                        $keyword = '';
                        if((int)end($url_part)>0){
                            $end = '-'.((int)end($url_part)+1);
                            array_pop($url_part);
                        }else{
                            $end = '-1';
                        }
                        $keyword = implode('-', $url_part);
                        
                    }else{
                        $end = '-1';
                    }
                    $keyword = $keyword.$end;
                }
            }
            $url = $keyword;
            return $url;
        }
        
        protected function validateUrl($string,$only_to_latin=FALSE){
            
            $string = html_entity_decode($string,ENT_QUOTES);
            $string = strip_tags($string);
            $string = trim($string);
            
            $arr = explode(" ", $string);
            $str = '';
            for($i=0;$i<count($arr);$i++){
                $arr[$i] = trim($arr[$i]);
                if($arr[$i]){
                    $str .= ' '.$arr[$i];
                }
            }
            $str = trim($str);
            $find = array('!', '^','*','$','\'','@','"', '±',' ','&','#',';','%','?',':','(',')','-','_','=','+','[',']',',','.','/','\\');
            $replace = array('','','','','','','','','-','','','','','','','','','-','-','-','-','','','-','','-','-');
            $str = str_replace($find, $replace, $str);
            $str = trim(mb_strtolower($str,'utf-8'));
            if($only_to_latin){
                $find = array('а','б','в','г','д','е', 'ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','ц','ч','ш','щ','у','ф','х','ъ','ь','ы','э','ю','я');
                //$replace = array('a','b','v','g','d','ye','yo','zh','z','i','yi','k','l','m','n','o','p','r','s','t','ts','ch','sh','sch','u','ph','kh','','','y','e','yu','ya');
                $replace = array('a','b','v','g','d','e','yo','zh','z','i','j','k','l','m','n','o','p','r','s','t','ts','ch','sh','sch','u','f','kh','','','y','e','yu','ya');
                $str = str_replace($find, $replace, $str);
            }
            return $str;
        }

        public function getDublicates($query_part,$seos){
            $result = array();
            if($seos){
                foreach ($seos as $id => $keyword) {
                    $keyword = trim($keyword);
                    if($keyword){
                        //$where = " WHERE keyword='".$keyword."' AND query!='".$this->db->escape($query_part).'='.(int)$id."' AND query LIKE '".$this->db->escape($query_part)."%' ";
                        $where = " WHERE keyword='".$keyword."' AND query!='".$this->db->escape($query_part).'='.(int)$id."' ";
                        //$where = " WHERE keyword='".$keyword."' ";
                        $sql = "SELECT * FROM " . DB_PREFIX . "url_alias ".$where;
                        $query = $this->db->query($sql);
                        if($query->row){
                            $result[$id] = $keyword;
                        }
                    }
                }
            }
            return $result;
        }
        
        public function save($query_part,$seos){
            
            if($seos){
                foreach ($seos as $id => $keyword) {
                    $keyword = $this->validateUrl($keyword);
                    $keyword = trim($keyword);
                    $where = " query='".$this->db->escape($query_part).'='.(int)$id."' ";
                    $sql = "DELETE FROM " . DB_PREFIX . "url_alias WHERE ".$where;
                    $query = $this->db->query($sql);
                    $sql = "INSERT INTO " . DB_PREFIX . "url_alias SET ".$where. ', keyword = '."'".$this->db->escape($keyword)."'";
                    $query = $this->db->query($sql);
                }
            }
        }

	public function getSeos($data = array()) {
                if($data['sort'] && isset($data['sort']['products'])){
                    $query_url_alias = 'product_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "product` seos_data LEFT JOIN `" . DB_PREFIX . "product_description` seos_description ON (seos_data.product_id = seos_description.product_id)";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "product` seos_data LEFT JOIN `" . DB_PREFIX . "product_description` seos_description ON (seos_data.product_id = seos_description.product_id)";
                    $sql .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    $sql_c .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    if ($data['filter_name']) {
                            $sql .= " AND seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                            $sql_c .= " AND seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                    }
                    $sql .= " GROUP BY seos_data.product_id";
                    if($data['sort']['products']){
                        $sort_parts = explode('-', $data['sort']['products']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }elseif ($data['sort'] && isset($data['sort']['categories'])) {
                    $query_url_alias = 'category_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "category` seos_data LEFT JOIN `" . DB_PREFIX . "category_description` seos_description ON (seos_data.category_id = seos_description.category_id)";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "category` seos_data LEFT JOIN `" . DB_PREFIX . "category_description` seos_description ON (seos_data.category_id = seos_description.category_id)";
                    $sql .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    $sql_c .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    if ($data['filter_name']) {
                            $sql .= " AND seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                            $sql_c .= " AND seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                    }
                    $sql .= " GROUP BY seos_data.category_id";
                    if($data['sort']['categories']){
                        $sort_parts = explode('-', $data['sort']['categories']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }elseif ($data['sort'] && isset($data['sort']['manufactures'])) {
                    $query_url_alias = 'manufacturer_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "manufacturer` seos_data ";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "manufacturer` seos_data ";
                    if ($data['filter_name']) {
                            $sql .= " WHERE seos_data.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                            $sql_c .= " WHERE seos_data.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                    }
                    if($data['sort']['manufactures']){
                        $sort_parts = explode('-', $data['sort']['manufactures']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }
                //v.1.1
                elseif ($data['sort'] && isset($data['sort']['informations'])) {
                    $query_url_alias = 'information_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "information` seos_data LEFT JOIN `" . DB_PREFIX . "information_description` seos_description ON (seos_data.information_id = seos_description.information_id)";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "information` seos_data LEFT JOIN `" . DB_PREFIX . "information_description` seos_description ON (seos_data.information_id = seos_description.information_id)";
                    $sql .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    $sql_c .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    if ($data['filter_name']) {
                            $sql .= " AND (seos_description.title LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                            $sql_c .= " AND (seos_description.title LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                    }
                    $sql .= " GROUP BY seos_data.information_id";
                    if($data['sort']['informations']){
                        $sort_parts = explode('-', $data['sort']['informations']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }
                ///v.1.1.1
                //v.1.2
                elseif ($data['sort'] && isset($data['sort']['simpleblogarticles'])) {
                    $query_url_alias = 'simple_blog_article_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "simple_blog_article` seos_data LEFT JOIN `" . DB_PREFIX . "simple_blog_article_description` seos_description ON (seos_data.simple_blog_article_id = seos_description.simple_blog_article_id)";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "simple_blog_article` seos_data LEFT JOIN `" . DB_PREFIX . "simple_blog_article_description` seos_description ON (seos_data.simple_blog_article_id = seos_description.simple_blog_article_id)";
                    $sql .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    $sql_c .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    if ($data['filter_name']) {
                            $sql .= " AND (seos_description.article_title LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                            $sql_c .= " AND (seos_description.article_title LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                    }
                    $sql .= " GROUP BY seos_data.simple_blog_article_id";
                    if($data['sort']['simpleblogarticles']){
                        $sort_parts = explode('-', $data['sort']['simpleblogarticles']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }
                elseif ($data['sort'] && isset($data['sort']['simpleblogcategories'])) {
                    $query_url_alias = 'simple_blog_category_id';
                    $sql = "SELECT * FROM `" . DB_PREFIX . "simple_blog_category` seos_data LEFT JOIN `" . DB_PREFIX . "simple_blog_category_description` seos_description ON (seos_data.simple_blog_category_id = seos_description.simple_blog_category_id)";
                    $sql_c = "SELECT count(*) FROM `" . DB_PREFIX . "simple_blog_category` seos_data LEFT JOIN `" . DB_PREFIX . "simple_blog_category_description` seos_description ON (seos_data.simple_blog_category_id = seos_description.simple_blog_category_id)";
                    $sql .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    $sql_c .= " WHERE seos_description.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
                    if ($data['filter_name']) {
                            $sql .= " AND (seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                            $sql_c .= " AND (seos_description.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR seos_description.description LIKE '%" . $this->db->escape($data['filter_name']) . "%' )";
                    }
                    $sql .= " GROUP BY seos_data.simple_blog_category_id";
                    if($data['sort']['simpleblogcategories']){
                        $sort_parts = explode('-', $data['sort']['simpleblogcategories']);
                        $sql .= " ORDER BY ".$sort_parts[1].' '.$sort_parts[0];
                    }
                }
                ///v.1.2
                $query = $this->db->query($sql_c);
                $seosDistributesResult['total_seos'] = (int)$query->row['count(*)'];
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
                $seosDistributes = $query->rows;
                $seosDistributesResult['seos'] = array();
                if($seosDistributes){
                    $whereParts = array();
                    foreach ($seosDistributes as $seosDistribut) {
                        $whereParts[] = "query ='".$query_url_alias."=".$seosDistribut[ $query_url_alias ]."'";
                        $seosDistributesResult['seos'][$seosDistribut[ $query_url_alias ]] = $seosDistribut;
                        $seosDistributesResult['seos'][$seosDistribut[ $query_url_alias ]]['url_alias'] = '';
                    }
                    $where = 'WHERE '.implode(' OR ', $whereParts);
                    $sql = "SELECT * FROM " . DB_PREFIX . "url_alias ".$where;
                    $query = $this->db->query($sql);
                    if($query->rows){
                        foreach ($query->rows as $url_alias) {
                            $url_alias_parts = explode('=', $url_alias['query']);
                            
                            if(isset($seosDistributesResult['seos'][ $url_alias_parts[1] ]) && $seosDistributesResult['seos'][ $url_alias_parts[1] ]){
                                $seosDistributesResult['seos'][ $url_alias_parts[1] ]['url_alias'] = $url_alias['keyword'];
                            }
                        }
                    }
                }

		return $seosDistributesResult;
	}
        public function getShowTable($table) {
            $result = FALSE;
            if(is_string($table)){
                $check = $query = $this->db->query('SHOW TABLES from '.DB_DATABASE.' like "'.$table.'" ');
                if($check->num_rows){
                    $result = TRUE;
                }
            }elseif (is_array($table)) {
                $result = TRUE;
                foreach ($table as $t) {
                    $check = $query = $this->db->query('SHOW TABLES from '.DB_DATABASE.' like "'.$t.'" ');
                    if(!$check->num_rows){
                        $result = FALSE;
                    }
                }
            }
            return $result;
        }
        
        public function checkDBColumn($table,$column) {
            
            $columns = $this->db->query('SHOW COLUMNS FROM ' . DB_PREFIX . $table);
            
            $result = FALSE;
            
            foreach ($columns->rows as $db_column) {
                
                if(  $db_column['Field'] == $column  ){
                    
                    $result = TRUE;
                    
                }
                
            }
            
            return $result;
            
        }
        
}
?>
