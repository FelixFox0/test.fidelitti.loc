<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<!-- Css -->
<link rel="icon" href="http://www.fidelitti.com/wp-content/uploads/2016/04/cropped-fidelitti_icon-32x32.png">
<link rel="stylesheet" href="/catalog/view/theme/fidelitti/stylesheet/app.css">
<link rel="stylesheet" href="/catalog/view/theme/fidelitti/stylesheet/bootstrap.css">
<link rel="stylesheet" href="/catalog/view/theme/fidelitti/stylesheet/foundation.css" />
<link rel="stylesheet" href="/catalog/view/javascript/bxslider/jquery.bxslider.css" />
    
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="catalog/view/javascript/jquery.tabslideout.v1.2.js" type="text/javascript"></script>
    <script src="/catalog/view/javascript/vendor/foundation.js"></script>
    <script src="/catalog/view/javascript/jquery.lockfixed.min.js"></script>
    <?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="http://coolcarousels.frebsite.nl/c/17/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
    <script src="/catalog/view/javascript/common.js"></script>
     <script src="/catalog/view/javascript/jquery/jquery.cookie.js"></script>
    <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
    <?php } ?>
    <script>
        $(document).foundation();
    </script>
</head>
<body style="min-width:900px;">
	<div style="float:left;" id="image">
		<!--<img src="image/CountrySelector.jpg" style="height:100%;position:absolute" />-->
	</div>
	<div style="padding-top:50px;" id="countries">
		<div style="text-align:center;padding-bottom:35px;border-bottom: 1px solid #ddd;margin-bottom:50px;"><?= $text_choose_region; ?></div>
		<div style="column-count:3;padding-left:80px;">
			<?php foreach ($columns as $column) { ?>
				<?php foreach ($column as $city) { ?>
					<div class="prmn-cmngr-cities__city none<?= $city['fias_id']; ?>">
						<a class="prmn-cmngr-cities__city-name <?= $city['fias_id']; ?>" data-id="<?= $city['fias_id']; ?>">
							<!--<img src="/image/country/<?= $city['image']; ?>.png" alt="">-->
							<?php if ($actual_language == "ru-ru"){ ?>
								<?= $city['country_ru']; ?>
							<? } elseif ($actual_language == "en-gb"){ ?>
								<?= $city['image']; ?>
							<? }else{ ?>
								<?= $city['country_ua']; ?>
							<? } ?>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	<script>
	$('a').on('click', function(){
		$.get('index.php?route=module/progroman/city_manager/save&fias_id=' + this.dataset.id,
			function(json) {
				console.log(json);
				if (json.success) {
					window.location.href='index.php?route=common/home';
				}
			},
			'json'
		);
	});
	var img=new Image(); 
	img.onload=function(){
		document.getElementById('image').appendChild(img);
		var margin=document.querySelector('img').offsetWidth/window.innerWidth*100;
		document.querySelector('#countries').style.marginLeft=margin+'%';
	}
	img.style.position='absolute';
	img.style.height='100%';
	img.src='image/CountrySelector.jpg';

	window.onresize=function(){
		var margin=document.querySelector('img').offsetWidth/window.innerWidth*100;
		document.querySelector('#countries').style.marginLeft=margin+'%';
	}
	</script>
</body>
</html>