<?php echo $header; ?>
<div class="container top-extra-space">
	<nav id="top-extra" class="navbar navbar-fixed-top Fixed">
		<div class="container">
			<div class="row">
				<div class="col-xs-2">
					<div class="pull-center">
						<a href="javascript:void(0);" class="btn btn-link history-back"><i class="fa fa-angle-left"></i></a>
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
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
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
      <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
			  <div class="multiple-fields-box extra-padding-15-25">
				  <div class="form-group">
					<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
				  </div>
				  <div class="form-group">
					<label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
					<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
					<a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
				  </div>
				  <input type="submit" value="<?php echo $button_login; ?>" class="btn btn-block btn-primary" />
				  <?php if ($redirect) { ?>
				  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
				  <?php } ?>
			  </div>	  
            </form>
			
			<div class="heading-title no-border-bottom"><span><?php echo $text_new_customer; ?> ?</span></div>
			<div class="multiple-fields-box extra-padding-15-25">
				<p><?php echo $text_register_account; ?></p>
				<a href="<?php echo $register; ?>" class="btn btn-block btn-link"><?php echo $text_register; ?></a>
			</div>
        </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>