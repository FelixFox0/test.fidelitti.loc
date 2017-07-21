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


class ControllerDpdManifest extends Controller
{

    protected $_data = array();

    public function printmanifest()
    {
        $this->load->model('module/dpd/manifest');

        if (isset($this->request->get['manifest'])) {
            $manifest_id = $this->request->get['manifest'];
        } else {
            $manifest_id = 0;
        }

        $data = $this->model_module_dpd_manifest->getManifest($manifest_id);

        $pdfContent = $data['pdfManifestFile'];

        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="manifest_' . $data['manifestName'] . '.pdf"');
        echo(base64_decode($pdfContent));
        exit;
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