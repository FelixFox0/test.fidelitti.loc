<?php
/**
 *
 * @ Release on : 30.09.2015
 * @ Доставка Плюс для Опенкарт 2.x
 *
 **/

class ControllerShippingDostavkaPlus extends Controller
{
    protected $error = array();
    protected $type = 'shipping';
    protected $name = 'dostavkaplus';
    protected $arr_bibb = array(0 => 'zone', 1 => 'quantity', 2 => 'total', 3 => 'weight');

    function index()
    {
        /* Проверка лицензии
        if (!$this->check_license( $this->config->get( $this->name . '_license' ) )) {
        $this->response->redirect( $this->url->link( $this->type . '/' . $this->name . '/license', 'token=' . $this->session->data['token'], 'SSL' ) );
        }
        */
        $data                        = $this->load->language($this->type . '/' . $this->name);
        $data['show_product_groups'] = false;
        $data['name']                = $this->name;
        $query                       = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'extension WHERE `type` = \'total\'');
        $order_totals                = $query->rows;
        $sort_order                  = array();
        foreach ($order_totals as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $order_totals);
        $arr_totals = array();
        foreach ($order_totals as $ot) {

            if ($ot['code'] != $this->type) {
                if ($this->config->get($ot['code'] . '_status')) {
                    $this->load->language('total/' . $ot['code']);
                    $arr_totals[$ot['code']] = $this->language->get('heading_title');
                    continue;
                }

                continue;
            }
        }

        $data['totals'] = $arr_totals;
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate())) {
            $this->model_setting_setting->editSetting($this->name, $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/' . $this->type, 'token=' . $this->session->data['token'], 'SSL'));
        }


        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }


        if (isset($this->error['store'])) {
            $data['error_store'] = $this->error['store'];
        } else {
            $data['error_store'] = array();
        }

        $data['modules'] = array();

        if (isset($this->request->post[$this->name . '_module'])) {
            $data['modules'] = $this->request->post[$this->name . '_module'];
        } else {
            if ($this->config->get($this->name . '_module')) {
                $data['modules'] = $this->config->get($this->name . '_module');
            }
        }

        $this->load->model('tool/image');
        foreach ($data['modules'] as $key => $module) {

            if ((isset($module['image']) && ($module['image'] && is_file(DIR_IMAGE . $module['image'])))) {
                $thumb = $this->model_tool_image->resize($module['image'], 100, 100);
            } else {
                $thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
            }

            $data['modules'][$key]['thumb'] = $thumb;
        }

        $data['placeholder']   = $this->model_tool_image->resize('no_image.png', 100, 100);
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/' . $this->type, 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link($this->type . '/' . $this->name, 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['action']        = $this->url->link($this->type . '/' . $this->name, 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel']        = $this->url->link('extension/' . $this->type, 'token=' . $this->session->data['token'], 'SSL');
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        foreach ($data['order_statuses'] as $key => $order_status) {
            $data['order_statuses'][$key]['name'] = preg_replace('|[^abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъыьэюяё0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯЁ ]|', '', $order_status['name']);
        }

        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
        foreach ($data['geo_zones'] as $key => $geo_zone) {
            $data['geo_zones'][$key]['name'] = preg_replace('|[^abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъыьэюяё0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯЁ ]|', '', $geo_zone['name']);
        }

        $this->load->model('setting/store');
        $stores               = $this->model_setting_store->getStores();
        $data['text_default'] = str_replace('<b>', '', $data['text_default']);
        $data['text_default'] = str_replace('</b>', '', $data['text_default']);
        $array_default_store  = array(
            'store_id' => 0,
            'name' => $data['text_default']
        );
        $data['stores'][]     = $array_default_store;
        foreach ($stores as $val) {
            $data['stores'][] = $val;
        }

        foreach ($data['stores'] as $key => $store) {
            $data['stores'][$key]['name'] = preg_replace('|[^abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъыьэюяё0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯЁ ]|', '', $store['name']);
        }

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post[$this->name . '_name'])) {
            $data[$this->name . '_name'] = $this->request->post[$this->name . '_name'];
        } else {
            $data[$this->name . '_name'] = $this->config->get($this->name . '_name');
        }


        if (isset($this->request->post[$this->name . '_status'])) {
            $data[$this->name . '_status'] = $this->request->post[$this->name . '_status'];
        } else {
            $data[$this->name . '_status'] = $this->config->get($this->name . '_status');
        }

        $this->load->model('localisation/tax_class');
        $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

        if (isset($this->request->post[$this->name . '_tax_class_id'])) {
            $data[$this->name . '_tax_class_id'] = $this->request->post[$this->name . '_tax_class_id'];
        } else {
            $data[$this->name . '_tax_class_id'] = $this->config->get($this->name . '_tax_class_id');
        }


        if (isset($this->request->post[$this->name . '_sort_order'])) {
            $data[$this->name . '_sort_order'] = $this->request->post[$this->name . '_sort_order'];
        } else {
            $data[$this->name . '_sort_order'] = $this->config->get($this->name . '_sort_order');
        }


        if (isset($this->request->post[$this->name . '_show_error_text'])) {
            $data[$this->name . '_show_error_text'] = $this->request->post[$this->name . '_show_error_text'];
        } else {
            $data[$this->name . '_show_error_text'] = $this->config->get($this->name . '_show_error_text');
        }

        $this->load->model('localisation/weight_class');
        $data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
        foreach ($this->arr_bibb as $code) {
            $data['text_' . $code] = $this->language->get('text_' . $code);
        }

        $data['arr_bibb']           = $this->arr_bibb;
        $data['config_language_id'] = $this->config->get('config_language_id');
		
        $this->load->model('customer/customer_group');
        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		
		
        array_unshift($data['customer_groups'], array(
            'customer_group_id' => 0,
            'name' => $data['text_not_logged_in']
        ));

        if ($this->config->get($this->name . '_license')) {
            $data[$this->name . '_license'] = $this->config->get($this->name . '_license');
        } else {
            $data[$this->name . '_license'] = '';
        }


        if ((file_exists(DIR_APPLICATION . '/controller/catalog/product_groups.php') && file_exists(DIR_APPLICATION . '/model/catalog/product_groups.php'))) {
            $query = $this->db->query('SELECT extension_id FROM ' . DB_PREFIX . 'extension WHERE `code` = \'product_groups\' ');

            if (0 < count($query->rows)) {
                $data['show_product_groups'] = true;
                $this->load->model('catalog/product_groups');
                $results = $this->model_catalog_product_groups->getGroups();
                foreach ($results as $key => $result) {
                    $data['groups'][$key] = array(
                        'group_id' => $result['group_id'],
                        'name' => $result['caption'],
                        'status' => $result['status']
                    );
                }
            }
        }

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view($this->type . '/' . $this->name . '.tpl', $data));
    }

    function validate()
    {
        if (!$this->user->hasPermission('modify', $this->type . '/' . $this->name)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }


        if (isset($this->request->post[$this->name . '_module'])) {
            foreach ($this->request->post[$this->name . '_module'] as $key => $val) {
                foreach ($val['title'] as $language_id => $value) {

                    if (!$value) {
                        $this->error['title'][$key][$language_id] = $this->language->get('error_title');
                        continue;
                    }
                }


                if ((!isset($val['store']) || (isset($val['store']) && count($val['store']) == 0))) {
                    $this->error['store'][$key] = $this->language->get('error_store');
                    continue;
                }
            }
        }


        if (($this->error && !isset($this->error['warning']))) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    function license()
    {
        $data         = $this->load->language($this->type . '/' . $this->name . '_license');
        $data['name'] = $this->name;
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        $this->document->setTitle($this->language->get('heading_title'));
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit']     = $this->language->get('text_edit');
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateKey())) {
            $this->model_setting_setting->editSetting($this->name, $this->request->post);
            $this->response->redirect($this->url->link($this->type . '/' . $this->name, 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_' . $this->type),
            'href' => $this->url->link('extension/' . $this->type, 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link($this->type . '/' . $this->name . '/license', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['action']        = $this->url->link($this->type . '/' . $this->name . '/license', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel']        = $this->url->link('extension/' . $this->type, 'token=' . $this->session->data['token'], 'SSL');
        $data['button_save']   = $this->language->get('button_save');
        $data['entry_key']     = $this->language->get('entry_key');

        if ($this->config->get($this->name . '_license')) {
            $data[$this->name . '_license'] = $this->config->get($this->name . '_license');
        } else {
            $data[$this->name . '_license'] = '';
        }

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view($this->type . '/' . $this->name . '_license.tpl', $data));
    }

    function keygen($text)
    {
        $key = substr(strtoupper(md5(base64_encode(sha1(md5($text))))), 3, 16);
        return $key;
    }

    function check_license($text)
    {
        $domen = str_replace('http://', '', HTTP_SERVER);
        $domen = str_replace('https://', '', $domen);
        $domen = str_replace('www.', '', $domen);
        $domen = strtolower($domen);
        $pos   = strpos($domen, '/');

        if ($pos) {
            $domen = substr($domen, 0, $pos);
        }

        $pos = strpos($domen, ':');

        if ($pos) {
            $domen = substr($domen, 0, $pos);
        }

        $domen     = str_replace(':', '', $domen);
        $domen     = str_replace('/', '', $domen);
        $arr_domen = explode('.', $domen);
        $total     = count($arr_domen);

        if ($total <= 2) {
            $new_domen = implode('.', $arr_domen);
        } else {
            $last      = $arr_domen[$total - 2] . '.' . $arr_domen[$total - 1];
            $arr_allow = array(
                'net.ru',
                'com.ru',
                'net.ua',
                'com.ua',
                'co.uk',
                'crimea.pro',
                'bukhara.su',
                'navoi.su',
                'termez.su',
                'tashkent.su',
                'ashgabad.su',
                'karacol.su',
                'georgia.su',
                'azerbaijan.su',
                'armenia.su',
                'abkhazia.su',
                'aktyubinsk.su',
                'chimkent.su',
                'east-kazakhstan.su',
                'jambyl.su',
                'karaganda.su',
                'kustanai.ru',
                'kustanai.su',
                'mangyshlak.su',
                'north-kazakhstan.su',
                'tselinograd.su',
                'adygeya.ru',
                'adygeya.su',
                'arkhangelsk.su',
                'balashov.su',
                'bashkiria.ru',
                'bashkiria.su',
                'bir.ru',
                'bryansk.su',
                'cbg.ru',
                'dagestan.ru',
                'dagestan.su',
                'grozny.ru',
                'grozny.su',
                'ivanovo.su',
                'kalmykia.ru',
                'kalmykia.su',
                'kaluga.su',
                'karelia.su',
                'khakassia.su',
                'krasnodar.su',
                'kurgan.su',
                'lenug.su',
                'marine.ru',
                'mordovia.ru',
                'mordovia.su',
                'msk.ru',
                'msk.su',
                'murmansk.su',
                'mytis.ru',
                'nalchik.ru',
                'nalchik.su',
                'nov.ru',
                'nov.su',
                'obninsk.su',
                'penza.su',
                'pokrovsk.su',
                'pyatigorsk.ru',
                'sochi.su',
                'spb.ru',
                'spb.su',
                'togliatti.su',
                'troitsk.su',
                'tula.su',
                'tuva.su',
                'vladikavkaz.ru',
                'vladikavkaz.su',
                'vladimir.ru',
                'vladimir.su',
                'vologda.su',
                'bget.ru'
            );

            if (in_array($last, $arr_allow)) {
                $new_domen = $arr_domen[$total - 3] . '.' . $arr_domen[$total - 2] . '.' . $arr_domen[$total - 1];
            } else {
                $new_domen = $arr_domen[$total - 2] . '.' . $arr_domen[$total - 1];
            }
        }


        if ($text == $this->keygen($new_domen . '_' . $this->name . '_louise')) {
            return true;
        }

        return false;
    }

    function validateKey()
    {
        if ((isset($this->request->post[$this->name . '_license']) && $this->check_license($this->request->post[$this->name . '_license']))) {
            return true;
        }

        return false;
    }
}

?>