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
class ModelModuleDpdShipmentTracking extends Model
{

    const TABLE_NAME = 'zitec_dpd_shipment_tracking';

    /**
     * return the tracking data for given shipment
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getTrackingData($shipment_id)
    {
        $sql   = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE shipment_id = '" . $this->db->escape($shipment_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);
        $entry = $query->row;
        if (!empty($entry)) {
            return $entry;
        }

        return false;

    }


    public function getTrackingUrlByOrder($orderId)
    {
        try {
            $sql   = "SELECT tracking_url FROM " . DB_PREFIX . self::TABLE_NAME . " AS trackingTable
                  LEFT JOIN  " . DB_PREFIX . "zitec_dpd_shipment AS shipmentTable ON shipmentTable.shipment_id = trackingTable.shipment_id
                  WHERE shipmentTable.order_id = '" . $this->db->escape($orderId) . "' LIMIT 1 ";
            $query = $this->db->query($sql);
            $entry = $query->row;
            if (!empty($entry)) {
                return $entry['tracking_url'];
            }
        } catch (Exception $e) {
            return null;
        }

        return null;
    }

    /**
     *  create new trackin entry
     *
     * @param $data
     *
     * @return mixed
     */
    public function saveTrackingResponse($trackingData)
    {
        $sql = "DELETE FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE shipment_id = '" . $this->db->escape($trackingData['shipment_id']) . "' AND tracking_id > 0 ";
        //remove existing cached data
        $this->db->query($sql);

        $sql = "INSERT INTO " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `shipment_id` = '" . $this->db->escape($trackingData['shipment_id']) . "',
                                        `refference_tracking_id` = '" . $this->db->escape($trackingData['refference_tracking_id']) . "',
                                        `shipment_status_response` = '" . $this->db->escape($trackingData['shipment_status_response']) . "',
                                        `tracking_url` = '" . $this->db->escape($trackingData['tracking_url']) . "'
                                        ";

        $this->db->query($sql);

        $shipmentId = $this->db->getLastId();

        return $shipmentId;
    }


}
