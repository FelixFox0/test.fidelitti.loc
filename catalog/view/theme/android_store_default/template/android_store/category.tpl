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
		<?php if ($products) { ?>
		<nav id="bottom-extra" class="navbar navbar-fixed-bottom Fixed">
			<div class="container">
				<div class="row">
					<div class="hidden">
					  <div class="btn-group hidden-xs">
						<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
						<button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
					  </div>
					</div>

					<div class="col-xs-12">
						<div class="btn-group btn-group-justified" role="group">
							<div class="btn-group dropup" role="group" id="filters-trigger">
							  <a href="#slide-menu-filter" class="btn btn-link" id="button-show-filters">
								<i class="fa fa-fw fa-filter"></i> <?php echo $text_refine; ?> 
							  </a>
							</div>							
							<div class="btn-group dropup" role="group">
							  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<?php foreach ($sorts as $sort_methods) { ?>
								<?php if ($sort_methods['value'] == $sort . '-' . $order) { ?>
								<?php echo $sort_methods['text']; ?> 
								<?php } ?> 
								<?php } ?> 
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<?php foreach ($sorts as $sort_methods) { ?>
								<?php if ($sort_methods['value'] != $sort . '-' . $order) { ?>
								<li><a href="<?php echo $sort_methods['href']; ?>"><?php echo $sort_methods['text']; ?></a></li>
								<?php } ?>
								<?php } ?>
							  </ul>
							</div>
							<div class="btn-group dropup" role="group">
							  <button type="button" class="btn btn-link btn-link-no-right-border dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<?php foreach ($limits as $limit_show) { ?>
								<?php if ($limit_show['value'] == $limit) { ?>
								<i class="fa fa-fw fa-eye"></i> <?php echo $limit_show['text']; ?>
								<?php } ?> 
								<?php } ?> 
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<?php foreach ($limits as $limit_show) { ?>
								<?php if ($limit_show['value'] != $limit) { ?>
								<li><a href="<?php echo $limit_show['href']; ?>"><?php echo $limit_show['text']; ?></a></li>
								<?php } ?>
								<?php } ?>
							  </ul>
							</div>
						</div>	
					</div>
				</div>
			</div>	
		</nav>	
		<div class="row equal-height-columns">
			<div class="infinite-scroll-products-block">
				<?php foreach ($products as $product) { ?>
				<div class="product-layout product-list col-xs-12">
				  <div class="product-thumb">
					<div class="addtocart-progress addtocart-progress-<?php echo $product['product_id']; ?>"></div>
					<div class="image"><a href="<?php echo $product['href']; ?>"><img data-src="<?php echo $product['thumb']; ?>" src="" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazy" /></a></div>
					<div>
					  <div class="caption equal-height-column">
						<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
						<p><?php echo $product['description']; ?></p>
						<?php if ($product['price']) { ?>
						<p class="price">
						  <?php if (!$product['special']) { ?>
						  <?php echo $product['price']; ?>
						  <?php } else { ?>
						  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
						  <?php } ?>
						</p>
						<?php } ?>
					  </div>
					  <div class="button-group">
						<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span><?php echo $button_cart; ?></span></button>
					  </div>
					</div>
				  </div>
				</div>
				<?php } ?>
				<div><?php echo $infinite_scroll; ?></div>
			</div>
		</div>
      <?php } ?>
	  
      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
	  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
