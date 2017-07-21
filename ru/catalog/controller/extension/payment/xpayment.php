<?php

class ControllerExtensionPaymentXpayment extends Controller {

	public function index() {

		  $this->language->load('extension/payment/xpayment');
		  $this->load->model('checkout/order');
		
	      $data['button_confirm'] = $this->language->get('button_confirm');
		
		  $language_id=$this->config->get('config_language_id');
		  $payment_method=$this->session->data['payment_method']['code'];
		  
		  $xpayment=$this->config->get('xpayment');
		   if($xpayment) {
		    $xpayment=unserialize(base64_decode($xpayment));
		  }
		  
		  if(!isset($xpayment['name']))$xpayment['name']=array();
		  if(!is_array($xpayment['name']))$xpayment['name']=array();

          $redirect=''; 
          $redirect_type=''; 
		  $xpayment_instruction='';
		  $xpayment_name='';
		  $success='';
		  $redirect_data = '';
		  $redirect_success = '';
                   
          foreach($xpayment['name'] as $no_of_tab=>$names){
              
               if($payment_method=='xpayment'.'.xpayment'.$no_of_tab){
              
                  if(!is_array($names))$names=array();
		
		 	      if(!isset($xpayment['instruction'][$no_of_tab]))$xpayment['instruction'][$no_of_tab]=array();
		 	      if(!is_array($xpayment['instruction'][$no_of_tab]))$xpayment['instruction'][$no_of_tab]=array();
		 	      
		 	      $redirect=isset($xpayment['redirect'][$no_of_tab])?$xpayment['redirect'][$no_of_tab]:'';
		 	      $redirect_type=isset($xpayment['redirect_type'][$no_of_tab])?$xpayment['redirect_type'][$no_of_tab]:'post';
		 	      $redirect_data=isset($xpayment['redirect_data'][$no_of_tab])?$xpayment['redirect_data'][$no_of_tab]:'';
		 	      $redirect_success=isset($xpayment['redirect_success'][$no_of_tab])?$xpayment['redirect_success'][$no_of_tab]:'';
		 	  
		 	      $xpayment_name=$names[$language_id];
		 	      $xpayment_instruction=isset($xpayment['instruction'][$no_of_tab][$language_id]) ? $xpayment['instruction'][$no_of_tab][$language_id] : '';
		 	      $success=isset($xpayment['success'][$no_of_tab])?$xpayment['success'][$no_of_tab]:'';
		 	      break;
		 	   }
              
          }
		  
		
		  $order_id=isset($this->session->data['order_id'])?$this->session->data['order_id']:0;
          $order_info = $this->model_checkout_order->getOrder($order_id);
          if(!$order_info) {
            $order_info['total'] = 0;
            $order_info['currency_code'] = $this->config->get('config_currency');
            $order_info['currency_value'] = 1;
          }   
          
          $amount =$this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);
          
		  $customerId = '';
          $customerName = '';
          $notifyURL = $this->url->link('extension/payment/xpayment/confirm', '');
          
          if($order_info) {
            $customerId = $order_info['customer_id'];
            $customerName = $order_info['firstname'].' '.$order_info['lastname'];
          }
          
		  
		  $placeholder=array('{orderId}','{orderTotal}', '{customerId}', '{customerName}','{notifyURL}');
		  $replacer=array($order_id,$amount, $customerId, $customerName, $notifyURL);
		  
		  $xpayment_instruction=str_replace($placeholder,$replacer,$xpayment_instruction);
		  
		  /*check xform status*/
		  $data['xform'] = 0;
	      if($this->getXformStatus() && preg_match('/\[xform\](\d+)\[\/xform\]/', $xpayment_instruction,$xforms)) {
		     
		            $this->load->language('module/xform');
				    $this->load->model('xform/xform'); 
					$formId = $xforms[1];
					$formdata = (isset($this->request->post['data']) && is_array($this->request->post['data']))?$this->request->post['data']:array();
		        	$form_html=$this->model_xform_xform->renderForm($formId,$formdata);
		        	
		        	$form_html .= '<style>li.li-submit{display:none;}</style>';
		        	
		        	$xpayment_instruction = str_replace('[xform]'.$formId.'[/xform]', $form_html, $xpayment_instruction); 
		        	$data['xform'] = $formId;
		  }
		  
		  /*xform end*/
		  
		  if($success) $success=str_replace($placeholder,$replacer,htmlspecialchars_decode($success));
		  
		  $form_data = array();
		  $replacer[1] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'],false);
		  
		  if($redirect_data) {
		     $redirect_data = explode(',',$redirect_data);  
		     
		     foreach($redirect_data as $single) {
		        
		        if($single) {
		        	
		        	if(strpos($single,':') ===false) continue;
		        	
		        	list($key, $value) = explode(':',$single,2);
		        
		        	if($key && $value) {
		        	    
		        	    if(strpos($value,'{notifyURL}') !==false) {
		        	      $value = str_replace('{notifyURL}?','{notifyURL}&',$value);
		        	    }
		           		$form_data[trim($key)] =  str_replace($placeholder,$replacer,trim($value));
		        	}
		        } 	
		     }
		  }
		    
		
		  $data['form_data'] = $form_data;
		  $data['redirect'] = $redirect;
		  $data['redirect_type'] = strtoupper($redirect_type);
		  $data['xpayment_instruction'] = html_entity_decode($xpayment_instruction);
		  $data['xpayment_name'] = html_entity_decode($xpayment_name);
		  $data['continue'] = ($success)?$success:$this->url->link('checkout/success');

		  return $this->load->view('extension/payment/xpayment', $data);
	  
	}


	public function confirm() {
		  
		  $this->load->model('checkout/order');
		  
		  /*xform integration*/
		  if($this->getXformStatus()) {
		     
		     $this->load->language('module/xform');
		     $this->load->model('xform/xform');
		     
		     $formId = isset($this->request->get['formId'])? $this->request->get['formId'] : 0; 
		      
		     if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->post['data']) && $this->model_xform_xform->validateForm($formId,$this->request->post['data'])) {
		
            		$formdata=array();
					$formdata['formId']     = $formId;
			 		$formdata['userIP'] = $_SERVER['REMOTE_ADDR'];
			 		$formdata['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
			 		$formdata['submitDate'] = date('Y-m-d H:i:s');
			 		$formdata['userId']= ($this->customer->isLogged())? $this->customer->getId(): 0;
					$formdata['storeId']= $this->config->get('config_store_id');
					$formdata['orderId']= $this->session->data['order_id'];
					
			 		$recordId=$this->model_xform_xform->addFormRecord($formdata);
			 		$this->model_xform_xform->processFormData($recordId,$this->request->post['data']);
			 		$this->model_xform_xform->processFormEmail($recordId);
		     }
		     
		     $formError = array();
		     if(isset($this->request->post['data'])) {
		        $formError = $this->model_xform_xform->getErrorDetails($formId,$this->request->post['data']);
		     }
		     
		     if($formError) {
		        echo json_encode($formError);
		        exit;
		     }
		     
		  }
		  
		  /*xform end*/
	
		  $payment_method=$this->session->data['payment_method']['code'];
		  
		  $xpayment=$this->config->get('xpayment');
		  if($xpayment) {
		    $xpayment=unserialize(base64_decode($xpayment));
		  }
		  
		  $callback='';
		  $order_status_id=0;
		  $redirect=''; 
		  $redirect_success = '';
		  $location = $this->url->link('checkout/success');
		  
		  if(!isset($xpayment['name']))$xpayment['name']=array();
		  if(!is_array($xpayment['name']))$xpayment['name']=array();

                
          foreach($xpayment['name'] as $no_of_tab=>$names){
              
               if($payment_method=='xpayment'.'.xpayment'.$no_of_tab){
            
		 	      $order_status_id=$xpayment['order_status_id'][$no_of_tab];
		 	      $callback=$xpayment['callback'][$no_of_tab];
		 	      
		 	      $redirect=isset($xpayment['redirect'][$no_of_tab])?$xpayment['redirect'][$no_of_tab]:'';
		 	      $redirect_success=isset($xpayment['redirect_success'][$no_of_tab])?$xpayment['redirect_success'][$no_of_tab]:'';
		 	       $location=isset($xpayment['success'][$no_of_tab]) && $xpayment['success'][$no_of_tab]?$xpayment['success'][$no_of_tab]:$location;    
		 	      break;
		 	   }
              
          }
          
        $is_success = true;  
          
        if($redirect && $redirect_success) {
           
           if(!$redirect_success) {
             header('location:'.$location);
             exit;
           }
           
           $redirect_success = explode(',',$redirect_success); 
           
		   foreach($redirect_success as $single) {
		        
		        if($single) {
		        	
		        	if(strpos($single,':') ===false) continue;
		        	
		        	list($key, $value) = explode(':',$single,2);
		        	
		        	$found_value = '';
		        
		        	if($key && $value) {
		        	    
		        	    if(isset($_REQUEST[$key])) $found_value = $_REQUEST[$key]; 
		        	    if(isset($_GET[$key])) $found_value = $_GET[$key]; 	
		        	    if(isset($_POST[$key])) $found_value = $_POST[$key]; 
		        	    
		        	    if(strpos($value,'!') !==false) {
		        	    
		        	       $value = trim($value);
		        	       $value = trim($value,'!');
		        	       
		        	       if($found_value == $value) {
		        	         $is_success = false;
		        	       }  
		        	    }
		        	    else {
		        	     
		        	      if($found_value != $value) {
		        	         $is_success = false;
		        	      }   
		        	         
		        	    }
		        	    
		        	}
		        } 	
		    }
       
        }   
        
        
        if($is_success) {
          $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $order_status_id,'',true);
        }
		
		if($callback && $is_success){
		  $ch = curl_init();
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $callback);
          $return = curl_exec($ch);
          curl_close($ch);
        }
        
         if(!$is_success) $location = $this->url->link('checkout/checkout');
        
         if($redirect) {
            header('location:'.$location);
            exit;
         }
        
        echo json_encode(array());
        
	}
	
	public function getXformStatus() {
	  
	      $xform_mod = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `code` = 'xform'")->row;
	      
		  if($xform_mod) {
		     
		     return true;
		  } 
		  
		  return false;  
	}

}

?>