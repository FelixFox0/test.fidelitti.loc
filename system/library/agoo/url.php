<?php
class agooUrl extends Controller
{
	protected $Url;
	public function __call($name, array $params)
	{
		// if ($this->registry->get('url_work')) return $params;
		/*
        if (strtolower($name) == 'addrewrite' && $this->config->get('config_seo_url_type')!='seo_url' && $this->config->get('config_seo_url_type')!=false) {
        	if (is_object($params[0]) && strtolower(get_class($params[0])) == 'controllercommonseourl') {
        		return $params;
        	}
        }
        */

		if (isset($params[0]) && strtolower($name)  == 'addrewrite' && $this->config->get('sc_ar_'.strtolower(get_class($params[0])))) {
			return $params;
		}
		if (isset($params[0]) && strtolower($name)  == 'addrewrite') {
         	$this->config->set('sc_ar_'.strtolower(get_class($params[0])), true);
		}

		$asc_langmark  = $this->config->get('asc_langmark');


		if($this->config->get('config_language_default_langmark')!='') {
       		$config_language_default = $this->config->get('config_language_default_langmark');
		} else {
			$config_language_default = $this->config->get('config_language');
		}

		$slash     = false;
		$this->Url = $this->registry->get('url_old');

		$this->registry->set('url_work', true);
		$modules   = call_user_func_array(array(
			$this->Url,
			$name
		), $params);
		unset($this->Url);

		if ($name == 'link') {
			$link_route = $params[0];
		} else {
			$link_route = '';
		}

        if (isset($asc_langmark['ex_url_route']) && $asc_langmark['ex_url_route']!='') {
	        $ex_url_route = $asc_langmark['ex_url_route'];
	        $ex_url_route_array = explode('|', $ex_url_route);

			if ($link_route!='') {
				foreach ($ex_url_route_array as $ex_route) {

					if (utf8_strpos(utf8_strtolower($link_route),trim($ex_route)) !== false) {
	            		$ajax = true;
	            		return $modules;
					}
				}
			}
		}

        if (isset($asc_langmark['ex_url_uri']) && $asc_langmark['ex_url_uri']!='') {
	        $ex_url_uri = $asc_langmark['ex_url_uri'];
	        $ex_url_uri_array = explode('|', $ex_url_uri);
			if (isset($this->request->server['REQUEST_URI'])) {
				foreach ($ex_url_uri_array as $ex_uri) {
					if (utf8_strpos(utf8_strtolower($this->request->server['REQUEST_URI']), trim($ex_uri)) !== false) {
		            	$ajax = true;
		            	return $modules;
					}
				}
			}
        }

        $config_url_http  = substr($this->config->get('config_url'), 0, $this->strpos_offset('/', $this->config->get('config_url'), 3) + 1);
        if (!$config_url_http) $config_url_http = HTTP_SERVER;

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$conf_ssl = $this->config->get('config_ssl');
			if (!$conf_ssl) $conf_ssl = HTTPS_SERVER;
			$config_url = substr($conf_ssl, 0, $this->strpos_offset('/', $conf_ssl, 3) + 1);
		} else {
			$conf_url = $this->config->get('config_url');
			if (!$conf_url) $conf_url = HTTP_SERVER;
            $config_url = substr($conf_url, 0, $this->strpos_offset('/', $conf_url, 3) + 1);
		}

		$url = str_replace($config_url, '', $modules);
        $url = str_replace($config_url_http, '', $url);

		if (isset($this->session->data['language'])) {
			$code_session = $this->session->data['language'];
		} else {
			$code_session = $this->config->get('config_language');
		}

		$parts       = explode('/', trim(utf8_strtolower($url), '/'));
		$parts_first = $parts[0];


		foreach ($asc_langmark['prefix'] as $lang_code => $prefix) {
			if (trim(utf8_strtolower($code_session))  == trim(utf8_strtolower($lang_code), '/')) {

				$code_flag    = true;

				if (isset($prefix[utf8_strlen($prefix) - 1]) && $prefix[utf8_strlen($prefix) - 1] == '/') {
					$slash = true;
				}

				$code_prefix = $asc_langmark['prefix'][$lang_code];

				if (isset($asc_langmark['prefix_home_default'][$lang_code]) && $asc_langmark['prefix_home_default'][$lang_code] && (isset($config_language_default[$lang_code]) && $lang_code == $config_language_default[$lang_code]) && (trim($url)=='' || utf8_strpos(utf8_strtolower($url),'index.php?route=common/home') !== false)) {
					$code_prefix = '';
				}

				break;
			}
		}

		if (trim(utf8_strtolower($parts_first), '/') == trim(utf8_strtolower($code_session), '/')) {
		} else {
			if (trim(utf8_strtolower($code_prefix), '/') == '') {
				$del = '';
			} else {
				$del = '/';
			}
			if ($url == '' && !$slash)
				$del = '';
			$modules = $config_url . trim(utf8_strtolower($code_prefix), '/') . $del . $url;
		}

		if (isset($asc_langmark['pagination']) && $asc_langmark['pagination']) {
					if ($this->registry->get('langmark_page')!='') {
			   				$title = $this->document->getTitle();
			   				$description = $this->document->getDescription();
			                if (utf8_strpos($title, ' '. $this->registry->get('langmark_page')) === false) {
								$this->document->setTitle($title .  ' '.$asc_langmark['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
								$this->document->setDescription($description .  ' '.$asc_langmark['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
							}
					}

			         if (isset($params[1]) && (strpos($params[1], $asc_langmark['pagination_prefix'].'=') !== false || strpos($params[1], 'page=') !== false)) {

					       	$component = parse_url(str_replace('&amp;', '&', $modules));
			                $component['path'] = str_replace('/index.php', '', $component['path']);

							$data_array = array();
							if (isset($component['query'])) {
							   parse_str($component['query'], $data_array);
							}

					        if (count($data_array)) {
								 /*** added code seo paging http://opencartadmin.com ***/
					  			$seo_url='';
					  			$paging = '';
					            $devider = '/'; // :)
					            foreach ($data_array as $key => $value) {

											if ($key == $asc_langmark['pagination_prefix'] || $key=="page") {
												$key = $asc_langmark['pagination_prefix'];
												if ($devider != '/') {
													$paging = "/" . $key . "-" . $value;
												} else  {
													$paging = $key . "-" . $value;
												}

												unset($data_array[$key]);
												if (isset($data_array['page'])) {
													unset($data_array['page']);
												}
											}
								}
                                // WTF?

                                if (isset($params[1]) && strpos($params[1], 'page={page}') !== false) {
	                              //  $paging = '';
                                }

					            if (trim($paging,'/') == $asc_langmark['pagination_prefix'].'-1') {
					            	$paging = '';
					            }

								if (count($data_array)) {
									$seo_url .= $paging.'?' . urldecode(http_build_query($data_array, '', '&amp;'));
								} else {
								  	$seo_url .= $paging;
								}
			                    if (trim($component['path']) == '') $mydel =""; else $mydel = "/";
					             $modules = $config_url .trim($component['path'],'/').$mydel.$seo_url;

							}

			         }
			         /* for pagination */
        }

       	if (isset($asc_langmark['commonhome_status']) && $asc_langmark['commonhome_status']) {
			if (utf8_strpos(utf8_strtolower($modules),'index.php?route=common/home') !== false) {

			    if(substr($code_prefix, -1) == '/' || $code_prefix == '') {
			    	$home_divider = '';
			    } else {
			    	$home_divider = '/';
			    }

				if ((utf8_strpos(utf8_strtolower($modules),'&') !== false) || (utf8_strpos(utf8_strtolower($modules),'&amp;') !== false)) {
		           	$modules = str_replace('&amp;', '&', $modules);
		           	$modules = str_replace('&', '&amp;', $modules);
		           	$modules = str_replace($home_divider.'index.php?route=common/home&amp;', '?', $modules);
				 } else {
					$modules = str_replace($home_divider.'index.php?route=common/home', '', $modules);
				 }

			}
       	}
        if (isset($asc_langmark['two_status']) && $asc_langmark['two_status']) {
			$modules = preg_replace('/(?<!^[http:]|[https:])[\/]{2,}/', '/', trim($modules));
		}

		$this->registry->set('url_work', false);

		return $modules;
	}

	private function strpos_offset($needle, $haystack, $occurrence)
	{
		// explode the haystack
		$arr = explode($needle, $haystack);
		// check the needle is not out of bounds
		switch ($occurrence) {
			case $occurrence == 0:
				return false;
			case $occurrence > max(array_keys($arr)):
				return false;
			default:
				return strlen(implode($needle, array_slice($arr, 0, $occurrence)));
		}
	}
}
