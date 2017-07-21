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
	
      <div class="heading-title no-border-bottom"><span><?php echo $entry_search; ?></span></div>
		<div class="search-filter">
		  <div class="row">
			<div class="col-sm-4">
			  <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
			</div>
			<div class="col-sm-3">
			  <select name="category_id" class="form-control">
				<option value="0"><?php echo $text_category; ?></option>
				<?php foreach ($categories as $category_1) { ?>
				<?php if ($category_1['category_id'] == $category_id) { ?>
				<option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
				<?php } ?>
				<?php foreach ($category_1['children'] as $category_2) { ?>
				<?php if ($category_2['category_id'] == $category_id) { ?>
				<option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
				<?php } ?>
				<?php foreach ($category_2['children'] as $category_3) { ?>
				<?php if ($category_3['category_id'] == $category_id) { ?>
				<option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
				<?php } ?>
				<?php } ?>
				<?php } ?>
				<?php } ?>
			  </select>
			</div>
			<div class="col-sm-3">
			  <label class="checkbox-inline">
				<?php if ($sub_category) { ?>
				<input type="checkbox" name="sub_category" value="1" checked="checked" />
				<?php } else { ?>
				<input type="checkbox" name="sub_category" value="1" />
				<?php } ?>
				<?php echo $text_sub_category; ?></label>
			</div>
		  </div>
		  <p>
			<label class="checkbox-inline">
			  <?php if ($description) { ?>
			  <input type="checkbox" name="description" value="1" id="description" checked="checked" />
			  <?php } else { ?>
			  <input type="checkbox" name="description" value="1" id="description" />
			  <?php } ?>
			  <?php echo $entry_description; ?></label>
		  </p>
		  <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
		</div>
		
	  <div class="heading-title m-bottom-10"><span><?php echo $text_search; ?></span></div>
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
			<?php } ?>
			<div><?php echo $infinite_scroll; ?></div>
		</div>	
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=android_store/search';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').prop('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
--></script> 
<?php echo $footer; ?> 