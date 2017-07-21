<?php echo $header; ?>
<div class="container top-extra-space bottom-extra-space">

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
      <div class="heading-title no-border-bottom"><span><?php echo $heading_title; ?></span></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <div class="multiple-fields-box">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>
                <div class="col-sm-10">
                  <?php if ($newsletter) { ?>
                  <label class="radio-inline">
                    <input type="radio" name="newsletter" value="1" checked="checked" />
                    <?php echo $text_yes; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="newsletter" value="0" />
                    <?php echo $text_no; ?></label>
                  <?php } else { ?>
                  <label class="radio-inline">
                    <input type="radio" name="newsletter" value="1" />
                    <?php echo $text_yes; ?> </label>
                  <label class="radio-inline">
                    <input type="radio" name="newsletter" value="0" checked="checked" />
                    <?php echo $text_no; ?></label>
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