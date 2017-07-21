<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
<link rel="stylesheet" href="/catalog/view/theme/mobile_theme/stylesheet/app.css">
<link rel="stylesheet" href="/catalog/view/theme/mobile_theme/stylesheet/bootstrap.css">
<link rel="stylesheet" href="/catalog/view/theme/mobile_theme/stylesheet/foundation.css" />
<link rel="stylesheet" href="/catalog/view/javascript/bxslider/jquery.bxslider.css" />
    
    <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery.tabslideout.v1.2.js" type="text/javascript"></script>
    <script src="/catalog/view/javascript/vendor/foundation.js"></script>

    <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery.accordion.css">
    <script type="text/javascript" src="catalog/view/javascript/jquery.accordion.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.accordion').accordion({
        "transitionSpeed": 400
});
      });
    </script>

    <script src="/catalog/view/javascript/jquery.lockfixed.min.js"></script>
    <?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="http://coolcarousels.frebsite.nl/c/17/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
    <script src="catalog/view/theme/mobile_theme/js/common.js"></script>
     <script src="/catalog/view/javascript/jquery/jquery.cookie.js"></script>
    <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript"></script>
    <?php } ?>
     
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>


        <link type="text/css" rel="stylesheet" href="/catalog/view/theme/mobile_theme/js/jquery.mmenu.all.css" />

        <script type="text/javascript" src="/catalog/view/theme/mobile_theme/js/jquery.mmenu.all.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('nav#menu').mmenu();
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('div#cart').mmenu({
                    "offCanvas": {
                        "position": "right"
                     }
                });
            });
        </script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>



<style type="text/css">
	#page-preloader {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background: #fff;
    z-index: 100500;
}

#page-preloader .spinner {
    width: 100px;
    height: 100px;
    position: absolute;
    left: 40%;
    top: 45%;
    background: url('/catalog/view/theme/mobile_theme/images/cropped-fidelitti_icon-192x192.gif') no-repeat 50% 50%;
    margin: -16px 0 0 -16px;
    background-size: contain;
}
</style>   
<script type="text/javascript">
	$(window).on('load', function () {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.delay(350).fadeOut('slow');
});
</script> 
<script src="/catalog/view/theme/mobile_theme/js/jquery.progroman.city-manager.js" type="text/javascript"></script>    

				<script type="text/javascript" src="catalog/view/javascript/lazyload/jquery.lazyload.min.js"></script>
				<script type="text/javascript">
				$(function() {
				    $("img.lazy-load").lazyload({
				        event : "sporty",
				         effect : "fadeIn",
				         threshold : 200,
				        placeholder : "catalog/view/javascript/lazyload/loading.gif"
				    });
				});

				$(window).bind("load", function() {
				    var timeout = setTimeout(function() { $("img.lazy-load").trigger("sporty") }, 1000);
				});
				</script>
			
</head>
<body class="<?php echo $class; ?> aaaaaaaaaa">
<div id="page-preloader"><span class="spinner"></span></div>
<? if (strpos($og_url, 'simplecheckout') !== false) { ?>
<div id="page">
<div class="header">
    <div class="large-3 columns large-offset-5 header__logo default header__logo__img">
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
</div>
<? } else { ?>

<nav id="menu">
                <ul>
                    <div>
                        <?php echo $search; ?>
                    </div>
                    <div class="mobile_phone">
                        <a href="tel:0800210385"><div><img src="/catalog/view/theme/mobile_theme/images/menu_icon_phone.png">0 800 210 385</div></a>
                    </div>
                    <li><a href="/">Главная</a></li>
                    <?php foreach ($categories as $category) { ?>
                    <?php if ($category['children']) { ?>
                    <li><span><?php echo $category['name']; ?></span>
                        <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                        <ul>
                        <div class="vertical__img">
                            <img src="<?php echo $category['thumb']; ?>">                    
                        </div>
                        <div class="vertical__name"><?php echo $category['name']; ?></div>
                            <?php foreach ($children as $child) { ?>
                            <?php     if ($child['children']) {?>                            
                            <li><span><?php echo $child['name']; ?></span>
                            
                            		<ul>
                            		<li><a href="<?php echo $child['href']; ?>">Смотреть все</a></li>
                            		<?php foreach ($child['children'] as $child) { ?>
									<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
									<?php } ?>
								</ul>
                            </li>
                            <?php }else{ ?>
                            	<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                            <? } ?>  
                            <?php } ?>   
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                    <?php } ?>
                    <li><span>Мир fidelitti</span>
                        <ul>
                            <div class="vertical__img">
                                <img src="/catalog/view/theme/mobile_theme/image/img_3.jpg">                    
                            </div>
                            <div class="vertical__name">Мир fidelitti</div>
                            <li>
                                <a href="/all_news/">
                                     Новости и мероприятия
                                </a>
                            </li>
                            <li>
                                <a href="">
                                     #Fidelittigirls
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><span>О компании</span>
                        <ul>
                            <div class="vertical__img">
                                <img src="/catalog/view/theme/mobile_theme/image/img_3.jpg">                    
                            </div>
                            <div class="vertical__name">О компании</div>
                            <li>
                                <a href="/my_company">
                                    О компании
                                </a>
                            </li>
                            <li>
                                <a href="/contact-us/">
                                    Сотрудничество
                                </a>
                            </li>
                            <li>
                                <a href="/our_production">
                                     Наше производство
                                </a>
                            </li>
                            <li>
                                <a href="/works">
                                     Вакансии
                                </a>
                            </li>
                            <li>
                                <a href="/contact-us/">
                                     Контакты
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/client_service" class="client_service">
                        Обслуживание клиентов <img src="/catalog/view/theme/mobile_theme/images/icon_phone.png" alt="">
                        </a>
                    </li>
                    <li>
                        <div class="mobile_auth">
                            <?php if ($logged) { ?>
                            <li><a class="mobile_auth" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                            <?php } else { ?>
                            <li><a class="mobile_auth" href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
                            <?php } ?>
                        </div>
                    </li>
                    <div class="prmn-cmngr" data-confirm="true"></div>
                    <div class="mobile_lang">
                        <?php if ($actual_language == "ru-ru"){ ?>
                        <a data-fancybox data-src="#hidden-content" href="javascript:;" class="white-popup_lang popup_lang_old">
                            <div class="mobile_lang__icon"><div></div></div> Русский
                        </a>
                        <? } elseif ($actual_language == "en-gb"){ ?>
                        <a data-fancybox data-src="#hidden-content" href="javascript:;" class="white-popup_lang popup_lang_old">
                           <div class="mobile_lang__icon"><div></div></div>  Английский
                        </a>
                        <? }else{ ?>
                        <a data-fancybox data-src="#hidden-content" href="javascript:;" class="white-popup_lang popup_lang_old">
                            <div class="mobile_lang__icon"><div></div></div> Украинский
                        </a>
                        <? } ?>
                    </div>   
                    <?php echo $language; ?>                 
                </ul>
            </nav>
<div id="page"> 
<?php echo $quicksignup; ?>
<li class="quick-login"><a class="quick_signup"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $signin_or_register ?></span></a></li>
<div class="header">
    <a href="#menu" class="menu_click"><span></span></a>
    <div class="large-3 columns large-offset-5 header__logo default header__logo__img">
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
    <?php echo $cart; ?>
</div>

<? } ?>        <!--BOF Product Series-->
			<style>	
				.pds a, .pds a:hover, .pds a:visited
				{
					text-decoration: none;
				}
			
				.pds a.preview
				{
					display: inline-block;
				}
				
				.pds a.preview.pds-current, .pds a.pds-current
				{
					border-bottom: 3px solid orange;
				}
				
				#preview{
					position: absolute;
					border: 1px solid #DBDEE1;
					background: #F8F8F8;
					padding: 5px;
					display: none;
					color: #333;
					z-index: 1000000;
				}
			</style>
			<script type="text/javascript" src="catalog/view/javascript/imagepreview/imagepreview.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					pdsListRollover();
				});
				
				function pdsListRollover()
				{
					$('.pds a.pds-thumb-rollover').hover(function(){
						//on hover
						$this = $(this);
						var hoverImage = $this.attr('rel');
						$this.parents('.product-thumb').find('.image a img').attr('src', hoverImage);
					}, function(){
						//on unhover
						$this = $(this);
						var masterImage = $this.attr('master-image');
						$this.parents('.product-thumb').find('.image a img').attr('src', masterImage);
					});
				}
			</script>
			<!--EOF Product Series-->