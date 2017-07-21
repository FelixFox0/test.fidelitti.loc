     $(function(){
 var topPos = $('.floating').offset().top;
  $(window).scroll(function() { 
  var top = $(document).scrollTop(),
      pip = $('.simplecheckout-cart-buttons').offset().top, //расстояние до подвала от верха окна браузера
      height = $('.floating').outerHeight(); //получаем значение высоты пл.блока
  if (top > topPos && top < pip - 100) {$('.floating').addClass('simplecheckout-cart-fixed').fadeIn();} //блок будет виден, если значения соответствуют указанным
  else if (top > pip - 100) {$('.floating').fadeOut(100);} //блок скроется когда достигнет заданного расстояния
  else {$('.floating').removeClass('simplecheckout-cart-fixed');}
  });
});

  window.onload= function() {
  document.getElementById('toggler').onclick = function() {
    openbox('box', this);
    return false;
  };
};