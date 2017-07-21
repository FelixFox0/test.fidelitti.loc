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
$_['heading_title'] = 'Shipping Settings';

// Text
$_['text_shipping'] = 'Shipping';
$_['text_success']  = 'Success: You have modified flat rate shipping!';

$_['dpd_text_shipping']           = 'DPD Shipping Carrier';
$_['method_title_label']          = 'Shipping method label';
$_['dpd_enabled_label']           = 'Enabled';
$_['postcode_autocomplete_label'] = 'Autocomplete/Autocorrect postcode enabled';
$_['zitecdpd_mode_label']         = 'Production mode enabled';
$_['wsurlproduction_label']       = 'Production url';
$_['wsurltest_label']             = 'Test url';
$_['ws_username_label']           = 'Username';
$_['ws_password_label']           = 'Password';
$_['ws_connection_timeout_label'] = 'Connection timeout';
$_['payer_id_label']              = 'Payer id';
$_['sender_id_label']             = 'Sender id';
$_['dpd_services']                = 'Services';
$_['dpd_services_predict']        = 'Services with predict';

$_['debug_label'] = 'Debug mode';
$_['debug_file_label'] = 'Debug file';

$_['save_settings_text_success'] = 'Module settings saved successfully';
$_['save_settings_text_error']   = 'There were some problems during the save process';


$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);