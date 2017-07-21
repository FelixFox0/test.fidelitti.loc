<?php
class ControllerExtensionModuleIscroller extends Controller 
{
    private $_data = array('error_warning' => false, 'success' => false);

    private $_defaultSettings = array(
        'infScroll' => array(
            'enabled' => 1,
            'showSeparator' => 0,
            'minDistToBottom' => 100,
            'containerSelector' => '#content .row:nth-last-of-type(2)',
            'paginatorSelector' => '#content .row:nth-last-of-type(1)',
            'itemSelector' => '.product-layout',
            'debugMode' => 0,
            'loadingMode' => 'auto',
            'animation' => 0,
        ),
    );
    
    public function index(){
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->load->model('setting/setting');
            $this->request->post['iscroller_status'] = '1';
			$this->model_setting_setting->editSetting('iscroller', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			if ($this->request->post['action'] == 'apply') {
				$this->response->redirect($this->url->link('extension/module/iscroller', 'token=' . $this->session->data['token'] . '&type=module', true));

             } else {
                $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));

            }
		}
        if (isset($this->session->data['success'])) {
			$this->_data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
        
        
        
        if (isset($this->request->post['iscroller'])) {
            $this->_data['settings'] = $this->request->post['iscroller'];
        } elseif ($this->config->get('iscroller_module')) {
            $this->_data['settings'] = $this->config->get('iscroller_module');
        } else {
            $this->_data['settings'] = $this->_defaultSettings;
        }
        $this->_data['settings'] = $this->mergeSettings($this->_data['settings'], $this->_defaultSettings);
        
        $lang = $this->load->language('extension/module/iscroller');
        $this->document->setTitle($this->language->get('heading_title_adv'));
        if (count($lang)) {
            foreach ($lang as $var => $val) {
                $this->_data['lang_' . $var] = $val;
            }
        }
        $this->_data['text_yes'] = $this->language->get('text_yes');
        $this->_data['text_no']  = $this->language->get('text_no');
        $this->_data['button_cancel'] = $this->language->get('button_cancel');
        
        
        $this->_data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$this->_data['breadcrumbs'][] = array(
			'text' => $this->language->get('modules'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
		);

		$this->_data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_adv'),
			'href' => $this->url->link('module/iscroller', 'token=' . $this->session->data['token'], true)
		);

		$this->_data['action'] = $this->url->link('extension/module/iscroller', 'token=' . $this->session->data['token'], true);

		$this->_data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);
        
        $this->load->model('localisation/language');
		
		$this->_data['languages'] = $this->model_localisation_language->getLanguages();

        
        $this->_data['header'] = $this->load->controller('common/header');
		$this->_data['column_left'] = $this->load->controller('common/column_left');
		$this->_data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/iscroller', $this->_data));
        
        
    }
    
	protected function validate() {
        $this->load->language('extension/module/iscroller');
        $hasAccess = $this->user->hasPermission('modify', 'extension/module/iscroller');
		if (!$hasAccess) {
			$this->_data['error_warning'] = $this->language->get('error_permission');
		}
		return $hasAccess;
	}
    
    protected function mergeSettings($set, $defSet) {
        if (!isset($set['infScroll'])) {
            $set['infScroll'] = array();
        }
        
        foreach ($defSet['infScroll'] as $k => $v) {
            if (!isset($set['infScroll'][$k])) {
                $set['infScroll'][$k] = $v;
            }
        }
       
        return $set;
    }
	
}