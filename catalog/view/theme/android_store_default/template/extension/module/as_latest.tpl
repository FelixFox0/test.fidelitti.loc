<div class="heading-title"><span><?php echo $heading_title; ?></span></div>
<div id="android-store-latest-<?php echo $module; ?>" class="owl-carousel owl-androidstore-module-theme equal-height-columns">
  <?php foreach ($products as $product) { ?>
  <div class="owl-product">
    <div class="product-thumb transition">
	  <div class="addtocart-progress addtocart-progress-<?php echo $product['product_id']; ?>"></div>	
      <div class="image"><a href="<?php echo $product['href']; ?>"><img data-src="<?php echo $product['thumb']; ?>" src="" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazyOwl" /></a></div>
      <div class="caption equal-height-column">
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
        <p class="description"><?php echo $product['description']; ?></p>
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
        <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-fw fa-shopping-cart"></i> <span><?php echo $button_cart; ?></span></button>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<script type="text/javascript"><!--
$('#android-store-latest-<?php echo $module; ?>').owlCarousel({
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
