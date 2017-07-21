<div>
	<div id="special-offers">
		<div class="row">
			<div class="col-xs-6 col-border-right">
				<div class="pull-center">
					<div class="so-icon"><a href="<?php echo $special; ?>"><i class="fa fa-fw fa-barcode"></i></a></div>
					<div class="so-link"><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></div>
				</div>				
			</div>
			<div class="col-xs-6">
				<div class="pull-center">
					<div class="so-icon"><a href="<?php echo $gift_voucher; ?>"><i class="fa fa-fw fa-gift"></i></a></div>
					<div class="so-link"><a href="<?php echo $gift_voucher; ?>"><?php echo $text_gift_voucher; ?></a></div>
				</div>				
			</div>
		</div>	
	</div>
	
	<?php foreach ($categories as $category) { ?>
	<ul>
		<?php if ($category['children']) { ?>
			<li><a id="mmo-category-<?php echo $category['category_id']; ?>" href="#mmo-category-<?php echo $category['category_id']; ?>-submenu"><?php echo $category['name']; ?></a>
				<ul id="mmo-category-<?php echo $category['category_id']; ?>-submenu">
					<?php foreach ($category['children'] as $children) { ?>
					<li><a href="<?php echo $children['href']; ?>"><?php echo $children['name']; ?></a></li>
					<div class="menu-divider-category"></div>
					<?php } ?>
					<li><a href="<?php echo $category['href']; ?>"><?php echo $text_all; ?> <?php echo $category['name']; ?></a></li>
				</ul>
			</li>
		<?php } else { ?>
		<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
		<?php } ?>	
	</ul>
	<div class="menu-divider-category"></div>
	<?php } ?>	
</div>

<?php if ($menu_selected_parent_category_id) { ?>
<script type="text/javascript"><!--
	$(document).ready(function(){
		$('#mmo-category-<?php echo $menu_selected_parent_category_id; ?>').trigger('click');
	});
--></script>
<?php } ?>