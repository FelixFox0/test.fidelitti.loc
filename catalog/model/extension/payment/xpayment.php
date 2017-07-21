<?php
class ModelExtensionPaymentXpayment extends Model {
	function getMethod($address, $total) {
	
		$this->load->language('extension/payment/xpayment');
		$this->load->model('catalog/product');
		
		if(isset($this->session->data['default']) && isset($this->session->data['default']['shipping_address']) && $this->session->data['default']['shipping_address']) {
		  $address = $this->session->data['default']['shipping_address'];
		}

		$language_id=$this->config->get('config_language_id');
		$store_id=(isset($_POST['store_id']))?$_POST['store_id']:$this->config->get('config_store_id');
		
		$is_admin = (isset($_REQUEST['api']) || (isset($_REQUEST['route']) && strpos($_REQUEST['route'],'api')!==false))?true:false;
		
		if(isset($_GET['store_id']) && $_GET['store_id'] != "") {
		     $store_id = $_GET['store_id'];
		 } 
		
		$shipping_method=isset($this->session->data['shipping_method']['code'])?$this->session->data['shipping_method']['code']:'';
		if(isset($this->session->data['default']['shipping_method']['code'])) $shipping_method = $this->session->data['default']['shipping_method']['code'];
	
		$method_data = array();
	    $x_method = array();
		$sort_data = array();
	    
	    $xpayment_debug=$this->config->get('xpayment_debug');
	    
		$xpayment=$this->config->get('xpayment');
		if($xpayment)
		$xpayment=unserialize(base64_decode($xpayment));
		
		$currency_code=$this->config->get('config_currency');
        $order_info='';
        if(isset($this->session->data['order_id'])){
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        }
        
        if(isset($this->request->get['order_id'])){
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->request->get['order_id']);
        }
        
        $is_admin = (isset($_REQUEST['api']) || (isset($_REQUEST['route']) && strpos($_REQUEST['route'],'api')!==false))?true:false;
      
        if($is_admin && isset($_REQUEST["order_id"]) && $_REQUEST["order_id"]) {
           $this->load->model('checkout/order');
           $order_info = $this->model_checkout_order->getOrder($_REQUEST["order_id"]);
        }
        
       if($order_info){
            $currency_code=$order_info['currency_code'];  
            if(!$shipping_method){
              $shipping_method=$order_info['shipping_code'];
            }
        }
		
		$cart_products=$this->cart->getProducts();
		$cart_weight=$this->cart->getWeight(); 
		$cart_quantity=$this->cart->countProducts();
		$cart_subtotal=$this->cart->getSubTotal();
		$cart_total=$this->cart->getTotal();
		
		$coupon_value=0;
	
	    $xtotals = array();
		$xtaxes = $this->cart->getTaxes();
		$xtotal = $cart_total;

		// Because __call can not keep var references so we put them into an array. 
		 $xtotal_data = array(
			'totals' => &$xtotals,
			'taxes'  => &$xtaxes,
			'total'  => &$xtotal
		 );
		
		$coupon = '';
		
		if (isset($this->session->data['default']['coupon']) && $this->session->data['default']['coupon']) {
		  $coupon = $this->session->data['default']['coupon'];
		}
		
		if (isset($this->session->data['coupon']) && $this->session->data['coupon']) {
		  $coupon = $this->session->data['coupon'];
		}
		
		if ($coupon) {
		    
			if ($this->config->get('coupon_status')) {
				$this->load->model('extension/total/coupon');
				$this->{'model_extension_total_coupon'}->getTotal($xtotal_data);
			}
	       if(isset($xtotal_data['totals'][0]['code']) && $xtotal_data['totals'][0]['code']=='coupon'){
	         $coupon_value=$xtotal_data['totals'][0]['value'];
	       } 
		}
		
		$cart_categories=array();
		$cart_product_ids=array();
		$cart_manufacturers=array();
		$multi_category=false;
		foreach($cart_products as $inc=>$product){
			$product_categories=$this->model_catalog_product->getCategories($product['product_id']);
			$cart_product_ids[]=$product['product_id']; 
			
			$cart_products[$inc]['categories']=array();
			if($product_categories){
				 if(count($product_categories)>1)$multi_category=true;
				 foreach($product_categories as $category){
					$cart_categories[]=$category['category_id'];  
					$cart_products[$inc]['categories'][]=$category['category_id']; //store for future use 
				 } 
			 }		
			
			$product_info=$this->model_catalog_product->getProduct($product['product_id']);
			if($product_info){
				$cart_manufacturers[]=$product_info['manufacturer_id'];
				$cart_products[$inc]['manufacturer_id']=$product_info['manufacturer_id']; //store for future use
			}
			 
		 } 
		$cart_categories=array_unique($cart_categories);
		$cart_product_ids=array_unique($cart_product_ids);
		$cart_manufacturers=array_unique($cart_manufacturers);
		
		$debugging=array();
		
		if(!isset($xpayment['name']))$xpayment['name']=array();
		if(!is_array($xpayment['name']))$xpayment['name']=array();

                
        foreach($xpayment['name'] as $no_of_tab=>$names){
		    
			$debugging_message=array();
	   	 
			if(!isset($xpayment['customer_group'][$no_of_tab]))$xpayment['customer_group'][$no_of_tab]=array();
		    if(!isset($xpayment['geo_zone_id'][$no_of_tab]))$xpayment['geo_zone_id'][$no_of_tab]=array();
		 	if(!isset($xpayment['product_category'][$no_of_tab]))$xpayment['product_category'][$no_of_tab]=array();
		 	if(!isset($xpayment['product_product'][$no_of_tab]))$xpayment['product_product'][$no_of_tab]=array();
			if(!isset($xpayment['shipping'][$no_of_tab]))$xpayment['shipping'][$no_of_tab]=array();
			if(!isset($xpayment['store'][$no_of_tab]))$xpayment['store'][$no_of_tab]=array();
		 	if(!isset($xpayment['manufacturer'][$no_of_tab]))$xpayment['manufacturer'][$no_of_tab]=array();
		 	if(!isset($xpayment['days'][$no_of_tab]))$xpayment['days'][$no_of_tab]=array();
		 		 
		 	if(!is_array($xpayment['customer_group'][$no_of_tab]))$xpayment['customer_group'][$no_of_tab]=array();
		 	if(!is_array($xpayment['geo_zone_id'][$no_of_tab]))$xpayment['geo_zone_id'][$no_of_tab]=array();
		 	if(!is_array($xpayment['product_category'][$no_of_tab]))$xpayment['product_category'][$no_of_tab]=array();
		 	if(!is_array($xpayment['product_product'][$no_of_tab]))$xpayment['product_product'][$no_of_tab]=array();
			if(!is_array($xpayment['shipping'][$no_of_tab]))$xpayment['shipping'][$no_of_tab]=array();
		 	if(!is_array($xpayment['store'][$no_of_tab]))$xpayment['store'][$no_of_tab]=array();
		 	if(!is_array($xpayment['manufacturer'][$no_of_tab]))$xpayment['manufacturer'][$no_of_tab]=array();
		 	if(!is_array($xpayment['days'][$no_of_tab]))$xpayment['days'][$no_of_tab]=array();
			 
	
		 	if(!is_array($names))$names=array();
		  
		  	if(!isset($xpayment['customer_group_all'][$no_of_tab]))$xpayment['customer_group_all'][$no_of_tab]='';
		  	if(!isset($xpayment['geo_zone_all'][$no_of_tab]))$xpayment['geo_zone_all'][$no_of_tab]='';
		  	if(!isset($xpayment['store_all'][$no_of_tab]))$xpayment['store_all'][$no_of_tab]='';
		  	if(!isset($xpayment['manufacturer_all'][$no_of_tab]))$xpayment['manufacturer_all'][$no_of_tab]='';
		 	if(!isset($xpayment['postal_all'][$no_of_tab]))$xpayment['postal_all'][$no_of_tab]='';
		  	if(!isset($xpayment['coupon_all'][$no_of_tab]))$xpayment['coupon_all'][$no_of_tab]='';
			if(!isset($xpayment['shipping_all'][$no_of_tab]))$xpayment['shipping_all'][$no_of_tab]='';
		  	if(!isset($xpayment['postal'][$no_of_tab]))$xpayment['postal'][$no_of_tab]='';
		  	if(!isset($xpayment['coupon'][$no_of_tab]))$xpayment['coupon'][$no_of_tab]='';
		  	if(!isset($xpayment['postal_rule'][$no_of_tab]))$xpayment['postal_rule'][$no_of_tab]='inclusive';
		  	if(!isset($xpayment['coupon_rule'][$no_of_tab]))$xpayment['coupon_rule'][$no_of_tab]='inclusive';
		  	if(!isset($xpayment['time_start'][$no_of_tab]))$xpayment['time_start'][$no_of_tab]='';
		  	if(!isset($xpayment['time_end'][$no_of_tab]))$xpayment['time_end'][$no_of_tab]='';
			
			if(!isset($xpayment['manufacturer_rule'][$no_of_tab]))$xpayment['manufacturer_rule'][$no_of_tab]='2';
			if(!isset($xpayment['multi_category'][$no_of_tab]))$xpayment['multi_category'][$no_of_tab]='all';  
			if(!isset($xpayment['logo'][$no_of_tab]))$xpayment['logo'][$no_of_tab]=''; 
			if(!isset($xpayment['without_coupon'][$no_of_tab]))$xpayment['without_coupon'][$no_of_tab]=''; 
			
				$status = true;
				if($xpayment['geo_zone_id'][$no_of_tab] && $xpayment['geo_zone_all'][$no_of_tab]!=1){
				   $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id in (" . implode(',',$xpayment['geo_zone_id'][$no_of_tab]) . ") AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')"); 
				}
                
				if($xpayment['geo_zone_all'][$no_of_tab]!=1){
				  if ($xpayment['geo_zone_id'][$no_of_tab] && $query->num_rows==0) {
					$status = false;
					$debugging_message[]='GEO Zone';
				  } 
				}
				
				if (!$xpayment['status'][$no_of_tab]) {
				  $status = false;
				  $debugging_message[]='Status';
				}
				
				/*store checking*/
				if($xpayment['store_all'][$no_of_tab]!=1){
				  if(!in_array((int)$store_id,$xpayment['store'][$no_of_tab])){
				  $status = false;
				  $debugging_message[]='Store';
				  }
				}
				
				$method_categories=array();
				// if multi-cateogry rule is any, then recalculate method categories
				if($multi_category && $xpayment['multi_category'][$no_of_tab]=='any'){
					  foreach($cart_products as $product){
						  if(array_intersect($xpayment['product_category'][$no_of_tab],$product['categories']))         {
							 $method_categories=array_merge($method_categories, $product['categories']); 
						  }
					  }
					  $method_categories=array_unique($method_categories);
					  $xpayment['product_category'][$no_of_tab]=$method_categories;
				 }
				
				$resultant_category=array_intersect($xpayment['product_category'][$no_of_tab],$cart_categories);
				$resultant_products=array_intersect($xpayment['product_product'][$no_of_tab],$cart_product_ids);
				$resultant_manufacturers=array_intersect($xpayment['manufacturer'][$no_of_tab],$cart_manufacturers);
				
				// print_r($xpayment['product_category'][$no_of_tab]);
				// print_r($resultant_category);
				
				/*Manufacturer checking*/
				$applicable_manufacturer=$cart_manufacturers;
				if($xpayment['manufacturer_all'][$no_of_tab]!=1){
				   
				   if ($xpayment['manufacturer_rule'][$no_of_tab]==2){
				     if(count($resultant_manufacturers)!=count($xpayment['manufacturer'][$no_of_tab])){
				       $status = false; 
				       $debugging_message[]='Manufacturer';
				    }
				    $applicable_manufacturer=$xpayment['manufacturer'][$no_of_tab];
				  }
				  
				 if ($xpayment['manufacturer_rule'][$no_of_tab]==3){
				   if(!$resultant_manufacturers){
				     $status = false; 
				     $debugging_message[]='Manufacturer';
				    }
				    $applicable_manufacturer=$xpayment['manufacturer'][$no_of_tab];
				  }
				
				if ($xpayment['manufacturer_rule'][$no_of_tab]==4){
				
				  if(count($resultant_manufacturers)!=count($xpayment['manufacturer'][$no_of_tab]) || count($resultant_manufacturers)!=count($cart_manufacturers)){
				    $status = false; 
				    $debugging_message[]='Manufacturer';
				  }
				  $applicable_manufacturer=$xpayment['manufacturer'][$no_of_tab];
				}
				
				if ($xpayment['manufacturer_rule'][$no_of_tab]==5){
				   if($resultant_manufacturers){
				     $status = false; 
				     $debugging_message[]='Manufacturer';
				   }
				   
				 }
				
				if ($xpayment['manufacturer_rule'][$no_of_tab]==6){
				
				  if(!$resultant_manufacturers || count($resultant_manufacturers)!=count($cart_manufacturers)){
				    $status = false; 
				    $debugging_message[]='Manufacturer';
				   }
				   $applicable_manufacturer=$xpayment['manufacturer'][$no_of_tab];
				 }
				 
				 if ($xpayment['manufacturer_rule'][$no_of_tab]==7){
				
				  if($resultant_manufacturers && count($resultant_manufacturers)==count($cart_manufacturers)){
				    $status = false; 
				    $debugging_message[]='Manufacturer';
				  }
				}
				   
			 }
			 /* End manufacturer checking*/
				
				/*Customer group checking*/
				if(isset($_POST['customer_group_id']) && $_POST['customer_group_id']){
				     $customer_group_id=$_POST['customer_group_id'];
				}
				elseif(isset($_GET['customer_group_id']) && $_GET['customer_group_id']){
				     $customer_group_id=$_GET['customer_group_id'];
				}
				elseif ($this->customer->isLogged()) {
					 $customer_group_id = $this->customer->getGroupId();
				} else {
					 $customer_group_id = $this->config->get('config_customer_group_id');
					 
					 if($is_admin) $customer_group_id =  '';
				}
				 
				 
				if ($customer_group_id && !in_array($customer_group_id,$xpayment['customer_group'][$no_of_tab]) && $xpayment['customer_group_all'][$no_of_tab]!=1) {
				   $status = false; 
				   $debugging_message[]='Customer Group';
				}
				
				/*postal checking*/
				if($xpayment['postal_all'][$no_of_tab]!=1){
				  $postal=$xpayment['postal'][$no_of_tab]; 
				  $postal_rule=$xpayment['postal_rule'][$no_of_tab];
				  $postal_rule=($postal_rule=='inclusive')?true:false;
				  $postal_found=false;
				  if($postal){
				    $postal=explode(',',trim($postal));
					 foreach($postal as $postal_code){
						 $postal_code=trim($postal_code);
						
						  /* In case of range postal code - only numeric */
						 if(strpos($postal_code,'-')!==false && substr_count($postal_code,'-')==1){
						    list($start_postal,$end_postal)=	explode('-',$postal_code); 
							$start_postal=(int)$start_postal;
							$end_postal=(int)$end_postal;
							if($start_postal<=$end_postal){
						       for($i=$start_postal;$i<=$end_postal;$i++){
								   if(trim((int)$address['postcode'])==$i){
									    $postal_found=true;
										 break;
								   }
								}
							}
					     }
						 /* End of range checking*/
						
						  /* In case of range postal code wiht prefix*/
						 elseif(strpos($postal_code,'-')!==false && substr_count($postal_code,'-')==2){
						    list($prefix,$start_postal,$end_postal)=	explode('-',$postal_code); 
							$start_postal=(int)$start_postal;
							$end_postal=(int)$end_postal;
							
							if($start_postal<=$end_postal){
						       for($i=$start_postal;$i<=$end_postal;$i++){
								   
								    if(preg_match('/^'.str_replace(array('\*','\?'),array('(.*?)','[a-zA-Z0-9]'),preg_quote($prefix.$i)).'$/i',trim($address['postcode']))){
							         $postal_found=true; 
									  break; 
						           }
								   
								}
							}
					     }
						 /* End of range checking*/
						   /* In case of range postal code wiht prefix and sufiix*/
						 elseif(strpos($postal_code,'-')!==false && substr_count($postal_code,'-')==3){
						    list($prefix,$start_postal,$end_postal,$sufiix)=	explode('-',$postal_code); 
							$start_postal=(int)$start_postal;
							$end_postal=(int)$end_postal;
							
							if($start_postal<=$end_postal){
						       for($i=$start_postal;$i<=$end_postal;$i++){
								   
								   if(preg_match('/^'.str_replace(array('\*','\?'),array('(.*?)','[a-zA-Z0-9]'),preg_quote($prefix.$i.$sufiix)).'$/i',trim($address['postcode']))){
							         $postal_found=true;  
									 break;
						           }
								}
							}
					     }
						 /* End of range checking*/
						 
						 /* In case of wildcards use code*/
						 elseif(strpos($postal_code,'*')!==false || strpos($postal_code,'?')!==false){
							
				         if(preg_match('/^'.str_replace(array('\*','\?'),array('(.*?)','[a-zA-Z0-9]'),preg_quote($postal_code)).'$/i',trim($address['postcode']))){
							 $postal_found=true;  
						  }
						
                        
					     }
						 /* End of wildcards checking*/
						 else{
							  
							  if(trim(strtolower($address['postcode']))==strtolower($postal_code)){
									$postal_found=true; 
								} 
					     }
					 }
				    
			        if((boolean)$postal_found!==$postal_rule){
				        $status = false;
				        $debugging_message[]='Zip/Postal -'.$address['postcode'];
				    } 
				  }	  
				}
				
				/*coupon checking*/
				if($xpayment['coupon_all'][$no_of_tab]!=1 && isset($this->session->data['coupon'])){
				  $coupon=$xpayment['coupon'][$no_of_tab]; 
				  $coupon_rule=$xpayment['coupon_rule'][$no_of_tab];
				  if($coupon){
				    $coupon=explode(',',trim($coupon));
				    $coupon_rule=($coupon_rule=='inclusive')?false:true;
				    
			        if(in_array(trim($this->session->data['coupon']),$coupon)===$coupon_rule){
				        $status = false;
				        $debugging_message[]='Coupon';
				    } 
				  }	  
				}
				
				
				/*category checking*/
				$applicable_category=$cart_categories;
				if ($xpayment['category'][$no_of_tab]==2){
				  if(count($resultant_category)!=count($xpayment['product_category'][$no_of_tab])){
				    $status = false; 
				    $debugging_message[]='Category';
				  }
			      $applicable_category=$xpayment['product_category'][$no_of_tab];
				}
				if ($xpayment['category'][$no_of_tab]==3){
				   if(!$resultant_category){
				     $status = false; 
				     $debugging_message[]='Category';
				   }
				   $applicable_category=$xpayment['product_category'][$no_of_tab];
				}
				
				if ($xpayment['category'][$no_of_tab]==4){
				
				  if(count($resultant_category)!=count($xpayment['product_category'][$no_of_tab]) || count($resultant_category)!=count($cart_categories)){
				    $status = false; 
				    $debugging_message[]='Category';
				  }
				  $applicable_category=$xpayment['product_category'][$no_of_tab];
				}
				
				if ($xpayment['category'][$no_of_tab]==5){
				   if($resultant_category){
				     $status = false; 
				     $debugging_message[]='Category';
				   }
				   
				}
				
				if ($xpayment['category'][$no_of_tab]==6){
				
				  if(!$resultant_category || count($resultant_category)!=count($cart_categories)){
				    $status = false; 
				    $debugging_message[]='Category';
				  }
				  $applicable_category=$xpayment['product_category'][$no_of_tab];
				}
				
				if ($xpayment['category'][$no_of_tab]==7){
				
				  if($resultant_category && count($resultant_category)==count($cart_categories)){
				    $status = false; 
				    $debugging_message[]='Category';
				  }
				}
				
				/* End of category */
				
				/*product checking*/
				$applicable_product=$cart_product_ids;
				if ($xpayment['product'][$no_of_tab]==2){
				  if(count($resultant_products)!=count($xpayment['product_product'][$no_of_tab])){
				    $status = false; 
				    $debugging_message[]='Product';
				  }
				  $applicable_product=$xpayment['product_product'][$no_of_tab];
				}
				if ($xpayment['product'][$no_of_tab]==3){
				   if(!$resultant_products){
				     $status = false; 
				     $debugging_message[]='Product';
				   }
				  $applicable_product=$xpayment['product_product'][$no_of_tab]; 
				}
				if ($xpayment['product'][$no_of_tab]==4){
				  if(count($resultant_products)!=count($xpayment['product_product'][$no_of_tab]) || count($resultant_products)!=count($cart_product_ids)){
				    $status = false;
				    $debugging_message[]='Product'; 
				  }
				  $applicable_product=$xpayment['product_product'][$no_of_tab]; 
				}
				
				if ($xpayment['product'][$no_of_tab]==5){
				   if($resultant_products){
				     $status = false; 
				     $debugging_message[]='Product';
				   }
				   
				}
				
				if ($xpayment['product'][$no_of_tab]==6){
				   if(!$resultant_products || count($resultant_products)!=count($cart_product_ids)){
				     $status = false; 
				     $debugging_message[]='Product';
				   }
				  $applicable_product=$xpayment['product_product'][$no_of_tab]; 
				}
				
				if ($xpayment['product'][$no_of_tab]==7){
				
				  if($resultant_products && count($resultant_products)==count($cart_product_ids)){
				    $status = false; 
				    $debugging_message[]='Product';
				  }
				}
				
				/* End of product */
				
				/*Rearraging method for x-shipping pro*/
				$shipping_methods=array();
				if(is_array($xpayment['shipping'][$no_of_tab])){
				   foreach($xpayment['shipping'][$no_of_tab] as $method){
					  $shipping_methods[]=$method;
					  $shipping_methods[]=$method.'.'.$method;
				   }
				}
			
				 /*Shipping checking*/
				if ($xpayment['shipping_all'][$no_of_tab]!=1) {
				   if($shipping_methods){
					   if(!in_array($shipping_method,$shipping_methods)){
						  $status = false; 
						  $debugging_message[]='Shipping';
					   }  
					}
				  
				   if(!$shipping_methods && $shipping_method){  
						  $status = false;  
						  $debugging_message[]='Shipping';
					}       
				}
				
				/*Days of week checking*/
				  $day=date('w');
				  if(!in_array($day,$xpayment['days'][$no_of_tab])){
				    $status = false; 
				    $debugging_message[]='Day Option';
				  }
				/* Day checking*/
				
				/*time checking*/
				
				  $time=date('G')+1; /* 'G' return 0-23 so plus 1 */
				  if($xpayment['time_start'][$no_of_tab] && $xpayment['time_end'][$no_of_tab]){
				    if($time < $xpayment['time_start'][$no_of_tab] || $time> $xpayment['time_end'][$no_of_tab]) {
				      $status = false; 
				      $debugging_message[]='Time Setting (server time: '.$time.')';
				     }  
				  }
				  
				/*Day checking*/
				
				/* Ranges checking*/
				
				if((float)$xpayment['order_total_end'][$no_of_tab]>0){
				    
				     $method_total = $cart_total;
				     
				     if($xpayment['without_coupon'][$no_of_tab]) {
				       $method_total = $method_total + $coupon_value;
				     }
				      
					 if ($method_total < (float)$xpayment['order_total_start'][$no_of_tab] || $method_total> (float)$xpayment['order_total_end'][$no_of_tab]) {
					   $status = false;
					   $debugging_message[]='Order Total';
					 } 
				}
				
				if((int)$xpayment['weight_end'][$no_of_tab]>0){
				    
					 if ($cart_weight < (int)$xpayment['weight_start'][$no_of_tab] || $cart_weight > (int)$xpayment['weight_end'][$no_of_tab]) {
					   $status = false;
					   $debugging_message[]='Weight';
					 }
				}
				
				if((int)$xpayment['quantity_end'][$no_of_tab]>0){
				    
					 if ($cart_quantity < (int)$xpayment['quantity_start'][$no_of_tab] || $cart_quantity > (int)$xpayment['quantity_end'][$no_of_tab]) {
					   $status = false;
					   $debugging_message[]='Quantity';
					 }
				}
			    
			    /* End of ranges of checking*/
				
				
				if(!isset($names[$language_id]) || !$names[$language_id]){
				  $status = false;
				  $debugging_message[]='Name';
				}
				
				if(!isset($xpayment['term'][$no_of_tab][$language_id]) || !$xpayment['term'][$no_of_tab][$language_id]) $xpayment['term'][$no_of_tab][$language_id]='';
				
				if(!$status){
				   $debugging[]=array('name'=>$names[$language_id],'filter'=>$debugging_message,'index'=>$no_of_tab);
				}
				
				
				if ($status) {
					$x_method['xpayment'.$no_of_tab] = array(
						'code'         => 'xpayment'.'.xpayment'.$no_of_tab,
						'title'        => html_entity_decode($names[$language_id]),
						'terms' =>$xpayment['term'][$no_of_tab][$language_id],
						'logo'         => $xpayment['logo'][$no_of_tab],
						'sort_order'         => intval($xpayment['sort_order'][$no_of_tab])
					);
				}
			}
			
		   
		    /*Sorting final method*/
		    $sort_order = array();
			foreach ($x_method as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $x_method);
			
			
			
			$method_data = array(
				'code'       => 'xpayment',
				'title'      => $this->language->get('text_title'),
				'methods'      => $x_method,
				'sort_order' => $this->config->get('xpayment_sort_order')
			);	
	   
	    if($xpayment_debug && $debugging){ 
	      echo '<div style="border: 1px solid #FF0000; margin: 20px 5px;padding: 10px;">';
	      foreach($debugging as $debug){
	        echo '<b>'.$debug['name'].'-'.$debug['index'].'</b> : ('.implode(',',$debug['filter']).') <br />';
	      }
	      echo '</div>';
	    }		
		
        if(!$x_method) return array();
		return $method_data;
 }
}
?>