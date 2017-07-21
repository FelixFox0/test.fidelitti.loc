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
          <legend><?php echo $text_password; ?></legend>
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