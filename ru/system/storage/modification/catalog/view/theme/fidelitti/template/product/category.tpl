<?php echo $header; ?><?php if( ! empty( $mfilter_json ) ) { echo '<div id="mfilter-json" style="display:none">' . base64_encode( $mfilter_json ) . '</div>'; } ?>
<div class="breadcrumbs">
    <nav class="row">
        <ul class="large-12 breadcrumbs__links">               
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
    <div class="row sub_category_title">
        <div class="large-12 columns"><h1><?php echo $heading_title; ?></h1></div>
    </div>
    <div class="row sub_filter">
      <div class="large-12 sub_category__filter">
         Уточнить поиск
         <?php echo $content_top; ?><div id="mfilter-content-container">
      </div>
    </div>
    <div id="content" class="sub_category_top_line"></div>
    <div class="row sub_category">
    
    <?php $i = 0; ?>
    <?php foreach ($products as $product) { ?>
    <?php $i++; ?>
        <div class="large-3 columns sub_category__product">
          <a href="<?php echo $product['href']; ?>">
            <div class="sub_category__product--line"></div>
          </a>
           <button type="button" class="tooltips" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
           <span><?php echo $button_wishlist; ?></span>
              <div class="sub_category__product--live"></div>
            </button>
            <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="" class="sub_category__product--img">
            </a>
            <div class="sub_category__product--name">
              <?php echo $product['name']; ?>
            </div>
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
            <a href="<?php echo $product['href']; ?>"><div class="sub_category__product--here">Посмотреть продукт</div></a>
            <a href="<?php echo $product['href']; ?>">
            <div class="sub_category__product--lineBottom"></div>
            </a>
        </div>
        <?php if ($i == 6) { ?>
          <?php if($thumbcategoryBanner) { ?>
            <div class="large-6 columns sub_category__banner">
              <img src="<?php echo $thumbcategoryBanner; ?>" alt="">
            </div>
          <?php } ?>
        <? } ?>
        <?php if ($i == 6) { ?>
          <?php if($thumbcategoryBannerTwo) { ?>
            <div class="large-6 columns sub_category__banner">
              <img src="<?php echo $thumbcategoryBannerTwo; ?>" alt="">
            </div>
          <?php } ?>
        <? } ?>
    <? } ?>
    </div> 

     <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>


<?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    
   
      
      </div><?php echo $content_bottom; ?>
    <?php echo $column_right; ?>

<?php echo $footer; ?>









