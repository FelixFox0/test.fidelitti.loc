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
class ControllerDpdShipmentList extends Controller
{
    protected $_data = array();

    public function preDispatch()
    {
        $this->load->url = $this->url;
        $this->load->config = $this->config;

        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'zitec_dpd' AND `type` = 'shipping' ");

        if ($result->num_rows) {
            //extension installed it's ok
        } else {
            $this->session->data['success'] = $this->language->get('DPD - shipping module is not installed. Please install it by pressing the install button in shipping extensions list.');
            $this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }


    public function createManifest()
    {
        $this->preDispatch();
        $post = $this->request->post;

        if (isset($post['selected'])) {
            $shipmentsIds = $post['selected'];
        }
        if ($shipmentsIds && is_numeric($shipmentsIds)) {
            $shipmentsIds = array($shipmentsIds);
        }

        if (!$shipmentsIds || !is_array($shipmentsIds)) {
            $this->session->data['error'] = $this->language->get('Please select the shipments to include in the manifest.');
            $this->response->redirect($this->url->link('dpd/shipment_list/index', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->load->model('sale/order');
        $this->load->model('module/dpd/shipment');
        $shipments = $this->model_module_dpd_shipment->getShipmentsListWhereIds($shipmentsIds);

        // prepare create manifest action sorted by store id
        $shipmentsForManifestIdsByStore = array();
        $shipmentsForManifestByStore    = array();
        $countShipments                 = 0;
        foreach ($shipments as $shipment) {
            $order_id   = $shipment['order_id'];
            $order_info = $this->model_sale_order->getOrder($order_id);
            $storeId    = (isset($order_info) && !empty($order_info['store_id']) ? $order_info['store_id'] : 0);
            if (!isset($shipmentsForManifestIdsByStore[$storeId]) || !is_array($shipmentsForManifestIdsByStore[$storeId])) {
                $shipmentsForManifestIdsByStore[$storeId] = array();
            }
            if (!isset($shipmentsForManifestByStore[$storeId]) || !is_array($shipmentsForManifestByStore[$storeId])) {
                $shipmentsForManifestByStore[$storeId] = array();
            }

            if (!$this->model_module_dpd_shipment->isDpdShipment($shipment)) {
                $message = sprintf($this->language->get('Could not include shipment %s in the manifest because it is not a DPD shipment.'), $shipment['shipment_id']);
                $this->_addNotification($message);
                continue;
            }

            if (!$this->model_module_dpd_shipment->isShipmentRegistredWithDpd($shipment)) {
                $message = sprintf($this->language->get('Could not include shipment %s in the manifest because it was not communicated to DPD.'), $shipment['shipment_id']);
                $this->_addNotification($message);
                continue;
            }
            $shipmentsForManifestByStore[$storeId][]    = $shipment;
            $shipmentsForManifestIdsByStore[$storeId][] = $shipment['shipment_id'];
            $countShipments++;
        }

        if ($countShipments == 0) {
            $this->_addNotification($this->language->get("None of the shipments selected could be included in a manifest."));
            $this->response->redirect($this->url->link('dpd/shipment_list/index', 'token=' . $this->session->data['token'], 'SSL'));

            return false;
        }

        $this->_getWsHelper()->requireApiFile();
        $messageString = '';
        $error         = false;
        foreach ($shipmentsForManifestByStore as $storeId => $shipmentsForManifest) {
            $closeManResponse = $this->createManifestByStore($shipmentsForManifest, $shipmentsForManifestIdsByStore[$storeId], $storeId);
            $error            = $error || ($closeManResponse === false);
            if ($closeManResponse !== false) {
                $messageString .= '<br />' . $closeManResponse;
            }
        }
        if (!$error) {
            $this->session->data['success'] = $messageString;
        } else {
            $this->session->data['error'] = $this->language->get('Some errors occurred during processing');
        }
        $this->response->redirect($this->url->link('dpd/shipment_list/index', 'token=' . $this->session->data['token'], 'SSL'));
    }

    protected function createManifestByStore($shipmentsForManifest, $shipmentsForManifestIds, $storeId)
    {
        $manifestParams = $this->_getWsHelper()->getManifestParams($storeId);

        $manifestParams['method'] = Zitec_Dpd_Api_Configs::METHOD_MANIFEST_CLOSE;
        $dpdApi                   = new Zitec_Dpd_Api($manifestParams);
        $closeManifest            = $dpdApi->getApiMethodObject();


        foreach ($shipmentsForManifest as $index => $shipment) {
            $shipResponse = unserialize($shipment['save_shipment_response']);
            if (!empty($shipResponse->result->resultList->shipmentReference->id)) {
                $shipmentId = $shipResponse->result->resultList->shipmentReference->id;
            } else {
                continue;
            }

            $closeManifest->addShipment($shipmentId, $shipment['dpd_shipment_reference_number']);
            if ($index == 0) {
                $closeManifest->setManifestReferenceNumber($shipment['dpd_shipment_reference_number']);
            }
        }

        try {
            $closeManifest->execute();
        } catch (Exception $e) {
            global $log;
            $logString = '___________________';
            $log->write($logString);
            $logString = 'DPD shipping carrier - create manifest';
            $log->write($logString);
            $log->write('Error code:' . $e->getCode());
            $log->write($e->getMessage());

            $this->_addNotification(sprintf($this->language->get("An error occurred while requesting the manifest from DPD: %s"), $e->getMessage()));

            return false;
        }

        $response = $closeManifest->getCloseManifestResponse();
        if ($response->hasError()) {
            $this->_addNotification(sprintf($this->language->get('An error occurred while communicating the manifest details to DPD. DPD says: "%s"'), $response->getErrorText()));

            return false;
        }

        $manifestData                            = array();
        $manifestData['manifestReferenceNumber'] = $response->getManifestReferenceNumber();
        $manifestData['dpd_manifest_id']         = $response->getManifestId();
        $manifestData['manifestName']            = $response->getManifestName();
        $manifestData['pdfManifestFile']         = base64_encode($response->getPdfFile());
        $manifestData['shipments']               = serialize($shipmentsForManifestIds);


        $this->load->model('module/dpd/manifest');
        try {
            $manifestId = $this->model_module_dpd_manifest->saveManifest($manifestData);

            $shipmentData = array(
                'manifest' => $manifestId
            );
            foreach ($shipmentsForManifestIds as $shipmentId) {
                $shipmentData['shipment_id'] = $shipmentId;
                $this->model_module_dpd_shipment->saveManifestOnShipment($shipmentData);

            }
        } catch (Exception $e) {
            $message = "The manifest was communicated successfully to DPD, but an error occurred while saving the manifest details in Opencart. <br />" .
                "Please make a capture of this screen so that you have a record of the shipments included in the manifest. <br />" .

                "For you reference when communicating with DPD, the manifest details are: <br /> " .
                "Manifest Reference: %s <br />" .
                "Manifest Name: %s <br />" .
                "Manifest internal DPD ID: %s <br />" .
                "The error message returned was: %s";

            $this->_addNotification(sprintf($this->language->get($message), $manifestData['manifestReferenceNumber'], $manifestData['dpd_manifest_id'], $manifestData['manifestName'], $e->getMessage()));

        }

        $message = (sprintf($this->language->get('The manifest %s was successfully Closed'), $manifestData['manifestName']));

        return $message;

    }


    public function index()
    {
        $this->preDispatch();
        $this->load->model('module/dpd/shipment');
        $this->load->language('shipping/zitec_dpd');

        $this->applyGeneralFeatures();
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/category');

        $this->getList();
    }

    protected function getList()
    {
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['insert']   = $this->url->link('dpd/shipment_list/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->_data['manifest'] = $this->url->link('dpd/shipment_list/createManifest', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->_data['repair']   = $this->url->link('dpd/shipment_list/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->_data['shipments'] = array();

        $this->_data['pagination']                             = array(
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $this->_data['filter_shipment_id'] = '';
        $this->_data['filter_order_id']    = '';
        $this->_data['filter_shipment']    = '';
        $this->_data['filter_manifest']    = '';
        $this->_data['filter_shipment_created']    = '';

        if (isset($this->request->get['filter_shipment_id'])) {
            $this->_data['filter_shipment_id'] = $this->_data['filter_shipment_id'] = $this->db->escape($this->request->get['filter_shipment_id']);
        }
        if (isset($this->request->get['filter_order_id'])) {
            $this->_data['filter_order_id'] = $this->_data['filter_order_id'] = $this->db->escape($this->request->get['filter_order_id']);
        }
        if (isset($this->request->get['filter_shipment'])) {
            $this->_data['filter_shipment'] = $this->_data['filter_shipment'] = $this->db->escape($this->request->get['filter_shipment']);
        }
        if (isset($this->request->get['filter_manifest'])) {
            $this->_data['filter_manifest'] = $this->_data['filter_manifest'] = $this->db->escape($this->request->get['filter_manifest']);
        }
        if (isset($this->request->get['filter_shipment_created'])) {
            $this->_data['filter_shipment_created'] = $this->_data['filter_shipment_created'] = $this->db->escape($this->request->get['filter_shipment_created']);
        }
        $this->_data['token'] = $this->request->get['token'];

        $category_total = $this->model_module_dpd_shipment->getTotalShipments();

        $results = $this->model_module_dpd_shipment->getShipmentsWithFilter($this->_data);
        $this->load->model('module/dpd/manifest');
        $manifestIds = array();
        $this->load->model('module/dpd/shipment_tracking');

        foreach ($results as $result) {
            $action = array();
            /*
                $action[] = array(
                    'text' => $this->language->get('text_edit'),
                    'href' => $this->url->link('dpd/shipment_list/update', 'token=' . $this->session->data['token'] . '&shipment_id=' . $result['shipment_id'] . $url, 'SSL')
                );
            */
            $trackingData  = $this->model_module_dpd_shipment_tracking->getTrackingData($result['shipment_id']);
            $manifestIds[] = $result['manifest'];

            $this->_data['manifest_list'] = $this->model_module_dpd_manifest->getManifestList($manifestIds);

            $this->_data['shipments'][] = array(
                'shipment_id'                   => $result['shipment_id'],
                'order_id'                      => $result['order_id'],
                'created'                      => $result['created'],
                'manifest'                      => $result['manifest'],
                'tracking_url'                  => (!empty($trackingData['tracking_url']) ? $trackingData['tracking_url'] : ''),
                'dpd_shipment_reference_number' => $result['dpd_shipment_reference_number'],
                'print_shipment'                => $this->url->link('dpd/shipment/printShippingLabel', 'token=' . $this->session->data['token'] . '&shipment_id=' . $result['shipment_id'] . $url, 'SSL'),
                'print_manifest'                => $this->url->link('dpd/manifest/printmanifest', 'token=' . $this->session->data['token'] . '&manifest=' . $result['manifest'] . $url, 'SSL'),
                'selected'                      => isset($this->request->post['selected']) && in_array($result['shipment_id'], $this->request->post['selected']),
                'action'                        => $action
            );
        }

        $this->_data['heading_title'] = $this->language->get('heading_title');

        $this->_data['text_no_results'] = $this->language->get('text_no_results');

        $this->_data['column_name']       = $this->language->get('column_name');
        $this->_data['column_sort_order'] = $this->language->get('column_sort_order');
        $this->_data['column_action']     = $this->language->get('column_action');

        $this->_data['button_insert'] = $this->language->get('button_insert');
        $this->_data['button_delete'] = $this->language->get('button_delete');
        $this->_data['button_repair'] = $this->language->get('button_repair');

        $pagination        = new Pagination();
        $pagination->total = $category_total;
        $pagination->page  = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text  = $this->language->get('text_pagination');
        $pagination->url   = $this->url->link('dpd/shipment_list/index', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->_data['pagination'] = $pagination->render();

        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('shipping/zitec_dpd/shipment/shipment_list.tpl', $this->_data));
    }


    /**
     *  add to all actions in this controller a basic behavior
     *  for example add the basic breadcrumbs information
     *  init some models needed in all places
     */
    private function applyGeneralFeatures()
    {
        $this->language->load('shipping/zitec_dpd/shipment/list');
        $this->_data['language'] = $this->language;


        //ERROR handling
        if (isset($this->error['warning'])) {
            $this->_data['error_warning'] = $this->error['warning'];
        } else {
            $this->_data['error_warning'] = '';
        }

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

        if (isset($this->session->data['notification_array'])) {
            $this->_data['notification_array'] = $this->session->data['notification_array'];

            unset($this->session->data['notification_array']);
        } else {
            $this->_data['notification_array'] = '';
        }

    }


    /**
     * append notification to the notification_array
     *
     * @param $message
     *
     * @return bool
     */
    protected function _addNotification($message)
    {
        if (empty($this->session->data['notification_array'])) {
            $this->session->data['notification_array'] = array();
        }
        $this->session->data['notification_array'][] = $message;

        return true;
    }


    protected function _getWsHelper()
    {
        if (empty($this->model_module_dpd_helper)) {
            $this->load->model('module/dpd/helper');
        }

        return $this->model_module_dpd_helper;
    }

}