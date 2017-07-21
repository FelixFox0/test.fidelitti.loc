<?php echo $header; ?>
<div class="container top-extra-space bottom-extra-space">
	<nav id="top-extra" class="navbar navbar-fixed-top Fixed">
		<div class="container">
			<div class="row">
				<div class="col-xs-2">
					<div class="pull-center">
						<a href="javascript:void(0);" class="btn btn-link history-back"><i class="fa fa-angle-left"></i></a>
					</div>	
				</div>		
				<div class="col-xs-8">
					<div class="pull-center">
						<a href="javascript:void(0);" class="btn btn-link page-title"><?php echo $heading_title; ?></a>
					</div>	
				</div>		
				<div class="col-xs-2">
					<div class="pull-center">
						<a id="display-type" class="btn btn-link"><i class="fa"></i></a>
					</div>	
				</div>		
			</div>
		</div>
	</nav>
	
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
	
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <?php if ($thumb || $images) { ?>
          <div id="product-image-slideshow" class="owl-carousel owl-androidstore-product-theme">
            <?php if ($thumb) { ?>
            <div class="item"><a class="thumbnail photoswipe-thumbnail" href="javascript:void(0);" title="<?php echo $heading_title; ?>"><img class="img-responsive lazyOwl" data-src="<?php echo $thumb; ?>" src="" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
            <?php } ?>
            <?php if ($images) { ?>
            <?php foreach ($images as $image) { ?>
            <div class="item"><a class="thumbnail photoswipe-thumbnail" href="javascript:void(0);" title="<?php echo $heading_title; ?>"> <img class="img-responsive lazyOwl" data-src="<?php echo $image['thumb']; ?>" src="" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
            <?php } ?>
            <?php } ?>
          </div>
		  <!-- start photoswipe  -->
			<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="pswp__bg"></div>
				<div class="pswp__scroll-wrap">
					<div class="pswp__container">
						<div class="pswp__item"></div>
						<div class="pswp__item"></div>
						<div class="pswp__item"></div>
					</div>

					<div class="pswp__ui pswp__ui--hidden">
						<div class="pswp__top-bar">
							<div class="pswp__counter"></div>
							<button class="pswp__button pswp__button--close"></button>
							<button class="pswp__button pswp__button--fs"></button>
							<button class="pswp__button pswp__button--zoom"></button>
							<div class="pswp__preloader">
								<div class="pswp__preloader__icn">
								  <div class="pswp__preloader__cut">
									<div class="pswp__preloader__donut"></div>
								  </div>
								</div>
							</div>
						</div>

						<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
							<div class="pswp__share-tooltip"></div> 
						</div>

						<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
						</button>

						<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
						</button>

						<div class="pswp__caption">
							<div class="pswp__caption__center"></div>
						</div>
					</div>
				</div>
			</div>
		  <!-- stop photoswipe -->
          <?php } ?>
          
			<div id="product-info-options">
				<div class="product-info product-title"><?php echo $heading_title; ?></div>
				  <ul class="list-unstyled product-info">
					<?php if ($manufacturer) { ?>
					<li><?php echo $text_manufacturer; ?> <?php echo $manufacturer; ?></li>
					<?php } ?>
					<li><?php echo $text_model; ?> <?php echo $model; ?></li>
					<?php if ($reward) { ?>
					<li><?php echo $text_reward; ?> <?php echo $reward; ?></li>
					<?php } ?>
					<li class="product-availability"><?php echo $text_stock; ?> <?php echo $stock; ?></li>
					
					<?php if ($review_status) { ?>
					<li class="rating">
					<p>
					  <?php for ($i = 1; $i <= 5; $i++) { ?>
					  <?php if ($rating < $i) { ?>
					  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
					  <?php } else { ?>
					  <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
					  <?php } ?>
					  <?php } ?> 
				    </li>
				  <?php } ?>
				  </ul>
				  <?php if ($price) { ?>
				  <ul class="list-unstyled product-info">
					<?php if (!$special) { ?>
					<li>
					  <h2><?php echo $price; ?></h2>
					</li>
					<?php } else { ?>
					<li><span style="text-decoration: line-through;"><?php echo $price; ?></span></li>
					<li>
					  <h2><?php echo $special; ?></h2>
					</li>
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
				  </ul>
				  <?php } ?>
				  <div id="product">
					<?php if ($options) { ?>
					<div class="heading-title m-bottom-10"><span><?php echo $text_option; ?></span></div>
					<?php foreach ($options as $option) { ?>
					<?php if ($option['type'] == 'select') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
					  <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
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
					  <label class="control-label"><?php echo $option['name']; ?></label>
					  <div id="input-option<?php echo $option['product_option_id']; ?>">
						<?php foreach ($option['product_option_value'] as $option_value) { ?>
						<div class="radio">
						  <label>
							<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
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
					<?php if ($option['type'] == 'checkbox') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
					  <label class="control-label"><?php echo $option['name']; ?></label>
					  <div id="input-option<?php echo $option['product_option_id']; ?>">
						<?php foreach ($option['product_option_value'] as $option_value) { ?>
						<div class="checkbox">
						  <label>
							<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
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
					<?php if ($option['type'] == 'image') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
					  <label class="control-label"><?php echo $option['name']; ?></label>
					  <div id="input-option<?php echo $option['product_option_id']; ?>">
						<?php foreach ($option['product_option_value'] as $option_value) { ?>
						<div class="radio">
						  <label>
							<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
							<img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
							<?php if ($option_value['price']) { ?>
							(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
							<?php } ?>
						  </label>
						</div>
						<?php } ?>
					  </div>
					</div>
					<?php } ?>
					<?php if ($option['type'] == 'text') { ?>
					<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
					  <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
					  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
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
					<div class="form-group">
					  <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
					  <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
					  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
					  <br />
					  <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-fw fa-shopping-cart"></i> <?php echo $button_cart; ?></button>
					  <button type="button" id="button-cart-fixed" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block Fixed"><i class="fa fa-fw fa-shopping-cart"></i> <?php echo $button_cart; ?></button>
					</div>
					<?php if ($minimum > 1) { ?>
					<div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
					<?php } ?>
				  </div>		  
		  </div>
		  
		  <div id="product-details">
			<div class="panel list-group">
				<a href="javascript:void(0);" id="product-description-trigger" class="list-group-item has-hidden-children active" data-toggle="collapse" data-target="#product-description" data-parent="#product-details"><?php echo $tab_description; ?><i class="fa fa-angle-up pull-right"></i></a>
				<div id="product-description" class="details-content collapse">
					<?php echo $description; ?>
				</div>
				
				<?php if ($attribute_groups) { ?>
				<a href="javascript:void(0);" class="list-group-item has-hidden-children" data-toggle="collapse" data-target="#product-specification" data-parent="#product-details"><?php echo $tab_attribute; ?><i class="fa fa-angle-down pull-right"></i></a>
				<div id="product-specification" class="details-content collapse">
					<table class="table table-responsive table-bordered">
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
				<a href="javascript:void(0);" class="list-group-item has-hidden-children" data-toggle="collapse" data-target="#product-review" data-parent="#product-details"><?php echo $tab_review; ?><i class="fa fa-angle-down pull-right"></i></a>
				<div id="product-review" class="details-content collapse">
					<form class="form-horizontal">
						<div id="review"></div>
						<h2><?php echo $text_write; ?></h2>
						<?php if ($review_guest) { ?>
						<div class="form-group required">
						  <div class="col-sm-12">
							<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
							<input type="text" name="name" value="" id="input-name" class="form-control" />
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
			
						<div class="buttons">
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
	  
	  <div class="col-xs-12">
		  <?php if ($products) { ?>
		  <div class="heading-title"><span><?php echo $text_related; ?></span></div>
		  <div id="product-related" class="owl-carousel owl-androidstore-module-theme equal-height-columns">
			<?php foreach ($products as $product) { ?>
			<div class="owl-product">
			  <div class="product-thumb transition">
				<div class="image"><a href="<?php echo $product['href']; ?>"><img data-src="<?php echo $product['thumb']; ?>" src="" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazy" /></a></div>
				<div class="caption equal-height-column">
				  <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
				  <p><?php echo $product['description']; ?></p>
				  <?php if ($product['price']) { ?>
				  <p class="price">
					<?php if (!$product['special']) { ?>
					<?php echo $product['price']; ?>
					<?php } else { ?>
					<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
					<?php } ?>
				  </p>
				  <?php } ?>
				</div>
				<div class="button-group">
				  <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span><?php echo $button_cart; ?></span></button>
				</div>
			  </div>
			</div>
			<?php } ?>
		  </div>
		  <?php } ?>
		  <?php if ($tags) { ?>
		  <p><?php echo $text_tags; ?>
			<?php for ($i = 0; $i < count($tags); $i++) { ?>
			<?php if ($i < (count($tags) - 1)) { ?>
			<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
			<?php } else { ?>
			<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
			<?php } ?>
			<?php } ?>
		  </p>
		  <?php } ?>
	   </div>	  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=android_store/product/getRecurringDescription',
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
$('#button-cart, #button-cart-fixed').on('click', function() {
	$.ajax({
		url: 'index.php?route=android_store/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart, #button-cart-fixed').button('loading');
		},
		complete: function() {
			$('#button-cart, #button-cart-fixed').button('reset');
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
					
					$('html, body').animate({ scrollTop: $("#product").offset().top - 44 }, 'slow');
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				setTimeout(function() { 
					$('.alert.alert-success').fadeOut();
				}, 3000);
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

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

$('#review').load('index.php?route=android_store/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=android_store/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
			$('#captcha').attr('src', 'index.php?route=tool/captcha#'+new Date().getTime());
			$('input[name=\'captcha\']').val('');
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
});

<?php if ($thumb || $images) { ?>
$(document).ready(function() {
    //Init the carousel
    $("#product-image-slideshow").owlCarousel({
		autoPlay: false,
		slideSpeed : 500,
		singleItem : true,
		lazyLoad: true,
		lazyEffect: false,		
		paginationSpeed : 500
    });
});

$('a.photoswipe-thumbnail').on('click', function(){
	var pswpElement = document.querySelectorAll('.pswp')[0];

	// build items array
	var items = [
		<?php if ($thumb) { ?>
		{
			src: '<?php echo $popup; ?>',
			w: <?php echo $photoswipe_image_width; ?>,
			h: <?php echo $photoswipe_image_height; ?>
		},
		<?php } ?>
		
		<?php if ($images) { ?>
		<?php foreach ($images as $image) {?>
		{
			src: '<?php echo $image['popup']; ?>',
			w: <?php echo $photoswipe_image_width; ?>,
			h: <?php echo $photoswipe_image_height; ?>
		},
		<?php } ?>
		<?php } ?>
	];

	var options = {
		index: $(this).closest('.photoswipe-thumbnail').index('.photoswipe-thumbnail'), // start at first slide
		shareEl: false,
		tapToToggleControls: false
	};

	// move top bar under photoswipe gallery
	$('#top').addClass('under-photoswipe');
	
	// Initializes and opens PhotoSwipe
	var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
	gallery.init();
	
	gallery.listen('close', function() {
		$('#top').removeClass('under-photoswipe');
	});
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
$('#product-related').owlCarousel({
	items: 4,
	lazyLoad: true,
	lazyEffect: false,
	pagination: true,
	afterInit : function(elem){
		var that = this
		that.owlControls.prependTo(elem)
    }
});
--></script>

<script type="text/javascript"><!--
$('#product-description-trigger').trigger('click');

$(window).on('scroll', function(){
	if (!$('#button-cart').visible()) {
		$('#button-cart-fixed').show();
	} else {
		$('#button-cart-fixed').hide();
	} 
});

$(window).trigger('scroll');
--></script>
<?php echo $footer; ?>
