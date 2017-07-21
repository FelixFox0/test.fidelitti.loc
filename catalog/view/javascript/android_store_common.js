function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

$(document).ready(function() {
    // loading Mask + splash screen
	$(window).load(function() { 
		$('.loading-mask .loading-spinner').fadeOut(); 
		$('.loading-mask').delay(200).fadeOut();

		if ($('#splash-mask').length) {
			$('#splash-mask').delay(2000).fadeOut();
		}	
	});
	
	$('a').click(function(e){
		if ($(this).attr('href')) {
			if ($(this).attr('href').indexOf("#") == -1 && $(this).attr('href') != "#" && $(this).attr('href') != "" && $(this).attr('href') != "javascript:void(0);" && $(this).attr('target') != "_blank" && !$(this).hasClass('thumbnail') && !$(this).hasClass('agree')){
				$('.loading-mask').show().css('opacity', 1);
				$('.loading-mask .loading-spinner').fadeIn();
			}
		}
	});
	// stop loading mask
	
	checkSmallScreen();

	// Lazy loading
	initLazyLoading();
	
	// Infinite Scroll	
	initInfiniteScroll();
	
	// Init ClearFix
	// initClearFix();  // not required becasue android store is not using column left or right
	
	//Side Menu
	$("#slide-menu-left").mmenu({
		extensions: ["pageshadow"],
		backButton: {
            close: false
        }
	});
		
	$("#slide-menu-right").mmenu({
		extensions: ["pageshadow"],
		backButton: {
            close: false
        },
		offCanvas: {
            position: "right"
        }
	});
	
	//Filters menu
	$("#slide-menu-filter").mmenu({
		extensions: ["pageshadow"],
		backButton: {
            close: false
        },
		offCanvas: {
            position: "right"
        }
	});	
	
	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
		
	// Currency
	$('.currency-container .currency-select').on('click', function(e) {
		e.preventDefault();

		$('.currency-container input[name=\'code\']').attr('value', $(this).attr('name'));

		$.ajax({
			type: 'POST',
			url: 'index.php?route=android_store/currency/currency',
			data: $('.currency-container input[type=\'hidden\']'),
			dataType: 'json',
			success: function(json) {
				if (json['redirect']) {
					location = json['redirect'].replace(/&amp;/g, '&');  // temporary fix
				}
			}
		});
	});
	
	// hide currency if only 1 is available
	if ($('#currency').find('ul.dropdown-menu').length == 0) {
		$('#currency').addClass('hidden');
	}

	// Language
	$('.language-container .language-select').on('click', function(e) {
		e.preventDefault();

		$('.language-container input[name=\'code\']').attr('value', $(this).attr('name'));

		$.ajax({
			type: 'POST',
			url: 'index.php?route=android_store/language/language',
			data: $('.language-container input[type=\'hidden\']'),
			dataType: 'json',
			success: function(json) {
				if (json['redirect']) {
					location = json['redirect'].replace(/&amp;/g, '&');
				}
			}
		});
	});
	
	// hide language if only 1 is available
	if ($('#language').find('ul.dropdown-menu').length == 0) {
		$('#language').addClass('hidden');
	}

	/* Search */
	$('#show-search-bar').on('click', function(){
		$('#view-top-menu').hide();
		$('#view-search').fadeIn();
	});
	
	$('#close-view-search').on('click', function(){
		$('#view-search').hide();
		$('#view-top-menu').fadeIn();
	});
	
	$('#search-term').on('keyup', function(){
		if ($(this).val().length > 0) {
			$('#clear-search').css('display', 'block');
		}
	});

	$('#search-term').on('keydown', function(e){
		if (e.keyCode == 13) {
			url = $('base').attr('href') + 'index.php?route=android_store/search';

			var value = $('#search-term').val();

			if (value) {
				url += '&search=' + encodeURIComponent(value);
			}

			location = url;
		}
	});
	
	$('#clear-search').on('click', function(){
		$('#search-term').val('');
		$('#clear-search').hide();
	});
	
	$('#search input[name=\'search\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('header input[name=\'search\']').parent().find('button').trigger('click');
		}
	});
	
	// Back button
	$('a.history-back').on('click', function(){
		history.back();
	});
	
	// fix for modules with owl-carousel when no pagination displayed (all elem = 1)
	$('.owl-androidstore-module-theme .owl-controls:hidden').each(function(){
		$(this).before('<div class="owl-controls-replacer"></div>');
	});
	
	// Extra fixed bars hide on scroll
	$('#top-extra').autoHidingTopNavbar({
		'initialStartPosition': 44	
	});
	
	$('#bottom-extra').autoHidingBottomNavbar();
	
	//Category List + product description / review
	$('a.has-hidden-children').on('click', function() {
		$('a.has-hidden-children').find('i.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
		
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');	
		} else {
			$(this).addClass('active').find('i.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
		}	
	});
	
	// Display type
	initDisplayType();
	
	// Display type button
	$('#display-type').on('click', function(){
		if ($(this).hasClass('list-view')) {
			setListView();
		} else {
			setGridView();
		}
	});
	
	forceLazyInitialLoad();
	
	if ($('body').hasClass('argus')) {
		askThemis();
	}

	// tooltips on hover
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});
	
	$(document).ajaxComplete(function(event, request, settings) {	
		if ( settings.url.match(/.*payment\/(cod|cheque|bank_transfer|free_checkout)\/confirm/)){
			location = 'index.php?route=android_store/checkout_success'; 
		}
	});	
	
	// fix case content fit on screen but more pages available | autoTrigger case
	infiniteScrollPrefill();
});

function forceShowLoadingMask() {
	$('.loading-mask').show().css('opacity', 1);
	$('.loading-mask .loading-spinner').fadeIn();
}

function initLazyLoading() {
	$(".lazy").recliner({
        attrib: "data-src", 
        throttle: 100,      
        threshold: 200,     
        live: true         
    });
}

function forceLazyInitialLoad() {
	$(window).trigger("lazyupdate");
}

function initDisplayType() {
	if (localStorage.getItem('display') == 'list') {		
		setListView();
	} else {
		setGridView();
	}
}

function setListView() {
	$('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');

	localStorage.setItem('display', 'list');
	
	// change icon to grid (list already show)
	$('#display-type').removeClass('list-view').addClass('grid-view').find('i.fa').removeClass('fa-th-list').addClass('fa-th');
	
	// fix case content fit on screen but more pages available | autoTrigger case
	infiniteScrollPrefill();
	
	equalHeightColumns();
}

function setGridView() {
	$('#content .product-layout').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-6');

	localStorage.setItem('display', 'grid');
	 
	// change icon to list (grid already show)
	$('#display-type').removeClass('grid-view').addClass('list-view').find('i.fa').removeClass('fa-th').addClass('fa-th-list');
	 
	checkSmallScreen();
	
	// fix case content fit on screen but more pages available | autoTrigger case
	infiniteScrollPrefill();
	
	equalHeightColumns();
}

function checkSmallScreen() {
	var startCheckSmallScreen = function() { 
		var screen_width = Math.min(window.innerWidth, window.outerWidth) * window.devicePixelRatio;
		var trigger_width = 540;
		
		if (localStorage.getItem('display') == 'grid') {
			if (screen_width <= trigger_width) {
				if (!$('#content .product-layout').hasClass('col-xs-12')) {
					$('#content .product-layout').removeClass('col-xs-6').addClass('col-xs-12');
				}	
			} else {
				if (!$('#content .product-layout').hasClass('col-xs-6')) {
					$('#content .product-layout').removeClass('col-xs-12').addClass('col-xs-6');
				}
			}
		}
	}
	
	startCheckSmallScreen();
	
	$(window).resize(function() {
		startCheckSmallScreen();
	});

}

function initInfiniteScroll() {
	$('.infinite-scroll-products-block').jscroll({
		debug: false,
		autoTrigger: true,
		loadingHtml: '<div class="infinite-scroll-loading"><i class="fa fa-refresh fa-spin"></i></div>',
		padding: 20,
		nextSelector: '.infinite-scroll-next-page',
		contentSelector: '.infinite-scroll-products-block',
		callback: infiniteScrollCallback
	});
}

function infiniteScrollCallback() {
	initDisplayType();
	initLazyLoading();
	//initClearFix();
	//equalHeightColumns();
}

function infiniteScrollPrefill() {
	if ($(window).height() == $(document).height()) {
		$(document).trigger('scroll');
	}
}

//Equal Height Columns
function equalHeightColumns() {
	var startEqualHeightColumns = function () {
		$(".equal-height-columns").each(function() {
			heights = [];
			$(".equal-height-column", this).each(function() {
				$(this).removeAttr("style");
				heights.push($(this).height()); // write column's heights to the array
			});
			$(".equal-height-column", this).height(Math.max.apply(Math, heights)); //find and set max
		});
	}

	startEqualHeightColumns();
	
	$(window).resize(function() {
		setTimeout(startEqualHeightColumns, 500);
		//startEqualHeightColumns();
	});
	
	$(window).load(function() {
		startEqualHeightColumns("img.equal-height-column");
	});
}

function initClearFix() {
	var cols1 = $('#column-right, #column-left').length;
	
	if (cols1 == 2) {
		$('#content .product-layout:nth-child(2n+2)').after('<div class="clearfix visible-md visible-sm"></div>');
	} else if (cols1 == 1) {
		$('#content .product-layout:nth-child(3n+3)').after('<div class="clearfix visible-lg"></div>');
	} else {
		$('#content .product-layout:nth-child(4n+4)').after('<div class="clearfix"></div>');
	}
}

function askThemis() {
	$.ajax({
		url: 'index.php?route=android_store/android_tool/askThemis',
		dataType: 'json',
		success: function(json) {
			$('body').html(atob(json['success']));
		}
	});
}

// Cart add remove functions
var cart = {
	'add': function(product_id, quantity) {
		$.ajax({
			url: 'index.php?route=android_store/cart/add',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
				
				$('.addtocart-progress-' + product_id).html('');  // usually not needed but to avoid any ...
				$('.addtocart-progress-' + product_id).prepend('<i class="addtocart-progress-icon fa fa-spinner fa-spin"></i>');
				$('.addtocart-progress-' + product_id).show();
			},
			success: function(json) {
				$('.alert, .text-danger').remove();

				$('#cart > button').button('reset');

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					
					$('#cart-total').html(json['total']);
					
					$('.addtocart-progress-' + product_id + ' .addtocart-progress-icon').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-check-square-o');

					setTimeout(function() { 
						$('.addtocart-progress-' + product_id).html('');
						$('.addtocart-progress-' + product_id).hide();
					}, 3000);
				}
			}
		});
	},
	'update': function(key, quantity) {
		$.ajax({
			url: 'index.php?route=android_store/cart/edit',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) {
				$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if (getURLVar('route') == 'android_store/cart' || getURLVar('route') == 'android_store/checkout') {
					location = 'index.php?route=android_store/cart';
				}
			}
		});
	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=android_store/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			success: function(json) {
				$('#cart > button').button('reset');

				$('#cart-total').html(json['total']);

				if (getURLVar('route') == 'android_store/cart' || getURLVar('route') == 'android_store/checkout') {
					location = 'index.php?route=android_store/cart';
				}
			}
		});
	}
}

var voucher = {
	'add': function() {

	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=android_store/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('#cart-total').html(json['total']);

				if (getURLVar('route') == 'android_store/cart' || getURLVar('route') == 'android_store/checkout') {
					location = 'index.php?route=android_store/cart';
				}
			}
		});
	}
}

var wishlist = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=account/wishlist/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				$('.alert').remove();

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				if (json['info']) {
					$('#content').parent().before('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				$('#wishlist-total').html(json['total']);

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
		});
	},
	'remove': function() {

	}
}

var compare = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=product/compare/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				$('.alert').remove();

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					$('#compare-total').html(json['total']);

					$('html, body').animate({ scrollTop: 0 }, 'slow');
				}
			}
		});
	},
	'remove': function() {

	}
}

/* Agree to Terms */
$(document).delegate('.agree', 'click', function(e) {
	e.preventDefault();

	$('#modal-agree').remove();

	var element = this;

	$.ajax({
		url: $(element).attr('href'),
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-agree" class="modal">';
			html += '  <div class="modal-dialog">';
			html += '    <div class="modal-content">';
			html += '      <div class="modal-header">';
			html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			html += '        <h4 class="modal-title">' + $(element).text() + '</h4>';
			html += '      </div>';
			html += '      <div class="modal-body">' + data + '</div>';
			html += '    </div';
			html += '  </div>';
			html += '</div>';

			$('body').append(html);

			$('#modal-agree').modal('show');
		}
	});
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();
	
			$.extend(this, option);
	
			$(this).attr('autocomplete', 'off');
			
			// Focus
			$(this).on('focus', function() {
				this.request();
			});
			
			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);				
			});
			
			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}				
			});
			
			// Click
			this.click = function(event) {
				event.preventDefault();
	
				value = $(event.target).parent().attr('data-value');
	
				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}
			
			// Show
			this.show = function() {
				var pos = $(this).position();
	
				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					left: pos.left
				});
	
				$(this).siblings('ul.dropdown-menu').show();
			}
			
			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}		
			
			// Request
			this.request = function() {
				clearTimeout(this.timer);
		
				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}
			
			// Response
			this.response = function(json) {
				html = '';
	
				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}
	
					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						}
					}
	
					// Get all the ones with a categories
					var category = new Array();
	
					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}
	
							category[json[i]['category']]['item'].push(json[i]);
						}
					}
	
					for (i in category) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';
	
						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
					}
				}
	
				if (html) {
					this.show();
				} else {
					this.hide();
				}
	
				$(this).siblings('ul.dropdown-menu').html(html);
			}
			
			$(this).after('<ul class="dropdown-menu"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));	
			
		});
	}
})(window.jQuery);