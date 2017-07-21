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
$_['heading_title'] = 'Sender Settings';

// Text
$_['text_shipping'] = 'Shipping';
$_['text_success']  = 'Success: You have modified flat rate shipping!';

$_['dpd_text_shipping']  = 'DPD Shipping Carrier';
$_['method_title_label'] = 'Shipping method label';
$_['dpd_enabled_label']  = 'Enabled';


$_['sender_name_label']     = 'Sender name';
$_['additional_name_label'] = 'Additional name';
$_['street_label']          = 'Street';
$_['city_name_label']       = 'City';
$_['postcode_label']        = 'Postcode';
$_['country_label']         = 'Country';
$_['telephone_label']       = 'Telephone';
$_['email_address_label']   = 'Email';



$_['save_settings_text_success'] = 'Module settings saved successfully';
$_['save_settings_text_error']   = 'There were some problems during the save process';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);