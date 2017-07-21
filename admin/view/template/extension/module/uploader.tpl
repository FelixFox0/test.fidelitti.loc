<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-uploader" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-uploader" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_auto; ?></label>
            <div class="col-sm-10">
              <label class="radio-inline">
              	<?php if ($uploader_auto) { ?>
                <input type="radio" class="yes" name="uploader_auto" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" class="yes" name="uploader_auto" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$uploader_auto) { ?>
                <input type="radio" class="no" name="uploader_auto" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" class="no" name="uploader_auto" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
	          <div class="form-group hiden">
		          <label class="col-sm-2 control-label" for="input-textbutton"><?php echo $entry_textbutton; ?></label>
		            <div class="col-sm-10">
		              <input type="text" name="uploader_textbutton" value="<?php echo $uploader_textbutton; ?>" id="input-textbutton" class="form-control" />
		          	</div>
		          	<label class="col-sm-2 control-label"></label>
		          	<div class="col-sm-10">
		          		<i>ВНИМАНИЕ!!! Если Вы не укажите текст, то будет отображаться иконка</i>
		          	</div>
	          </div>
	          <div class="form-group hiden">
		          <label class="col-sm-2 control-label" for="input-textcolor"><?php echo $entry_textcolor; ?></label>
              	<div class="col-sm-10">
									<div class="input-group colorpicker-component colorpicker-element" id="cp1">
				            <input type="text" name="uploader_textcolor" value="<?php echo $uploader_textcolor;?>" id="input-textcolor" class="form-control" />
				            <span class="input-group-addon"><i></i></span>                    
			            </div>
			          </div>
	          </div>
          <div class="form-group">
		          <label class="col-sm-2 control-label" for="input-defaultcolorbutton"><?php echo $entry_defaultcolorbutton; ?></label>
              	<div class="col-sm-10">
	              <label class="radio-inline">
	              	<?php if ($uploader_defaultcolorbutton) { ?>
	                <input type="radio" class="color_yes" name="uploader_defaultcolorbutton" value="1" checked="checked" />
	                <?php echo $text_yes; ?>
	                <?php } else { ?>
	                <input type="radio" class="color_yes" name="uploader_defaultcolorbutton" value="1" />
	                <?php echo $text_yes; ?>
	                <?php } ?>
	              </label>
	              <label class="radio-inline">
	                <?php if (!$uploader_defaultcolorbutton) { ?>
	                <input type="radio" class="color_no" name="uploader_defaultcolorbutton" value="0" checked="checked" />
	                <?php echo $text_no; ?>
	                <?php } else { ?>
	                <input type="radio" class="color_no" name="uploader_defaultcolorbutton" value="0" />
	                <?php echo $text_no; ?>
	                <?php } ?>
	              </label>	              	
			          </div>
	          </div>
	          <div class="form-group defaultcolor">
	          	<label class="col-sm-2 control-label" for="input-choosedefaultcolorbutton"></label>
	          		<div class="col-sm-10 <?php echo $uploader_choosedefaultcolorbutton ?>">
	              		<label class="radio-inline">
	              			<input type="radio" class="btn default" name="uploader_choosedefaultcolorbutton" value="default">
	              			<a class="btn btn-default">Demo</a>
	              		</label>
	              		<label class="radio-inline">
	              			<input type="radio" class="btn success" name="uploader_choosedefaultcolorbutton" value="success">
	              			<a class="btn btn-success">Demo</a>
	              		</label>
	              		<label class="radio-inline">
	              			<input type="radio" class="btn danger" name="uploader_choosedefaultcolorbutton" value="danger">
	              			<a class="btn btn-danger">Demo</a>
	              		</label>
	              		<label class="radio-inline">
	              			<input type="radio" class="btn primary" name="uploader_choosedefaultcolorbutton" value="primary">
	              			<a class="btn btn-primary">Demo</a>
	              		</label>
	              		<label class="radio-inline">
	              			<input type="radio" class="btn info" name="uploader_choosedefaultcolorbutton" value="info">
	              			<a class="btn btn-info">Demo</a>
	              		</label>
	              		<label class="radio-inline">
	              			<input type="radio" class="btn warning" name="uploader_choosedefaultcolorbutton" value="warning">
	              			<a class="btn btn-warning">Demo</a>
	              		</label>
	              	</div>
              </div>
	          <div class="form-group customcolor">
		          <label class="col-sm-2 control-label" for="input-colorbutton"><?php echo $entry_colorbutton; ?></label>
              	<div class="col-sm-10">
									<div class="input-group colorpicker-component colorpicker-element" id="cp2">
				            <input type="text" name="uploader_colorbutton" value="<?php echo $uploader_colorbutton;?>" id="input-colorbutton" class="form-control" />
				            <span class="input-group-addon"><i></i></span>                    
			            </div>
			          </div>
	          </div>
	          <div class="form-group customcolor">
			        <label class="col-sm-2 control-label" for="input-colorbuttonhover"><?php echo $entry_colorbuttonhover; ?></label>
              <div class="col-sm-10">
								<div class="input-group colorpicker-component colorpicker-element" id="cp3">
				          <input type="text" name="uploader_colorbuttonhover" value="<?php echo $uploader_colorbuttonhover;?>" id="input-colorbuttonhover" class="form-control" />
				            <span class="input-group-addon"><i></i></span>                    
			          </div>
			        </div>
			      </div>
					<div class="form-group">
            <label class="col-sm-2 control-label" for="input-customclass"><?php echo $entry_customclass; ?></label>
            <div class="col-sm-10">
              <input type="text" name="uploader_customclass" id="input-customclass" class="form-control" value="<?php echo $uploader_customclass; ?>" />
              <div>
              	<i>Если Вы оставите поле пустым, будет использоваться только класс Bootstrap'a</i>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="uploader_status" id="input-status" class="form-control">
                <?php if ($uploader_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script>
	$('.hiden').css('display' , 'none');
	$('.no').click(function() {
		$('.hiden').fadeIn(600);
	});
	$('.yes').click(function() {
		$('.hiden').fadeOut(600);
	});

	$('.color_yes').click(function() {
		$('.defaultcolor').fadeIn(600);
		$('.customcolor').hide();
	});

	$('.color_no').click(function() {
		$('.defaultcolor').hide();
		$('.customcolor').fadeIn(600);
	});

	<?php if ($uploader_choosedefaultcolorbutton) { ?>
		$('.<?php echo $uploader_choosedefaultcolorbutton; ?>').find('.<?php echo $uploader_choosedefaultcolorbutton; ?>').attr('checked', 'checked');
	<?php } ?>

	if ($('input.color_no').is(':checked')) {
		$('.defaultcolor').css('display' , 'none');
	}

	if ($('input.color_yes').is(':checked')) {
		$('.customcolor').css('display', 'none');
	}

	if ($('input.no').is(':checked')) {
		$('.hiden').css('display' , 'block');
	}

	$(function() {
    $('#cp2, #cp3, #cp1').colorpicker();
  });
</script>