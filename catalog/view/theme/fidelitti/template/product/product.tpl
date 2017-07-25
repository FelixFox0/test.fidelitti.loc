<?php echo $header; ?>
<div class="breadcrumbs">
    <nav class="row">
        <ul class="large-12 medium-12 small-12 breadcrumbs__links">               
            <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
	       <?php if($i+1<count($breadcrumbs)) { ?>
            <li>
                <a href="<?php echo $breadcrumb['href']; ?>">
                    <?php echo $breadcrumb['text']; ?>
                </a>
            </li><?php } else { ?><li><?php echo $breadcrumb['text']; ?></li><?php } ?>
            <?php } ?>
        </ul> 
    </nav>
</div>
<div class="row product" id="content">
   
    <?php if ($thumb || $images) { ?>
        <div class="large-2 columns product__prew" id="bx-pager">       
        <?php if ($images) { ?>
          <?php $i = 0; ?>
          <?php foreach ($images as $image) { ?>   
            <a data-slide-index="<?php echo $i++ ?>" href="">
                <div class="product__prew--img"><img src="<?php echo $image['thumb']; ?>" /></div>
            </a> 
          <?php } ?>
          <?php } ?>
        </div>
        <div class="large-5 medium-9 small-8 columns product__center">
        <div class="slider5" id="element">
            <?php if ($images) { ?>
          <?php foreach ($images as $image) { ?>  
            <div class="slide aaaa">
                <a href="<?php echo $image['popup']; ?>" class="image-link"><img src="<?php echo $image['popups']; ?>"></a>
            </div>          
            <?php } ?>
             <?php } ?>
         </div>
        </div>
    <?php } ?>
        <div class="large-4 product__right">
            <h1 class="product__title">
                <?php echo $heading_title; ?>
            </h1>
            <?php if ($price) { ?>
            <div class="product__price">
                <?php if (!$special) { ?>
                <?php echo $price; ?>
                <?php } else { ?>
            <span style="text-decoration: line-through; font-size: 20px;"><?php echo $price; ?></span><?php echo $special; ?>
            <?php } ?>
            <?php if ($tax) { ?>
            <li><?php echo $text_tax; ?> <?php echo $tax; ?></li>
            <?php } ?>
            <?php if ($points) { ?>
            <li><?php echo $text_points; ?> <?php echo $points; ?></li>
            <?php } ?>
            <?php if ($discounts) { ?>
            <li>
              <hr>
            </li>
            <?php foreach ($discounts as $discount) { ?>
            <li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>
            <?php } ?>
            <?php } ?>
            </div>
            <?php } ?>


             <!-- =====================Атрибуты NEW==================== -->
             <? if($pds) {?>
                        <div class="product__color-all">
                        
                        <?php foreach ($pds as $p) { ?>
					<?php if ($p['product_id'] == $product_id){ ?>
					Цвет:
							<div style="background: url(<?php echo $p['product_pds_image']; ?>) -86px -227px;width: 30px;height: 30px;border-radius: 17px;display: inline-block;position: relative;top: 8px;left: 10px;">
              <?php if($p['attribute_groups']) { ?>
                    <?php foreach($p['attribute_groups'] as $attribute_group) { ?>
                        <?php foreach($attribute_group['attribute'] as $attribute) { ?>
                        <?php if(in_array($attribute['attribute_id'], array(14))) { ?>
                                                 
								<a href="#text-popupaa" class="popup-content" title="<?php echo $attribute['text']; ?> " style="padding: 15px 15px;"></a>
                <?php } ?>
                        <?php } ?>
                    <?php } ?>
                  <?php } ?>
							</div>
						
					<? } ?>
					<?php } ?>
                        <div class="product__color-count"><a href="#text-popupaa" class="popup-content">1 из <?php echo count($pds);?></a></div>
                        
                        </div>
             <? } ?>
                  <!-- =====================Атрибут NEW конец==================== -->
            
            <div class="product__options"> 
                <div id="product">
            <?php if ($options) { ?>
            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?>:</label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="product__options--title"><?php echo $option['name']; ?>:</label>
              <div id="input-option<?php echo $option['product_option_id']; ?>" class="product__options--images">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                  <li class="shipping_method">
                    <input type="radio" data-index="0" class="shipping_method" checked="checked" id="<?php echo $option_value['product_option_value_id']; ?>" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <label for="<?php echo $option_value['product_option_value_id']; ?>">
                  <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>                    
                    <!-- <?php echo $option_value['name']; ?> -->
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                  </li>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                    <input type="checkbox" id="<?php echo $option_value['product_option_value_id']; ?>" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                  <label for="<?php echo $option_value['product_option_value_id']; ?>">                    
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>

            


            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if ($recurrings) { ?>
            <hr>
            <h3><?php echo $text_payment_recurring; ?></h3>
            <div class="form-group required">
              <select name="recurring_id" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($recurrings as $recurring) { ?>
                <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>
                <?php } ?>
              </select>
              <div class="help-block" id="recurring-description"></div>
            </div>
            <?php } ?>            
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>
          </div>
        </div>            
        <div class="product__options-size">                           
        	<?php if ($options) { ?>
          размер:
            <?php foreach ($options as $option) { ?>
			 
			       <? if($option['value']){ ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <a href="/index.php?route=product/product&path=20_61&product_id=<?php echo $option['value']; ?>"><?php echo $option['name']; ?></a>
            </div>
            <?php } ?>

            <? }elseif($option['value'] == NULL){ ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <?php echo $option['name']; ?>
            </div>
            <?php } ?>
            <?php } ?>
			<?php } ?>		
      <?php } ?>	 
         
        </div>
        	<div class="product__stock"><?php echo $stock; ?></div>
            <div class="product__cart">
            <?php if ($quantity == 0){ ?> 
              	<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_pred_order; ?></button>
            <? }else{ ?>				
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>
            <? } ?>
                  <!-- Button fastorder -->
                 <?php  echo $fastorder;?>
                  <!-- END :  button fastorder -->  
            </div>
            
                <div class="product__heart" onclick="wishlist.add('<?php echo $product_id; ?>');">
                    <?php echo $button_wishlist; ?>
                </div>    
                <div class="product__deliv">
                	<a href="#text-popup" class="popup-content">доставка и оплата</a>
                </div>        
            <div class="product__desc">
                <ul class="tabs" data-responsive-accordion-tabs="tabs medium-accordion large-tabs" id="example-tabs" role="tablist" data-tabs="j6tnv7-tabs">
                    <li class="tabs-title product__tabs-title is-active" role="presentation"><a href="#panel1" aria-selected="false" role="tab" aria-controls="panel1" id="panel1-label">Описание</a></li>
                    <li class="tabs-title product__tabs-title" role="presentation"><a href="#panel2" role="tab" aria-controls="panel2" aria-selected="true" id="panel2-label">Детали</a></li>
                    <li class="tabs-title product__tabs-title" role="presentation"><a href="#panel3" role="tab" aria-controls="panel3" aria-selected="true" id="panel3-label">Размер</a></li>
                </ul>
                </div>
               <div class="product__tabs-content tabs-content" data-tabs-content="example-tabs">
                  <div class="product__tabs-panel tabs-panel is-active" id="panel1">
                    <div class="product__desc--atribute">                                             
                   <!-- =====================Атрибуты NEW==================== -->
                        <!--<div class="product__color">
                        <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                    <?php if(in_array($attribute['attribute_id'], array(14))) { ?>
                                        <span><?php echo $attribute['name']; ?>:</span>
                                        <?php echo $attribute['text']; ?>
                                    <?php }?>
                                <?php }?>
                        <?php }?>
                        </div>     -->                   
                  <!-- =====================Атрибут NEW конец==================== -->
                  <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
                  <div class="product__sku">
                            <?php echo $text_model; ?> 
                            <?php echo $model; ?>
                        </div>   
                         <?php if ($options) { ?>
                        <?php foreach ($options as $option) { ?>
                        <?php if ($option['type'] == 'radio') { ?>

                        <?php echo $option['name']; ?>:

                            <?php foreach ($option['product_option_value'] as $option_value) { ?>

                                <?php echo $option_value['name']; ?>,

                            <?php } ?>

                        <?php } ?><?php } ?>
                        <?php } ?>
                        
                        
                        
                        <div class="tab-content">
            
            <?php if ($attribute_groups) { ?>
            <div class="tab-pane" style="display: none;" id="tab-specification">
              <table class="table table-bordered">
                <?php foreach ($attribute_groups as $attribute_group) { ?>
                <thead>
                  <tr>
                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                  <tr>
                    <td><?php echo $attribute['name']; ?></td>
                    <td><?php echo $attribute['text']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php } ?>
              </table>
            </div>
            <?php } ?>
            <?php if ($review_status) { ?>
            <div class="tab-pane" id="tab-review">
              <form class="form-horizontal" id="form-review">
                <div id="review"></div>
                <h2><?php echo $text_write; ?></h2>
                <?php if ($review_guest) { ?>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <input type="text" name="name" value="<?php echo $customer_name; ?>" id="input-name" class="form-control" />
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo $entry_rating; ?></label>
                    &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;<?php echo $entry_good; ?></div>
                </div>
                <?php echo $captcha; ?>
                <div class="buttons clearfix">
                  <div class="pull-right">
                    <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                  </div>
                </div>
                <?php } else { ?>
                <?php echo $text_login; ?>
                <?php } ?>
              </form>
            </div>
            <?php } ?>
          </div>
                        
                    </div>
                  </div>
                  <div class="tabs-panel" id="panel2">
                   

                    <div class="product__materials">
                        <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                    <?php if(in_array($attribute['attribute_id'], array(17))) { ?>
                                        <div class="large-12 product__materials__title"><?php echo $attribute['name']; ?>:</div>
                                        <div class="large-12"><?php echo $attribute['text']; ?></div>
                                    <?php }?>
                                     
                                <?php }?>
                        <?php }?>
                        <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                        <?php if(in_array($attribute['attribute_id'], array(18))) { ?>
                                        <div class="large-12 product__materials__title"><?php echo $attribute['name']; ?>:</div>
                                        <div class="large-12"><?php echo $attribute['text']; ?></div>
                                    <?php }?>
<?php }?>
                        <?php }?>
                                    
                        </div>

                  </div>
                   <div class="tabs-panel" id="panel3">
                   <div class="product__size">
                            Размер:  
                            <?php if ($length && $width && $height) { ?>
                                <?php echo $length; ?> х
                                <?php echo $width; ?> х
                                <?php echo $height; ?>
                            <?php } ?>
                        </div>
                  </div>
                </div>                
            </div>
        </div>
    </div>
     <div class="product-line"></div>
     <div class="row product-recommend">
     <?php echo $content_bottom; ?>
    </div>
    <div>
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <?php echo $content_top; ?>
    <?php echo $column_right; ?>

</div>

<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				$('.breadcrumbs').after('<div class="alert-os"><div class="alert alert-success">' + json['success'] + '<button type="button" class="close alert__close" data-dismiss="alert">&times;</button></div></div>');

				$('#cart-total_up > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart__none > ul').load('index.php?route=common/cart/info ul li');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script>
<script type="text/javascript"><!--

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
    grecaptcha.reset();
});

$(document).ready(function() {
	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});

$(document).ready(function() {
	var hash = window.location.hash;
	if (hash) {
		var hashpart = hash.split('#');
		var  vals = hashpart[1].split('-');
		for (i=0; i<vals.length; i++) {
			$('div.options').find('select option[value="'+vals[i]+'"]').attr('selected', true).trigger('select');
			$('div.options').find('input[type="radio"][value="'+vals[i]+'"]').attr('checked', true).trigger('click');
		}
	}
})
//--></script>





<script type="text/javascript">
$('#one_click').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/oneclickbye&product_id=<?php echo $product_id; ?>',
		type: 'post',
		data: 'name=test&phone=000&mail=test@test.ua' ,
		dataType: 'json',
		beforeSend: function() {
			
		},
		complete: function() {
			
		},
		success: function(json) {			
			if (json['success']) {
                            alert("Ваш заказ получен");	
			}else{
                            alert("Ваш заказ не получен");
                        }
		}
	});
});
</script> 











<?php echo $footer; ?>































          <div id="product">
            
            
              
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <br />
              
</div>
            