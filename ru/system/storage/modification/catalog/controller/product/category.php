<?php
class ControllerProductCategory extends Controller {

				private function _removeMfpFromUrl( $url ) {
					if( false !== ( $mfpPos = mb_strpos( $url, '?mfp=', 0, 'utf8' ) ) ) {
						$before = $mfpPos ? mb_substr( $url, 0, $mfpPos, 'utf8' ) : '';
						$after	= '';
				
						if( false !== ( $pos = mb_strpos( $url, '&', $mfpPos+1, 'utf8' ) ) ) {
							$after = '?' . mb_substr( $url, $pos+1, NULL, 'utf8' );
						}
				
						$url = $before . $after;
					} else if( false !== ( $mfpPos = mb_strpos( $url, '&mfp=', 0, 'utf8' ) ) ) {
						$before = $mfpPos ? mb_substr( $url, 0, $mfpPos, 'utf8' ) : '';
						$after	= '';
				
						if( false !== ( $pos = mb_strpos( $url, '&', $mfpPos+1, 'utf8' ) ) ) {
							$after = '?' . mb_substr( $url, $pos+1, NULL, 'utf8' );
						}
				
						$url = $before . $after;
					} else if( false !== ( $mfpPos = mb_strpos( $url, 'mfp,', 0, 'utf8' ) ) ) {
						$before = $mfpPos ? mb_substr( $url, 0, $mfpPos, 'utf8' ) : '';
						$after	= '';
				
						if( false !== ( $pos = mb_strpos( $url, '?', $mfpPos+1, 'utf8' ) ) ) {
							$after = mb_substr( $url, $pos, NULL, 'utf8' );
						} else if( false !== ( $pos = mb_strpos( $url, '&', $mfpPos+1, 'utf8' ) ) ) {
							$after = '?' . mb_substr( $url, $pos+1, NULL, 'utf8' );
						} else if( false !== ( $pos = mb_strpos( $url, '/', $mfpPos+1, 'utf8' ) ) ) {
							$after = mb_substr( $url, $mfpPos, $pos, 'utf8' );
						}
				
						$url = $before . $after;
					}
				
					return $url;
				}
			
	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
		}


				if( ! empty( $this->_request->get['mfp_org_path'] ) ) {
					$this->_request->get['path'] = $this->_request->get['mfp_org_path'];
				}
			
		
				if( ! empty( $this->request->get['mfp_path'] ) ) {
					$category_id = explode( '_', $this->request->get['mfp_path'] );
					$category_id = end( $category_id );
				}
				
				$category_info = $this->model_catalog_category->getCategory($category_id);
				
				if( ! empty( $this->request->get['mfp_org_path'] ) ) {
					$category_id = explode( '_', $this->request->get['mfp_org_path'] );
					$category_id = end( $category_id );
				}
			

		if ($category_info) {

			if ($category_info['meta_title']) {
				$this->document->setTitle($category_info['meta_title']);
			} else {
				$this->document->setTitle($category_info['name']);
			}

			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);

			if ($category_info['meta_h1']) {
				$data['heading_title'] = $category_info['meta_h1'];
			} else {
				$data['heading_title'] = $category_info['name'];
			}

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $category_info['name'],
				'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'])
			);

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
				$this->document->setOgImage($data['thumb']);
			} else {
				$data['thumb'] = '';
			}


			if ($category_info['categoryBanner']) {
				$data['thumbcategoryBanner'] = $this->model_tool_image->resize($category_info['categoryBanner'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
				$this->document->setOgImage($data['thumbcategoryBanner']);
			} else {
				$data['thumbcategoryBanner'] = '';
			}
			if ($category_info['categoryBannerTwo']) {
				$data['thumbcategoryBannerTwo'] = $this->model_tool_image->resize($category_info['categoryBannerTwo'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
				$this->document->setOgImage($data['thumbcategoryBannerTwo']);
			} else {
				$data['thumbcategoryBannerTwo'] = '';
			}



			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = $this->url->link('product/compare');

//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


				$fmSettings = $this->config->get('mega_filter_settings');
				
				if( ! empty( $fmSettings['not_remember_filter_for_subcategories'] ) && false !== ( $mfpPos = strpos( $url, '&mfp=' ) ) ) {
					$mfUrlBeforeChange = $url;
					$mfSt = mb_strpos( $url, '&', $mfpPos+1, 'utf-8');
					$url = $mfSt === false ? '' : mb_substr($url, $mfSt, mb_strlen( $url, 'utf-8' ), 'utf-8');
				} else if( empty( $fmSettings['not_remember_filter_for_subcategories'] ) && false !== ( $mfpPos = strpos( $url, '&mfp=' ) ) ) {
					$mfUrlBeforeChange = $url;
					$url = preg_replace( '/,?path\[[0-9_]+\]/', '', $url );
				}
			
			$data['categories'] = array();

			$results = $this->model_catalog_category->getCategories($category_id);

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);
				//size subcategory image
				if ($result['image']) {
	           $image = $this->model_tool_image->resize($result['image'], 104, 104);
	         	} else {
	           $image = $this->model_tool_image->resize('placeholder.png', 104, 104);
	         	}


	         	//dop image 
				if ($result['imagetwo']) {
	           	$imagetwo = $this->model_tool_image->resize($result['imagetwo'], 1400, 405);
	         	} else {
	            $imagetwo = $this->model_tool_image->resize('placeholder.png', 1400, 405);
	         	}
	         	//end dop image 
	         	//dop image 
				if ($result['imagethree']) {
	           	$imagethree = $this->model_tool_image->resize($result['imagethree'], 1200, 237);
	         	} else {
	            $imagethree = $this->model_tool_image->resize('placeholder.png', 1200, 237);
	         	}
	         	//end dop image 
	         	//product images one
				if ($result['productimgone']) {
	           	$productimgone = $this->model_tool_image->resize($result['productimgone'], 605, 313);
	         	} else {
	            $productimgone = $this->model_tool_image->resize('placeholder.png', 605, 313);
	         	}
	         	//product images one
	         	//product images two
				if ($result['productImgTwo']) {
	           	$productImgTwo = $this->model_tool_image->resize($result['productImgTwo'], 296, 513);
	         	} else {
	            $productImgTwo = $this->model_tool_image->resize('placeholder.png', 296, 513);
	         	}
	         	//product images two
	         	//product images three 
				if ($result['productImgThree']) {
	           	$productImgThree = $this->model_tool_image->resize($result['productImgThree'], 497, 513);
	         	} else {
	            $productImgThree = $this->model_tool_image->resize('placeholder.png', 497, 513);
	         	}
	         	//end product images three


	         	//category banner products
				if ($result['categoryBanner']) {
	           	$categoryBanner = $this->model_tool_image->resize($result['categoryBanner'], 497, 513);
	         	} else {
	            $categoryBanner = $this->model_tool_image->resize('placeholder.png', 497, 513);
	         	}
	         	//end category banner products

	         	//category banner products two
				if ($result['categoryBannerTwo']) {
	           	$categoryBannerTwo = $this->model_tool_image->resize($result['categoryBannerTwo'], 497, 513);
	         	} else {
	            $categoryBannerTwo = $this->model_tool_image->resize('placeholder.png', 497, 513);
	         	}
	         	//end category banner products two
	         	//end size subcategory image
				$data['categories'][] = array(
					'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'thumb'       => $image, //sub category image
					'imagetwo'    => $imagetwo, //dop image
					'imagethree' => $imagethree, //dop image three
					'productimgone'    => $productimgone, //product images one
					'productImgTwo'    => $productImgTwo, //product images two
					'productImgThree'    => $productImgThree, //product images three
					'categoryBanner'    => $categoryBanner, //category banner products
					'categoryBannerTwo'    => $categoryBannerTwo, //category banner products two
					'short_description' => substr(strip_tags(html_entity_decode($result['description'])),0,350). "...",
					'description_two' => html_entity_decode($result['description_two'], ENT_QUOTES, 'UTF-8'),
					'textbuttom' => $result['textbuttom'],//name title button
					'titletwo' => $result['titletwo'],// name title two
					'nameimgthree' => $result['nameimgthree'], //name images absolute three
					'linkbuttom' => $result['linkbuttom'],//link button
					'prodNameImgOne' => $result['prodNameImgOne'],//Product name image one
					'prodDescImgOne' => $result['prodDescImgOne'],//Product desc image one
					'prodNameImgTwo' => $result['prodNameImgTwo'],//Product name image two
					'prodDescImgTwo' => html_entity_decode($result['prodDescImgTwo'], ENT_QUOTES, 'UTF-8'),//Product desc image two
					'linkButProdTwo' => $result['linkButProdTwo'],//Product button image two
					'NameButProdTwo' => $result['NameButProdTwo'],//Product button image two
					'category_id' => $result['category_id'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)
				);
			}


				if( isset( $mfUrlBeforeChange ) ) {
					$url = $mfUrlBeforeChange;
					unset( $mfUrlBeforeChange );
				}
			
			$data['products'] = array();

			$filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);


				$fmSettings = $this->config->get('mega_filter_settings');
		
				if( ! empty( $fmSettings['show_products_from_subcategories'] ) ) {
					if( ! empty( $fmSettings['level_products_from_subcategories'] ) ) {
						$fmLevel = (int) $fmSettings['level_products_from_subcategories'];
						$fmPath = explode( '_', empty( $this->request->get['path'] ) ? '' : $this->request->get['path'] );

						if( $fmPath && count( $fmPath ) >= $fmLevel ) {
							$filter_data['filter_sub_category'] = '1';
						}
					} else {
						$filter_data['filter_sub_category'] = '1';
					}
				}
				
				if( ! empty( $this->request->get['manufacturer_id'] ) ) {
					$filter_data['filter_manufacturer_id'] = (int) $this->request->get['manufacturer_id'];
				}
			
			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => ($result['minimum'] > 0) ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
				);
			}

//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);

//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			






			$template = 'product/category';

            // Custom template module
            $this->load->model('setting/setting');

            $custom_template_module = $this->model_setting_setting->getSetting('custom_template_module');

            $customer_group_id = $this->customer->getGroupId();

            if ($this->config->get('config_theme') == 'theme_default') {
                $directory = $this->config->get('theme_default_directory');
            } else {
                $directory = $this->config->get('config_theme');
            }

            if(!empty($custom_template_module['custom_template_module'])){
                foreach ($custom_template_module['custom_template_module'] as $key => $module) {
                    if (($module['type'] == 0) && !empty($module['categories'])) {
                        if ((isset($module['customer_groups']) && in_array($customer_group_id, $module['customer_groups'])) || !isset($module['customer_groups']) || empty($module['customer_groups'])){

                            if (in_array($category_id, $module['categories'])) {
                                if (file_exists(DIR_TEMPLATE . $directory . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $module['template_name'] . '.tpl')) {
                                    $template = $module['template_name'];
                                }
                            }

                        } // customer groups

                    }
                }
            }

            $template = str_replace('\\', '/', $template);


				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$this->load->model( 'module/mega_filter' );
				
					if( class_exists( 'MegaFilterCore' ) ) {
						$calculate_number_of_products = false;
				
						$settings = $this->config->get('mega_filter_module');
						$settings = isset( $settings[$this->request->get['mfilterIdx']] ) && isset( $this->request->get['mfilterIdx'] ) 
							? $settings[$this->request->get['mfilterIdx']] : array();
				
						if( ! empty( $settings['configuration'] ) ) {
							$calculate_number_of_products = ! empty( $settings['configuration']['calculate_number_of_products'] );
						} else {
							$settings = $this->config->get('mega_filter_settings');
							$calculate_number_of_products = ! empty( $settings['calculate_number_of_products'] );
						}
				
						$seo_settings	= $this->config->get('mega_filter_seo');
				
						$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );

						if( isset( $this->request->get['mfilterBTypes'] ) ) {
							$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
						}

						if( ! empty( $seo_settings['enabled'] ) || $calculate_number_of_products || in_array( 'categories:tree', $baseTypes ) ) {
							if( ! $calculate_number_of_products ) {
								$baseTypes = array( 'categories:tree' );
							}

							$this->load->model( 'module/mega_filter' );

							$idx = 0;

							if( isset( $this->request->get['mfilterIdx'] ) )
								$idx = (int) $this->request->get['mfilterIdx'];

							$data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
						}

						$data['header'] = $data['column_left'] = $data['column_right'] = $data['content_top'] = $data['content_bottom'] = $data['footer'] = '';
					}
				}
				
				if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$data['breadcrumbs'][$mfK]['href'] = $this->_removeMfpFromUrl( $data['breadcrumbs'][$mfK]['href'] );
					}
				}
			
            $this->response->setOutput($this->load->view($template, $data));
            // Custom template module
            





            
		} else {
//BOF Product Series	
			$pds_show_thumbnails = $this->getData('pds_show_thumbnails', 1);
			
			if($pds_show_thumbnails)
			{
				if(isset($data['products']))
				{
					$pds_list_thumbnail_width = $this->getData('pds_list_thumbnail_width', 20);
					$pds_list_thumbnail_height = $this->getData('pds_list_thumbnail_height', 20);
					$pds_thumbnail_hover_effect = $this->getData('pds_thumbnail_hover_effect', 'rollover');
					
					if($pds_thumbnail_hover_effect == 'rollover')
					{
						$pds_list_hover_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
						$pds_list_hover_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
						$pds_list_thumbnail_class = 'pds-thumb-rollover';
					}
					else if($pds_thumbnail_hover_effect == 'preview')
					{
						$pds_list_hover_width = $this->getData('pds_list_preview_width', 200);
						$pds_list_hover_height = $this->getData('pds_list_preview_height', 200);
						$pds_list_thumbnail_class = 'preview';
					}
					else //none
					{
						$pds_list_thumbnail_class = '';
					}
					
					$this->load->model('catalog/product_master');
					$linkedProducts = $this->model_catalog_product_master->getAllLinkedProducts('2'); //2 is Image
					
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
						
						foreach ($linkedProducts as $result) {
							if($result['master_product_id'] == $product['product_id'])
							{
								$product_pds_image = $result['special_attribute_value'] != '' 
								? $this->model_tool_image->resize($result['special_attribute_value'], $pds_list_thumbnail_width, $pds_list_thumbnail_height)
								: $this->model_tool_image->resize($result['image'], $pds_list_thumbnail_width, $pds_list_thumbnail_height);
								
								if($pds_thumbnail_hover_effect == 'rollover' || $pds_thumbnail_hover_effect == 'preview')
								{
									$product_pds_image_hover = $this->model_tool_image->resize($result['image'], $pds_list_hover_width, $pds_list_hover_height);
								}
								else //none
								{
									$product_pds_image_hover = '';
								}
							
								$product['pds'][] = array(
									'product_link' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id']),
									'product_name' => $result['product_name'],
									'product_pds_image' => $product_pds_image,
									'product_master_image' => $product['thumb'],
									'product_pds_image_hover' => $product_pds_image_hover,
									'pds_list_thumbnail_class' => $pds_list_thumbnail_class
								);
							}
						}
					}
				}
			}
			else
			{
				if(isset($data['products']))
				{
					foreach ($data['products'] as &$product) //& is for reference
					{
						$product['pds'] = array();
					}
				}
			}
			//EOF Product Series
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');


				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$this->load->model( 'module/mega_filter' );
				
					if( class_exists( 'MegaFilterCore' ) ) {
						$calculate_number_of_products = false;
				
						$settings = $this->config->get('mega_filter_module');
						$settings = isset( $settings[$this->request->get['mfilterIdx']] ) && isset( $this->request->get['mfilterIdx'] ) 
							? $settings[$this->request->get['mfilterIdx']] : array();
				
						if( ! empty( $settings['configuration'] ) ) {
							$calculate_number_of_products = ! empty( $settings['configuration']['calculate_number_of_products'] );
						} else {
							$settings = $this->config->get('mega_filter_settings');
							$calculate_number_of_products = ! empty( $settings['calculate_number_of_products'] );
						}
				
						$seo_settings	= $this->config->get('mega_filter_seo');
				
						$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );

						if( isset( $this->request->get['mfilterBTypes'] ) ) {
							$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
						}

						if( ! empty( $seo_settings['enabled'] ) || $calculate_number_of_products || in_array( 'categories:tree', $baseTypes ) ) {
							if( ! $calculate_number_of_products ) {
								$baseTypes = array( 'categories:tree' );
							}

							$this->load->model( 'module/mega_filter' );

							$idx = 0;

							if( isset( $this->request->get['mfilterIdx'] ) )
								$idx = (int) $this->request->get['mfilterIdx'];

							$data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
						}

						$data['header'] = $data['column_left'] = $data['column_right'] = $data['content_top'] = $data['content_bottom'] = $data['footer'] = '';
					}
				}
				
				if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$data['breadcrumbs'][$mfK]['href'] = $this->_removeMfpFromUrl( $data['breadcrumbs'][$mfK]['href'] );
					}
				}
			
			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
}
