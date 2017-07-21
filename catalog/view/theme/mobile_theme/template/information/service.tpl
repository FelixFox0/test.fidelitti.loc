<?php echo $header; ?>
<div class="breadcrumbs"></div>
<div class="row clientService">        
  <div class="large-12 columns clientService__title">
                
  </div>
  <div class="large-12 columns clientService__hr"><hr></div>
  <div class="large-3 columns clientService__left">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>            
  </div>
  <div id="content" class="large-9 columns clientService__right">
  eeeeeeeeee
    <?php echo $description; ?><?php echo $content_bottom; ?>
    <?php echo $column_right; ?>
  </div>
</div>    
<?php echo $footer; ?>