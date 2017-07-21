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
class ModelTotalDpdPayment extends Model
{


    /**
     * update here the total of checkout and add the subtotal dpd payment tax
     *
     * @param $total_data
     * @param $total
     * @param $taxes
     */
    public function getTotal($total)
    {
        if ($this->cart->hasShipping() && isset($this->session->data['shipping_method'])) {

            if (!isset($this->session->data['payment_method'], $this->session->data['payment_method']['cost'])) {
                return;
            }
            $this->load->model('module/dpd/settings');

            $totalTitle = $this->model_module_dpd_settings->getFrontendSettings('cod_subtotal_title', 'payment');
            if (empty($totalTitle)) {
                $totalTitle = $this->language->get('DPD cash on delivery');
            }

            $price        = $this->session->data['payment_method']['cost'];
            $total['totals'][] = array(
                'code'       => 'dpd_payment',
                'title'      => $totalTitle,
                'text'       => $this->currency->format($price, $this->session->data['currency'], 1),
                'value'      => $price,
                'sort_order' => $this->config->get('total_sort_order') - 1
            );
            $total['total'] += $price;
        }
    }

}
