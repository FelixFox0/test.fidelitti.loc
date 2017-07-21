<div class="simplecheckout-block" id="simplecheckout_summary">
    <?php if ($display_header) { ?>
        <div class="checkout-heading panel-heading"><?php echo $text_summary ?></div>
    <?php } ?>
    <div class="table-responsive">
        <table class="simplecheckout-cart">
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <div class="cart-product">
                    <div class="cart-product__line-top"></div>
                        <div class="image">
                            <?php if ($product['thumb']) { ?>
                                <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                            <?php } ?>
                        </div>
                        <div class="name">
                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                            <div class="options">
                            <?php foreach ($product['option'] as $option) { ?>
                            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                            <?php } ?>
                            </div>
                            <?php if ($product['reward']) { ?>
                            <small><?php echo $product['reward']; ?></small>
                            <?php } ?>
                             <div class="cart-product__model"><span style="padding-right: 5px;">Артикул:</span> <?php echo $product['model']; ?></div>
                        <div class="quantity"><div style="margin: 6px 16px 6px 0;display: inline-block;">Количество: </div><span><?php echo $product['quantity']; ?></span></div>
                        </div>                       
                        <div class="price"><?php echo $product['price']; ?></div>
                        <div class="total"><?php echo $product['total']; ?></div>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

   
 <script type="text/javascript">

$( init );

function init() {
  // Заменяем параграф в #myDiv1 новым параграфом
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