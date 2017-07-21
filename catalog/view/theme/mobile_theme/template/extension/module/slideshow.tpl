<?php foreach ($banners as $banner) { ?>
<? if($banner['width'] > 780 ) {?>
<div id="slideshow<?php echo $module; ?>" class="owl-carousel large-12 medium-12" style="opacity: 1;">
<? }elseif($banner['width'] > 600 ) { ?>
<div id="slideshow<?php echo $module; ?>" class="owl-carousel large-6 medium-6" style="opacity: 1;">
<? }elseif($banner['width'] < 466 ) { ?>
<div id="slideshow<?php echo $module; ?>" class="owl-carousel large-4 medium-4" style="opacity: 1;">
<? }else{ ?>
<div id="slideshow<?php echo $module; ?>" class="owl-carousel large-12 medium-12" style="opacity: 1;">
<? } ?>
<? } ?>
  <?php foreach ($banners as $banner) { ?>
  <div class="slider__item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
      <div class="slider__title">
        <?php echo $banner['title']; ?>        
      </div>
      <!--<div class="slider__title-two">
        <?php echo $banner['title_two']; ?>
      </div> -->
    </a>
      <div class="slider__button">
        <a href="<?php echo $banner['link']; ?>"><?php echo $banner['title_buttom']; ?></a>
      </div>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>