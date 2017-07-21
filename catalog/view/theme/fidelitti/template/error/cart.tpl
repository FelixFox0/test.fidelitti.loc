<?php echo $header; ?>
<div class="container">
<div class="breadcrumbs"></div>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="large-12 cart_not"><?php echo $content_top; ?>
      <div class="cart_not__title"><?php echo $heading_title; ?></div>
      <p class="cart-page-empty"><?php echo $text_error; ?></p>
      <div class="buttons clearfix">
        <div class="pull-right cart_not__button"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_gotoshopping; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
