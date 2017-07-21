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
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @author     Zitec COM <magento@zitec.ro>
 */
class ModelModuleDpdShipment extends Model
{

    const TABLE_NAME = 'zitec_dpd_shipment';


    /**
     * return the entire data collection for shipment
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getShipmentsByOrder($order_id)
    {
        $sql   = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE order_id = '" . $this->db->escape($order_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);
        $entry = $query->row;
        if (!empty($entry)) {
            return $entry;
        }

        return false;

    }


    /**
     * return the entire data collection for shipment
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getShipments($shipment_id)
    {
        $sql   = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE shipment_id = '" . $this->db->escape($shipment_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);
        $entry = $query->row;
        if (!empty($entry)) {
            return $entry;
        }

        return false;

    }

    public function getShipment($shipment_id)
    {
        return $this->getShipments($shipment_id);
    }

    /**
     * @param $data - filter data
     *
     * @return mixed
     */
    public function getShipmentsWithFilter($data)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " ";

        $condition                        = '';
        if (!empty($data['filter_shipment_id'])) {
            $condition .= (empty($condition) ? '' : ' AND ') . " shipment_id = '" . $data['filter_shipment_id'] . "' ";
        }
        if (!empty($data['filter_order_id'])) {
            $condition .= (empty($condition) ? '' : ' AND ') . " order_id = '" . $data['filter_order_id'] . "' ";
        }
        if (!empty($data['filter_shipment'])) {
            $condition .= (empty($condition) ? '' : ' AND ') . " dpd_shipment_reference_number = '" . $data['filter_shipment'] . "' ";
        }

        if (!empty($data['filter_shipment_created'])) {
            $condition .= (empty($condition) ? '' : ' AND ') . "  DATE(created) = DATE('" . $this->db->escape($data['filter_shipment_created']) . "') ";
        }

        if(!empty($condition)){
            $sql .= ' WHERE '. $condition;
        }

        $sql .= " GROUP BY shipment_id ORDER BY shipment_id DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }


        $query = $this->db->query($sql);

        return $query->rows;
    }


    public function getTotalShipments()
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . self::TABLE_NAME . " ");

        return $query->row['total'];
    }


    /**
     * return the entire data collection for shipment
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getShipmentsList()
    {
        $sql   = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " ";
        $query = $this->db->query($sql);

        if (!empty($query->rows)) {
            return $query->rows;
        }

        return false;

    }


    /**
     * return the entire data collection for shipment
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getShipmentsListWhereIds($ids)
    {
        if (empty($ids)) {
            return false;
        }
        $filteredData = array();
        foreach ($ids as $key => $value) {
            $filteredData[$key] = $this->db->escape($value);
        }
        $ids = $filteredData;
        $sql = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE shipment_id IN ('" . implode("','", $ids) . "') ";

        $query = $this->db->query($sql);

        return $query->rows;
    }


    /**
     *  create new shipment id for a given order
     *
     * @param $data
     *
     * @return mixed
     */
    public function createNewShipmentId($order_id)
    {
        $sql   = "SELECT shipment_id FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE order_id = '" . $this->db->escape($order_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);
        $entry = $query->row;
        if (!empty($entry['shipment_id'])) {
            return $entry['shipment_id'];
        }

        $sql = "INSERT INTO " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `order_id` = '" . $this->db->escape($order_id) . "'
                                        ";

        $this->db->query($sql);

        $shipmentId = $this->db->getLastId();

        return $shipmentId;
    }

    /**
     *  remove shipment by shipment id
     *
     * @param $data
     *
     * @return mixed
     */
    public function removeShipmentId($shipment_id)
    {
        if (!$this->isShipmentEmpty($shipment_id)) {
            return false;
        }

        $sql   = "DELETE FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE shipment_id = '" . $this->db->escape($shipment_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);

        return $query;
    }

    public function isShipmentEmpty($shipment_id)
    {
        $data = $this->getShipment($shipment_id);

        return (empty($data['dpd_shipment_reference_number']) &&
            empty($data['dpd_shipment_id']) &&
            empty($data['manifest'])
        );
    }


    /**
     * update an existing shipment - save shipment save response
     *
     * @param $data
     *
     * @return mixed
     */
    public function saveShipmentSaveResponse($data)
    {
        if (empty($data['shipment_id'])) {
            return false;
        }

        $sql = "UPDATE " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `save_shipment_response` = '" . $this->db->escape($data['save_shipment_response']) . "',
                                        `dpd_shipment_reference_number` = '" . $this->db->escape($data['dpd_shipment_reference_number']) . "',
                                        `dpd_shipment_id` = '" . $this->db->escape($data['dpd_shipment_id']) . "'
                                        WHERE shipment_id =  '" . $this->db->escape($data['shipment_id']) . "'
                    ";

        return $this->db->query($sql);
    }

    /**
     * save manifest on shipment
     *
     * @param $data
     *
     * @return mixed
     */
    public function saveManifestOnShipment($data)
    {
        if (empty($data['shipment_id'])) {
            return false;
        }

        $sql = "UPDATE " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `manifest` = '" . $this->db->escape($data['manifest']) . "'
                                        WHERE shipment_id =  '" . $this->db->escape($data['shipment_id']) . "'
                    ";

        return $this->db->query($sql);
    }


    /**
     * update an existing shipment, save shipping labels
     *
     * @param $data
     *
     * @return mixed
     */
    public function saveShipmentLabels($data)
    {
        if (empty($data['shipment_id'])) {
            return false;
        }

        $sql = "UPDATE " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `shipping_labels` = '" . ($data['shipping_labels']) . "'
                                        WHERE shipment_id =  '" . $this->db->escape($data['shipment_id']) . "'
                    ";

        return $this->db->query($sql);
    }


    /**
     * @param $shipment
     *
     * @return bool return true every time because all
     *              shipment in the list are dpd shipments
     */
    public function isDpdShipment($shipment)
    {
        return true;
    }


    public function isShipmentRegistredWithDpd($shipment)
    {
        if (empty($shipment['dpd_shipment_reference_number'])) {
            return false;
        }

        // the shipment can be canceled in this case
        if (empty($shipment['shipping_labels'])) {
            return false;
        }

        return true;
    }


    public function getShipmentInfo()
    {
        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'zitec_dpd' AND `type` = 'shipping' ");

        if ($result->num_rows) {
            //extension installed it's ok
        } else {
            $url     = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
            $content = $this->language->get('DPD - shipping module is not installed. Please install it by pressing button install <a href="%s">shipping extensions list.</a>');
            $content = sprintf($content, $url);

            $content       = '<div style="padding: 10px;"><p>' . $content . '</p></div>';

            return $content;
        }

        $this->load->model('module/dpd/shipment');
        $this->load->model('sale/order');
        $this->load->model('module/dpd/helper');

        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }

        $order_info = $this->model_sale_order->getOrder($order_id);

        $serviceId = $this->model_module_dpd_helper->extractDpdDeliveryServiceId($order_info['shipping_code']);
        $content   = '';
        if ($serviceId == false) {
            $alert      = $this->language->get('The order was not created using one of DPD shipping service');
            $secondPart = $this->language->get('This section is available only for DPD shipping services.');
            $content    = '<div style="padding: 10px;"><p>' . $alert . '</p><p>' . $secondPart . '</p></div>';

        }

        $shipmentData = $this->model_module_dpd_shipment->getShipmentsByOrder($order_id);

        $statusResponse = $this->getShippingTrackingData($shipmentData);
        $traking_url    = $statusResponse['tracking_url'];


        $print_shipments_url = $this->url->link('dpd/shipment/printShippingLabel' . '&token=' . $this->session->data['token'] . '&shipment_id=' . $shipmentData['shipment_id'], 'SSL');

        $shipmentsHtml = '';
        if ($serviceId !== false && !empty($shipmentData['dpd_shipment_reference_number'])) {
            $shipmentsHtml =
                '<div>
                             <table class="table table-bordered table-hover">
                                 <tbody>
                                     <tr>
                                         <td class="left">' . $this->language->get('Shipment') . '</td>
                                         <td class="left"><a href="' . $print_shipments_url . '">' . $shipmentData['dpd_shipment_reference_number'] . '</a></td>
                                     </tr>
                                     <tr>
                                            <td class="left">' . $this->language->get('Track this shipment') . '</td>
                                            <td><a href="' . $traking_url . '" target="_blank">' . $traking_url . '</a></td>
                                     </tr>
                                 </tbody>
                             </table>
                        </div>';
            $content .= $shipmentsHtml;
        }

        if (empty($shipmentData)) {
            $alert   = $this->language->get('The shipment is not already created on DPD systems.');
            $button  = '<a id="shipment_management_button" href="index.php?route=dpd/shipment/index&token=' . $this->request->get['token'] . '&order_id=' . $this->request->get['order_id'] . '" class="btn btn-default" token="' . $this->request->get['token'] . '">' . $this->language->get('Create Shipment') . '</a>';
            $content = '<div style="padding: 10px;"><p>' . $alert . '</p><p>' . $button . '</p></div>';
        }

        return $content;
    }

    public function getShippingTrackingData($shipmentData)
    {
        $this->load->model('module/dpd/shipment_tracking');

        $cachedShippmentData = $this->model_module_dpd_shipment_tracking->getTrackingData($shipmentData['shipment_id']);
        if (!empty($cachedShippmentData) && !empty($cachedShippmentData['tracking_url'])) {
            return $cachedShippmentData;
        }
        $referenceNumber = $shipmentData['dpd_shipment_reference_number'];
        $dpd_shipment_id = $shipmentData['dpd_shipment_id'];
        $this->load->model('module/dpd/helper');
        $this->model_module_dpd_helper->requireApiFile();

        $response = $this->model_module_dpd_helper->getShipmentStatus($dpd_shipment_id, $referenceNumber);

        $trackingData = array(
            'shipment_id'              => $shipmentData['shipment_id'],
            'refference_tracking_id'   => '',
            'shipment_status_response' => serialize($response),
            'tracking_url'             => $response->getTrackingUrl(),
        );
        $this->model_module_dpd_shipment_tracking->saveTrackingResponse($trackingData);

        return $trackingData;
    }
}
