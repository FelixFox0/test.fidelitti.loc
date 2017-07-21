<?php echo $header; ?>
<div class="container top-extra-space">

  <nav id="top-extra" class="navbar navbar-fixed-top Fixed">
    <div class="container">
      <div class="row">
        <div class="col-xs-2">
          <div class="pull-center">
            <a href="<?php echo $back; ?>" class="btn btn-link"><i class="fa fa-angle-left"></i></a>
          </div>  
        </div>    
        <div class="col-xs-8">
          <div class="pull-center">
            <a href="javascript:void(0);" class="btn btn-link page-title"><?php echo $heading_title; ?></a>
          </div>  
        </div>    
        <div class="col-xs-2">
          <div class="pull-center">
          </div>  
        </div>    
      </div>
    </div>
  </nav>

  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="heading-title m-bottom-10"><span><?php echo $text_address_book; ?></span></div>
      <?php if ($addresses) { ?>
	  <div class="table-responsive">
		  <table class="table table-bordered table-hover">
			<?php foreach ($addresses as $result) { ?>
			<tr>
			  <td class="text-left"><?php echo $result['address']; ?></td>
			  <td class="text-right"><a href="<?php echo $result['update']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a> &nbsp; <a href="<?php echo $result['delete']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>
			<?php } ?>
		  </table>
	  </div>	  
      <?php } else { ?>
      <div class="multiple-fields-box"><p><?php echo $text_empty; ?></p></div>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $add; ?>" class="btn btn-primary"><?php echo $button_new_address; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>