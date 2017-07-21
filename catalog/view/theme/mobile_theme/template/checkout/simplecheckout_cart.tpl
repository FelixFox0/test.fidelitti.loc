<div class="simplecheckout-block" id="simplecheckout_cart" <?php echo $hide ? 'data-hide="true"' : '' ?> <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>
<?php if ($display_header) { ?>
    <div class="checkout-heading panel-heading"><?php echo $text_cart ?></div>
<?php } ?>
<?php if ($attention) { ?>
    <div class="simplecheckout-warning-block"><?php echo $attention; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
    <div class="simplecheckout-warning-block"><?php echo $error_warning; ?></div>
<?php } ?>
    <div class="table-responsive">
            <?php foreach ($products as $product) { ?>
                <?php if (!empty($product['recurring'])) { ?>
                    <tr>
                        <td class="simplecheckout-recurring-product" style="border:none;"><img src="<?php echo $additional_path ?>catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" />
                            <span style="float:left;line-height:18px; margin-left:10px;">
                            <strong><?php echo $text_recurring_item ?></strong>
                            <?php echo $product['profile_description'] ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
                <div class="cart-product">
                <div class="cart-product__line-top"></div>
                    <div class="image">
                        <?php if ($product['thumb']) { ?>
                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                        <?php } ?>
                    </div>
                    <div class="cart-prodinfo__right">
                        <div class="name">
                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                            <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
                                <span class="product-warning">***</span>
                            <?php } ?>
                        </div>
                        <div class="options">
                        <?php foreach ($product['option'] as $option) { ?>
                        &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                        <?php } ?>
                        <?php if (!empty($product['recurring'])) { ?>
                        - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                        <?php } ?>
                        </div>
                        <?php if ($product['reward']) { ?>
                        <small><?php echo $product['reward']; ?></small>
                        <?php } ?>
                        <div class="cart-product__model"><span style="padding-right: 5px;">Артикул:</span> <?php echo $product['model']; ?></div>
                        <div class="checkout-color">  Цвет: 
                        <?php 
                        $attr = $product['attrib'];
                        echo($attr[0]['attribute'][4]['text']);
                        ?>
                        </div> 
                        <div class="total"><?php echo $product['total']; ?></div>   
                        <!--
                        <div class="input-group btn-block quantity" style="max-width: 90px;margin: -4px 0 0 0;float: left;">
                        <span class="input-group-btn">
                            <button class="btn btn-primary cart-product__minus" data-onclick="decreaseProductQuantity" data-toggle="tooltip" type="submit">
                                -
                            </button>
                            </span>
                        <input class="form-control" type="text" data-onchange="changeProductQuantity" name="quantity[<?php echo !empty($product['cart_id']) ? $product['cart_id'] : $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" />
                        <span class="input-group-btn">
                            <button class="btn btn-primary cart-product__plus" data-onclick="increaseProductQuantity" data-toggle="tooltip" type="submit">
                                +
                            </button>
                        </span>
                        </div>  
                        -->  
                        <div class="input-group btn-block quantity" style="max-width: 50px;margin: -4px 0 0 0;float: left;">
                            <select id="" data-onchange="reloadAll" name="quantity[<?php echo !empty($product['cart_id']) ? $product['cart_id'] : $product['key']; ?>]">
                            <? for($i=1; $i<5; $i++){ ?>
                                <? if($i == $product['quantity']) { ?>
                                <option value="<? $product['quantity'] ?>" selected="selected"><? echo $product['quantity']; ?></option>

                                <? }else{ ?>
                                 <option value="<? echo $i; ?>"><? echo $i; ?></option>
                                <? } ?>
                            <? } ?>
                            </select>
                        </div>                              
                        <div class="remove">
                            <button class="btn btn-danger cart-product__del" data-onclick="removeProduct" data-product-key="<?php echo !empty($product['cart_id']) ? $product['cart_id'] : $product['key'] ?>" data-toggle="tooltip" type="button">
                            <span></span>
                            </button>
                        </div>                    
                    </div>                   
                </div>
                 <div class="large-12 sub-total">
                        <?php foreach ($totals as $total) { ?>
                        <?php if(($total['title'] == 'Sub-Total') || ($total['title'] == 'Сумма'))  { ?>                       
                            <span><b><?php echo $total['title']; ?>:</b></span>
                            <span class="sub-total__right"><?php echo $total['text']; ?></span>       
                        <?php } ?>
                        <?php } ?>
                </div>
                    <?php } ?>
                    <?php foreach ($vouchers as $voucher_info) { ?>
                        <tr>
                            <td class="image"></td>
                            <td class="name"><?php echo $voucher_info['description']; ?></td>
                            <td class="model"></td>
                            <td class="quantity">1</td>
                            <td class="price"><?php echo $voucher_info['amount']; ?></td>
                            <td class="total"><?php echo $voucher_info['amount']; ?></td>
                            <td class="remove">
                                <i data-onclick="removeGift" data-gift-key="<?php echo $voucher_info['key']; ?>" title="<?php echo $button_remove; ?>" class="fa fa-times-circle"></i>
                            </td>
                        </div>
                    <?php } ?>
    </div>


                <script type="text/javascript">

$( init );

function init() {
  // Заменяем параграф в #myDiv1 новым параграфом
  $('#cart-total-right').replaceWith( "<div class='cart-total-right'><div class='cart_total-title'>Итоговая информация о заказе</div><?php foreach ($totals as $total) { ?><div class='simplecheckout-cart-total' id='total_<?php echo $total['code']; ?>'><span><?php echo $total['title']; ?>:</span><span class='simplecheckout-cart-total-value'><?php echo $total['text']; ?></span><span class='simplecheckout-cart-total-remove'><?php if ($total['code'] == 'coupon') { ?><i data-onclick='removeCoupon' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'voucher') { ?><i data-onclick='removeVoucher' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'reward') { ?><i data-onclick='removeReward' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?></span></div><?php } ?></div>" );

  $('#myDiv2').replaceWith( "<?php if (isset($modules['coupon'])) { ?><div class='simplecheckout-cart-total cart_kupon'><span class='inputs'><div><?php echo $entry_coupon; ?>&nbsp;</div><input class='form-control' type='text' data-onchange='reloadAll' name='coupon' value='<?php echo $coupon; ?>'' /><span>применить</span></span></div><?php } ?>" );

  $('#cart__text_help').replaceWith( "<a id='toggler' class='toggler_help' href='#''>Нужна помощь? +</a><div class='cart__text_help-desc' id='box' style='display: none;'>НАПИСАТЬ НАМ <div><a href='/contact-us/''><img src='/catalog/view/theme/fidelitti/images/send.jpg' alt='' /></a></div>Пожалуйста, отправьте нам email, и мы скоро с Вами свяжемся.</div><br><a onclick='javascript:history.back(-1); return false;' class='b-back_to_shopping'>ПРОДОЛЖИТЬ ШОППИНГ</a> " );
  $('#payment_address_country_id').before('<div class="cart_address_country"><a href="javascript:location.reload()">Изменить</a></div>');
  $('#payment_address_zone_id').before('<div class="cart_address_country"><a href="javascript:location.reload()">Изменить</a></div>');
  $('#payment_address_city').before('<div class="cart_address_country"><a href="javascript:location.reload()">Изменить</a></div>');
}

</script>



       <script type="text/javascript">

$( init );

function init() {
  // Заменяем параграф в #myDiv1 новым параграфом
  $('#simplecheckout_comment').replaceWith( "<div class='cart-total-right'><div class='cart_total-title'>Итоговая информация о заказе</div><?php foreach ($totals as $total) { ?><div class='simplecheckout-cart-total' id='total_<?php echo $total['code']; ?>'><span><?php echo $total['title']; ?>:</span><span class='simplecheckout-cart-total-value'><?php echo $total['text']; ?></span><span class='simplecheckout-cart-total-remove'><?php if ($total['code'] == 'coupon') { ?><i data-onclick='removeCoupon' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'voucher') { ?><i data-onclick='removeVoucher' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'reward') { ?><i data-onclick='removeReward' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?></span></div><?php } ?></div>" );
}

</script>

<?php if (isset($modules['reward']) && $points > 0) { ?>
    <div class="simplecheckout-cart-total">
        <span class="inputs"><div><?php echo $entry_reward; ?>&nbsp;</div><input class="form-control" type="text" name="reward" data-onchange="reloadAll" value="<?php echo $reward; ?>" /></span>
    </div>
<?php } ?>
<!--
<?php if (isset($modules['voucher'])) { ?>
    <div class="simplecheckout-cart-total">
        <span class="inputs"><?php echo $entry_voucher; ?>&nbsp;<input class="form-control" type="text" name="voucher" data-onchange="reloadAll" value="<?php echo $voucher; ?>" /></span>
    </div>
<?php } ?>
-->

<?php if (isset($modules['coupon']) || (isset($modules['reward']) && $points > 0) || isset($modules['voucher'])) { ?>
    <div class="simplecheckout-cart-total simplecheckout-cart-buttons">
        <!-- <span class="inputs buttons"><a id="simplecheckout_button_cart" data-onclick="reloadAll" class="button btn-primary button_oc btn"><span><?php echo $button_update; ?></span></a></span> -->
        <!-- <div class="cart-product__back"><a href="/">Назад к покупкам</a></div> -->
    </div>
<?php } ?>
<input type="hidden" name="remove" value="" id="simplecheckout_remove">
<div style="display:none;" id="simplecheckout_cart_total"><?php echo $cart_total ?></div>
<?php if ($display_weight) { ?>
    <div style="display:none;" id="simplecheckout_cart_weight"><?php echo $weight ?></div>
<?php } ?>
<?php if (!$display_model) { ?>
    <style>
    .simplecheckout-cart col.model,
    .simplecheckout-cart th.model,
    .simplecheckout-cart td.model {
        display: none;
    }
    </style>
<?php } ?>
</div>
<style>
    #simplecheckout_summary #total_sub_total,
    #simplecheckout_summary #total_shipping,
    #simplecheckout_summary #total_total{
        display: none;
    }
    .simplecheckout > div:nth-child(2n) #total_coupon,
    .simplecheckout > div:nth-child(2n) #total_shipping{
       
    }
    .simplecheckout > div:nth-child(4n) > .simplecheckout-block div:nth-child(5n),
    .simplecheckout > div:nth-child(4n) > .simplecheckout-block div:nth-child(6n){
        
    }
    .step-step-2 {
        margin: 0px;
    }
</style>

