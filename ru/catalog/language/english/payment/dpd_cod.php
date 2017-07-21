<?php

// Text
$_['text_title']                     = 'Cash On Delivery';
$_['DPD payment - cash on delivery'] = 'DPD payment - cash on delivery';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);