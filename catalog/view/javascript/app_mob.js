//ini foundation
 $(document).ready(function() {
            $(document).foundation();
         })
//menu phone modal
jQuery(document).ready(function($) {
    $('.popup-content').magnificPopup({
        type: 'inline',
        mainClass: 'mfp-with-zoom'
    });
});

$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

jQuery(document).ready(function($) {
    $('.popup-country').magnificPopup({
        type: 'inline',
        mainClass: 'mfp-with-zoom'
    });
});

jQuery(document).ready(function($) {
    $('.popup-product-color').magnificPopup({
        type: 'inline',
        mainClass: 'mfp-with-zoom',
    });
});

$('div.aaaa').magnificPopup({ 
  type: 'image',
  delegate: 'a',
  alignTop: true,
  mainClass: 'mfp-with-zoom',
  
  gallery:{enabled:true},
  callbacks: {
    
    disableOn: function() {
  if( $(window).width() < 3000 ) {
    return false;
  }
  return true;
}
    
  }
});


// Hover search
var linc2 = $('.search__block'),
    timeoutId;
$('.parent_block').hover(function(){
    clearTimeout(timeoutId);
    linc2.show();
}, function(){
    timeoutId = setTimeout($.proxy(linc2,'hide'), 1000)
});
linc2.mouseenter(function(){
    clearTimeout(timeoutId); 
}).mouseleave(function(){
    linc2.hide();
}); 




// DropDown filter subcategory
function DropDown(el) {
                this.f_cat = el;
                this.f_mat = el;
                this.f_line = el;
                this.f_color = el;
                this.f_sort = el;
                this.initEvents();
            }
            DropDown.prototype = {
                initEvents : function() {
                    var obj = this;

                    obj.f_cat.on('click', function(event){
                        $(this).toggleClass('active');
                        event.stopPropagation();
                    }); 
                }
            }

            $(function() {

                var f_cat = new DropDown( $('#f_cat') );
                var f_mat = new DropDown( $('#f_mat') );
                var f_line = new DropDown( $('#f_line') );
                var f_color = new DropDown( $('#f_color') );
                var f_sort = new DropDown( $('#f_sort') );
                $(document).click(function() {
                    // all dropdowns
                    $('.wrapper-dropdown-5').removeClass('active');
                });

            });
// Slider photo product
/*$(document).ready(function(){
  $('.slider5').bxSlider({
    mode: 'vertical',
    slideWidth: 300,
    minSlides: 3,
    maxSlides: 3,
    moveSlides: 1,
    slideMargin: 10,
    pagerCustom: '#bx-pager'
  });
});
*/




$(document).ready(function(){

    // SLIDER : begin
    var $slider = $(".slider5");

    var slider = $slider.bxSlider({
        mode: 'horizontal',
        speed: 500,
        adaptiveHeight: false,
        hideControlOnEnd: true,
        infiniteLoop: false,
        slideWidth: 417,
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 1,
        slideMargin: 10,
        preloadImages: 'visible',
        responsive: true,
  		captions: true
    });        
});

//Recommener product carousel
$(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 303,
    minSlides: 2,
    maxSlides: 4,
    slideMargin: 0,
    hideControlOnEnd: false,
    infiniteLoop: false,
    easing: 'ease-in-out',
    pager: false,
    adaptiveHeight: true,
    nextSelector: '#slider-next',
    prevSelector: '#slider-prev',
    nextText: '<img src="/catalog/view/theme/fidelitti/images/carousel-right-arrow.png">',
    prevText: '<img src="/catalog/view/theme/fidelitti/images/carousel-left-arrow.png">'
  });
});
/*
 $(function() {
        var insert = $('#insert');
        $('a[rel="insert"]').click(function() {
          insert.find('div.clientService__right--click').css('display', 'none');
          insert.find('#'+$(this).attr('href')).fadeIn(300);
          return false;
        });
      });

*/
/*
$(function(){
    $('#new-ref').mouseenter(function(){
      $( "#cart__none" ).show(); // Показываем блок
    });

   $('#new-ref,#cart__none').mouseleave(function(e){
    if (e.relatedTarget.id == 'new-ref' || e.relatedTarget.id == 'cart__none') return;
    //if ($('#login').val() || $('#password').val()) return;
    //$('#cart__none').hide();
});

   
    $(document).click(function(e){ // Функция скрывает элемент если произошёл клик в не поля #cart__none
            if ($(e.target).closest('#cart__none').length) return; 
            $('#cart__none').hide(); // Скрываем блок
            e.stopPropagation();
        });
    
});
*/


//Product radio class
 $(function(){
       $('input.shipping_method').click(function() {
    $('li.shipping_method').each(function(indx, element){
         if ($('input',this)[0].checked) {
        $(this).addClass('selected');
    } else {
        $(this).removeClass('selected');
    }  });


}).filter(":checked").click();

   })
//category filter

//end category filter



  function collapsElementsort(id) {
 if ( document.getElementById(id).style.display != "block" ) {
    $( "#sub_sort_hover" ).fadeIn( "slow", function() {
 document.getElementById(id).style.display = 'block';
 document.getElementById(id).style.position = 'absolute';
  document.getElementById(id).style.top = '42px';
   });}

 else {
    $( "#sub_sort_hover" ).fadeOut( "slow", function() {
document.getElementById(id).style.position = 'absolute';
  document.getElementById(id).style.top = '42px';
    
});
 }
 }

// Remove classes for a filter in the category

 function toggleClass(el, class1, class2) {
    el.className = (el.className == class1) ? class2 : class1;
}

//Product color modal
$('.bxslider').bxSlider({
  speed: 300,
  minSlides: 1,
  maxSlides: 3,
  moveSlides: 1,
  slideWidth: 230,
  slideMargin: 10,
  infiniteLoop: true,
  pager: false,
  preloadImages: 'all',
  adaptiveHeight: true,
  hideControlOnEnd: true,
});
//End product color modal

function openbox(id, toggler) {
  var div = document.getElementById(id);
  if(div.style.display == 'block') {
    div.style.display = 'none';
    toggler.innerHTML = 'Нужна помощь? +';
  }
  else {
    div.style.display = 'block';
    toggler.innerHTML = 'Нужна помощь? -';
  }
}

//scroll menu



var h_hght = 138; // высота шапки
var h_mrg = 40;    // отступ когда шапка уже не видна
                 
$(function(){
 
    var elem = $('.search__block__pol');
    var top = $(this).scrollTop();
     
    if(top > h_hght){
        elem.css('top', h_mrg);
    }           
     
    $(window).scroll(function(){
        top = $(this).scrollTop();
         
        if (top+h_mrg < h_hght) {
            elem.css('top', (h_hght-top));
        } else {
            elem.css('top', h_mrg);
        }
    });
 
});
/*
$(function(){
 $(window).scroll(function() { 
  var top = $(document).scrollTop();
  if (top > 150) $('.service-block').addClass('service-block-fixed'); //200 - это значение высоты прокрутки страницы для добавления класс
  else $('.service-block').removeClass('service-block-fixed');
 });
});

$(function(){
 $(window).scroll(function() { 
  var top = $(document).scrollTop();
  if (top > 150) $('.header__logo').addClass('header__logo-fixed'); //200 - это значение высоты прокрутки страницы для добавления класс
  else $('.header__logo').removeClass('header__logo-fixed');
 });
});
*/
//scroll service block menu

$(window).scroll(function() { 
  var top = $(document).scrollTop();
  var width = $( window ).width();
   if (top < 150 || width < 1000) $(".menu").css({left: '0', top: '0', position: 'relative', borderBottom: '0'}).stop();
   else $(".menu").css({left: '0', top: '0', position: 'fixed', borderBottom: '2px solid #ededed'}).fadeIn(1000);
 });

 $(window).scroll(function() { 
  var top = $(document).scrollTop();
  var width = $( window ).width();
   if (top < 150 || width < 1000) $(".service-block").css({top: '-48px', position: 'absolute'}).stop();
   else $(".service-block").css({top: '7px', position: 'fixed'}).fadeIn(1000);
 });

  $(window).scroll(function() { 
  var top = $(document).scrollTop();
  var width = $( window ).width();
   if (top < 150 || width < 1000) $(".header__logo__img").css({padding: '0', left: '0', width: '140px', position: 'relative'}).stop();
   else $(".header__logo__img").css({padding: '7px 0 0 10px', left: '0', width: '165px', top: '18px', position: 'fixed'}).fadeIn(1000);
 });



$(function(){
  $('.panel').tabSlideOut({             //Класс панели
    tabHandle: '.handle',           //Класс кнопки
    pathToTabImage: '/catalog/view/theme/fidelitti/images/icon_menu_but.png',       //Путь к изображению кнопки
    imageHeight: '40px',           //Высота кнопки
    imageWidth: '40px',           //Ширина кнопки
    tabLocation: 'left',           //Расположение панели top - выдвигается сверху, right - выдвигается справа, bottom - выдвигается снизу, left - выдвигается слева
    speed: 300,               //Скорость анимации
    action: 'click',                //Метод показа click - выдвигается по клику на кнопку, hover - выдвигается при наведении курсора
    topPos: '0',              //Отступ сверху
    fixedPosition: true            //Позиционирование блока false - position: absolute, true - position: fixed
  });
});


//mobile
$('input').focus(function(){$('#subsc__desc').show();});


$(document).ready(function(){ // функция будет выполнена при полной загрузке страницы
  setTimeout(function(){ // если нужно устанавливаем задержку выполнения действия
      $('#cmngr__click').click(); // имитируем нажатие кнопкой мишы на блок
  },1000); // время задержки в милисикундах
});

function f(){
  var ob=document.getElementById('orderbox');
    if( ob.style.display=='block') { ob.style.display='block'; }
    else  { ob.style.display='block'; }
  } 
function fs(){
  var ob=document.getElementById('orderbox');
    if( ob.style.display=='block') { ob.style.display='none'; }
    else  { ob.style.display='none'; }
  } 





  // go top
  var top_show = 200; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
  var delay = 1000; // Задержка прокрутки
  $(document).ready(function() {
    $(window).scroll(function () { // При прокрутке попадаем в эту функцию
      /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
      if ($(this).scrollTop() > top_show) $('#up_top').fadeIn();
      else $('#up_top').fadeOut();
    });
    $('#up_top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
      /* Плавная прокрутка наверх */
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    });
  });

    // go top
  var top_show = 200; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
  var delay = 1000; // Задержка прокрутки
  $(document).ready(function() {
    $(window).scroll(function () { // При прокрутке попадаем в эту функцию
      /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
      if ($(this).scrollTop() > top_show) $('#up_top_two').fadeIn();
      else $('#up_top_two').fadeOut();
    });
    $('#up_top_two').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
      /* Плавная прокрутка наверх */
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    });
  });