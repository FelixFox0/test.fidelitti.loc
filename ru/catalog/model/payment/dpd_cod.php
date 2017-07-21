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
class ModelPaymentDpdCOD extends Model
{

    /**
     * return the payment method
     *
     * @param $address
     * @param $total
     *
     * @return array
     */
    public function getMethod($address, $total)
    {
        $this->language->load('payment/dpd_cod');
        $status = false;

        //check the dpd shipping method
        $dpdService = $this->getSelectedShippingService();
        if (empty($dpdService)) {
            return;
        }

        $availableForServices = $this->_getSettingsModel()->getPaymentSettings('dpd_services', $this->config->get('config_store_id'));
        if (!is_array($availableForServices) || empty($availableForServices)) {
            return false;
        }
        if (!in_array($dpdService, $availableForServices)) {
            return;
        }

        // check if table rate was stored in session, else no payment
        // method will be available
        $shippingMethodData = $this->session->data['shipping_method'];
        if (empty($shippingMethodData['dpd_rate'])) {
            return;
        }
        $rate = $shippingMethodData['dpd_rate'];

        //dpd shipping method is disabled, wrong table rate entry
        if (empty($rate['shipping_method_enabled'])) {
            return;
        }

        //cod is disabled in tablerate or in settings
        if (empty($rate['cod_surcharge_calculation'])) {
            return;
        }

        //if no amount was provided
        if (!isset($rate['cod_surcharge_amount'])) {
            return;
        }
        $total = $this->cart->getSubTotal();
        $amount = floatval($rate['cod_surcharge_amount']);
        $price  = 0;
        switch (intval($rate['cod_surcharge_calculation'])) {
            //Cash On Delivery Not Available
            case 0: {
                break;
            }
            //Zero Surcharge
            case 1: {
                $price = 0;
                break;
            }
            //Fixed Surcharge
            case 2: {
                $price = $amount;
                break;
            }
            // Percentage Surcharge
            case 3: {
                $price = floatval($total) * floatval($amount) / 100;
                break;
            }

        }

        if (!empty($rate['cod_surcharge_min_amount']) && floatval($rate['cod_surcharge_min_amount']) > $price) {
            $price = floatval($rate['cod_surcharge_min_amount']);
        }

        $status = true;

        $method_data = array();
        if ($status) {
            $methodTitle = $this->getPaymentMethodTitle($dpdService);

            $method_data = array(
                'code'       => 'dpd_cod',
                'title'      => $methodTitle . ' (' . $this->currency->format($price, $this->session->data['currency'], 1) . ')',
                'sort_order' => $this->config->get('cod_sort_order'),
                'cost'       => $price,
                'terms' => ''
            );
        }

        return $method_data;
    }

    /**
     * extract current payment method title
     *
     * @param $dpdService
     *
     * @return mixed
     */
    protected function getPaymentMethodTitle($dpdService)
    {
        $storeId     = $this->config->get('config_store_id');
        $methodTitle = $this->_getSettingsModel()->getPaymentMethodTitle($dpdService, $storeId);
        if (empty($methodTitle)) {
            $methodTitle = $this->_getSettingsModel()->getPaymentSettings('method_title', $storeId);
        }

        if (empty($methodTitle)) {
            $methodTitle = $this->_getSettingsModel()->getPaymentMethodTitle($dpdService, 0);
        }

        if (empty($methodTitle)) {
            $methodTitle = $this->language->get('DPD payment - cash on delivery');
        }
        $description = $this->_getSettingsModel()->getFrontendSettings('payment', 'description');
        if (strlen($description) > 0) {
            $methodTitle .= '<span>' . description . '</span>';
        }

        return $methodTitle;
    }


    /**
     *
     */
    protected function extractPaymentPrice()
    {

    }


    /**
     * extract the dpd shipping service id
     *
     * @return bool
     */
    public function  getSelectedShippingService()
    {
        $shippingMethod = $this->getSelectedShippingMethod();
        if (empty($shippingMethod) || empty($shippingMethod['code'])) {
            return false;
        }
        $values = explode('zitec_dpd.zitec_dpd', $shippingMethod['code']);
        if (isset($values[1])) {
            return $values[1];
        }

        return false;
    }


    /**
     * return the selected shipping method for current cart in session
     *
     * @return mixed
     */
    public function getSelectedShippingMethod()
    {
        if (!isset($this->session->data['shipping_method'])) {
            return '';
        }

        return $this->session->data['shipping_method'];
    }


    /**
     *
     * @return Zitec_Dpd_Helper_Data
     */
    protected function _getSettingsModel()
    {
        if (empty($this->model_module_dpd_settings)) {
            $this->load->model('module/dpd/settings');
        }

        return $this->model_module_dpd_settings;
    }

}
