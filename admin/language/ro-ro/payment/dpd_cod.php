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
$_['heading_title'] = 'DPD Plata la livrare';

// Text
$_['text_payment'] = 'Plata';
$_['text_success'] = 'Succes: Ai modificat setarile modulului de plata DPD!';

// Entry
$_['entry_total']        = 'Total:<br /><span class="help">The checkout total the order must reach before this payment method becomes active.</span>';
$_['entry_order_status'] = 'Status comanda';

// Error
$_['error_permission'] = 'Warning: Nu ai drepturi sa modifici setarile modulului DPD!';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);