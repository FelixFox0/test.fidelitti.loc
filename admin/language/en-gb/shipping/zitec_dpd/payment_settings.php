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

// Heading
$_['heading_title']     = 'Payment settings';
$_['dpd_text_shipping'] = 'DPD Shipping Carrier';

// Text
$_['text_shipping'] = 'Shipping';
$_['text_success']  = 'Success: You have modified flat rate shipping!';


// Button
$_['button_add_module'] = 'Add new';
$_['button_remove']     = 'Remove';

$_['dpd_enabled_label']  = 'Enabled';
$_['description_label']  = 'Description';
$_['method_title_label'] = 'Payment method title';
$_['dpd_services']       = 'Available for DPD shipping services';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);