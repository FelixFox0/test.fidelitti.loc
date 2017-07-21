<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-auspost" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a id="quick_save" onclick="return false;" data-toggle="tooltip" title="<?php echo $button_save_continue; ?>" id="quick_save" class="btn btn-info"><i class="fa fa-clipboard"></i></a>&nbsp;
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
 </div>
<div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
          </div>
          <div class="panel-body">
           <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-auspost" class="form-horizontal">
             <input type="file" class="import-csv" accept="text/csv" name="file" />
             <div class="row">
                    <div class="col-sm-2">
                      <ul id="method-list" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <?php
                            $xpayment['name']=(isset($xpayment['name']) && is_array($xpayment['name']))?$xpayment['name']:array();
                            foreach($xpayment['name'] as $no_of_tab=>$names){
                              if (!is_array($names))$names=array();
                              if (!isset($names[$language_id]) || !$names[$language_id]) {
                                 $names[$language_id]='Untitled Method '.$no_of_tab;
                               }
                               ?>
                          <li><a class="tab<?php echo $no_of_tab;?>" href="#xpayment-<?php echo $no_of_tab; ?>"  data-toggle="tab"><?php echo $names[$language_id];?></a></li>
                        <?php } ?>
                      </ul>
                      
                      <button class="btn btn-success add-new" data-toggle="tooltip" form="form-auspost" type="button"  data-placement="bottom"  data-original-title="<?php echo $text_add_new_method?>"><i class="fa fa-plus"></i></button>
                    </div>
	                
                  <div class="col-sm-10">
                    <div id="xpayment-container" class="tab-content">
                     <div class="tab-pane active" id="tab-general">
                           <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-sort-order"><span data-toggle="tooltip" title="<?php echo $tip_sorting_global; ?>"><?php echo $entry_sort_order; ?> </span></label>
                            <div class="col-sm-10">
                              <input type="text" name="xpayment_sort_order" value="<?php echo $xpayment_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                            </div>
                          </div>
                           <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="<?php echo $tip_status_global; ?>"><?php echo $module_status; ?></span></label>
                            <div class="col-sm-10">
                              <select name="xpayment_status" id="input-status" class="form-control">
                                <?php if ($xpayment_status) { ?>
                                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                  <option value="0"><?php echo $text_disabled; ?></option>
                                  <?php } else { ?>
                                  <option value="1"><?php echo $text_enabled; ?></option>
                                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                             </div>
                          </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-group-limit"><span data-toggle="tooltip" title="<?php echo $tip_debug; ?>"><?php echo $text_debug; ?></span></label>
                            <div class="col-sm-10">
                              <select name="xpayment_debug" class="form-control">
                               <?php if ($xpayment_debug) { ?>
                                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                  <option value="0"><?php echo $text_disabled; ?></option>
                                  <?php } else { ?>
                                  <option value="1"><?php echo $text_enabled; ?></option>
                                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                  <?php } ?>
                              </select>
                             </div>
                          </div>
                       </div> <!--end of tab general-->
                       <?php  echo $form_data;?>
                   </div>
                 </div>
               </div>      
            </form>
      </div>
    </div>
  </div>

<style type="text/css">
.xpayment-checkbox label{ margin-right: 15px;}
.xpayment-checkbox label input {
    margin-right: 5px;
	margin-bottom:4px;
}
.well-sm{ display:none;}
.well-days, .well-desc, .product-category, .product-product{ display:block;}
div.category, div.product, div.postal-option, div.range-option, div.coupon-option, div.manufacturer-option, div.dimensional-option{ display:none;}
label.any-class {
    margin-top: 4px;
}
.tbl-wrapper{ width:99%;}
.import-btn-wrapper{width:99%; height:auto; overflow:hidden; margin-bottom:10px;}
.import-btn-wrapper a.btn{ float:right;margin-right: 5px;}
input.import-csv[type="file"]{ display:none;}
div.xpayment {
    position: relative;
}
.action-btn {
    position: absolute;
    right: 0;
    top: -5px;
}
.action-btn button {
    margin-left: 5px;
}
button.add-new {
    margin-top: 10px;
}

div.tooltip div.tooltip-inner{ font-weight:normal !important; text-align:left !important;}
div.tooltip div.tooltip-inner b{ display:block !important;}
.global-waiting{display:block;position:fixed; width:124px; height:34px; text-align:center;font-size:18px;font-weight:bold; color:#ffffff;background-color:#D96E7C; border-radius:5px;padding-top:10px;}
.fa-minus-circle{ cursor:pointer;}
/* End of new*/

</style>
<script type="text/javascript"><!--
var current_tab=1;    
var range ='<tr>'; 
    range += '    <td class="text-left"><input size="15" type="text" name="xpayment[rate_start][__INDEX__][]" class="form-control" value="__VALUE_START__" /></td>';
    range += '    <td class="text-left"><input size="15" type="text" name="xpayment[rate_end][__INDEX__][]" class="form-control" value="__VALUE_END__" /></td>';
    range += '    <td class="text-left"><input size="15" type="text" name="xpayment[rate_total][__INDEX__][]" class="form-control" value="__VALUE_COST__" /></td>';
    range += '    <td class="text-left"><input size="6" type="text" name="xpayment[rate_block][__INDEX__][]" class="form-control" value="__VALUE_PG__" /></td>';
	range += '    <td class="text-left"><select name="xpayment[rate_partial][__INDEX__][]"><option __VALUE_PA1__ value="1"><?php echo $text_yes;?></option><option __VALUE_PA2__ value="0"><?php echo $text_no;?></option></select></td>';
    range += '    <td class="text-right"><a class="btn btn-danger remove-row"><?php echo $text_remove;?></a></td>';
    range += '  </tr>';
       
    
var tmp='<div id="__ID__" class="tab-pane xpayment">'
          +'<div class="action-btn">'
		     +'<button class="btn btn-warning btn-copy" data-toggle="tooltip" type="button" data-original-title="<?php echo $text_method_copy;?>"><i class="fa fa-copy"></i></button>'
			 +'<button class="btn btn-danger btn-delete" data-toggle="tooltip" type="button" data-original-title="<?php echo $text_method_remove;?>"><i class="fa fa-trash-o"></i></button>'
		   +'</div>'
          +'<ul class="nav nav-tabs" id="language__INDEX__">'
            <?php $inc=0; foreach ($languages as $language) { $active_cls=($inc==0)?'class="active"':''; $inc++; ?>
             +'<li <?php echo $active_cls; ?> ><a href="#language<?php echo $language['language_id']; ?>__INDEX__" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>'
            <?php } ?>
          +' </ul>'
		  +'<div class="tab-content">'
         <?php $inc=0;foreach ($languages as $language) { $active_cls=($inc==0)?' active':''; $lang_cls=($inc==0)?'':'-lang'; $inc++;  ?>
          +'<div class="tab-pane<?php echo $active_cls;?>" id="language<?php echo $language['language_id']; ?>__INDEX__">'
		      +'<div class="form-group required">'
				+'<label class="col-sm-2 control-label" for="lang-name-__INDEX__<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>'
				+'<div class="col-sm-10">'
				 +'<input type="text" name="xpayment[name][__INDEX__][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $entry_name; ?>" id="lang-name-__INDEX__<?php echo $language['language_id']; ?>" class="form-control method-name<?php echo $lang_cls?>" />'
				 +'</div>'
			  +'</div>'
			  +'<div class="form-group">'
				+'<label class="col-sm-2 control-label" for="lang-term-__INDEX__<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo addslashes($tip_payment_terms)?>"><?php echo $payment_terms; ?></span></label>'
				+'<div class="col-sm-10">'
				 +'<input type="text" name="xpayment[term][__INDEX__][<?php echo $language['language_id']; ?>]" value="" placeholder="<?php echo $payment_terms; ?>" id="lang-term-__INDEX__<?php echo $language['language_id']; ?>" class="form-control" />'
				 +'</div>'
			  +'</div>'
		      +'<div class="form-group">'
				+'<label class="col-sm-2 control-label" for="lang-instruction-__INDEX__<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo addslashes($tip_instruction)?>"><?php echo $entry_instruction; ?></span></label>'
				+'<div class="col-sm-10">'
				 +'<textarea class="form-control" id="lang-instruction-__INDEX__<?php echo $language['language_id']; ?>" name="xpayment[instruction][__INDEX__][<?php echo $language['language_id']; ?>]" rows="8" cols="70" /></textarea><?php echo $text_keyword;?>'
				 +'</div>'
			  +'</div>'
			  +'<div class="form-group">'
				+'<label class="col-sm-2 control-label" for="lang-email_instruction-__INDEX__<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo addslashes($tip_email_instruction)?>"><?php echo $text_instruction_email; ?></span></label>'
				+'<div class="col-sm-10">'
				 +'<textarea class="form-control" id="lang-email_instruction-__INDEX__<?php echo $language['language_id']; ?>" name="xpayment[email_instruction][__INDEX__][<?php echo $language['language_id']; ?>]" rows="8" cols="70" /></textarea><?php echo $text_keyword;?>'
				 +'</div>'
			  +'</div>'
	      +'</div>'
	  <?php } ?>
	  +'</div>'
      +'<ul class="nav nav-tabs" id="method-tab-__INDEX__">'
             +'<li class="active"><a href="#common___INDEX__" data-toggle="tab"><?php echo $text_general?></a></li>'
             +'<li><a href="#criteria___INDEX__" data-toggle="tab"><?php echo $text_criteria_setting?></a></li>'
             +'<li><a href="#catprod___INDEX__" data-toggle="tab"><?php echo $text_category_product?></a></li>'
             +'<li><a href="#price___INDEX__" data-toggle="tab"><?php echo $text_price_setting?></a></li>'
             +'<li><a href="#other___INDEX__" data-toggle="tab"><?php echo $text_others;?></a></li>'
           +'</ul>' 
		   +'<div class="tab-content">'
           +'<div class="tab-pane active" id="common___INDEX__">'
                +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-inc-email__INDEX__"><?php echo $text_inc_email; ?></label>'
                  +'<div class="col-sm-10"><input type="checkbox" name="xpayment[inc_email][__INDEX__]" value="1" class="form-control" id="input-inc-email__INDEX__" /></div>'
                +'</div>'
                 +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-inc-order__INDEX__"><?php echo $text_inc_order; ?></label>'
                  +'<div class="col-sm-10"><input type="checkbox" name="xpayment[inc_order][__INDEX__]" value="1" class="form-control" id="input-inc-order__INDEX__" /></div>'
                +'</div>'
                 +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-callback__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_order_status)?>"><?php echo $entry_order_status; ?> </span></label>'
                  +'<div class="col-sm-10"><select name="xpayment[order_status_id][__INDEX__]">'
                  <?php foreach ($order_statuses as $order_status) { ?>
                  +'<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>'
                  <?php } ?>
                  +'</select></div>'
                +'</div>'
                +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-logo__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_text_logo)?>"><?php echo $text_logo; ?> </span></label>'
                  +'<div class="col-sm-10"><input type="text" name="xpayment[logo][__INDEX__]" value="" class="form-control" id="input-logo__INDEX__" /></div>'
                +'</div>'
                +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-sortorder__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_sorting_own)?>"><?php echo $entry_sort_order; ?> </span></label>'
                  +'<div class="col-sm-10"><input type="text" name="xpayment[sort_order][__INDEX__]" value="" class="form-control" id="input-sortorder__INDEX__" /></div>'
                +'</div>'
                +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="input-status__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_status_own)?>"><?php echo $entry_status; ?></span></label>'
                  +'<div class="col-sm-10"><select class="form-control" id="input-status__INDEX__" name="xpayment[status][__INDEX__]">'
                  +'<option value="1" selected="selected"><?php echo $text_enabled; ?></option>'
                  +'<option value="0"><?php echo $text_disabled; ?></option>'
                  +'</select></div>'
                +'</div>'
            +'</div>'
            +'<div class="tab-pane" id="criteria___INDEX__">'
               +'<div class="form-group">'
                +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_store)?>"><?php echo $entry_store; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[store_all][__INDEX__]" class="choose-any" value="1" />&nbsp;<?php echo $text_any; ?></label>'
		            +'<div class="well well-sm" style="height: 70px; overflow: auto;">'
		             +'<div class="checkbox xpayment-checkbox">'
                     <?php 
                    foreach ($stores as $store) {
                     ?>
		              +'<label>'
                       +'<input type="checkbox" name="xpayment[store][__INDEX__][]" value="<?php echo $store['store_id']; ?>" /><?php echo addslashes($store['name']); ?>'
		             +'</label>'
                 <?php } ?>
                   +'</div>'
				   +'</div>'
	            +'</div>'
               +'</div>'
			   
			   +'<div class="form-group">'
                +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_geo)?>"><?php echo $entry_geo_zone; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[geo_zone_all][__INDEX__]" class="choose-any" value="1" />&nbsp;<?php echo $text_any; ?></label>'
		            +'<div class="well well-sm" style="height: 100px; overflow: auto;">'
		             +'<div class="checkbox xpayment-checkbox">'
                     <?php 
                    foreach ($geo_zones as $geo_zone) {
                     ?>
		              +'<label>'
                       +'<input type="checkbox" name="xpayment[geo_zone_id][__INDEX__][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" /><?php echo addslashes($geo_zone['name']); ?>'
		             +'</label>'
                 <?php } ?>
                   +'</div>'
				   +'</div>'
	            +'</div>'
               +'</div>'
			   
			    +'<div class="form-group">'
                +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_customer_group)?>"><?php echo $entry_customer_group; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[customer_group_all][__INDEX__]" class="choose-any" value="1" />&nbsp;<?php echo $text_any; ?></label>'
		            +'<div class="well well-sm" style="height: 70px; overflow: auto;">'
		             +'<div class="checkbox xpayment-checkbox">'
                     <?php 
                     foreach ($customer_groups as $customer_group) {
                     ?>
		              +'<label>'
                       +'<input type="checkbox" name="xpayment[customer_group][__INDEX__][]" value="<?php echo $customer_group['customer_group_id']; ?>" /><?php echo addslashes($customer_group['name']); ?>'
		             +'</label>'
                 <?php } ?>
                   +'</div>'
				   +'</div>'
	            +'</div>'
               +'</div>'
			   
			   +'<div class="form-group">'
                +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_shipping)?>"><?php echo $entry_shipping; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[shipping_all][__INDEX__]" class="choose-any" value="1" />&nbsp;<?php echo $text_any; ?></label>'
		            +'<div class="well well-sm" style="height: 70px; overflow: auto;">'
		             +'<div class="checkbox xpayment-checkbox">'
                     <?php 
                     foreach ($shipping_mods as $code=>$value) {
						   if (array_key_exists($code,$xpaymentshipping)) {
							   if(!isset($xpaymentshipping[$code])) $xpaymentshipping[$code]=array();
							   $prefix=$value;
							   foreach($xpaymentshipping[$code] as $code =>$value) {
					      ?>
					         +'<label>'
                            +'<input type="checkbox" name="xpayment[shipping][__INDEX__][]" value="<?php echo $code; ?>" /><?php echo $prefix.' - '.addslashes($value); ?>'
		                  +'</label>'
					   <?php 
								   
							   }
							   continue;
						   }
							   
                     ?>
		              +'<label>'
                       +'<input type="checkbox" name="xpayment[shipping][__INDEX__][]" value="<?php echo $code; ?>" /><?php echo addslashes($value); ?>'
		             +'</label>'
                 <?php } ?>
                   +'</div>'
				   +'</div>'
	            +'</div>'
               +'</div>'
			   +'<div class="form-group">'
                +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_manufacturer)?>"><?php echo $entry_manufacturer; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[manufacturer_all][__INDEX__]" class="choose-any-with" rel="manufacturer-option" value="1" />&nbsp;<?php echo $text_any; ?></label>'
		            +'<div class="well well-sm" style="height: 100px; overflow: auto;">'
		             +'<div class="checkbox xpayment-checkbox">'
                     <?php 
                    foreach ($manufacturers as $manufacturer) {
                     ?>
		              +'<label>'
                       +'<input type="checkbox" name="xpayment[manufacturer][__INDEX__][]" value="<?php echo $manufacturer['manufacturer_id']; ?>" /><?php echo addslashes($manufacturer['name']); ?>'
		             +'</label>'
                 <?php } ?>
                   +'</div>'
				   +'</div>'
	            +'</div>'
               +'</div>'
                +'<div class="form-group manufacturer-option">'
                +'<label class="col-sm-2 control-label" for="input-make-rule__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_manufacturer_rule)?>"><?php echo $text_manufacturer_rule?></span></label>'
                +'<div class="col-sm-10"><select class="form-control" id="input-make-rule__INDEX__" name="xpayment[manufacturer_rule][__INDEX__]">'
                   +'<option value="2"><?php echo $text_manufacturer_all; ?></option>'
		           +'<option value="3"><?php echo $text_manufacturer_least_with_other; ?></option>'
		           +'<option value="6"><?php echo $text_manufacturer_least; ?></option>'
		           +'<option value="4"><?php echo $text_manufacturer_exact; ?></option>'
		           +'<option value="5"><?php echo $text_manufacturer_except; ?></option>'
				   +'<option value="7"><?php echo $text_manufacturer_except_other; ?></option>'
                  +'</select></div>'
               +'</div>'
			   
			   +'<div class="form-group">'
                +'<label class="col-sm-2 control-label" for="input-postal__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_zip)?>"><?php echo $text_zip_postal; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[postal_all][__INDEX__]" class="choose-any-with" rel="postal-option" value="1" id="input-postal__INDEX__" /><?php echo $text_any; ?></label>'
	            +'</div>'
               +'</div>'
               +'<div class="form-group postal-option">'
                +'<label class="col-sm-2 control-label" for="input-zip__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_postal_code)?>"><?php echo $text_enter_zip?></span></label>'
                +'<div class="col-sm-10"><textarea class="form-control" id="input-zip__INDEX__" name="xpayment[postal][__INDEX__]" rows="8" cols="70" /></textarea></div>'
               +'</div>'
               +'<div class="form-group postal-option">'
                +'<label class="col-sm-2 control-label" for="input-zip-rule__INDEX__"><?php echo $text_zip_rule?></label>'
                +'<div class="col-sm-10"><select class="form-control" id="input-zip-rule__INDEX__" name="xpayment[postal_rule][__INDEX__]">'
                    +'<option value="inclusive"><?php echo $text_zip_rule_inclusive?></option>'
                    +'<option value="exclusive"><?php echo $text_zip_rule_exclusive?></option>'
                  +'</select></div>'
               +'</div>'  
			   
			    +'<div class="form-group">'
                +'<label class="col-sm-2 control-label" for="input-coupon__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_coupon)?>"><?php echo $text_coupon; ?></span></label>' 
                 +'<div class="col-sm-10">'
		            +'<label class="any-class"><input checked type="checkbox" name="xpayment[coupon_all][__INDEX__]" class="choose-any-with" rel="coupon-option" value="1" id="input-coupon__INDEX__" /><?php echo $text_any; ?></label>'
	            +'</div>'
               +'</div>'
               +'<div class="form-group coupon-option">'
                +'<label class="col-sm-2 control-label" for="input-coupon-here__INDEX__"><?php echo $text_enter_coupon?></label>'
                +'<div class="col-sm-10"><textarea class="form-control" id="input-coupon-here__INDEX__" name="xpayment[coupon][__INDEX__]" rows="8" cols="70" /></textarea></div>'
               +'</div>'
               +'<div class="form-group coupon-option">'
                +'<label class="col-sm-2 control-label" for="input-coupon-rule__INDEX__"><?php echo $text_coupon_rule?></label>'
                +'<div class="col-sm-10"><select class="form-control" id="input-coupon-rule__INDEX__" name="xpayment[coupon_rule][__INDEX__]">'
                    +'<option value="inclusive"><?php echo $text_coupon_rule_inclusive?></option>'
                    +'<option value="exclusive"><?php echo $text_coupon_rule_exclusive?></option>'
                  +'</select></div>'
               +'</div>'
         +'</div>' 
         +'<div class="tab-pane" id="catprod___INDEX__">'
	        +'<div class="form-group">'
              +'<label class="col-sm-2 control-label" for="input-cat-rule__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_category)?>"><?php echo $text_category; ?></span></label>'
              +'<div class="col-sm-10"><select id="input-cat-rule__INDEX__" class="form-control selection" rel="category" name="xpayment[category][__INDEX__]">'
                  +'<option value="1"><?php echo $text_category_any; ?></option>'
                  +'<option value="2"><?php echo $text_category_all; ?></option>'
		          +'<option value="3"><?php echo $text_category_least_with_other; ?></option>'
		          +'<option value="6"><?php echo $text_category_least; ?></option>'
		          +'<option value="4"><?php echo $text_category_exact; ?></option>'
		          +'<option value="5"><?php echo $text_category_except; ?></option>'
				   +'<option value="7"><?php echo $text_category_except_other; ?></option>'
                +'</select></div>'
            +'</div>'
			 +'<div class="form-group category">'
              +'<label class="col-sm-2 control-label" for="input-mul-cat-rule__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_multi_category)?>"><?php echo $text_multi_category; ?></span></label>'
              +'<div class="col-sm-10"><select id="input-mul-cat-rule__INDEX__" class="form-control" name="xpayment[multi_category][__INDEX__]">'
                  +'<option value="all"><?php echo $entry_all; ?></option>'
                  +'<option value="any"><?php echo $entry_any; ?></option>'
                +'</select></div>'
            +'</div>'
	        +'<div class="form-group category">'
              +'<label class="col-sm-2 control-label" for="input-category__INDEX__"><?php echo $entry_category; ?></label>'
              +'<div class="col-sm-10"><input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category__INDEX__" class="form-control" />'
			     +'<div class="well well-sm product-category" style="height: 150px; overflow: auto;">'
				 +'</div>'
			   +'</div>'
            +'</div>'
            +'<div class="form-group">'
              +'<label class="col-sm-2 control-label" for="input-product_rule__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_product)?>"><?php echo $text_product; ?></span></label>'
              +'<div class="col-sm-10"><select id="input-product_rule__INDEX__" class="form-control selection" rel="product" name="xpayment[product][__INDEX__]">'
                  +'<option value="1"><?php echo $text_product_any; ?></option>'
                  +'<option value="2"><?php echo $text_product_all; ?></option>'
	              +'<option value="3"><?php echo $text_product_least_with_other; ?></option>'
	              +'<option value="6"><?php echo $text_product_least; ?></option>'
	              +'<option value="4"><?php echo $text_product_exact; ?></option>'
	              +'<option value="5"><?php echo $text_product_except; ?></option>'
				   +'<option value="7"><?php echo $text_product_except_other; ?></option>'
                +'</select></div>'
             +'</div>'
			  +'<div class="form-group product">'
              +'<label class="col-sm-2 control-label" for="input-product__INDEX__"><?php echo $entry_product; ?></label>'
              +'<div class="col-sm-10"><input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product__INDEX__" class="form-control" />'
			     +'<div class="well well-sm product-product" style="height: 150px; overflow: auto;">'
				 +'</div>'
			   +'</div>'
            +'</div>'
          +'</div>'
         +'<div class="tab-pane" id="price___INDEX__">'
			+'<div class="form-group">'
             +'<label class="col-sm-2 control-label" for="input-total__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_total)?>"><?php echo $entry_order_total?></span></label>'
             +'<div class="col-sm-10">'
                  +'<div class="row-fluid">'
                     +'<div class="col-sm-5">'
                       +'<input size="15" class="form-control" type="text" name="xpayment[order_total_start][__INDEX__]" value="" />'
                     +'</div>'
                    +'<div class="col-sm-1"><?php echo $entry_to?></div>'
                    +'<div class="col-sm-5">'
                       +'<input class="form-control" size="15" type="text" name="xpayment[order_total_end][__INDEX__]" value="" />'
                    +'</div>'
                  +'</div>'
              +'</div>'
           +'</div>'
		   +'<div class="form-group">'
            +'<label class="col-sm-2 control-label" for="input-total__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_weight)?>"><?php echo $entry_order_weight?></span></label>'
             +'<div class="col-sm-10">'
                  +'<div class="row-fluid">'
                     +'<div class="col-sm-5">'
                       +'<input size="15" class="form-control" type="text" name="xpayment[weight_start][__INDEX__]" value="" />'
                     +'</div>'
                    +'<div class="col-sm-1"><?php echo $entry_to?></div>'
                    +'<div class="col-sm-5">'
                       +'<input class="form-control" size="15" type="text" name="xpayment[weight_end][__INDEX__]" value="" />'
                    +'</div>'
                  +'</div>'
              +'</div>'
           +'</div>'
		   +'<div class="form-group">'
           +'<label class="col-sm-2 control-label" for="input-total__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_quantity)?>"><?php echo $entry_quantity?></span></label>'
             +'<div class="col-sm-10">'
                  +'<div class="row-fluid">'
                     +'<div class="col-sm-5">'
                       +'<input size="15" class="form-control" type="text" name="xpayment[quantity_start][__INDEX__]" value="" />'
                     +'</div>'
                    +'<div class="col-sm-1"><?php echo $entry_to?></div>'
                    +'<div class="col-sm-5">'
                       +'<input class="form-control" size="15" type="text" name="xpayment[quantity_end][__INDEX__]" value="" />'
                    +'</div>'
                  +'</div>'
              +'</div>'
           +'</div>'	
		  +'</div>'
           +'<div class="tab-pane" id="other___INDEX__">'
             +'<div class="form-group">'
                  +'<label class="col-sm-2 control-label" for="total-without-coupon__INDEX__"><?php echo $total_without_coupon; ?></label>'
                  +'<div class="col-sm-10"><input type="checkbox" name="xpayment[without_coupon][__INDEX__]" value="1" class="form-control" id="total-without-coupon__INDEX__" /></div>'
             +'</div>'
             +'<div class="form-group">'
              +'<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo addslashes($tip_day)?>"><?php echo $text_days_week?></span></label>'
              +'<div class="col-sm-10">'
			      +'<div class="well well-sm well-days" style="height: 60px; overflow: auto;">'
				    +'<div class="checkbox xpayment-checkbox">' 
				      +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="0" />&nbsp; <?php echo $text_sunday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="1" />&nbsp; <?php echo $text_monday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="2" />&nbsp; <?php echo $text_tuesday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="3" />&nbsp; <?php echo $text_wednesday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="4" />&nbsp; <?php echo $text_thursday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="5" />&nbsp; <?php echo $text_friday?></label>'
                    +'<label><input name="xpayment[days][__INDEX__][]" checked type="checkbox" value="6" />&nbsp; <?php echo $text_saturday?></label>'
					 +'</div>'
					+'</div>' 
                +'</div>'
             +'</div>'
            +'<div class="form-group">'
                +'<label class="col-sm-2 control-label" for="input-time-start__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_time)?>"><?php echo $text_time_period?></span></label>'
                +'<div class="col-sm-10">'
				    +'<div class="row">'
					    +'<div class="col-sm-4">'
						   +'<select id="input-time-start__INDEX__" class="form-control" name="xpayment[time_start][__INDEX__]">'
						  +'<option value=""><?php echo $text_any; ?></option>'
						  <?php for($i = 1; $i <= 24; $i++) { ?>
						  +'<option value="<?php echo $i; ?>"><?php echo date("h:i A", strtotime("$i:00")); ?></option>'
						  <?php } ?>
						  +'</select>'
				       +'</div>'
				       +'<div class="col-sm-4">'
						  +'<select class="form-control" name="xpayment[time_end][__INDEX__]">'
						  +'<option value=""><?php echo $text_any; ?></option>'
						  <?php for($i = 1; $i <= 24; $i++) { ?>
						  +'<option value="<?php echo $i; ?>"><?php echo date("h:i A", strtotime("$i:00")); ?></option>'
						  <?php } ?>
						 +'</select>'
				         +'</div>'
				       +'</div>'
				      +'</div>'
				     +'</div>'
				      +'<div class="form-group">'
                  		+'<label class="col-sm-2 control-label" for="input-success__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_success)?>"><?php echo $entry_success; ?> </span></label>'
                 		+'<div class="col-sm-10"><input type="text" name="xpayment[success][__INDEX__]" value="" class="form-control" id="input-success__INDEX__" /></div>'
               		 +'</div>'
               		 +'<div class="form-group">'
                 		+'<label class="col-sm-2 control-label" for="input-callback__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_callback)?>"><?php echo $entry_callback; ?> </span></label>'
                        +'<div class="col-sm-10"><input type="text" name="xpayment[callback][__INDEX__]" value="" class="form-control" id="input-callback__INDEX__" /></div>'
                     +'</div>'
                     +'<div class="form-group">'
                       +'<label class="col-sm-2 control-label" for="input-redirect__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($tip_redirect)?>"><?php echo $entry_redirect; ?> </span></label>'
                       +'<div class="col-sm-10"><input type="text" name="xpayment[redirect][__INDEX__]" value="" class="form-control" id="input-redirect__INDEX__" /></div>'
                     +'</div>'
                     +'<div class="form-group">'
                       +'<label class="col-sm-2 control-label" for="input-redirect_type__INDEX__"><span data-toggle="tooltip" title="<?php echo $tip_redirect_data; ?>"><?php echo $entry_redirect_type; ?></span></label>'
                       +'<div class="col-sm-10"><select class="form-control" id="input-redirect_type__INDEX__" name="xpayment[redirect_type][__INDEX__]">'
                       +'<option value="post" selected><?php echo $entry_redirect_post; ?></option>'
					   +'<option value="get"><?php echo $entry_redirect_get; ?></option>'
                      +'</select></div>'
                     +'</div>'
                    +'<div class="form-group">'
                      +'<label class="col-sm-2 control-label" for="redirect-field__INDEX__"><?php echo $text_redirect_fields; ?></label>'
                      +'<div class="col-sm-10"><textarea class="form-control" id="redirect-field__INDEX__" name="xpayment[redirect_data][__INDEX__]" rows="5" cols="70" /></textarea><?php echo addslashes($text_redirect_hints); ?></div>'
                    +'</div>'
                    +'<div class="form-group">'
                     +'<label class="col-sm-2 control-label" for="redirect-success__INDEX__"><?php echo $text_success_condition; ?></label>'
                     +'<div class="col-sm-10"><textarea class="form-control" id="redirect-success__INDEX__" name="xpayment[redirect_success][__INDEX__]" rows="2" cols="70" /></textarea><?php echo addslashes($text_success_condition_hints); ?></div>'
                    +'</div>'
                    +'<div class="form-group">'
                  		+'<label class="col-sm-2 control-label" for="input-email__INDEX__"><span data-toggle="tooltip" title="<?php echo addslashes($additional_email_tip)?>"><?php echo $additional_email; ?> </span></label>'
                  		+'<div class="col-sm-10"><input type="text" name="xpayment[email][__INDEX__]" value="" class="form-control" id="input-email__INDEX__" /></div>'
                	+'</div>'
               +'</div>'
		     +'</div>' 
           +'</div>';


 var auto_complete_cat={
				'source': function(request, response) {
					$.ajax({
						url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
						dataType: 'json',			
						success: function(json) {
							response($.map(json, function(item) {
								return {
									label: item['name'],
									value: item['category_id']
								}
							}));
						}
					});
				},
				'select': function(item) {
					
					var my_method_area=$('#xpayment-'+current_tab);
					$('input[name=\'category\']',my_method_area).val('');
					$('.product-category' + item['value'],my_method_area).remove();
					$('.product-category',my_method_area).append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="xpayment[product_category]['+current_tab+'][]" value="' + item['value'] + '" /></div>');	
					
				}
	};
	
 var auto_complete_prod={
	 'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	 'select': function(item) {
		 
		var my_method_area=$('#xpayment-'+current_tab); 
		$('input[name=\'product\']', my_method_area).val('');
		$('.product-product' + item['value'], my_method_area).remove();
		$('.product-product', my_method_area).append('<div id="product-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="xpayment[product_product]['+current_tab+'][]" value="' + item['value'] + '" /></div>');	
	  }	
  };

   
$(document).ready(function () {		
 
	 /* Enable tab*/
	 $('#method-list a:first').tab('show');
	 $('#language-heading a:first').tab('show');
	 
	 $("#method-list").on("click","li",function(){
		 current_tab=$(this).find('a').attr('href').replace('#xpayment-','');  
	 });
	 
	 /* Creating New method*/
	 $('.add-new').on('click',function(e) {
		  e.preventDefault();
		  $this=$(this);
		  var no_of_tab=$('#xpayment-container').find('div.xpayment').length;
		  no_of_tab=parseInt(no_of_tab)+1;
		  //finding qnique id
		  while($('#xpayment-'+no_of_tab).length!=0)
		   {
		     no_of_tab++;
		   }
		  var tab_html=tmp;
		  tab_html=tab_html.replace('__ID__','xpayment-'+no_of_tab);
		  tab_html=tab_html.replace(/__INDEX__/g, no_of_tab);
		  $('#xpayment-container').append(tab_html);
		  
		  $('#method-list').append('<li><a data-toggle="tab" class="tab'+no_of_tab+'" href="#xpayment-'+no_of_tab+'">Untitled Method '+no_of_tab+'</a></li>');
		   enableEvents(no_of_tab); 
		   current_tab=no_of_tab;
      });
	 /* End of creating new*/
	 
	 $("#xpayment-container").on('click','button.btn-delete', function() { 
		  if(confirm('Are you sure to delete this method?')){
					  $('a.tab'+current_tab).remove();
					  $('#xpayment-'+current_tab).remove();
					  $('#method-list a:first').tab('show');
					  
				}
	 });
	 
	 $("#xpayment-container").on('click','button.btn-copy', function() { 
		  if(confirm('Are you sure to copy this method?')){
					  copyMethod(current_tab);
				}
	 });
	 
	 
	   $('.xpayment_group').change(function(){
		   if($(this).val()=='lowest' || $(this).val()=='highest') {
			  $('#group-limit').show();  
		   }else{
			  $('#group-limit').hide();     
		   }  
		});
	   
       
	   $("#xpayment-container").on('keyup','input.method-name', function() {		
		  var method_name=$(this).val();
		  if(method_name=='')method_name='Untitled Method '+tabId;
		  $('a.tab'+current_tab).html(method_name);
	   }); 
	   
	   
	    $("#xpayment-container").on('change','select.selection', function() {
		    
			var relto=$(this).attr('rel');
			 if($(this).val()=='1'){
			    $(this).closest('div.form-group').siblings('div.'+relto).hide();  
			 }else{
			    $(this).closest('div.form-group').siblings('div.'+relto).show();  
			 }
		 }); 
		 
		 $('#xpayment-container').delegate('.fa-minus-circle', 'click', function() {
			  $(this).parent().remove();
	     });
		
		  // Category selection
		  $('input[name=\'category\']').autocomplete(auto_complete_cat);
		  $('input[name=\'product\']').autocomplete(auto_complete_prod);
			
		  $("#xpayment-container").on('click', '.choose-any', function() {
				 if($(this).prop('checked')){
					 $(this).parent().next('div.well-sm').slideUp();  
				 }else{
					 $(this).parent().next('div.well-sm').slideDown();
				}
			});
			
		  $("#xpayment-container").on('click', '.choose-any-with', function() {
                var relto=$(this).attr('rel');	
				
				if(relto=='manufacturer-option') {
					 if($(this).prop('checked')){
						 $(this).parent().next('div.well-sm').slideUp();  
					 }else{
						 $(this).parent().next('div.well-sm').slideDown();
					 }
				 }
				
				 if($(this).prop('checked')){
					 $(this).closest('div.form-group').siblings('div.'+relto).hide();  
				 }else{
					$(this).closest('div.form-group').siblings('div.'+relto).show();  
				}
			});
                
		
    
		
        /*Quick save*/
        $('#quick_save').click(function(){
			    $('body').append('<div class="global-waiting">Saving...</div>');
			    $('.global-waiting').css({top:'50%',left:'50%',marginTop:'-40px',marginLeft:'-75px'});
				$.ajax({
					url: 'index.php?route=extension/payment/xpayment/quick_save&token=<?php echo $token; ?>',
					dataType: 'json',
                    data:$('#form-auspost').serialize(),
                    type:'POST',
					  success: function(json) {		
					   
					    if (json['error']) {
                            alert(json['error']);
                        }
                       $('.global-waiting').remove();	  
					}
				});
		});           
       
	    
 });
 
 function enableEvents(no_of_tab){ 
		  /* new */
		  var my_method_area=$('#xpayment-'+no_of_tab);
         $('#method-list a.tab'+no_of_tab).trigger('click');
		  $('#language'+no_of_tab+' li:first-child').trigger('click');
		  $('#method-tab-'+no_of_tab+' li:first-child').trigger('click');
		  $("[data-toggle='tooltip']",my_method_area).tooltip(); 
		  $('input[name=\'category\']', my_method_area).autocomplete(auto_complete_cat);
		  $('input[name=\'product\']', my_method_area).autocomplete(auto_complete_prod);	  
 }
 
 function copyMethod(tabId){
 
 
       var no_of_tab=$('#xpayment-container').find('div.xpayment').length;
	      no_of_tab=parseInt(no_of_tab)+1;
	      //finding qnique id
	      while($('#xpayment-'+no_of_tab).length!=0)
	      {
		   no_of_tab++;
	      }
          
          var tab_item=$('#xpayment-'+tabId).clone()
          var tab_html='<div id="xpayment-'+no_of_tab+'" class="tab-pane xpayment">'+tab_item.html()+'</div>';
          
		   
 		  tab_html = tab_html.replace(/xpayment\[([a-z_]+)\]\[\d+\]/igm, 'xpayment[$1]['+no_of_tab+']');
 		  tab_html = tab_html.replace(/_(\d+)/g, '_'+no_of_tab); 
          
		  $('#xpayment-container').append(tab_html); 
		  
		  var inputs_text = $('#xpayment-'+tabId+' input[type="text"]');
		  var inputs_text_new = $('#xpayment-'+no_of_tab+' input[type="text"]');
		  
		  var inputs_checkboxes = $('#xpayment-'+tabId+' input[type="checkbox"]');
		  var inputs_checkboxes_new = $('#xpayment-'+no_of_tab+' input[type="checkbox"]');
		  
		  var inputs_selects = $('#xpayment-'+tabId+' select');
		  var inputs_selects_new = $('#xpayment-'+no_of_tab+' select');
		  
		  inputs_text.each(function(index) {
              inputs_text_new.eq(index).val($(this).val());
          });
          
          inputs_selects.each(function(index) {
              inputs_selects_new.eq(index).val($(this).val());
          });
          
          inputs_checkboxes.each(function(index) {
              if($(this).prop('checked')) {
                inputs_checkboxes_new.eq(index).prop('checked','checked');
              } else {
                inputs_checkboxes_new.eq(index).removeAttr('checked');
              }   
          });
	
	
		  $('#method-list').append('<li><a data-toggle="tab" class="tab'+no_of_tab+'" href="#xpayment-'+no_of_tab+'">'+$('a.tab'+tabId).html()+'</a></li>');
		  enableEvents(no_of_tab);
		  current_tab=no_of_tab;
 }

 
//--></script>
</div>
<?php echo $footer; ?>