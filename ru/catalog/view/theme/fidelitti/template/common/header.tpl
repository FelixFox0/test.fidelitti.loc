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
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" />
<!-- Css -->
<link rel="icon" href="http://www.fidelitti.com/wp-content/uploads/2016/04/cropped-fidelitti_icon-32x32.png">
<link rel="stylesheet" href="/catalog/view/theme/fidelitti/stylesheet/app.css">
<link rel="stylesheet" href="/catalog/view/theme/fidelitti/stylesheet/foundation.css" />
<link rel="stylesheet" href="/catalog/view/javascript/bxslider/jquery.bxslider.css" />
    
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
    <script src="/catalog/view/javascript/common.js"></script>
    <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">


<?php echo $currency; ?>
    <?php echo $language; ?>
<?php if ($logged) { ?>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
    <header class="row header">
        <div class="large-4 columns large-offset-4 header__logo">
            <?php if ($logo) { ?>
            <?php if ($home == $og_url) { ?>
              <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
            <?php } else { ?>
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
            <?php } ?>
          <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
        <div class="large-4 columns">
           <div class="header__lang">
              <div class="delivery_block">
                    <a href="#text-popupq" class="popup-content">
                       <img src="/catalog/view/theme/fidelitti/images/country/ukraine.png" alt="">
                    </a>
                    <?php echo $language; ?>                
            </div>
        </div>
    </header>
    <div class="row nav">
       <div class="menu">
            <ul id="nav">
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['children']) { ?>
                    <li>
                        <a href="<?php echo $category['href']; ?>">
                            <?php echo $category['name']; ?>
                        </a>
                        <span id="s1"></span>
                        <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                        <ul class="subs">
                                            <?php foreach ($children as $child) { ?>
                <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="<?php echo $child['href']; ?>">
                        <?php echo $child['name']; ?>
                    </a>
                    </div>
                    <?php     if ($child['children']) {?>
                         <div class="child">
                             <ul class="list-unstyled">
                         <?php foreach ($child['children'] as $child) { ?>
                            <li>
                                <a href="<?php echo $child['href']; ?>">
                                    <?php echo $child['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                            </ul>
                             <ul>
                                <li>
                                <img src="/catalog/view/theme/fidelitti/images/product/Zaino_Mini_Blackberry_AR-01.jpg">
                                </li>
                                 <li>
                                <img src="/catalog/view/theme/fidelitti/images/product/Zaino_Mini_Blackberry_AR-02.jpg">
                                </li>
                             </ul>
                        </div>
                    <?php } ?>
                </li>
                <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="mob_menu">
            меню
        </div>
        <div class="service-block">
            <a href="#text-popup" class="popup-content">
                <img src="/catalog/view/theme/fidelitti/images/call-answer.png" alt="">
            </a>
            <a href="<?php echo $login; ?>">
                <img src="/catalog/view/theme/fidelitti/images/user.png" alt="">
            </a>
            <?php echo $cart; ?>
            
            <div class="parent_block">
              <div class="button">
                 <img src="/catalog/view/theme/fidelitti/images/search.png" alt="">
              </div>
              <div class="toggled_block">
                <?php echo $search; ?>  
              </div>
            </div>
        </div>
        
    </div>

    

    
