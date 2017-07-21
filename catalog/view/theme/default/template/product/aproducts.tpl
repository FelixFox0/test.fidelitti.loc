      <?php if ($products) { ?>
        <?php foreach ($products as $product) { ?>
        <div class="product-list large-4 medium-4 small-6 columns sub_category__product aproduct">
            <a href="/index.php?route=product/quick_view&product_id=<? echo $product['product_id']; ?>" class="ajax-popup-link"><img src="/catalog/view/theme/mobile_theme/images/icon-cart.png"></a>
            <a href="<?php echo $product['href']; ?>">
            <img class="lazy-load" data-original="<?php echo $product['thumb']; ?>" alt="">
            </a>
            <div class="dop_img">
            <a href="<?php echo $product['href']; ?>">
              <?php foreach ($product['dop_img'] as $img) { ?>
                <img src="<?php echo $img;?>">
              <?php } ?>
            </a>
            </div>
            <a href="<?php echo $product['href']; ?>">
              <div class="sub_category__product--desc"><?php echo $product['name']; ?></div>             
            </a>
            <div class="sub_category__product--price">
              <?php if ($product['price']) { ?>
                <span class="price">
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
                </p>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
      <?php } ?>