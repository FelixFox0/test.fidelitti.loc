<style type="text/css">
  table tbody tr:nth-child(even) {
    border-bottom: 0;
    background-color: #fafafa;
}
</style>
<span class="new-ref__block">
<a href="#cart" id="new-ref" class="cart_click">
<div id="cart-total_up">
<button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
</div>
</a>
</span>

<div id="cart" class="cart__non">
<div id="cart__none" class="cart__border">
<a href="#cart" id="new-ref" class="cart_click__info">
Корзина
<div class="cart__bracket-one">(</div>
<div id="cart-total_up">
<button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
</div>
<div class="cart__bracket-two">)</div>
</a>
  <ul class="mini-cart__list">
    <?php if ($products || $vouchers) { ?>
    <li class="mini-cart__product">
      <table class="mini-cart__table">
        <?php foreach ($products as $product) { ?>
        <tr class="mini-cart__info">

          <td class="mini-cart__image"><?php if ($product['thumb']) { ?>
          <div class="mini-cart__img">
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
            <?php } ?>
          </div>
          </td>
         
          <td class="mini-cart__prodinfo">
            <div>
            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <?php if ($product['option']) { ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
            <?php } ?>
            <?php } ?>
            <?php if ($product['recurring']) { ?>
            <br />
            - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
            <?php } ?>
            </div>
            <div>
            Цвет: 
            <?php
              $attr = $product['attrib'];
              
              echo($attr[0]['attribute'][4]['text']);
            ?>
            </div>
            <div>
              Количество: <?php echo $product['quantity']; ?>
            </div> 
            </td>

        </tr>
        <tr>
            <td>
                <button type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>Удалить</button>              
            </td>
            <td>
                <?php echo $product['total']; ?>
            </td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="text-center"></td>
          <td class="text-left"><?php echo $voucher['description']; ?></td>
          <td class="text-right">x&nbsp;1</td>
          <td class="text-right"><?php echo $voucher['amount']; ?></td>
          <td class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
      </table>
    </li>
    <li class="mini-cart__totals">
        <table class="mini-cart__total">
          <?php foreach ($totals as $total) { ?>
<?php if(($total['title'] == 'Sub-Total') || ($total['title'] == 'Сумма'))  { ?>
  <tr>
    <td align="right"><b><?php echo $total['title']; ?>:</b></td>
    <td align="right"><?php echo $total['text']; ?></td>
  </tr>        
<?php } ?>
<?php } ?>
        </table>
    </li>
    <li class="mini-cart__go--check">
        <!--<a href="/simplecheckout/"><strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp; -->
          <a href="/simplecheckout/"><?php echo $text_checkout; ?></a>
        </li>
    <?php } else { ?>
    <li>
      <p class="text-center"><?php echo $text_empty; ?></p>
    </li>
    <?php } ?>
  </ul>
</div>
</div>
