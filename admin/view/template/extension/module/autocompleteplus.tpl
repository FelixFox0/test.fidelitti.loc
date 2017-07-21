<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
		<span style="padding-right:20px;">
		<a href="https://opencartforum.com/index.php?app=core&module=search&do=user_activity&search_app=downloads&mid=688391" target="_blank" data-toggle="tooltip" title="Другие дополнения" class="btn btn-info"><i class="fa fa-download"></i> Другие дополнения</a></span>
        <button type="submit" form="form-latest" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>Autocomplete+ 1.03</h1>
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
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-4">
              <select name="autocompleteplus_status" id="input-status" class="form-control">
                <?php if ($autocompleteplus_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
			</div>
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
            <div class="col-sm-4">
              <input type="text" name="autocompleteplus_limit" value="<?php echo (isset($autocompleteplus_limit) ? $autocompleteplus_limit: '5') ; ?>" id="input-limit" class="form-control" />
            </div>
			</div>

          <fieldset>
          <legend><?php echo $text_search; ?></legend>
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-model"><?php echo $entry_model; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_model" id="input-model" class="form-control">
                <?php if ($autocompleteplus_model) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
			<label class="col-sm-2 control-label" for="input-location"><?php echo $entry_location; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_location" id="input-location" class="form-control">
                <?php if ($autocompleteplus_location) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
		  
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-sku"><?php echo $entry_sku; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_sku" id="input-sku" class="form-control">
                <?php if ($autocompleteplus_sku) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
			<label class="col-sm-2 control-label" for="input-upc"><?php echo $entry_upc; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_upc" id="input-upc" class="form-control">
                <?php if ($autocompleteplus_upc) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-ean"><?php echo $entry_ean; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_ean" id="input-ean" class="form-control">
                <?php if ($autocompleteplus_ean) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
			<label class="col-sm-2 control-label" for="input-jan"><?php echo $entry_jan; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_jan" id="input-jan" class="form-control">
                <?php if ($autocompleteplus_jan) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-isbn"><?php echo $entry_isbn; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_isbn" id="input-isbn" class="form-control">
                <?php if ($autocompleteplus_isbn) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
			<label class="col-sm-2 control-label" for="input-mpn"><?php echo $entry_mpn; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_mpn" id="input-mpn" class="form-control">
                <?php if ($autocompleteplus_mpn) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          </fieldset>

          <fieldset>
          <legend><?php echo $text_show; ?></legend>
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_image" id="input-show" class="form-control">
                <?php if ($autocompleteplus_image) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
			<label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
			<div class="col-sm-4">
              <select name="autocompleteplus_price" id="input-price" class="form-control">
                <?php if ($autocompleteplus_price) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
			<label class="col-sm-2 control-label" for="input-field"><?php echo $entry_field; ?></label>
			<div class="col-sm-4">
				 <select name="autocompleteplus_field" id="input-field" class="form-control">

                  <?php if ($autocompleteplus_field == 0) { ?>
                  <option value="0" selected="selected"> -- </option>
                  <?php } else { ?>
                  <option value="0"> -- </option>
                  <?php } ?>

                  <?php foreach ($fields as $field) { ?>
                  <?php if ($field == $autocompleteplus_field ) { ?>
                  <option value="<?php echo $field; ?>" selected="selected"><?php echo $field; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>	
            </div>
          </div>
          </fieldset>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>