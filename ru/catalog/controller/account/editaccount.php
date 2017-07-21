<?php
class ControllerAccountEditAccount extends Controller {
	private $error = array();
	public $data = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');
			$this->xtensions->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/edit');

		$this->document->setTitle($this->language->get('heading_title'));
		$modData =  $this->xtensions->getModData();
		$this->data['modData'] = $modData;
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$this->data['title'] = "data-toggle='tooltip' data-placement='top' title ='";
		if(!$isOpencartTwo){
			$title='%s';
		}else{
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
			$title='data-toggle="tooltip" data-placement="top" title ="%s"';
		}
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate($modData)) {
			$this->model_account_customer->editCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			if($isOpencartTwo){
				// Add to activity log
				$this->load->model('account/activity');

				$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);

				$this->model_account_activity->addActivity('edit', $activity_data);
			}
			$this->xtensions->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_edit'),
			'href'      => $this->url->link('account/edit', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_your_details'] = $this->language->get('text_your_details');
		$this->data['text_additional'] = $this->language->get('text_additional');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_loading'] = $this->language->get('text_loading');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');

		$this->language->load('account/xtensions');
		$this->data['title_firstname'] = ($this->language->get('title_firstname')?sprintf($title,$this->language->get('title_firstname')):'');
		$this->data['title_lastname'] = ($this->language->get('title_lastname')?sprintf($title,$this->language->get('title_lastname')):'');
		$this->data['title_email'] = ($this->language->get('title_email')?sprintf($title,$this->language->get('title_email')):'');
		$this->data['title_telephone'] = ($this->language->get('title_telephone')?sprintf($title,$this->language->get('title_telephone')):'');
		$this->data['title_fax'] = ($this->language->get('title_fax')?sprintf($title,$this->language->get('title_fax')):'');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');
		$this->data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$this->data['error_lastname'] = $this->error['lastname'];
		} else {
			$this->data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$this->data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$this->data['error_custom_field'] = array();
		}

		$this->data['action'] = $this->url->link('account/editaccount', '', 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) {
			$this->data['firstname'] = $customer_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($customer_info)) {
			$this->data['lastname'] = $customer_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$this->data['email'] = $customer_info['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$this->data['telephone'] = $customer_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$this->data['fax'] = $this->request->post['fax'];
		} elseif (!empty($customer_info)) {
			$this->data['fax'] = $customer_info['fax'];
		} else {
			$this->data['fax'] = '';
		}

		// Custom Fields
		$this->load->model('account/xcustom_field');
		if($isOpencartTwo){
			$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->customer->getGroupId());
		}else{
			$this->data['custom_fields'] = $this->model_account_xcustom_field->getCustomFields($this->customer->getCustomerGroupId());
		}

		if (isset($this->request->post['custom_field'])) {
			$this->data['register_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($customer_info)) {
			$this->data['register_custom_field'] = $this->xtensions->unserialize($customer_info['custom_field']);
		} else {
			$this->data['register_custom_field'] = array();
		}

		$this->data['back'] = $this->url->link('account/account', '', 'SSL');

		$children = array('common/column_left', 'common/column_right', 'common/content_top','common/content_bottom', 'common/footer', 'common/header');
		$this->data += $this->xtensions->getChildren($children);
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/editaccount.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/xtensions/'.$this->xtensions->viewVersion().'/editaccount.tpl';
		} else {
			$this->template = 'default/template/account/xtensions/'.$this->xtensions->viewVersion().'/editaccount.tpl';
		}

		$this->response->setOutput($this->xtensions->renderView($this));
	}

	protected function validate($modData) {

		if ($modData['f_name_req_edit'] && $modData['f_name_show_edit']  && ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32))) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ($modData['l_name_req_edit'] && $modData['l_name_show_edit'] && ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32))) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ($modData['mob_req_edit'] && $modData['mob_show_edit'] && ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32))) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		// Custom field validation
		$this->load->model('account/xcustom_field');
		if($this->xtensions->isOpencartTwo()){
			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->customer->getGroupId());
		}else{
			$custom_fields = $this->model_account_xcustom_field->getCustomFields($this->customer->getCustomerGroupId());
		}

		foreach ($custom_fields as $custom_field) {
			if($custom_field['location'] == 'account'){
				if (($custom_field['type']!='text' && $custom_field['type']!='textarea' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']]))) {
					$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
				}else if(($custom_field['type']=='text') || ($custom_field['type']=='textarea')){
					$field =   $this->request->post['custom_field'][$custom_field['custom_field_id']];
					if($custom_field['required'] && (( utf8_strlen($field)<$custom_field['minimum']) ||  utf8_strlen($field)>$custom_field['maximum'])){
						$this->error['custom_field'][$custom_field['custom_field_id']] = $custom_field['error'];
					}
				}
			}
		}

		return !$this->error;
	}

}