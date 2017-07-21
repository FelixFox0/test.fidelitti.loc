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
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <div class="heading-title no-border-bottom"><span><?php echo $text_password; ?></span></div>
            <div class="multiple-fields-box">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
                <div class="col-sm-10">
                  <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                  <?php if ($error_password) { ?>
                  <div class="text-danger"><?php echo $error_password; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                <div class="col-sm-10">
                  <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
                  <?php if ($error_confirm) { ?>
                  <div class="text-danger"><?php echo $error_confirm; ?></div>
                  <?php } ?>
                </div>
              </div>
            </div>  
        </fieldset>
        <div class="buttons clearfix">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-block btn-primary" />
        </div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 