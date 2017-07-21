<div>
	<div id="refine-filter-title">
		<div class="row">
			<div class="col-xs-12">
				<div class="pull-center"><?php echo $heading_title; ?></div>				
			</div>
		</div>	
	</div>
	
	<div class="panel-group" id="filters-list" role="tablist" aria-multiselectable="true">
	  <?php if ($sub_categories) { ?> 
	  <div class="panel panel-filters">
		<div class="panel-heading" role="tab" id="heading-subcategories">
		  <h4 class="panel-title">
			<a class="btn-block" role="button" data-toggle="collapse" data-parent="" href="#subcategories-collapse" aria-expanded="true" aria-controls="subcategories-collapse">
			  <?php echo $text_subcategories; ?>
			</a>
		  </h4>
		</div>
		<div id="subcategories-collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-subcategories">
		  <div class="panel-body">
			<?php foreach ($sub_categories as $category) { ?>
			<label class="checkbox">
			  <input name="subcategory[]" type="checkbox" value="" data-redirect="<?php echo $category['href']; ?>" />
			  <?php echo $category['name']; ?></label>
			<?php } ?> 
		  </div>
		</div>
	  </div>
	  <?php } ?>
	  
	  <?php foreach ($filter_groups as $filter_group) { ?>
	  <div class="panel panel-filters">
		<div class="panel-heading" role="tab" id="heading-filter-group<?php echo $filter_group['filter_group_id']; ?>">
		  <h4 class="panel-title">
			<a class="collapsed btn-block" role="button" data-toggle="collapse" data-parent="" href="#filter-group<?php echo $filter_group['filter_group_id']; ?>" aria-expanded="false" aria-controls="filter-group<?php echo $filter_group['filter_group_id']; ?>">
			  <?php echo $filter_group['name']; ?>
			</a>
		  </h4>
		</div>
		<div id="filter-group<?php echo $filter_group['filter_group_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-filter-group<?php echo $filter_group['filter_group_id']; ?>">
		  <div class="panel-body">
			<?php foreach ($filter_group['filter'] as $filter) { ?>
			<?php if (in_array($filter['filter_id'], $filter_category)) { ?>
			<label class="checkbox">
			  <input name="filter[]" type="checkbox" value="<?php echo $filter['filter_id']; ?>" checked="checked" />
			  <?php echo $filter['name']; ?></label>
			<?php } else { ?>
			<label class="checkbox">
			  <input name="filter[]" type="checkbox" value="<?php echo $filter['filter_id']; ?>" />
			  <?php echo $filter['name']; ?></label>
			<?php } ?>
			<?php } ?>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	</div>	
	
	
</div>
<script type="text/javascript"><!--
// by default filters trigger is hidden (at bottom of page) and is enabled if filters are available
$(document).ready(function(){
	$('#filters-trigger').addClass('active');
});

$('input[name^=\'filter\']').on('click', function() {
	filter = [];
	
	$('input[name^=\'filter\']:checked').each(function(element) {
		filter.push(this.value);
	});
	
	forceShowLoadingMask(); // for non links
	
	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});

$('input[name^=\'subcategory\']').on('click', function() {
	forceShowLoadingMask(); // for non links
	
	location = $(this).attr('data-redirect');
});
//--></script> 
