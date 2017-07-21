<?php
    use \progroman\CityManager\CityManager;

    class ControllerModuleProgromanCityManager extends Controller {

        /** @var CityManager */
        private $city_manager;

        public function __construct($registry) {
            parent::__construct($registry);
            $this->city_manager = CityManager::instance($registry);
        }

        public function init() {
            $this->language->load('progroman/city_manager');
            $city = $this->getCityName();
            $data = ['city' => $city ? $city : $this->language->get('text_unknown')];

            $json = [];
            $json['content'] = $this->loadView('content', $data);
            $json['messages'] = $this->city_manager->getMessages();

            $key = $this->city_manager->getSessionKey();
            $cookieKey = $this->city_manager->getCookieKey('confirm');

            if (!empty($this->session->data[$key]['show_confirm']) || !empty($this->request->cookie[$cookieKey])) {
                $confirm_region = false;
            }
            else {
                $confirm_region = true;
                $settings = $this->config->get('progroman_cm_setting');
                $time = !empty($settings['popup_cookie_time']) ? time() + $settings['popup_cookie_time'] : null;
                $this->session->data[$key]['show_confirm'] = 1;
                setcookie($cookieKey, 1, $time, '/', $this->city_manager->getCookieDomain());
            }

            if ($confirm_region && $city) {
                $data = [
                    'city' => $city,
                    'text_your_city' => $this->language->get('text_your_city'),
                    'text_guessed' => $this->language->get('text_guessed'),
                    'text_yes' => $this->language->get('text_yes'),
                    'text_no' => $this->language->get('text_no'),
                ];
                $json['confirm'] = $this->loadView('confirm', $data);
                $json['confirm_redirect'] = $this->city_manager->isNeedRedirect($this->request->get['url']);
            }

            $this->response->setOutput(json_encode($json));
        }


        public function cities() {
            $data['actual_language'] = $this->session->data['language'];
            $this->language->load('progroman/city_manager');
            $data['text_search'] = $this->language->get('text_search');
            $data['text_search_placeholder'] = $this->language->get('text_search_placeholder');
            $data['text_choose_region'] = $this->language->get('text_choose_region');
            $data['text_go_button'] = $this->language->get('text_go_button');

            $this->load->model('progroman/city_manager');
            $cities = $this->model_progroman_city_manager->getCities();
            $count_columns = 3;
            $data['columns'] = $cities ? array_chunk($cities, ceil(count($cities) / $count_columns)) : [];
            $this->response->setOutput($this->loadView('cities', $data));
        }
        public function index() {
			//echo '<pre>';
			//print_r($_SESSION);
			//echo '</pre>';
			$this->document->addScript('catalog/view/javascript/jquery/progroman/jquery.progroman.autocomplete.js');
			$this->document->addScript('catalog/view/javascript/jquery/progroman/jquery.progroman.city-manager.js');
			$this->document->addStyle('catalog/view/javascript/jquery/progroman/progroman.city-manager.css');
            $data['actual_language'] = $this->session->data['language'];
            $this->language->load('progroman/city_manager');
            $data['text_search'] = $this->language->get('text_search');
            $data['text_search_placeholder'] = $this->language->get('text_search_placeholder');
            $data['text_choose_region'] = $this->language->get('text_choose_region');
            $data['text_go_button'] = $this->language->get('text_go_button');
			$this->load->model('extension/extension');

			if ($this->request->server['HTTPS']) {
				$server = $this->config->get('config_ssl');
			} else {
				$server = $this->config->get('config_url');
			}

			if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
				$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
			}

			$data['title'] = $this->document->getTitle();

			$data['styles'] = $this->document->getStyles();
			$data['scripts'] = $this->document->getScripts();

			if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
				$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
			} else {
				$data['logo'] = '';
			}

			$this->load->language('common/header');
			$data['lang'] = $this->language->get('code');
			$data['direction'] = $this->language->get('direction');

            $this->load->model('progroman/city_manager');
            $cities = $this->model_progroman_city_manager->getCities();
            $count_columns = 3;
            $data['columns'] = $cities ? array_chunk($cities, ceil(count($cities) / $count_columns)) : [];
            $this->response->setOutput($this->loadView('cities_main', $data));
		}

        public function search() {
            $json = [];
            $search = !empty($this->request->get['term']) ? trim($this->request->get['term']) : '';

            if ($search) {
                $this->load->model('progroman/fias');
                $json = $this->model_progroman_fias->findFiasByName($search);
            }

            $this->response->setOutput(json_encode($json));
        }

        public function save() {
            $fias_id = isset($this->request->get['fias_id']) ? $this->request->get['fias_id'] : 0;
            $success = $fias_id && $this->city_manager->setFias($fias_id) ? 1 : 0;
            $this->response->setOutput(json_encode(['success' => $success]));
        }

        private function getCityName() {
            if ($popup_city_name = $this->city_manager->getPopupCityName()) {
                return $popup_city_name;
            }

            if ($short_city_name = $this->city_manager->getShortCityName()) {
                return $short_city_name;
            }

            if ($city_name = $this->city_manager->getCityName()) {
                return $city_name;
            }

            if ($zone_name = $this->city_manager->getZoneName()) {
                return $zone_name;
            }

            if ($country_name = $this->city_manager->getCountryName()) {
                return $country_name;
            }

            return false;
        }

        private function loadView($name, $data = []) {
            if (VERSION < '2.2') {
                $name = '/template/module/progroman/city_manager/' . $name . '.tpl';
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . $name)) {
                    return $this->load->view($this->config->get('config_template') . $name, $data);
                }
                else {
                    return $this->load->view('default' . $name, $data);
                }
            }
            else {
                return $this->load->view('module/progroman/city_manager/' . $name, $data);
            }
        }
    }
