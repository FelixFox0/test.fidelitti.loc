<?php
class ControllerAgooLangmarkLangmark extends Controller
{
	protected $error = array();
	protected  $data;
	private $module_files_langmark = Array('agootemplates/record/langmark.tpl');

	public function index($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);

        $this->data['langmark_template'] = 'agoo/langmark/langmark.tpl';
       	$this->language->load('agoo/langmark/langmark');

        if (!isset($this->data['id'])) {
         $this->data['id'] = false;
        }

		if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['cached'])) {
			$this->data['ascp_widgets'][$this->data['id']]['cached'] = false;
		}

		if (SC_VERSION < 20) {
			if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['anchor'])) {
				$this->data['ascp_widgets'][$this->data['id']]['anchor'] = "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#language').html(data);";
			}
		} else {
			if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['anchor'])) {
				$this->data['ascp_widgets'][$this->data['id']]['anchor'] = '';
			}
		}


		$this->data['ascp_widgets'][$this->data['id']]['anchor_templates'] = array(
		$this->language->get('entry_anchor_templates_default') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('#language').html(data);",

		$this->language->get('entry_anchor_templates_html') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').html(data);",

		$this->language->get('entry_anchor_templates_clear') => ""
		);


		$this->data['ascp_widgets'][$this->data['id']]['box_begin_templates'] = array(
		$this->language->get('entry_box_begin_templates_empty') => '<div>',
		$this->language->get('entry_anchor_templates_clear') => ""
		);


		$this->data['ascp_widgets'][$this->data['id']]['box_end_templates'] = array(
		$this->language->get('entry_box_end_templates_empty') => '</div>',
		$this->language->get('entry_anchor_templates_clear') => ""
		);


        return $this->data;
	}

	public function settings($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);


       	$this->language->load('agoo/langmark/langmark');

		$this->data['header'] 	= '';
		$this->data['menu'] 	= '';
		$this->data['footer'] 	= '';
		$this->data['column_left'] 	= '';

        $this->data['url_langmark'] = $this->url->link('catalog/langmark', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['entry_url_langmark'] = $this->language->get('entry_url_langmark');


		$this->template = 'agoo/langmark/settings.tpl';
        $this->data['language'] = $this->language;

        if (SC_VERSION < 20) {
			$html = $this->render();
		} else {
			$html = $this->load->view($this->template, $this->data);
		}

        $this->data['widgets']['langmark']['code'] = 'langmark';
        $this->data['widgets']['langmark']['name'] = $this->language->get('text_widget_langmark_settings');
        $this->data['widgets']['langmark']['html'] = $html;

	    return $this->data;
	}


	public function install($data)
	{
		if (!$this->validate()) {
			return $data;
		}

		$this->data = $data;
		$this->config->set("blog_work", true);

       	$this->language->load('agoo/langmark/langmark');
        $query = false;

       if ($query) {
        	$this->data['html'] = $this->language->get('entry_langmark_widget_install_success') ;
        } else {
        	$this->data['html'] = $this->language->get('entry_langmark_widget_install') ;
       }

	    return $this->data;
	}


	public function adapter_button($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);

       	$this->language->load('agoo/langmark/langmark');

		foreach ($this->data['adapter'] as $id => $adapter) {

			$action               = array(
				'text' => $this->language->get('text_adapter_edit'),
				'href' => $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $adapter['adapter_name'].'&widget=langmark' , 'SSL')
			);
			$this->data['adapter'][$id]['action'][] = $action;
		}

	    return $this->data;
	}

	public function adapter_form($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);
       	$this->language->load('agoo/langmark/langmark');

        if (isset($this->request->get['widget']) && $this->request->get['widget']=='langmark') {
        	$this->data = $this->run($this->data);
        }

	    return $this->data;
	}

	public function adapter_update($data)
	{
		$this->data = $data;
		$this->config->set("blog_work", true);
       	$this->language->load('agoo/langmark/langmark');

		if (isset($this->request->get['widget']) && $this->request->get['widget']=='langmark' && $this->validate()) {
			if ($this->editTheme($this->request->get['adapter_theme'], $this->request->post)) {
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->session->data['error_warning'] = $this->language->get('text_error_warning');
			}
		}

	    return $this->data;
	}

   	public function loaddata($data)
	{
		$this->data = $data;

		if (isset($this->request->get['adapter_theme']) && $this->request->get['adapter_theme']!='' && $this->validate()) {
			$this->data['theme'] = $this->request->get['adapter_theme'];
		}


        if (isset($this->request->get['ajax_action']) && $this->request->get['ajax_action']=='template_new' && $this->validate()) {
	        $this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'agootemplates/record/langmark.tpl';
        } else {
			if (SC_VERSION < 20) {
				$this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'module/language.tpl';
			} else {
				$this->data['file_theme'][$this->data['theme']] = $this->data['file_theme_out']  = 'common/language.tpl';
			}
        }
		$this->data['file_theme']                      = $this->data['file_theme'][$this->data['theme']];
		$this->data['replace_main_name']               = '';

		if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme'])) {
			$success_file = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme'];
			$success      = $this->data['success_data'] = file_get_contents($success_file);
		} else {
			if (file_exists(DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme_out'])) {
				$success_file = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $this->data['file_theme_out'];
				$success      = $this->data['success_data'] = file_get_contents($success_file);
			} else {
				if (file_exists(DIR_CATALOG . 'view/theme/default/template/' . $this->data['file_theme_out'])) {
					$this->data['theme']  = 'default';
					$success_file = DIR_CATALOG . 'view/theme/default/template/' . $this->data['file_theme_out'];
					$success      = $this->data['success_data'] = file_get_contents($success_file);
				}
			}
		}

		if ($this->data['success_data'] != '') {

			$this->load->library('parser/simple_html_dom');
			$html                                = str_get_html($success, true, true, DEFAULT_TARGET_CHARSET, false);
			$html                                = str_get_html($html->outertext, true, true, DEFAULT_TARGET_CHARSET, false);

			$this->data['success_id'][$this->data['theme']]    = array();
			$this->data['success_class'][$this->data['theme']] = array();
			$this->data['success_tag'][$this->data['theme']]   = array(
				'script'
			);

			$this->data['success_id']            = $this->data['success_id'][$this->data['theme']];
			$this->data['success_class']         = $this->data['success_class'][$this->data['theme']];
			$this->data['success_tag']           = $this->data['success_tag'][$this->data['theme']];

			foreach ($html->find(0) as $element) {
				if ($element->id != '') {
					$this->data['success_id'][] = $element->id;
				}

				if ($element->class != '') {
					/* $element->class = preg_replace('/<\?(.*)\?>/', ' ', $element->class); */
					$element->class = preg_replace('/\s{2,}/', ' ', trim($element->class));
					$pos            = strpos($element->class, ' ');
					if ($pos === false) {
						$class_array = Array(
							$element->class
						);
					} else {
						$class_array = explode(" ", $element->class);
					}
					foreach ($class_array as $classic) {
						if ($classic != '')
							$this->data['success_class'][$classic][] = $classic;
					}
				}
				if ($element->tag != '' && $element->tag != 'root')
					$this->data['success_tag'][$element->tag] = $element->tag;
			}


			$this->data['remove_tag'][$this->data['theme']]         = Array(
				'script',
				'input'
			);
			$this->data['remove_class'][$this->data['theme']]       = Array();
			$this->data['remove_id'][$this->data['theme']]          = Array();


			$new                                      = $html->outertext;
			$new                                      = preg_replace('/ {2,}/', ' ', $new);
			$new                                      = preg_replace('~(?:\r?\n){2,}~', "\n\r", $new);
			//$new                                      = preg_replace('/<form (.*)>/', '', $new);

			$healthy                                  = array(
				"<div",
				"/div>",
				"<?php echo \$content; ?>",
				"\t"

			);
			$yummy                                    = array(
				"\r\n<div",
				"/div>\r\n",
				"\r\n{CONTENT}\r\n",
				""
			);
			$this->data['success_data'] = str_replace($healthy, $yummy, $new);

			if (isset($this->request->post['replace_code'])) {
				$this->data['replace_code'] = $this->request->post['replace_code'];
			} else {

				preg_match_all('/(\<form.*?[^\?\>][\>])/isu', $new, $out, PREG_SET_ORDER);

				if (SC_VERSION < 20) {
					if (isset($out[0][0])) {
						$this->data['replace_code'][0]['in'] = $out[0][0];
						$this->data['replace_code'][0]['out'] = "";
					}

					$this->data['replace_code'][1]['in'] = "</form>";
					$this->data['replace_code'][1]['out'] = "";

                    preg_match_all('/(\<img.*?[^\?\>][\>])/isu', $new, $out, PREG_SET_ORDER);
                    if (isset($out[0][0])) {
						$this->data['replace_code'][2]['in'] = $out[0][0];
						$this->data['replace_code'][2]['out'] = "<a href=\"<?php echo \$language['url']; ?>\"><img src=\"image/flags/<?php echo \$language['image']; ?>\" alt=\"<?php echo \$language['name']; ?>\" title=\"<?php echo \$language['name']; ?>\"></a>";
					}
				} else {
					if (isset($out[0][0])) {
						$this->data['replace_code'][0]['in'] = $out[0][0];
						$this->data['replace_code'][0]['out'] = "<div id=\"langmark\">";
					}

					$this->data['replace_code'][1]['in'] = "</form>";
					$this->data['replace_code'][1]['out'] = "</div>";

					$this->data['replace_code'][2]['in'] = "<a href=\"<?php echo \$language['code']; ?>\"";
					$this->data['replace_code'][2]['out'] = "<a href=\"<?php echo \$language['url']; ?>\"";
				}

			}



		}

		if (isset($this->request->get['ajax_action']) && $this->request->get['ajax_action']!='' && $this->validate()) {
			return htmlspecialchars($this->data['success_data']);
		}

		return $this->data;
	}



   	public function run($data)
	{
        $this->language->load('module/blog');
        $time_start = microtime(true);
        $this->data = $this->loadData($data);

		$this->data['load_template'] 		= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=langmark'.'&ajax_action=template', 'SSL');
		$this->data['load_template_full'] 	= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=langmark'.'&ajax_action=template_full', 'SSL');
        $this->data['load_template_new'] 	= $this->url->link('catalog/adapter/loaddata', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=langmark'.'&ajax_action=template_new', 'SSL');


		$time_end                                 = microtime(true);
		$time                                     = $time_end - $time_start;
		$this->data['time']                       = sprintf("%05.5f sec.", $time);

        $this->data['template']          = 'agoo/langmark/adapter_form.tpl';
		if (isset($this->request->get['adapter_theme'])) {
			$this->data['action'] = $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_theme=' . $this->request->get['adapter_theme'].'&widget=langmark', 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/adapter/update', 'token=' . $this->session->data['token'] . '&adapter_id=' . $this->request->get['adapter_id'] . $url.'&widget=langmark', 'SSL');
		}

		return $this->data;
	}

	public function editTheme($adapter_theme, $post)
	{
		if (!$this->validate()) {
			return;
		}

		if (isset($post['success_file']) && $post['success_file'] != '')
			$success_data = html_entity_decode($post['success_file'], ENT_QUOTES, 'UTF-8');
		else
			$success_data = '';
		if (isset($post['replace_breadcrumb']) && $post['replace_breadcrumb'] != '')
			$replace_breadcrumb = $post['replace_breadcrumb'];
		else
			$replace_breadcrumb = false;
		if (isset($post['replace_breadcrumb_name']) && $post['replace_breadcrumb_name'] != '')
			$replace_breadcrumb_name = html_entity_decode($post['replace_breadcrumb_name'], ENT_QUOTES, 'UTF-8');
		else
			$replace_breadcrumb_name = '';
		if (isset($post['selected_tag']) && is_array($post['selected_tag']))
			$selected_tag = $post['selected_tag'];
		else
			$selected_tag = array();
		if (isset($post['selected_id']) && is_array($post['selected_id']))
			$selected_id = $post['selected_id'];
		else
			$selected_id = array();
		if (isset($post['selected_class']) && is_array($post['selected_class']))
			$selected_class = $post['selected_class'];
		else
			$selected_class = array();

		if (isset($post['replace_code']) && is_array($post['replace_code']))
			$replace_code = $post['replace_code'];
		else
			$replace_code = array();



		$this->load->library('parser/simple_html_dom');
		$html = str_get_html($success_data, true, true, DEFAULT_TARGET_CHARSET, false);
		$html = str_get_html($html->outertext, true, true, DEFAULT_TARGET_CHARSET, false);
		foreach ($selected_tag as $tag) {
			$html = str_get_html($html->innertext, true, true, DEFAULT_TARGET_CHARSET, false);
			$b    = $html->find($tag);
			if ($b) {
				foreach ($b as $a) {
					$a->outertext = '';
				}
			}
		}
		foreach ($selected_id as $id) {
			$html = str_get_html($html->innertext, true, true, DEFAULT_TARGET_CHARSET, false);
			$b    = $html->find('#' . $id);
			if ($b) {
				foreach ($b as $a) {
					$a->outertext = '';
				}
			}
		}
		foreach ($selected_class as $class) {
			$k = 0;
			foreach ($class as $num => $classic) {
				$html = str_get_html($html->innertext, true, true, DEFAULT_TARGET_CHARSET, false);
				$b    = $html->find('.' . $classic, $num - $k);
				if ($b) {
					$b->outertext = '';
					$k++;
				}
			}
		}
		if ($replace_breadcrumb && $replace_breadcrumb_name != '') {
			$html = str_get_html($html->innertext, true, true, DEFAULT_TARGET_CHARSET, false);
			$b    = $html->find($replace_breadcrumb_name, 0);
			if ($b)
				$b->outertext = html_entity_decode('{BREADCRUMB}', ENT_QUOTES, 'UTF-8');
		}
		$html_new = $html->outertext;

		if ($replace_code && is_array($replace_code)) {
            $healthy = array();
            $yummy = array();
	        foreach ($replace_code as $num => $rcode) {

	        	$healthy = html_entity_decode($rcode['in'], ENT_QUOTES, 'UTF-8');
	          	$yummy = html_entity_decode($rcode['out'], ENT_QUOTES, 'UTF-8');


                $html_new = html_entity_decode($html_new, ENT_QUOTES, 'UTF-8');
	          	$html_new = str_replace($healthy, $yummy, $html_new);

	   		}
		}


		$this->data['html']  = $html_new;
		$this->data['theme'] = $adapter_theme;
		return $this->saveTheme($this->data);
	}

	private function saveTheme($data)
	{
		if (!$this->validate()) {
			return $data;
		}

		$this->data = $data;
		$this->load->library('parser/simple_html_dom');
		$save_flag = false;
		foreach ($this->module_files_langmark as $module_file) {
			$module_file_content = DIR_CATALOG . 'view/theme/default/template/' . $module_file;
			//if (file_exists($module_file_content))
			{
				//$content                = file_get_contents($module_file_content);
				$content = ' ';
				$html                   = str_get_html($content, true, true, DEFAULT_TARGET_CHARSET, false);
				$html                   = str_get_html($html->outertext, true, true, DEFAULT_TARGET_CHARSET, false);
				$breadcrumb             = $html->find('.breadcrumb', 0);
				$seocmspro_content      = $html->find('.seocmspro_content', 0);
				$this->data['html_new'] = $this->data['html'];

				if ($breadcrumb && $breadcrumb != '') {
					$healthy                = array(
						'{BREADCRUMB}'
					);
					$yummy                  = array(
						$breadcrumb
					);
					$this->data['html_new'] = str_replace($healthy, $yummy, $this->data['html_new']);
					$save_flag              = true;
				}
				if ($seocmspro_content && $seocmspro_content != '') {
					$healthy                = array(
						'{CONTENT}'
					);
					$yummy                  = array(
						$seocmspro_content
					);
					$this->data['html_new'] = str_replace($healthy, $yummy, $this->data['html_new']);
					$save_flag              = true;
				}

				$save_flag              = true;
				if ($save_flag) {
					$path = DIR_CATALOG . 'view/theme/' . $this->data['theme'] . '/template/' . $module_file;
					if (mkdirs($path)) {
						file_put_contents($path, $this->data['html_new']);
					} else {
						$save_flag = false;
					}
				}
				unset($html);
			}
		}
		return $save_flag;
	}


	private function table_exists($tableName)
	{
		$found= false;
		$like   = addcslashes($tableName, '%_\\');
		$result = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape($like) . "';");
		$found  = $result->num_rows > 0;
		return $found;
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}


}

