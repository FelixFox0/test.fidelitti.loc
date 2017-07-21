<?php echo $header; ?>
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <button type="button" class="close close_login" data-dismiss="alert">×</button><?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> my-account"><?php echo $content_top; ?>
    <div class="footer">
       <ul class="accordion" data-accordion data-allow-all-closed="true" data-responsive-accordion-tabs="accordion medium-tabs large-accordion" id="3e5nyv-responsiveaccordiontabs">
                <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title"><?php echo $text_my_account; ?></a>
                  <div class="accordion-content" data-tab-content>
                        <ul class="list-unstyled">
                          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                          <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                        </ul>
                  </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title"><?php echo $text_my_orders; ?></a>
                  <div class="accordion-content" data-tab-content>
                    <div class="product__size">
                        <ul class="list-unstyled">
                          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                          <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                          <?php if ($reward) { ?>
                          <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
                          <?php } ?>
                          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                          <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                          <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
                        </ul>                          
                    </div>
                  </div>
                </li>
                <li class="accordion-item" data-accordion-item>
                  <a href="#" class="accordion-title"><?php echo $text_my_newsletter; ?></a>
                  <div class="accordion-content" data-tab-content>
                           <ul class="list-unstyled">
                            <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                          </ul>
                  </div>
                </li>                
              </ul>

</div>
      
      <?php if ($credit_cards) { ?>
      <h2><?php echo $text_credit_card; ?></h2>
      <ul class="list-unstyled">
        <?php foreach ($credit_cards as $credit_card) { ?>
        <li><a href="<?php echo $credit_card['href']; ?>"><?php echo $credit_card['name']; ?></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 