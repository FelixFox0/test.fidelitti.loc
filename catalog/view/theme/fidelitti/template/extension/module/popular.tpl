<div class="lange-12 medium-12 small-12 columns product-recommend__title">
  <?php echo $heading_title; ?>
</div>
<div class="large-12 medium-12 small-12 columns product-recommend__block">
  <div class="outside">
    <span id="slider-prev"></span> <span id="slider-next"></span>
  </div>
  <div class="slider1">
  <?php foreach ($products as $product) { ?>
    <div class="slide">
      <div class="product-carousel">
      <!--
      <a href="<?php echo $product['href']; ?>">
        <div class="product-carousel--line"></div>
      </a>
        <button type="button" class="tooltips" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
          <span><?php echo $button_wishlist; ?></span>
          <div class="product-carousel--live"></div>
        </button>
        -->
        <a href="<?php echo $product['href']; ?>">
        <img class="js-hover" src="<?php echo $product['thumb']; ?>" <?php foreach ($product['additional_img'] as $additional_img) { ?> data="<?php echo $additional_img;?>"<?php } ?> alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
        </a>
        <div class="product-carousel--name"><?php echo $product['name']; ?></div>
        <div class="product-carousel--price">
            <?php if ($product['price']) { ?>
              <?php if (!$product['special']) { ?>
              <div class="product-carousel--basic"><?php echo $product['price']; ?></div>
              <?php } else { ?>
              <div class="product-carousel--priceSale">
                <?php echo $product['price']; ?>
              </div>
              <div class="product-carousel--priceNew">
                <?php echo $product['special']; ?>
              </div>               
              <?php } ?>
              <?php if ($product['tax']) { ?>
              <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
              <?php } ?>
            <?php } ?>
        </div>
        <!--
        <a href="<?php echo $product['href']; ?>">
        <div class="product-carousel--here">Посмотреть продукт</div>
        </a>
        <a href="<?php echo $product['href']; ?>">
        <div class="product-carousel--lineBottom"></div>
        </a>
        -->
      </div>
     </div>
  <?php } ?>
  </div>
</div>



<script>
$(function(){
 
  //onhover image
  $('.js-hover').hover(function() {
    var _this = this,
      images = _this.getAttribute('data').split(','),
      counter = 0;
 
    this.setAttribute('data-src', this.src);
    _this.timer = setInterval(function(){
      if(counter > images.length) {
        counter = 0;
      }
      if (images[counter] != undefined) {
        _this.src = images[counter];
      } else {
        _this.src = _this.getAttribute('data-src');
      }
    });
 
  }, function() {
    this.src = this.getAttribute('data-src');
    clearInterval(this.timer);
  });
 
});
</script>
