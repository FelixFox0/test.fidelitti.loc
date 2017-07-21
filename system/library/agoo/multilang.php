<?php
class agooMultilang extends Controller
{
	private $langcode_all;
	private $languages_all;
	private $domen = '';

	public function __construct($registry)
	{

		parent::__construct($registry);

		$sc_ver = VERSION;
		if (!defined('SC_VERSION')) define('SC_VERSION', substr(str_replace('.','',$sc_ver), 0,2));

		$asc_langmark  = $this->config->get('asc_langmark');

		$code        	= '';
		$code_cookie 	= '';
		$code_flag   	= false;
		$code_parefix	= '';
        $flag_pagination = false;
		$ajax        	= false;
		$slash       	= false;
        $is_main 		= false;
        $main_pref = false;

		if (isset($this->request->cookie['language'])) {
			$code_cookie = $this->request->cookie['language'];
		}

		if (isset($this->session->data['language'])) {
			$code_cookie = $prev_code = $this->session->data['language'];
		} else {
			$prev_code = '';
		}

		if (!isset($_SESSION['language_first'])) {
			$_SESSION['language_first'] = true;
		}

		if (isset($this->request->get['_route_'])) {
			$route = urldecode($this->request->get['_route_']);
		} else {
			$route = '';
		}

		$uri = $this->request->server['REQUEST_URI'];
        $url_data = parse_url(str_replace('&amp;', '&', $uri));

        if (isset($url_data['path'])) {
        	$url_data['path'] = trim($url_data['path'], '/');
        } else {
        	$url_data['path'] = '';
        }

        $path_info = pathinfo($url_data['path']);


        if (isset($path_info['extension'])) {
        	$url_data['ext'] = $path_info['extension'];
        } else {
        	$url_data['ext'] = '';
        }

		if ($url_data['ext'] =='js') {
           	$ajax = true;
		}


		if (isset($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$ajax = true;
		}

		if ((isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) || $this->config->get('config_secure')) {
			$conf_ssl = $this->config->get('config_ssl');
			if (!$conf_ssl) $conf_ssl = HTTPS_SERVER;
			$this->domen = substr($conf_ssl, 0, $this->strpos_offset('/', $conf_ssl, 3) + 1);
			$config_url = $conf_ssl;
		} else {
			$conf_url = $this->config->get('config_url');
			if (!$conf_url) $conf_url = HTTP_SERVER;
			$this->domen = substr($conf_url, 0, $this->strpos_offset('/', $conf_url, 3) + 1);
			$config_url = $conf_url;
		}

		if (isset($this->request->server['HTTP_ACCEPT'])) {

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('image')) !== false) {

             	if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('html')) !== false) {
                    $ajax = false;
				} else {
					$ajax = true;
				}
            }

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('js')) !== false) {
            	$ajax = true;
			}

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('json')) !== false) {
	            $ajax = true;
			}

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('ajax')) !== false) {
    	        $ajax = true;
			}

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('javascript')) !== false) {
        	    $ajax = true;
			}

		}

        if (isset($asc_langmark['ex_multilang_route']) && $asc_langmark['ex_multilang_route']!='') {
	        $ex_multilang_route = $asc_langmark['ex_multilang_route'];
	        $ex_multilang_route_array = explode('|', $ex_multilang_route);
			if (isset($this->request->get['route'])) {
				foreach ($ex_multilang_route_array as $ex_route) {
					if (utf8_strpos(utf8_strtolower($this->request->get['route']),trim($ex_route)) !== false) {
	            		$ajax = true;
					}
				}
			}
        }

        if (isset($asc_langmark['ex_multilang_uri']) && $asc_langmark['ex_multilang_uri']!='') {
	        $ex_multilang_uri = $asc_langmark['ex_multilang_uri'];
	        $ex_multilang_uri_array = explode('|', $ex_multilang_uri);
			if (isset($this->request->server['REQUEST_URI'])) {
				foreach ($ex_multilang_uri_array as $ex_uri) {
					if (utf8_strpos(utf8_strtolower($this->request->server['REQUEST_URI']), trim($ex_uri)) !== false) {
		            	$ajax = true;
					}
				}
			}
		}


		if ($ajax) {
			$parts       = explode('/', trim(utf8_strtolower($route), '/'));
			$parts_first = $parts[0];
			foreach ($asc_langmark['prefix'] as $lang_code => $prefix) {
				$prefix = urldecode($prefix);
				if ($lang_code == $code_cookie && $route == '') {
					$route = $prefix;
					break;
				}
			}
		}

		$languages = array();
		$query     = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = '1'");
		foreach ($query->rows as $result) {
			$languages[$result['code']] = $result;
			$this->langcode_all[$result['code']]         = $result;
			$this->languages_all[$result['language_id']] = $result;
		}

        foreach ($languages as $language_code => $language_result) {
			if (isset($asc_langmark['prefix_home_default'][$language_code]) && $asc_langmark['prefix_home_default'][$language_code]) {
				$config_language_default[$language_code] = $language_code;
				$this->config->set('config_language_default_langmark', $config_language_default);
				/*
				$this->load->model('setting/setting');
				$settings_config = $this->model_setting_setting->getSetting('config');
				foreach ($settings_config as $key => $value) {
					if ($key == 'config_language') {
						$config_language_default = $value;
						$this->config->set('config_language_default_langmark', $config_language_default);
					}
				}
				*/
	        }
        }



		$parts       = explode('/', trim(utf8_strtolower($route), '/'));

       	$request_uri = urldecode($this->request->server['REQUEST_URI']);

        if ($request_uri !=  $this->request->server['REQUEST_URI'] && count($parts) == 1) {
        	$this->request->server['REQUEST_URI'] = '/'.trim($this->request->server['REQUEST_URI'],'/');
        }
        $request_uri = str_replace($config_url, '' ,ltrim(trim($this->domen, '/').'/' . ltrim($request_uri, '/'),'/'));

		$parts_first = $parts[0];

		$parts_first_array = explode('?', $parts_first);
		$parts_first =  $parts_first_array[0];



		if (!$ajax) {

			if (is_array($asc_langmark['prefix']) && !empty($asc_langmark['prefix'])) {

				foreach ($asc_langmark['prefix'] as $lang_code => $prefix) {
	                $prefix = $code_parefix_uri = urldecode($prefix);

			 		//if ((trim($path_info['filename'])=='' || $path_info['dirname']=='.' ) || (isset($this->request->get['route']) && $this->request->get['route']=='common/home')) {
					if ((trim($path_info['filename'])=='' ) || $path_info['filename'] == trim(utf8_strtolower($prefix), '/') || (isset($this->request->get['route']) && $this->request->get['route']=='common/home')) {
						$is_main = true;
					}

					if (trim(utf8_strtolower($parts_first), '/') == trim(utf8_strtolower($prefix), '/')
						&& trim(utf8_strtolower($prefix), '/') != '') {

						$code_flag    = true;
						$code         = $lang_code;
						$code_parefix = $code_parefix_uri = $asc_langmark['prefix'][$lang_code];


						if (isset($config_language_default[$lang_code]) && ($lang_code == $config_language_default[$lang_code]) && $is_main && isset($asc_langmark['prefix_home_default']) && $asc_langmark['prefix_home_default'] ) {

	                    	$code = $config_language_default[$lang_code];
				        	$code_parefix = '';
				        	$main_pref = true;

				        }

						if ($prefix[strlen($prefix) - 1] == '/') {
							$slash = true;
						}
						break;
					}
					if (trim(utf8_strtolower($prefix), '/') == '' && !$code_flag) {
							$code_parefix                    = $code_parefix_uri = $asc_langmark['prefix'][$lang_code];
							$code_flag                       = false;
							$code                            = $lang_code;
							$this->session->data['language'] = $code;

					}

					if (isset($config_language_default[$lang_code]) && ($lang_code == $config_language_default[$lang_code]) && $is_main && isset($asc_langmark['prefix_home_default']) && $asc_langmark['prefix_home_default'] ) {
                    	$code = $config_language_default[$lang_code];
			        	$code_parefix = '';
			        }


				}
			}
		}


		if ($code_flag) {
			unset($parts[0]);
		}
		if (isset($this->request->post['language_code'])) {
			$code = $this->session->data['language'] = $this->request->post['language_code'];
		}

        $code_red = $code;

		if (($code_red == 'old' && !$ajax) || $main_pref=='old') {

			if ($code_cookie == '') {
				$code_cookie = $this->config->get('config_language');
			}

			$pref = trim($asc_langmark['prefix'][$code_cookie], '/');

            if ($main_pref) {
            	$pref = '';
            }

            $request_uri_without_prefix = substr($request_uri, strlen(trim(utf8_strtolower($code_parefix_uri), '/')), strlen($request_uri) - strlen(trim(utf8_strtolower($code_parefix_uri), '/')) );

            if (!$seo_type = $this->config->get('config_seo_url_type')) {
				$seo_type = 'seo_url';
			}

			$this->cont('common/'.$seo_type);
			$seo_controller = 'controller_common_'.$seo_type;
			$this->request->get['_route_'] = $request_uri_without_prefix;
			$execute_seo = $this->$seo_controller->index();
            if (!isset($this->request->get['route'])) $this->request->get['route']='common/home';
			$seo = str_replace('&amp;', '&', str_replace($this->config_url, '', $this->url->link($this->request->get['route'], $this->getQueryString(array(
				'route',
				'_route_',
				'site_language'
			)), 'SSL')));


            $url = str_replace('&amp;', '&', $this->domen . $pref . '/' . ltrim($request_uri, '/'));
            $url = preg_replace('/(?<!^[http:]|[https:])[\/]{2,}/', '/', trim($url));

            if ($main_pref) {
            	$url = $this->domen . str_replace($this->domen . $asc_langmark['prefix'][$code], '', $url);
            	$url = preg_replace('/(?<!^[http:]|[https:])[\/]{2,}/', '/', trim($url));
            }

            header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
			$this->response->redirect($url);
		}


		$url       = str_replace('&amp;', '&', $this->domen . '/' . ltrim($request_uri, '/'));
        $url       = str_replace('//', '/', $url );

		$slash_end = '';
		$seo_url   = ltrim($request_uri, '/');


		if (isset($request_uri[strlen($request_uri) - 1]) && $request_uri[strlen($request_uri) - 1] == '/' && strlen($request_uri) > 1) {
			$slash_end = '/';
		}
		$parts       = explode('/', trim(utf8_strtolower($request_uri), '/'));
        $parts_route = explode('/', trim(utf8_strtolower($route), '/'));

		if (isset($asc_langmark['pagination']) && $asc_langmark['pagination']) {
		        /* for seo pagination */
				$parts_end = end($parts_route);

				if (strpos($parts_end, $asc_langmark['pagination_prefix'].'-') !== false || strpos($parts_end, 'page-') !== false) {
						list($key, $value) = explode("-", $parts_end);
                        $value = (int)$value;
						if ($value > 1) {
							$this->request->get['page'] = $value;
						}

			   			$title = $this->document->getTitle();
			   			$description = $this->document->getDescription();

						$this->document->setTitle($title .  ' '.$asc_langmark['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
						$this->document->setDescription($description .  ' '.$asc_langmark['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
						$this->registry->set('langmark_page', $value);
						unset($parts_route[count($parts_route) - 1]);

                        $flag_pagination = true;

		        		reset($parts_route);

		       }
		        /* for seo pagination */
        }




		$parts_first = $parts[0];
		$parts_first_array = explode('?', $parts_first);
		$parts_first =  $parts_first_array[0];

		foreach ($asc_langmark['prefix'] as $lang_code => $prefix) {
			$prefix = urldecode($prefix);

			if (trim(utf8_strtolower($parts_first), '/') == trim(utf8_strtolower($prefix), '/') && trim(utf8_strtolower($prefix), '/') != '') {

				$code_parefix = $asc_langmark['prefix'][$lang_code];
				$code_flag    = true;
				$code         = $lang_code;
				if ($prefix[strlen($prefix) - 1] == '/') {
					$slash = true;
				}
				unset($parts_route[0]);
				unset($parts[0]);
				$seo_url = implode("/", $parts) . $slash_end;
				break;
			}
		}

       $this->registry->set('langmark_url', $seo_url);
       $this->registry->set('langmark_prefix', $code_parefix);


		foreach ($asc_langmark['prefix'] as $lang_code => $prefix) {
			$prefix = urldecode($prefix);
			if (isset($prefix[strlen($prefix) - 1]) && $prefix[strlen($prefix) - 1] != '/' && $seo_url != '')
				$del = "/";
			else
				$del = '';
			if ($seo_url == '' || $seo_url == '/') {
				$del     = '';
				$seo_url = '';
			}
			$seourl[$lang_code] = $prefix . $del . $seo_url;
		}

		foreach ($languages as $result) {
			$languages[$result['code']]['url'] = $config_url . $seourl[$result['code']];
		}
		$this->registry->set('langmarkdata', $languages);

		if (!$ajax) {

			if (($prev_code != $code) || $_SESSION['language_first'])
			{
				$_SESSION['language_first'] = false;

				if (isset($asc_langmark['currency'][$code]) && $asc_langmark['currency'][$code]!='') {

					if (SC_VERSION > 21) {
						$this->session->data['currency'] = $asc_langmark['currency'][$code];

						unset($this->session->data['shipping_method']);
						unset($this->session->data['shipping_methods']);
					} else {
						$this->currency->set($asc_langmark['currency'][$code]);
					}

				}

			}

			 if (isset($languages[$code]['language_id'])) {
			 	$this->switchLanguage($languages[$code]['language_id'], $code);
			 }
  		}

		if (isset($this->request->get['_route_'])) {
			if (!isset($asc_langmark['jazz']) || !$asc_langmark['jazz'] || $flag_pagination) {
				if (isset($asc_langmark['jazz']) && $asc_langmark['jazz'] && $flag_pagination) {
					array_unshift($parts_route, trim($code_parefix, "/"));
				}
				$this->request->get['_route_'] = implode("/", $parts_route);
			}
		}

		if (isset($this->request->get['route']) || empty($parts_route)) {
			if (!isset($asc_langmark['jazz']) || !$asc_langmark['jazz'] || $flag_pagination)
			{
				unset($this->request->get['_route_']);
			}
		}

 		if (($code_red == '' && !$ajax) || $main_pref) {

            if (!$seo_type = $this->config->get('config_seo_url_type')) {
				$seo_type = 'seo_url';
			}

			if (SC_VERSION < 22) {
				$this->cont('common/'.$seo_type);
				$seo_controller = 'controller_common_'.$seo_type;
			} else {
				$this->cont('startup/'.$seo_type);
				$seo_controller = 'controller_startup_'.$seo_type;
			}


			$execute_seo = $this->$seo_controller->index();

            if (!isset($this->request->get['route'])) $this->request->get['route']='common/home';
			$seo = str_replace('&amp;', '&', str_replace($this->config_url, '', $this->url->link($this->request->get['route'], $this->getQueryString(array(
				'route',
				'_route_',
				'site_language'
			)), 'SSL')));

            header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
			$this->response->redirect($seo);
		}


	}

	private function getQueryString($exclude = array()) {
		if (!is_array($exclude)) {
				$exclude = array();
		}
		return urldecode(http_build_query(array_diff_key($this->request->get, array_flip($exclude))));
	}

	private function strpos_offset($needle, $haystack, $occurrence)
	{
		$arr = explode($needle, $haystack);

		switch ($occurrence) {
			case $occurrence == 0:
				return false;
			case $occurrence > max(array_keys($arr)):
				return false;
			default:
				return strlen(implode($needle, array_slice($arr, 0, $occurrence)));
		}
	}

		public function switchLanguage($language_id, $code)
		{
			if ($code != '') {
				$this->session->data['language'] = $code;
				setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
				$this->config->set('config_language_id', $language_id);
				$this->config->set('config_language', $code);

				if (SC_VERSION > 21) {
                    $language_construct = $code;
				} else {
					$language_construct = $this->langcode_all[$code]['directory'];
				}
				$language = new Language($language_construct);

				if (SC_VERSION > 15) {
					if (SC_VERSION > 21) {
						$language->load($code);
					} else {
						$language->load('default');
						$language->load($language_construct);
					}

				} else {
					$language->load($this->langcode_all[$code]['filename']);
				}
				$this->registry->set('language', $language);
				$this->session->data['language_old'] = $code;

				$langdata = $this->config->get('config_langdata');
				if (isset($langdata[$language_id])) {
				  foreach ($langdata[$language_id] as $key => $value) {
				    $this->config->set('config_' . $key, $value);
				  }
				}


			}
		}

		public function cont($cont)
		{
			if (!defined('DIR_CATALOG'))
				$dir_catalog =  DIR_APPLICATION;
			else
				$dir_catalog = DIR_CATALOG;

			$file  = $dir_catalog . 'controller/' . $cont . '.php';
			if (file_exists($file)) {
	           $this->cont_loading($cont, $file);
	           return true;
			} else {
				$file  = DIR_APPLICATION . 'controller/' . $cont . '.php';
	            if (file_exists($file)) {
	             	$this->cont_loading($cont, $file);
	            } else {
					trigger_error('Error: Could not load controller ' . $cont . '!');
					exit();
				}
			}
		}
		private function cont_loading ($cont, $file)
		{
				$class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $cont);
				include_once($file);
				$this->registry->set('controller_' . str_replace('/', '_', $cont), new $class($this->registry));
		}


}
