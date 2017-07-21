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

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left"><?php echo $column_type; ?></td>
              <td class="text-left"><?php echo $column_digits; ?></td>
              <td class="text-right"><?php echo $column_expiry; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($cards) { ?>
            <?php foreach ($cards  as $card) { ?>
            <tr>
              <td class="text-left"><?php echo $card['type']; ?></td>
              <td class="text-left"><?php echo $card['digits']; ?></td>
              <td class="text-right"><?php echo $card['expiry']; ?></td>
			  <td class="text-right"><a href="<?php echo $delete . $card['card_id']; ?>" class="btn btn-danger"><?php echo $button_delete; ?></a></td>

            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" colspan="5"><?php echo $text_empty; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
	  <div class="buttons clearfix">
        <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
        <div class="pull-right"><a href="<?php echo $add; ?>" class="btn btn-primary"><?php echo $button_new_card; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
