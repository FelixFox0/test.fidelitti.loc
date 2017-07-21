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
<div class="row categoryOne">
  <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <?php echo $content_top; ?>
      <?php if ($categories) { ?>
      <?php if (count($categories) <= 5) { ?>
        <?php foreach ($categories as $category) { ?>
       <div class="large-4 categoryOne__block">
          <a href="<?php echo $category['category_id']; ?>" rel="insert">
            <div>
              <img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>" class="img-responsive" />
            </div>
            <?php echo $category['name']; ?>
          </a>                        
        </div><?php } ?>
</div>
<div id="insert" class="cat__click">
  <?php foreach ($categories as $category) { ?>
    <div class="clientService__right--click" id="<?php echo $category['category_id']; ?>">
      
      <div class="cat__click--one" style="background: url(<? echo $category['imagetwo']; ?>)no-repeat;background-size: 100%;">
        <div><?php echo $category['name']; ?></div>
      </div>
      <div class="row">
        <div class="large-12 columns cat__click--block">
          <h3><?php echo $category['titletwo']; ?></h3>
          <?php echo $category['description_two']; ?>
        </div>
      
        <div class="large-12 columns cat__click--buttom">
          <a href="<?php echo $category['linkbuttom']; ?>">
            <?php echo $category['textbuttom']; ?>
          </a>
        </div>
        <div class="large-12 cat__click--twoimg columns" style="background: url(<?php echo $category['imagethree']; ?>) no-repeat;background-size: 100%;">
            <?php echo $category['nameimgthree']; ?>
        </div>
        <div class="large-6 cat__click--prodimgone">
          <img src="<?php echo $category['productimgone']; ?>" class="img-responsive" />
        </div>
        <div class="large-6 columns cat__click--prodone">          
          <?php echo $category['prodDescImgOne']; ?><br />
          <div><a href=""><?php echo $category['prodNameImgOne']; ?></a></div>
        </div>
        <div class="large-4 cat__click--prodtwo">
          <h3><?php echo $category['prodNameImgTwo']; ?></h3>
          <div><?php echo $category['prodDescImgTwo']; ?></div>
          <div>
            <a href="<?php echo $category['linkButProdTwo']; ?>">
              <?php echo $category['NameButProdTwo']; ?>
            </a>
          </div>
        </div>
        <div class="large-3 cat__click--prodimgtwo">
          <img src="<?php echo $category['productImgTwo']; ?>" alt="">
        </div>
        <div class="large-5 cat__click--prodimgthree">
          <img src="<?php echo $category['productImgThree']; ?>" alt="">
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>
   <? } ?>
</div>
               

     
      <?php } else { ?>
        <?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
        <div class="col-sm-3">
          <ul>
            <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
      <?php } ?>
      <?php } ?>
      
      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>

<?php echo $footer; ?>
