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
$_['heading_title'] = 'Setari livrare';

// Text
$_['text_shipping'] = 'Livrare';

$_['dpd_text_shipping']           = 'DPD Shipping Carrier';
$_['method_title_label']          = 'Titlul metodei de livrare';
$_['dpd_enabled_label']           = 'Activ';
$_['postcode_autocomplete_label'] = 'Auto-validarea codului postal activa';
$_['zitecdpd_mode_label']         = 'Activ in modul productie';
$_['wsurlproduction_label']       = 'URL productie';
$_['wsurltest_label']             = 'URL testare';
$_['ws_username_label']           = 'Username';
$_['ws_password_label']           = 'Password';
$_['ws_connection_timeout_label'] = 'Connection timeout';
$_['payer_id_label']              = 'Payer id';
$_['sender_id_label']             = 'Sender id';
$_['dpd_services']                = 'Servicii';
$_['dpd_services_predict']        = 'Servicii cu alerte SMS';
$_['debug_label']                 = 'Mod debug';
$_['debug_file_label']            = 'Fisier debugging';

$_['save_settings_text_success'] = 'Setarile modulului DPD au fost salvate';
$_['save_settings_text_error']   = 'Au aparut probleme in timpul salvarii setarilor';


$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);