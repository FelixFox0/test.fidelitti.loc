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
class ModelModuleDpdManifest extends Model
{

    const TABLE_NAME = 'zitec_dpd_manifest';


    public function saveManifest($data)
    {

        $sql = "INSERT INTO " . DB_PREFIX . self::TABLE_NAME . " SET
                                        `dpd_manifest_id` = '" . $this->db->escape($data['dpd_manifest_id']) . "',
                                        `manifestReferenceNumber` = '" . $this->db->escape($data['manifestReferenceNumber']) . "',
                                        `manifestName` = '" . $this->db->escape($data['manifestName']) . "',
                                        `shipments` = '" . $this->db->escape($data['shipments']) . "',
                                        `pdfManifestFile` = '" . $this->db->escape($data['pdfManifestFile']) . "'
                                        ";

        $this->db->query($sql);

        $shipmentId = $this->db->getLastId();

        return $shipmentId;


    }

    /**
     * return the manifest
     *
     * @param $order_id
     *
     * @return bool
     */
    public function getManifest($manifest_id)
    {
        $sql   = "SELECT * FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE manifest_id = '" . $this->db->escape($manifest_id) . "' LIMIT 1 ";
        $query = $this->db->query($sql);
        $entry = $query->row;
        if (!empty($entry)) {
            return $entry;
        }

        return false;

    }


    /**
     * return the manifest in $ids
     *
     * @param $ids
     *
     * @return bool
     */
    public function getManifestList($ids)
    {
        if (empty($ids)) {
            return false;
        }
        $filteredData = array();
        foreach ($ids as $key => $value) {
            $filteredData[$key] = $this->db->escape($value);
        }
        $ids = $filteredData;
        $sql = "SELECT
                      `manifest_id`,
                      `dpd_manifest_id`,
                      `transaction_id`,
                      `manifestReferenceNumber`,
                      `manifestName`,
                      `manifestPrintData`,
                      `error`,
                      `shipments`
                      FROM " . DB_PREFIX . self::TABLE_NAME . " WHERE manifest_id IN ('" . implode("','", $ids) . "') ";

        $query  = $this->db->query($sql);
        $result = array();
        foreach ($query->rows as $manifest) {
            $result[$manifest['manifest_id']] = $manifest;
        }

        return $result;
    }

}
