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
      <div class="heading-title m-bottom-10"><span><?php echo $heading_title; ?></span></div>
      <?php if ($returns) { ?>
	  <div class="table-responsive">
		  <table class="table table-bordered table-hover">
			<thead>
			  <tr>
				<td class="text-right"><?php echo $column_return_id; ?></td>
				<td class="text-left"><?php echo $column_status; ?></td>
				<td class="text-left"><?php echo $column_date_added; ?></td>
				<td class="text-right"><?php echo $column_order_id; ?></td>
				<td class="text-left"><?php echo $column_customer; ?></td>
				<td></td>
			  </tr>
			</thead>
			<tbody>
			  <?php foreach ($returns as $return) { ?>
			  <tr>
				<td class="text-right">#<?php echo $return['return_id']; ?></td>
				<td class="text-left"><?php echo $return['status']; ?></td>
				<td class="text-left"><?php echo $return['date_added']; ?></td>
				<td class="text-right"><?php echo $return['order_id']; ?></td>
				<td class="text-left"><?php echo $return['name']; ?></td>
				<td class="text-right"><a href="<?php echo $return['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
			  </tr>
			  <?php } ?>
			</tbody>
		  </table>
	  </div>	  
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>