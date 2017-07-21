<?php
class ModelModuleSeoUrlGenerator extends Model {
    
    
    private $eol = "\n";
    private $head_script = array();
    private $body_script = array();
    private $elements = array();
    private $footer_script = array();
    
    private function prepareField($field) {
        if(is_string($field)){
            $field = strip_tags(htmlspecialchars_decode($field));
            $from = array('"', '&', '>', '<', '\'','`','&acute;');
            $to = array('\"', '&amp;', '&gt;', '&lt;', '&apos;','','');
            $field = str_replace($from, $to, $field);
            $field = trim($field);
        }
        return $field;
    }
    
    public function addScript($data=array()) {
        
        $breadcrumb_status = $this->config->get('seourlgenerator_breadcrumb_list');
        $product_microdata_status = $this->config->get('seourlgenerator_product_microdata_status');
        $param = array();
        if(isset($product_microdata_status['status']) && $product_microdata_status['status']){
            $param = $product_microdata_status;
            $product_microdata_status = 1;
        }else{
            $product_microdata_status = 0;
        }
        
        if(!$breadcrumb_status || !$product_microdata_status){
            return '';
        }
        
        if(!$data){
            return;
        }
        $result = $this->setJSONLD($data,$param);
        if($result){
            $this->addScriptToSession();
        }
        
    }
    /*
     * 
    public function addScriptToHead() {
        $jsonldmicrodata = '';
        foreach ($this->body_script as $type => $value){
            $jsonldmicrodata .= $this->head_script[$type];
            $jsonldmicrodata .= json_encode($value);
            $jsonldmicrodata .= $this->footer_script[$type];
        }
        if($jsonldmicrodata){
            $file_path = 'view/javascript/jsonldmicrodata/jsonldmicrodata.js';
            $file = fopen(DIR_APPLICATION.$file_path, 'w+');
            $result = FALSE;
            if(isset($file) && $file){
                $result = fwrite($file, $jsonldmicrodata);
            }
            if($result){
                $this->document->addScript('catalog/'.$file_path);
            }
        }
    }
     * 
     */

    public function addScriptToSession(){
        $jsonldmicrodata = '';
        foreach ($this->body_script as $type => $tmp){
            $jsonldmicrodata .= $this->head_script[$type];
            $jsonldmicrodata.= '{'.$this->eol;
            $jsonldmicrodata.= $this->body_script[$type];
            $jsonldmicrodata.= '}'.$this->eol;
            $jsonldmicrodata .= $this->footer_script[$type];
        }
        if($jsonldmicrodata){
            $this->session->data['microdataseourlgenerator'] = $jsonldmicrodata;
        }
    }
    
    public function getScript(){
        
        $breadcrumb_status = $this->config->get('seourlgenerator_breadcrumb_list');
        $product_microdata_status = $this->config->get('seourlgenerator_product_microdata_status');
        if(isset($product_microdata_status['status']) && $product_microdata_status['status'] && $product_microdata_status['priceCurrency']){
            $product_microdata_status = 1;
        }else{
            $product_microdata_status = 0;
        }
        
        if(!$breadcrumb_status || !$product_microdata_status){
            return '';
        }
        
        if(isset($this->session->data['microdataseourlgenerator'])){
            $script = $this->session->data['microdataseourlgenerator'];
            unset($this->session->data['microdataseourlgenerator']);
            return $script;
        }else{
            return '';
        }
    }
    
    private function setJSONLD($data,$param=array()) {
        //breadcrumbs
        $result = FALSE;
        if(isset($data['breadcrumbs']) && count($data['breadcrumbs'])>1){
            $breadcrumbs = $data['breadcrumbs'];
            if($this->setBreadCrumbs($breadcrumbs)){
                $result = TRUE;
            }
        }
        //product
        if(isset($this->request->get['route']) && $this->request->get['route']=='product/product'){
            if($this->setProduct($data,$param)){
                $result = TRUE;
            }
        }
        return $result;
    }
    
    private function setProduct($product,$param=array()) {
        //var_dump($param);
        //var_dump($product);exit();
        $product['base_data'] = $this->getProduct($product['product_id']);
        $this->head_script['product'] = '<script type="application/ld+json">'.$this->eol;
        $this->footer_script['product'] = '</script>'.$this->eol;
        $this->body_script['product'] = '"@context":"http://schema.org",'.$this->eol;
        $this->body_script['product'] .= '"@type":"Product",'.$this->eol;
        $this->body_script['product'] .= '"name":"'.$this->prepareField($product['heading_title']).'",'.$this->eol;
        if(isset($param['image']) && $param['image']){
            $this->body_script['product'] .= '"image":"'.$this->prepareField($product['popup']).'",'.$this->eol;
        }
        
        if($product['description']){
            $this->body_script['product'] .= '"description":"'.$this->prepareField(strip_tags($product['description'])).'",'.$this->eol;
        }
        
        if(isset($param['brand']) && $param['brand'] && $product['manufacturer']){
            $this->body_script['product'] .= '"brand":'.$this->eol;
            $this->body_script['product'] .= '{'.$this->eol;
            $this->body_script['product'] .= '"@type": "Thing",'.$this->eol;
            $this->body_script['product'] .= '"name": "'.$this->prepareField($product['manufacturer']).'"'.$this->eol;
            $this->body_script['product'] .= '},'.$this->eol;
        }
        
        if(isset($param['aggregateRating']) && $param['aggregateRating'] && $product['rating']){
            $this->body_script['product'] .= '"aggregateRating":'.$this->eol;
            $this->body_script['product'] .= '{'.$this->eol;
            $this->body_script['product'] .= '"@type": "AggregateRating",'.$this->eol;
            $this->body_script['product'] .= '"ratingValue": "'.(float)$product['rating'].'",'.$this->eol;
            $this->body_script['product'] .= '"reviewCount": "'.(int)$product['reviews'].'"'.$this->eol;
            $this->body_script['product'] .= '},'.$this->eol;
        }
        
        $this->body_script['product'] .= '"offers":'.$this->eol;
        $this->body_script['product'] .= '{'.$this->eol;
        $this->body_script['product'] .= '"@type": "Offer",'.$this->eol;
        if(isset($param['availability']) && $param['availability']){
            $this->body_script['product'] .= '"availability":"http://schema.org/InStock",'.$this->eol;
        }
        $this->body_script['product'] .= '"price": "'.(float)$product['base_data']['price'].'",'.$this->eol;
        $this->body_script['product'] .= '"priceCurrency": "'.$param['priceCurrency'].'"'.$this->eol;
        $this->body_script['product'] .= '}';
        return TRUE;
    }
    
    private function setBreadCrumbs($breadcrumbs) {
        $result = FALSE;
        $this->head_script['breadcrumbs'] = '<script type="application/ld+json">'.$this->eol;
        $this->footer_script['breadcrumbs'] = '</script>'.$this->eol;
        $this->body_script['breadcrumbs'] = '"@context":"http://schema.org",'.$this->eol.'"@type":"BreadcrumbList",'.$this->eol.'"itemListElement":'.$this->eol."[";
        $this->elements['breadcrumbs'] = '';
        $number_element = 1;
        foreach ($breadcrumbs as $position => $breadcrumb) {
            $text = $this->prepareField($breadcrumb['text']);
            if($text==''){
                $this->load->language('common/header');
                $text = $this->language->get('text_home');
            }
            $this->elements['breadcrumbs'] .= "{".$this->eol;
                $this->elements['breadcrumbs'] .= '"@type":"ListItem",'.$this->eol;
                $this->elements['breadcrumbs'] .= '"position":'.$number_element.','.$this->eol;
                $this->elements['breadcrumbs'] .= '"item":';
                    $this->elements['breadcrumbs'] .= "{".$this->eol;
                        $this->elements['breadcrumbs'] .= '"@id":"'.$breadcrumb['href'].'",'.$this->eol;
                        $this->elements['breadcrumbs'] .= '"name":"'.$text.'"'.$this->eol;
                    $this->elements['breadcrumbs'] .= "}".$this->eol;
            if($number_element<count($breadcrumbs)){
                $this->elements['breadcrumbs'] .= "},".$this->eol;
            }else{
                $this->elements['breadcrumbs'] .= "}".$this->eol;
            }
            $number_element++;
        }
        if($this->elements['breadcrumbs']){
            $result = TRUE;
            $this->body_script['breadcrumbs'] .= $this->elements['breadcrumbs'];
        }
        $this->body_script['breadcrumbs'] .= ']'.$this->eol;
        return $result;
    }
    
    
    public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'product_id'       => $query->row['product_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}
    
    
}
?>
