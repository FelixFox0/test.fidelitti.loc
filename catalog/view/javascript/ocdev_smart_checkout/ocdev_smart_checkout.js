var $smch_modal              = $( '#smch_modal_body' ),
    $smch_close              = $( '#smch_modal_body > .top > .close_button' ),
    $smch_modal_background   = $( '#smch_modal_background' ),
    $smch_modal_payment_html = $( '#payment_html' ),
    $smch_modal_heading      = $( '#smch_modal_body > .top > .heading' ),
    smch_name_block_height   = $( "#check_data > .middle > .processing > .name" ).height(),
    smch_totals_block_height = $( "#check_data > .middle > .processing > .totals" ).height(),
    smch_middle_block_height = $( "#check_data > .middle" ).height(),
    smch_bottom_block_height = $( "#check_data > .bottom" ).height(),
    winH_for_smch            = $( window ).height(),
    winW_for_smch            = $( window ).width();

function getOCwizardModal_smch( product_id ) {  
  $( '<div/>' )
    .attr( 'id', 'smch_modal_body' )
    .load( 'index.php?route=extension/module/ocdev_smart_checkout&product_id=' + product_id )
    .prependTo( 'body' );
    hidePageScroll( true );
    $('html, body').animate({ scrollTop: 0 }, 'slow'); 
}

$(function() {
  $( window ).scroll(function() {
    if ( $smch_modal.height() < winH_for_smch && winW_for_smch > 800 ) {
      $("#smch_modal_body").stop().animate({ 'top': $(window).scrollTop() + 50 }, 'slow' );
    }
  });
});

function rePositionModal() {
    winH_for_smch = $( window ).height();
    winW_for_smch = $( window ).width();

  if ( $smch_modal.height() > winH_for_smch ) {
    $smch_modal.css( 'top', "10%" );
    $smch_modal.css( 'left', winW_for_smch / 2 - $smch_modal.width() / 2 ); 
  } else {
    $smch_modal.css( 'top',  winH_for_smch / 2 - $smch_modal.height() / 2 );
    $smch_modal.css( 'left', winW_for_smch / 2 - $smch_modal.width() / 2 ); 
  }
}

$( document ).on( 'click', '.smch_call_button', function () {
  $( ".smch_call_button" ).attr( 'disabled' );
});

$(function() {
  if ( $smch_modal_background.length == 0 ) {
    $smch_modal_background = $( '<div id="smch_modal_background" />' ).insertAfter( $smch_modal );
  } 

  $smch_close.click( function() {
    $smch_modal_background.remove();
    $smch_modal.remove();
    hidePageScroll( false );
    $( ".smch_call_button" ).removeAttr( 'disabled' );
  });

  $smch_modal_background.click( function( event ) {
    if ( $( event.target ).closest( $smch_modal ).length == 0 ) {
      $smch_modal_background.remove();
      $smch_modal.remove();
      hidePageScroll( false );
      $( ".smch_call_button" ).removeAttr( 'disabled' );
    };
  });

  $smch_modal.draggable( { 
    handle: $smch_modal_heading,
    cursor: "crosshair"
  });

  rePositionModal(); 
});

$( document ).on( 'keydown', function( event ) {
  if ( event.keyCode === 27 ) {
    closeModal();
  }
});

$( window ).resize( function() {
  rePositionModal(); 
});

function hidePageScroll( status ) {
  if ( status == true ) {
    $( 'html' ).css( 'overflow-x', 'hidden' );
  } else {
    $( 'html' ).css( 'overflow-x', 'auto' );
  }
}

function closeModal() {
  $smch_modal_background.remove();
  $smch_modal.remove();
  hidePageScroll( false );
  $( ".smch_call_button" ).removeAttr( 'disabled' );
}

if ( !jQuery().draggable ) {
  $.fn.draggable = function( draggable_options ) {
    draggable_options = $.extend( {
        handle: "",
        cursor: ""
    }, draggable_options );
    if( draggable_options.handle === "" ) {
        var $div = this;
    } else {
        var $div = this.find( draggable_options.handle );
    }
    return $div.on( "mousedown touchstart", function(e) {
        if( draggable_options.handle === "" ) {
            var $draggable = $( this ).addClass( 'draggable' );
        } else {
            var $draggable = $( this ).addClass( 'handle' ).parent().parent().addClass( 'draggable' );
        }
        var z_index     = $draggable.css( 'z-index' ),
            div_w       = $draggable.outerWidth(),
            div_h       = $draggable.outerHeight(),
            position_x  = $draggable.offset().left + div_w - e.pageX || $draggable.offset().left + div_w - e.originalEvent.pageX,
            position_y  = $draggable.offset().top + div_h - e.pageY || $draggable.offset().top + div_h - e.originalEvent.pageY;

        $draggable.css( 'z-index', z_index ).parents().on("mousemove touchmove", function(e) {
          $('.draggable').offset({
              top: e.pageY  + position_y - div_h || e.originalEvent.pageY + position_y - div_h,
              left: e.pageX + position_x - div_w || e.originalEvent.pageX + position_x - div_w
          }).on("mouseup touchend touchcancel", function() {
              $(this).removeClass('draggable');
          });
          draggable_options.handle.css( 'cursor', draggable_options.cursor );
        });
        e.preventDefault();

    } ).on( "mouseup touchend touchcancel", function() {

        if( draggable_options.handle === "" ) {
            $( this ).removeClass( 'draggable' );
        } else {
            $( this ).removeClass( 'handle' ).parent().parent().removeClass( 'draggable' );
        }
    });
  }
}

(function($) { 
  if ( smch_name_block_height > smch_totals_block_height ) {
    $( "#check_data > .middle > .processing > .quantity" ).height( $( "#check_data > .middle > .processing > .name" ).height() );
  } else {
    $( "#check_data > .middle > .processing > .quantity" ).height( $( "#check_data > .middle > .processing > .totals" ).height() );
  };

  // for "slide_description" block

  if ( smch_middle_block_height < $( '#smch_modal_body > .slide_description > .content' ).height() ) {
    $( '#smch_modal_body > .slide_description > .content' ).height( parseInt( smch_middle_block_height ) - parseInt( smch_bottom_block_height ) + "px" );
  }
  $( "#smch_modal_body > .slide_description > .open" ).toggle( function() {
    if ( winW_for_smch < 414 ) {
      $( "#smch_modal_body > .slide_description" ).animate( { left: '275px' }, 500 );
    } else {
      $( "#smch_modal_body > .slide_description" ).animate( { left: '380px' }, 500 );
    }
  }, function() {
    $( "#smch_modal_body > .slide_description" ).animate( { left: 0 }, 500 );
  } ); 

  // for "slide_informer" block

  if ( (smch_middle_block_height - 30 ) < $( '#smch_modal_body > .slide_informer > .content' ).height() ) {
    $( '#smch_modal_body > .slide_informer > .content' ).height( parseInt( smch_middle_block_height - 30 ) - parseInt( smch_bottom_block_height ) );
  }
  $( "#smch_modal_body > .slide_informer > .open" ).toggle( function() {
    if ( winW_for_smch < 414 ) {
    $( "#smch_modal_body > .slide_informer" ).animate( { left: '275px' }, 500 );
    } else {
      $( "#smch_modal_body > .slide_informer" ).animate( { left: '380px' }, 500 );
    }
  }, function() {
    $( "#smch_modal_body > .slide_informer" ).animate( { left: 0 }, 500 );
  } ); 

  // for "slide_attributes" block

  if ( (smch_middle_block_height - 60 ) < $( '#smch_modal_body > .slide_attributes > .content' ).height() ) {
    $( '#smch_modal_body > .slide_attributes > .content' ).height( parseInt( smch_middle_block_height - 60 ) - parseInt( smch_bottom_block_height ) );
  }
  $( "#smch_modal_body > .slide_attributes > .open" ).toggle( function() {
    if ( winW_for_smch < 414 ) {
    $( "#smch_modal_body > .slide_attributes" ).animate( { left: '275px' }, 500 );
    } else {
      $( "#smch_modal_body > .slide_attributes" ).animate( { left: '380px' }, 500 );
    }
  }, function() {
    $( "#smch_modal_body > .slide_attributes" ).animate( { left: 0 }, 500 );
  } ); 
})(smch_old_jqury)

// loadmask function

function maskElement( element, status ) {
  if ( status == true ) {
    $( '<div/>' )
    .attr( {'id':'smch_modal_loadmask', 'class':'smch_modal_loadmask'} )
    .prependTo( element );
    $( '<div class="smch_modal_loadmask_loading" />' ).insertAfter( $( '#smch_modal_loadmask' ) );

    var $loadmask_body = $( '.smch_modal_loadmask_loading' ),
      elementH  = $( element ).height(),
      elementW  = $( element ).width();

    $loadmask_body.css( 'top',  elementH / 2 - $loadmask_body.height() / 2 );
    $loadmask_body.css( 'left', elementW / 2 - $loadmask_body.width() / 2 ); 

  } else {
    $( '#smch_modal_loadmask' ).remove();
    $( '.smch_modal_loadmask_loading' ).remove();
  }
}

// send data to processing

function sendOrder() {
  var $button_send = $( '#smch_modal_body .bottom > input' );
  $button_send.attr( "disabled", true );
  maskElement( '#check_data', true );
  $.ajax({
      type: 'post',
      url: 'index.php?route=extension/module/ocdev_smart_checkout/sendOrder',
      dataType: 'json',
      data: $( '#smch_modal_data input[type=\'text\'], #smch_modal_data input[type=\'hidden\'], #smch_modal_data input[type=\'radio\']:checked, #smch_modal_data input[type=\'checkbox\']:checked, #smch_modal_data textarea, #smch_modal_data select' ),
      success: function( json ) {
        if ( json['error'] ) {
          $( '.field_error' ).remove();
          $( '.option_error' ).remove();
          $( '.ocdev_smart_checkout_fields input, .ocdev_smart_checkout_fields textarea, .ocdev_smart_checkout_fields select, .smch_methods_table' ).removeClass('error_style error_style_table');
          $( '.option' ).removeClass('error_style_table_option');
          if ( json['error']['field'] ) {
            maskElement( '#check_data', false );
            $.each( json['error']['field'], function( i, val ) {
                if ( i == 'shipping_method' ) {
                  $( '#smch_shipping_table' ).addClass( 'error_style_table' ).after( '<span class="error_text_table field_error">' + val + '</span>' );
                } else if ( i == 'payment_method' ) {
                  $( '#smch_payment_table' ).addClass( 'error_style_table' ).after( '<span class="error_text_table field_error">' + val + '</span>' );
                } else {
                  $( '[name="' + i + '"]' ).addClass( 'error_style' ).after( '<span class="error_text field_error">' + val + '</span>' );
                }
            });
          };
          if ( json['error']['option'] ) {
            maskElement( '#check_data', false );
            $.each( json['error']['option'], function( i, val ) {
                $( '#smch_option-' + i ).addClass( 'error_style_table_option' ).after( '<span class="error_text_table_option option_error">' + val + '</span>' );
            });
          };
          $button_send.attr( "disabled", false );
        } else {

          if ( json['transfer_payments_selector'] ) {
            $( '#payment_html' ).html( json['payment_html'] );
            $( '#payment_html' ).find( json['transfer_payments_selector'] ).click();
            json['output'] = false; 
          }

          if ( json['output'] ) {
            maskElement( '#check_data', false );
            $( '#smch_modal_body .slide_description, #smch_modal_body .slide_informer, #smch_modal_body .slide_attributes, #smch_modal_body .bottom > .totals' ).remove();
            $button_send.attr( {'value': json['button_close_text'], "disabled": false, 'class': 'close_button_bottom' } ).removeAttr('onclick').on( 'click', this, function() {
                closeModal();
            });
            $('.close_button_bottom').attr( 'title', $smch_close.attr('title') );
            $( '#smch_modal_data' ).html( json['output'] );
            rePositionModal();
          }

          if ( json['google_analytics'] ) {
            ga( 'require', 'ecommerce' );
            ga( 'ecommerce:addTransaction', {
              'id': json['google_analytics']['transaction_id'],
              'affiliation': json['google_analytics']['affiliation'],
              'revenue': json['google_analytics']['revenue'],
              'shipping': json['google_analytics']['shipping'],
              'tax': json['google_analytics']['tax'],
              'currency': json['google_analytics']['currency']
            });
            ga( 'ecommerce:addItem', {
              'id': json['google_analytics']['product_id'],
              'name': json['google_analytics']['name'],
              'sku': json['google_analytics']['sku'],
              'price': json['google_analytics']['price'],
              'quantity': json['google_analytics']['quantity']
            });
            ga( 'ecommerce:send' );
          }

          if ( json['google_event'] ) {
            ga( 'send', 'event', json['google_event']['сategory'], json['google_event']['action'], json['google_event']['name'], json['google_event']['product_id'] );
          }
        }
      }
  });
}

function validate_input( input ) {
    input.value = input.value.replace(/[^\d,]/g, '' );
}

function changeImage( image_id ) {
    $( "#smch_modal_image" ).attr( "src", $( image_id ).attr("rel") );
    return false;
}

function update_quantity( product_id ) {
  maskElement( '#check_data', true );
  var input_val = $( '#smch_quantity' ).find( 'input[name=quantity]' ).val(),
      quantity  = parseInt( input_val );

  if ( quantity == 0 ) {
    quantity = $( '#smch_quantity' ).find( 'input[name=quantity]' ).val( 1 );
    maskElement( '#check_data', false );
    return;
  }

  $.ajax({
    url: 'index.php?route=extension/module/ocdev_smart_checkout/processing&product_id=' + product_id + '&quantity=' + quantity,
    type: 'post',
    dataType: 'json',
    data: $( '#smch_modal_data input[type=\'text\'], #smch_modal_data input[type=\'hidden\'], #smch_modal_data input[type=\'radio\']:checked, #smch_modal_data input[type=\'checkbox\']:checked, #smch_modal_data select, #smch_modal_data textarea' ),
    success: function( json ) {
      $( "#ocdev_price" ).html( json['price'] );
      $( "#ocdev_special" ).html( json['special'] );
      $( "#ocdev_tax" ).html( json['tax'] );
      $( "#total_order" ).html( json['total'] );
      maskElement( '#check_data', false );
      reMethods(); 
    } 
  });
}

function reCalculate() { 
  maskElement( '#check_data', true );
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/module/ocdev_smart_checkout/processing',
    data: $( '#smch_modal_data input[type=\'text\'], #smch_modal_data input[type=\'hidden\'], #smch_modal_data input[type=\'radio\']:checked, #smch_modal_data input[type=\'checkbox\']:checked, #smch_modal_data select, #smch_modal_data textarea' ),
    dataType: 'json',
    success: function( json ) {
      $( "#ocdev_price" ).html( json['price'] );
      $( "#ocdev_special" ).html( json['special'] );
      $( "#ocdev_tax" ).html( json['tax'] );
      $( "#total_order" ).html( json['total'] );
      if ( $smch_modal_payment_html.length == 0 ) {
        $smch_modal_payment_html = $( '<div id="payment_html" />' ).insertAfter( $smch_modal );
      } 
      maskElement( '#check_data', false );
    } 
  });
}

function reMethods() { 
  maskElement( '#check_data', true );
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/module/ocdev_smart_checkout',
    dataType: 'html',
    data: $( '#smch_modal_data input[type=\'text\'], #smch_modal_data input[type=\'hidden\'], #smch_modal_data input[type=\'radio\']:checked, #smch_modal_data input[type=\'checkbox\']:checked, #smch_modal_data select, #smch_modal_data textarea' ),
    success: function( data ) {
      $( "#smch_shipping_table" ).html( $( data ).find( '#smch_shipping_table > *' ) );
      $( "#smch_payment_table" ).html( $( data ).find( '#smch_payment_table > *' ) );
      maskElement( '#check_data', false );
    } 
  });
}