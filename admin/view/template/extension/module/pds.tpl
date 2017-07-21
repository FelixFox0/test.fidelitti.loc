<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <div class="panel-body">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
			<fieldset>
				<legend><?php echo $text_general; ?></legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><?php echo $entry_allow_buying_series; ?></label>
				  <div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="pds_allow_buying_series" value="1" <?php echo $pds_allow_buying_series ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
					</label>
					<label class="radio-inline">
						<input type="radio" name="pds_allow_buying_series" value="0" <?php echo !$pds_allow_buying_series ? 'checked="checked"' : ''; ?>><?php echo $text_no;?>					
					</label>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_hide_from_list_view; ?>"><?php echo $entry_hide_from_list_view; ?></span></label>
				  <div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="pds_hide_from_list_view" value="items" <?php echo $pds_hide_from_list_view == 'items' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_items;?>
					</label><br/>
					<label class="radio-inline">
						<input type="radio" name="pds_hide_from_list_view" value="series" <?php echo $pds_hide_from_list_view == 'series' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_series;?>		
					</label><br/>
					<label class="radio-inline">
						<input type="radio" name="pds_hide_from_list_view" value="none" <?php echo $pds_hide_from_list_view == 'none' ? 'checked="checked"' : ''; ?>><?php echo $text_hide_none;?>
					</label>
				  </div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?php echo $text_category_page; ?></legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label">
					<span data-toggle="tooltip" title="<?php echo $text_show_thumbnails; ?>"><?php echo $entry_show_thumbnails; ?></span>
				  </label>
				  <div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="pds_show_thumbnails" value="1" <?php echo $pds_show_thumbnails ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
					</label>
					<label class="radio-inline">
						<input type="radio" name="pds_show_thumbnails" value="0" <?php echo !$pds_show_thumbnails? 'checked="checked"' : ''; ?>><?php echo $text_no;?>			
					</label>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><?php echo $entry_thumbnail_size; ?></label>
				  <div class="col-sm-10">
					<div class="row">
						<div class="col-sm-2">
							<input type="text" name="pds_list_thumbnail_width" value="<?php echo $pds_list_thumbnail_width; ?>" class="form-control" />
						</div>
						<div class="col-sm-2">
							<input type="text" name="pds_list_thumbnail_height" value="<?php echo $pds_list_thumbnail_height; ?>" class="form-control" />
						</div>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_thumbnail_hover_effect; ?>"><?php echo $entry_thumbnail_hover_effect; ?></span></label>
				  <div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="pds_thumbnail_hover_effect" value="rollover" <?php echo $pds_thumbnail_hover_effect == 'rollover' ? 'checked="checked"' : ''; ?>><?php echo $text_rollover;?>
					</label><br/>
					<label class="radio-inline">
						<input type="radio" name="pds_thumbnail_hover_effect" value="preview" <?php echo $pds_thumbnail_hover_effect == 'preview' ? 'checked="checked"' : ''; ?>><?php echo $text_preview;?>		
					</label><br/>
					<label class="radio-inline">
						<input type="radio" name="pds_thumbnail_hover_effect" value="none" <?php echo $pds_thumbnail_hover_effect == 'none' ? 'checked="checked"' : ''; ?>><?php echo $text_no_effect;?>
					</label>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">
					<span data-toggle="tooltip" title="<?php echo $text_list_preview_size; ?>"><?php echo $entry_preview_size; ?></span>
				  </label>
				  <div class="col-sm-10">
					<div class="row">
						<div class="col-sm-2">
							<input type="text" name="pds_list_preview_width" value="<?php echo $pds_list_preview_width; ?>" class="form-control" />
						</div>
						<div class="col-sm-2">
							<input type="text" name="pds_list_preview_height" value="<?php echo $pds_list_preview_height; ?>" class="form-control" />
						</div>
					</div>
				  </div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?php echo $text_product_page; ?></legend>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><?php echo $entry_thumbnail_size; ?></label>
				  <div class="col-sm-10">
					<div class="row">
						<div class="col-sm-2">
							<input type="text" name="pds_detail_thumbnail_width" value="<?php echo $pds_detail_thumbnail_width; ?>" class="form-control" />
						</div>
						<div class="col-sm-2">
							<input type="text" name="pds_detail_thumbnail_height" value="<?php echo $pds_detail_thumbnail_height; ?>" class="form-control" />
						</div>
					</div>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_enable_preview; ?>"><?php echo $entry_enable_preview; ?></span></label>
				  <div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" name="pds_enable_preview" value="1" <?php echo $pds_enable_preview ? 'checked="checked"' : ''; ?>><?php echo $text_yes;?>
					</label>
					<label class="radio-inline">
						<input type="radio" name="pds_enable_preview" value="0" <?php echo !$pds_enable_preview? 'checked="checked"' : ''; ?>><?php echo $text_no;?>			
					</label>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"><?php echo $entry_preview_size; ?></label>
				  <div class="col-sm-10">
					<div class="row">
						<div class="col-sm-2">
							<input type="text" name="pds_preview_width" value="<?php echo $pds_preview_width; ?>" class="form-control" />
						</div>
						<div class="col-sm-2">
							<input type="text" name="pds_preview_height" value="<?php echo $pds_preview_height; ?>" class="form-control" />
						</div>
					</div>
				  </div>
				</div>
			</fieldset>
	    </form>
	  </div>
	</div>
  </div>
</div>
<?php echo $footer; ?>