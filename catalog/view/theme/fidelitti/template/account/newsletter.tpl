<?php echo $header; ?>
<div class="breadcrumbs">
    <nav class="row">
        <ul class="large-3 medium-12 small-12 breadcrumbs__links">      
            <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
         <?php if($i+1<count($breadcrumbs)) { ?>
            <li>
                <!-- <a href="<?php echo $breadcrumb['href']; ?>"> -->
                    <?php echo $breadcrumb['text']; ?>
                <!-- </a> -->
            </li><?php } else { ?><li><?php echo $breadcrumb['text']; ?></li><?php } ?>
            <?php } ?>             
        </ul> 
    </nav>
</div>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="forgot-password"><?php echo $content_top; ?>
      <h3><?php echo $heading_title; ?></h3>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
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
        </fieldset>
        <div class="buttons clearfix">
          <div class="button_account">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary forgot-password_but button" />
          </div>
        </div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>