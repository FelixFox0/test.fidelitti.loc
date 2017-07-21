<div id="android-store-promote-alert" style="background: <?php echo $background_color; ?> !important; ">
	<a href="<?php echo $link; ?>" style="color: <?php echo $text_color;?> !important;"><i class="fa fa-fw fa-download"></i> <?php echo $message; ?></a>
	<button class="close" id="android-store-promo-close" data-dismiss="alert" type="button" style="color: <?php echo $text_color;?> !important;">×</button>
</div>

<script type="text/javascript"><!--
$(document).ready(function(){
	$('#android-store-promo-close').on('click', function(){
		$.ajax({
			type: 'GET',
			url: 'index.php?route=android_store/promote/disable',
			dataType: 'json',
			success: function(json){
				// will see later if will do something with response
			}
		});
	});
});
//--></script>