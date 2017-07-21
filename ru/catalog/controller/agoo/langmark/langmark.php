<?php
class ControllerAgooLangmarkLangmark extends Controller
{
	private $error = array();
	protected  $data;
	protected $settings;

 	public function __construct($registry) 	{
			parent::__construct($registry);
	}

	public function index($data)
	{
		$this->data = $data;
        $asc_langmark  = $this->config->get('asc_langmark');
        $this->data['langmark'] = '';
		if ((!isset($this->data['settings_general']) || !empty($this->data['settings_general'])) && $this->config->get('ascp_settings') != '') {
			$this->data['settings_general'] = $this->config->get('ascp_settings');
		}

        if (isset($this->data['settings_general']['langmark_widget_status']) && $this->data['settings_general']['langmark_widget_status']) {
		    $this->data['langmark_template'] = 'agoo/langmark/langmark.tpl';
		    $this->language->load('agoo/langmark/langmark');
		    $this->data['type'] = 'langmark';

			$this->data['languages'] = $this->registry->get('langmarkdata');

			if (isset($this->data['languages']) && is_array($this->data['languages'])) {
				usort($this->data['languages'], 'commd');
			}

			$this->language->load('module/language');

			$this->data['text_language'] = $this->language->get('text_language');
	        $this->data['redirect'] = '';
			$this->data['action'] = '';
			$this->data['language_code'] = $this->session->data['language'];
	        $this->data['language_prefix'] = $this->registry->get('langmark_prefix');

		    $class_widget = $this->data['type'].'_widget';
		    $this->data = $this->$class_widget($this->data);
		    $this->data['langmark_template'] = $this->data['template'];

			if (isset($asc_langmark['pagination_prefix'])) {
				$pagination_prefix = $asc_langmark['pagination_prefix'];
			} else {
				$pagination_prefix = 'page';
			}
		 	$file	= DIR_APPLICATION.'controller/record/pagination.php';
			require_once($file);

			if (SC_VERSION > 15) {

				if (isset($this->data['settings_general']['langmark_widget_status']) && $this->data['settings_general']['langmark_widget_status']
				 && isset($asc_langmark['description_status']) && $asc_langmark['description_status'] ) {
		         	if (isset($this->request->get[$pagination_prefix]) && $this->request->get[$pagination_prefix] > 1) {
						if (isset($asc_langmark['desc_type']) && !empty($asc_langmark['desc_type'])) {
	                        foreach ($asc_langmark['desc_type'] as $desc_type) {
				         		$this->load->setreplacedata(array($desc_type['title'] => array('description'=> '')));
                            }
                        }
		         	}
	            }

	            $pagination_object = (object) array('ControllerRecordPagination' => 'setPagination');
	            $this->load->setreplacedata(array('' => array('pagination'=> $pagination_object )));

                if (isset($this->data['settings_general']['langmark_widget_status']) && $this->data['settings_general']['langmark_widget_status']) {
	            	$this->load->setreplacecontroller(array('common/language' => 'record/langmark' ));
	            }


            } else {
 				$langmark = new ControllerRecordPagination($this->registry);

    	        $output = $this->response->getSCOutput();

    	        $output = $langmark->setPagination($output);
            }

			$this->setMain();

           	if (SC_VERSION < 20) {
		 		$file	= DIR_APPLICATION.'controller/record/langmark.php';
			    require_once($file);
				$langmark = new ControllerRecordLangmark($this->registry);
				$this->data['langmark'] = $langmark->index();
			}
        }
	    return $this->data;
	}


	public function setMain() {

        $asc_langmark  = $this->config->get('asc_langmark');

	    if (isset($this->request->get['route'])) {
			$route = $this->request->get['route'];
	    } else {
	    	$route = 'common/home';
	    }

		if (isset($asc_langmark['main_title'][$this->config->get('config_language')]) && $asc_langmark['main_title'][$this->config->get('config_language')]!='' && $route == 'common/home') {
	        $this->document->setTitle($asc_langmark['main_title'][$this->config->get('config_language')]);

		}

		if (isset($asc_langmark['main_description'][$this->config->get('config_language')]) && $asc_langmark['main_description'][$this->config->get('config_language')]!='' && $route == 'common/home') {
            $this->document->setDescription($asc_langmark['main_description'][$this->config->get('config_language')]);
		}

		if (isset($asc_langmark['main_keywords'][$this->config->get('config_language')]) && $asc_langmark['main_title'][$this->config->get('config_language')]!='' && $route == 'common/home') {
        	$this->document->setKeywords($asc_langmark['main_keywords'][$this->config->get('config_language')]);
		}

	}


	private function langmark_widget($data)
	{
		$this->data = $data;
		$this->data['html'] = html_entity_decode($this->data['settingswidget']['html'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		$html_name          = "html." . md5(serialize($this->data['settingswidget'])) . "." . $this->config->get('config_language_id') . ".php";
		$file               = DIR_CACHE . $html_name;

	    $this->deletecache('html');
		if (!file_exists($file) || (isset($this->data['settings_general']['cache_widgets']) && !$this->data['settings_general']['cache_widgets'])) {
			$handle = fopen($file, 'w');
			fwrite($handle, $this->data['html']);
			fclose($handle);
		}

		if (file_exists($file)) {
		$this->data['mark'] = "Mark";
		    extract($this->data);
			ob_start();
			require($file);
			$this->output = ob_get_contents();
			ob_end_clean();
		}

		$this->data['html'] = $this->output;

		if (isset($this->data['settingswidget']['title_list_latest'][$this->config->get('config_language_id')]))
			$this->data['heading_title'] = $this->data['settingswidget']['title_list_latest'][$this->config->get('config_language_id')];
		else
			$this->data['heading_title'] = '';

		if (isset($this->data['settingswidget']['template']) && $this->data['settingswidget']['template'] != '') {
			$this->data['template'] = '/template/agootemplates/widgets/langmark/' . $this->data['settingswidget']['template'];
		} else {
			$this->data['template'] = '/template/agootemplates/widgets/langmark/langmark.tpl';
		}

	     return $this->data;
	}

	private function deletecache($key) {
		$files = glob(DIR_CACHE . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

		if ($files) {
	    	foreach ($files as $file) {
	    		if (file_exists($file)) {
					$file_time = filemtime ($file);
					$date_current = date("d-m-Y H:i:s");
					$date_diff = (strtotime($date_current) - ($file_time))/60;
					if ($date_diff > 5) {
					 unlink($file);
					}
				}
	    	}
		}
	}

}