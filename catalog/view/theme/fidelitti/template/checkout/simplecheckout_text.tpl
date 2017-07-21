<div id="cart-total-right">
    	
</div>
 <?php if (!$cart_empty) { ?>
    <div class="simplecheckout-button-block buttons" id="buttons">
                    <div class="simplecheckout-button-right">
                    <?php if ($block_order == 0) { ?>
                        <a class="button btn-primary button_oc cart_button btn" data-onclick="nextStep" id="simplecheckout_button_next"><span>Заказать</span></a>
                        <?php } ?>
                        <?php if (!$block_order) { ?>
                            <a class="button btn-primary button_oc cart_button btn_order" data-onclick="createOrder" id="simplecheckout_button_confirm"><?php echo $button_order; ?></a>
                        <?php } ?>
                    </div>
                </div> 
    <? } ?>
<div class="simplecheckout-block" id="simplecheckout_text_<?php echo $text_type ?>">
    <!-- <?php if ($display_header) { ?>
    <div class="checkout-heading panel-heading"><?php echo $text_title ?></div>
    <?php } ?> -->
    <div class="simplecheckout-block-content">
        <span class="prmn-cmngr-message" data-key="delivery_cart"></span>
      <div id="text_<?php echo $text_id ?>"><?php echo $text_content ?></div>
    </div>
    <div id="cart__text_help">
    	
    </div>

</div>