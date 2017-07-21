<?php
/*
 *	location: admin/controller
 */

class ControllerModuleDShopunity extends Controller {
	

	private $codename = 'd_shopunity';
	private $route = 'module/d_shopunity';
	private $extension = array();
	private $store_id = 0;
	//private $config_file = '';

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('d_shopunity/mbooth');
		$this->load->model('d_shopunity/account');
		//$this->load->model('d_shopunity/config');

		//extension.json
		$this->extension = $this->model_d_shopunity_mbooth->getExtension($this->codename);

		//Store_id (for multistore)
		if (isset($this->request->get['store_id'])) { 
			$this->store_id = $this->request->get['store_id']; 
		}

		//Config File (example: d_shopunity)
		//$this->config_file = $this->model_d_shopunity_config->getConfigFile($this->codename);

		//Check if all dependencies are installed
		$this->model_d_shopunity_mbooth->installDependencies($this->codename);

	}

	public function index(){

		if(!$this->model_d_shopunity_account->isLogged()){
			$this->response->redirect($this->url->link('d_shopunity/account/login', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->response->redirect($this->url->link('d_shopunity/extension', 'token=' . $this->session->data['token'], 'SSL'));
	
	}

	public function content_top(){

		$this->load->language('module/d_shopunity');

		//documentation http://t4t5.github.io/sweetalert/
		$this->document->addStyle('view/javascript/d_shopunity/library/sweetalert/sweetalert.css');
		$this->document->addScript('view/javascript/d_shopunity/library/sweetalert/sweetalert.min.js');
		$this->document->addStyle('view/javascript/d_shopunity/library/syntaxhighlight/syntaxhighlight.css');
		$this->document->addScript('view/javascript/d_shopunity/library/syntaxhighlight/syntaxhighlight.js');

		$this->document->addStyle('view/stylesheet/shopunity/bootstrap.css');
		$this->document->addStyle('view/stylesheet/d_shopunity/d_shopunity.css');
		$this->document->addScript('view/javascript/d_shopunity/d_shopunity.js');

		// Breadcrumbs
		$data['breadcrumbs'] = array(); 
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
			);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
			);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_main'),
			'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'], 'SSL')
			);

		if(!empty($this->session->data['error'])){
			$data['error'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if(!empty($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

   		$this->document->setTitle($this->language->get('heading_title_main'));
   		$data['heading_title'] = $this->language->get('heading_title_main');
   		$data['version'] = $this->model_d_shopunity_mbooth->getVersion($this->codename);
   		$data['route'] = $this->request->get['route'];
		//language
		$data['tab_extension'] =  $this->language->get('tab_extension');
		$data['tab_market'] =  $this->language->get('tab_market');
		$data['tab_billing'] =  $this->language->get('tab_billing');
		$data['tab_backup'] =  $this->language->get('tab_backup');
		$data['tab_setting'] =  $this->language->get('tab_setting');
		$data['tab_tester'] =  $this->language->get('tab_tester');
		$data['tab_developer'] =  $this->language->get('tab_developer');

		$data['button_cancel'] =  $this->language->get('button_cancel');

		$data['href_extension'] =  $this->url->link('d_shopunity/extension', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_market'] =  $this->url->link('d_shopunity/market', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_billing'] =  $this->url->link('d_shopunity/order', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_backup'] = $this->url->link('d_shopunity/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_setting'] = $this->url->link('d_shopunity/setting', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_tester'] = $this->url->link('d_shopunity/tester', 'token=' . $this->session->data['token'], 'SSL');
		$data['href_developer'] = $this->url->link('d_shopunity/developer', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['button_logout'] =  $this->language->get('button_logout');
		$data['logout'] = $this->url->link('d_shopunity/account/logout', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$account = $this->config->get('d_shopunity_account');

		$data['tester'] = false;
		if(!empty($account['tester'])){
			$data['tester'] = true;
		}
		$data['developer'] = false;
		if(!empty($account['developer'])){
			$data['developer'] = true;
		}
		$data['header'] = $this->load->controller('common/header');
   		$data['column_left'] = $this->load->controller('common/column_left');

		return $this->load->view('d_shopunity/content_top.tpl', $data);
	}

	public function content_bottom(){

		$data['purchase_url'] = str_replace('&amp;', '&', $this->url->link('d_shopunity/extension/purchase', 'token='.$this->session->data['token'], 'SSL')); 

		$data['footer'] = $this->load->controller('common/footer');
		return $this->load->view('d_shopunity/content_bottom.tpl', $data);
	}



	private function validate($permission = 'modify') {

		if (isset($this->request->post['config'])) {
			return false;
		}

		$this->language->load($this->route);
		
		if (!$this->user->hasPermission($permission, $this->route)) {
			$this->error['warning'] = $this->language->get('error_permission');
			return false;
		}


		return true;
	}

	public function install() {
		// $this->load->model('d_shopunity/vqmod');
		// $this->model_d_shopunity_vqmod->setVqmod('a_vqmod_d_shopunity.xml', 1);

		$this->load->model('d_shopunity/setting');
		$this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/account');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/account');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/developer');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/developer');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/extension');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/extension');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/market');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/market');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/backup');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/backup');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/order');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/order');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/invoice');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/invoice');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/transaction');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/transaction');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/setting');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/setting');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/tester');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/tester');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/dependency');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/dependency');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'access', $this->codename.'/filemanager');
        $this->model_user_user_group->addPermission($this->model_d_shopunity_setting->getGroupId(), 'modify', $this->codename.'/filemanager');

        $this->load->model('d_shopunity/mbooth');
		$this->model_d_shopunity_mbooth->installDependencies($this->codename);

		//$this->getUpdate(1);	  
	}

	public function uninstall() {
		// $this->load->model('d_shopunity/vqmod');
		// $this->model_d_shopunity_vqmod->setVqmod('a_vqmod_d_shopunity.xml', 0);	
		//$this->getUpdate(0);	  
	}
}
?>