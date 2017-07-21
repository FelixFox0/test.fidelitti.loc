<?php
class ControllerExtensionModuleManager extends Controller
{

	private $type = "extension/module";
	private $extension = "manager";
	private $error = array();	
	private $options = array(
		'customer_groups' => 'checkbox',
		'tax_class' => 'select',
		'geo_zone' => 'select',
		'status' => 'select',
		'sort_order' => 'input');

	public function index()
	{
		$params = array();
		
		$params['extension'] = $this->extension;
		$params['type'] = $this->type;
        
        $this->language->load($this->type.'/'.$this->extension);

		$params['heading_title'] = $this->language->get('heading_title');
		
		$this->document->setTitle($params['heading_title']);

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting($this->extension, $this->request->post);
			$this->session->data['success'] = sprintf($this->language->get('message_success'), $params['heading_title']);
			
			if ($this->request->post['apply']) {
				
				$this->response->redirect($this->url->link($this->type.'/'.$this->extension, 'token='.$this->session->data['token'], true));
				
			} else {
				
				$this->response->redirect($this->url->link('extension/extension', 'token='.$this->session->data['token'], true));
				
			}			
		}
		
		if (isset($this->session->data['success'])) $params['success'] = $this->session->data['success'];
		else $params['success'] = "";
		
		$this->session->data['success'] = "";

		$params['version'] = "2.3";
		
		if (version_compare(VERSION, '2.0', '>=')) $params['text_edit'] = sprintf($this->language->get('text_edit_title'), $this->language->get('heading_title'));
		
		$params['text_yes'] = $this->language->get('text_yes');
		$params['text_no'] = $this->language->get('text_no');
		$params['text_enabled'] = $this->language->get('text_enabled');
		$params['text_disabled'] = $this->language->get('text_disabled');
		$params['text_select_all'] = $this->language->get('text_select_all');
		$params['text_unselect_all'] = $this->language->get('text_unselect_all');

		$params['button_save'] = $this->language->get('button_save');
		$params['button_apply'] = $this->language->get('button_apply');
		$params['button_cancel'] = $this->language->get('button_cancel');

		$params['breadcrumbs'] = array();

   		$params['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token='.$this->session->data['token'], true),      		
      		'separator' => false
   		);

   		$params['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_'.$this->type),
			'href' => $this->url->link('extension/extension', 'token='.$this->session->data['token'], true),
      		'separator' => ' :: '
   		);

   		$params['breadcrumbs'][] = array(
       		'text' => $params['heading_title'],
			'href' => $this->url->link($this->type.'/'.$this->extension, 'token='.$this->session->data['token'], true),
      		'separator' => ' :: '
   		);

		$params['action'] = $this->url->link($this->type.'/'.$this->extension, 'token='.$this->session->data['token'], true);
		$params['cancel'] = $this->url->link('extension/extension', 'token='.$this->session->data['token'], true);

		
		$this->load->model('customer/customer_group');
		$groupmodel = 'model_customer_customer_group';
		
		
		$customer_groups = $this->{$groupmodel}->getCustomerGroups();

		foreach ($customer_groups as $customer_group) {
			$params['customer_groups'][] = array($customer_group['customer_group_id'], $customer_group['name']);
		}
		
		$this->load->model('localisation/tax_class');
		$taxes = $this->model_localisation_tax_class->getTaxClasses();
		
		$params['tax_class'][] = array(0, $this->language->get('text_none'));
	
		foreach ($taxes as $tax) {
			$params['tax_class'][] = array($tax['tax_class_id'], $tax['title']);
		}

		$this->load->model('localisation/geo_zone');
		$geo_zones = $this->model_localisation_geo_zone->getGeoZones();
		
		$params['geo_zone'][] = array(0, $this->language->get('text_all_zones'));
		
		foreach ($geo_zones as $geo_zone) {
			$params['geo_zone'][] = array($geo_zone['geo_zone_id'], $geo_zone['name']);
		}
		
		$this->load->model('localisation/order_status');
        $statuses = $this->model_localisation_order_status->getOrderStatuses();
        
        $params['order_status_id'] = array();

        foreach ($statuses as $status) {
        	$params['order_status_id'][] = array($status['order_status_id'], $status['name']);
        }
        
		$params['status'] = array(
			array('0', $params['text_disabled']),
			array('1', $params['text_enabled']));

		$this->load->model('localisation/language');
		$params['languages'] = $this->model_localisation_language->getLanguages();

		$this->load->model('localisation/stock_status');
		$statuses = $this->model_localisation_stock_status->getStockStatuses();
        
        foreach ($statuses as $status) {
        	$params['stock_status'][] = array($status['stock_status_id'], $status['name']);
        }

		$params['stylesheet'] = $this->extension;
		
		/* Extension specific code */
		
		$this->options = array();
		
		$params['options'] = array_merge(array(
			'mode' => 'select',
			'notice' => 'input',
			'hide_dashboard' => 'radio',
			'filters' => 'radio',
			'notify' => 'radio',
			'default_limit' => 'input',
			'default_links' => 'input',
			'default_sort' => 'select',
			'default_order' => 'select',
			'name_format' => 'select',
			'address_format' => 'textarea',
			'date_format' => 'input',
			'addips' => 'radio',
			'status' => 'select'), $this->options);

		$params['text_color'] = $this->language->get('text_color');
		
		$buttons = array('history', 'invoice', 'shipping', 'delete', 'create', 'minimize', 'toggle', 'filter', 'clear', 'edit_customer', 'view_order', 'edit_order');

		$params['entry_buttons'] = $this->language->get('entry_buttons');
		$params['help_buttons'] = $this->language->get('help_buttons');
		
		if (isset($this->request->post[$this->extension.'_buttons'])) {
			$params[$this->extension.'_buttons'] = $this->request->post[$this->extension.'_buttons'];
		} elseif ($this->config->get($this->extension.'_buttons')) {
			$params[$this->extension.'_buttons'] = $this->config->get($this->extension.'_buttons');
		} else {
			$params[$this->extension.'_buttons'] = array();
		}
		
		$params['buttons'] = array();
			
		foreach ($buttons as $button) {
			$params['buttons'][$button] = $this->language->get('button_'.$button);
		}
								
		$columns = array(
			'select' => '',
			'order_id' => 'o.order_id',
			'order_status_id' => 'o.order_status_id',			
			'customer' => 'customer',
			'recipient' => 'recipient',
			'date_added' => 'o.date_added',
			'date_modified' => 'o.date_modified',
			'products' => '',
			'payment' => 'o.payment_method',
			'shipping' => 'o.shipping_method',
			'subtotal' => 'subtotal',			
			'total' => 'o.total',
			'actions' => '');
						
		$params['entry_columns'] = $this->language->get('entry_columns');
		$params['help_columns'] = $this->language->get('help_columns');
		
		if (isset($this->request->post[$this->extension.'_columns'])) {
			$params[$this->extension.'_columns'] = $this->request->post[$this->extension.'_columns'];
		} elseif ($this->config->get($this->extension.'_columns')) {
			$params[$this->extension.'_columns'] = $this->config->get($this->extension.'_columns');
		} else {
			$params[$this->extension.'_columns'] = array();
		}
		
		if (!$params[$this->extension.'_columns']) {
			unset($params['options']['default_sort']);
			unset($params['options']['default_order']);
		}
		
		$params['columns'] = array();
			
		foreach ($columns as $key => $column) {
			$params['columns'][$key] = $this->language->get('column_'.$key);
		}

		$params['entry_statuses'] = $this->language->get('entry_statuses');
		$params['help_statuses'] = $this->language->get('help_statuses');
						
		if (isset($this->request->post[$this->extension.'_statuses'])) {
			$params[$this->extension.'_statuses'] = $this->request->post[$this->extension.'_statuses'];
		} elseif ($this->config->get($this->extension.'_statuses')) {
			$params[$this->extension.'_statuses'] = $this->config->get($this->extension.'_statuses');
		} else {
			$params[$this->extension.'_statuses'] = array();
		}
									
		$this->load->model('localisation/order_status');
    	$statuses = $this->model_localisation_order_status->getOrderStatuses();

		$statuses[] = array('order_status_id' => "0", 'name' => $this->language->get('text_missing'));
		
    	if ($statuses) {
    		foreach ($statuses as $status) {
    			if (!in_array($status['order_status_id'], array_keys($params[$this->extension.'_statuses']))) {
    				$params[$this->extension.'_statuses'][$status['order_status_id']] = array(
    					'checked' => "0",
    					'name' => $status['name'],
    					'color' => "");
    			} else {
    				$params[$this->extension.'_statuses'][$status['order_status_id']]['name'] = $status['name'];
    			}
    		}
    	}

		$params['entry_payments'] = $this->language->get('entry_payments');
		$params['help_payments'] = $this->language->get('help_payments');
    	
		if (isset($this->request->post[$this->extension.'_payments'])) {
			$params[$this->extension.'_payments'] = $this->request->post[$this->extension.'_payments'];
		} elseif ($this->config->get($this->extension.'_payments')) {
			$params[$this->extension.'_payments'] = $this->config->get($this->extension.'_payments');
		} else {
			$params[$this->extension.'_payments'] = array();
		}
							
		$this->load->model('extension/extension');
		$payments = $this->model_extension_extension->getInstalled('payment');

 		foreach (array_keys($params[$this->extension.'_payments']) as $key) {
 			if (!in_array($key, $payments)) unset($params[$this->extension.'_payments'][$key]);
 		}
 		
		if ($payments) {
    		foreach ($payments as $payment) {
    			$this->language->load('extension/payment/'.$payment);
    			
    			if (!in_array($payment, array_keys($params[$this->extension.'_payments']))) {
    				$params[$this->extension.'_payments'][$payment] = array(
    					'name' => $this->language->get('heading_title'),
    					'color' => "");
    			} else {
    				$params[$this->extension.'_payments'][$payment]['name'] = $this->language->get('heading_title');
    			}
    		}
		}
		
		$params['entry_shippings'] = $this->language->get('entry_shippings');
		$params['help_shippings'] = $this->language->get('help_shippings');
		
		if (isset($this->request->post[$this->extension.'_shippings'])) {
			$params[$this->extension.'_shippings'] = $this->request->post[$this->extension.'_shippings'];
		} elseif ($this->config->get($this->extension.'_shippings')) {
			$params[$this->extension.'_shippings'] = $this->config->get($this->extension.'_shippings');
		} else {
			$params[$this->extension.'_shippings'] = array();
		}
			
		$this->load->model('extension/extension');
		$shippings = $this->model_extension_extension->getInstalled('shipping');

		foreach (array_keys($params[$this->extension.'_shippings']) as $key) {
 			if (!in_array($key, $shippings)) unset($params[$this->extension.'_shippings'][$key]);
 		}

    	if ($shippings) {
    		foreach ($shippings as $shipping) {
    			$this->language->load('extension/shipping/'.$shipping);
    			
    			if (!in_array($shipping, array_keys($params[$this->extension.'_shippings']))) {
    				$params[$this->extension.'_shippings'][$shipping] = array(
    					'name' => $this->language->get('heading_title'),
    					'color' => "");
    			} else {
    				$params[$this->extension.'_shippings'][$shipping]['name'] = $this->language->get('heading_title');
    			}
    		}
    	}
		
		$params['mode'] = array(
			array("full", $this->language->get('text_mode_full')),
			array("custom", $this->language->get('text_mode_custom')));
									
		$params['default_sort'] = array();
	
		foreach ($columns as $key => $column) {
			if (in_array($key, $params[$this->extension.'_columns']) && $column) {
				$params['default_sort'][] = array($column, $this->language->get('column_'.$key));
			}
		}

		$params['default_order'] = array(
			array("ASC", $this->language->get('text_order_asc')),
			array("DESC", $this->language->get('text_order_desc')));
        
		$params['name_format'] = array(
			array('firstname', $this->language->get('text_firstname')),
			array('lastname', $this->language->get('text_lastname')));
		   		
   		$this->language->load('setting/setting');
   		$this->language->load($this->type.'/'.$this->extension);
    								
		/* Generic code */
					
		foreach ($params['options'] as $key => $type) {
			$params['entry_'.$key] = $this->language->get('entry_'.$key);
			$params['help_'.$key] = $this->language->get('help_'.$key);
			
			$from_post = (isset($this->request->post[$this->extension.'_'.$key]) ? $this->request->post[$this->extension.'_'.$key] : "");
			$from_config = $this->config->get($this->extension.'_'.$key);
			$default = ($type == 'checkbox' ? array() : "");
			
			if (!isset($params[$this->extension.'_'.$key])) {
				if (!empty($from_post)) $params[$this->extension.'_'.$key] = $from_post;
				elseif (isset($from_config)) $params[$this->extension.'_'.$key] = $from_config;
				else $params[$this->extension.'_'.$key] = $default;
			}
		}

		/* Extension specific code */
		
		if (!$params[$this->extension.'_address_format']) {
			$params[$this->extension.'_address_format'] = $this->language->get('entry_address_default');
		}
		
		/* Generic code */

		if (isset($this->session->data['errors'])) {
			foreach ($this->session->data['errors'] as $key => $text) {
				$this->error[$key] = $text;
			}
			
			unset($this->session->data['errors']);
        }
       
		if (!empty($this->error)) {
			$params['errors'] = $this->error;
		} else {
			$params['errors'] = "";
		}

		if (version_compare(VERSION, '2.0', '<')) {
			$this->data = $params;
			$this->template = $this->type.'/'.$this->extension.'.tpl';
			$this->children = array('common/header', 'common/footer');
        	$this->response->setoutput($this->render(true));
        } else {
        	$data = $params;
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view($this->type.'/'.$this->extension, $data));
		}
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', $this->type.'/'.$this->extension)) {
			$this->error['warning'] = sprintf($this->language->get('error_permission'), $this->language->get('heading_title'));
		}
		
		$numerics = array('default_limit', 'default_links');
		$percent = array();
		$nonempty = array();

		$fields = array_unique(array_merge($numerics, array_merge($percent, $nonempty)));
		$post = $this->request->post;

		if ($fields) {
			foreach ($fields as $field) {
				if (isset($post[$this->extension.'_'.$field])) {
					$value = $post[$this->extension.'_'.$field];
				
					if (in_array($field, $nonempty) && !$value) {
						$this->error[] = sprintf($this->language->get('error_empty'), $this->language->get('entry_'.$field));
					} elseif (!is_array($value)) {
						$value = trim($value, "%");
				
						if (!empty($value) && !is_numeric($value)) {
							if (in_array($field, $numerics)) {
								$this->error[] = sprintf($this->language->get('error_numerical'), $this->language->get('entry_'.$field));
							} elseif (in_array($field, $percent)) {
								$this->error[] = sprintf($this->language->get('error_percent'), $this->language->get('entry_'.$field));
							}
    	        		} elseif ($value < 0) {
        	    			$this->error[] = sprintf($this->language->get('error_positive'), $this->language->get('entry_'.$field));
            			}
            		}
	            } elseif (in_array($field, $nonempty)) {
    	        	$this->error[] = sprintf($this->language->get('error_empty'), $this->language->get('entry_'.$field));
        	    }
			}
		}			

		if (!$this->error) return true;
		else return false;
	}
}

?>