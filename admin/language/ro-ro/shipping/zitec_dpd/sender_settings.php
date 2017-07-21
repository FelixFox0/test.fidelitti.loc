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

$_['dpd_text_shipping'] = 'DPD Shipping Carrier';
$_['dpd_enabled_label'] = 'Activ';


$_['sender_name_label']     = 'Nume expeditor';
$_['additional_name_label'] = 'Nume aditional';
$_['street_label']          = 'Strada';
$_['city_name_label']       = 'Oras';
$_['postcode_label']        = 'Cod postal';
$_['country_label']         = 'Tara';
$_['telephone_label']       = 'Telefon';
$_['email_address_label']   = 'Email';

$_['save_settings_text_success'] = 'Setarile modulului DPD au fost salvate';
$_['save_settings_text_error']   = 'Au fost unele probleme in timpul salvarii setarilor.';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);