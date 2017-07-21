<nav id="top" class="navbar navbar-fixed-top Fixed">
  <div class="container">
	<div id="view-top-menu" class="row">
		<div class="col-xs-2">
			<div class="pull-center">
				<a href="#slide-menu-left" class="btn btn-link top-icon"><i class="fa fa-bars"></i></a>
			</div>	
		</div>		
		<div class="col-xs-4">
			<div class="pull-left">
				<a href="<?php echo $home; ?>" class="btn btn-link top-icon"><?php echo $name; ?></a>
			</div>	
		</div>		
		<div class="col-xs-2">
			<div class="pull-center">
				<a id="show-search-bar" class="btn btn-link top-icon"><i class="fa fa-search"></i></a>
			</div>	
		</div>
		
		<?php if ($menu_type == 'user-name-search-category-cart') { ?>	
		<div class="col-xs-2">
			<div class="pull-center">
				<a href="<?php echo $category_list; ?>" class="btn btn-link top-icon"><i class="fa fa-tags"></i></a>
			</div>	
		</div>	
		<?php } ?>		
		
		<div class="col-xs-2">
			<div class="pull-center">
				<a href="<?php echo $shopping_cart; ?>" class="btn btn-link top-icon">
					<i class="fa fa-shopping-cart"></i>
					<span id="cart-total"><?php echo $cart_total_items; ?></span>
				</a>
			</div>	
		</div>
		
		<?php if ($menu_type == 'category-name-search-cart-user') { ?>	
		<div class="col-xs-2">
			<div class="pull-center">
				<a href="#slide-menu-right" class="btn btn-link top-icon"><i class="fa fa-ellipsis-v"></i></a>
			</div>	
		</div>	
		<?php } ?>
		
	</div>
	<div id="view-search" class="row">
		<div class="col-xs-2">
			<div class="pull-center"><a id="close-view-search" class="btn btn-link"><i class="fa fa-arrow-left"></i></a></div>
		</div>
		<div class="col-xs-8">
			<div class="pull-center">
				<input id="search-term" class="form-control search-input" placeholder="<?php echo $text_looking_for; ?>" />
			</div>	
		</div>
		<div class="col-xs-2">
			<div class="pull-center"><a id="clear-search" class="btn btn-link"><i class="fa fa-times"></i></a></div>
		</div>
	</div>
  </div>
</nav>