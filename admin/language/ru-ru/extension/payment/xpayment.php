<?php

$_['heading_title']    = 'Мои способы оплаты';
$_['tab_general']    = 'Настройки';
$_['tab_rate']    = 'Настройки способа';

// Text 
$_['text_payment']    = 'Оплата';
$_['module_status']    = 'Статус модуля';
$_['text_success']     = 'Успешно: Вы изменили модуль!';
$_['text_edit']    = 'Настройки вашего способа оплаты';
$_['text_add_new_method']    = 'Добавить новый';

$_['text_select_all']    = 'Выбрать все';
$_['text_unselect_all']    = 'Снять все';
$_['text_any']    = 'Для любого';

$_['text_zip_postal']    = 'Почтовый индекс';
$_['text_enter_zip']    = 'Введите Почтовый индекс';
$_['text_zip_rule']    = 'Правила ввода почтового индекса';
$_['text_zip_rule_inclusive']    = 'Только если введенн индекс';
$_['text_zip_rule_exclusive']    = 'Только если не введен индекс';

// Entry 
$_['entry_customer_group'] = 'Группа клиентов:';
$_['entry_store'] = 'Магазин:';
$_['entry_manufacturer'] = 'Производитель:';
$_['store_default'] = 'По умолчанию';
$_['entry_name']       = 'Название способа оплаты:';
$_['entry_order_total']       = 'Диапазон суммы заказа:';
$_['entry_order_weight']       = 'Диапазон веса заказа:';
$_['entry_quantity']       = 'Диапазон количества товаров:';
$_['entry_to']       = 'до';
$_['entry_order_hints']       = 'Введите 0 (ноль) чтобы не использовать';
$_['entry_tax']        = 'Налоги:';
$_['entry_geo_zone']   = 'Регион:';
$_['entry_status']     = 'Статус:';
$_['entry_sort_order'] = 'Порядок:';
$_['entry_customer_group'] = 'Группа клиентов:';
$_['entry_instruction']         = 'Инструкция по оплате:<br />(HTML разрешен)';
$_['keywords_hints']        = 'You can use these keywords in the description';
$_['entry_order_status'] = 'Статус заказа:';
$_['entry_callback'] = 'Callback URL:';
$_['entry_redirect'] = 'Redirct URL:';
$_['entry_redirect_type'] = 'Метод передачи:';
$_['entry_redirect_post'] = 'POST';
$_['entry_redirect_get'] = 'GET';
$_['entry_success'] = 'Success URL:';

$_['text_debug']    = 'Отладка:';
$_['text_inc_email']    = 'Отправить инструкцию на Email клиента:';
$_['text_inc_order']    = 'Показать инструкцию при оформлении заказа:';
$_['text_instruction_email']    = 'Инструкция на Email:';
$_['tip_email_instruction']        = 'Необязательно.';
$_['text_general']    = 'Главные';
$_['text_criteria_setting']    = 'Зависимости';
$_['text_category_product']    = 'Категории/Товары';
$_['text_price_setting']    = 'Диапазоны';
$_['text_others']    = 'Другое';
$_['text_logo']    = 'Ссылка на логотип';

// Error
$_['error_permission'] = 'Внимание: У вас нет доступа к управлению модулем!';

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

$_['text_method_remove']    = 'Удалить этот способ';
$_['text_method_copy']    = 'Копировать этот способ';
$_['text_yes']    = 'Да';
$_['text_no']    = 'Нет';
$_['text_keyword']    = '<b>Шорткоды:</b> {orderId}, {orderTotal}';
$_['payment_terms']    = 'Подпись к способу';
$_['tip_payment_terms']    = 'Подпись будет показываться под названием способа оплаты';


$_['text_coupon']    = 'Купон';
$_['text_enter_coupon']    = 'Введите код купона';
$_['text_coupon_rule']    = 'Условие по купону';
$_['text_coupon_rule_inclusive']    = 'Только при введенном купоне';
$_['text_coupon_rule_exclusive']    = 'Только если купон не введен';

$_['text_days_week']    = 'Дни недели';
$_['text_time_period']    = 'Диапазон времени';
$_['text_sunday']    = 'Воскресенье';
$_['text_monday']    = 'Понедельник';
$_['text_tuesday']    = 'Вторник';
$_['text_wednesday']    = 'Среда';
$_['text_thursday']    = 'Четверг';
$_['text_friday']    = 'Пятница';
$_['text_saturday']    = 'Суббота';

$_['entry_all']    = 'Все';
$_['entry_any']    = 'Любые';

// Entry 
$_['entry_shipping']  = 'Способ доставки:';
$_['entry_name']       = 'Название способа оплаты:';
$_['entry_order_total']       = 'Диапазон суммы заказа:';
$_['entry_order_weight']       = 'Диапазон веса:';
$_['entry_to']       = 'до';
$_['entry_order_hints']       = 'Введите 0 (ноль) для любого значения';
$_['entry_tax']        = 'Налоги:';
$_['entry_geo_zone']   = 'Регион:';
$_['entry_status']     = 'Статус:';
$_['entry_sort_order'] = 'Порядок:';
$_['entry_customer_group'] = 'Группа клиентов:';
$_['entry_store'] = 'Магазин:';
$_['entry_manufacturer'] = 'Производитель:';
$_['store_default'] = 'По умолчанию';
$_['text_all'] = 'Любые';
$_['text_category'] = 'Условия по категории';
$_['text_multi_category'] = 'Условие для нескольких категорий';
$_['text_category_any'] = 'Для любой категории';
$_['text_category_all'] = 'Обязательно выбрать категории';
$_['text_category_least'] = 'Любая из выбранных категорий';
$_['text_category_least_with_other'] = 'Любая из выбранных категорий с другими';
$_['text_category_except'] = 'За исключением выбраных категорий';
$_['text_category_exact'] = 'Только для выбранных категорий';
$_['text_category_except_other'] = 'За исключением выбранных категорий с другими';

$_['entry_category']     = 'Категории';
$_['text_product'] = 'Условия по товарам';
$_['text_product_any'] = 'Для любого товара';
$_['text_product_all'] = 'Обязательно выбрать товары';
$_['text_product_least'] = 'Любой из выбранных товаров';
$_['text_product_least_with_other'] = 'Любой из выбранных товаров с другими';
$_['text_product_exact'] = 'Только для выбранных товаров';
$_['text_product_except'] = 'За исключением выбранных товаров';
$_['text_product_except_other'] = 'За исключением выбранных товаров с другими';
$_['entry_product']     = 'Товары';
$_['total_without_coupon']     = 'Сумма без купона';

$_['text_manufacturer_rule'] = 'Условия по производителю';
$_['text_manufacturer_any'] = 'Для любого производителей';
$_['text_manufacturer_all'] = 'Обязательно выбрать производителей';
$_['text_manufacturer_least'] = 'Любой из выбранных производителей';
$_['text_manufacturer_least_with_other'] = 'Любой из выбранных производителей с другими';
$_['text_manufacturer_exact'] = 'Только для выбранных производителей';
$_['text_manufacturer_except'] = 'За исключением выбранных производителей';
$_['text_manufacturer_except_other'] = 'За исключением выбранных производителей с другими';

$_['button_save_continue'] = 'Сохранить и продолжить';
$_['additional_email'] = 'Дополнительный Email:';
$_['additional_email_tip'] = 'Дополнительный Email будет получать уведомление о заказе выбраным способом. Несколько вариантов можно перечислить через запятую.';

/* tooltip */
$_['tip_shipping']       = 'Please Select shipping method for which this mehtod will work. Custom shipping may not be appeared.';
$_['tip_coupon']       = 'Please enter coupon code for which this mehtod will work';
$_['tip_category']       = '<b>Для любых категорий</b>: Valid for any categories.<br /><b>Must have selected categories</b>: Selected categories must have in the shopping cart with  other categories.<br /><b>Any of the selected categories with others</b>: At least one of the selected category must have in the shopping cart with  other categories.<br /><b>Any of the selected categories</b>: At least one of the selected category must have in the shopping cart.  Other categories are not allowed.<br /><b>Only for the selected categories</b>: All cart categories should be in the selected categories. Other categories are not allowed.<br /><b>Except the selected categories</b>: Shopping cart should not have any of the selected categories. Only non-selected categories are allowed.<br /><b>Except the selected categories with others</b>: Shopping cart may have selected categories only if cart have at least any other category';
$_['tip_multi_category']       = 'The feature is needed when your product have more than one category.<br /><b>All</b>: Valid only if all categories of a cart product in the selected category list below.<br /><b>Any</b>: Valid if any category of a cart product in the selected category list below. If you are not sure, just keep the default value';
$_['tip_product']       = '<b>For any Products</b>: Valid for any Products.<br /><b>Must have selected products</b>: Selected products must have in the shopping cart with  other products.<br /><b>Any of the selected products with others</b>: At least one of the selected product must have in the shopping cart with  other products.<br /><b>Any of the selected products</b>: At least one of the selected product must have in the shopping cart.  Other products are not allowed.<br /><b>Only for the selected products</b>: All cart products should be in the selected products. Other products are not allowed.<br /><b>Except the selected product</b>: Shopping cart should not have any of the selected products. Only non-selected products are allowed .<br /><b>Except the selected products with others</b>: Shopping cart may have selected products only if cart have at least any other product';
$_['tip_manufacturer_rule']       = '<b>For any Manufacturers</b>: Valid for any Manufacturers.<br /><b>Must have selected manufacturer</b>: Selected manufacturer must have in the shopping cart with  other manufacturer.<br /><b>Any of the selected manufacturer with others</b>: At least one of the selected pmanufacturer must have in the shopping cart with  other manufacturer.<br /><b>Any of the selected manufacturer</b>: At least one of the selected pmanufacturer must have in the shopping cart.  Other manufacturer are not allowed.<br /><b>Only for the selected manufacturer</b>: All cart manufacturer should be in the selected manufacturer. Other manufacturer are not allowed.<br /><b>Except the selected manufacturer</b>: Shopping cart should not have any of the selected manufacturer. Only non-selected manufacturer are allowed . <br /><b>Except the selected manufacturer with others</b>: Shopping cart may have selected manufacturers only if cart have at least any other manufacturer';
$_['tip_day']       = 'Please select the day(s) for which this method will be valid';
$_['tip_time']       = 'Please set time period for this method.';
$_['tip_heading']       = 'Заголовок в блоке способы оплаты';
$_['tip_status_global']       = 'Статус модуля';
$_['tip_sorting_global']       = 'Global Sorting Order with respective to other mehtod modules';
$_['tip_debug']       = 'It will show the cause why a particular payment method does not appear while checkout';
$_['tip_text_logo'] = 'Optional field. Only image URL is allowed. This logo will be appeared right before payment title';

$_['tip_postal_code']='Comma Separated. Wildcards support (*, ?) and Range Support. <br /><b>Example:</b><br />12345,443300-443399,9843*,875*22,45433?,S3432?2 <br /><b>Explanation</b>:<br /> 12345: A single Postal Code <br /> 443300-443399: Postal Code start from 443300 to 443399<br /> 9843*: Any code that starts with 9843 <br />875*22:  Any code that starts with 875 and ends by 22 <br /> 45433?: Any code that start with 45433 and ends by any single alpha-numeric char. <br /> SE-1-10: Postal Code start from 1 to 10 with prefix SE i.e SE9 <br /> PA-1-10-NK: Postal Code start from 1 to 10 with prefix PK and suffix NK i.e PA9NK';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify X-Payment!';

$_['text_redirect_fields'] = 'Передаваемые данные';
$_['text_redirect_hints']    = 'Пары ключ:значение. Например: <i>merchant:910000, amount:{orderTotal}, currency:USD</i>. Можно использовать шотркоды {orderId}, {orderTotal}, {customerId}, {customerName}, {notifyURL} <br /><br />{notifyURL} can be used as success/redirect URL in case of integrating any payment gateway. It can be added query string as well e.g {notifyURL}?txn=1&success=true';
$_['text_success_condition'] = 'Условия успешной оплаты';
$_['text_success_condition_hints'] = 'Пары ключ:значение. ! знак может быть использован для неравенства. Значение будет взят из GET / POST запроса.  Например: <i>success:1, txnId:!null</i>. В этом случае сделка будет успешной, если она удовлетворяет условию <u>if success == 1 and txnId != null</u>';

?>