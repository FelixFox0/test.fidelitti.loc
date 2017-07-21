<?php echo $header; ?>
<div class="breadcrumbs">
    <nav class="row">
        <ul class="large-12 medium-12 small-12 breadcrumbs__links"> 
          <div class="large-12 medium-12 small-12 sub_category__filter_even">
            <a data-fancybox data-src="#hidden-filter" href="javascript:;">ФИЛЬТР</a>
          </div> 
          <div class="large-12 medium-12 small-12 sub_category__sort_even">
            <a data-fancybox data-src="#hidden-sort" href="javascript:;">СОРТИРОВАТЬ ПО</a>
          </div>
        </ul>  
        
    </nav>
</div>

<? if($power_ct_block == 1) { ?>
<!--
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
      <?php } ?> -->

<div class="row" >
 <div class="large-4 categoryOne__block">
          <a href="xxxx" rel="insert">
            <div>
              <img src="<?php echo $thumbtop_tab_icon; ?>" class="img-responsive" />
            </div>
            <?php echo $descbannerone; ?>
          </a>                      
        </div>
        <div class="large-4 categoryOne__block">
         
           <a href="qqqq" rel="insert">
            <div>
              <img src="<?php echo $thumbtop_tab_icon_two; ?>" class="img-responsive" />
            </div>
            <?php echo $descbanneronetwo; ?>
          </a>                    
        </div>
        <div class="large-4 categoryOne__block">
         
           <a href="wwww" rel="insert">
            <div>
              <img src="<?php echo $thumbtop_tab_icon_three; ?>" class="img-responsive" />
            </div>
            <?php echo $descbanneronethree; ?>
          </a>                      
        </div>
</div>

<div id="insert" class="cat__click">
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

    <div class="clientService__right--click" id="qqqq">
      
      <div class="cat__click--one" style="background: url(<? echo $thumbimagetwotwo; ?>)no-repeat;background-size: 100%;">
        <div><?php echo $descbanneronetwo; ?></div>
      </div>
      <div class="row">
        <div class="large-12 columns cat__click--block">
          <h3><?php echo $titletwotwo; ?></h3>
          <div><?php echo $description_twotwo; ?></div>
        </div>
      
        <div class="large-12 columns cat__click--buttom">
          <a href="<?php echo $linkbuttomtwo; ?>">
            <?php echo $textbuttomtwo; ?>
          </a>
        </div>
        <div class="large-12 cat__click--twoimg columns" style="background: url(<?php echo $thumbimagethreetwo; ?>) no-repeat;background-size: 100%;">
            <?php echo $nameimgthreetwo; ?>
        </div>
        <div class="large-6 cat__click--prodimgone">
          <img src="<?php echo $thumbproductimgonetwo; ?>" class="img-responsive" />
        </div>
        <div class="large-6 columns cat__click--prodone">          
          <?php echo $prodDescImgOnetwo; ?><br />
          <div><a href=""><?php echo $prodNameImgOnetwo; ?></a></div>
        </div>
        <div class="large-4 cat__click--prodtwo">
          <h3><?php echo $prodNameImgTwotwo; ?></h3>
          <div><?php echo $prodDescImgTwotwo; ?></div>
          <div>
            <a href="<?php echo $linkButProdTwotwo; ?>">
              <?php echo $NameButProdTwotwo; ?>
            </a>
          </div>
        </div>
        <div class="large-3 cat__click--prodimgtwo">
          <img src="<?php echo $thumbproductImgTwotwo; ?>" alt="">
        </div>
        <div class="large-5 cat__click--prodimgthreetwo">
          <img src="<?php echo $thumbproductImgThreetwo; ?>" alt="">
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>

    <div class="clientService__right--click" id="wwww">
      
      <div class="cat__click--one" style="background: url(<? echo $thumbimagetwothree; ?>)no-repeat;background-size: 100%;">
        <div><?php echo $descbanneronethree; ?></div>
      </div>
      <div class="row">
        <div class="large-12 columns cat__click--block">
          <h3><?php echo $titletwothree; ?></h3>
          <div><?php echo $description_twothree; ?></div>
        </div>
      
        <div class="large-12 columns cat__click--buttom">
          <a href="<?php echo $linkbuttomthree; ?>">
            <?php echo $textbuttomthree; ?>
          </a>
        </div>
        <div class="large-12 cat__click--twoimg columns" style="background: url(<?php echo $thumbimagethreethree; ?>) no-repeat;background-size: 100%;">
            <?php echo $nameimgthreethree; ?>
        </div>
        <div class="large-6 cat__click--prodimgone">
          <img src="<?php echo $thumbproductimgonethree; ?>" class="img-responsive" />
        </div>
        <div class="large-6 columns cat__click--prodone">          
          <?php echo $prodDescImgOnethree; ?><br />
          <div><a href=""><?php echo $prodNameImgOnethree; ?></a></div>
        </div>
        <div class="large-4 cat__click--prodtwo">
          <h3><?php echo $prodNameImgTwothree; ?></h3>
          <div><?php echo $prodDescImgTwothree; ?></div>
          <div>
            <a href="<?php echo $linkButProdTwothree; ?>">
              <?php echo $NameButProdTwothree; ?>
            </a>
          </div>
        </div>
        <div class="large-3 cat__click--prodimgtwothree">
          <img src="<?php echo $thumbproductImgTwothree; ?>" alt="">
        </div>
        <div class="large-5 cat__click--prodimgthreethree">
          <img src="<?php echo $thumbproductImgThreethree; ?>" alt="">
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>

</div>



<? } else { ?>
<!--
    <div class="row sub_category_title">
        <div class="large-12 columns"><h1><?php echo $heading_title; ?></h1></div>
    </div>
-->

    <div class="row sub_filter">
      <div style="display: none;" id="hidden-filter">
        <div class="large-12" style="height: 94%;">
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


      <div style="display: none;" id="hidden-sort">
            <div class="hidden-sort__title">
              СОРТИРОВАТЬ ПО
            </div>
            <div id="input-sort" class="form-control" onchange="location = this.value;">
              <?php foreach ($sorts as $sorts) { ?>
              <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
              <a href="<?php echo $sorts['href']; ?>" class="sub_sort_hover_here"><?php echo $sorts['text']; ?></a><br>
              <?php } else { ?>
              <a href="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></a>
              <br>
              <?php } ?>
              <?php } ?>
            </div>
      </div>
      
    </div>
    <!-- <div id="content" class="sub_category_top_line"></div> -->
    <div id="content">
   
  <div class="filter_blocks">
    <div class="filter_update" id="filter-list"></div>
    <div id="button-list-reset"></div>
  </div>
    <div class="row sub_category">
    
    <?php $i = 0; ?>
    <?php foreach ($products as $product) { ?>
    <?php $i++; ?>
        
                <div class="product-list large-4 medium-4 small-6 columns sub_category__product aproduct"> 
          <!--
          <a href="<?php echo $product['href']; ?>">
            <div class="sub_category__product--line"></div>
          </a>
          -->
          <!--
           <button type="button" class="tooltips" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
           <span><?php echo $button_wishlist; ?></span>
              <div class="sub_category__product--live"></div>
            </button>
            -->
            <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="" class="sub_category__product--img">
            </a>
            <!--
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
            -->
            <!--
            <a href="<?php echo $product['href']; ?>"><div class="sub_category__product--here">Посмотреть продукт</div></a>
            <a href="<?php echo $product['href']; ?>">
            <div class="sub_category__product--lineBottom"></div>
            </a>
            -->
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
        <!--
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
        -->
    <? } ?>
 <?php if ($totalproducts - ($page * $limit) > 0) { ?>
                    <div id="ajax-button" class="product-list large-4 medium-4 small-6 columns sub_category__product"><a
                                class="abjmax btn btn-product" onclick="aj();"><p>Показать
                                еще <?php echo (($totalproducts - ($page * $limit)) > $limit) ? $limit : ($totalproducts - ($page * $limit)); ?></p>
                        </a></div>
                    <div style="display:none" id="category_id"><?php echo $category_id; ?></div>
                    <div style="display:none" id="totalproducts"><?php echo $totalproducts; ?></div>
                    <div style="display:none" id="default_limit"><?php echo $default_limit; ?></div>
                    <div style="display:none" id="apage"><?php echo $page; ?></div>        <?php } ?> 
    </div> 
    </div>

     <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right text-right__page"><?php echo $results; ?></div>

<? } ?>
   
      
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>

<?php echo $footer; ?>

