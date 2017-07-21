<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-as" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
	  </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-as" class="form-horizontal">
			<ul class="nav nav-tabs" id="tabs">
				<li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-fw fa-wrench"></i> <?php echo $tab_setting; ?></a></li>
				<li><a href="#tab-image" data-toggle="tab"><i class="fa fa-fw fa-camera"></i> <?php echo $tab_image; ?></a></li>
				<li><a href="#tab-splash-screen" data-toggle="tab"><i class="fa fa-fw fa-laptop"></i> <?php echo $tab_splash_screen; ?></a></li>
				<li><a href="#tab-promote-application" data-toggle="tab"><i class="fa fa-fw fa-bell-o"></i> <?php echo $tab_promote_application; ?></a></li>
				<li><a href="#tab-help" data-toggle="tab"><i class="fa fa-fw fa-question"></i> <?php echo $tab_help; ?></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab-setting"> 
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-template"><?php echo $entry_template; ?></label>
						<div class="col-sm-10">
							<select name="android_store_template" id="input-template" class="form-control">
								<?php foreach($templates as $template) { ?>
								<?php if ($template == $android_store_template) { ?>
								<option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
								<?php } else { ?>
								<option value="<?php echo $template; ?>"><?php echo $template; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-menu-type"><?php echo $entry_menu_type; ?></label>
						<div class="col-sm-10">
							<select name="android_store_menu_type" id="input-menu-type" class="form-control">
								<?php if ($android_store_menu_type == "category-name-search-cart-user") { ?>
								<option value="category-name-search-cart-user" selected="selected"><?php echo $text_menu_category_user; ?></option>
								<option value="user-name-search-category-cart"><?php echo $text_menu_user; ?></option>
								<?php } else { ?>
								<option value="category-name-search-cart-user"><?php echo $text_menu_category_user; ?></option>
								<option value="user-name-search-category-cart" selected="selected"><?php echo $text_menu_user; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-push-api-key"><?php echo $entry_push_api_key; ?></label>
						<div class="col-sm-10">
							<input type="text" name="android_store_push_api_key" value="<?php echo $android_store_push_api_key; ?>" placeholder="<?php echo $entry_push_api_key; ?>" id="input-push-api-key" class="form-control" />
						</div>
					</div>

				    <fieldset>
						<legend class="small text-center"><?php echo $legend_product; ?></legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-catalog-limit"><span data-toggle="tooltip" title="<?php echo $help_catalog_limit; ?>"><?php echo $entry_catalog_limit; ?></span></label>
								<div class="col-sm-10">
								<input type="text" name="android_store_catalog_limit" value="<?php echo $android_store_catalog_limit; ?>" placeholder="<?php echo $entry_catalog_limit; ?>" id="input-catalog-limit" class="form-control" />
								<?php if ($error_catalog_limit) { ?>
								<div class="text-danger"><?php echo $error_catalog_limit; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-description-length"><span data-toggle="tooltip" title="<?php echo $help_description_length; ?>"><?php echo $entry_description_length; ?></span></label>
							<div class="col-sm-10">
								<input type="text" name="android_store_description_length" value="<?php echo $android_store_description_length; ?>" placeholder="<?php echo $entry_description_length; ?>" id="input-description-length" class="form-control" />
								<?php if ($error_description_length) { ?>
								<div class="text-danger"><?php echo $error_description_length; ?></div>
								<?php } ?>
							</div>
						</div>
				    </fieldset>					
				</div>			
				
				<div class="tab-pane" id="tab-image">
					<div class="tab-content">
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-thumb-width"><?php echo $entry_image_thumb; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_thumb_width" value="<?php echo $android_store_image_thumb_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-thumb-width" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_thumb_height" value="<?php echo $android_store_image_thumb_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_thumb) { ?>
							  <div class="text-danger"><?php echo $error_image_thumb; ?></div>
							  <?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-popup-width"><?php echo $entry_image_popup; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_popup_width" value="<?php echo $android_store_image_popup_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-popup-width" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_popup_height" value="<?php echo $android_store_image_popup_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_popup) { ?>
							  <div class="text-danger"><?php echo $error_image_popup; ?></div>
							  <?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-product-width"><?php echo $entry_image_product; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_product_width" value="<?php echo $android_store_image_product_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-product-width" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_product_height" value="<?php echo $android_store_image_product_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_product) { ?>
							  <div class="text-danger"><?php echo $error_image_product; ?></div>
							  <?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-related"><?php echo $entry_image_related; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_related_width" value="<?php echo $android_store_image_related_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-related" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_related_height" value="<?php echo $android_store_image_related_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_related) { ?>
							  <div class="text-danger"><?php echo $error_image_related; ?></div>
							  <?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-cart"><?php echo $entry_image_cart; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_cart_width" value="<?php echo $android_store_image_cart_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-cart" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_cart_height" value="<?php echo $android_store_image_cart_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_cart) { ?>
							  <div class="text-danger"><?php echo $error_image_cart; ?></div>
							  <?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-location"><?php echo $entry_image_location; ?></label>
							<div class="col-sm-10">
							  <div class="row">
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_location_width" value="<?php echo $android_store_image_location_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-location" class="form-control" />
								</div>
								<div class="col-sm-6">
								  <input type="text" name="android_store_image_location_height" value="<?php echo $android_store_image_location_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
								</div>
							  </div>
							  <?php if ($error_image_location) { ?>
							  <div class="text-danger"><?php echo $error_image_location; ?></div>
							  <?php } ?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab-splash-screen">
					<div class="tab-content">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-splash-status"><?php echo $entry_status; ?></label>
							<div class="col-sm-10">
								<select name="android_store_splash_status" id="input-splash-status" class="form-control">
									<?php if ($android_store_splash_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="form-group no-splash">
							<label class="col-sm-2 control-label" for="input-logo"><?php echo $entry_splash_logo; ?></label>
							<div class="col-sm-10"><a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $splash_logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_logo; ?>" class="img-responsive" /></a>
							  <input type="hidden" name="android_store_splash_logo" value="<?php echo $android_store_splash_logo; ?>" id="input-logo" />
							</div>
						</div>
						<div class="form-group no-splash">
							<label class="col-sm-2 control-label" for="input-splash-background"><?php echo $entry_background_color; ?></label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="android_store_splash_background_color" value="<?php echo $android_store_splash_background_color; ?>" placeholder="<?php echo $entry_background_color; ?>" id="input-splash-background" class="form-control choose-color" />
									<span class="input-group-addon"></span>
								</div>	
							</div>
						</div>						
					</div>
				</div>	

				<div class="tab-pane" id="tab-promote-application">
					<div class="tab-content">
						<div class="alert alert-info"><i class="fa fa-fw fa-info-circle"></i> <?php echo $text_promote_info; ?></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-promote-status"><?php echo $entry_status; ?></label>
							<div class="col-sm-10">
								<select name="android_store_promote_status" id="input-promote-status" class="form-control">
									<?php if ($android_store_promote_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="form-group no-promote">
							<label class="col-sm-2 control-label" for="input-google-play-link"><?php echo $entry_google_play_link; ?></label>
							<div class="col-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-link"></i></span>
									<input type="text" name="android_store_google_play_link" value="<?php echo $android_store_google_play_link; ?>" placeholder="<?php echo $entry_google_play_link; ?>" id="input-google-play-link" class="form-control" />
								</div>	
								<?php if ($error_google_play_link) { ?>
									<div class="text-danger"><?php echo $error_google_play_link; ?></div>
								<?php } ?>
							</div>
						</div>
			
						<fieldset class="no-promote">
							<ul class="nav nav-tabs no-promote" id="languages">
								<?php foreach ($languages as $language) { ?>
								<li><a data-toggle="tab" href="#language-<?php echo $language['language_id']; ?>"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div id="language-<?php echo $language['language_id']; ?>" class="tab-pane">
									<div class="form-group required">
										<label class="col-sm-2 control-label" for="input-promote-message-<?php echo $language['language_id']; ?>"><?php echo $entry_promote_message; ?></span></label>
										<div class="col-sm-10">
											<input name="android_store_promote_message[<?php echo $language['language_id']; ?>][message]" placeholder="<?php echo $entry_promote_message; ?>" id="input-promote-message-<?php echo $language['language_id']; ?>" value="<?php echo isset($android_store_promote_message[$language['language_id']]) ? $android_store_promote_message[$language['language_id']]['message'] : ''; ?>" class="form-control" />
											<?php if (isset($error_promote_message[$language['language_id']])) { ?>
											<div class="text-danger"><?php echo $error_promote_message[$language['language_id']]; ?></div>
											<?php } ?>
										</div>
									</div>						
								</div>
								<?php } ?>
							</div>	
						</fieldset>	
						
						<fieldset class="no-promote">
							<legend class="small"><?php echo $text_promote_bar; ?></legend>
							<div class="form-group no-promote">
								<label class="col-sm-2 control-label" for="input-promote-background"><?php echo $entry_promote_background; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" name="android_store_promote_background" value="<?php echo $android_store_promote_background; ?>" placeholder="<?php echo $entry_promote_background; ?>" id="input-promote-background" class="form-control choose-color" />
										<span class="input-group-addon"></span>
									</div>	
								</div>
							</div>
							<div class="form-group no-promote">
								<label class="col-sm-2 control-label" for="input-promote-color"><?php echo $entry_promote_color; ?></label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" name="android_store_promote_color" value="<?php echo $android_store_promote_color; ?>" placeholder="<?php echo $entry_promote_color; ?>" id="input-promote-color" class="form-control choose-color" />
										<span class="input-group-addon"></span>
									</div>	
								</div>
							</div>
						</fieldset>							
						
					</div>
				</div>					
				
				<div class="tab-pane" id="tab-help">
					<div class="tab-content">
						Change Log and HELP Guide is available : <a href="http://www.oc-extensions.com/Android-Store-Opencart-2.x" target="blank">HERE</a><br /><br />
						If you need support email us at <strong>support@oc-extensions.com</strong> (Please first read help guide) 				
					</div>
				</div>
			</div>
		</form>	
    </div>
  </div>
<script type="text/javascript"><!--
initLivePreviewLayout();

$('.choose-color').colorpicker().on('changeColor', function(ev){
	colorLivePreview($(this), ev.color.toHex());
});

function colorLivePreview(object, color) {
	color = typeof(color) != 'undefined' ? color : object.val();
	
	// set input value => color hex
	object.val(color);
	
	// mark span with choosed color
	object.next().css('background-color', color);
}

function initLivePreviewLayout() {
	$('.choose-color').each(function() {
		colorLivePreview($(this));
	});
}

$('select[name=\'android_store_splash_status\']').on('change', function(){
	if ($(this).val() == 1) {
		$('.no-splash').show();
	} else {
		$('.no-splash').hide();
	}
});

$('select[name=\'android_store_splash_status\']').trigger('change');

$('select[name=\'android_store_promote_status\']').on('change', function(){
	if ($(this).val() == 1) {
		$('.no-promote').show();
	} else {
		$('.no-promote').hide();
	}
});

$('select[name=\'android_store_promote_status\']').trigger('change');

$('#languages li:first-child a').tab('show');
//--></script></div>
<?php echo $footer; ?>