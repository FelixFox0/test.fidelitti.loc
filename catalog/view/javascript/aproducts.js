var page=1;
var page_plus=0;

//var limit=parseInt(document.getElementById('default_limit').innerText);
//console.log(limit);
//var totalproducts=parseInt(document.getElementById('totalproducts').innerText);
function aj() {
	if(document.getElementById('apage')) {
		page_plus=1;
		document.getElementById('apage').parentElement.removeChild(document.getElementById('apage'));
	} else {
		page_plus++;
	}
	//разбераем get-запрос
	var get_params = window.location.search.replace('?','').split('&').reduce(
        function(p,e){
            var a = e.split('=');
            p[decodeURIComponent(a[0])]=decodeURIComponent(a[1]);
            return p;
        },{}
    );
	if(get_params.route) {
		delete get_params.route;
	}
	//Проверяем текущую страницу из get-запроса. Если нет, то 1
	if(!get_params.page) {
		get_params.page=page;
	}
	//Проверяем количество товаров на страницу. Если нет, то по-умолчанию
	if(!get_params.limit) {
		get_params.limit=parseInt(document.getElementById('default_limit').innerText);
	} else {
		get_params.limit=parseInt(get_params.limit);
	}
	if(!get_params.path) {
		get_params.path=document.getElementById('category_id').innerHTML;
	}
	//готовим запрос
	get_params.page=parseInt(get_params.page)+page_plus;
	console.log(get_params);
	//собираем параметры обратно в строку
	var str_params='';
	for(var key in get_params) {
		str_params+=('&'+key+'='+get_params[key]);
	}
	console.log(str_params);
	var href='index.php?route=product/aproducts'+str_params;
	$.ajax({url: href, success: function(result){
		$("img.lazy-load").removeClass('lazy-load');
		if(result.trim()!='' && result!=null && result!=undefined && result!=NaN) {
			//limit=parseInt(document.getElementById('default_limit').innerText);
			totalproducts=parseInt(document.getElementById('totalproducts').innerText);
			var show=((totalproducts-(get_params.limit*get_params.page))>get_params.limit)?get_params.limit:(totalproducts-(get_params.limit*get_params.page));
			document.querySelector('#ajax-button a p').innerHTML='Показать еще '+show;
			var productsClass=document.querySelector('.aproduct').parentElement.className;
			//console.log(productsClass);
			document.querySelector('.abjmax').parentElement.insertAdjacentHTML('beforeBegin', result);
			var products=document.querySelectorAll('.aproduct');
			for(var i=0; i<products.length; i++) {
				products[i].parentElement.className=productsClass;
			}
			var cur_page=document.querySelector('ul.pagination li.active+li:not(.active)');
			if(parseInt(cur_page.innerText)) {
				cur_page.className='active';
			}
			if(totalproducts<=(get_params.page*get_params.limit)) {
				document.getElementById('ajax-button').style.display='none';
			} else {
				$(window).scroll(src);
			}
  $('.ajax-popup-link').magnificPopup({
  type: 'ajax',
  mainClass: 'ajax_quickview'
});
$("img.lazy-load").lazyload({
	event : "scroll",
	effect : "fadeIn",
	threshold : 200,
	placeholder : "catalog/view/javascript/lazyload/loading.gif"
});
var timeout = setTimeout(function() { $("img.lazy-load").trigger("scroll") }, 1000);
		} else {
			document.getElementById('ajax-button').style.display='none';
		}
	}});
}
$(window).scroll(src);
function src() {
	if($('#ajax-button').offset()) {
		if($('#ajax-button').offset().top<=$(window).scrollTop()+$(window).height()) {
			$(window).unbind('scroll',src);
			aj();
		}
	} else {
		$(window).unbind('scroll',src);
	}
}
