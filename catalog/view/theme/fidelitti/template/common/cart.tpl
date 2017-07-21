 <style>
            .mini-cart__img img{
              width: 100px;
            }
            .mini-cart__table{

            }
            .cart__border li{
              list-style: none;
            }
            table tbody tr:nth-child(even) {
                border-bottom: 0;
                background-color: #fff;
            }
            .mini-cart__list{
              margin-left:0;
            }
            .mini-cart__img {
                height: 150px;
                overflow: hidden;
                width: 100px;
            }
            .mini-cart__image{
                  width: 120px;
                  padding: 0;
                  position: relative;
                  top: 0px;
                  left: 2px;
                  border-bottom: 1px solid #b7b7b7;
            }
            #cart__none{
              padding: 28px 0 12px 0;
            }
            .mini-cart__total tr:nth-child(odd){
              
            }
            .mini-cart__go{
              width: 100%;
              border-top: 1px solid #b7b7b7;
              border-bottom: 1px solid #b7b7b7;
              text-align: center;
              padding: 7px 0;
              position: relative;
              top: 35px;
              background: #fff;
              margin-top: -50px;
    margin-bottom: 47px;
            }
            .mini-cart__go a{
                  color: #000;
                  border-radius: 0;
                  font-size: 11px;
            }
            .mini-cart__go a:hover{
                  text-decoration: underline;
            }
            .mini-cart__go--check{
                  font-size: 12px;
                  letter-spacing: 2.5px;
                  text-transform: uppercase;
                  text-align: center;
            }
            .mini-cart__go--check a:hover{
                  text-decoration: underline;
            }
          </style>
<div class="cart_blocks">
<a href="/cart" id="new-ref">         <img src="/catalog/view/theme/fidelitti/images/business.png" alt=""> 
<div id="cart-total_up">
<button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
</div>
</a>

<div id="cart" class="cart__non" style="display: none;">
    <div id="cart__none" class="cart__border">
  <ul class="mini-cart__list">
    <?php if ($products || $vouchers) { ?>
    <li>
    <div class="cart__overf">
      <table class="mini-cart__table">
        <?php foreach ($products as $product) { ?>
        <tr>

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
            <div>
                <?php echo $product['total']; ?>
            </div>
            <div>
                <button type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>Удалить</button>              
            </div>
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
      </div>
    </li>
    <li class="mini-cart__go">
        <!--<a href="/simplecheckout/"><strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp; -->
          <a href="/cart/">Перейти в корзину</a>
        </li>
    <li>
      <div>
        <table class="mini-cart__total">
          <?php foreach ($totals as $total) { ?>
           

          <tr>
            <td><?php echo $total['title']; ?></td>
            <td class="text-right"><?php echo $total['text']; ?></td>
          </tr>
          
          <?php } ?>
        </table>
      </div>
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
</div>