<?php
class ControllerAndroidStoreCategoryList extends Controller {
	public function index() {
		$this->load->language('android_store/extra');
		
		$this->document->setTitle($this->config->get('config_meta_title'));

		$data['text_all'] = $this->language->get('text_all');
		
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
		
		
		$data['column_left'] = false;
		$data['column_right'] = false;
		$data['content_top'] = $this->load->controller('android_store/content_top');
		$data['content_bottom'] = $this->load->controller('android_store/content_bottom');
		$data['footer'] = $this->load->controller('android_store/footer');
		$data['header'] = $this->load->controller('android_store/header');

		$this->response->setOutput($this->load->view('android_store/category_list', $data));
	}
}