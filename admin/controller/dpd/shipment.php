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
     *  the landing page of the dpd shipping settings section
     */

    public function index() {

        $this->preDispatch();

        $this->load->model('module/dpd/shipment');

        $this->load->model('module/dpd/helper');

        $this->document->addScript('view/javascript/zitec_dpd/loading-overlay.js');

        $this->document->addStyle('view/stylesheet/zitec_dpd/overlay.css');

        $this->load->model('sale/order');

        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }

        $order_info = $this->model_sale_order->getOrder($order_id);
        $serviceId  = $this->model_module_dpd_helper->extractDpdDeliveryServiceId($order_info['shipping_code']);
        $data['isDpdShipping'] = $serviceId;

        if ($serviceId == false) {
            $alert                        = $this->language->get('The order was not created using one of DPD shipping service');
            $secondPart                   = $this->language->get('This section is available only for DPD shipping services.');
            $this->session->data['success'] = $alert . ' ' . $secondPart;
            $this->response->redirect($this->url->link('sale/order/info&order_id='.$order_id . '&token=' . $this->session->data['token'], 'SSL'));
            return;
        }

        $shipmentData                = $this->model_module_dpd_shipment->getShipmentsByOrder($order_id);
        $data['shipment']            = $shipmentData;
        $data['print_shipments_url'] = $this->url->link('dpd/shipment/printShippingLabel' . '&token=' . $this->session->data['token'] . '&shipment_id=' . $shipmentData['shipment_id'], 'SSL');
        $data['traking_info']        = $statusResponse = $this->getShippingTrackingData($shipmentData);
        $data['traking_url']         = $statusResponse['tracking_url'];


        if ($order_info) {

            $this->load->language('sale/order');

            $this->document->setTitle($this->language->get('heading_title'));

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_order_id'] = $this->language->get('text_order_id');
            $data['text_invoice_no'] = $this->language->get('text_invoice_no');
            $data['text_invoice_date'] = $this->language->get('text_invoice_date');
            $data['text_store_name'] = $this->language->get('text_store_name');
            $data['text_store_url'] = $this->language->get('text_store_url');
            $data['text_customer'] = $this->language->get('text_customer');
            $data['text_customer_group'] = $this->language->get('text_customer_group');
            $data['text_email'] = $this->language->get('text_email');
            $data['text_telephone'] = $this->language->get('text_telephone');
            $data['text_fax'] = $this->language->get('text_fax');
            $data['text_total'] = $this->language->get('text_total');
            $data['text_reward'] = $this->language->get('text_reward');
            $data['text_order_status'] = $this->language->get('text_order_status');
            $data['text_comment'] = $this->language->get('text_comment');
            $data['text_affiliate'] = $this->language->get('text_affiliate');
            $data['text_commission'] = $this->language->get('text_commission');
            $data['text_ip'] = $this->language->get('text_ip');
            $data['text_forwarded_ip'] = $this->language->get('text_forwarded_ip');
            $data['text_user_agent'] = $this->language->get('text_user_agent');
            $data['text_accept_language'] = $this->language->get('text_accept_language');
            $data['text_date_added'] = $this->language->get('text_date_added');
            $data['text_date_modified'] = $this->language->get('text_date_modified');
            $data['text_firstname'] = $this->language->get('text_firstname');
            $data['text_lastname'] = $this->language->get('text_lastname');
            $data['text_company'] = $this->language->get('text_company');
            $data['text_address_1'] = $this->language->get('text_address_1');
            $data['text_address_2'] = $this->language->get('text_address_2');
            $data['text_city'] = $this->language->get('text_city');
            $data['text_postcode'] = $this->language->get('text_postcode');
            $data['text_zone'] = $this->language->get('text_zone');
            $data['text_zone_code'] = $this->language->get('text_zone_code');
            $data['text_country'] = $this->language->get('text_country');
            $data['text_shipping_method'] = $this->language->get('text_shipping_method');
            $data['text_payment_method'] = $this->language->get('text_payment_method');
            $data['text_history'] = $this->language->get('text_history');
            $data['text_loading'] = $this->language->get('text_loading');

            $data['column_product'] = $this->language->get('column_product');
            $data['column_model'] = $this->language->get('column_model');
            $data['column_quantity'] = $this->language->get('column_quantity');
            $data['column_price'] = $this->language->get('column_price');
            $data['column_total'] = $this->language->get('column_total');

            $data['entry_order_status'] = $this->language->get('entry_order_status');
            $data['entry_notify'] = $this->language->get('entry_notify');
            $data['entry_comment'] = $this->language->get('entry_comment');

            $data['button_invoice_print'] = $this->language->get('button_invoice_print');
            $data['button_shipping_print'] = $this->language->get('button_shipping_print');
            $data['button_edit'] = $this->language->get('button_edit');
            $data['button_cancel'] = $this->language->get('button_cancel');
            $data['button_generate'] = $this->language->get('button_generate');
            $data['button_reward_add'] = $this->language->get('button_reward_add');
            $data['button_reward_remove'] = $this->language->get('button_reward_remove');
            $data['button_commission_add'] = $this->language->get('button_commission_add');
            $data['button_commission_remove'] = $this->language->get('button_commission_remove');
            $data['button_history_add'] = $this->language->get('button_history_add');

            $data['tab_order'] = $this->language->get('tab_order');
            $data['tab_payment'] = $this->language->get('tab_payment');
            $data['tab_shipping'] = $this->language->get('tab_shipping');
            $data['tab_product'] = $this->language->get('tab_product');
            $data['tab_history'] = $this->language->get('tab_history');
            $data['tab_fraud'] = $this->language->get('tab_fraud');
            $data['tab_action'] = $this->language->get('tab_action');
            $data['tab_shipment_management'] = $this->language->get('tab_shipment_management');
            $data['language'] = $this->language;


            $data['token'] = $this->session->data['token'];

            $url = '';

            if (isset($this->request->get['filter_order_id'])) {
                $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
            }

            if (isset($this->request->get['filter_customer'])) {
                $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_order_status'])) {
                $url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
            }

            if (isset($this->request->get['filter_total'])) {
                $url .= '&filter_total=' . $this->request->get['filter_total'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['filter_date_modified'])) {
                $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
            );

            $data['shipping'] = $this->url->link('sale/order/shipping', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['edit'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
            $data['link_shipment_management'] =  $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['create_shipment_url']   = $this->url->link('dpd/shipment/create', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['validate_shipment_url'] = $this->url->link('dpd/shipment/validateShippingPrice' . '&token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            $data['index_shipment_url'] = $this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');


            $data['order_id'] = $this->request->get['order_id'];

            if ($order_info['invoice_no']) {
                $data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
            } else {
                $data['invoice_no'] = '';
            }

            $data['store_name'] = $order_info['store_name'];
            $data['store_url'] = $order_info['store_url'];
            $data['firstname'] = $order_info['firstname'];
            $data['lastname'] = $order_info['lastname'];

            if ($order_info['customer_id']) {
                $data['customer'] = $this->url->link('sale/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['customer_id'], 'SSL');
            } else {
                $data['customer'] = '';
            }

            $this->load->model('customer/customer_group');

            $customer_group_info = $this->model_customer_customer_group->getCustomerGroup($order_info['customer_group_id']);

            if ($customer_group_info) {
                $data['customer_group'] = $customer_group_info['name'];
            } else {
                $data['customer_group'] = '';
            }

            $data['email'] = $order_info['email'];
            $data['telephone'] = $order_info['telephone'];
            $data['fax'] = $order_info['fax'];

            $data['account_custom_field'] = $order_info['custom_field'];

            // Uploaded files
            $this->load->model('tool/upload');

            // Custom Fields
            $this->load->model('customer/custom_field');

            $data['account_custom_fields'] = array();

            $custom_fields = $this->model_customer_custom_field->getCustomFields();

            foreach ($custom_fields as $custom_field) {
                if ($custom_field['location'] == 'account' && isset($order_info['custom_field'][$custom_field['custom_field_id']])) {
                    if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
                        $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['custom_field'][$custom_field['custom_field_id']]);

                        if ($custom_field_value_info) {
                            $data['account_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $custom_field_value_info['name']
                            );
                        }
                    }

                    if ($custom_field['type'] == 'checkbox' && is_array($order_info['custom_field'][$custom_field['custom_field_id']])) {
                        foreach ($order_info['custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
                            $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

                            if ($custom_field_value_info) {
                                $data['account_custom_fields'][] = array(
                                    'name'  => $custom_field['name'],
                                    'value' => $custom_field_value_info['name']
                                );
                            }
                        }
                    }

                    if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
                        $data['account_custom_fields'][] = array(
                            'name'  => $custom_field['name'],
                            'value' => $order_info['custom_field'][$custom_field['custom_field_id']]
                        );
                    }

                    if ($custom_field['type'] == 'file') {
                        $upload_info = $this->model_tool_upload->getUploadByCode($order_info['custom_field'][$custom_field['custom_field_id']]);

                        if ($upload_info) {
                            $data['account_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $upload_info['name']
                            );
                        }
                    }
                }
            }

            $data['comment'] = nl2br($order_info['comment']);
            $data['shipping_method'] = $order_info['shipping_method'];
            $data['payment_method'] = $order_info['payment_method'];
            $data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);

            $this->load->model('customer/customer');

            $data['reward'] = $order_info['reward'];

            $data['reward_total'] = $this->model_customer_customer->getTotalCustomerRewardsByOrderId($this->request->get['order_id']);

            $data['affiliate_firstname'] = $order_info['affiliate_firstname'];
            $data['affiliate_lastname'] = $order_info['affiliate_lastname'];

            if ($order_info['affiliate_id']) {
                $data['affiliate'] = $this->url->link('marketing/affiliate/edit', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $order_info['affiliate_id'], 'SSL');
            } else {
                $data['affiliate'] = '';
            }

            $data['commission'] = $this->currency->format($order_info['commission'], $order_info['currency_code'], $order_info['currency_value']);

            $this->load->model('marketing/affiliate');

            $data['commission_total'] = $this->model_marketing_affiliate->getTotalTransactionsByOrderId($this->request->get['order_id']);

            $this->load->model('localisation/order_status');

            $order_status_info = $this->model_localisation_order_status->getOrderStatus($order_info['order_status_id']);

            if ($order_status_info) {
                $data['order_status'] = $order_status_info['name'];
            } else {
                $data['order_status'] = '';
            }

            $data['ip'] = $order_info['ip'];
            $data['forwarded_ip'] = $order_info['forwarded_ip'];
            $data['user_agent'] = $order_info['user_agent'];
            $data['accept_language'] = $order_info['accept_language'];
            $data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
            $data['date_modified'] = date($this->language->get('date_format_short'), strtotime($order_info['date_modified']));

            // Payment
            $data['payment_firstname'] = $order_info['payment_firstname'];
            $data['payment_lastname'] = $order_info['payment_lastname'];
            $data['payment_company'] = $order_info['payment_company'];
            $data['payment_address_1'] = $order_info['payment_address_1'];
            $data['payment_address_2'] = $order_info['payment_address_2'];
            $data['payment_city'] = $order_info['payment_city'];
            $data['payment_postcode'] = $order_info['payment_postcode'];
            $data['payment_zone'] = $order_info['payment_zone'];
            $data['payment_zone_code'] = $order_info['payment_zone_code'];
            $data['payment_country'] = $order_info['payment_country'];

            // Custom fields
            $data['payment_custom_fields'] = array();

            foreach ($custom_fields as $custom_field) {
                if ($custom_field['location'] == 'address' && isset($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
                    if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
                        $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['payment_custom_field'][$custom_field['custom_field_id']]);

                        if ($custom_field_value_info) {
                            $data['payment_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $custom_field_value_info['name'],
                                'sort_order' => $custom_field['sort_order']
                            );
                        }
                    }

                    if ($custom_field['type'] == 'checkbox' && is_array($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
                        foreach ($order_info['payment_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
                            $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

                            if ($custom_field_value_info) {
                                $data['payment_custom_fields'][] = array(
                                    'name'  => $custom_field['name'],
                                    'value' => $custom_field_value_info['name'],
                                    'sort_order' => $custom_field['sort_order']
                                );
                            }
                        }
                    }

                    if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
                        $data['payment_custom_fields'][] = array(
                            'name'  => $custom_field['name'],
                            'value' => $order_info['payment_custom_field'][$custom_field['custom_field_id']],
                            'sort_order' => $custom_field['sort_order']
                        );
                    }

                    if ($custom_field['type'] == 'file') {
                        $upload_info = $this->model_tool_upload->getUploadByCode($order_info['payment_custom_field'][$custom_field['custom_field_id']]);

                        if ($upload_info) {
                            $data['payment_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $upload_info['name'],
                                'sort_order' => $custom_field['sort_order']
                            );
                        }
                    }
                }
            }

            // Shipping
            $data['shipping_firstname'] = $order_info['shipping_firstname'];
            $data['shipping_lastname'] = $order_info['shipping_lastname'];
            $data['shipping_company'] = $order_info['shipping_company'];
            $data['shipping_address_1'] = $order_info['shipping_address_1'];
            $data['shipping_address_2'] = $order_info['shipping_address_2'];
            $data['shipping_city'] = $order_info['shipping_city'];
            $data['shipping_postcode'] = $order_info['shipping_postcode'];
            $data['shipping_zone'] = $order_info['shipping_zone'];
            $data['shipping_zone_code'] = $order_info['shipping_zone_code'];
            $data['shipping_country'] = $order_info['shipping_country'];

            $data['shipping_custom_fields'] = array();

            foreach ($custom_fields as $custom_field) {
                if ($custom_field['location'] == 'address' && isset($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
                    if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
                        $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);

                        if ($custom_field_value_info) {
                            $data['shipping_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $custom_field_value_info['name'],
                                'sort_order' => $custom_field['sort_order']
                            );
                        }
                    }

                    if ($custom_field['type'] == 'checkbox' && is_array($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
                        foreach ($order_info['shipping_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
                            $custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

                            if ($custom_field_value_info) {
                                $data['shipping_custom_fields'][] = array(
                                    'name'  => $custom_field['name'],
                                    'value' => $custom_field_value_info['name'],
                                    'sort_order' => $custom_field['sort_order']
                                );
                            }
                        }
                    }

                    if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
                        $data['shipping_custom_fields'][] = array(
                            'name'  => $custom_field['name'],
                            'value' => $order_info['shipping_custom_field'][$custom_field['custom_field_id']],
                            'sort_order' => $custom_field['sort_order']
                        );
                    }

                    if ($custom_field['type'] == 'file') {
                        $upload_info = $this->model_tool_upload->getUploadByCode($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);

                        if ($upload_info) {
                            $data['shipping_custom_fields'][] = array(
                                'name'  => $custom_field['name'],
                                'value' => $upload_info['name'],
                                'sort_order' => $custom_field['sort_order']
                            );
                        }
                    }
                }
            }

            $data['products'] = array();
            $this->load->model('catalog/product');

            $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
            $totalQuantity = 0;
            $totalWeight   = 0;

            foreach ($products as $product) {
                $totalQuantity += $product['quantity'];
                $option_data = array();

                $options = $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

                foreach ($options as $option) {
                    if ($option['type'] != 'file') {
                        $option_data[] = array(
                            'name'  => $option['name'],
                            'value' => $option['value'],
                            'type'  => $option['type']
                        );
                    } else {
                        $upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

                        if ($upload_info) {
                            $option_data[] = array(
                                'name'  => $option['name'],
                                'value' => $upload_info['name'],
                                'type'  => $option['type'],
                                'href'  => $this->url->link('tool/upload/download', 'token=' . $this->session->data['token'] . '&code=' . $upload_info['code'], 'SSL')
                            );
                        }
                    }
                }

                $productData = $this->model_catalog_product->getProduct($product['product_id']);
                $data['products'][] = array(
                    'order_product_id' => $product['order_product_id'],
                    'product_id'       => $product['product_id'],
                    'name'    	 	   => $product['name'],
                    'model'    		   => $product['model'],
                    'option'   		   => $option_data,
                    'quantity'		   => $product['quantity'],
                    'price'    		   => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
                    'total'    		   => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
                    'href'     		   => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL'),
                    'product_data'     => $productData
                );

                $totalWeight += $productData['weight'] * $product['quantity'];
            }

            $data['total_quantity'] = $totalQuantity;
            $data['total_weight']   = $totalWeight;

            if (empty($this->request->post['parcels_number']) || $this->request->post['parcels_number'] > $totalQuantity) {
                $parcels_number = $totalQuantity;
            } else {
                $parcels_number = $this->request->post['parcels_number'];
            }

            $data['parcels_number'] = $parcels_number;

            $data['vouchers'] = array();

            $vouchers = $this->model_sale_order->getOrderVouchers($this->request->get['order_id']);

            foreach ($vouchers as $voucher) {
                $data['vouchers'][] = array(
                    'description' => $voucher['description'],
                    'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
                    'href'        => $this->url->link('sale/voucher/edit', 'token=' . $this->session->data['token'] . '&voucher_id=' . $voucher['voucher_id'], 'SSL')
                );
            }

            $data['totals'] = array();

            $totals = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);

            foreach ($totals as $total) {
                $data['totals'][] = array(
                    'title' => $total['title'],
                    'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
                    'code'  => $total['code']
                );
            }

            $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

            $data['order_status_id'] = $order_info['order_status_id'];

            // Unset any past sessions this page date_added for the api to work.
            unset($this->session->data['cookie']);

            // Set up the API session
            if ($this->user->hasPermission('modify', 'sale/order')) {
                $this->load->model('user/api');

                $api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

                if ($api_info) {
                    $curl = curl_init();

                    // Set SSL if required
                    if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                    }

                    curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                    curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

                    $json = curl_exec($curl);

                    if (!$json) {
                        $data['error_warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                    } else {
                        $response = json_decode($json, true);
                    }

                    if (isset($response['cookie'])) {
                        $this->session->data['cookie'] = $response['cookie'];
                    }
                }
            }

            if (isset($response['cookie'])) {
                $this->session->data['cookie'] = $response['cookie'];
            } else {
                $data['error_warning'] = $this->language->get('error_permission');
            }

            $data['payment_action'] = $this->load->controller('payment/' . $order_info['payment_code'] . '/action');

            $data['frauds'] = array();

            $this->load->model('extension/extension');

            $extensions = $this->model_extension_extension->getInstalled('fraud');

            foreach ($extensions as $extension) {
                if ($this->config->get($extension . '_status')) {
                    $this->load->language('fraud/' . $extension);

                    $content = $this->load->controller('fraud/' . $extension . '/order');

                    if ($content) {
                        $data['frauds'][] = array(
                            'code'    => $extension,
                            'title'   => $this->language->get('heading_title'),
                            'content' => $content
                        );
                    }
                }
            }

            $this->applyGeneralFeatures();
            $this->_data['address_validation'] = $this->validateAddressForDpdShipment($order_info);
            $this->_data['url']                = $this->url;

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('shipping/zitec_dpd/shipment/info.tpl', $data));
        } else {
            $this->load->language('error/not_found');

            $this->document->setTitle($this->language->get('heading_title'));

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_not_found'] = $this->language->get('text_not_found');

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }

    }

    /**
     * ajax call
     *
     * return shipment info on the order info page
     */
    public function shipment_info()
    {
        $this->load->model('module/dpd/shipment');
        $content = $this->model_module_dpd_shipment->getShipmentInfo();

        $responseArray = array(
            'content' => $content
        );

        $this->response->setOutput(json_encode($responseArray));
    }

    /**
     *  used to print shipping label for a order
     *  considering that the sipping label is already created on dpd system
     *
     */
    public function printShippingLabel()
    {
        $this->preDispatch();

        $this->load->model('module/dpd/shipment');

        if (isset($this->request->get['shipment_id'])) {
            $shipment_id = $this->request->get['shipment_id'];
        } else {
            $shipment_id = 0;
        }

        $shipmentData = $this->model_module_dpd_shipment->getShipments($shipment_id);
        $pdfContent   = $shipmentData['shipping_labels'];

        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="shipment_label_' . $shipmentData['dpd_shipment_reference_number'] . '.pdf"');

        echo(base64_decode($pdfContent));
        exit;
    }


    /**
     *  used to print shipping label for a order
     *  considering that the sipping label is already created on dpd system
     *
     */
    public function printShippingLabelByOrder()
    {
        $this->preDispatch();

        $this->load->model('module/dpd/shipment');

        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }

        $shipmentData = $this->model_module_dpd_shipment->getShipmentsByOrder($order_id);

        $pdfContent = $shipmentData['shipping_labels'];

        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="shipment_labels_' . $shipmentData['dpd_shipment_reference_number'] . '.pdf"');

        echo(base64_decode($pdfContent));
        exit;
    }

    /**
     *  is called to trigger shipment create on dpd systems
     *  save it in opencart database and create shipment labels
     *
     */
    public function create()
    {
        $this->preDispatch();
        try {
            $this->load->model('sale/order');
            $this->load->model('module/dpd/helper');
            $this->load->model('module/dpd/shipment');
            $this->load->model('module/dpd/postcode');

            if (isset($this->request->get['order_id'])) {
                $order_id = $this->request->get['order_id'];
            } else {
                $order_id = 0;
            }

            $shipmentId = $this->model_module_dpd_shipment->createNewShipmentId($order_id);
            if (empty($shipmentId)) {
                $this->session->data['error'] = $this->language->get('Shipment id is not valid');
                $this->response->redirect($this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'], 'SSL'));

                return false;
            }

            $order_info = $this->model_sale_order->getOrder($order_id);
            $customer   = $order_info['customer'];
            if (empty($customer)) {
                $customer = $order_info['firstname'] . ' ' . $order_info['lastname'];
            }
            $address = array(
                'customer'        => $customer,
                'payment_company' => $order_info['payment_company'],
                'telephone'       => $order_info['telephone'],
                'address_1'       => $order_info['shipping_address_1'],
                'address_2'       => $order_info['shipping_address_2'],
                'postcode'        => $order_info['shipping_postcode'],
                'city'            => $order_info['shipping_city'],
                'zone'            => $order_info['shipping_zone'],
                'country'         => $order_info['shipping_country'],
                'iso_code_2'      => $order_info['shipping_iso_code_2'],
            );

            // look after a valid post code in database
            $relevance = new stdClass();
            $request   = array(
                'country'  => (strtolower($address['country']) == 'ro') ? 'romania' : $address['country'],
                'region'   => $address['zone'],
                'city'     => $address['city'],
                'address'  => $address['address_1'] . ' ' . $address['address_2'],
                'postcode' => $address['postcode']
            );

            $postcodeResult = $this->model_module_dpd_postcode->findAndCachePostCode($request, $relevance);

            if (!empty($postcodeResult)) {
                $request['postcode'] = $postcodeResult;
                $address['postcode'] = $postcodeResult;
            }

            $serviceId = $this->model_module_dpd_helper->extractDpdDeliveryServiceId($order_info['shipping_code']);
            if ($serviceId == false) {
                $this->session->data['error'] = $this->language->get('The order is not created using DPD shipment option. ');
                $this->response->redirect($this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'], 'SSL'));

                return false;
            }

            $parcels = '';
            if(isset($this->request->post['parcels'])) {
                $parcels = $this->request->post['parcels'];
            }

            $parcels = $this->extractParcelsWeightFromForm($parcels);

            $_response = $this->_createShipment($serviceId, $address, $parcels, $shipmentId, $order_info);

            if ($_response === false || $_response->hasError()) {
                $this->model_module_dpd_shipment->removeShipmentId($shipmentId);
                if ($_response === false) {
                    $this->session->data['error'] = $this->language->get('An error occurred during communication with DPD service.');
                } else {
                    $this->session->data['error'] = $this->language->get($_response->getErrorText());
                }
                $this->response->redirect($this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'], 'SSL'));
            }

            $dataToSave = array(
                'shipment_id'                   => $shipmentId,
                'save_shipment_call'            => serialize($_response),
                'save_shipment_response'        => serialize($_response->_getResponse()),
                'dpd_shipment_reference_number' => $_response->getDpdShipmentReferenceNumber(),
                'dpd_shipment_id'               => $_response->getDpdShipmentId()
            );
            $this->model_module_dpd_shipment->saveShipmentSaveResponse($dataToSave);

            $dpdShipmentId   = $_response->getDpdShipmentId();
            $referenceNumber = $_response->getDpdShipmentReferenceNumber();
            if (!isset($dpdShipmentId, $referenceNumber)) {
                $this->session->data['error'] = $this->language->get('The response from DPD Api is not valid');
                $this->response->redirect($this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'], 'SSL'));

                return false;
            }
            $pdfContent = $this->model_module_dpd_helper->getNewPdfShipmentLabelsStr($dpdShipmentId, $referenceNumber, $order_info);

            $dataToSave = array(
                'shipment_id'     => $shipmentId,
                'shipping_labels' => base64_encode($pdfContent)
            );
            $this->model_module_dpd_shipment->saveShipmentLabels($dataToSave);

            $this->session->data['success'] = $this->language->get('The shipment was successfuly created on DPD system');
        } catch (Exception $e) {
            global $log;
            $logString = '___________________';
            $log->write($logString);
            $logString = 'DPD shipping carrier - create shipment';
            $log->write($logString);
            $log->write('Error code:' . $e->getCode());
            $log->write($e->getMessage());

            $this->session->data['error'] = $this->language->get('an error was detected while the shipment creation: ' . $e->getMessage());
        }
        $this->response->redirect($this->url->link('dpd/shipment/index', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'], 'SSL'));

    }


    /**
     * call this action to obtain exact price for parcels
     *
     */
    public function validateShippingPrice()
    {
        $this->load->model('sale/order');
        $this->load->model('module/dpd/helper');
        $this->load->model('module/dpd/postcode');

        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }

        $order_info = $this->model_sale_order->getOrder($order_id);

        $address = array(
            'address_1'  => $order_info['shipping_address_1'],
            'address_2'  => $order_info['shipping_address_2'],
            'postcode'   => $order_info['shipping_postcode'],
            'city'       => $order_info['shipping_city'],
            'zone'       => $order_info['shipping_zone'],
            'country'    => $order_info['shipping_country'],
            'iso_code_2' => $order_info['shipping_iso_code_2'],
        );

        // look after a valid post code in database
        $relevance = new stdClass();
        $request   = array(
            'country'  => (strtolower($address['country']) == 'ro') ? 'romania' : $address['country'],
            'region'   => $address['zone'],
            'city'     => $address['city'],
            'address'  => $address['address_1'] . ' ' . $address['address_2'],
            'postcode' => $address['postcode']
        );

        $postcodeResult = $this->model_module_dpd_postcode->findAndCachePostCode($request, $relevance);

        if (!empty($postcodeResult)) {
            $request['postcode'] = $postcodeResult;
            $address['postcode'] = $postcodeResult;
        }

        $serviceId = $this->model_module_dpd_helper->extractDpdDeliveryServiceId($order_info['shipping_code']);

        if (empty($this->request->post['parcels'])) {
            $responseArray = array(
                'error' => $this->language->get('The request is not correct, or the shipment was already created.')

            );
            $this->response->setOutput(json_encode($responseArray));

            return;
        }
        $parcels = $this->request->post['parcels'];
        $parcels = $this->extractParcelsWeightFromForm($parcels);

        $priceResponse = $this->getDpdWsShippingPrice($serviceId, $address, $parcels, $order_info);

        $totals        = $this->model_sale_order->getOrderTotals($order_id);
        $shippingTotal = $this->extractShippingTotalFromTotals($totals);
        if (empty($priceResponse) || $priceResponse->hasError()) {
            if (empty($priceResponse)) {
                $responseArray = array(
                    'error' => $this->language->get('The DPD service is unreachable or the connection parameters are wrong.')

                );
            } else {
                $responseArray = array(
                    'error' => $priceResponse->getErrorText()
                );
            }
        } else {
            $apiTotalAmount = $priceResponse->getTotalAmount();
            if ($priceResponse->getCurrency() != $order_info['currency_code']) {
                if ($priceResponse->getCurrencyLocal() != $order_info['currency_code']) {
                    $responseArray = array(
                        'error' => $this->language->get('The response from DPD api has different currency')

                    );
                    $this->response->setOutput(json_encode($responseArray));

                    return;
                }
                $apiTotalAmount = $priceResponse->getTotalAmountLocal();

            }
            $profit = ($shippingTotal['value'] * $order_info['currency_value']) - $apiTotalAmount;

            //we use 1 for currency rate because, we already checked if is the same currency
            $responseArray = array(
                'error'        => false,
                'profit'       => $this->currency->format($profit, $order_info['currency_code'], 1),
                'price_paid'   => $this->currency->format($shippingTotal['value'], $order_info['currency_code'], $order_info['currency_value']),
                'profitcolor'  => ($profit >= 0 ? 'green' : 'red'),
                'shippingcost' => $this->currency->format($apiTotalAmount, $order_info['currency_code'], 1)
            );
        }
        $this->response->setOutput(json_encode($responseArray));
    }


    public function extractShippingTotalFromTotals($totals)
    {
        foreach ($totals as $total) {
            if ($total['code'] == 'shipping') {
                return $total;
            }
        }

        return false;
    }


    /**
     * - process all data posted to action and return the parcels weight
     *
     * @param $parcels
     *
     * @return array
     */
    public function extractParcelsWeightFromForm($parcels)
    {
        if (!is_array($parcels)) {
            return false;
        }
        $this->load->model('catalog/product');

        $parcelsWeight = array();
        foreach ($parcels as $product => $parcel) {
            $product_id  = explode('_', $product);
            $product_id  = $product_id[0];
            $productData = $this->model_catalog_product->getProduct($product_id);
            if (empty($parcelsWeight[$parcel])) {
                $parcelsWeight[$parcel] = 0;
            }
            $parcelsWeight[$parcel] += $productData['weight'];
        }

        return $parcelsWeight;

    }


    /**
     * call calculate price on DPD api and return the values
     *
     * @param $service
     * @param $address
     *
     * @return bool
     */
    public function getDpdWsShippingPrice($service, $address, $parcels, $order_info = null)
    {

        $this->load->model('module/dpd/helper');
        $this->model_module_dpd_helper->requireApiFile();

        $storeId             = (is_array($order_info) && isset($order_info['store_id']) ? $order_info['store_id'] : 0);
        $apiParams           = $this->model_module_dpd_helper->getShipmentParams($storeId);
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_CALCULATE_PRICE;

        try {
            $dpdApi         = new Zitec_Dpd_Api($apiParams);
            $calculatePrice = $dpdApi->getApiMethodObject();

            $calculatePrice->setReceiverAddress($address['address_1'] . ' ' . $address['address_2'], $address['city'], $address['postcode'], $address['iso_code_2'])
                ->setShipmentServiceCode($service);

            foreach ($parcels as $key => $parcelWeight) {
                $calculatePrice->addParcel($parcelWeight);
            }

            $this->load->model('sale/order');
            $products             = $this->model_sale_order->getOrderProducts($order_info['order_id']);
            $insuranceDescription = '';
            foreach ($products as $product) {
                $insuranceDescription .= '|' . $product['name'];
            }
            $totalAmount  = $order_info['total'];
            $currencyCode = $order_info['currency_code'];

            $calculatePrice->setAdditionalHighInsurance($totalAmount, $currencyCode, $insuranceDescription);

            $calculatePrice->execute();
        } catch (Exception $e) {
            return false;
        }

        return $dpdApi()->getResponse();

    }


    /**
     * call calculate price on DPD api and return the values
     *
     * @param $service
     * @param $address
     *
     * @return bool
     */
    public function _createShipment($service, $address, $parcels, $shipmentId, $order_info = null)
    {

        $this->load->model('module/dpd/helper');
        $this->model_module_dpd_helper->requireApiFile();

        $storeId             = (isset($order_info) && !empty($order_info['store_id']) ? $order_info['store_id'] : 0);
        $apiParams           = $this->model_module_dpd_helper->getShipmentParams($storeId);
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_SAVE;

        try {
            $dpdApi         = new Zitec_Dpd_Api($apiParams);
            $createShipment = $dpdApi->getApiMethodObject();
            $createShipment->setShipmentReferenceNumber($shipmentId);

            $createShipment->setReceiverAddress($address)
                ->setShipmentServiceCode($service);


            $predict_methods = $this->model_module_dpd_settings->getShippingSettings('dpd_services_predict');
            $predict_methods_by_keys = array_flip($predict_methods);

            if(isset($address['telephone']) && array_key_exists($service, $predict_methods_by_keys)) {
                $createShipment->setPredictPhoneNumber($address['telephone']);
            }

            if(is_array($parcels)) {
                foreach ($parcels as $key => $parcelWeight) {
                    $createShipment->addParcel($key, $parcelWeight, $key);
                }
            }


            $this->load->model('sale/order');
            $products             = $this->model_sale_order->getOrderProducts($order_info['order_id']);
            $insuranceDescription = '';
            foreach ($products as $product) {
                $insuranceDescription .= '|' . $product['name'];
            }
            $totalAmount  = $order_info['total'];
            $currencyCode = $order_info['currency_code'];

            $createShipment->setAdditionalHighInsurance($totalAmount, $currencyCode, $insuranceDescription);

            $paymentCode = (isset($order_info) && !empty($order_info['payment_code']) ? $order_info['payment_code'] : 0);
            if ($paymentCode === 'dpd_cod') {
                $this->load->model('module/dpd/settings');
                $paymentMethod = $this->model_module_dpd_settings->getCodPaymentMethod();
                $createShipment->setCashOnDelivery($totalAmount, $currencyCode, $paymentMethod);
            }

            $createShipment->execute();
        } catch (Exception $e) {
            global $log;
            $logString = '___________________';
            $log->write($logString);
            $logString = 'DPD shipping carrier - Create shipment';
            $log->write($logString);
            $log->write('Error code:' . $e->getCode());
            $log->write($e->getMessage());

            return false;
        }

        return $dpdApi()->getResponse();

    }


    /**
     * call webservice to obtain tracking number
     *
     * @param $shipmentData
     *
     * @return mixed
     */
    public function getShippingTrackingData($shipmentData)
    {
        $this->load->model('module/dpd/shipment');

        return $this->model_module_dpd_shipment->getShippingTrackingData($shipmentData);
    }

    /**
     * check if dpd requirements are matched for current order
     * the return of this function will trigger errors on  frontend
     *
     * @param $order_info
     *
     * @return array
     */
    protected function validateAddressForDpdShipment($order_info)
    {
        $validationResult           = array();
        $validationResult['errors'] = array();
        $address                    = array(
            'region'   => $order_info['shipping_zone'],
            'country'  => (strtolower($order_info['shipping_country']) == 'ro') ? 'romania' : strtolower($order_info['shipping_country']),
            'city'     => $order_info['shipping_city'],
            'address'  => $order_info['shipping_address_1'] . (!empty($order_info['shipping_address_2']) ? ' ' . $order_info['shipping_address_2'] : ''),
            'postcode' => $order_info['shipping_postcode'],
        );


        $this->load->model('module/dpd/postcode');
        $countryName               = (strtolower($address['country']) == 'ro') ? 'romania' : strtolower($address['country']);
        $postcodeValidationEnabled = $this->model_module_dpd_postcode->isEnabledAutocompleteForPostcode($countryName);
        if (!empty($postcodeValidationEnabled)) {
            // look after a valid post code in database
            $relevance      = new stdClass();
            $postcodeResult = $this->model_module_dpd_postcode->findAndCachePostCode($address, $relevance);
            if (!$this->model_module_dpd_postcode->isValid($postcodeResult, $relevance)) {
                $validationResult['errors']['postcode'] = 1;
            }
        }

        if (strlen($address['address']) > Zitec_Dpd_Postcode_Search::ADDRESS_FIELD_LENGTH_LIMIT) {
            $validationResult['errors']['street_length'] = 1;
        }

        return $validationResult;
    }


    /**
     *  add to all actions in this controller a basic behavior
     *  for example add the basic breadcrumbs information
     *  init some models needed in all places
     */
    private function applyGeneralFeatures()
    {
        $this->language->load('shipping/zitec_dpd/shipment_info');
        $this->_data['language'] = $this->language;


        //ERROR handling
        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
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

        $results = $this->model_module_dpd_postcode->findAllSimilarAddressesForAddress($address);

        $data = array();
        if (is_array($results) && !empty($results)) {
            foreach ($results as $address) {
                $data[] = array(
                    'label'    => $address['postcode'] . ' - ' . ($address['address'] ? $address['address'] . ', ' : '') . $address['city'] . ', ' . $address['region'],
                    'postcode' => $address['postcode']
                );
            }
        }

        echo json_encode($data);
        exit;
    }

}
