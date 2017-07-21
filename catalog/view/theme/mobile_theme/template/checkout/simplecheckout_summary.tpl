<div class="simplecheckout-block" id="simplecheckout_summary">
    <?php if ($display_header) { ?>
        <div class="checkout-heading panel-heading"><?php echo $text_summary ?></div>
    <?php } ?>
    <div class="containersssss">
<div class="floating">
    <div class="floating-one">ТОВАР</div>  <div class="floating-two"> КОЛ-ВО</div>  <div class="floating-three">ЦЕНА ЗА</div> <div class="floating-for">ИТОГО</div>
</div>
</div>
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
                        </div>
                        <!--<div class="input-group btn-block" style="max-width: 90px;margin: -4px 0 0 0;float: left;">
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

                        </div>-->
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
  $('#myDiv5').replaceWith( "<p> <?php foreach ($totals as $total) { ?><div class='simplecheckout-cart-total' id='total_<?php echo $total['code']; ?>'><span><b><?php echo $total['title']; ?>:</b></span><span class='simplecheckout-cart-total-value'><?php echo $total['text']; ?></span></div><?php } ?></p>" );

  $('#myDiv5').replaceWith( "<p> <?php foreach ($totals as $total) { ?><div class='simplecheckout-cart-total' id='total_<?php echo $total['code']; ?>'><span><b><?php echo $total['title']; ?>:</b></span><span class='simplecheckout-cart-total-value'><?php echo $total['text']; ?></span></div><?php } ?></p>" );
}

</script>
    <?php if ($summary_comment) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
      <thead>
        <tr>
          <th class="name"><?php echo $text_summary_comment; ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $summary_comment; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($summary_payment_address || $summary_shipping_address) { ?>
    <table class="simplecheckout-cart simplecheckout-summary-info">
      <thead>
        <tr>
          <?php if ($summary_payment_address) { ?>
          <th class="name"><?php echo $text_summary_payment_address; ?></th>
          <?php } ?>
          <?php if ($summary_shipping_address) { ?>
          <th class="name"><?php echo $text_summary_shipping_address; ?></th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php if ($summary_payment_address) { ?>
          <td><?php echo $summary_payment_address; ?></td>
          <?php } ?>
          <?php if ($summary_shipping_address) { ?>
          <td><?php echo $summary_shipping_address; ?></td>
          <?php } ?>
        </tr>

      </tbody>

    </table>
    <div class="simple-step step-step-1" data-onclick="gotoStep" data-step="1">Редактировать</div>
    <?php } ?>
    <div id="myDiv5">
    <p>Параграф с текстом</p> 
  </div>
</div>