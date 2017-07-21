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
$_['heading_title'] = 'Table rates';

// Text
$_['text_shipping'] = 'Shipping';
$_['text_success']  = 'Success: You have modified flat rate shipping!';

$_['dpd_text_shipping'] = 'DPD Shipping Carrier';

// Button
$_['button_add_module'] = 'Add new';
$_['button_remove']     = 'Remove';


$_['column_store']                      = 'Store';
$_['column_dest_country']               = 'Dest. Country';
$_['column_dest_region']                = 'Dest. Region';
$_['column_dest_postcode']              = 'Dest. Postcode';
$_['column_condition']                  = 'Condition';
$_['column_condition_threshold']        = 'Condition threshold(and above)';
$_['column_shipping_price_calculation'] = 'Shipping price calculation';
$_['column_shipping_price_value']       = 'Shipping price value';
$_['column_cod_surcharge_calculation']  = 'Cash On Delivery Surcharge Calculation';
$_['column_cod_surcharge_amount']       = 'Cash On Delivery Surcharge amount';
$_['column_cod_surcharge_min_amount']   = 'Cash On Delivery Surcharge  minimum amount';
$_['column_shipping_method_enabled']    = 'Enable Shipping Method';
$_['column_dpd_service']                = 'DPD shipping service';
$_['column_action']                     = 'Action';


$_['Fixed Price'] = 'Fixed Price';

// Error
$_['error_permission']                     = 'Warning: You do not have permission to modify flat rate shipping!';
$_['table_rates_delete_nothing_to_delete'] = 'You have to select at least one rate to be removed.';
$_['table_rates_delete_text_success']      = 'The table rate was removed.';
$_['table_rates_delete_text_error']        = 'There was a problem while removing shipping rate.';

$_['table_rates_insert_text_success'] = 'The new shipping rate was saved.';
$_['table_rates_insert_text_error']   = 'There was a problem while saving table rate, or no changes applied';

$_['table_rates_update_text_success'] = 'The shipping rate was saved.';
$_['table_rates_update_text_error']   = 'There was a problem while saving table rate, or no changes applied';


$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);
