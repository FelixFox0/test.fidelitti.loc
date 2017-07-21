<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-latest" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-latest" class="form-horizontal">
	    <input type="hidden" name="name" value="<?php echo $text_edit; ?>">
		<input type="hidden" name="status" value="1">
		<div class="form-group">
			<div class="col-sm-4">
				<b><?php echo $text_categories;?></b><br>
				<p><?php echo $text_categories_desc;?></p>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_title;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[category_title]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['category_title'])) ? $seogenerator_module['category_title'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_description;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[category_description]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['category_description'])) ? $seogenerator_module['category_description'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_keywords;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[category_keywords]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['category_keywords'])) ? $seogenerator_module['category_keywords'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef;?></b>
					</div>
					<div class="col-sm-8">
						<select id="selector_category" name="seogenerator_module[sef_selector_category]" class="form-control">
							<option value="-" <?php if (isset($seogenerator_module['sef_selector_category']) && $seogenerator_module['sef_selector_category'] == '-') { ?>selected="selected"<?php } ?>><?php echo $text_dash; ?></option>
							<option value="_" <?php if (isset($seogenerator_module['sef_selector_category']) && $seogenerator_module['sef_selector_category'] == '_') { ?>selected="selected"<?php } ?>><?php echo $text_underscore; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_category_auto;?></b>
					</div>
					<div class="col-sm-8">
						<select name="seogenerator_module[sef_category_auto]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_category_auto']) && (int)$seogenerator_module['sef_category_auto'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_category_auto']) && (int)$seogenerator_module['sef_category_auto'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_category_update;?></b>
					</div>
					<div class="col-sm-8">
						<select id="update_category" name="seogenerator_module[sef_category_update]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_category_update']) && (int)$seogenerator_module['sef_category_update'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_category_update']) && (int)$seogenerator_module['sef_category_update'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<a href="javascript:void(0)" id="generateSEFCategory" class="btn btn-primary"><?php echo $button_sef_category; ?></a>
					</div>
				</div>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-sm-4">
				<b><?php echo $text_products;?></b><br>
				<p><?php echo $text_products_desc;?></p>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_title;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[product_title]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['product_title'])) ? $seogenerator_module['product_title'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_description;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[product_description]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['product_description'])) ? $seogenerator_module['product_description'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_keywords;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[product_keywords]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['product_keywords'])) ? $seogenerator_module['product_keywords'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef;?></b>
					</div>
					<div class="col-sm-8">
						<select id="selector_product" name="seogenerator_module[sef_selector_product]" class="form-control">
							<option value="-" <?php if (isset($seogenerator_module['sef_selector_product']) && $seogenerator_module['sef_selector_product'] == '-') { ?>selected="selected"<?php } ?>><?php echo $text_dash; ?></option>
							<option value="_" <?php if (isset($seogenerator_module['sef_selector_product']) && $seogenerator_module['sef_selector_product'] == '_') { ?>selected="selected"<?php } ?>><?php echo $text_underscore; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_product_auto;?></b>
					</div>
					<div class="col-sm-8">
						<select name="seogenerator_module[sef_product_auto]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_product_auto']) && (int)$seogenerator_module['sef_product_auto'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_product_auto']) && (int)$seogenerator_module['sef_product_auto'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_product_update;?></b>
					</div>
					<div class="col-sm-8">
						<select id="update_product" name="seogenerator_module[sef_product_update]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_product_update']) && (int)$seogenerator_module['sef_product_update'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_product_update']) && (int)$seogenerator_module['sef_product_update'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<a href="javascript:void(0)" id="generateSEFProduct" class="btn btn-primary"><?php echo $button_sef_product; ?></a>
					</div>
				</div>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-sm-4">
				<b><?php echo $text_manufacturers;?></b><br>
				<p><?php echo $text_manufacturers_desc;?></p>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_title;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[manufacturer_title]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['manufacturer_title'])) ? $seogenerator_module['manufacturer_title'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_description;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[manufacturer_description]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['manufacturer_description'])) ? $seogenerator_module['manufacturer_description'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_keywords;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[manufacturer_keywords]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['manufacturer_keywords'])) ? $seogenerator_module['manufacturer_keywords'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef;?></b>
					</div>
					<div class="col-sm-8">
						<select id="selector_manufacturer" name="seogenerator_module[sef_selector_manufacturer]" class="form-control">
							<option value="-" <?php if (isset($seogenerator_module['sef_selector_manufacturer']) && $seogenerator_module['sef_selector_manufacturer'] == '-') { ?>selected="selected"<?php } ?>><?php echo $text_dash; ?></option>
							<option value="_" <?php if (isset($seogenerator_module['sef_selector_manufacturer']) && $seogenerator_module['sef_selector_manufacturer'] == '_') { ?>selected="selected"<?php } ?>><?php echo $text_underscore; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_manufacturer_auto;?></b>
					</div>
					<div class="col-sm-8">
						<select name="seogenerator_module[sef_manufacturer_auto]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_manufacturer_auto']) && (int)$seogenerator_module['sef_manufacturer_auto'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_manufacturer_auto']) && (int)$seogenerator_module['sef_manufacturer_auto'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_manufacturer_update;?></b>
					</div>
					<div class="col-sm-8">
						<select id="update_manufacturer" name="seogenerator_module[sef_manufacturer_update]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_manufacturer_update']) && (int)$seogenerator_module['sef_manufacturer_update'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_manufacturer_update']) && (int)$seogenerator_module['sef_manufacturer_update'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<a href="javascript:void(0)" id="generateSEFManufacture" class="btn btn-primary"><?php echo $button_sef_manufacturer; ?></a>
					</div>
				</div>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-sm-4">
				<b><?php echo $text_informations;?></b><br>
				<p><?php echo $text_informations_desc;?></p>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_title;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[information_title]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['information_title'])) ? $seogenerator_module['information_title'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_description;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[information_description]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['information_description'])) ? $seogenerator_module['information_description'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_keywords;?></b>
					</div>
					<div class="col-sm-8">
						<textarea name="seogenerator_module[information_keywords]" style="height: 50px;" class="form-control"><?php echo (isset($seogenerator_module['information_keywords'])) ? $seogenerator_module['information_keywords'] : ''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef;?></b>
					</div>
					<div class="col-sm-8">
						<select id="selector_information" name="seogenerator_module[sef_selector_information]" class="form-control">
							<option value="-" <?php if (isset($seogenerator_module['sef_selector_information']) && $seogenerator_module['sef_selector_information'] == '-') { ?>selected="selected"<?php } ?>><?php echo $text_dash; ?></option>
							<option value="_" <?php if (isset($seogenerator_module['sef_selector_information']) && $seogenerator_module['sef_selector_information'] == '_') { ?>selected="selected"<?php } ?>><?php echo $text_underscore; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_information_auto;?></b>
					</div>
					<div class="col-sm-8">
						<select name="seogenerator_module[sef_information_auto]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_information_auto']) && (int)$seogenerator_module['sef_information_auto'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_information_auto']) && (int)$seogenerator_module['sef_information_auto'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<b><?php echo $text_sef_information_update;?></b>
					</div>
					<div class="col-sm-8">
						<select id="update_information" name="seogenerator_module[sef_information_update]" class="form-control">
							<option value="0" <?php if (isset($seogenerator_module['sef_information_update']) && (int)$seogenerator_module['sef_information_update'] == 0) { ?>selected="selected"<?php } ?>><?php echo $text_no; ?></option>
							<option value="1" <?php if (isset($seogenerator_module['sef_information_update']) && (int)$seogenerator_module['sef_information_update'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_yes; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<a href="javascript:void(0)" id="generateSEFInformation" class="btn btn-primary"><?php echo $button_sef_information; ?></a>
					</div>
				</div>
			</div>			
		</div>
	  </form>
	</div>
  </div>
</div>
<script type="text/javascript"><!--
$('#generateSEFCategory').click(function() {
	$('#loader').css('display', 'block');
	$selector = $('#selector_category').val();
	$update = $('#update_category').val();
	$.ajax({
		url: 'index.php?route=module/seogenerator/generateSEFCategory&token=<?php echo $token; ?>&selector='+$selector+'&update='+$update,
		dataType: 'json',
		success: function(json) {	
			$('#loader').css('display', 'none');
			if (json) {alert("<?php echo $text_generate_success; ?>");} else {alert("<?php echo $error_generate; ?>");}
		}
	});
});
$('#generateSEFProduct').click(function() {
	$('#loader').css('display', 'block');
	$selector = $('#selector_product').val();
	$update = $('#update_product').val();
	$.ajax({
		url: 'index.php?route=module/seogenerator/generateSEFProduct&token=<?php echo $token; ?>&selector='+$selector+'&update='+$update,
		dataType: 'json',
		success: function(json) {	
			$('#loader').css('display', 'none');
			if (json) {alert("<?php echo $text_generate_success; ?>");} else {alert("<?php echo $error_generate; ?>");}
		}
	});
});
$('#generateSEFManufacture').click(function() {
	$('#loader').css('display', 'block');
	$selector = $('#selector_manufacturer').val();
	$update = $('#update_manufacturer').val();
	$.ajax({
		url: 'index.php?route=module/seogenerator/generateSEFManufacturer&token=<?php echo $token; ?>&selector='+$selector+'&update='+$update,
		dataType: 'json',
		success: function(json) {	
			$('#loader').css('display', 'none');
			if (json) {alert("<?php echo $text_generate_success; ?>");} else {alert("<?php echo $error_generate; ?>");}
		}
	});
});
$('#generateSEFInformation').click(function() {
	$('#loader').css('display', 'block');
	$selector = $('#selector_information').val();
	$update = $('#update_information').val();
	$.ajax({
		url: 'index.php?route=module/seogenerator/generateSEFInformation&token=<?php echo $token; ?>&selector='+$selector+'&update='+$update,
		dataType: 'json',
		success: function(json) {	
			$('#loader').css('display', 'none');
			if (json) {alert("<?php echo $text_generate_success; ?>");} else {alert("<?php echo $error_generate; ?>");}
		}
	});
});
//--></script>
<div id="loader" style="display: none;top: 0; left: 0; width: 100%; height: 100%; position: fixed; background: rgba(255, 255, 255, 0.7); z-index: 100;"><div style="background: url(/admin/view/image/seogenerator_loading.gif); position: absolute; top: calc(50% - 33px); left: calc(50% - 33px); width: 66px; height: 66px; z-index: 101;"></div></div> 
<?php echo $footer; ?>