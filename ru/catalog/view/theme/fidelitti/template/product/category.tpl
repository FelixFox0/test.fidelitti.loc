<?php echo $header; ?>
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

<? if($power_ct_block == 1) { ?>
 <?php if ($thumb || $description) { ?>
      <div class="row">
        <?php if ($thumb) { ?>
        <div class="col-sm-2"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail" /></div>
        <?php } ?>
        <?php if ($description) { ?>
        <div class="col-sm-10"><?php echo $description; ?></div>
        <?php } ?>
      </div>
      <hr>
      <?php } ?>



<div class="clientService__right--click" id="xxxx">
      
      <div class="cat__click--one" style="background: url(<? echo $thumbimagetwo; ?>)no-repeat;background-size: 100%;">
        <div><?php echo $descbannerone; ?></div>
      </div>
      <div class="row">
        <div class="large-12 columns cat__click--block">
          <h3><?php echo $titletwo; ?></h3>
          <div><?php echo $description_two; ?></div>
        </div>
      
        <div class="large-12 columns cat__click--buttom">
          <a href="<?php echo $linkbuttom; ?>">
            <?php echo $textbuttom; ?>
          </a>
        </div>
        <div class="large-12 cat__click--twoimg columns" style="background: url(<?php echo $thumbimagethree; ?>) no-repeat;background-size: 100%;">
            <?php echo $nameimgthree; ?>
        </div>
        <div class="large-6 cat__click--prodimgone">
          <img src="<?php echo $thumbproductimgone; ?>" class="img-responsive" />
        </div>
        <div class="large-6 columns cat__click--prodone">          
          <?php echo $prodDescImgOne; ?><br />
          <div><a href=""><?php echo $prodNameImgOne; ?></a></div>
        </div>
        <div class="large-4 cat__click--prodtwo">
          <h3><?php echo $prodNameImgTwo; ?></h3>
          <div><?php echo $prodDescImgTwo; ?></div>
          <div>
            <a href="<?php echo $linkButProdTwo; ?>">
              <?php echo $NameButProdTwo; ?>
            </a>
          </div>
        </div>
        <div class="large-3 cat__click--prodimgtwo">
          <img src="<?php echo $thumbproductImgTwo; ?>" alt="">
        </div>
        <div class="large-5 cat__click--prodimgthree">
          <img src="<?php echo $thumbproductImgThree; ?>" alt="">
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>





<? } else { ?>
    <div class="row sub_category_title">
        <div class="large-12 columns"><h1><?php echo $heading_title; ?></h1></div>
    </div>
    <div class="row sub_filter">
      <div class="large-2 sub_category__filter">
         <a class="open-content" href="javascript:collapsElement('sub_filter_hover')" title="" rel="nofollow">Уточнить поиск</a>
      </div>      
      <div id="sub_filter_hover" class="large-12" style="top: -99999px">
        <?php echo $content_top; ?>
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
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

<? } ?>
   
      
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>

<?php echo $footer; ?>









