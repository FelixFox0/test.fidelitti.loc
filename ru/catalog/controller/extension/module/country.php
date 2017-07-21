<?php
class ControllerExtensionModuleCountry extends Controller {
    protected $_templateData = array();

    public function index() {
        $this->simplecheckout = SimpleCheckout::getInstance($this->registry);

        $this->language->load('extension/module/country');

        $this->_templateData['error_country'] = '';

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->session->data['shipping_address']['country_id'] = $this->request->post['c_country_id'];
            $this->session->data['payment_address']['country_id']  = $this->request->post['c_country_id'];
        }

        $this->_templateData['heading_title'] = $this->language->get('heading_title');
        $this->_templateData['text_select']   = $this->language->get('text_select');
        $this->_templateData['entry_country'] = $this->language->get('entry_country');

        $geo = array();
        if ($this->request->server['REQUEST_METHOD'] == 'GET') {
            $this->load->model('tool/simplegeo');
            $geo = $this->model_tool_simplegeo->getGeoDataByIp($this->getGeoIpMode());
        }

        if (isset($this->request->post['c_country_id'])) {
            $this->_templateData['c_country_id'] = $this->request->post['c_country_id'];
        } elseif (isset($this->session->data['shipping_address']['country_id'])) {
            $this->_templateData['c_country_id'] = $this->session->data['shipping_address']['country_id'];
        } elseif (!empty($geo['country_id'])) {
            $this->_templateData['c_country_id'] = $geo['country_id'];
        } else {
            $this->_templateData['c_country_id'] = $this->getDefaultValue('country_id');
        }

        $this->_templateData['display_error']  = $this->simplecheckout->displayError('country');
        $this->_templateData['has_error']      = $this->simplecheckout->hasError('country');

        $this->load->model('localisation/country');

        $this->_templateData['countries'] = $this->model_localisation_country->getCountries();

        return $this->load->view('extension/module/country', $this->_templateData);
    }

    private function validate() {
        $error = false;

        if (isset($this->request->post['c_country_id']) && $this->request->post['c_country_id'] == '') {
            $this->_templateData['error_country'] = $this->language->get('error_country');
            $error = true;
        }

        if ($error) {
            $this->simplecheckout->addError('country');
        }

        return !$error;
    }

    public function zone() {
        $output = '<option value="">' . $this->language->get('text_select') . '</option>';

        $this->load->model('localisation/zone');

        $results = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);

        foreach ($results as $result) {
            $output .= '<option value="' . $result['zone_id'] . '">' . $result['name'] . '</option>';
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