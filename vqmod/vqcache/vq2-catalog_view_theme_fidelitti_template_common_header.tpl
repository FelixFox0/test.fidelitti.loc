<?  
    if ($_SERVER['REQUEST_URI'] == '/deliverys_en'){
        header( 'Location: /deliverys', true, 301 );
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/payment_en'){
        header( 'Location: /payment', true, 301 );
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/deliverys_ru'){
        header( 'Location: /deliverys', true, 301 );
        exit;
    }
    if ($_SERVER['REQUEST_URI'] == '/payment_ru'){
        header( 'Location: /payment', true, 301 );
        exit;
    }
?>
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
     
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<script src="/catalog/view/theme/fidelitti/js/jquery.progroman.city-manager.js" type="text/javascript"></script>

<script type="text/javascript">
    $(window).on('load', function () {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.delay(350).fadeOut('slow');
});
</script> 

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
    left: 48%;
    top: 45%;
    background: url('/catalog/view/theme/mobile_theme/images/cropped-fidelitti_icon-192x192.gif') no-repeat 50% 50%;
    margin: -16px 0 0 -16px;
    background-size: contain;
}
</style>   

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
<?php echo $quicksignup; ?>
<!--
<li class="quick-login"><a class="quick_signup"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $signin_or_register ?></span></a></li>
-->
 <div class="search__block" style="display: none;">
    <div></div> 
    <div class="search__block__pol"><?php echo $search; ?></div>
     
</div>
<div class="header-text">
        <div class="large-2">
            <div class="prmn-cmngr" data-confirm="true"></div>
        </div>
         <div class="large-2 columns">
            <?php echo $language; ?>
        </div>
        <div class="anime_mass"><div id="message"></div></div>
        <div class="header-text__right">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
        </div>
</div>
    <header class="row header">
        <div class="large-3 columns large-offset-5 header__logo default">

            <?php if ($logo) { ?>
            <?php if ($home == $og_url) { ?>
            <div class="boutique">ОНЛАЙН - БУТИК</div>
              <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive header__logo__img" />
            <?php } else { ?>
            <div  class="boutique">ОНЛАЙН - БУТИК</div>
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive header__logo__img" /></a>
            <?php } ?>
          <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
    </header>


<div class="panel">
    <div>
        <?php echo $search; ?>
    </div>
	<a class="handle" href="#">Content</a> <!-- Ссылка для пользователей с отключенным JavaScript -->
	<ul class="vertical" data-drilldown> 
        <li>
            <a href="/">
                Главная
            </a>
        </li>   
    <?php foreach ($categories as $category) { ?>
       <?php if ($category['children']) { ?>
          <li>
            <a href="#Item-1">
                <?php echo $category['name']; ?><div class="mobile-menu-arrow right"></div>                
            </a>
            <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                <ul class="vertical">
                <div class="vertical__img">
                    <img src="<?php echo $category['thumb']; ?>">                    
                </div>
                <div class="vertical__name"><?php echo $category['name']; ?></div>
                <?php foreach ($children as $child) { ?>
                  <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>
                </ul>
            <?php } ?>
          </li>
        <?php } ?>
    <?php } ?>
    <li>
        <a href="#Item-1">
            Мир fidelitti <div class="mobile-menu-arrow right"></div> 
        </a>
        <ul class="vertical">
            <div class="vertical__img">
                <img src="/catalog/view/theme/fidelitti/image/img_3.jpg">                    
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
    <li>
        <a href="#Item-1">
            О компании <div class="mobile-menu-arrow right"></div> 
        </a>
        <ul class="vertical">
            <div class="vertical__img">
                <img src="/catalog/view/theme/fidelitti/image/img_3.jpg">                    
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
        <a href="#text-popup" class="popup-content">
        Обслуживание клиентов <img src="/catalog/view/theme/fidelitti/images/call-answer.png" alt="">
        </a>
    </li>
    <li>
        <a href="<?php echo $login; ?>" class="mobile_auth">
        Авторизация <img src="/catalog/view/theme/fidelitti/images/user.png" alt="">
        </a>
    </li>
    <div class="prmn-cmngr" data-confirm="true"></div>
    <div class="mobile_lang">
        <?php if ($actual_language == "ru-ru"){ ?>
        <a href="#text-popup_lang" class="white-popup_lang popup_lang_old">
            <div class="mobile_lang__icon"><div></div></div> Русский
        </a>
        <? } elseif ($actual_language == "en-gb"){ ?>
        <a href="#text-popup_lang" class="white-popup_lang popup_lang_old">
           <div class="mobile_lang__icon"><div></div></div>  Английский
        </a>
        <? }else{ ?>
        <a href="#text-popup_lang" class="white-popup_lang popup_lang_old">
            <div class="mobile_lang__icon"><div></div></div> Украинский
        </a>
        <? } ?>
    </div>
    </ul>
</div>

    




    <div class="row nav">
       <div class="menu default">
            <ul id="nav">
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['children']) { ?>
                    <li class="nav__child <?php echo ($category['category_id'] == $category_id) ? 'active' : ''; ?>">
                        <a href="" onclick="return false">
                            <?php echo $category['name']; ?>
                        </a>
                        
                        <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                        <div class="subs_block">
                        <ul class="subs">
                        <div class="subs_bg"></div>
                                            <?php foreach ($children as $child) { ?>
                <li class="menu__child nav__child <?php echo ($child['category_id'] == $child_id) ? 'active' : ''; ?>">
                    <div class="menu__childLevel--two">
                    <a href="<?php echo $child['href']; ?>">
                        <?php echo $child['name']; ?>
                    
                    </a>
                    </div>
                    <?php     if ($child['children']) {?>
                         <div class="child">
                             <ul class="list-unstyled">
                         <?php foreach ($child['children'] as $child) { ?>
                        <div class="items">
                            <div class="item">
                            <li>
                                <a href="<?php echo $child['href']; ?>">
                                    <?php echo $child['name']; ?>
                                </a>
                            </li>
                            </div>
                        </div>
                        <?php } ?>
                            </ul>
                    <?php } ?>
                </li>
                <?php } ?>
                

                        </ul>
                        <div class="menu-banner__one">
                <div>
                     <img src="<?php echo $category['thumb']; ?>">
                </div>
                </div>
                        </div>
                        <?php } ?>
                    </li>
                    
                <?php } ?>
                <?php } ?>
                <li class="menu-fidel nav__child"><a href="">Мир fidelitti</a>
                    <div class="subs_block">
                    <ul class="subs">
                    <div class="subs_bg"></div>
                 <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/all_news/">
                        Новости и мероприятия
                    </a>
                    </div>
                </li>
                 <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="<?php echo $child['href']; ?>">
                        #Fidelittigirls
                    </a>
                    </div>
                </li>
               
                        </ul>
                         <div class="menu-banner__one">
                <div>
                     <img src="/catalog/view/theme/fidelitti/image/img_3.jpg">                </div>
               
                </div>
                        </div>

                </li>
                    <li><a href="">О компании</a>
                    <div class="subs_block">
                        <ul class="subs">
                    <div class="subs_bg"></div>
                <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/my_company">
                        О компании
                    </a>
                    </div>
                </li>
                <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/contact-us/">
                        Сотрудничество
                    </a>
                    </div>
                </li>
                 <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/our_production">
                        Наше производство
                    </a>
                    </div>
                </li>
                <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/contact-us/">
                        Контакты
                    </a>
                    </div>
                </li>
                <li class="menu__child">
                    <div class="menu__childLevel--two">
                    <a href="/works">
                        Вакансии
                    </a>
                    </div>
                </li>
               
                        </ul>
                         <div class="menu-banner__one">
                <div>
                     <img src="/catalog/view/theme/fidelitti/image/img_3.jpg">                </div>
               
                </div>
                        </div>
                    </li>
            </ul>
             <div class="menu_bg"></div>
        </div>
        <div class="service-block default">
            <div>
            <a href="#text-popup" class="popup-content">
                <img src="/catalog/view/theme/fidelitti/images/call-answer.png" alt="">
            </a>
            </div>
            <div>
            <a href="<?php echo $login; ?>">
                <img src="/catalog/view/theme/fidelitti/images/user.png" alt="">
            </a>
            </div>
            <?php echo $cart; ?>
            
            <div class="parent_block">
              <div>
               <a class="search__link" href='#'>
                 <img src="/catalog/view/theme/fidelitti/images/search.png" alt="">
                </a>
              </div>              
            </div>
        </div>        
    </div>
    <div class="mobile_head_bg"></div>
    <!--BOF Product Series-->
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