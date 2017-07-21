<?php echo $header; ?><?php echo $column_left; ?>

<div id="content" class="main_ocdev_module">
<ol class="breadcrumb">
  <?php foreach ( $breadcrumbs as $i=> $breadcrumb ) { ?>
  <?php if( $i + 1 < count( $breadcrumbs ) ) { ?><li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li><?php } else { ?><li class="active"><?php echo $breadcrumb['text']; ?></li><?php } ?>
  <?php } ?>
</ol>
<?php if ( $error_warning ) { ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
  <?php echo $error_warning; ?>
</div>
<?php } ?>
<?php if ( $error_text ) { ?>
<?php foreach ( $error_text as $text ) { ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
  <?php echo $text; ?>
</div>
<?php } ?>
<?php } ?>
<?php if ( $error_data_fields ) { ?>
<?php foreach ( $error_data_fields as $key=>$field ) { ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
  <?php echo $field; ?>
  <script type="text/javascript">
    $( document ).ready( function(){
      $( 'input[name*=<?php echo $key; ?>]' )
      .parent( 'div.input-group' )
      .addClass( 'has-error' );
    });
  </script>
</div>
<?php } ?>
<?php } ?>
<?php if ( $success ) { ?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
  <?php echo $success; ?>
</div>
<?php } ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" style="display:inline-block;"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $heading_title; ?></h3>
      <div class="buttons" style="float: right;display: inline-block;">
        <a onclick="$('#form').submit();" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-save"></i> <?php echo $button_save; ?></a>
        <a href="<?php echo $cache; ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-trash"></i> <?php echo $button_clear_cache; ?></a>
        <a href="<?php echo $cancel; ?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-log-out"></i> <?php echo $button_cancel; ?></a>
      </div>
  </div>
  <div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#<?php echo $_module_name; ?>_main_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-cog"></i> <?php echo $tab_basic_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_output_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-file"></i> <?php echo $tab_output_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_field_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-th-list"></i> <?php echo $tab_field_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_display_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-eye-open"></i> <?php echo $tab_display_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_style_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-picture"></i> <?php echo $tab_style_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_analytics_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-stats"></i> <?php echo $tab_analytics_settings; ?></a></li>
          <li role="presentation"><a href="#<?php echo $_module_name; ?>_about_settings" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $tab_about_settings; ?></a></li>
        </ul>
        <div class="tab-content">
          <!-- TAB Basic settings -->
          <div role="tabpanel" class="tab-pane active" id="<?php echo $_module_name; ?>_main_settings">
            <table class="form main">
              <tr>
                <td><?php echo $text_activate_module; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[activate]" value="1" <?php echo ( !empty( $form_data['activate'] ) ) ? 'checked' : '' ; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_stock_check; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_stock_check_faq; ?>"></i></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[stock_validate]" value="1" <?php echo ( !empty( $form_data['stock_validate'] ) ) ? 'checked' : '' ; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_captcha_verification; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[use_captcha_verification]" value="1" <?php echo ( !empty( $form_data['use_captcha_verification'] ) ) ? 'checked' : '' ; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_shipping_check; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[require_shipping_method]" value="1" <?php echo ( !empty( $form_data['require_shipping_method'] ) ) ? 'checked' : '' ; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_payment_check; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[require_payment_method]" value="1" <?php echo ( !empty( $form_data['require_payment_method'] ) ) ? 'checked' : '' ; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_telephone_mask; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_telephone_mask_faq; ?>"></i></td>
                <td><div class="input-group input-group-sm"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input value="<?php echo $form_data['telephone_mask']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[telephone_mask]" class="form-control" placeholder="<?php echo $text_telephone_mask_ph; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $text_alternative_email; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_alternative_email_faq; ?>"></i></td>
                <td><div class="input-group input-group-sm"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input value="<?php echo $form_data['alternative_email']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[alternative_email]" class="form-control" /></div></td>
              </tr>
              <tr>
                <td><?php echo $text_order_prefix; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_order_prefix_faq; ?>"></i></td>
                <td><div class="input-group input-group-sm"><span class="input-group-addon"><i class="glyphicon glyphicon-indent-left"></i></span><input value="<?php echo $form_data['prefix_order']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[prefix_order]" class="form-control" /></div></td>
              </tr>
              <tr>
                <td><?php echo $text_add_function_selector; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_add_function_selector_faq; ?>"></i></td>
                <td><div class="input-group input-group-sm"><span class="input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span><input value="<?php echo $form_data['add_function_selector']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[add_function_selector]" class="form-control" placeholder="<?php echo $text_add_function_selector_ph; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $text_add_id_selector; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_add_id_selector_faq; ?>"></i></td>
                <td><div class="input-group input-group-sm"><span class="input-group-addon">#</span><input value="<?php echo $form_data['add_id_selector']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[add_id_selector]" class="form-control" placeholder="<?php echo $text_add_id_selector_ph; ?>" /></div></td>
              </tr>
              <tr>
                <td><?php echo $text_order_status; ?></td>
                <td>
                  <div class="input-group-sm">
                    <select name="<?php echo $_module_name; ?>_form_data[order_status_id]" class="form-control">
                      <option value=""><?php echo $text_make_a_choice; ?></option>
                      <?php foreach ( $order_statuses as $order_status ) { ?>
                        <?php if ( isset( $form_data['order_status_id'] ) && $order_status['status_id'] == $form_data['order_status_id'] ) { ?>
                          <option value="<?php echo $order_status['status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                          <option value="<?php echo $order_status['status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_module_heading; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_module_heading_faq; ?>"></i></td>
                <td>
                  <ul class="nav nav-tabs" id="module_heading">
                    <?php foreach ( $languages as $language ) { ?>
                      <li>
                        <a href="#module_heading<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <?php foreach ( $languages as $language ) { ?>
                    <div id="module_heading<?php echo $language['language_id']; ?>" class="language-block">
                      <table class="form">
                        <tr>
                          <td>
                            <div class="input-group-sm">
                              <input 
                                type="text" 
                                name="<?php echo $_module_name; ?>_text_data[<?php echo $language['code']; ?>][heading]" 
                                value="<?php echo ( !empty( $text_data[$language['code']]['heading'] ) ) ? $text_data[$language['code']]['heading'] : ''; ?>" 
                                class="form-control" 
                              />
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_module_call_button; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_module_call_button_faq; ?>"></i></td>
                <td>
                  <ul class="nav nav-tabs" id="module_call_button">
                    <?php foreach ( $languages as $language ) { ?>
                      <li>
                        <a href="#module_call_button<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <?php foreach ( $languages as $language ) { ?>
                    <div id="module_call_button<?php echo $language['language_id']; ?>" class="language-block">
                      <table class="form">
                        <tr>
                          <td>
                            <div class="input-group-sm">
                              <input 
                                type="text" 
                                name="<?php echo $_module_name; ?>_text_data[<?php echo $language['code']; ?>][call_button]" 
                                value="<?php echo ( !empty( $text_data[$language['code']]['call_button'] ) ) ? $text_data[$language['code']]['call_button'] : ''; ?>" 
                                class="form-control" 
                              />
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_result_message; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_result_message_faq; ?>"></i></td>
                <td>
                  <ul class="nav nav-tabs" id="success_text">
                    <?php foreach ( $languages as $language ) { ?>
                      <li>
                        <a href="#success_text<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <?php foreach ( $languages as $language ) { ?>
                    <div id="success_text<?php echo $language['language_id']; ?>" class="language-block">
                      <table class="form">
                        <tr>
                          <td>
                            <div class="input-group-sm">
                              <textarea 
                                class="form-control" 
                                style="height:auto;resize:vertical;" 
                                rows="3" 
                                name="<?php echo $_module_name; ?>_text_data[<?php echo $language['code']; ?>][success_text]"><?php echo ( !empty( $text_data[$language['code']]['success_text'] ) ) ? $text_data[$language['code']]['success_text'] : '';?></textarea>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  <?php } ?>
                  <?php echo $text_result_message_sub; ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_message_informer; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_message_informer_faq; ?>"></i></td>
                <td>
                  <ul class="nav nav-tabs" id="informer">
                    <?php foreach ( $languages as $language ) { ?>
                    <li><a href="#informer<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                    <?php } ?>
                  </ul>
                  <?php foreach ( $languages as $language ) { ?>
                    <div id="informer<?php echo $language['language_id']; ?>" class="language-block">
                      <table class="form">
                        <tr>
                          <td>
                            <div class="input-group-sm">
                              <textarea 
                                class="form-control" 
                                style="height:auto;resize:vertical;" 
                                rows="3" 
                                name="<?php echo $_module_name; ?>_text_data[<?php echo $language['code']; ?>][informer]"
                                ><?php echo ( !empty( $text_data[$language['code']]['informer'] ) ) ? $text_data[$language['code']]['informer'] : ''; ?></textarea>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  <?php } ?>
                </td>
              </tr>
            </table>
          </div>
          <!-- TAB Output settings -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_output_settings">
            <table class="form">
              <tr>
                <td><?php echo $text_show_in_stores; ?></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $all_stores as $store ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="checkbox" 
                          name="<?php echo $_module_name; ?>_form_data[stores][<?php echo $row; ?>]" 
                          value="<?php echo $store['store_id']; ?>" 
                          <?php echo (  isset( $form_data['stores'] ) && in_array($store['store_id'], $form_data['stores'] ) ) ? 'checked' : ''; ?> 
                        /> <?php echo $store['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
              <tr>
                <td><?php echo $text_customer_groups; ?></td>
                <td><div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $all_customer_groups as $customer_group ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="checkbox" 
                          name="<?php echo $_module_name; ?>_form_data[customer_groups][<?php echo $row; ?>]" 
                          value="<?php echo $customer_group['customer_group_id']; ?>" 
                          <?php echo ( !empty( $form_data['customer_groups'][$row] ) ) ? 'checked' : ''; ?> 
                        /> <?php echo $customer_group['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_select_payments; ?></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $payments as $payment ) { ?>
                      <?php if ( !empty( $payment['code'] ) ) { ?>
                      <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                        <div class="<?php echo $class; ?>">
                          <label>
                            <input 
                              type="checkbox" 
                              class="payments_input"
                              name="<?php echo $_module_name; ?>_form_data[payment_code][<?php echo $row; ?>]" 
                              value="<?php echo $payment['code']; ?>" 
                              <?php echo ( !empty( $form_data['payment_code'][$row] ) ) ? 'checked' : ''; ?> 
                            /> <?php echo $payment['name']; ?>
                          </label>
                          <input 
                            style="float:right;" 
                            type="radio" 
                            name="<?php echo $_module_name; ?>_form_data[default_payment]" 
                            value="<?php echo $payment['code']; ?>" <?php echo ( !empty( $form_data['default_payment'] ) && $form_data['default_payment'] == $payment['code'] ) ? 'checked' : ''; ?>
                            data-placement="top" 
                            data-toggle="tooltip" 
                            title="<?php echo $text_default_payment_faq; ?>" 
                          />
                          <input class="transfer_payments_selector" 
                            type="text" 
                            name="<?php echo $_module_name; ?>_form_data[transfer_payments_selector][<?php echo $payment['code']; ?>]" 
                            value="<?php echo ( !empty( $form_data['transfer_payments_selector'][$payment['code']] ) ) ? $form_data['transfer_payments_selector'][$payment['code']] : ''; ?>" 
                            data-placement="top" 
                            data-toggle="tooltip" 
                            title="<?php echo $transfer_payments_selector_faq; ?>" 
                          />
                          <input 
                            style="float:right;" 
                            type="checkbox" 
                            name="<?php echo $_module_name; ?>_form_data[transfer_payments][<?php echo $row; ?>]" 
                            value="<?php echo $payment['code']; ?>" <?php echo ( !empty( $form_data['transfer_payments'][$row] ) ) ? 'checked' : ''; ?>
                            data-placement="top" 
                            data-toggle="tooltip" 
                            title="<?php echo $transfer_payments_faq; ?>" 
                          />
                        </div>
                      <?php } ?>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find('.payments_input:checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find('.payments_input:checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
              <tr>
                <td><?php echo $text_select_shipping; ?></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $shippings as $shipping ) { ?>
                    <?php if ( !empty( $shipping['code'] ) ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="checkbox" 
                          name="<?php echo $_module_name; ?>_form_data[shipping_code][<?php echo $row; ?>]" 
                          value="<?php echo $shipping['code']; ?>" 
                          <?php echo ( !empty( $form_data['shipping_code'][$row] ) ) ? 'checked' : ''; ?> 
                        /> <?php echo $shipping['name']; ?>
                      </label>
                      <input 
                        style="float:right;" 
                        type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[default_shipping]" 
                        value="<?php echo $shipping['code']; ?>" <?php echo ( !empty( $form_data['default_shipping'] ) && $form_data['default_shipping'] == $shipping['code'] ) ? 'checked' : ''; ?>
                        data-placement="top" 
                        data-toggle="tooltip" 
                        title="<?php echo $text_default_shipping_faq; ?>" 
                      />
                    </div>
                    <?php } ?>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
              <tr>
                <td><?php echo $text_select_options; ?></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $product_options as $option ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="checkbox" 
                          name="<?php echo $_module_name; ?>_form_data[product_options][<?php echo $row; ?>]" 
                          value="<?php echo $option['option_id']; ?>" 
                          <?php echo ( !empty( $form_data['product_options'][$row] ) ) ? 'checked' : ''; ?> 
                        /> <?php echo $option['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
              <tr>
                <td><?php echo $text_select_country; ?></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $countries_data as $country ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="checkbox" 
                          name="<?php echo $_module_name; ?>_form_data[product_countries][<?php echo $row; ?>]" 
                          value="<?php echo $country['country_id']; ?>" 
                          <?php echo ( !empty( $form_data['product_countries'][$row] ) ) ? 'checked' : ''; ?> 
                        /> <?php echo $country['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
              <tr>
                <td><?php echo $text_select_information; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_select_information_faq; ?>"></i></td>
                <td>
                  <div class="scrollbox">
                    <?php $class = 'odd'; $row = 0; ?>
                    <?php foreach ( $informations as $information ) { ?>
                    <?php $class = ( $class == 'even' ? 'odd' : 'even' ); ?>
                    <div class="<?php echo $class; ?>">
                      <label>
                        <input 
                          type="radio" 
                          name="<?php echo $_module_name; ?>_form_data[require_information]" 
                          value="<?php echo $information['information_id']; ?>" 
                          <?php echo ( isset( $form_data['require_information'] ) && $form_data['require_information'] == $information['information_id'] ) ? 'checked' : ''; ?> 
                        /> <?php echo $information['title']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <br/>
                  <a onclick="$(this).parent().find(':radio').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
              </tr> 
            </table> 
          </div>
          <!-- TAB Configure fields set -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_field_settings">
            <div class="tabbable tabs-left" id="fil_form">
              <div class="col-sm-3">
                <ul class="nav nav-tabs" id="module">
                  <?php $field_row = 1; ?>
                  <?php foreach ( $field_data as $field ) { ?>
                  <li>
                    <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][sort_order]" />
                    <a href="#tab-module<?php echo $field_row; ?>" data-toggle="tab"><i class="glyphicon glyphicon-minus-sign" onclick="$( 'a[href=\'#tab-module<?php echo $field_row; ?>\']' ).parent().remove(); $( '#tab-module<?php echo $field_row; ?>' ).remove(); $( '#module a:first' ).tab('show' );"></i> <?php echo $tab_module; ?> <?php echo '№'. $field_row; ?>
                    <span class="field_title">(<?php echo ( isset( $field['title'][$admin_language] ) ) ? $field['title'][$admin_language] : ''; ?>)</span>
                    </a>
                  </li>
                  <?php $field_row++; ?>
                  <?php } ?>
                  <li id="module-add">
                    <a onclick="addField();" class="pull-right"><span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus-sign"></i> <?php echo $button_add_module; ?></span></a>
                  </li>
                </ul>
              </div>
              <div class="col-sm-9">
                <div class="tab-content">
                  <?php $field_row = 1; ?>
                  <?php foreach ( $field_data as $field ) { ?>
                    <div class="tab-pane" id="tab-module<?php echo $field_row; ?>">
                      <table class="form">
                        <tr>
                          <td><?php echo $text_activate_field; ?></td>
                          <td>
                            <div class="input-group-sm">
                              <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][activate]" class="form-control">
                                <?php if ( $field['activate'] == TRUE ) { ?>
                                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                  <option value="0"><?php echo $text_no; ?></option>
                                <?php } else { ?>
                                  <option value="1"><?php echo $text_yes; ?></option>
                                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $text_heading_field; ?></td>
                          <td>
                            <ul class="nav nav-tabs" id="language<?php echo $field_row; ?>">
                              <?php foreach ( $languages as $language ) { ?>
                                <li>
                                  <a href="#tab-module<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <?php foreach ( $languages as $language ) { ?>
                              <div class="tab-pane fields_block" id="tab-module<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>">
                                <table class="form">
                                  <tr>
                                    <td>
                                      <div class="input-group-sm">
                                        <input 
                                        type="text" 
                                        name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][title][<?php echo $language['code']; ?>]" 
                                        value="<?php echo ( isset( $field['title'][$language['code']] ) ) ? $field['title'][$language['code']] : ''; ?>" 
                                        class="form-control" 
                                        />
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $text_assign_functionality; ?></td>
                          <td>
                            <div class="input-group-sm">
                              <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][view]" class="form-control">
                                  <option value="0"><?php echo $text_make_a_choice; ?></option>
                                <?php foreach ( $field_view_data as $key => $view ) { ?>
                                  <option value="<?php echo $key; ?>" <?php echo ( $field['view'] == $key ) ? 'selected="selected"' : ''; ?> ><?php echo $view; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $text_check_type; ?></td>
                          <td>
                            <div class="input-group-sm">
                              <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check]" class="form-control">
                                  <option value="0" <?php echo $field['check'] == 0 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_1; ?></option>
                                  <option value="1" <?php echo $field['check'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_2; ?></option>
                                  <option value="2" <?php echo $field['check'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_3; ?></option>
                                  <option value="3" <?php echo $field['check'] == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_4; ?></option>
                              </select>

                              <div class="input-group input-group-sm" style="<?php echo $field['check'] == 2 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                <input type="text" placeholder="<?php echo $text_validation_type_3_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_rule]" value="<?php echo $field['check_rule']; ?>" class="form-control" />
                              </div>
                              <div class="input-group input-group-sm" style="<?php echo $field['check'] == 3 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                <input type="text" placeholder="<?php echo $text_validation_type_4_1_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_min]" value="<?php echo $field['check_min']; ?>" class="form-control" />
                              </div>
                              <div class="input-group input-group-sm" style="<?php echo $field['check'] == 3 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-left"></i></span>
                                <input type="text" placeholder="<?php echo $text_validation_type_4_2_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_max]" value="<?php echo $field['check_max']; ?>" class="form-control" />
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $text_error_text; ?></td>
                          <td>
                            <ul class="nav nav-tabs" id="language<?php echo $field_row; ?>">
                              <?php foreach ( $languages as $language ) { ?>
                                <li>
                                  <a href="#tab-module2<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <?php foreach ( $languages as $language ) { ?>
                              <div class="tab-pane fields_block" id="tab-module2<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>">
                                <table class="form">
                                  <tr>
                                    <td>
                                        <div class="input-group-sm">
                                          <input 
                                            type="text" 
                                            name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][error_text][<?php echo $language['code']; ?>]" 
                                            value="<?php echo isset( $field['error_text'][$language['code']]) ? $field['error_text'][$language['code']] : ''; ?>" 
                                            class="form-control" 
                                          />
                                        </div>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo $text_css_id; ?></td>
                          <td><div class="input-group input-group-sm"><span class="input-group-addon">#</span><input value="<?php echo $field['css_id']; ?>" type="text" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][css_id]" class="form-control" placeholder="<?php echo $text_css_id_ph; ?>" /></div></td>
                        </tr>
                        <tr>
                          <td><?php echo $text_css_class; ?></td>
                          <td><div class="input-group input-group-sm"><span class="input-group-addon">&#8226;</span><input value="<?php echo $field['css_class']; ?>" type="text" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][css_class]" class="form-control" placeholder="<?php echo $text_css_class_ph; ?>" /></div></td>
                        </tr>
                        <tr>
                          <td><?php echo $text_position; ?></td>
                          <td>
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-success <?php echo $field['position'] == 1 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="1" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 1 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_left_side; ?>
                              </label>
                              <label class="btn btn-success <?php echo $field['position'] == 3 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="3" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 3 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_center; ?>
                              </label>
                              <label class="btn btn-success <?php echo $field['position'] == 2 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="2" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 2 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_right_side; ?>
                              </label>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  <?php $field_row++; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <!-- TAB Display settings -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_display_settings">
            <table class="form">
              <tr>
                <td><?php echo $text_show_main_product_image; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_main_img]" value="1" <?php echo ( !empty( $form_data['hide_main_img'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_dementions_of_main_image; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-horizontal"></i></span>
                    <input 
                      value="<?php echo $form_data['main_image_width']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[main_image_width]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_width_ph; ?>" 
                    />
                  </div>
                  <br/>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-vertical"></i></span>
                    <input 
                      value="<?php echo $form_data['main_image_height']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[main_image_height]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_height_ph; ?>" 
                    />
                  </div>
                  <h5><?php echo $text_warning_dementions_of_main_image; ?></h5>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_show_sub_images; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_sub_img]" value="1" <?php echo ( !empty( $form_data['hide_sub_img'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_dementions_of_sub_images; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-horizontal"></i></span>
                    <input 
                      value="<?php echo $form_data['sub_images_width']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[sub_images_width]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_width_ph; ?>" 
                    />
                  </div>
                  <br/>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-vertical"></i></span>
                    <input 
                      value="<?php echo $form_data['sub_images_height']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[sub_images_height]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_height_ph; ?>" 
                    />
                  </div>
                  <h5><?php echo $text_warning_dementions_of_sub_images; ?></h5>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_count_sub_images; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-horizontal"></i></span>
                    <input 
                      value="<?php echo $form_data['count_sub_images']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[count_sub_images]" 
                      class="form-control" 
                    />
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_dementions_of_option_images; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-horizontal"></i></span>
                    <input 
                      value="<?php echo $form_data['option_images_width']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[option_images_width]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_width_ph; ?>" 
                    />
                  </div>
                  <br/>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-resize-vertical"></i></span>
                    <input 
                      value="<?php echo $form_data['option_images_height']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[option_images_height]" 
                      class="form-control" 
                      placeholder="<?php echo $text_image_height_ph; ?>" 
                    />
                  </div>
                  <h5><?php echo $text_warning_dementions_of_option_images; ?></h5>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_show_shipping_title; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_shipping_title]" value="1" <?php echo ( !empty( $form_data['hide_shipping_title'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_use_product_discount; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[discount_status]" value="1" <?php echo ( !empty( $form_data['discount_status'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_product_table_info; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_table_info]" value="1" <?php echo ( !empty( $form_data['hide_table_info'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_product_options; ?></td>
                <td><input type="checkbox" class="fix_input" name="<?php echo $_module_name; ?>_form_data[hide_product_options]" value="1" <?php echo ( !empty( $form_data['hide_product_options'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_product_attributes; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_attributes]" value="1" <?php echo ( !empty( $form_data['hide_product_attributes'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_product_description; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_description]" value="1" <?php echo ( !empty( $form_data['hide_product_description'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_model; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_model]" value="1" <?php echo ( !empty( $form_data['hide_product_model'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_ean; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_ean]" value="1" <?php echo ( !empty( $form_data['hide_product_ean'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_jan; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_jan]" value="1" <?php echo ( !empty( $form_data['hide_product_jan'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_isbn; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_isbn]" value="1" <?php echo ( !empty( $form_data['hide_product_isbn'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_mpn; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_mpn]" value="1" <?php echo ( !empty( $form_data['hide_product_mpn'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_show_product_location; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[hide_product_location]" value="1" <?php echo ( !empty( $form_data['hide_product_location'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
            </table>
          </div>
          <!-- TAB Style settings -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_style_settings">
            <table class="form">
              <tr>
                <td><?php echo $text_background_images; ?></td>
                <td class="td_background_images">
                <?php if ( $backgrounds ) { ?>
                  <?php $key = 1; foreach ( $backgrounds as $background ) { ?>
                  <input type="radio" name="<?php echo $_module_name; ?>_form_data[style_beckground]" id="label_img_<?php echo $key; ?>" value="<?php echo $background['name']; ?>" <?php echo ( !empty( $form_data['style_beckground'] ) && $form_data['style_beckground'] == $background['name'] ) ? 'checked' : ''; ?> />
                  <label class="background_for_label" for="label_img_<?php echo $key; ?>" style="background:url( <?php echo $background['src']; ?> );">
                  </label>
                  <?php $key++; } ?>
                <?php } ?>
               </td>
              </tr>
              <tr>
                <td><?php echo $text_background_opacity; ?> <i class="glyphicon glyphicon-info-sign faq" data-toggle="tooltip" data-placement="right" title="<?php echo $text_background_opacity_faq; ?>"></i></td>
                <td>
                  <label for="amount_opacity"><?php echo $text_background_opacity_value; ?></label>
                  <input type="text" id="amount_opacity" value="" name="<?php echo $_module_name; ?>_form_data[background_opacity]" style="border:0; color:#f6931f; font-weight:bold;" readonly />
                  <div id="slider_opacity"></div>
                </td>
              </tr>
            </table>
          </div>
          <!-- TAB Analytics -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_analytics_settings">
            <table class="form">
              <tr>
                <td><?php echo $text_allow_google_analytics; ?></td>
                <td><input type="checkbox" name="<?php echo $_module_name; ?>_form_data[allow_google_analytics]" value="1" <?php echo ( !empty( $form_data['allow_google_analytics'] ) ) ? 'checked' : ''; ?> /></td>
              </tr>
              <tr>
                <td><?php echo $text_google_analytics_id; ?></td>
                <td>
                  <div class="input-group-sm">
                    <textarea 
                      rows="3" 
                      style="height:auto;resize:vertical;" 
                      name="<?php echo $_module_name; ?>_form_data[google_analytics_script]" 
                      class="form-control" 
                      /><?php echo $form_data['google_analytics_script']; ?></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_allow_google_event; ?></td>
                <td>
                  <input 
                    type="checkbox" 
                    name="<?php echo $_module_name; ?>_form_data[allow_google_event]" 
                    value="1" 
                    <?php echo ( !empty( $form_data['allow_google_event'] ) ) ? 'checked' : ''; ?> 
                  />
                </td>
              </tr>
              <tr>
                <td><?php echo $text_google_event_category_name; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                      <input 
                        value="<?php echo $form_data['google_event_category']; ?>" 
                        type="text" 
                        name="<?php echo $_module_name; ?>_form_data[google_event_category]" 
                        class="form-control" 
                      />
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $text_google_event_action_name; ?></td>
                <td>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input 
                      value="<?php echo $form_data['google_event_action']; ?>" 
                      type="text" 
                      name="<?php echo $_module_name; ?>_form_data[google_event_action]" 
                      class="form-control" 
                    />
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <!-- TAB About -->
          <div role="tabpanel" class="tab-pane" id="<?php echo $_module_name; ?>_about_settings">
            <table class="form">
              <tr>
                <td><?php echo $text_installed_module_version; ?></td>
                <td><?php echo $_module_version; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_installed_module_name; ?></td>
                <td>&copy; <?php echo str_replace( array( '<b>','</b>' ), "", $heading_title ); ?></td>
              </tr>
              <tr>
                <td><?php echo $text_seller_page; ?></td>
                <td><a href="https://opencart2x.ru">opencart2x.ru</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_form_data[front_module_name]" value="<?php echo str_replace( array( '<b>','</b>' ), "", $heading_title ); ?>" />
      <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_form_data[front_module_version]" value="<?php echo $_module_version; ?>" />
    </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  $( ".main_ocdev_module .tabs-left > .col-sm-3 > .nav-tabs" ).sortable();
  $(function() {
    $( "#slider_opacity" ).slider( {
      range: "max",
      min: 0,
      max: 1,
      value: <?php echo ( !empty( $form_data['background_opacity'] ) ) ? $form_data['background_opacity'] : 0; ?>,
      step: 0.01,
      slide: function( event, ui ) {
        $( "#amount_opacity" ).val( ui.value );
      }
    } );
    $( "#amount_opacity" ).val( <?php echo ( !empty( $form_data['background_opacity'] ) ) ? $form_data['background_opacity'] : 0; ?> );
  });
//--></script>
<script type="text/javascript"><!--
  var field_row = <?php echo $field_row; ?>;

  function addField() {
    html  = '<div class="tab-pane" id="tab-module' + field_row + '">';
    html += ' <table class="form">';
    html += '   <tr>';
    html += '     <td><?php echo $text_activate_field; ?></td>';
    html += '     <td>';
    html += '      <div class="input-group-sm">';
    html += '        <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][activate]" class="form-control">';
    html += '          <option value="1"><?php echo $text_yes; ?></option><option value="0" selected="selected"><?php echo $text_no; ?></option>';
    html += '        </select>';
    html += '      </div>';
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_heading_field; ?></td>';
    html += '     <td>';
    html += '       <ul class="nav nav-tabs" id="language' + field_row + '">';
                      <?php foreach ( $languages as $language ) { ?>
    html += '         <li>';
    html += '           <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][sort_order]" />';
    html += '           <a href="#tab-module' + field_row + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    html += '         </li>';
                      <?php } ?>
    html += '       </ul>';
                    <?php foreach ( $languages as $language ) { ?>
    html += '       <div class="tab-pane fields_block" id="tab-module' + field_row + '-language<?php echo $language['language_id']; ?>">';
    html += '         <table class="form">';
    html += '           <tr>';
    html += '             <td>';
    html += '               <div class="input-group-sm">';
    html += '                 <input type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][title][<?php echo $language['code']; ?>]" value="" class="form-control" />';
    html += '               </div>';
    html += '             </td>';
    html += '           </tr>';
    html += '         </table>'; 
    html += '       </div>';
                    <?php } ?>
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_assign_functionality; ?></td>';
    html += '     <td>';
    html += '       <div class="input-group-sm">';
    html += '         <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][view]" class="form-control">';
    html += '           <option value="0"><?php echo $text_make_a_choice; ?></option>';
                        <?php foreach ( $field_view_data as $key => $view ) { ?>
    html += '           <option value="<?php echo $key; ?>"><?php echo $view; ?></option>';
                        <?php } ?>
    html += '         </select>';
    html += '       </div>';
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_check_type; ?></td>';
    html += '     <td>';
    html += '       <div class="input-group-sm">';
    html += '         <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check]" class="form-control">';
    html += '           <option value="0"><?php echo $text_validation_type_1; ?></option>';
    html += '           <option value="1"><?php echo $text_validation_type_2; ?></option>';
    html += '           <option value="2"><?php echo $text_validation_type_3; ?></option>';
    html += '           <option value="3"><?php echo $text_validation_type_4; ?></option>';
    html += '         </select>';
    html += '         <div class="input-group input-group-sm" style="display:none;margin-top:15px;">';
    html += '           <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>';
    html += '           <input type="text" placeholder="" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_rule]" value="" class="form-control" />';
    html += '         </div>';
    html += '         <div class="input-group input-group-sm" style="display:none;margin-top:15px;">';
    html += '           <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>';
    html += '           <input type="text" placeholder="<?php echo $text_validation_type_4_1_ph; ?>" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_min]" value="" class="form-control" />';
    html += '         </div>';
    html += '         <div class="input-group input-group-sm" style="display:none;margin-top:15px;">';
    html += '           <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-left"></i></span>';
    html += '           <input type="text" placeholder="<?php echo $text_validation_type_4_2_ph; ?>" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_max]" value="" class="form-control" />';
    html += '         </div>';
    html += '       </div>';
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_error_text; ?></td>';
    html += '     <td>';
    html += '       <ul class="nav nav-tabs" id="language' + field_row + '">';
                      <?php foreach ( $languages as $language) { ?>
    html += '           <li>';
    html += '             <a href="#tab-module2' + field_row + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    html += '           </li>';
                      <?php } ?>
    html += '       </ul>';
                    <?php foreach ( $languages as $language) { ?>
    html += '       <div class="tab-pane fields_block" id="tab-module2' + field_row + '-language<?php echo $language['language_id']; ?>">';
    html += '         <table class="form">';
    html += '           <tr>';
    html += '             <td>';
    html += '               <div class="input-group-sm">';
    html += '                 <input type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][error_text][<?php echo $language['code']; ?>]" value="" class="form-control" />';
    html += '               </div>';
    html += '             </td>';
    html += '           </tr>';
    html += '         </table>'; 
    html += '       </div>';
                    <?php } ?>
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_css_id; ?></td>';
    html += '     <td>';
    html += '       <div class="input-group input-group-sm">';
    html += '         <span class="input-group-addon">#</span>';
    html += '         <input value="" type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][css_id]" class="form-control" placeholder="<?php echo $text_css_id_ph; ?>" />';
    html += '       </div>';
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_css_class; ?></td>';
    html += '     <td>';
    html += '       <div class="input-group input-group-sm">';
    html += '         <span class="input-group-addon">&#8226;</span>';
    html += '         <input value="" type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][css_class]" class="form-control" placeholder="<?php echo $text_css_class_ph; ?>" />';
    html += '       </div>';
    html += '     </td>';
    html += '   </tr>';
    html += '   <tr>';
    html += '     <td><?php echo $text_position; ?></td>';
    html += '     <td>';
    html += '       <div class="btn-group" data-toggle="buttons">';
    html += '         <label class="btn btn-success">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="1" autocomplete="off" ><?php echo $text_left_side; ?>';
    html += '         </label>';
    html += '         <label class="btn btn-success active">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="3" autocomplete="off" checked="checked"><?php echo $text_center; ?>';
    html += '         </label>';
    html += '         <label class="btn btn-success">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="2" autocomplete="off" ><?php echo $text_right_side; ?>';
    html += '         </label>';
    html += '       </div>';
    html += '     </td>';
    html += '   </tr>';
    html += ' </table>';
    html += '</div>';

    $('.tab-content:first-child').append(html);

    $('#module-add').before('<li class="no_field_title"><a href="#tab-module' + field_row + '" data-toggle="tab"><i class="glyphicon glyphicon-minus-sign" onclick="$(\'a[href=\\\'#tab-module' + field_row + '\\\']\').parent().remove(); $(\'#tab-module' + field_row + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> <?php echo $tab_module; ?> №' + field_row + '</a></li>');
    $('#module a[href=\'#tab-module' + field_row + '\']').tab('show');
    $('#module a[href=\'#tab-module2' + field_row + '\']').tab('show');
    $('#language' + field_row + ' li:first-child a').tab('show');
  
    $( 'select[name*=check]' ).change( function() {
      var val = $( this ).val();
      if ( val == 2 ) {
        $( this ).next().show();
        $( this ).next().next().hide();
        $( this ).next().next().next().hide();
      } else if( val == 3 ) {
        $( this ).next().hide();
        $( this ).next().next().show();
        $( this ).next().next().next().show();
      } else {
        $( this ).next().hide();
        $( this ).next().next().hide();
        $( this ).next().next().next().hide();
      }
    });

    field_row++;
  }

  <?php $field_row = 1; ?>
  <?php foreach ( $field_data as $field ) { ?>
    $( '#language<?php echo $field_row; ?> li:first-child a' ).tab( 'show' );
  <?php $field_row++; ?>
  <?php } ?>
//--></script> 
<script type="text/javascript"><!--
$( 'select[name*=check]' ).change( function() {
  var val = $( this ).val();

   if ( val == 2 ) {
    $( this ).next().show();
    $( this ).next().next().hide();
    $( this ).next().next().next().hide();
   } else if( val == 3 ) {
    $( this ).next().hide();
    $( this ).next().next().show();
    $( this ).next().next().next().show();
   } else {
    $( this ).next().hide();
    $( this ).next().next().hide();
    $( this ).next().next().next().hide();
   }
});

$( '#module_heading a:first' ).tab( 'show' );
$( '#module_call_button a:first' ).tab( 'show' );
$( '#success_text a:first' ).tab( 'show' );
$( '#informer a:first' ).tab( 'show' );

$(function() {
  $( 'td > :checkbox' ).checkboxpicker();
  $( '#module li:first-child a' ).tab( 'show' );
  $( '[data-toggle="tooltip"]' ).tooltip()
});

(function($) { 
  $.extend($.fn.checkboxpicker.defaults, { 
    offLabel: '<?php echo $text_no; ?>', 
    onLabel: '<?php echo $text_yes; ?>', 
    style: 'btn-group-sm'
  }); 
})(jQuery);
//--></script>
<?php echo $footer; ?>