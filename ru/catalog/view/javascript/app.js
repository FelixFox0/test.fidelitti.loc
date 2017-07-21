//ini foundation
$(document).foundation();
//menu phone modal
jQuery(document).ready(function($) {
    $('.popup-content').magnificPopup({
        type: 'inline',
        mainClass: 'mfp-with-zoom'
    });
});


jQuery(document).ready(function($) {
    $('.popup-country').magnificPopup({
        type: 'inline',
        mainClass: 'mfp-with-zoom'
    });
});
/*
$('div.aaaa').magnificPopup({ 
  type: 'image',
  delegate: 'a',
  
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
*/
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
        speed: 1500,
        hideControlOnEnd: true,
        infiniteLoop: false,
        slideWidth: 417,
        adaptiveHeight: true,
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 1,
        slideMargin: 10,
        pagerCustom: '#bx-pager',
    });

    // scroll : begin
    var isMac = navigator.platform.toUpperCase().indexOf('MAC')>=0;
    
    // if OS === Mac OS X
    if(isMac){

        isMoving = false;
        $slider.on('mousewheel', function(e) {

            if (e.deltaY > 1) {
                if (!isMoving) {
                    isMoving = true; 
                    slider.goToPrevSlide();
                }

            }

            else if (e.deltaY < -1) {
                if (!isMoving) {
                    isMoving = true;
                    slider.goToNextSlide();
                }
            }

            else { isMoving = false; }

            event.stopPropagation();
            event.preventDefault();

        });
    }

    // other OS
    else{
        $slider.on("mousewheel", function(event, delta, deltaX, deltaY) {

            //console.log(event, delta, deltaX, deltaY);

            if (delta > 0) {
                slider.goToPrevSlide();
            }
            if (deltaY < 0){
                slider.goToNextSlide();
            }
            event.stopPropagation();
            event.preventDefault();

        });
    }
    // scroll : end
    // SLIDER : end
        
});

//Recommener product carousel
$(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 303,
    minSlides: 1,
    maxSlides: 4,
    slideMargin: 0,
    hideControlOnEnd: true,
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

 $(function() {
        var insert = $('#insert');
        $('a[rel="insert"]').click(function() {
          insert.find('div.clientService__right--click').css('display', 'none');
          insert.find('#'+$(this).attr('href')).fadeIn(300);
          return false;
        });
      });



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




// Search header hover
$(".button").click(function() {
  $('.toggled_block').toggle();
});
$(document).on('click', function(e) {
  if (!$(e.target).closest(".parent_block").length) {
    $('.toggled_block').hide();
  }
  e.stopPropagation();
});


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
 
  function collapsElement(id) {
 if ( document.getElementById(id).style.top != "32px" ) {
 document.getElementById(id).style.top = '32px';
 document.getElementById(id).style.position = 'relative';
 }
 else {
 document.getElementById(id).style.top = '-99999px';
 document.getElementById(id).style.position = 'absolute';
 }
 }
 