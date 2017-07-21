<?php

class ControllerPaymentDpdCod extends Controller
{
    protected $_data = '';

    public function index()
    {
        $this->_data['button_confirm'] = $this->language->get('button_confirm');

        $this->_data['continue'] = $this->url->link('checkout/success');

        $this->_data['text_loading'] = $this->language->get('text_loading');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/payment/dpd_cod.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/payment/dpd_cod.tpl', $this->_data);
        } else {
            return $this->load->view('payment/dpd_cod.tpl', $this->_data);
        }

    }

    public function confirm()
    {
        if ($this->session->data['payment_method']['code'] == 'dpd_cod') {
            $this->load->model('checkout/order');

            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('cod_order_status_id'));
        }

    }
}
