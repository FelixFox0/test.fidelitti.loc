<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.recliner.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/android_store_default/stylesheet/android_store_stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/android_store_default/stylesheet/jquery.mmenu.all.css" rel="stylesheet" />
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery.mmenu.min.all.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.mmenu.backbutton.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.mmenu.fixedelements.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.bootstrap-autohidingtopnavbar.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.bootstrap-autohidingbottomnavbar.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/jquery.jscroll.js" type="text/javascript"></script>
<script src="catalog/view/javascript/android_store_common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?> <?php echo ($argus) ? 'argus' : 'non-argus'; ?>">
<?php echo $device_check; ?>

<div class="loading-mask">
	<div class="loading-spinner fa-spin"></div>
</div>

<nav id="slide-menu-left"><?php echo $menu_left; ?></nav>
<?php if ($menu_right) { ?>
<nav id="slide-menu-right"><?php echo $menu_right; ?></nav>
<?php } ?>
<?php if ($menu_filter) { ?>
<nav id="slide-menu-filter"><?php echo $menu_filter; ?></nav>
<?php } ?>

<div id="page"><!-- start mmenu wrapper page -->
<?php echo $menu_top; ?>

<?php echo $push_notification; ?>