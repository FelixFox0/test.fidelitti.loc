<?php

class ControllerExtensionModuleDeadcowSEO extends Controller
{
    private $error = array();

    public function install()
    {
        // enable the module and set default settings
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('deadcow_seo', array(
            'deadcow_seo_transliteration' => 1,
            'deadcow_seo_categories_template' => '[category_name]',
            'deadcow_seo_categories_suffix' => '',
            'deadcow_seo_products_template' => '[product_name]',
            'deadcow_seo_products_suffix' => '.html',
            'deadcow_seo_manufacturers_template' => '[manufacturer_name]',
            'deadcow_seo_manufacturers_suffix' => '.html',
            'deadcow_seo_meta_template' => '[product_name], [model_name], [manufacturer_name], [categories_names]',
            'deadcow_seo_tags_template' => '[product_name], [model_name], [manufacturer_name], [categories_names]',
            'deadcow_seo_source_language_code' => ''
        ));
    }

    public function index()
    {
        $this->load->language('extension/module/deadcow_seo');
        $this->document->setTitle = $this->language->get('heading_title');
        $this->load->model('setting/setting');
        $this->load->model('module/deadcow_seo');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            if (isset($this->request->post['categories'])) {
                $this->model_module_deadcow_seo->generateCategories($this->request->post['categories_template'], $this->request->post['categories_suffix'], $this->request->post['source_language_code'], $this->request->post['overwrite_categories'] == 'overwrite', $this->request->post['do_transliteration']);
            }
            if (isset($this->request->post['products'])) {
                $this->model_module_deadcow_seo->generateProducts($this->request->post['products_template'], $this->request->post['products_suffix'], $this->request->post['source_language_code'], $this->request->post['overwrite_products'] == 'overwrite', $this->request->post['do_transliteration']);
            }
            if (isset($this->request->post['manufacturers'])) {
                $this->model_module_deadcow_seo->generateManufacturers($this->request->post['manufacturers_template'], $this->request->post['manufacturers_suffix'], $this->request->post['source_language_code'], $this->request->post['overwrite_manufacturers'] == 'overwrite', $this->request->post['do_transliteration']);
            }
            if (isset($this->request->post['meta_keywords'])) {
                $this->model_module_deadcow_seo->generateProductsMetaKeywords($this->request->post['meta_template'], $this->request->post['source_language_code'], $this->request->post['do_transliteration']);
            }
            if (isset($this->request->post['categories_meta_keywords'])) {
                $this->model_module_deadcow_seo->generateCategoriesMetaKeywords($this->request->post['categories_meta_template'], $this->request->post['source_language_code']);
            }
            if (isset($this->request->post['tags'])) {
                $this->model_module_deadcow_seo->generateTags($this->request->post['tags_template'], $this->request->post['source_language_code'], $this->request->post['do_transliteration']);
            }
            $this->model_setting_setting->editSetting('deadcow_seo', array(
                'deadcow_seo_transliteration' => $this->request->post['do_transliteration'],
                'deadcow_seo_categories_template' => $this->request->post['categories_template'],
                'deadcow_seo_categories_suffix' => $this->request->post['categories_suffix'],
                'deadcow_seo_products_template' => $this->request->post['products_template'],
                'deadcow_seo_products_suffix' => $this->request->post['products_suffix'],
                'deadcow_seo_manufacturers_template' => $this->request->post['manufacturers_template'],
                'deadcow_seo_manufacturers_suffix' => $this->request->post['manufacturers_suffix'],
                'deadcow_seo_meta_template' => $this->request->post['meta_template'],
                'deadcow_seo_tags_template' => $this->request->post['tags_template'],
                'deadcow_seo_source_language_code' => $this->request->post['source_language_code']
            ));
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['success'] = $this->language->get('text_success');
            }
        }

        $data['transliteration'] = $this->language->get('transliteration');
        $data['transliteration_detail'] = $this->language->get('transliteration_detail');
        $data['warning_clear'] = $this->language->get('warning_clear');
        $data['warning_clear_tags'] = $this->language->get('warning_clear_tags');
        $data['warning_clear_meta'] = $this->language->get('warning_clear_meta');
        $data['back'] = $this->language->get('back');
        $data['categories'] = $this->language->get('categories');
        $data['products'] = $this->language->get('products');
        $data['manufacturers'] = $this->language->get('manufacturers');
        $data['products_meta_keywords'] = $this->language->get('products_meta_keywords');
        $data['categories_meta_keywords'] = $this->language->get('categories_meta_keywords');
        $data['categories_meta_keywords_template_parents'] = $this->language->get('categories_meta_keywords_template_parents');
        $data['categories_meta_keywords_template_no_parents'] = $this->language->get('categories_meta_keywords_template_no_parents');
        $data['tags'] = $this->language->get('tags');
        $data['generate'] = $this->language->get('generate');
        $data['append_model'] = $this->language->get('append_model');
        $data['template'] = $this->language->get('template');
        $data['available_category_tags'] = $this->language->get('available_category_tags');
        $data['available_product_tags'] = $this->language->get('available_product_tags');
        $data['available_manufacturer_tags'] = $this->language->get('available_manufacturer_tags');
        $data['available_meta_tags'] = $this->language->get('available_meta_tags');
        $data['available_tags_tags'] = $this->language->get('available_tags_tags');
        $data['source_language'] = $this->language->get('source_language');
        $data['overwrite'] = $this->language->get('overwrite');
        $data['overwrite_all'] = $this->language->get('overwrite');
        $data['dont_overwrite'] = $this->language->get('dont_overwrite');
        $data['main_settings'] = $this->language->get('main_settings');
        $data['extension'] = $this->language->get('extension');
        $data['extension_warning'] = $this->language->get('extension_warning');

        if (isset($this->request->post['do_transliteration'])) {
            $data['do_transliteration'] = $this->request->post['do_transliteration'];
        } else {
            $data['do_transliteration'] = $this->config->get('deadcow_seo_transliteration');
        }
        if (isset($this->request->post['categories_template'])) {
            $data['categories_template'] = $this->request->post['categories_template'];
        } else {
            $data['categories_template'] = $this->config->get('deadcow_seo_categories_template');
        }
        if (isset($this->request->post['categories_suffix'])) {
            $data['categories_suffix'] = $this->request->post['categories_suffix'];
        } else {
            $data['categories_suffix'] = $this->config->get('deadcow_seo_categories_suffix');
        }
        if (isset($this->request->post['products_template'])) {
            $data['products_template'] = $this->request->post['products_template'];
        } else {
            $data['products_template'] = $this->config->get('deadcow_seo_products_template');
        }
        if (isset($this->request->post['products_suffix'])) {
            $data['products_suffix'] = $this->request->post['products_suffix'];
        } else {
            $data['products_suffix'] = $this->config->get('deadcow_seo_products_suffix');
        }
        if (isset($this->request->post['manufacturers_template'])) {
            $data['manufacturers_template'] = $this->request->post['manufacturers_template'];
        } else {
            $data['manufacturers_template'] = $this->config->get('deadcow_seo_manufacturers_template');
        }
        if (isset($this->request->post['manufacturers_suffix'])) {
            $data['manufacturers_suffix'] = $this->request->post['manufacturers_suffix'];
        } else {
            $data['manufacturers_suffix'] = $this->config->get('deadcow_seo_manufacturers_suffix');
        }
        if (isset($this->request->post['meta_template'])) {
            $data['meta_template'] = $this->request->post['meta_template'];
        } else {
            $data['meta_template'] = $this->config->get('deadcow_seo_meta_template');
        }
        if (isset($this->request->post['tags_template'])) {
            $data['tags_template'] = $this->request->post['tags_template'];
        } else {
            $data['tags_template'] = $this->config->get('deadcow_seo_tags_template');
        }
        if (isset($this->request->post['source_language_code'])) {
            $data['source_language_code'] = $this->request->post['source_language_code'];
        } else {
            $data['source_language_code'] = $this->config->get('deadcow_seo_source_language_code');
        }
        $data['languages'] = $this->model_module_deadcow_seo->getLanguages();
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('href' => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'], 'text' => $this->language->get('text_home'), 'separator' => FALSE);
        $data['breadcrumbs'][] = array('href' => HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'], 'text' => $this->language->get('text_module'), 'separator' => ' :: ');
        $data['breadcrumbs'][] = array('href' => HTTPS_SERVER . 'index.php?route=module/deadcow_seo&token=' . $this->session->data['token'], 'text' => $this->language->get('heading_title'), 'separator' => ' :: ');
        $data['action'] = HTTPS_SERVER . 'index.php?route=extension/module/deadcow_seo&token=' . $this->session->data['token'];
        $data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/extension&token=' . $this->session->data['token'];

        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['heading_title'] = $this->language->get('heading_title');

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/deadcow_seo', $data));
    }

    private function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/module/deadcow_seo')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
} 