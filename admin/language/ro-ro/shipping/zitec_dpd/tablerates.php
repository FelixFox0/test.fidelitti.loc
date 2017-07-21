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
$_['heading_title'] = 'Tabel de taxare';

// Text
$_['text_shipping'] = 'Livrare';
$_['text_success']  = 'Succes: Setarile au fost salvate';

$_['dpd_text_shipping'] = 'DPD Shipping Carrier';

// Button
$_['button_add_module'] = 'Adauga';
$_['button_remove']     = 'Sterge';


$_['column_store']                      = 'Magazin';
$_['column_dest_country']               = 'Tara Dest.';
$_['column_dest_region']                = 'Regiune/judet Dest.';
$_['column_dest_postcode']              = 'Cod postal Dest.';
$_['column_condition']                  = 'Conditie';
$_['column_condition_threshold']        = 'Prag conditie (si mai mult)';
$_['column_shipping_price_calculation'] = 'Calularea pretului de livrare';
$_['column_shipping_price_value']       = 'Valoarea pretului de livrare';
$_['column_cod_surcharge_calculation']  = 'Tip taxare plata ramburs';
$_['column_cod_surcharge_amount']       = 'Valoare taxa plata ramburs';
$_['column_cod_surcharge_min_amount']   = 'Pret minim plata ramburs';
$_['column_shipping_method_enabled']    = 'Disponibil pentru serviciile';
$_['column_dpd_service']                = 'Servicii de livrare DPD';
$_['column_action']                     = 'Action';


$_['Fixed Price'] = 'Pret fix';

// Error
$_['table_rates_delete_nothing_to_delete'] = 'Trebuie sa selectezi cel putin o rata pentru a sterge';
$_['table_rates_delete_text_success']      = 'Rata a fost stearsa';
$_['table_rates_delete_text_error']        = 'A aparut o problema in timpul stergerii';

$_['table_rates_insert_text_success'] = 'Noua rata de taxare a fost salvata';
$_['table_rates_insert_text_error']   = 'A aparut o eroare in timpul salvarii';


$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);
