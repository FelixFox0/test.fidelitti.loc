<?php
class ControllerInformationContact extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('information/contact');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->request->post['email']);
            $mail->setReplyTo($this->request->post['email']);
			$mail->setSender(html_entity_decode($this->request->post['name'].' '.$this->request->post['lastname'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode($this->request->post['select_city']."\r\n".$this->language->get('entry_order_number')." ".$this->request->post['ord']."\r\n".$this->request->post['select_category']."\r\n".$this->request->post['secondWhy1']."\r\n".$this->request->post['secondWhy2'], ENT_QUOTES, 'UTF-8')."\r\n".$this->request->post['enquiry']);
/*						$mail->setText(html_entity_decode("country: ".$this->request->post['country']."\r\n".$this->language->get('entry_order_number').' '.$this->request->post['ord'], ENT_QUOTES, 'UTF-8')."\r\n".$this->request->post['enquiry']);*/
			$mail->send();

			$this->response->redirect($this->url->link('information/contact/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/contact')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_location'] = $this->language->get('text_location');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_open'] = $this->language->get('text_open');
		$data['text_comment'] = $this->language->get('text_comment');

		$data['entry_order_number']= $this->language->get('entry_order_number');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$data['entry_select_category'] = $this->language->get('entry_select_category');
		$data['entry_select_city'] = $this->language->get('entry_select_city');

		$data['button_map'] = $this->language->get('button_map');
		/*WB*/
        $data['more']= $this->language->get('more');
        $data['error_enquiry_name']= $this->language->get('error_enquiry_name');
        $data['entry_order_number1']= $this->language->get('entry_order_number1');
        $data['entry_email1']= $this->language->get('entry_email1');

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
				if (isset($this->error['ord'])) {
			$data['error_ord'] = '';
		} else {
			$data['error_ord'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['enquiry'])) {
			$data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$data['error_enquiry'] = '';
		}

		if (isset($this->error['select_category'])) {
			$data['error_select_category'] = $this->error['select_category'];
		} else {
			$data['error_select_category'] = '';
		}

		if (isset($this->error['select_city'])) {
			$data['error_select_city'] = $this->error['select_city'];
		} else {
			$data['error_select_city'] = '';
		}

		$data['button_submit'] = $this->language->get('button_submit');

		$data['action'] = $this->url->link('information/contact', '', true);

		$this->load->model('tool/image');

		if ($this->config->get('config_image')) {
			$data['image'] = $this->model_tool_image->resize($this->config->get('config_image'), $this->config->get($this->config->get('config_theme') . '_image_location_width'), $this->config->get($this->config->get('config_theme') . '_image_location_height'));
		} else {
			$data['image'] = false;
		}

		$data['store'] = $this->config->get('config_name');
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['geocode_hl'] = $this->config->get('config_language');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['fax'] = $this->config->get('config_fax');
		$data['open'] = nl2br($this->config->get('config_open'));
		$data['comment'] = $this->config->get('config_comment');

		$data['locations'] = array();

		$this->load->model('localisation/location');

		foreach((array)$this->config->get('config_location') as $location_id) {
			$location_info = $this->model_localisation_location->getLocation($location_id);

			if ($location_info) {
				if ($location_info['image']) {
					$image = $this->model_tool_image->resize($location_info['image'], $this->config->get($this->config->get('config_theme') . '_image_location_width'), $this->config->get($this->config->get('config_theme') . '_image_location_height'));
				} else {
					$image = false;
				}

				$data['locations'][] = array(
					'location_id' => $location_info['location_id'],
					'name'        => $location_info['name'],
					'address'     => nl2br($location_info['address']),
					'geocode'     => $location_info['geocode'],
					'telephone'   => $location_info['telephone'],
					'fax'         => $location_info['fax'],
					'image'       => $image,
					'open'        => nl2br($location_info['open']),
					'comment'     => $location_info['comment']
				);
			

			}
		
		}

/*	$this->load->model('localisation/country');
	$this->load->model('localisation/zone');
    $this->language->load('progroman/city_manager');
    $city = $this->getCityName();
	$data['city']=$city;
			   */

		 
		 /* $_SESSION[$_COOKIE['default']]['prmn.city_manager']['fias_id']  ;*/
		 
		 
			
      $this->load->model('progroman/city_manager');
	  $cities = $this->model_progroman_city_manager->getCities();
      $this->load->language('common/language');  
	   $data['code'] = $this->session->data['language'];
	
	
/*	echo '<pre>';
     print_r( $data['code']);
	 print_r($cities);
	 
			echo '</pre>';*/
	        
		foreach($cities as $citiey) { 
		if ( $citiey['fias_id']==$_SESSION[$_COOKIE['default']]['prmn.city_manager']['fias_id']){
			if($data['code']=='ru-ru'){
				$data['strana']=$citiey['country_ru'];
				}else{
			if($data['code']=='ua-ua' && $citiey['country_ua']!=="")
				{$data['strana']=$citiey['country_ua'];}else
					{$data['strana']=$citiey['image'];}}
		
			}
;}
	
         

/*	
   

		$country_info = $this->model_localisation_location->getLocation($_SESSION[$_COOKIE['default']]['prmn.city_manager']['fias_id']);

	if ($location_info ) {
			$this->load->model('localisation/zone');

				$data['countri'] =$country_info['name'];}*/
	
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $this->customer->getFirstName();
		}
		if (isset($this->request->post['ord'])) {
			$data['ord'] = $this->request->post['ord'];
		} else {
			$data['ord'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = $this->customer->getLastname();
		}
/*         if (isset($this->request->post['country'])) {
			$data['country'] = $this->request->post['country'];
		} else {
			$data['country'] = '';*/
			
		if (isset($this->request->post['select_city'])) {
			$data['select_city'] = $this->request->post['select_city'];
		} else {
			$data['select_city'] = '';
		}

		if (isset($this->request->post['select_category'])) {
			$data['select_category'] = $this->request->post['select_category'];
		} else {
			$data['select_category'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['enquiry'])) {
			$data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$data['enquiry'] = '';
		}
		if (isset($this->request->post['secondWhy1'])) {
			$data['secondWhy1'] = $this->request->post['secondWhy1'];
		} else {
			$data['secondWhy1'] = '';}
				
		if (isset($this->request->post['secondWhy2'])) {
			$data['secondWhy2'] = $this->request->post['secondWhy2'];
		} else {
			$data['secondWhy2'] = '';}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('information/contact', $data));
	}

	protected function validate() {
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 3) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if (!preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
			$this->error['enquiry'] = $this->language->get('error_enquiry');
		}

	/*	if ((utf8_strlen($this->request->post['select_category']) < 3) || (utf8_strlen($this->request->post['select_category']) > 3000)) {
			$this->error['select_category'] = $this->language->get('error_select_category');
		}*/

		if ((utf8_strlen($this->request->post['select_city']) < 3) || (utf8_strlen($this->request->post['select_city']) > 3000)) {
			$this->error['select_city'] = $this->language->get('error_select_city');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		return !$this->error;
	}

	public function success() {
		$this->load->language('information/contact');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/contact')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = $this->language->get('text_success');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/success', $data));
	}
}
