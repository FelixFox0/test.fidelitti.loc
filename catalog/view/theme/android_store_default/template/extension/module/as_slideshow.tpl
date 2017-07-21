<div id="android-store-slideshow-<?php echo $module; ?>" class="owl-carousel owl-androidstore-slideshow-theme" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img data-src="<?php echo $banner['image']; ?>" src="" alt="<?php echo $banner['title']; ?>" class="img-responsive lazyOwl" /></a>
    <?php } else { ?>
    <img data-src="<?php echo $banner['image']; ?>" src="" alt="<?php echo $banner['title']; ?>" class="img-responsive lazyOwl" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
    //Init the carousel
    $("#android-store-slideshow-<?php echo $module; ?>").owlCarousel({
		autoPlay: <?php echo $slide_time; ?>,
		slideSpeed : <?php echo $transition_time; ?>,
		singleItem : true,
		lazyLoad: true,
		lazyEffect: false,
		paginationSpeed : <?php echo $transition_time; ?>
    });
});
--></script>