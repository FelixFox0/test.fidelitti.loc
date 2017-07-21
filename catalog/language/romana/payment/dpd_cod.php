<?php

// Text
$_['text_title']                     = 'Plata ramburs';
$_['DPD payment - cash on delivery'] = 'DPD plata - ramburs';

$temp = $this->load('shipping/zitec_dpd/general');
$temp = array_diff_key($temp, $_);
$_    = array_merge($_, $temp);