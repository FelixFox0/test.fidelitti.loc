<?php
class ControllerAndroidStoreMenuFilter extends Controller { 
	public function index() {
		
		// Check if visitor is on category page and if category id is available
		if (isset($this->request->get['route']) && $this->request->get['route'] == 'android_store/category') {
			
			if (isset($this->request->get['ascpath'])) {
				$parts = explode('_', (string)$this->request->get['ascpath']);
			} else {
				$parts = array();
			}

			$category_id = end($parts);

			$this->load->model('catalog/category');

			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$this->load->language('android_store/menu_filter');

				$data['heading_title'] = $this->language->get('heading_title');
				
				$data['text_subcategories'] = $this->language->get('text_subcategories');

				$data['button_filter'] = $this->language->get('button_filter'); 

				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['action'] = str_replace('&amp;', '&', $this->url->link('android_store/category', 'ascpath=' . $this->request->get['ascpath'] . $url));

				if (isset($this->request->get['filter'])) {
					$data['filter_category'] = explode(',', $this->request->get['filter']);
				} else {
					$data['filter_category'] = array();
				}

				$this->load->model('catalog/product');

				$data['filter_groups'] = array();

				$filter_groups = $this->model_catalog_category->getCategoryFilters($category_id);

				if ($filter_groups) {
					foreach ($filter_groups as $filter_group) {
						$childen_data = array();

						foreach ($filter_group['filter'] as $filter) {
							$filter_data = array(
								'filter_category_id' => $category_id,
								'filter_filter'      => $filter['filter_id']
							);

							$childen_data[] = array(
								'filter_id' => $filter['filter_id'],
								'name'      => $filter['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '')
							);
						}

						$data['filter_groups'][] = array(
							'filter_group_id' => $filter_group['filter_group_id'],
							'name'            => $filter_group['name'],
							'filter'          => $childen_data
						);
					}
				}
				
				// required only in subcategories link 
				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}
				
				$data['sub_categories'] = array();

				$sub_categories = $this->model_catalog_category->getCategories($category_id);

				foreach ($sub_categories as $sub_category) {
					$filter_data = array(
						'filter_category_id'  => $sub_category['category_id'],
						'filter_sub_category' => true
					);

					$data['sub_categories'][] = array(
						'name'  => $sub_category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('android_store/category', 'ascpath=' . $this->request->get['ascpath'] . '_' . $sub_category['category_id'] . $url)
					);
				}
				
				if ($data['filter_groups'] || $data['sub_categories']) {	
					return $this->load->view('android_store/menu_filter', $data);
				}	
			}
		}
	}	
}