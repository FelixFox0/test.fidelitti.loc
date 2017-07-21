<?php
class ControllerXCheckoutXHeader extends Controller {
	public $data=array();
	public function index() {
		$this->data['title'] = $this->document->getTitle();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['name'] = $this->config->get('config_name');

		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}

		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$this->data['logo'] = '';
		}

		$this->language->load('common/header');
		$this->language->load('account/xtensions');

		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		if($this->customer->isLogged()){
			if($this->customer->getFirstName()){
				$display_name=$this->customer->getFirstName();
			}
			else{
				$display_name=substr($this->customer->getEmail(),0,strpos($this->customer->getEmail(),'@'));
			}
			$this->data['text_logged'] = sprintf('<span class=""><a href="%s"><i class="fa fa-user"></i> %s</a> | <a href="%s">'.$this->language->get('text_logout').' <i class="fa fa-sign-out fa-lg"></i></a></span>', $this->url->link('account/account', '', 'SSL'), $display_name, $this->url->link('account/logout', '', 'SSL'));
		}else{
			$this->data['text_logged'] = '<i class="fa fa-user"></i> '.$this->language->get('text_guest_header');
		}

		$this->data['text_ssl_msg'] =$this->language->get('text_ssl_header');

		$this->data['home'] = $this->url->link('common/home');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$isOpencartTwo = $this->xtensions->isOpencartTwo();
		$modData = $this->xtensions->getModData();
		$this->data['custom_css'] = html_entity_decode($modData['css'], ENT_QUOTES, 'UTF-8');
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$connection = 'SSL';
		} else {
			$connection = 'NONSSL';
		}
		if (!isset($this->request->get['route'])) {
			$this->data['redirect'] = $this->url->link('common/home');
		} else {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			$this->data['redirect'] = $this->url->link($route, $url, $connection);
		}

		//currency starts
		if($isOpencartTwo){
			$this->language->load('common/currency');
		}else{
			$this->language->load('module/currency');
		}

		$this->data['text_currency'] = $this->language->get('text_currency');

		$this->data['action'] = $this->url->link('xcheckout/xheader/currency', '', $connection);

		$this->data['currency_code'] = $this->currency->getCode();

		$this->load->model('localisation/currency');

		$this->data['currencies'] = array();

		$results = $this->model_localisation_currency->getCurrencies();

		foreach ($results as $result) {
			if ($result['status']) {
				$this->data['currencies'][] = array(
					'title'        => $result['title'],
					'code'         => $result['code'],
					'symbol_left'  => $result['symbol_left'],
					'symbol_right' => $result['symbol_right']				
				);
			}
		}


		//currency ends

		//language starts


		if($isOpencartTwo){
			$this->language->load('common/language');
		}else{
			$this->language->load('module/language');
		}

		$this->data['text_language'] = $this->language->get('text_language');

		$this->data['action_lang'] = $this->url->link('xcheckout/xheader/language', '', $connection);

		$this->data['language_code'] = $this->session->data['language'];

		$this->load->model('localisation/language');

		$this->data['languages'] = array();

		$results = $this->model_localisation_language->getLanguages();

		foreach ($results as $result) {
			if ($result['status']) {
				$this->data['languages'][] = array(
					'name'  => $result['name'],
					'code'  => $result['code'],
					'image' => $result['image']
				);
			}
		}
		//language ends

		// Daniel's robot detector
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// A dirty hack to try to set a cookie for the multi-store feature
		$this->load->model('setting/store');

		$this->data['stores'] = array();

		if ($this->config->get('config_shared') && $status) {
			$this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();

			$stores = $this->model_setting_store->getStores();

			foreach ($stores as $store) {
				$this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			}
		}

		//$this->load->library('lessc.inc'); // Load LessPHP
		$styleFolder = 'catalog/view/theme/xtensions/stylesheet/less/';
			
		$style_setting = array ( // Setting to overide LessPHP variable
				'bordercolor'		=> '#ccc',
				'color'	=> '#ccc',
				'border-pixel' =>'1px',
				'border-style' => 'dashed'
				//'bgcolor'	=> '#e3eff2'
		);

		$lessFile	= $styleFolder . 'xtensions.less'; // Input Less stylesheet
		$cssFile 	= $styleFolder . 'xtensions.css'; // Output stylesheet
			
		if(false && file_exists($lessFile) && is_writable($styleFolder)){ // Check does .less file is available and stylesheet folder is writable
			$lessNew		= new lessc($lessFile);
			$lessParse	= $lessNew->parse(null, $style_setting); // Parse variable

			$hashCss = file_exists($cssFile) ? sha1_file($cssFile) : '';
			$hashLess = sha1($lessParse);

			if ($hashCss != $hashLess) { // Check does the Hash above is different. If yes, generate new stylesheet.
				file_put_contents($cssFile, $lessParse);
			}

			$this->document->addStyle($cssFile);
		}else{
			$this->document->addStyle($cssFile);
		}
		$this->data['styles'] = $this->document->getStyles();
		$this->language->load('checkout/checkout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_cart'),
			'href'      => $this->url->link('checkout/cart'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_checkout_option'] = $this->language->get('text_checkout_option');
		$this->data['text_checkout_account'] = $this->language->get('text_checkout_account');
		$this->data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');

		$this->data['logged'] = $this->customer->isLogged();

		$this->template = 'xtensions/template/checkout/xheader.tpl';
		return $this->xtensions->renderView($this);
	}

	public function currency(){

		if (isset($this->request->post['currency_code'])) {
			$this->currency->set($this->request->post['currency_code']);

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);

			if (isset($this->request->post['redirect'])) {
				$this->xtensions->redirect($this->request->post['redirect']);
			} else {
				$this->xtensions->redirect($this->url->link('common/home'));
			}
		}
	}

	public function language(){
		if (isset($this->request->post['language_code'])) {
			$this->session->data['language'] = $this->request->post['language_code'];
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			if (isset($this->request->post['redirect_language'])) {
				$this->xtensions->redirect($this->request->post['redirect_language']);
			} else {
				$this->xtensions->redirect($this->url->link('checkout/home'));
			}
		}
	}
}
?>