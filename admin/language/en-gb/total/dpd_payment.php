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
 * @authod     george.babarus
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

// Heading
$_['heading_title'] = 'DPD Plati';

// Text
$_['text_total']   = 'Total comenzi';
$_['text_success'] = 'Success: You have modified shipping total!';

// Entry
$_['entry_estimator']  = 'Shipping Estimator:';
$_['entry_status']     = 'Status:';
$_['entry_sort_order'] = 'Sort Order:';

// Error
$_['error_permission']     = 'Warning: Nu ai drepturi sa motifici totalul!';
$_['DPD cash on delivery'] = 'Plata ramburs DPD';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);