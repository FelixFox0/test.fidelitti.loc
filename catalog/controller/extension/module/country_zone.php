<?php
class ControllerExtensionModuleCountryZone extends Controller {
    protected $_templateData = array();

    public function index() {
        

        $this->simplecheckout = SimpleCheckout::getInstance($this->registry);

        $this->language->load('extension/module/country_zone');

        $this->_templateData['error_country'] = '';
        $this->_templateData['error_zone']    = '';
        $this->_templateData['error_city']    = '';

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->session->data['simple']['shipping_address']['country_id'] = $this->request->post['cz_country_id'];
            $this->session->data['simple']['shipping_address']['zone_id']    = $this->request->post['cz_zone_id'];
            $this->session->data['simple']['shipping_address']['city']       = $this->request->post['cz_city'];
            $this->session->data['simple']['payment_address']['country_id']  = $this->request->post['cz_country_id'];
            $this->session->data['simple']['payment_address']['zone_id']     = $this->request->post['cz_zone_id'];
            $this->session->data['simple']['payment_address']['city']        = $this->request->post['cz_city'];
        }

        $this->_templateData['heading_title'] = $this->language->get('heading_title');
        $this->_templateData['text_select']   = $this->language->get('text_select');
        $this->_templateData['entry_country'] = $this->language->get('entry_country');
        $this->_templateData['entry_zone']    = $this->language->get('entry_zone');
        $this->_templateData['entry_city']    = $this->language->get('entry_city');

        $geo = array();
        if ($this->request->server['REQUEST_METHOD'] == 'GET') {
            $this->load->model('tool/simplegeo');
            $geo = $this->model_tool_simplegeo->getGeoDataByIp($this->getGeoIpMode());
        }

        if (isset($this->request->post['cz_country_id'])) {
            $this->_templateData['cz_country_id'] = $this->request->post['cz_country_id'];
        } elseif (isset($this->session->data['simple']) && isset($this->session->data['simple']['shipping_address']['country_id'])) {
            $this->_templateData['cz_country_id'] = $this->session->data['simple']['shipping_address']['country_id'];
        } elseif (!empty($geo['country_id'])) {
            $this->_templateData['cz_country_id'] = $geo['country_id'];
        } else {
            $this->_templateData['cz_country_id'] = $this->getDefaultValue('country_id');
        }

        if (isset($this->request->post['cz_zone_id'])) {
            $this->_templateData['cz_zone_id'] = $this->request->post['cz_zone_id'];
        } elseif (isset($this->session->data['simple']) && isset($this->session->data['simple']['shipping_address']['zone_id'])) {
            $this->_templateData['cz_zone_id'] = $this->session->data['simple']['shipping_address']['zone_id'];
        } elseif (!empty($geo['zone_id'])) {
            $this->_templateData['cz_zone_id'] = $geo['zone_id'];
        } else {
            $this->_templateData['cz_zone_id'] = $this->getDefaultValue('zone_id');
        }

        if (isset($this->request->post['cz_city'])) {
            $this->_templateData['cz_city'] = $this->request->post['cz_city'];
        } elseif (isset($this->session->data['simple']) && isset($this->session->data['simple']['shipping_address']['city'])) {
            $this->_templateData['cz_city'] = $this->session->data['simple']['shipping_address']['city'];
        } elseif (!empty($geo['city'])) {
            $this->_templateData['cz_city'] = $geo['city'];
        } else {
            $this->_templateData['cz_city'] = $this->getDefaultValue('city');
        }

        $this->_templateData['display_error']  = $this->simplecheckout->displayError('country_zone');
        $this->_templateData['has_error']      = $this->simplecheckout->hasError('country_zone');

        $this->load->model('localisation/country');

        $this->_templateData['countries'] = $this->model_localisation_country->getCountries();

        $this->load->model('localisation/zone');

        $this->_templateData['zones'] = $this->model_localisation_zone->getZonesByCountryId($this->_templateData['cz_country_id']);

        return $this->load->view('extension/module/country_zone', $this->_templateData);
        
    }

    private function validate() {
        $error = false;

        if (isset($this->request->post['cz_country_id']) && $this->request->post['cz_country_id'] == '') {
            $this->_templateData['error_country'] = $this->language->get('error_country');
            $error = true;
        }

        if (isset($this->request->post['cz_zone_id']) && $this->request->post['cz_zone_id'] == '') {
            $this->_templateData['error_zone'] = $this->language->get('error_zone');
            $error = true;
        }


        if ($error) {
            $this->simplecheckout->addError('country_zone');
        }

        return !$error;
    }

    public function zone() {
        $output = '<option value="">' . $this->language->get('text_select') . '</option>';

        $this->load->model('localisation/zone');

        $results = $this->model_localisation_zone->getZonesByCountryId($this->request->get['cz_country_id']);

        foreach ($results as $result) {
            $output .= '<option value="' . $result['zone_id'] . '"';

            if (isset($this->request->get['cz_zone_id']) && ($this->request->get['cz_zone_id'] == $result['zone_id'])) {
                $output .= ' selected="selected"';
            }

            $output .= '>' . $result['name'] . '</option>';
        }

        if (!$results) {
            $output .= '<option value="0">' . $this->language->get('text_none') . '</option>';
        }

        $this->response->setOutput($output);
    }

    private function getGeoIpMode() {
        $settings = @json_decode($this->config->get('simple_settings'), true);

        return $settings['checkout'][0]['geoIpMode'];
    }

    private function getDefaultValue($fieldId) {
        $settings = @json_decode($this->config->get('simple_settings'), true);

        foreach ($settings['fields'] as $fieldInfo) {
            if ($fieldInfo['id'] == $fieldId && isset($fieldInfo['default']['saved'])) {
                return $fieldInfo['default']['saved'];
            }
        }

        return '';
    }
}
?>