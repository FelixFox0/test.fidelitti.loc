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
        <table class="simplecheckout-cart">
           
            <tbody>
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
                    <div class="name">
                    <!--
                        <?php if ($product['thumb']) { ?>
                            <div class="image">
                                <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                            </div>
                        <?php } ?>
                    -->
                        <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
                            <span class="product-warning">***</span>
                        <?php } ?>
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
                        <div class="input-group btn-block" style="max-width: 200px;margin-bottom: 0;">
                            <div style="margin: 6px 16px 6px 0;">Количество: </div>
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
                        <div>
                            <button class="btn btn-danger cart-product__del" data-onclick="removeProduct" data-product-key="<?php echo !empty($product['cart_id']) ? $product['cart_id'] : $product['key'] ?>" data-toggle="tooltip" type="button">
                                    <span>Удалить</span><span> <img src="/catalog/view/theme/fidelitti/images/close.png" alt=""></span>
                                </button>
                            </div>
                    </div>
                    
                    
                    <div class="price"><?php echo $product['price']; ?></div>
                    <div class="total"><?php echo $product['total']; ?></div>
                    <div class="remove">
                    </div>
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
            </tbody>
        </table>
    </div>


                <script type="text/javascript">

$( init );

function init() {
  // Заменяем параграф в #myDiv1 новым параграфом
  $('#myDiv1').replaceWith( "<?php foreach ($totals as $total) { ?><div class='simplecheckout-cart-total' id='total_<?php echo $total['code']; ?>'><span><b><?php echo $total['title']; ?>:</b></span><span class='simplecheckout-cart-total-value'><?php echo $total['text']; ?></span><span class='simplecheckout-cart-total-remove'><?php if ($total['code'] == 'coupon') { ?><i data-onclick='removeCoupon' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'voucher') { ?><i data-onclick='removeVoucher' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?><?php if ($total['code'] == 'reward') { ?><i data-onclick='removeReward' title='<?php echo $button_remove; ?>' class='fa fa-times-circle'></i><?php } ?></span></div><?php } ?>" );

  $('#myDiv2').replaceWith( "<?php if (isset($modules['coupon'])) { ?><div class='simplecheckout-cart-total'><span class='inputs'><?php echo $entry_coupon; ?>&nbsp;<input class='form-control' type='text' data-onchange='reloadAll' name='coupon' value='<?php echo $coupon; ?>'' /></span></div><?php } ?>" );
}

</script>

<?php if (isset($modules['reward']) && $points > 0) { ?>
    <div class="simplecheckout-cart-total">
        <span class="inputs"><?php echo $entry_reward; ?>&nbsp;<input class="form-control" type="text" name="reward" data-onchange="reloadAll" value="<?php echo $reward; ?>" /></span>
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
        <div class="cart-product__back"><a href="/">Назад к покупкам</a></div>
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
    .simplecheckout > div:nth-child(4n) #total_sub_total,
    .simplecheckout > div:nth-child(4n) #total_shipping{
        display: none;
    }
    .simplecheckout > div:nth-child(2n) #total_coupon,
    .simplecheckout > div:nth-child(2n) #total_shipping{
        display: none;
    }
    .simplecheckout > div:nth-child(4n) > .simplecheckout-block div:nth-child(5n),
    .simplecheckout > div:nth-child(4n) > .simplecheckout-block div:nth-child(6n){
        display: none;
    }

</style>