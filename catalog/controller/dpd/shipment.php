<?php

/**
 * Zitec_Dpd – shipping carrier extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @authod     george.babarus
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ControllerDpdShipment extends Controller
{
    protected $_data = array();
    /**
     * check before multiple action if dpd service are available for current context
     *
     */
    public function preDispatch()
    {
        $this->load->url = $this->url;
        $this->load->config = $this->config;

        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'zitec_dpd' AND `type` = 'shipping' ");

        if ($result->num_rows) {
            //extension installed it's ok
        } else {
            $this->session->data['error'] = $this->language->get('DPD - shipping module is not installed. Please install it by pressing the install button in shipping extensions list.');
            $this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }


    /**
     *  here will be created the ajax call for
     *  postcode advice in order edit interface
     */
    public function find_postcode()
    {

        $this->load->model('module/dpd/postcode');

        $address = array(
            'city'       => $this->request->get['city'],
            'country_id' => $this->request->get['country_id'],
            'region_id'  => $this->request->get['zone_id'],
            'address'    => $this->request->get['address_1'] . ' ' . $this->request->get['address_2'],
        );

        $postcode = $this->model_module_dpd_postcode->search($address);
        if($postcode !== null && $postcode !== false) {
            $results = array(
                array(
                    'postcode' => $postcode,
                    'label' => $postcode
                )
            );
        } else {
            $results = $this->model_module_dpd_postcode->findAllSimilarAddressesForAddress($address);
        }

        $data = array();
        if (is_array($results) && !empty($results)) {
            foreach ($results as $address) {
                $label = array_key_exists('label', $address) ? $address['label'] : ($address['postcode'] . ' - ' . ($address['address'] ? $address['address'] . ', ' : '') . $address['city'] . ', ' . $address['region']);
                $data[] = array(
                    'label' => $label,
                    'postcode' => $address['postcode']
                );
            }
        }

        echo json_encode($data);
        exit;
    }

}