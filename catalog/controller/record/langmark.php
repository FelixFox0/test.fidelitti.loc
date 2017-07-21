<?php
class ControllerRecordLangmark extends Controller {

	protected $data;
	protected $settings;

	public function index() {



			$this->config->set("blog_work", true);

			$this->settings = $this->config->get('asc_langmark');

			if (SC_VERSION < 20) {
				$this->load->language('module/language');
			} else {
				$this->load->language('common/language');
			}

			$this->data['text_language'] = $this->language->get('text_language');

			$this->data['action'] = '';

			$this->data['code'] = $this->data['language_code'] = $this->session->data['language'];

			$this->load->model('localisation/language');

			$this->data['languages'] = array();

			$language_code = $this->config->get('config_language');
			$language_id = $this->config->get('config_language_id');
	        if (isset($this->request->get['route'])) {
		      	$route = $this->request->get['route'];
	        } else {
	            $route = 'common/home';
	        }

			$results = $this->model_localisation_language->getLanguages();
			$count_languages = count($results);

			if ($count_languages > 1) {
				foreach ($results as $result) {
						if ($result['status']) {

		                	$this->switchLanguage($result['language_id'], $result['code']);

							$url_lang = $this->url->link($route, $this->getQueryString(array(
											'route',
											'_route_',
											'site_language'
											)));


		                    if (isset($this->settings['hreflang'][$result['code']]) && $this->settings['hreflang'][$result['code']]!='') {
		                        $hreflang = $this->settings['hreflang'][$result['code']];
		                    } else {
		                    	$hreflang = $result['code'];
		                    }

							$array_hreflang[$result['code']] = Array('href' => $url_lang , 'hreflang' => $hreflang );

							 if (!isset($result['image'])) {
							 	$result['image'] = 'catalog/language/'. $result['code'].'/'.$result['code'].'.png';
							 }
							 $this->data['languages'][] = array(
								'url'  => $url_lang,
								'name'  => $result['name'],
								'code'  => $result['code'],
								'image' => $result['image']
							 );
						}
					}
			        $this->switchLanguage($language_id, $language_code);

		            if (method_exists($this->document, 'setHreflang')  && isset($this->settings['hreflang_status']) && $this->settings['hreflang_status']) {
						$this->document->setHreflang($array_hreflang);
					}

      				/*
			 		$file	= DIR_APPLICATION.'controller/record/pagination.php';
				    require_once($file);
					$langmark = new ControllerRecordPagination($this->registry);
					$langmark->index();
                    */

		        $template = 'langmark.tpl';

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/agootemplates/record/' . $template)) {
					$this_template = $this->config->get('config_template') . '/template/agootemplates/record/' . $template;
				} else {
					if (file_exists(DIR_TEMPLATE . 'default/template/agootemplates/record/' . $template)) {
						$this_template = 'default/template/agootemplates/record/' . $template;
					} else {
						$this_template = 'default/template/agootemplates/record/langmark.tpl';
					}
				}

				$this->data['language'] = $this->language;
				$this->data['theme']    = $this->config->get('config_template');
				$this->config->set("blog_work", false);
				$this->template            = $this_template;

				if (SC_VERSION < 20) {
					$html = $this->render();
				} else {
					$html = $this->load->view($this->template, $this->data);
				}

				return $html;
			} else {
				$this->config->set("blog_work", false);
			}

	}
		private function getQueryString($exclude = array())
		{
			if (!is_array($exclude)) {
				$exclude = array();
			}
			return urldecode(http_build_query(array_diff_key($this->request->get, array_flip($exclude))));
		}

		public function switchLanguage($language_id, $code)
		{
			if ($code != '') {
				$this->config->set('config_language_id', $language_id);
				$this->config->set('config_language', $code);
				$this->session->data['language'] = $code;

                if (isset($this->settings['jazz']) && $this->settings['jazz']) {
					setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
				}

			}
		}
}
