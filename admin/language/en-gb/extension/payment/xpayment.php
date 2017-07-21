<?php

$_['heading_title']    = 'X-Payment';
$_['tab_general']    = 'General Setting';
$_['tab_rate']    = 'Method Setting';

// Text 
$_['text_extension']  = 'Extensions';
$_['text_payment']    = 'Payment';
$_['module_status']    = 'Module Status';
$_['text_success']     = 'Success: You have modified X-Payment!';
$_['text_edit']    = 'Configure Your X-Payment';
$_['text_add_new_method']    = 'Add New Payment';

$_['text_select_all']    = 'Select All';
$_['text_unselect_all']    = 'Unselect All';
$_['text_any']    = 'For Any';

$_['text_zip_postal']    = 'Zip/Postal';
$_['text_enter_zip']    = 'Enter Zip/Postal Code';
$_['text_zip_rule']    = 'Zip/Postal Rule';
$_['text_zip_rule_inclusive']    = 'Only for entered zip/postal codes';
$_['text_zip_rule_exclusive']    = 'For all except entered zip/postal codes';

// Entry 
$_['entry_customer_group'] = 'Customer Group:';
$_['entry_store'] = 'Store:';
$_['entry_manufacturer'] = 'Manufacturer:';
$_['store_default'] = 'Default';
$_['entry_name']       = 'Payment Name:';
$_['entry_order_total']       = 'Order Amount Range:';
$_['entry_order_weight']       = 'Weight Range:';
$_['entry_quantity']       = 'Quantity Range:';
$_['entry_to']       = 'to';
$_['entry_order_hints']       = 'Please enter 0 (zero) if not applicable';
$_['entry_tax']        = 'Tax Class:';
$_['entry_geo_zone']   = 'Geo Zone:';
$_['entry_status']     = 'Status:';
$_['entry_sort_order'] = 'Sort Order:';
$_['entry_customer_group'] = 'Customer Group:';
$_['entry_instruction']         = 'Payment Instruction:<br />(HTML allowed)';
$_['keywords_hints']        = 'You can use these keywords in the description';
$_['entry_order_status'] = 'Order Status:';
$_['entry_callback'] = 'Callback URL:';
$_['entry_redirect'] = 'Redirct URL:';
$_['entry_redirect_type'] = 'Redirect Data Method:';
$_['entry_redirect_post'] = 'POST';
$_['entry_redirect_get'] = 'GET';
$_['entry_success'] = 'Success URL:';

$_['text_debug']    = 'Debugging:';
$_['text_inc_email']    = 'Send Instruction in Order Email:';
$_['text_inc_order']    = 'Show Instruction in Order Detail:';
$_['text_instruction_email']    = 'Instruction for Email:';
$_['tip_email_instruction']        = 'Optional. If you want to send different instruction in order email, you can use it.';
$_['text_general']    = 'General';
$_['text_criteria_setting']    = 'Criteria Setting';
$_['text_category_product']    = 'Category/Product';
$_['text_price_setting']    = 'Range Option';
$_['text_others']    = 'Others';
$_['text_logo']    = 'Logo URL';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify X-Payment!';

$_['tip_callback']       = 'If you want to call/execute any url after check out process done. It will be called silently. Please enter here.';
$_['tip_redirect']       = 'If you want to redirect to a url after clicking on confirm button, Please enter here.';
$_['tip_redirect_data']       = 'It will send order data (Order ID and Order Amount Only) either post or get method to your provided redirect URL';
$_['tip_order_status']       = 'Please select the order status what you want to apply after checking out using this method';
$_['tip_instruction']       = 'Please enter the payment instruction for the customer. It will show in the confirmation step in the checkout process. You can add placeholder in the instruction. Also it is possible to put xform shortcode!';
$_['tip_sorting_own']       = 'Sorting order with respective to x-payment methods';
$_['tip_status_own']       = 'Enable/Disable this particular method only';
$_['tip_store']       = 'Please Select Stores for which this payment method will work';
$_['tip_geo']       = 'Please Select Geo Zones for which this payment method will work';
$_['tip_manufacturer']       = 'Please Select Manufacturer for which this payment method will work';
$_['tip_customer_group']       = 'Please Select customer groups for which this payment method will work';
$_['tip_zip']       = 'Please enter zip/postal for which this payment method will work';
$_['tip_weight']       = 'Please enter weight range for which it will work';
$_['tip_total']       = 'Please enter order total range for which it will work';
$_['tip_quantity']       = 'Please enter order Product Quantity range for which it will work';
$_['tip_desc']       = 'Optional field. It will show a supportive small description under payment method name in the site.';
$_['tip_status_global']       = 'Global Status of the module';
$_['tip_sorting_global']       = 'Global Sorting Order with respective to other payment modules';
$_['tip_debug']       = 'You can debug for which conditions a payment has failed. It is very useful for debugging.';
$_['tip_success']       = 'If you want to overwrite success page URL, Please enter here. Placeholder allowed: {orderId}, {orderTotal}';

$_['text_method_remove']    = 'Remove This Method';
$_['text_method_copy']    = 'Copy This Method';
$_['text_yes']    = 'Yes';
$_['text_no']    = 'No';
$_['text_keyword']    = '<b>Keywords:</b> {orderId}, {orderTotal}';
$_['payment_terms']    = 'Payment Terms';
$_['tip_payment_terms']    = 'Payment Terms will be appeared after payment method title';


$_['text_coupon']    = 'Coupon';
$_['text_enter_coupon']    = 'Enter Coupon Code';
$_['text_coupon_rule']    = 'Coupon Rule';
$_['text_coupon_rule_inclusive']    = 'Only for entered coupon codes';
$_['text_coupon_rule_exclusive']    = 'For all except entered coupon codes';

$_['text_days_week']    = 'Days of Week';
$_['text_time_period']    = 'Time Period';
$_['text_sunday']    = 'Sunday';
$_['text_monday']    = 'Monday';
$_['text_tuesday']    = 'Tuesday';
$_['text_wednesday']    = 'Wednesday';
$_['text_thursday']    = 'Thursday';
$_['text_friday']    = 'Friday';
$_['text_saturday']    = 'Saturday';

$_['entry_all']    = 'All';
$_['entry_any']    = 'Any';

// Entry 
$_['entry_shipping']  = 'Shipping Method:';
$_['entry_name']       = 'Payment Method Title:';
$_['entry_order_total']       = 'Order Total Range:';
$_['entry_order_weight']       = 'Weight Range:';
$_['entry_to']       = 'to';
$_['entry_order_hints']       = 'Please enter 0 (zero) if not applicable';
$_['entry_tax']        = 'Tax Class:';
$_['entry_geo_zone']   = 'Geo Zone:';
$_['entry_status']     = 'Status:';
$_['entry_sort_order'] = 'Sort Order:';
$_['entry_customer_group'] = 'Customer Group:';
$_['entry_store'] = 'Store:';
$_['entry_manufacturer'] = 'Manufacturer:';
$_['store_default'] = 'Default';
$_['text_all'] = 'Any';
$_['text_category'] = 'Category Rule';
$_['text_multi_category'] = 'Multi-Categories Rule';
$_['text_category_any'] = 'For any categories';
$_['text_category_all'] = 'Must have selected categories';
$_['text_category_least'] = 'Any of the selected categories';
$_['text_category_least_with_other'] = 'Any of the selected categories with others';
$_['text_category_except'] = 'Except the selected categories';
$_['text_category_exact'] = 'Only for the selected categories';
$_['text_category_except_other'] = 'Except the selected categories with others';

$_['entry_category']     = 'Categories';
$_['text_product'] = 'Product Rule';
$_['text_product_any'] = 'For any products';
$_['text_product_all'] = 'Must have selected products';
$_['text_product_least'] = 'Any of the selected products';
$_['text_product_least_with_other'] = 'Any of the selected products with others';
$_['text_product_exact'] = 'Only for the selected products';
$_['text_product_except'] = 'Except the selected products';
$_['text_product_except_other'] = 'Except the selected products with others';
$_['entry_product']     = 'Products';
$_['total_without_coupon']     = 'Consider total without coupon';

$_['text_manufacturer_rule'] = 'Manufacturer Rule';
$_['text_manufacturer_any'] = 'For any manufacturers';
$_['text_manufacturer_all'] = 'Must have selected manufacturers';
$_['text_manufacturer_least'] = 'Any of the selected manufacturers';
$_['text_manufacturer_least_with_other'] = 'Any of the selected manufacturers with others';
$_['text_manufacturer_exact'] = 'Only for the selected manufacturers';
$_['text_manufacturer_except'] = 'Except the selected manufacturers';
$_['text_manufacturer_except_other'] = 'Except the selected manufacturers with others';

$_['button_save_continue'] = 'Save and Continue';
$_['additional_email'] = 'Additional Email:';
$_['additional_email_tip'] = 'Additional Email for receving order details. Comma(,) separated for multiple emails.';

/* tooltip */
$_['tip_shipping']       = 'Please Select shipping method for which this mehtod will work. Custom shipping may not be appeared.';
$_['tip_coupon']       = 'Please enter coupon code for which this mehtod will work';
$_['tip_category']       = '<b>For any categories</b>: Valid for any categories.<br /><b>Must have selected categories</b>: Selected categories must have in the shopping cart with  other categories.<br /><b>Any of the selected categories with others</b>: At least one of the selected category must have in the shopping cart with  other categories.<br /><b>Any of the selected categories</b>: At least one of the selected category must have in the shopping cart.  Other categories are not allowed.<br /><b>Only for the selected categories</b>: All cart categories should be in the selected categories. Other categories are not allowed.<br /><b>Except the selected categories</b>: Shopping cart should not have any of the selected categories. Only non-selected categories are allowed.<br /><b>Except the selected categories with others</b>: Shopping cart may have selected categories only if cart have at least any other category';
$_['tip_multi_category']       = 'The feature is needed when your product have more than one category.<br /><b>All</b>: Valid only if all categories of a cart product in the selected category list below.<br /><b>Any</b>: Valid if any category of a cart product in the selected category list below. If you are not sure, just keep the default value';
$_['tip_product']       = '<b>For any Products</b>: Valid for any Products.<br /><b>Must have selected products</b>: Selected products must have in the shopping cart with  other products.<br /><b>Any of the selected products with others</b>: At least one of the selected product must have in the shopping cart with  other products.<br /><b>Any of the selected products</b>: At least one of the selected product must have in the shopping cart.  Other products are not allowed.<br /><b>Only for the selected products</b>: All cart products should be in the selected products. Other products are not allowed.<br /><b>Except the selected product</b>: Shopping cart should not have any of the selected products. Only non-selected products are allowed .<br /><b>Except the selected products with others</b>: Shopping cart may have selected products only if cart have at least any other product';
$_['tip_manufacturer_rule']       = '<b>For any Manufacturers</b>: Valid for any Manufacturers.<br /><b>Must have selected manufacturer</b>: Selected manufacturer must have in the shopping cart with  other manufacturer.<br /><b>Any of the selected manufacturer with others</b>: At least one of the selected pmanufacturer must have in the shopping cart with  other manufacturer.<br /><b>Any of the selected manufacturer</b>: At least one of the selected pmanufacturer must have in the shopping cart.  Other manufacturer are not allowed.<br /><b>Only for the selected manufacturer</b>: All cart manufacturer should be in the selected manufacturer. Other manufacturer are not allowed.<br /><b>Except the selected manufacturer</b>: Shopping cart should not have any of the selected manufacturer. Only non-selected manufacturer are allowed . <br /><b>Except the selected manufacturer with others</b>: Shopping cart may have selected manufacturers only if cart have at least any other manufacturer';
$_['tip_day']       = 'Please select the day(s) for which this method will be valid';
$_['tip_time']       = 'Please set time period for this method.';
$_['tip_heading']       = 'Heading of the payment section in the site';
$_['tip_status_global']       = 'Global Status of the module';
$_['tip_sorting_global']       = 'Global Sorting Order with respective to other mehtod modules';
$_['tip_debug']       = 'It will show the cause why a particular payment method does not appear while checkout';
$_['tip_text_logo'] = 'Optional field. Only image URL is allowed. This logo will be appeared right before payment title';

$_['tip_postal_code']='Comma Separated. Wildcards support (*, ?) and Range Support. <br /><b>Example:</b><br />12345,443300-443399,9843*,875*22,45433?,S3432?2 <br /><b>Explanation</b>:<br /> 12345: A single Postal Code <br /> 443300-443399: Postal Code start from 443300 to 443399<br /> 9843*: Any code that starts with 9843 <br />875*22:  Any code that starts with 875 and ends by 22 <br /> 45433?: Any code that start with 45433 and ends by any single alpha-numeric char. <br /> SE-1-10: Postal Code start from 1 to 10 with prefix SE i.e SE9 <br /> PA-1-10-NK: Postal Code start from 1 to 10 with prefix PK and suffix NK i.e PA9NK';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify X-Payment!';

$_['text_redirect_fields'] = 'Redirect Data(s)';
$_['text_redirect_hints']    = 'Key value pairs. For example: <i>merchant:910000, amount:{orderTotal}, currency:USD</i>. Available placeholders {orderId}, {orderTotal}, {customerId}, {customerName}, {notifyURL} <br /><br />{notifyURL} can be used as success/redirect URL in case of integrating any payment gateway. It can be added query string as well e.g {notifyURL}?txn=1&success=true';
$_['text_success_condition'] = 'Payment successful condition';
$_['text_success_condition_hints'] = 'Key value pairs. ! sign can be used for inequality. Value will be found out from GET/POST using provided key. For example: <i>success:1, txnId:!null</i>. In this case, transaction will be successful if it meets the condition <u>if success == 1 and txnId != null</u>';

?>