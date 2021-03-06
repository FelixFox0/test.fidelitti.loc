<?php
class ControllerProductCategory extends Controller {
	public function index() {
 $this->document->addScript('catalog/view/javascript/aproducts.js'); 
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
			$sort = 'p2c.sort_order'; //! FOR CUSTOM SORT
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

		$category_info = $this->model_catalog_category->getCategory($category_id);

                /* Brainy Filter (brainyfilter.xml) - Start ->*/
                if (!$category_info) {
                    $this->load->language('extension/module/brainyfilter');
                    $category_info = array(
                        'name' => $this->language->get('text_bf_page_title'),
                        'description' => '',
                        'meta_description' => '',
                        'meta_keyword' => '',
                        'meta_title' => $this->language->get('text_bf_page_title'),
                        'image' => '',
                    );
                    $this->request->get['path'] = 0;
                    $showCategories = false;
                    $route = 'extension/module/brainyfilter/filter';
                    $path  = '';
                } else {
                    $route = 'product/category';
                    $path  = 'path=' . $this->request->get['path'];
                    $showCategories = true;
                }
                /* Brainy Filter (brainyfilter.xml) - End ->*/
                

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
				'href' => $this->url->link($route, $path)
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

			if ($category_info['imagetwo']) {
				$data['thumbimagetwo'] = $this->model_tool_image->resize($category_info['imagetwo'], 1400, 405);
				$this->document->setOgImage($data['thumbimagetwo']);
			} else {
				$data['thumbimagetwo'] = '';
			}
			if ($category_info['imagetwotwo']) {
				$data['thumbimagetwotwo'] = $this->model_tool_image->resize($category_info['imagetwotwo'], 1400, 405);
				$this->document->setOgImage($data['thumbimagetwotwo']);
			} else {
				$data['thumbimagetwotwo'] = '';
			}
			if ($category_info['imagetwothree']) {
				$data['thumbimagetwothree'] = $this->model_tool_image->resize($category_info['imagetwothree'], 1400, 405);
				$this->document->setOgImage($data['thumbimagetwothree']);
			} else {
				$data['thumbimagetwothree'] = '';
			}

			if ($category_info['top_tab_icon']) {
				$data['thumbtop_tab_icon'] = $this->model_tool_image->resize($category_info['top_tab_icon'], 100, 100);
				$this->document->setOgImage($data['thumbtop_tab_icon']);
			} else {
				$data['thumbtop_tab_icon'] = '';
			}

			if ($category_info['top_tab_icon_two']) {
				$data['thumbtop_tab_icon_two'] = $this->model_tool_image->resize($category_info['top_tab_icon_two'], 100, 100);
				$this->document->setOgImage($data['thumbtop_tab_icon_two']);
			} else {
				$data['thumbtop_tab_icon_two'] = '';
			}

			if ($category_info['top_tab_icon_three']) {
				$data['thumbtop_tab_icon_three'] = $this->model_tool_image->resize($category_info['top_tab_icon_three'], 100, 100);
				$this->document->setOgImage($data['thumbtop_tab_icon_three']);
			} else {
				$data['thumbtop_tab_icon_three'] = '';
			}


			if ($category_info['imagethree']) {
				$data['thumbimagethree'] = $this->model_tool_image->resize($category_info['imagethree'], 1438, 235);
				$this->document->setOgImage($data['thumbimagethree']);
			} else {
				$data['thumbimagethree'] = '';
			}



			if ($category_info['productimgone']) {
				$data['thumbproductimgone'] = $this->model_tool_image->resize($category_info['productimgone'], 607, 313);
				$this->document->setOgImage($data['thumbproductimgone']);
			} else {
				$data['thumbproductimgone'] = '';
			}

			if ($category_info['productImgTwo']) {
				$data['thumbproductImgTwo'] = $this->model_tool_image->resize($category_info['productImgTwo'], 297, 512);
				$this->document->setOgImage($data['thumbproductImgTwo']);
			} else {
				$data['thumbproductImgTwo'] = '';
			}

			if ($category_info['productImgThree']) {
				$data['thumbproductImgThree'] = $this->model_tool_image->resize($category_info['productImgThree'], 499, 512);
				$this->document->setOgImage($data['thumbproductImgThree']);
			} else {
				$data['thumbproductImgThree'] = '';
			}


			/////////
			if ($category_info['imagethreetwo']) {
				$data['thumbimagethreetwo'] = $this->model_tool_image->resize($category_info['imagethreetwo'], 1438, 235);
				$this->document->setOgImage($data['thumbimagethreetwo']);
			} else {
				$data['thumbimagethreetwo'] = '';
			}



			if ($category_info['productimgonetwo']) {
				$data['thumbproductimgonetwo'] = $this->model_tool_image->resize($category_info['imagethreetwo'], 607, 313);
				$this->document->setOgImage($data['thumbproductimgonetwo']);
			} else {
				$data['thumbproductimgonetwo'] = '';
			}

			if ($category_info['productImgTwotwo']) {
				$data['thumbproductImgTwotwo'] = $this->model_tool_image->resize($category_info['productImgTwotwo'], 297, 512);
				$this->document->setOgImage($data['thumbproductImgTwotwo']);
			} else {
				$data['thumbproductImgTwotwo'] = '';
			}

			if ($category_info['productImgThreetwo']) {
				$data['thumbproductImgThreetwo'] = $this->model_tool_image->resize($category_info['productImgThree'],499, 512);
				$this->document->setOgImage($data['thumbproductImgThreetwo']);
			} else {
				$data['thumbproductImgThreetwo'] = '';
			}
			///////////////
			if ($category_info['imagethreethree']) {
				$data['thumbimagethreethree'] = $this->model_tool_image->resize($category_info['imagethreethree'], 1438, 235);
				$this->document->setOgImage($data['thumbimagethreethree']);
			} else {
				$data['thumbimagethreethree'] = '';
			}



			if ($category_info['productimgonethree']) {
				$data['thumbproductimgonethree'] = $this->model_tool_image->resize($category_info['imagethree'], 607, 313);
				$this->document->setOgImage($data['thumbproductimgonethree']);
			} else {
				$data['thumbproductimgonethree'] = '';
			}

			if ($category_info['productImgTwothree']) {
				$data['thumbproductImgTwothree'] = $this->model_tool_image->resize($category_info['productImgTwothree'], 297, 512);
				$this->document->setOgImage($data['thumbproductImgTwothree']);
			} else {
				$data['thumbproductImgTwothree'] = '';
			}

			if ($category_info['productImgThreethree']) {
				$data['thumbproductImgThreethree'] = $this->model_tool_image->resize($category_info['productImgThreethree'], 499, 512);
				$this->document->setOgImage($data['thumbproductImgThreethree']);
			} else {
				$data['thumbproductImgThreethree'] = '';
			}



			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['power_ct_block'] = html_entity_decode($category_info['power_ct_block'], ENT_QUOTES, 'UTF-8');
			$data['descbannerone'] = html_entity_decode($category_info['descbannerone'], ENT_QUOTES, 'UTF-8');
			$data['titletwo'] = html_entity_decode($category_info['titletwo'], ENT_QUOTES, 'UTF-8');
			$data['description_two'] = html_entity_decode($category_info['description_two'], ENT_QUOTES, 'UTF-8');
			$data['linkbuttom'] = html_entity_decode($category_info['linkbuttom'], ENT_QUOTES, 'UTF-8');
			$data['textbuttom'] = html_entity_decode($category_info['textbuttom'], ENT_QUOTES, 'UTF-8');
			$data['nameimgthree'] = html_entity_decode($category_info['nameimgthree'], ENT_QUOTES, 'UTF-8');

			$data['prodDescImgOne'] = html_entity_decode($category_info['prodDescImgOne'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgOne'] = html_entity_decode($category_info['prodNameImgOne'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgTwo'] = html_entity_decode($category_info['prodNameImgTwo'], ENT_QUOTES, 'UTF-8');
			$data['prodDescImgTwo'] = html_entity_decode($category_info['prodDescImgTwo'], ENT_QUOTES, 'UTF-8');
			$data['linkButProdTwo'] = html_entity_decode($category_info['linkButProdTwo'], ENT_QUOTES, 'UTF-8');
			$data['NameButProdTwo'] = html_entity_decode($category_info['NameButProdTwo'], ENT_QUOTES, 'UTF-8');

			//////
			$data['descbanneronetwo'] = html_entity_decode($category_info['descbanneronetwo'], ENT_QUOTES, 'UTF-8');
			$data['titletwotwo'] = html_entity_decode($category_info['titletwotwo'], ENT_QUOTES, 'UTF-8');
			$data['description_twotwo'] = html_entity_decode($category_info['description_twotwo'], ENT_QUOTES, 'UTF-8');
			$data['linkbuttomtwo'] = html_entity_decode($category_info['linkbuttomtwo'], ENT_QUOTES, 'UTF-8');
			$data['textbuttomtwo'] = html_entity_decode($category_info['textbuttomtwo'], ENT_QUOTES, 'UTF-8');
			$data['nameimgthreetwo'] = html_entity_decode($category_info['nameimgthreetwo'], ENT_QUOTES, 'UTF-8');

			$data['prodDescImgOnetwo'] = html_entity_decode($category_info['prodDescImgOnetwo'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgOnetwo'] = html_entity_decode($category_info['prodNameImgOnetwo'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgTwotwo'] = html_entity_decode($category_info['prodNameImgTwotwo'], ENT_QUOTES, 'UTF-8');
			$data['prodDescImgTwotwo'] = html_entity_decode($category_info['prodDescImgTwotwo'], ENT_QUOTES, 'UTF-8');
			$data['linkButProdTwotwo'] = html_entity_decode($category_info['linkButProdTwotwo'], ENT_QUOTES, 'UTF-8');
			$data['NameButProdTwotwo'] = html_entity_decode($category_info['NameButProdTwotwo'], ENT_QUOTES, 'UTF-8');
			///////
			$data['descbanneronethree'] = html_entity_decode($category_info['descbanneronethree'], ENT_QUOTES, 'UTF-8');
			$data['titletwothree'] = html_entity_decode($category_info['titletwothree'], ENT_QUOTES, 'UTF-8');
			$data['description_twothree'] = html_entity_decode($category_info['description_twothree'], ENT_QUOTES, 'UTF-8');
			$data['linkbuttomthree'] = html_entity_decode($category_info['linkbuttomthree'], ENT_QUOTES, 'UTF-8');
			$data['textbuttomthree'] = html_entity_decode($category_info['textbuttomthree'], ENT_QUOTES, 'UTF-8');
			$data['nameimgthreethree'] = html_entity_decode($category_info['nameimgthreethree'], ENT_QUOTES, 'UTF-8');

			$data['prodDescImgOnethree'] = html_entity_decode($category_info['prodDescImgOnethree'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgOnethree'] = html_entity_decode($category_info['prodNameImgOnethree'], ENT_QUOTES, 'UTF-8');
			$data['prodNameImgTwothree'] = html_entity_decode($category_info['prodNameImgTwothree'], ENT_QUOTES, 'UTF-8');
			$data['prodDescImgTwothree'] = html_entity_decode($category_info['prodDescImgTwothree'], ENT_QUOTES, 'UTF-8');
			$data['linkButProdTwothree'] = html_entity_decode($category_info['linkButProdTwothree'], ENT_QUOTES, 'UTF-8');
			$data['NameButProdTwothree'] = html_entity_decode($category_info['NameButProdTwothree'], ENT_QUOTES, 'UTF-8');


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

			$data['categories'] = array();

			
                /* Brainy Filter (brainyfilter.xml) - Start ->*/
                if ($showCategories) {
                $results = $this->model_catalog_category->getCategories($category_id);
                } else {
                    $results = array();
                }
                /* Brainy Filter (brainyfilter.xml) - End ->*/
            
 $data['category_id']=$category_id; 

			$data['lazy_load_width_height'] = 'width="' . $this->config->get('config_image_product_width') . '" height="' . $this->config->get('config_image_product_height') . '"';


				$data['lazy_load_width_height'] = 'width="' . $this->config->get('config_image_product_width') . '" height="' . $this->config->get('config_image_product_height') . '"';
			
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
					'href' => $this->url->link($route, $path . '_' . $result['category_id'] . $url)
				);
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

            $filter_data['filter_bfilter'] = true;
			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

            $filter_data['filter_bfilter'] = true;
			$results = $this->model_catalog_product->getProducts($filter_data);

			// echo "<pre>";
			// var_dump($results);
			// echo "</pre>";
			// die;

			$data['lazy_load_width_height'] = 'width="' . $this->config->get('config_image_product_width') . '" height="' . $this->config->get('config_image_product_height') . '"';


				$data['lazy_load_width_height'] = 'width="' . $this->config->get('config_image_product_width') . '" height="' . $this->config->get('config_image_product_height') . '"';
			
			foreach ($results as $result) {
				//dop img product
				$results_img = $this->model_catalog_product->getProductImages($result['product_id']);
				$dop_img = array();
				foreach ($results_img as $result_img) {

					if ($result_img['image']) {
						$image_dop = $this->model_tool_image->resize($result_img['image'], 274, 497);
					} else {
						$image_dop = false;
					}
					$dop_img[2] = $image_dop;
					}
				//end dop img product
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
					'dop_img' => $dop_img,
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => ($result['minimum'] > 0) ? $result['minimum'] : 1,
					'rating'      => $rating,
					'fastorder'     => $this->load->controller('product/fastorder', $product_info = $this->model_catalog_product->getProduct( isset($result['product_id']) ? $result['product_id'] :'' )), // FastOrder
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

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

 if (isset($this->request->get['man_id'])) { $url .= '&man_id=' .
                $this->request->get['man_id']; } 
			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p2c.sort_order-ASC', //! FOR CUSTOM SORT
				'href'  => $this->url->link($route, $path . '&sort=p2c.sort_order&order=ASC' . $url) //! FOR CUSTOM SORT
			);
/*
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link($route, $path . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link($route, $path . '&sort=pd.name&order=DESC' . $url)
			);
*/
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link($route, $path . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link($route, $path . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link($route, $path . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link($route, $path . '&sort=rating&order=ASC' . $url)
				);
			}
/*
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link($route, $path . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link($route, $path . '&sort=p.model&order=DESC' . $url)
			);
*/
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

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

 if (isset($this->request->get['man_id'])) { $url .= '&man_id=' .
                $this->request->get['man_id']; } 
			$data['limits'] = array();

			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link($route, $path . $url . '&limit=' . $value)
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
			$pagination->url = $this->url->link($route, $path . $url . '&page={page}');

			$data['pagination'] = $pagination->render();
 $data['totalproducts'] = $product_total; $data['default_limit'] =
                $this->config->get($this->config->get('config_theme') . '_product_limit'); $data['limit']=$limit;
                $data['page']=$page; 

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html

                /* Brainy Filter (brainyfilter.xml) - Start ->*/
                if (isset($category_info['category_id'])) {
                /* Brainy Filter (brainyfilter.xml) - End ->*/
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

                /* Brainy Filter (brainyfilter.xml) - Start ->*/
                }
                /* Brainy Filter (brainyfilter.xml) - End ->*/

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
			 $data['fastorder'] = $this->load->controller('product/fastorder', $product_info = $this->model_catalog_product->getProduct($result['product_id'])); // FastOrder

			






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

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
}
