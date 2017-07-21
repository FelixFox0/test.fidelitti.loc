<script type="text/javascript" src="catalog/view/javascript/ocdev_smart_checkout/ocdev_smart_checkout.js"></script>
<?php if ( $product_description && isset( $hide_product_description ) ) { ?>
<div class="slide_description">
  <div class="open">i</div>
  <div class="content">
  <?php echo $product_description; ?>
  </div>
</div>  
<?php } ?>
<?php if ( $text_ocdev_smart_checkout_informer ) { ?>
<div class="slide_informer">
  <div class="open">?</div>
  <div class="content">
  <?php echo $text_ocdev_smart_checkout_informer; ?>
  </div>
</div>  
<?php } ?>
<?php if ( $attribute_groups && isset( $hide_product_attributes ) ) { ?>
<div class="slide_attributes">
  <div class="open">&equiv;</div>
  <div class="content">
    <?php if ( $attribute_groups ) { ?>
        <table class="attributes_table">
          <?php foreach ( $attribute_groups as $attribute_group ) { ?>
          <thead>
            <tr>
              <td colspan="2"><?php echo $attribute_group['name']; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $attribute_group['attribute'] as $attribute ) { ?>
            <tr>
              <td><?php echo $attribute['name']; ?></td>
              <td><?php echo $attribute['text']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <?php } ?>
        </table>
    <?php } ?>
  </div>
</div>  
<?php } ?>
<div class="top">
  <div class="heading"><?php echo $text_ocdev_smart_checkout_heading; ?></div>
  <div class="close_button" title="<?php echo $text_to_close; ?>"></div>
</div>
<div id="check_data">
  <div class="middle" id="smch_modal_data">
    <input name="product_id" type="hidden" value="<?php echo $product_id ?>" />
    <?php if ( isset( $hide_main_img ) || isset( $hide_sub_img ) ) { ?>

    <!-- IMAGE and SUB IMAGES -->

      <div class="image_block">
        <?php if ( isset( $hide_main_img ) ) { ?>
          <div class="image<?php echo ( !isset( $hide_sub_img ) || !$images ) ? " no_images" : ""; ?>">
            <img 
              src="<?php echo $thumb; ?>" 
              title="<?php echo $product_name; ?>" 
              alt="<?php echo $product_name; ?>" 
              id="smch_modal_image" 
            />
          </div>
        <?php } ?>
        <?php if ( isset( $hide_sub_img ) ) { ?>
          <div class="images">
            <?php foreach ($images as $image) { ?>
              <img 
                src="<?php echo $image['thumb']; ?>" 
                title="<?php echo $product_name; ?>" 
                alt="<?php echo $product_name; ?>" 
                rel="<?php echo $image['popup']; ?>" 
                onclick="changeImage(this);" 
              />
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <!-- PROCESSING -->

    <div class="processing">

    <!-- NAME and ANOTHER DATA -->

      <div class="name">
        <span class="name_main"><?php echo $product_name; ?></span>
        <?php if ( $product_model && isset( $hide_product_model ) ) { ?><span><b><?php echo $text_model; ?></b> <?php echo $product_model; ?></span><?php } ?>
        <?php if ( $product_ean && isset( $hide_product_ean ) ) { ?><span><b><?php echo $text_ean; ?></b> <?php echo $product_ean; ?></span><?php } ?>
        <?php if ( $product_jan && isset( $hide_product_jan ) ) { ?><span><b><?php echo $text_jan; ?></b> <?php echo $product_jan; ?></span><?php } ?>
        <?php if ( $product_isbn && isset( $hide_product_isbn ) ) { ?><span><b><?php echo $text_isbn; ?></b> <?php echo $product_isbn; ?></span><?php } ?>
        <?php if ( $product_mpn && isset( $hide_product_mpn ) ) { ?><span><b><?php echo $text_mpn; ?></b> <?php echo $product_mpn; ?></span><?php } ?>
        <?php if ( $product_location && isset( $hide_product_location ) ) { ?><span><b><?php echo $text_location; ?></b> <?php echo $product_location; ?></span><?php } ?>
      </div>

      <!-- QUANTITY -->

      <div class="quantity" id="smch_quantity">
        <div>
          <button onclick="$(this).next().val(~~$(this).next().val()+1); update_quantity('<?php echo $product_id; ?>');" id="increase_quantity">+</button>
          <input 
            type="text" 
            name="quantity" 
            value="1" 
            onchange="reCalculate(); return validate_input(this);" 
            onkeyup="reCalculate(); return validate_input(this);" 
            class="input_quantity" 
          />
          <button onclick="$(this).prev().val(~~$(this).prev().val()-1); update_quantity('<?php echo $product_id; ?>');" id="decrease_quantity">&mdash;</button>
        </div>
      </div>

      <!-- TOTALS -->

      <div class="totals">
        <?php if ( $price ) { ?>
          <?php if ( $special ) { ?>
            <div id="ocdev_special"><?php echo $special; ?></div> 
            <div id="ocdev_price" class="old_price"><?php echo $price; ?></div>
          <?php } else { ?>
            <div id="ocdev_price"><?php echo $price; ?></div>
          <?php } ?>  
          <?php if ( $tax ) { ?><div class="tax"><span><?php echo $text_tax; ?></span> <div id="ocdev_tax"><?php echo $tax; ?></div></div><?php } ?>
        <?php } ?>
        <?php if ( $discounts && isset( $discount_status ) ) { ?>
          <div class="discount">
            <?php foreach ( $discounts as $discount ) { ?>
            <?php echo sprintf( $text_discount, $discount['quantity'], $discount['price']); ?><br />
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div>

    <?php if ( $fields_data ) { ?>

    <!-- FIELDS DATA -->

      <div class="ocdev_smart_checkout_fields">
        <?php foreach ( $fields_data as $field ) { ?>
          <?php if( $field['type'] == 'textarea' ) { ?>
            <div <?php echo ( $field['css_id'] ) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ( $field['css_class'] ) ? $field['css_class'] : "" ; ?>">
              <textarea name="<?php echo $field['name']; ?>" placeholder="<?php echo $field['title']; ?>" ><?php echo $input_value[$field['name']]; ?></textarea>
            </div>
          <?php } elseif ( $field['type'] == 'select' ) { ?>
            <div <?php echo ( $field['css_id'] ) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ( $field['css_class'] ) ? $field['css_class'] : "" ; ?>">
              <?php if( $field['name'] == 'country_id' ) { ?>
              <select name="<?php echo $field['name']; ?>">
                <option value=""><?php echo $text_select; ?></option>
                <?php if ( $countries ) { ?>
                  <?php foreach ( $countries as $country ) { ?>
                    <?php if ( $country['country_id'] == $ocdev_smart_checkout_country_id ) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </select>
              <?php } elseif ( $field['name'] == 'zone_id' ) { ?>
                <select name="zone_id"></select>
              <?php } else { ?>
                <select name="<?php echo $field['name']; ?>"></select>
              <?php } ?>
            </div>
          <?php } else { ?>
            <div <?php echo ( $field['css_id'] ) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ( $field['css_class'] ) ? $field['css_class'] : "" ; ?>">
              <input name="<?php echo $field['name']; ?>" value="<?php echo $input_value[$field['name']]; ?>" type="<?php echo $field['type']; ?>" placeholder="<?php echo $field['title']; ?>" />
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <?php if ( isset( $telephone_mask ) ) { ?>
        <script type="text/javascript">
          $("#smch_modal_body input[name='telephone']").inputmask('<?php echo $telephone_mask; ?>');
        </script>
      <?php } ?>
    <?php } ?>

    <?php if ( $shipping_methods ) { ?>

    <!-- SHIPPING METHODS -->

      <table class="smch_methods_table" id="smch_shipping_table">
        <thead>
          <tr>
            <td colspan="3"><?php echo $text_shipping_methods; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $shipping_methods as $shipping_method ) { ?>
          <?php if ( isset( $hide_shipping_title ) ) { ?>
            <tr>
              <td colspan="3" class="heading"><?php echo $shipping_method['title']; ?></td>
            </tr>
          <?php } ?>
          <?php foreach ( $shipping_method['quote'] as $quote ) { ?>
          <tr>
            <td>
              <div>
                <?php $shipping = explode( '.', $quote['code'] ); ?>
                <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" <?php echo ( isset( $default_shipping ) && $default_shipping == $shipping[0] ) ? "checked" : ""; ?> />
              </div>
            </td>
            <td>
              <label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
            </td>
            <td style="text-align: right;">
              <label for="<?php echo $quote['code']; ?>"><?php echo $quote['text']; ?></label>
            </td>
          </tr>
          <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>

    <?php if ( $payment_methods ) { ?>

    <!-- PAYMENT METHODS -->

      <table class="smch_methods_table" id="smch_payment_table">
        <thead>
          <tr>
            <td colspan="3"><?php echo $text_payment_methods; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $payment_methods as $payment_method ) { ?>
          <tr>
            <td>
              <div>
                <?php $payment = explode( '.', $payment_method['code'] ); ?>
                <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" <?php echo ( isset( $default_payment ) && $default_payment == $payment[0] ) ? "checked" : ""; ?> />
              </div>
            </td>
            <td>
              <label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></label>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>

    <?php if ( $options && isset( $hide_product_options ) ) { ?> 

    <!-- OPTIONS -->
      <script type="text/javascript">
        $('#smch_modal_data .date_input').datetimepicker( { pickTime: false } );
        $('#smch_modal_data .datetime_input').datetimepicker( { pickDate: true, pickTime: true } );
        $('#smch_modal_data .time_input').datetimepicker( { pickDate: false } );
      </script>
      <?php foreach ( $options as $option ) { ?>
        <?php if ( $option['type'] == 'select' ) { ?>
          <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
            <select onchange="reCalculate();" name="option[<?php echo $option['product_option_id']; ?>]" >
              <option value=""><?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?></option>
              <?php foreach ( $option['product_option_value'] as $option_value ) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ( $option_value['price'] ) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </option>
              <?php } ?>
            </select>
          </div>
        <?php } ?>
        <?php if ( $option['type'] == 'text' ) { ?>
        <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" />
        </div>
        <?php } ?>
        <?php if ( $option['type'] == 'textarea' ) { ?>
        <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>"><?php echo $option['value']; ?></textarea>
        </div>
        <?php } ?>
        <?php if ( $option['type'] == 'radio' ) { ?>
        <table id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
          <thead>
            <tr>
              <td colspan="3"><?php echo $option['name']; ?><?php if ($option['required']) { ?><span class="required">*</span><?php } ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $option['product_option_value'] as $option_value ) { ?>
            <tr>
              <td>
              <input 
                onchange="reCalculate();" 
                type="radio" 
                name="option[<?php echo $option['product_option_id']; ?>]" 
                value="<?php echo $option_value['product_option_value_id']; ?>" 
                id="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>" 
              />
              </td>
              <td>
                <label for="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>">
                  <?php echo $option_value['name']; ?>
                </label>
              </td>
              <td style="text-align: right;">
                <?php if ( $option_value['price'] ) { ?>
                  <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
        <?php if ( $option['type'] == 'checkbox' ) { ?>
        <table id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
          <thead>
            <tr>
              <td colspan="3"><?php echo $option['name']; ?><?php if ( $option['required'] ) { ?><span class="required">*</span><?php } ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $option['product_option_value'] as $option_value ) { ?>
            <tr>
              <td>
              <input 
                onchange="reCalculate();" 
                type="checkbox" 
                name="option[<?php echo $option['product_option_id']; ?>][]" 
                value="<?php echo $option_value['product_option_value_id']; ?>" 
                id="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>" 
              />
              </td>
              <td>
                <label for="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>">
                  <?php echo $option_value['name']; ?>
                </label>
              </td>
              <td style="text-align: right;">
                <?php if ( $option_value['price'] ) { ?>
                  <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
        <?php if ( $option['type'] == 'image' ) { ?>
         <table id="smch_option-<?php echo $option['product_option_id']; ?>" class="smch_methods_table">
          <thead>
            <tr>
              <td colspan="4"><?php echo $option['name']; ?><?php if ( $option['required'] ) { ?><span class="required">*</span><?php } ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $option['product_option_value'] as $option_value ) { ?>
            <tr>
              <td>
              <input 
                onchange="reCalculate();" 
                type="radio" 
                name="option[<?php echo $option['product_option_id']; ?>]" 
                value="<?php echo $option_value['product_option_value_id']; ?>" 
                id="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>" 
              />
              </td>
              <td style="width:<?php echo !empty($option_images_width) ? $option_images_width : 50; ?>px;">
                <label for="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>">
                <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" />
                </label>
              </td>
              <td>
                <label for="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>" style="float: left;">
                  <?php echo $option_value['name']; ?>
                </label>
              </td>
              <td>
                <label for="smch_option-value-<?php echo $option_value['product_option_value_id']; ?>" style="float: right;">
                  <?php if ( $option_value['price'] ) { ?>
                    <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
                  <?php } ?>
                </label>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
        <?php if ( $option['type'] == 'date' ) { ?>
          <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
            <input 
              type="text" 
              name="option[<?php echo $option['product_option_id']; ?>]" 
              value="<?php echo $option['value']; ?>" 
              class="date_input" 
              data-format="YYYY-MM-DD" 
              placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
            />
          </div>
        <?php } ?>
        <?php if ( $option['type'] == 'datetime' ) { ?>
          <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
            <input 
              type="text" 
              name="option[<?php echo $option['product_option_id']; ?>]" 
              value="<?php echo $option['value']; ?>" 
              class="datetime_input" 
              data-format="YYYY-MM-DD HH:mm" 
              placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
            />
          </div>
        <?php } ?>
        <?php if ( $option['type'] == 'time' ) { ?>
        <div id="smch_option-<?php echo $option['product_option_id']; ?>" class="option">
          <input 
            type="text" 
            name="option[<?php echo $option['product_option_id']; ?>]" 
            value="<?php echo $option['value']; ?>" 
            class="time_input" 
            data-format="HH:mm" 
            placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
          />
        </div>
        <?php } ?>
      <?php } ?>
    <?php } ?>
    <?php if ( $informations ) { ?>
      <div id="require_information"><?php echo $informations; ?> <input type="checkbox" name="require_information" value="<?php echo isset( $require_information ) ? 1 : 0; ?>" /></div>
    <?php } ?>
    <?php if ( isset( $use_captcha_verification ) ) { ?>
      <div id="require_captcha">
        <input type="text" name="require_captcha" value="" placeholder="<?php echo $text_require_captcha_ph; ?>" />
        <img src="index.php?route=extension/module/ocdev_smart_checkout/captcha" alt="" />
      </div>
    <?php } ?>
  </div>

  <!-- TOTALS COUNT and CHECKOUT BUTTON -->

  <div class="bottom">
    <?php if ( $price ) { ?>
      <?php if ( $special ) { ?>
      <div class="totals"><span><?php echo $text_total_bottom; ?></span> <div id="total_order"><?php echo $special; ?></div></div>
      <?php } else { ?>
      <div class="totals"><span><?php echo $text_total_bottom; ?></span> <div id="total_order"><?php echo $price; ?></div></div>
      <?php } ?>
    <?php } ?>
    <input type="button" onclick="sendOrder();" value="<?php echo $button_send_order; ?>" />
  </div>
</div>

<?php if ( isset( $style_beckground ) ) { ?>
<style type="text/css">
  #smch_modal_background {
    background: url('image/ocdev_smart_checkout/background/<?php echo $style_beckground ;?>');
    opacity: <?php echo $background_opacity; ?>;
  }
</style>
<?php } ?>

<script type="text/javascript"><!--
<?php if ( $countries ) { ?>
$('#smch_modal_data select[name=\'country_id\']').bind('change', function() {
  if (this.value == '') return;
  $.ajax({
    url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('#smch_modal_data select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="image/ocdev_smart_checkout/loading_mini.gif" alt="" /></span>');
    },
    complete: function() {
      $('.wait').remove();
    },      
    success: function(json) {
      html = '<option value=""><?php echo $text_select; ?></option>';
      
      if (json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
          html += '<option value="' + json['zone'][i]['zone_id'] +','+ json['zone'][i]['name'] + '"';
            
          if (json['zone'][i]['zone_id'] == '<?php echo $ocdev_smart_checkout_zone_id; ?>') {
            html += ' selected="selected"';
          }
  
          html += '>' + json['zone'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }
      
      $('#smch_modal_data select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
$('#smch_modal_data select[name=\'country_id\']').trigger('change');
$('#smch_modal_data select[name=\'country_id\']').bind('change', function() {
  reMethods();
});
$('#smch_modal_data select[name=\'zone_id\']').bind('change', function() {
  reMethods();
});
<?php } ?>
$( document ).on( 'change', '#smch_modal_data input[name=\'shipping_method\']', function() {
  reCalculate();
});
$( document ).on( 'change', '#smch_modal_data input[name=\'payment_method\']', function() {
  reCalculate();
});
$smch_modal_background.attr('title','<?php echo $text_to_close; ?>');
//--></script>