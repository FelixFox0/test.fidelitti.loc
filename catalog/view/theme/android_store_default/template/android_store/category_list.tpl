<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	<?php if ($categories) { ?>
	<?php foreach($categories as $category) { ?>
	
	<?php } ?>
	<?php } ?>

	<?php if ($categories) { ?>
	<div id="category-list">
		<div class="panel list-group">
			<?php foreach($categories as $category) { ?>
			<?php if ($category['children']) { ?>
			<a href="javascript:void(0);" class="list-group-item has-hidden-children" data-toggle="collapse" data-target="#childrens-cat-<?php echo $category['category_id']; ?>" data-parent="#category-list"><?php echo $category['name']; ?><i class="fa fa-angle-down pull-right"></i></a>
			<div id="childrens-cat-<?php echo $category['category_id']; ?>" class="sublinks collapse">
				<?php foreach ($category['children'] as $children) { ?>
				<a href="<?php echo $children['href']; ?>" class="list-group-item subcategory"><?php echo $children['name']; ?></a>
				<?php } ?>
				<a href="<?php echo $category['href']; ?>" class="list-group-item subcategory"><?php echo $text_all; ?> <?php echo $category['name']; ?></a>
			</div>
			<?php } else { ?>
			<a href="<?php echo $category['href']; ?>" class="list-group-item has-hidden-children"><?php echo $category['name']; ?></a>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
	<?php } ?>	
	
	<?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 