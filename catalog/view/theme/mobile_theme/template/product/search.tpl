<?php echo $header; ?>

<? if($power_ct_block == 1) { ?>

<? } else { ?>
<div id="content">
    <div class="row sub_filter sub_filter_search">
      <div class="large-12">
      </div>
      <div class="large-12">
      <label class="control-label" id="input-search__label" for="input-search"><?php echo $entry_search; ?></label>
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
        <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
      </div>
        <!--
        <div class="col-sm-3">
          <label class="checkbox-inline">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="sub_category" value="1" />
            <?php } ?>
            <?php echo $text_sub_category; ?></label>
        </div>
       
      
      <p>
        <label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </p>
      -->
      <div id="sub_filter_hover" class="large-12" style="display: none; top:0;">
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
    <!-- <div id="content" class="sub_category_top_line"></div> -->
    <div>
     <div class="row sub_category">
    
    <?php $i = 0; ?>
    <?php foreach ($products as $product) { ?>
    <?php $i++; ?>
        <div class="product-list large-4 medium-4 small-6 columns sub_category__product">
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
    <? } ?>
    </div> 
</div>
     <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>

<? } ?>
   
      
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>


<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
  url = 'index.php?route=product/search';

  var search = $('#content input[name=\'search\']').prop('value');

  if (search) {
    url += '&search=' + encodeURIComponent(search);
  }

  var category_id = $('#content select[name=\'category_id\']').prop('value');

  if (category_id > 0) {
    url += '&category_id=' + encodeURIComponent(category_id);
  }

  var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

  if (sub_category) {
    url += '&sub_category=true';
  }

  var filter_description = $('#content input[name=\'description\']:checked').prop('value');

  if (filter_description) {
    url += '&description=true';
  }

  location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
  if (e.keyCode == 13) {
    $('#button-search').trigger('click');
  }
});

$('select[name=\'category_id\']').on('change', function() {
  if (this.value == '0') {
    $('input[name=\'sub_category\']').prop('disabled', true);
  } else {
    $('input[name=\'sub_category\']').prop('disabled', false);
  }
});

$('select[name=\'category_id\']').trigger('change');
--></script>
<?php echo $footer; ?>









