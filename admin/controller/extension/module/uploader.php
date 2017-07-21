<?php
class ControllerExtensionModuleUploader extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('extension/module/uploader');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');

		$this->document->addScript('view/javascript/colorpicker/bootstrap-colorpicker.min.js');
		$this->document->addStyle('view/stylesheet/bootstrap-colorpicker.min.css');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('uploader', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
		
		$data['heading_title'] 					= $this->language->get('heading_title');
		
		$data['text_module'] 					= $this->language->get('text_module');
		$data['text_success'] 					= $this->language->get('text_success');
		$data['text_edit'] 						= $this->language->get('text_edit');
		$data['text_yes']						= $this->language->get('text_yes');
		$data['text_no']						= $this->language->get('text_no');
		$data['text_enabled']					= $this->language->get('text_enabled');
		$data['text_disabled']					= $this->language->get('text_disabled');
		
		$data['entry_status']					= $this->language->get('entry_status');
		$data['entry_auto']						= $this->language->get('entry_auto');
		$data['entry_textbutton']				= $this->language->get('entry_textbutton');
		$data['entry_textcolor']				= $this->language->get('entry_textcolor');
		$data['entry_colorbutton']				= $this->language->get('entry_colorbutton');
		$data['entry_defaultcolorbutton'] 		= $this->language->get('entry_defaultcolorbutton');
		$data['entry_choosedefaultcolorbutton']	= $this->language->get('entry_choosedefaultcolorbutton');
		$data['entry_colorbuttonhover']			= $this->language->get('entry_colorbuttonhover');
		$data['entry_customclass']				= $this->language->get('entry_customclass');
		
		$data['button_save']					= $this->language->get('button_save');
		$data['button_cancel']					= $this->language->get('button_cancel');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'] . '&type=module', true)
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/uploader', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['action'] = $this->url->link('extension/module/uploader', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->post['uploader_auto'])) {
			$data['uploader_auto'] = $this->request->post['uploader_auto'];
		} else {
			$data['uploader_auto'] = $this->config->get('uploader_auto');
		}

		if (isset($this->request->post['uploader_colorbutton'])) {
			$data['uploader_colorbutton'] = $this->request->post['uploader_colorbutton'];
		} else {
			$data['uploader_colorbutton'] = $this->config->get('uploader_colorbutton');
		}

		if (isset($this->request->post['uploader_colorbuttonhover'])) {
			$data['uploader_colorbuttonhover'] = $this->request->post['uploader_colorbuttonhover'];
		} else {
			$data['uploader_colorbuttonhover'] = $this->config->get('uploader_colorbuttonhover');
		}

		if (isset($this->request->post['uploader_defaultcolorbutton'])) {
			$data['uploader_defaultcolorbutton'] = $this->request->post['uploader_defaultcolorbutton'];
		} else {
			$data['uploader_defaultcolorbutton'] = $this->config->get('uploader_defaultcolorbutton');
		}

		if (isset($this->request->post['uploader_choosedefaultcolorbutton'])) {
			$data['uploader_choosedefaultcolorbutton'] = $this->request->post['uploader_choosedefaultcolorbutton'];
		} else {
			$data['uploader_choosedefaultcolorbutton'] = $this->config->get('uploader_choosedefaultcolorbutton');
		}

		if (isset($this->request->post['uploader_customclass'])) {
			$data['uploader_customclass'] = $this->request->post['uploader_customclass'];
		} else {
			$data['uploader_customclass'] = $this->config->get('uploader_customclass');
		}
		
		if (isset($this->request->post['uploader_status'])) {
			$data['uploader_status'] = $this->request->post['uploader_status'];
		} else {
			$data['uploader_status'] = $this->config->get('uploader_status');
		}
		
		if (isset($this->request->post['uploader_textbutton'])) {
			$data['uploader_textbutton'] = $this->request->post['uploader_textbutton'];
		} else {
			$data['uploader_textbutton'] = $this->config->get('uploader_textbutton');
		}

		if (isset($this->request->post['uploader_textcolor'])) {
			$data['uploader_textcolor'] = $this->request->post['uploader_textcolor'];
		} else {
			$data['uploader_textcolor'] = $this->config->get('uploader_textcolor');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/uploader', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/uploader')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}
}