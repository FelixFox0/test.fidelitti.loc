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
$_['heading_title'] = 'DPD Shipping Carrier';

// Text
$_['text_shipping'] = 'Shipping';
$_['text_success']  = 'Success: You have modified flat rate shipping!';

// Entry
$_['button_test']      = 'Test:';
$_['entry_store']      = 'Store:';
$_['entry_cost']       = 'Cost:';
$_['entry_tax_class']  = 'Tax Class:';
$_['entry_geo_zone']   = 'Geo Zone:';
$_['entry_status']     = 'Status:';
$_['entry_sort_order'] = 'Sort Order:';

// Button
$_['button_add_module'] = 'Add Module';
$_['button_remove']     = 'Remove';
$_['dpd_text_shipping'] = 'DPD Shipping Carrier';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify flat rate shipping!';

$_['shipping_settings_details'] = '';
$_['sender_settings_details']   = '';
$_['table_rates_details']       = '';


$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);