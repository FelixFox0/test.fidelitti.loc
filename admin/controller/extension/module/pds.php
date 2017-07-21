<?php
class ControllerExtensionModulePds extends Controller {
	private $error = array(); 
	
	public function index() {  
	
		$this->load->language('extension/module/pds');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pds', $this->request->post);			
						
			$this->cache->delete('product');
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/pds', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/module/pds', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['modules'] = array();
		
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		//START
		//entry
		$this->setDataLang($data, 'entry_allow_buying_series');
		$this->setDataLang($data, 'entry_show_thumbnails');
		$this->setDataLang($data, 'entry_thumbnail_size');
		$this->setDataLang($data, 'entry_hide_from_list_view');
		$this->setDataLang($data, 'entry_preview_size');
		$this->setDataLang($data, 'entry_thumbnail_hover_effect');
		$this->setDataLang($data, 'entry_enable_preview');
		
		//text
		$this->setDataLang($data, 'text_general');
		$this->setDataLang($data, 'text_category_page');
		$this->setDataLang($data, 'text_product_page');
		$this->setDataLang($data, 'text_hide_from_list_view');
		$this->setDataLang($data, 'text_hide_items');
		$this->setDataLang($data, 'text_hide_series');
		$this->setDataLang($data, 'text_hide_none');
		$this->setDataLang($data, 'text_show_thumbnails');
		$this->setDataLang($data, 'text_thumbnail_hover_effect');
		$this->setDataLang($data, 'text_rollover');
		$this->setDataLang($data, 'text_preview');
		$this->setDataLang($data, 'text_no_effect');
		$this->setDataLang($data, 'text_enable_preview');
		$this->setDataLang($data, 'text_list_preview_size');
		$this->setDataLang($data, 'text_yes');
		$this->setDataLang($data, 'text_no');
		
		//data
		$this->setData($data, 'pds_allow_buying_series', 0);
		$this->setData($data, 'pds_hide_from_list_view', 'items');
		
		$this->setData($data, 'pds_show_thumbnails', 1);
		$this->setData($data, 'pds_list_thumbnail_width', 20);
		$this->setData($data, 'pds_list_thumbnail_height', 20);
		$this->setData($data, 'pds_thumbnail_hover_effect', 'rollover');
		$this->setData($data, 'pds_list_preview_width', 200);
		$this->setData($data, 'pds_list_preview_height', 200);
		
		$this->setData($data, 'pds_detail_thumbnail_width', 50);
		$this->setData($data, 'pds_detail_thumbnail_height', 50);
		$this->setData($data, 'pds_preview_width', 200);
		$this->setData($data, 'pds_preview_height', 200);
		$this->setData($data, 'pds_enable_preview', 1);
		
		//END
		
		$data['token'] =  $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/pds.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/pds')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	public function install()
	{
		$prefix = DB_PREFIX;
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}special_attribute_group`
(
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	`special_attribute_group_name` varchar(100) NOT NULL DEFAULT '',
	`special_attribute_group_description` varchar(4000) NOT NULL DEFAULT '',
	PRIMARY KEY (`special_attribute_group_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
SELECT special_attribute_group_id FROM `{$prefix}special_attribute_group` WHERE special_attribute_group_id = '2';
EOF;
		$result = $this->db->query($sql);
		if($result->rows == 0)
		{
			$sql =
<<<EOF
INSERT INTO `{$prefix}special_attribute_group` VALUES('2', 'Image', 'Product image');

EOF;
			$this->db->query($sql);
		}
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}special_attribute`
(
	`special_attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	`special_attribute_name` varchar(100) NOT NULL DEFAULT '',
	`special_attribute_value` varchar(2000) NOT NULL DEFAULT '',
	PRIMARY KEY (`special_attribute_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}product_master`
(
	`master_product_id` int(10) NOT NULL,
	`product_id` int(10) unsigned NOT NULL,
	`special_attribute_group_id` int(10) unsigned NOT NULL,
	PRIMARY KEY (`master_product_id`, `product_id`, `special_attribute_group_id`)
);
EOF;
		$this->db->query($sql);
		$sql =
<<<EOF
CREATE TABLE IF NOT EXISTS `{$prefix}product_special_attribute`
(
	`product_special_attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`product_id` int(10) unsigned NOT NULL,
	`special_attribute_id` int(10) NOT NULL,
	PRIMARY KEY (`product_special_attribute_id`)
);
EOF;
		$this->db->query($sql);
		
		$sql =
<<<EOF
SHOW INDEX FROM `{$prefix}product_master` WHERE KEY_NAME = 'product_id';
EOF;
		$result = $this->db->query($sql);
		if(sizeof($result->rows) == 0)
		{
			$sql =
<<<EOF
CREATE INDEX `product_id`
ON `{$prefix}product_master`(`product_id`);
EOF;
			$this->db->query($sql);
		}
	}
	
	public function uninstall()
	{
		/*$prefix = DB_PREFIX;
		$sql =
<<<EOF
DROP TABLE IF EXISTS `{$prefix}special_attribute_group`;
DROP TABLE IF EXISTS `{$prefix}special_attribute`;
DROP TABLE IF EXISTS `{$prefix}product_master`;
DROP TABLE IF EXISTS `{$prefix}product_special_attribute`;
EOF;
		$this->db->query($sql);*/
	}
}
?>