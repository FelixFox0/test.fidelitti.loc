<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-push-notification" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-send"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-bullhorn"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
		<div class="alert alert-info"><i class="fa fa-fw fa-tablet"></i> <?php echo $text_device; ?> | <i class="fa fa-fw fa-key"></i> <?php echo $text_api_key; ?></div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-push-notification" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-title"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_title; ?>"><?php echo $entry_title; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="title" value="<?php echo $title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
              <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-short-description"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_short_description; ?>"><?php echo $entry_short_description; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="short_description" value="<?php echo $short_description; ?>" placeholder="<?php echo $entry_short_description; ?>" id="input-short-description" class="form-control" />
              <?php if ($error_short_description) { ?>
              <div class="text-danger"><?php echo $error_short_description; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-extended-description"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_extended_description; ?>"><?php echo $entry_extended_description; ?></span></label>
            <div class="col-sm-10">
              <textarea name="extended_description"  placeholder="<?php echo $entry_extended_description; ?>" id="input-extended-description" class="form-control summernote"><?php echo $extended_description; ?></textarea>
              <?php if ($error_extended_description) { ?>
              <div class="text-danger"><?php echo $error_extended_description; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-redirect-route"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_redirect; ?>"><?php echo $entry_redirect; ?></span></label>
            <div class="col-sm-10">
              <select name="redirect_route" id="input-redirect-route" class="form-control">
				<?php if ($redirect_route == 'product') { ?>
					<option value="home"><?php echo $text_home; ?></option>
					<option value="product" selected="selected"><?php echo $text_product; ?></option>
					<option value="category"><?php echo $text_category; ?></option>
				<?php } elseif ($redirect_route == 'category') { ?>
					<option value="home"><?php echo $text_home; ?></option>
					<option value="product"><?php echo $text_product; ?></option>
					<option value="category" selected="selected"><?php echo $text_category; ?></option>				
				<?php } else { ?>
					<option value="home" selected="selected"><?php echo $text_home; ?></option>
					<option value="product"><?php echo $text_product; ?></option>
					<option value="category"><?php echo $text_category; ?></option>					
				<?php } ?>
			  </select>	
            </div>
          </div>
		  <div class="form-group redirect-to" id="redirect-to-product">
			<label class="col-sm-2 control-label" for="input-choose-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="choose_product" value="" placeholder="<?php echo $entry_product; ?>" id="input-choose-product" class="form-control" />
			  <div id="selected-product" class="well well-sm" style="height: 50px; overflow: auto;">
				<?php if ($product_info) { ?>
				<div id="selected-product<?php echo $product_info['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_info['name']; ?>
				  <input type="hidden" name="selected_product" value="<?php echo $product_info['product_id']; ?>" />
				</div>
				<?php } ?>
			  </div>
			  <?php if ($error_product) { ?>
              <div class="text-danger"><?php echo $error_product; ?></div>
              <?php } ?>
			</div>
		  </div>
		  <div class="form-group redirect-to" id="redirect-to-category">
			<label class="col-sm-2 control-label" for="input-choose-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="choose_category" value="" placeholder="<?php echo $entry_category; ?>" id="input-choose-category" class="form-control" />
			  <div id="selected-category" class="well well-sm" style="height: 50px; overflow: auto;">
				<?php if ($category_info) { ?>
				<div id="selected-category<?php echo $category_info['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category_info['name']; ?>
				  <input type="hidden" name="selected_category" value="<?php echo $category_info['category_id']; ?>" />
				</div>
				<?php } ?>
			  </div>
			  <?php if ($error_category) { ?>
              <div class="text-danger"><?php echo $error_category; ?></div>
              <?php } ?>
			</div>
		  </div>		  
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript"><!--
$('select[name=\'redirect_route\']').on('change', function(){
	$('.redirect-to').hide();
	$('#redirect-to-' + $(this).val()).show();
});

$('select[name=\'redirect_route\']').trigger('change');

// Choose product
$('input[name=\'choose_product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'choose_product\']').val('');
		
		$('#selected-product').html('');  // select only one product
		
		$('#selected-product').append('<div id="selected-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="selected_product" value="' + item['value'] + '" /></div>');	
	}	
});

$('#selected-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Choose category
$('input[name=\'choose_category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'choose_category\']').val('');
		
		$('#selected-category').html('');  // select only one category
		
		$('#selected-category').append('<div id="selected-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="selected_category" value="' + item['value'] + '" /></div>');	
	}	
});

$('#selected-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//--></script> 
<?php echo $footer; ?>