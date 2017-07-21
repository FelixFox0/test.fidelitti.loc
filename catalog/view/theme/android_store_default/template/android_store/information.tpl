<?php echo $header; ?>
<div class="container top-extra-space bottom-extra-space">

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
						<a id="display-type" class="btn btn-link"><i class="fa"></i></a>
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
      <div class="multiple-fields-box"><?php echo $description; ?></div>
	  <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 