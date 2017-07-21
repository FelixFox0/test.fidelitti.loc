<?php
class ControllerAndroidStoreMenuCategory extends Controller { 
	public function index() {
		$this->load->language('android_store/menu_category');

		$data['text_all'] = $this->language->get('text_all');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_gift_voucher'] = $this->language->get('text_gift_voucher');
		
		$data['special'] = $this->url->link('android_store/special', '', true);
		$data['gift_voucher'] = $this->url->link('android_store/voucher', '', true);
		
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {	
			// Level 2
			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach ($children as $child) {
				$filter_data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);

				$children_data[] = array(
					'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href'  => $this->url->link('android_store/category', 'ascpath=' . $category['category_id'] . '_' . $child['category_id'])
				);
			}
			
			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			// Level 1
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'     	  => $category['name']. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('android_store/category', 'ascpath=' . $category['category_id'])
			);
		}
		
		$data['menu_selected_parent_category_id'] = 0;
		
		if (isset($this->request->get['ascpath']) && isset($this->request->get['route'])) {
			$category_path = explode("_", $this->request->get['ascpath']);
			
			if (count($category_path) > 1 && $this->request->get['route'] == "android_store/category") {
				$data['menu_selected_parent_category_id'] = $category_path[0];
			}
		}
		
		return $this->load->view('android_store/menu_category', $data);
	}
}