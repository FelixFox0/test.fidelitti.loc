<?php
class ControllerExtensionPaymentXpayment extends Controller {
	private $error = array(); 
	
	public function index() {   
	    
		@ini_set( "max_input_vars", 10000);
		$this->load->language('extension/payment/xpayment');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$save=array();
			$save['xpayment_status']=$this->request->post['xpayment_status'];
			$save['xpayment_sort_order']=$this->request->post['xpayment_sort_order'];
			$save['xpayment_debug']=$this->request->post['xpayment_debug'];
			if(isset($this->request->post['xpayment'])) {
			 $save['xpayment']=base64_encode(serialize($this->request->post['xpayment']));
			}
			$this->model_setting_setting->editSetting('xpayment', $save);		
			$this->session->data['success'] = $this->language->get('text_success');	
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}
			
				
		$data['heading_title'] = $this->language->get('heading_title');

        $data['tab_rate'] = $this->language->get('tab_rate');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_order_total'] = $this->language->get('entry_order_total');
		$data['entry_order_weight'] = $this->language->get('entry_order_weight');
		$data['entry_to'] = $this->language->get('entry_to');
		$data['entry_order_hints'] = $this->language->get('entry_order_hints');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_edit'] = $this->language->get('text_edit');
		

		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_category_any'] = $this->language->get('text_category_any');
		$data['text_category_all'] = $this->language->get('text_category_all');
		$data['text_category_least'] = $this->language->get('text_category_least');
		$data['text_category_least_with_other'] = $this->language->get('text_category_least_with_other');       
		$data['text_category_except_other'] = $this->language->get('text_category_except_other');
		
		$data['text_category_except'] = $this->language->get('text_category_except');
		$data['text_category_exact'] = $this->language->get('text_category_exact');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_weight_include'] = $this->language->get('entry_weight_include');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_any'] = $this->language->get('text_any');
        $data['module_status'] = $this->language->get('module_status');
      
       $data['entry_store'] = $this->language->get('entry_store');
       $data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
       $data['text_product'] = $this->language->get('text_product');
	   $data['text_product_any'] = $this->language->get('text_product_any');
	   $data['text_product_all'] = $this->language->get('text_product_all');
	   $data['text_product_least'] = $this->language->get('text_product_least');
	   $data['text_product_least_with_other'] = $this->language->get('text_product_least_with_other');
	   $data['text_product_exact'] = $this->language->get('text_product_exact');
	   $data['text_product_except'] = $this->language->get('text_product_except');
	   $data['text_product_except_other'] = $this->language->get('text_product_except_other');
	   $data['entry_product'] = $this->language->get('entry_product');
	   $data['text_debug'] = $this->language->get('text_debug');
		
	   $data['text_manufacturer_rule'] = $this->language->get('text_manufacturer_rule');
	   $data['text_manufacturer_any'] = $this->language->get('text_manufacturer_any');
	   $data['text_manufacturer_all'] = $this->language->get('text_manufacturer_all');
	   $data['text_manufacturer_least'] = $this->language->get('text_manufacturer_least');
	   $data['text_manufacturer_least_with_other'] = $this->language->get('text_manufacturer_least_with_other');
	   $data['text_manufacturer_exact'] = $this->language->get('text_manufacturer_exact');
	   $data['text_manufacturer_except'] = $this->language->get('text_manufacturer_except');
	   $data['text_manufacturer_except_other'] = $this->language->get('text_manufacturer_except_other');
	   $data['tip_manufacturer_rule'] = $this->language->get('tip_manufacturer_rule');
			
	   $data['button_save'] = $this->language->get('button_save');
	   $data['button_cancel'] = $this->language->get('button_cancel');
       $data['button_save_continue'] = $this->language->get('button_save_continue');
       $data['tab_general'] = $this->language->get('tab_general');
	   $data['text_method_remove'] = $this->language->get('text_method_remove');
	   $data['text_method_copy'] = $this->language->get('text_method_copy');
	   $data['total_without_coupon'] = $this->language->get('total_without_coupon');
                
	
		$data['text_add_new_method'] = $this->language->get('text_add_new_method');
		$data['text_remove'] = $this->language->get('text_remove');
		$data['text_general'] = $this->language->get('text_general');
		$data['text_criteria_setting'] = $this->language->get('text_criteria_setting');
		$data['text_category_product'] = $this->language->get('text_category_product');
		$data['text_price_setting'] = $this->language->get('text_price_setting');
		$data['text_others'] = $this->language->get('text_others');
		$data['text_zip_postal'] = $this->language->get('text_zip_postal');
		$data['text_enter_zip'] = $this->language->get('text_enter_zip');
		$data['text_zip_rule'] = $this->language->get('text_zip_rule');
		$data['text_zip_rule_inclusive'] = $this->language->get('text_zip_rule_inclusive');
		$data['text_zip_rule_exclusive'] = $this->language->get('text_zip_rule_exclusive');
		$data['text_coupon'] = $this->language->get('text_coupon');
		$data['text_enter_coupon'] = $this->language->get('text_enter_coupon');
		$data['text_coupon_rule'] = $this->language->get('text_coupon_rule');
		$data['text_coupon_rule_inclusive'] = $this->language->get('text_coupon_rule_inclusive');
		$data['text_coupon_rule_exclusive'] = $this->language->get('text_coupon_rule_exclusive');
		$data['text_days_week'] = $this->language->get('text_days_week');
		$data['text_time_period'] = $this->language->get('text_time_period');
		$data['text_sunday'] = $this->language->get('text_sunday');
		$data['text_monday'] = $this->language->get('text_monday');
		$data['text_tuesday'] = $this->language->get('text_tuesday');
		$data['text_wednesday'] = $this->language->get('text_wednesday');
		$data['text_thursday'] = $this->language->get('text_thursday');
		$data['text_friday'] = $this->language->get('text_friday');
		$data['text_saturday'] = $this->language->get('text_saturday');
	
		$data['tip_sorting_own'] = $this->language->get('tip_sorting_own');
		$data['tip_status_own'] = $this->language->get('tip_status_own');
		$data['tip_store'] = $this->language->get('tip_store');
		$data['tip_geo'] = $this->language->get('tip_geo');
		$data['tip_manufacturer'] = $this->language->get('tip_manufacturer');
		$data['tip_customer_group'] = $this->language->get('tip_customer_group');
		$data['tip_zip'] = $this->language->get('tip_zip');
		$data['tip_coupon'] = $this->language->get('tip_coupon');
		$data['tip_category'] = $this->language->get('tip_category');
		$data['tip_product'] = $this->language->get('tip_product');
		$data['tip_day'] = $this->language->get('tip_day');
		$data['tip_time'] = $this->language->get('tip_time');
		$data['tip_heading'] = $this->language->get('tip_heading');
		$data['tip_status_global'] = $this->language->get('tip_status_global');
		$data['tip_sorting_global'] = $this->language->get('tip_sorting_global');
		$data['tip_grouping'] = $this->language->get('tip_grouping');
		$data['tip_debug'] = $this->language->get('tip_debug');
		$data['tip_postal_code'] = $this->language->get('tip_postal_code');
		$data['tip_multi_category'] = $this->language->get('tip_multi_category');
		$data['text_multi_category'] = $this->language->get('text_multi_category');
		$data['entry_all'] = $this->language->get('entry_all');
		$data['entry_any'] = $this->language->get('entry_any');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['tip_shipping'] = $this->language->get('tip_shipping');
        
		$data['text_yes'] = $this->language->get('text_yes'); 
		$data['text_no'] = $this->language->get('text_no'); 
		
		$data['entry_instruction'] = $this->language->get('entry_instruction'); 
		$data['keywords_hints'] = $this->language->get('keywords_hints'); 
		$data['entry_order_status'] = $this->language->get('entry_order_status'); 
		$data['entry_callback'] = $this->language->get('entry_callback'); 
		$data['entry_redirect'] = $this->language->get('entry_redirect'); 
		$data['entry_redirect_type'] = $this->language->get('entry_redirect_type'); 
		$data['entry_redirect_post'] = $this->language->get('entry_redirect_post'); 
		$data['entry_redirect_get'] = $this->language->get('entry_redirect_get'); 
		$data['tip_callback'] = $this->language->get('tip_callback'); 
		$data['tip_redirect'] = $this->language->get('tip_redirect'); 
		$data['tip_redirect_data'] = $this->language->get('tip_redirect_data'); 
		$data['tip_order_status'] = $this->language->get('tip_order_status'); 
		$data['tip_instruction'] = $this->language->get('tip_instruction');
		$data['tip_weight'] = $this->language->get('tip_weight');
		$data['tip_total'] = $this->language->get('tip_total');
		$data['tip_quantity'] = $this->language->get('tip_quantity');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['text_inc_email'] = $this->language->get('text_inc_email');
		$data['text_inc_order'] = $this->language->get('text_inc_order');
		$data['text_instruction_email'] = $this->language->get('text_instruction_email');
		$data['tip_email_instruction'] = $this->language->get('tip_email_instruction');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['payment_terms'] = $this->language->get('payment_terms');
		$data['tip_payment_terms'] = $this->language->get('tip_payment_terms');
		$data['entry_success'] = $this->language->get('entry_success');
		$data['tip_success'] = $this->language->get('tip_success');
		$data['text_logo'] = $this->language->get('text_logo');
		$data['tip_text_logo'] = $this->language->get('tip_text_logo');
		
		$data['text_redirect_fields'] = $this->language->get('text_redirect_fields');
		$data['text_redirect_hints'] = $this->language->get('text_redirect_hints');
		$data['text_success_condition'] = $this->language->get('text_success_condition');
		$data['text_success_condition_hints'] = $this->language->get('text_success_condition_hints');	
		$data['additional_email'] = $this->language->get('additional_email');
		$data['additional_email_tip'] = $this->language->get('additional_email_tip');	
			
 	    if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/xpayment', 'token=' . $this->session->data['token'], true)
		);
		
		$data['action'] = $this->url->link('extension/payment/xpayment', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		$xpayment=$this->config->get('xpayment');
		if ($xpayment) {
				
			 $xpayment=unserialize(base64_decode($xpayment)); 
		}
		
		if(!is_array($xpayment))$xpayment=array();
		$data['xpayment'] = $xpayment;
		
		$data['token']=$this->session->data['token'];
		
		
		 
		 if (isset($this->request->post['xpayment_status'])) {
			   $data['xpayment_status'] = $this->request->post['xpayment_status'];
         } else {
              $data['xpayment_status'] = $this->config->get('xpayment_status');
        }
		
		if (isset($this->request->post['xpayment_sort_order'])) {
			$data['xpayment_sort_order'] = $this->request->post['xpayment_sort_order'];
        } else {
             $data['xpayment_sort_order'] = $this->config->get('xpayment_sort_order');
        }
         

        
        if (isset($this->request->post['xpayment_debug'])) {
			$data['xpayment_debug'] = $this->request->post['xpayment_debug'];
         } else {
            $data['xpayment_debug'] = $this->config->get('xpayment_debug');
         }
                
                
		 $this->load->model('localisation/tax_class');
		 $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		 $this->load->model('localisation/geo_zone');
		 $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
                
         $this->load->model('setting/store');
		 $data['stores'] = $this->model_setting_store->getStores();
         $data['stores']=  array_merge(array(array('store_id'=>0,'name'=>$this->language->get('store_default'))),$data['stores']);
                
          if(intval(str_replace('.','',VERSION)) >=  2101) {
           $this->load->model('customer/customer_group');
		   $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		 } else {
		   $this->load->model('sale/customer_group');
		   $data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		 }
                
         $this->load->model('catalog/manufacturer');
		 $data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();
                
		 $this->load->model('localisation/language');
		 $data['languages'] = $this->model_localisation_language->getLanguages();
		 $data['language_id']=$this->config->get('config_language_id');
		 
		 $this->load->model('localisation/order_status');
		 $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
                	
		
		/*Fixing shipping selection issue*/
		$xpaymentshipping=$this->config->get('xpaymentshipping');
		if(!isset($xpaymentshipping))$xpaymentshipping=array();
		
		
		$shipping_mods=array();
		$xshipping_installed=false;
		$result=$this->db->query("select * from " . DB_PREFIX . "extension where type='shipping'");
		if($result->rows){
		  foreach($result->rows as $row){
			 $shipping_mods[$row['code']]=$this->getModuleName($row['code'],$row['type']); 
			 if($row['code']=='xshippingpro')$xshipping_installed=true;
		  }
		}
		
		$data['shipping_mods'] = $shipping_mods;
		
		/*For X-Shipping Pro*/
		   if($xshipping_installed){
			   
			   $xshippingpro_methods=array();
			   
			   $xshippingpro=$this->config->get('xshippingpro');
			   if($xshippingpro){
				   $xshippingpro=unserialize(base64_decode($xshippingpro)); 
			
			   	   if(!isset($xshippingpro['name']))$xshippingpro['name']=array();
			   	   if(!is_array($xshippingpro['name']))$xshippingpro['name']=array();
			   
			   	   foreach($xshippingpro['name'] as $no_of_tab=>$names) {
				  
				   		if(isset($names[$data['language_id']]) && $names[$data['language_id']]){
					 		 $code = 'xshippingpro'.'.xshippingpro'.$no_of_tab;
					  		 $xshippingpro_methods[$code]=$names[$data['language_id']];
						}
			       }
			   }
			   else {
			     $this->load->model('extension/xshippingpro/xshippingpro');
			     $xshippingpro= $this->model_extension_xshippingpro_xshippingpro->getData();
			     foreach($xshippingpro as $single_method) {
					$no_of_tab = $single_method['tab_id'];
					$method_data = $single_method['method_data'];
					$method_data = @unserialize(@base64_decode($method_data));
					if(!is_array($method_data)) $method_data = array();
			
			   		if(!isset($method_data['name']))$method_data['name']=array();
					if(!is_array($method_data['name']))$method_data['name']=array();
					$method_name = (!isset($method_data['name'][$data['language_id']]) || !$method_data['name'][$data['language_id']]) ? 'Untitled Method '.$no_of_tab : $method_data['name'][$data['language_id']]; 
			   		$code = 'xshippingpro'.'.xshippingpro'.$no_of_tab;
			   		$xshippingpro_methods[$code]=$method_name;
			     }
			   
			   } 
			 $xpaymentshipping['xshippingpro'] = $xshippingpro_methods;
			 
		   }
		/*End of X-shipping Pro*/
		
		 $known_shipping=array('usps'=>array(
			'usps.domestic_00'=>'First-Class Mail Parcel',
			'usps.domestic_01'=>'First-Class Mail Large Envelope',
			'usps.domestic_02'=>'First-Class Mail Letter',
			'usps.domestic_03'=>'First-Class Mail Postcards',
			'usps.domestic_1'=>'Priority Mail',
			'usps.domestic_2'=>'Express Mail Hold for Pickup',
			'usps.domestic_3'=>'Express Mail',
			'usps.domestic_4'=>'Parcel Post',
			'usps.domestic_5'=>'Bound Printed Matter',
			'usps.domestic_6'=>'Media Mail',
			'usps.domestic_7'=>'Library',
			'usps.domestic_12'=>'First-Class Postcard Stamped',
			'usps.domestic_13'=>'Express Mail Flat-Rate Envelope',
			'usps.domestic_16'=>'Priority Mail Regular Flat-Rate Box',
			'usps.domestic_17'=>'Priority Mail Keys and IDs',
			'usps.domestic_19'=>'First-Class Keys and IDs',
			'usps.domestic_22'=>'Priority Mail Flat-Rate Large Box',
			'usps.domestic_23'=>'Express Mail Sunday/Holiday',
			'usps.domestic_25'=>'Express Mail Flat-Rate Envelope Sunday/Holiday',
			'usps.domestic_27'=>'Express Mail Flat-Rate Envelope Hold For Pickup',
			'usps.domestic_28'=>'Priority Mail Small Flat-Rate Box',
			'usps.international_1'=>'Express Mail International',
			'usps.international_2'=>'Priority Mail International',
			'usps.international_4'=>'Global Express Guaranteed (Document and Non-document)',
			'usps.international_5'=>'Global Express Guaranteed Document used',
			'usps.international_6'=>'Global Express Guaranteed Non-Document Rectangular shape',
			'usps.international_7'=>'Global Express Guaranteed Non-Document Non-Rectangular',
			'usps.international_8'=>'Priority Mail Flat Rate Envelope ',
			'usps.international_9'=>'Priority Mail Flat Rate Box',
			'usps.international_10'=>'Express Mail International Flat Rate Envelope',
			'usps.international_11'=>'Priority Mail Flat Rate Large Box',
			'usps.international_12'=>'Global Express Guaranteed Envelope',
			'usps.international_13'=>'First Class Mail International Letters',
			'usps.international_14'=>'First Class Mail International Flats',
			'usps.international_15'=>'First Class Mail International Parcels',
			'usps.international_16'=>'Priority Mail Flat Rate Small Box',
			'usps.international_21'=>'Postcards'
		   ),
		   
		   'fedex'=>array(
			'fedex.EUROPE_FIRST_INTERNATIONAL_PRIORITY'=>'Europe First International Priority',
			'fedex.FEDEX_1_DAY_FREIGHT'=>'Fedex 1 Day Freight',
			'fedex.FEDEX_2_DAY'=>'Fedex 2 Day',
			'fedex.FEDEX_2_DAY_AM'=>'Fedex 2 Day AM',
			'fedex.FEDEX_2_DAY_FREIGHT'=>'Fedex 2 Day Freight',
			'fedex.FEDEX_3_DAY_FREIGHT'=>'Fedex 3 Day Freight',
			'fedex.FEDEX_EXPRESS_SAVER'=>'Fedex Express Saver',
			'fedex.FEDEX_FIRST_FREIGHT'=>'Fedex First Fright',
			'fedex.FEDEX_FREIGHT_ECONOMY'=>'Fedex Fright Economy',
			'fedex.FEDEX_FREIGHT_PRIORITY'=>'Fedex Fright Priority',
			'fedex.FEDEX_GROUND'=>'Fedex Ground',
			'fedex.FIRST_OVERNIGHT'=>'First Overnight',
			'fedex.GROUND_HOME_DELIVERY'=>'Ground Home Delivery',
			'fedex.INTERNATIONAL_ECONOMY'=>'International Economy',
			'fedex.INTERNATIONAL_ECONOMY_FREIGHT'=>'International Economy Freight',
			'fedex.INTERNATIONAL_FIRST'=>'International First',
			'fedex.INTERNATIONAL_PRIORITY'=>'International Priority',
			'fedex.INTERNATIONAL_PRIORITY_FREIGHT'=>'International Priority Freight',
			'fedex.PRIORITY_OVERNIGHT'=>'Priority Overnight',
			'fedex.SMART_POST'=>'Smart Post',
			'fedex.STANDARD_OVERNIGHT'=>'Standard Overnight'
		   ),
			'royal_mail'=>array(
			'royal_mail.1st_class_standard'=>'First Class Standard Post',
			'royal_mail.1st_class_recorded'=>'First Class Recorded Post',
			'royal_mail.2nd_class_standard'=>'Second Class Standard',
			'royal_mail.2nd_class_recorded'=>'Second Class Recorded',
			'royal_mail.special_delivery_500'=>'Special Delivery Next Day (&pound;500)',
			'royal_mail.special_delivery_1000'=>'Special Delivery Next Day (&pound;1000)',
			'royal_mail.special_delivery_2500'=>'Special Delivery Next Day (&pound;2500)',
			'royal_mail.standard_parcels'=>'Standard Parcels',
			'royal_mail.airmail'=>'Airmail',
			'royal_mail.international_signed'=>'International Signed',
			'royal_mail.airsure'=>'Airsure',
			'royal_mail.surface'=>'Surface'
		   )
		  );
		 
		if(isset($this->data['geo_zones']) && $this->data['geo_zones']){
		   $weight_based=array();
		   foreach($this->data['geo_zones'] as $geo_zone){
			   $weight_based['weight.weight_'.$geo_zone['geo_zone_id']]=$geo_zone['name'];  
			}
			$known_shipping['weight']=$weight_based;	
		}
		
		/*UPS shipping*/
		$ups_origin = $this->config->get('ups_origin'); 
		$ups_origin=($ups_origin)?$ups_origin:'US'; 
		if($ups_origin=='US') {
		   $known_shipping['ups']=array(
			'ups.01'=>'UPS Next Day Air',
			'ups.02'=>'UPS Second Day Air',
			'ups.03'=>'UPS Ground',
			'ups.07'=>'UPS Worldwide Express',
			'ups.08'=>'UPS Worldwide Expedited',
			'ups.11'=>'UPS Standard',
			'ups.12'=>'UPS Three-Day Select',
			'ups.13'=>'UPS Next Day Air Saver',
			'ups.14'=>'UPS Next Day Air Early A.M.',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.59'=>'UPS Second Day Air A.M.',
			'ups.65'=>'UPS Saver'
		   );
		}
		if($ups_origin=='CA') {
		   $known_shipping['ups']=array(
			'ups.01'=>'UPS Express',
			'ups.02'=>'UPS Expedited',
			'ups.07'=>'UPS Worldwide Express',
			'ups.08'=>'UPS Worldwide Expedited',
			'ups.11'=>'UPS Standard',
			'ups.12'=>'UPS Three-Day Select',
			'ups.13'=>'UPS Next Day Air Saver',
			'ups.14'=>'UPS Next Day Air Early A.M.',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.59'=>'UPS Second Day Air A.M.',
			'ups.65'=>'UPS Saver'
		   );
		}
		if($ups_origin=='EU') {
		   $known_shipping['ups']=array(
			'ups.07'=>'UPS Express',
			'ups.08'=>'UPS Expedited',
			'ups.11'=>'UPS Standard',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.59'=>'UPS Second Day Air A.M.',
			'ups.65'=>'UPS Saver',
			'ups.82'=>'UPS Today Standard',
			'ups.83'=>'UPS Today Dedicated Courier',
			'ups.84'=>'UPS Today Intercity',
			'ups.85'=>'UPS Today Express',
			'ups.86'=>'UPS Today Express Saver'
		   );
		}
		if($ups_origin=='PR') {
		   $known_shipping['ups']=array(
			'ups.01'=>'UPS Next Day Air',
			'ups.02'=>'UPS Second Day Air',
			'ups.03'=>'UPS Ground',
			'ups.07'=>'UPS Worldwide Express',
			'ups.08'=>'UPS Worldwide Expedited',
			'ups.11'=>'UPS Standard',
			'ups.12'=>'UPS Three-Day Select',
			'ups.13'=>'UPS Next Day Air Saver',
			'ups.14'=>'UPS Next Day Air Early A.M.',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.59'=>'UPS Second Day Air A.M.',
			'ups.65'=>'UPS Saver'
		   );
		}
		if($ups_origin=='MX') {
		   $known_shipping['ups']=array(
			'ups.07'=>'UPS Worldwide Express',
			'ups.08'=>'UPS Worldwide Expedited',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.65'=>'UPS Saver'
		   );
		}
		if($ups_origin=='other') {
		   $known_shipping['ups']=array(
			'ups.07'=>'UPS Express',
			'ups.08'=>'UPS Expedited',
			'ups.11'=>'UPS Standard',
			'ups.54'=>'UPS Worldwide Express Plus',
			'ups.65'=>'UPS Saver'
		   );
		}
		/* End of UPS*/
		
		$xpaymentshipping=array_merge($xpaymentshipping,$known_shipping);
		$data['xpaymentshipping'] = $xpaymentshipping;
	                
               
		 $data['form_data']=$this->getFormData($data);
	
		 $data['header'] = $this->load->controller('common/header');
		 $data['column_left'] = $this->load->controller('common/column_left');
		 $data['footer'] = $this->load->controller('common/footer');
		
		 $this->response->setOutput($this->load->view('extension/payment/xpayment', $data));
	}
      
      public function quick_save(){
         
        $this->load->model('setting/setting');
         $json=array();
         
         if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			 $save=array();
			
			 $save['xpayment_status']=$this->request->post['xpayment_status'];
			 $save['xpayment_sort_order']=$this->request->post['xpayment_sort_order']; 
			 $save['xpayment_debug']=$this->request->post['xpayment_debug'];
			 if(isset($this->request->post['xpayment'])) {
			   $save['xpayment']=base64_encode(serialize($this->request->post['xpayment']));
			 }
			 $this->model_setting_setting->editSetting('xpayment', $save);
			 $json['success']=1;	
			 	
		  } else{
			  
		     $json['error']=$this->language->get('error_permission');
		  }
		  
		  $this->response->addHeader('Content-Type: application/json');
		  $this->response->setOutput(json_encode($json)); 
         
      } 

   private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/xpayment')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	public function copyMehthod()
	{
	  $tabId=$this->requrest->get['tabId'];
	}
	
	private function getFormData($data)
	{
	   $this->load->model('catalog/category');
	   $this->load->model('catalog/product');
	   
	   $return=''; 
	   if(!isset($data['xpayment']['name']))$data['xpayment']['name']=array();
	   if(!is_array($data['xpayment']['name']))$data['xpayment']['name']=array();
	   foreach($data['xpayment']['name'] as $no_of_tab=>$names){
	   	 
		 if(!isset($data['xpayment']['customer_group'][$no_of_tab]))$data['xpayment']['customer_group'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['geo_zone_id'][$no_of_tab]))$data['xpayment']['geo_zone_id'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['product_category'][$no_of_tab]))$data['xpayment']['product_category'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['product_product'][$no_of_tab]))$data['xpayment']['product_product'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['store'][$no_of_tab]))$data['xpayment']['store'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['shipping'][$no_of_tab]))$data['xpayment']['shipping'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['manufacturer'][$no_of_tab]))$data['xpayment']['manufacturer'][$no_of_tab]=array();
		 if(!isset($data['xpayment']['days'][$no_of_tab]))$data['xpayment']['days'][$no_of_tab]=array();
		 		 
		 if(!is_array($data['xpayment']['customer_group'][$no_of_tab]))$data['xpayment']['customer_group'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['geo_zone_id'][$no_of_tab]))$data['xpayment']['geo_zone_id'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['product_category'][$no_of_tab]))$data['xpayment']['product_category'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['product_product'][$no_of_tab]))$data['xpayment']['product_product'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['store'][$no_of_tab]))$data['xpayment']['store'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['shipping'][$no_of_tab]))$data['xpayment']['shipping'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['manufacturer'][$no_of_tab]))$data['xpayment']['manufacturer'][$no_of_tab]=array();
		 if(!is_array($data['xpayment']['days'][$no_of_tab]))$data['xpayment']['days'][$no_of_tab]=array();
		 		
		 	
		 if(!is_array($names))$names=array();
		 
		  if(!isset($data['xpayment']['customer_group_all'][$no_of_tab]))$data['xpayment']['customer_group_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['geo_zone_all'][$no_of_tab]))$data['xpayment']['geo_zone_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['store_all'][$no_of_tab]))$data['xpayment']['store_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['manufacturer_all'][$no_of_tab]))$data['xpayment']['manufacturer_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['postal_all'][$no_of_tab]))$data['xpayment']['postal_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['coupon_all'][$no_of_tab]))$data['xpayment']['coupon_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['shipping_all'][$no_of_tab]))$data['xpayment']['shipping_all'][$no_of_tab]='';
		  if(!isset($data['xpayment']['postal'][$no_of_tab]))$data['xpayment']['postal'][$no_of_tab]='';
		  if(!isset($data['xpayment']['coupon'][$no_of_tab]))$data['xpayment']['coupon'][$no_of_tab]='';
		  if(!isset($data['xpayment']['postal_rule'][$no_of_tab]))$data['xpayment']['postal_rule'][$no_of_tab]='inclusive';
		  if(!isset($data['xpayment']['coupon_rule'][$no_of_tab]))$data['xpayment']['coupon_rule'][$no_of_tab]='inclusive';
		  if(!isset($data['xpayment']['time_start'][$no_of_tab]))$data['xpayment']['time_start'][$no_of_tab]='';
		  if(!isset($data['xpayment']['time_end'][$no_of_tab]))$data['xpayment']['time_end'][$no_of_tab]='';
		  
		  if(!isset($data['xpayment']['manufacturer_rule'][$no_of_tab]))$data['xpayment']['manufacturer_rule'][$no_of_tab]='2';
		  if(!isset($data['xpayment']['multi_category'][$no_of_tab]))$data['xpayment']['multi_category'][$no_of_tab]='all';
		  
		  
		  if(!isset($data['xpayment']['inc_email'][$no_of_tab]))$data['xpayment']['inc_email'][$no_of_tab]='';
		  if(!isset($data['xpayment']['inc_order'][$no_of_tab]))$data['xpayment']['inc_order'][$no_of_tab]='';
		 
		  if(!isset($data['xpayment']['callback'][$no_of_tab]))$data['xpayment']['callback'][$no_of_tab]='';
		  if(!isset($data['xpayment']['redirect'][$no_of_tab]))$data['xpayment']['redirect'][$no_of_tab]='';
		  if(!isset($data['xpayment']['success'][$no_of_tab]))$data['xpayment']['success'][$no_of_tab]='';
		  if(!isset($data['xpayment']['redirect_type'][$no_of_tab]))$data['xpayment']['redirect_type'][$no_of_tab]='post';
		  if(!isset($data['xpayment']['order_status_id'][$no_of_tab]))$data['xpayment']['order_status_id'][$no_of_tab]='';
		  if(!isset($data['xpayment']['logo'][$no_of_tab]))$data['xpayment']['logo'][$no_of_tab]='';
		  if(!isset($data['xpayment']['without_coupon'][$no_of_tab]))$data['xpayment']['without_coupon'][$no_of_tab]='';
		  
		  if(!isset($data['xpayment']['redirect_data'][$no_of_tab]))$data['xpayment']['redirect_data'][$no_of_tab]='';
		  if(!isset($data['xpayment']['redirect_success'][$no_of_tab]))$data['xpayment']['redirect_success'][$no_of_tab]='';
		  if(!isset($data['xpayment']['email'][$no_of_tab]))$data['xpayment']['email'][$no_of_tab]='';

		  
		
		  $return.='<div id="xpayment-'.$no_of_tab.'" class="tab-pane xpayment">'
          .'<div class="action-btn">'
		     .'<button class="btn btn-warning btn-copy" data-toggle="tooltip" type="button" data-original-title="'.$data['text_method_copy'].'"><i class="fa fa-copy"></i></button>'
			 .'<button class="btn btn-danger btn-delete" data-toggle="tooltip" type="button" data-original-title="'.$data['text_method_remove'].'"><i class="fa fa-trash-o"></i></button>'
		   .'</div>'
          .'<ul class="nav nav-tabs" id="language'.$no_of_tab.'">';
          
		  $inc=0; 
		   foreach ($data['languages'] as $language) { 
		       $active_cls=($inc==0)?'class="active"':''; 
			   $inc++;
              $return.='<li '.$active_cls.' ><a href="#language'.$language['language_id'].''.$no_of_tab.'" data-toggle="tab"><img src="language/'.$language['code'].'/'.$language['code'].'.png" title="'.$language['name'].'" /> '.$language['name'].'</a></li>';
             } 
          $return.='</ul>'
		   .'<div class="tab-content">';
          
		   $inc=0;
		   foreach ($data['languages'] as $language) { 
		        $active_cls=($inc==0)?' active':''; 
			    $lang_cls=($inc==0)?'':'-lang'; $inc++; 
				if(!isset($names[$language['language_id']]) || !$names[$language['language_id']])$names[$language['language_id']]='Untitled Method '.$no_of_tab;     
				if(!isset($data['xpayment']['instruction'][$no_of_tab][$language['language_id']]) || !$data['xpayment']['instruction'][$no_of_tab][$language['language_id']])$data['xpayment']['instruction'][$no_of_tab][$language['language_id']]='';
				if(!isset($data['xpayment']['email_instruction'][$no_of_tab][$language['language_id']]) || !$data['xpayment']['email_instruction'][$no_of_tab][$language['language_id']])$data['xpayment']['email_instruction'][$no_of_tab][$language['language_id']]='';
				if(!isset($data['xpayment']['term'][$no_of_tab][$language['language_id']]) || !$data['xpayment']['term'][$no_of_tab][$language['language_id']])$data['xpayment']['term'][$no_of_tab][$language['language_id']]='';
				
               $return.='<div class="tab-pane'.$active_cls.'" id="language'.$language['language_id'].''.$no_of_tab.'">'
		        .'<div class="form-group required">'
				.'<label class="col-sm-2 control-label" for="lang-name-'.$no_of_tab.''.$language['language_id'].'">'.$data['entry_name'].'</label>'
				.'<div class="col-sm-10">'
				 .'<input type="text" name="xpayment[name]['.$no_of_tab.']['.$language['language_id'].']" value="'.$names[$language['language_id']].'" placeholder="'.$data['entry_name'].'" id="lang-name-'.$no_of_tab.''.$language['language_id'].'" class="form-control method-name'.$lang_cls.'" />'
				 .'</div>'
			  .'</div>'
			   .'<div class="form-group">'
				.'<label class="col-sm-2 control-label" for="lang-term-'.$no_of_tab.''.$language['language_id'].'"><span data-toggle="tooltip" title="'.$data['tip_payment_terms'].'">'.$data['payment_terms'].'</span></label>'
				.'<div class="col-sm-10">'
				 .'<input type="text" name="xpayment[term]['.$no_of_tab.']['.$language['language_id'].']" value="'.$data['xpayment']['term'][$no_of_tab][$language['language_id']].'" placeholder="'.$data['payment_terms'].'" id="lang-term-'.$no_of_tab.''.$language['language_id'].'" class="form-control" />'
				 .'</div>'
			  .'</div>'
		      .'<div class="form-group">'
				.'<label class="col-sm-2 control-label" for="lang-instruction-'.$no_of_tab.''.$language['language_id'].'"><span data-toggle="tooltip" title="'.$data['tip_instruction'].'">'.$data['entry_instruction'].'</span></label>'
				.'<div class="col-sm-10">'
				 .'<textarea class="form-control" id="lang-instruction-'.$no_of_tab.''.$language['language_id'].'" name="xpayment[instruction]['.$no_of_tab.']['.$language['language_id'].']" rows="8" cols="70" />'.$data['xpayment']['instruction'][$no_of_tab][$language['language_id']].'</textarea>'.$data['text_keyword']
				 .'</div>'
			  .'</div>'
			  .'<div class="form-group">'
				.'<label class="col-sm-2 control-label" for="lang-email_instruction-'.$no_of_tab.''.$language['language_id'].'"><span data-toggle="tooltip" title="'.$data['tip_email_instruction'].'">'.$data['text_instruction_email'].'</span></label>'
				.'<div class="col-sm-10">'
				 .'<textarea class="form-control" id="lang-email_instruction-'.$no_of_tab.''.$language['language_id'].'" name="xpayment[email_instruction]['.$no_of_tab.']['.$language['language_id'].']" rows="8" cols="70" />'.$data['xpayment']['email_instruction'][$no_of_tab][$language['language_id']].'</textarea>'.$data['text_keyword']
				 .'</div>'
			  .'</div>'
	         .'</div>';
	        } 
	    $return.='</div>'
          .'<ul class="nav nav-tabs" id="method-tab-'.$no_of_tab.'">'
             .'<li class="active"><a href="#common_'.$no_of_tab.'" data-toggle="tab">'.$data['text_general'].'</a></li>'
             .'<li><a href="#criteria_'.$no_of_tab.'" data-toggle="tab">'.$data['text_criteria_setting'].'</a></li>'
             .'<li><a href="#catprod_'.$no_of_tab.'" data-toggle="tab">'.$data['text_category_product'].'</a></li>'
             .'<li><a href="#price_'.$no_of_tab.'" data-toggle="tab">'.$data['text_price_setting'].'</a></li>'
             .'<li><a href="#other_'.$no_of_tab.'" data-toggle="tab">'.$data['text_others'].'</a></li>'
           .'</ul>' 
		   .'<div class="tab-content">'
           .'<div class="tab-pane active" id="common_'.$no_of_tab.'">'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-inc-email'.$no_of_tab.'">'.$data['text_inc_email'].'</label>'
                  .'<div class="col-sm-10"><input '.(($data['xpayment']['inc_email'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[inc_email]['.$no_of_tab.']" value="1" class="form-control" id="input-inc-email'.$no_of_tab.'" /></div>'
                .'</div>'
                 .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-inc-order'.$no_of_tab.'">'.$data['text_inc_order'].'</label>'
                  .'<div class="col-sm-10"><input '.(($data['xpayment']['inc_order'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[inc_order]['.$no_of_tab.']" value="1" class="form-control" id="input-inc-order'.$no_of_tab.'" /></div>'
                .'</div>'
                .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_order_status'].'">'.$data['entry_order_status'].'</span></label>' 
                 .'<div class="col-sm-10">'
                   .'<select name="xpayment[order_status_id]['.$no_of_tab.']">';
                    foreach ($data['order_statuses'] as $order_status) {
		               $return.='<option '.(($order_status['order_status_id']==$data['xpayment']['order_status_id'][$no_of_tab])?'selected':'').' value="'.$order_status['order_status_id'].'">'.$order_status['name'].'</option>';
                      } 
                   $return.='</select>'
	             .'</div>'
               .'</div>'
               .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-logo'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_text_logo'].'">'.$data['text_logo'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[logo]['.$no_of_tab.']" value="'.$data['xpayment']['logo'][$no_of_tab].'" class="form-control" id="input-logo'.$no_of_tab.'" /></div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-sortorder'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_sorting_own'].'">'.$data['entry_sort_order'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[sort_order]['.$no_of_tab.']" value="'.$data['xpayment']['sort_order'][$no_of_tab].'" class="form-control" id="input-sortorder'.$no_of_tab.'" /></div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-status'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_status_own'].'">'.$data['entry_status'].'</span></label>'
                  .'<div class="col-sm-10"><select class="form-control" id="input-status'.$no_of_tab.'" name="xpayment[status]['.$no_of_tab.']">'
                   .'<option value="1" '.(($data['xpayment']['status'][$no_of_tab]==1 || $data['xpayment']['status'][$no_of_tab]=='')?'selected':'').'>'.$data['text_enabled'].'</option>'
					 .'<option value="0" '.(($data['xpayment']['status'][$no_of_tab]==0)?'selected':'').'>'.$data['text_disabled'].'</option>'
                  .'</select></div>'
                .'</div>'
            .'</div>'
            .'<div class="tab-pane" id="criteria_'.$no_of_tab.'">'
               .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_store'].'">'.$data['entry_store'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['store_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[store_all]['.$no_of_tab.']" class="choose-any" value="1" />&nbsp;'.$data['text_any'].'</label>'
		            .'<div class="well well-sm" style="height: 70px; overflow: auto;'.(($data['xpayment']['store_all'][$no_of_tab]!='1')?'display:block':'').'">'
		             .'<div class="checkbox xpayment-checkbox">';
                   
                    foreach ($data['stores'] as $store) {
		               $return.='<label>'
                       .'<input '.((in_array($store['store_id'],$data['xpayment']['store'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[store]['.$no_of_tab.'][]" value="'.$store['store_id'].'" />'.$store['name'].''
		                .'</label>';
                 } 
                 $return.='</div>'
				   .'</div>'
	            .'</div>'
               .'</div>'
			   
			   .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_geo'].'">'.$data['entry_geo_zone'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['geo_zone_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[geo_zone_all]['.$no_of_tab.']" class="choose-any" value="1" />&nbsp;'.$data['text_any'].'</label>'
		            .'<div class="well well-sm" style="height: 100px; overflow: auto;'.(($data['xpayment']['geo_zone_all'][$no_of_tab]!='1')?'display:block':'').'">'
		             .'<div class="checkbox xpayment-checkbox">';
                    
                    foreach ($data['geo_zones'] as $geo_zone) {
                    
		             $return.='<label>'
                       .'<input '.((in_array($geo_zone['geo_zone_id'],$data['xpayment']['geo_zone_id'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[geo_zone_id]['.$no_of_tab.'][]" value="'.$geo_zone['geo_zone_id'].'" />'.$geo_zone['name'].''
		             .'</label>';
                      } 
                  $return.='</div>'
				   .'</div>'
	            .'</div>'
               .'</div>'
			   
			    .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_customer_group'].'">'.$data['entry_customer_group'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['customer_group_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[customer_group_all]['.$no_of_tab.']" class="choose-any" value="1" />&nbsp;'.$data['text_any'].'</label>'
		            .'<div class="well well-sm" style="height: 70px; overflow: auto;'.(($data['xpayment']['customer_group_all'][$no_of_tab]!='1')?'display:block':'').'">'
		             .'<div class="checkbox xpayment-checkbox">';
                    
                     foreach ($data['customer_groups'] as $customer_group) {
                   
		              $return.='<label>'
                       .'<input '.((in_array($customer_group['customer_group_id'],$data['xpayment']['customer_group'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[customer_group]['.$no_of_tab.'][]" value="'.$customer_group['customer_group_id'].'" />'.$customer_group['name'].''
		             .'</label>';
                  } 
                $return.='</div>'
				   .'</div>'
	            .'</div>'
               .'</div>'
			   
			   .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_shipping'].'">'.$data['entry_shipping'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['shipping_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[shipping_all]['.$no_of_tab.']" class="choose-any" value="1" />&nbsp;'.$data['text_any'].'</label>'
		            .'<div class="well well-sm" style="height: 70px; overflow: auto;'.(($data['xpayment']['shipping_all'][$no_of_tab]!='1')?'display:block':'').'">'
		             .'<div class="checkbox xpayment-checkbox">';
                    
                     foreach ($data['shipping_mods'] as $code=>$value) {
						 
						 if (array_key_exists($code,$data['xpaymentshipping'])) {
					        if(!isset($data['xpaymentshipping'][$code])) $data['xpaymentshipping'][$code]=array();
						    $prefix=$value;
						    foreach($data['xpaymentshipping'][$code] as $code =>$value) {
							   $return.='<label>'
                              .'<input '.((in_array($code,$data['xpayment']['shipping'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[shipping]['.$no_of_tab.'][]" value="'.$code.'" />'.$prefix.'- '.$value.''
		             .'</label>';
							}
							continue;
						 }
		              $return.='<label>'
                       .'<input '.((in_array($code,$data['xpayment']['shipping'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[shipping]['.$no_of_tab.'][]" value="'.$code.'" />'.$value.''
		             .'</label>';
                  } 
                $return.='</div>'
				   .'</div>'
	            .'</div>'
               .'</div>'
			   
			   .'<div class="form-group">'
                .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_manufacturer'].'">'.$data['entry_manufacturer'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['manufacturer_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[manufacturer_all]['.$no_of_tab.']" class="choose-any-with" rel="manufacturer-option" value="1" />&nbsp;'.$data['text_any'].'</label>'
		            .'<div class="well well-sm" style="height: 100px; overflow: auto;'.(($data['xpayment']['manufacturer_all'][$no_of_tab]!='1')?'display:block':'').'">'
		             .'<div class="checkbox xpayment-checkbox">';
                  
                    foreach ($data['manufacturers'] as $manufacturer) {
                     
		             $return.='<label>'
                       .'<input '.((in_array($manufacturer['manufacturer_id'],$data['xpayment']['manufacturer'][$no_of_tab]))?'checked':'').' type="checkbox" name="xpayment[manufacturer]['.$no_of_tab.'][]" value="'.$manufacturer['manufacturer_id'].'" />'.$manufacturer['name'].''
		             .'</label>';
                    } 
                  $return.='</div>'
				   .'</div>'
	            .'</div>'
               .'</div>'
                .'<div class="form-group manufacturer-option" '.(($data['xpayment']['manufacturer_all'][$no_of_tab]!='1')?'style="display:block"':'').'>'
                .'<label class="col-sm-2 control-label" for="input-make-rule'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_manufacturer_rule'].'">'.$data['text_manufacturer_rule'].'</span></label>'
                .'<div class="col-sm-10"><select class="form-control" id="input-make-rule'.$no_of_tab.'" name="xpayment[manufacturer_rule]['.$no_of_tab.']">'
                   .'<option value="2" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==2)?'selected':'').'>'.$data['text_manufacturer_all'].'</option>'
		           .'<option value="3" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==3)?'selected':'').'>'.$data['text_manufacturer_least_with_other'].'</option>'
		           .'<option value="6" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==6)?'selected':'').'>'.$data['text_manufacturer_least'].'</option>'
		           .'<option value="4" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==4)?'selected':'').'>'.$data['text_manufacturer_exact'].'</option>'
		           .'<option value="5" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==5)?'selected':'').'>'.$data['text_manufacturer_except'].'</option>'
				   .'<option value="7" '.(($data['xpayment']['manufacturer_rule'][$no_of_tab]==7)?'selected':'').'>'.$data['text_manufacturer_except_other'].'</option>'
                  .'</select></div>'
               .'</div>'
			   
			   .'<div class="form-group">'
                .'<label class="col-sm-2 control-label" for="input-postal'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_zip'].'">'.$data['text_zip_postal'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['postal_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[postal_all]['.$no_of_tab.']" class="choose-any-with" rel="postal-option" value="1" id="input-postal'.$no_of_tab.'" />'.$data['text_any'].'</label>'
	            .'</div>'
               .'</div>'
               .'<div class="form-group postal-option" '.(($data['xpayment']['postal_all'][$no_of_tab]!='1')?'style="display:block"':'').'>'
                .'<label class="col-sm-2 control-label" for="input-zip'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_postal_code'].'">'.$data['text_enter_zip'].'</span></label>'
                .'<div class="col-sm-10"><textarea class="form-control" id="input-zip'.$no_of_tab.'" name="xpayment[postal]['.$no_of_tab.']" rows="8" cols="70" />'.$data['xpayment']['postal'][$no_of_tab].'</textarea></div>'
               .'</div>'
               .'<div class="form-group postal-option" '.(($data['xpayment']['postal_all'][$no_of_tab]!='1')?'style="display:block"':'').'>'
                .'<label class="col-sm-2 control-label" for="input-zip-rule'.$no_of_tab.'">'.$data['text_zip_rule'].'</label>'
                .'<div class="col-sm-10"><select class="form-control" id="input-zip-rule'.$no_of_tab.'" name="xpayment[postal_rule]['.$no_of_tab.']">'
                    .'<option value="inclusive" '.(($data['xpayment']['postal_rule'][$no_of_tab]=='inclusive')?'selected':'').'>'.$data['text_zip_rule_inclusive'].'</option>'
                    .'<option value="exclusive" '.(($data['xpayment']['postal_rule'][$no_of_tab]=='exclusive')?'selected':'').'>'.$data['text_zip_rule_exclusive'].'</option>'
                  .'</select></div>'
               .'</div>'  
			   
			    .'<div class="form-group">'
                .'<label class="col-sm-2 control-label" for="input-coupon'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_coupon'].'">'.$data['text_coupon'].'</span></label>' 
                 .'<div class="col-sm-10">'
		            .'<label class="any-class"><input '.(($data['xpayment']['coupon_all'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[coupon_all]['.$no_of_tab.']" class="choose-any-with" rel="coupon-option" value="1" id="input-coupon'.$no_of_tab.'" />'.$data['text_any'].'</label>'
	            .'</div>'
               .'</div>'
               .'<div class="form-group coupon-option" '.(($data['xpayment']['coupon_all'][$no_of_tab]!='1')?'style="display:blocked"':'').'>'
                .'<label class="col-sm-2 control-label" for="input-coupon-here'.$no_of_tab.'">'.$data['text_enter_coupon'].'</label>'
                .'<div class="col-sm-10"><textarea class="form-control" id="input-coupon-here'.$no_of_tab.'" name="xpayment[coupon]['.$no_of_tab.']" rows="8" cols="70" />'.$data['xpayment']['coupon'][$no_of_tab].'</textarea></div>'
               .'</div>'
               .'<div class="form-group coupon-option" '.(($data['xpayment']['coupon_all'][$no_of_tab]!='1')?'style="display:blocked"':'').'>'
                .'<label class="col-sm-2 control-label" for="input-coupon-rule'.$no_of_tab.'">'.$data['text_coupon_rule'].'</label>'
                .'<div class="col-sm-10"><select class="form-control" id="input-coupon-rule'.$no_of_tab.'" name="xpayment[coupon_rule]['.$no_of_tab.']">'
                    .'<option value="inclusive" '.(($data['xpayment']['coupon_rule'][$no_of_tab]=='inclusive')?'selected':'').'>'.$data['text_coupon_rule_inclusive'].'</option>'
                    .'<option value="exclusive" '.(($data['xpayment']['coupon_rule'][$no_of_tab]=='exclusive')?'selected':'').'>'.$data['text_coupon_rule_exclusive'].'</option>'
                  .'</select></div>'
               .'</div>'
         .'</div>' 
         .'<div class="tab-pane" id="catprod_'.$no_of_tab.'">'
	        .'<div class="form-group">'
              .'<label class="col-sm-2 control-label" for="input-cat-rule'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_category'].'">'.$data['text_category'].'</span></label>'
              .'<div class="col-sm-10"><select id="input-cat-rule'.$no_of_tab.'" class="form-control selection" rel="category" name="xpayment[category]['.$no_of_tab.']">'
                  .'<option value="1" '.(($data['xpayment']['category'][$no_of_tab]==1)?'selected':'').'>'.$data['text_category_any'].'</option>'
                  .'<option value="2" '.(($data['xpayment']['category'][$no_of_tab]==2)?'selected':'').'>'.$data['text_category_all'].'</option>'
		          .'<option value="3" '.(($data['xpayment']['category'][$no_of_tab]==3)?'selected':'').'>'.$data['text_category_least_with_other'].'</option>'
		          .'<option value="6" '.(($data['xpayment']['category'][$no_of_tab]==6)?'selected':'').'>'.$data['text_category_least'].'</option>'
		          .'<option value="4" '.(($data['xpayment']['category'][$no_of_tab]==4)?'selected':'').'>'.$data['text_category_exact'].'</option>'
		          .'<option value="5" '.(($data['xpayment']['category'][$no_of_tab]==5)?'selected':'').'>'.$data['text_category_except'].'</option>'
				   .'<option value="7" '.(($data['xpayment']['category'][$no_of_tab]==7)?'selected':'').'>'.$data['text_category_except_other'].'</option>'
                .'</select></div>'
            .'</div>'
			 .'<div class="form-group category" '.(($data['xpayment']['category'][$no_of_tab]!=1)?'style="display:block"':'').'>'
              .'<label class="col-sm-2 control-label" for="input-mul-cat-rule'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_multi_category'].'">'.$data['text_multi_category'].'</span></label>'
              .'<div class="col-sm-10"><select id="input-mul-cat-rule'.$no_of_tab.'" class="form-control" name="xpayment[multi_category]['.$no_of_tab.']">'
                  .'<option value="all" '.(($data['xpayment']['multi_category'][$no_of_tab]=='all')?'selected':'').'>'.$data['entry_all'].'</option>'
                  .'<option value="any" '.(($data['xpayment']['multi_category'][$no_of_tab]=='any')?'selected':'').'>'.$data['entry_any'].'</option>'
                .'</select></div>'
            .'</div>'
	        .'<div class="form-group category" '.(($data['xpayment']['category'][$no_of_tab]!=1)?'style="display:block"':'').'>'
              .'<label class="col-sm-2 control-label" for="input-category'.$no_of_tab.'">'.$data['entry_category'].'</label>'
              .'<div class="col-sm-10"><input type="text" name="category" value="" placeholder="'.$data['entry_category'].'" id="input-category'.$no_of_tab.'" class="form-control" />'
			     .'<div class="well well-sm product-category" style="height: 150px; overflow: auto;">';
				 foreach ($data['xpayment']['product_category'][$no_of_tab] as $category_id) {
						   $category_info = $this->model_catalog_category->getCategory($category_id);
						   if(!$category_info) {
						     $category_info['path'] = '';
						     $category_info['name'] = '';
						   }
						   $return.='<div class="product-category'.$category_id. '"><i class="fa fa-minus-circle"></i> '.$category_info['path'].'&nbsp;&nbsp;&gt;&nbsp;&nbsp;'.$category_info['name'].'<input type="hidden" class="category" name="xpayment[product_category]['.$no_of_tab.'][]" value="'.$category_id.'" /></div>';
						}
	    $return.='</div>'
			   .'</div>'
            .'</div>'
            .'<div class="form-group">'
              .'<label class="col-sm-2 control-label" for="input-product_rule'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_product'].'">'.$data['text_product'].'</span></label>'
              .'<div class="col-sm-10"><select id="input-product_rule'.$no_of_tab.'" class="form-control selection" rel="product" name="xpayment[product]['.$no_of_tab.']">'
                  .'<option value="1" '.(($data['xpayment']['product'][$no_of_tab]==1)?'selected':'').'>'.$data['text_product_any'].'</option>'
                  .'<option value="2" '.(($data['xpayment']['product'][$no_of_tab]==2)?'selected':'').'>'.$data['text_product_all'].'</option>'
	              .'<option value="3" '.(($data['xpayment']['product'][$no_of_tab]==3)?'selected':'').'>'.$data['text_product_least_with_other'].'</option>'
	              .'<option value="6" '.(($data['xpayment']['product'][$no_of_tab]==6)?'selected':'').'>'.$data['text_product_least'].'</option>'
	              .'<option value="4" '.(($data['xpayment']['product'][$no_of_tab]==4)?'selected':'').'>'.$data['text_product_exact'].'</option>'
	              .'<option value="5" '.(($data['xpayment']['product'][$no_of_tab]==5)?'selected':'').'>'.$data['text_product_except'].'</option>'
				   .'<option value="7" '.(($data['xpayment']['product'][$no_of_tab]==7)?'selected':'').'>'.$data['text_product_except_other'].'</option>'
                .'</select></div>'
             .'</div>'
			  .'<div class="form-group product" ' .(($data['xpayment']['product'][$no_of_tab]!=1)?'style="display:block"':'').'>'
              .'<label class="col-sm-2 control-label" for="input-product'.$no_of_tab.'">'.$data['entry_product'].'</label>'
              .'<div class="col-sm-10"><input type="text" name="product" value="" placeholder="'.$data['entry_product'].'" id="input-product'.$no_of_tab.'" class="form-control" />'
			     .'<div class="well well-sm product-product" style="height: 150px; overflow: auto;">';
				   foreach ($data['xpayment']['product_product'][$no_of_tab] as $product_id) {
						   $product_info = $this->model_catalog_product->getProduct($product_id);
						   if(!$product_info) {
						     $product_info['name'] = '';
						   }
						   $return.='<div class="product-product'.$product_id. '"><i class="fa fa-minus-circle"></i> '.$product_info['name'].'<input type="hidden" name="xpayment[product_product]['.$no_of_tab.'][]" value="'.$product_id.'" /></div>';
						}
				   $return.='</div>'
			   .'</div>'
            .'</div>'
          .'</div>'
         .'<div class="tab-pane" id="price_'.$no_of_tab.'">'
            .'<div class="form-group">'
             .'<label class="col-sm-2 control-label" for="input-total'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_total'].'">'.$data['entry_order_total'].'</span></label>'
             .'<div class="col-sm-10">'
                  .'<div class="row-fluid">'
                     .'<div class="col-sm-5">'
                       .'<input size="15" class="form-control" type="text" name="xpayment[order_total_start]['.$no_of_tab.']" value="'.$data['xpayment']['order_total_start'][$no_of_tab].'" />'
                     .'</div>'
                    .'<div class="col-sm-1">'.$data['entry_to'].'</div>'
                    .'<div class="col-sm-5">'
                       .'<input class="form-control" size="15" type="text" name="xpayment[order_total_end]['.$no_of_tab.']" value="'.$data['xpayment']['order_total_end'][$no_of_tab].'" />'
                    .'</div>'
                  .'</div>'
              .'</div>'
           .'</div>'
		   .'<div class="form-group">'
            .'<label class="col-sm-2 control-label" for="input-total'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_weight'].'">'.$data['entry_order_weight'].'</span></label>'
             .'<div class="col-sm-10">'
                  .'<div class="row-fluid">'
                     .'<div class="col-sm-5">'
                       .'<input size="15" class="form-control" type="text" name="xpayment[weight_start]['.$no_of_tab.']" value="'.$data['xpayment']['weight_start'][$no_of_tab].'" />'
                     .'</div>'
                    .'<div class="col-sm-1">'.$data['entry_to'].'</div>'
                    .'<div class="col-sm-5">'
                       .'<input class="form-control" size="15" type="text" name="xpayment[weight_end]['.$no_of_tab.']" value="'.$data['xpayment']['weight_end'][$no_of_tab].'" />'
                    .'</div>'
                  .'</div>'
              .'</div>'
           .'</div>'
		   .'<div class="form-group">'
           .'<label class="col-sm-2 control-label" for="input-total'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_quantity'].'">'.$data['entry_quantity'].'</span></label>'
             .'<div class="col-sm-10">'
                  .'<div class="row-fluid">'
                     .'<div class="col-sm-5">'
                       .'<input size="15" class="form-control" type="text" name="xpayment[quantity_start]['.$no_of_tab.']" value="'.$data['xpayment']['quantity_start'][$no_of_tab].'" />'
                     .'</div>'
                     .'<div class="col-sm-1">'.$data['entry_to'].'</div>'
                     .'<div class="col-sm-5">'
                       .'<input class="form-control" size="15" type="text" name="xpayment[quantity_end]['.$no_of_tab.']" value="'.$data['xpayment']['quantity_end'][$no_of_tab].'" />'
                    .'</div>'
                  .'</div>'
              .'</div>'
           .'</div>'
		  .'</div>'
           .'<div class="tab-pane" id="other_'.$no_of_tab.'">'
             .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="total-without-coupon'.$no_of_tab.'">'.$data['total_without_coupon'].'</label>'
                  .'<div class="col-sm-10"><input '.(($data['xpayment']['without_coupon'][$no_of_tab]=='1')?'checked="checked"':'').' type="checkbox" name="xpayment[without_coupon]['.$no_of_tab.']" value="1" class="form-control" id="total-without-coupon'.$no_of_tab.'" /></div>'
                .'</div>'
             .'<div class="form-group">'
              .'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="'.$data['tip_day'].'">'.$data['text_days_week'].'</span></label>'
              .'<div class="col-sm-10">'
			      .'<div class="well well-sm well-days" style="height: 60px; overflow: auto;">'
				    .'<div class="checkbox xpayment-checkbox">' 
				      .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(0,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="0" />&nbsp; '.$data['text_sunday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(1,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="1" />&nbsp; '.$data['text_monday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(2,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="2" />&nbsp; '.$data['text_tuesday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(3,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="3" />&nbsp; '.$data['text_wednesday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(4,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="4" />&nbsp; '.$data['text_thursday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(5,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="5" />&nbsp; '.$data['text_friday'].'</label>'
                    .'<label><input name="xpayment[days]['.$no_of_tab.'][]" '.((in_array(6,$data['xpayment']['days'][$no_of_tab]))?'checked':'').' type="checkbox" value="6" />&nbsp; '.$data['text_saturday'].'</label>'
					 .'</div>'
					.'</div>' 
                .'</div>'
             .'</div>'
            .'<div class="form-group">'
                .'<label class="col-sm-2 control-label" for="input-time-start'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_time'].'">'.$data['text_time_period'].'</span></label>'
                .'<div class="col-sm-10">'
				    .'<div class="row">'
					    .'<div class="col-sm-4">'
						   .'<select id="input-time-start'.$no_of_tab.'" class="form-control" name="xpayment[time_start]['.$no_of_tab.']">'
						  .'<option value="">'.$data['text_any'].'</option>';
						 for($i = 1; $i <= 24; $i++) { 
						  $return.='<option '.(($data['xpayment']['time_start'][$no_of_tab]==$i)?'selected':'').' value="'.$i.'">'.date("h:i A", strtotime("$i:00")).'</option>';
						   } 
						$return.='</select>'
				       .'</div>'
				       .'<div class="col-sm-4">'
						  .'<select class="form-control" name="xpayment[time_end]['.$no_of_tab.']">'
						  .'<option value="">'.$data['text_any'].'</option>';
						   for($i = 1; $i <= 24; $i++) { 
						  $return.='<option '.(($data['xpayment']['time_end'][$no_of_tab]==$i)?'selected':'').' value="'.$i.'">'.date("h:i A", strtotime("$i:00")).'</option>';
						   }
						 $return.='</select>'
				        .'</div>'
				     .'</div>'
                .'</div>'
               .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-success'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_success'].'">'.$data['entry_success'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[success]['.$no_of_tab.']" value="'.$data['xpayment']['success'][$no_of_tab].'" class="form-control" id="input-success'.$no_of_tab.'" /></div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-callback'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_callback'].'">'.$data['entry_callback'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[callback]['.$no_of_tab.']" value="'.$data['xpayment']['callback'][$no_of_tab].'" class="form-control" id="input-callback'.$no_of_tab.'" /></div>'
                .'</div>'
                 .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-redirect'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_redirect'].'">'.$data['entry_redirect'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[redirect]['.$no_of_tab.']" value="'.$data['xpayment']['redirect'][$no_of_tab].'" class="form-control" id="input-redirect'.$no_of_tab.'" /></div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-redirect_type'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['tip_redirect_data'].'">'.$data['entry_redirect_type'].'</span></label>'
                  .'<div class="col-sm-10"><select class="form-control" id="input-redirect_type'.$no_of_tab.'" name="xpayment[redirect_type]['.$no_of_tab.']">'
                   .'<option value="post" '.(($data['xpayment']['redirect_type'][$no_of_tab]=='post' || $data['xpayment']['redirect_type'][$no_of_tab]=='')?'selected':'').'>'.$data['entry_redirect_post'].'</option>'
					 .'<option value="get" '.(($data['xpayment']['redirect_type'][$no_of_tab]=='get')?'selected':'').'>'.$data['entry_redirect_get'].'</option>'
                  .'</select></div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="redirect-field'.$no_of_tab.'">'.$data['text_redirect_fields'].'</label>'
                  .'<div class="col-sm-10"><textarea class="form-control" id="redirect-field'.$no_of_tab.'" name="xpayment[redirect_data]['.$no_of_tab.']" rows="5" cols="70" />'.$data['xpayment']['redirect_data'][$no_of_tab].'</textarea>'.$data['text_redirect_hints'].'</div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="redirect-success'.$no_of_tab.'">'.$data['text_success_condition'].'</label>'
                  .'<div class="col-sm-10"><textarea class="form-control" id="redirect-success'.$no_of_tab.'" name="xpayment[redirect_success]['.$no_of_tab.']" rows="2" cols="70" />'.$data['xpayment']['redirect_success'][$no_of_tab].'</textarea>'.$data['text_success_condition_hints'].'</div>'
                .'</div>'
                .'<div class="form-group">'
                  .'<label class="col-sm-2 control-label" for="input-email'.$no_of_tab.'"><span data-toggle="tooltip" title="'.$data['additional_email_tip'].'">'.$data['additional_email'].' </span></label>'
                  .'<div class="col-sm-10"><input type="text" name="xpayment[email]['.$no_of_tab.']" value="'.$data['xpayment']['email'][$no_of_tab].'" class="form-control" id="input-email'.$no_of_tab.'" /></div>'
                .'</div>'
           .'</div>'
		   .'</div>' 
        .'</div>';
          
		}
		
		return $return;		
	}
	
	private function getModuleName($code,$type)
	{
	   if(!$code) return '';
	   
	   $this->language->load('extension/'.$type.'/'.$code);
	   return $this->language->get('heading_title');
	}
}
?>