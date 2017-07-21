<?php if ($langmark!='' || $html!='') { ?>
<div id="cmswidget-<?php echo $cmswidget; ?>" class="cmswidget">
<?php echo($langmark); ?>
<?php echo($html); ?>
</div>

<?php if (isset($settings_widget['anchor']) && $settings_widget['anchor']!='') { ?>
<script>
	$('#cmswidget-<?php echo $cmswidget; ?>').hide();
	<?php if (isset($settings_widget['doc_ready']) && $settings_widget['doc_ready']) { ?>
	$(document).ready(function(){
	<?php  } ?>
		var prefix = '<?php echo $prefix;?>';
		var cmswidget = '<?php echo $cmswidget; ?>';
		var heading_title = '<?php echo $heading_title; ?>';
		var data = $('#cmswidget-<?php echo $cmswidget; ?>').html();
		<?php echo $settings_widget['anchor']; ?>;
		$('#cmswidget-<?php echo $cmswidget; ?>').show();
		delete data;
		delete prefix;
		delete cmswidget;
	<?php if (isset($settings_widget['doc_ready']) && $settings_widget['doc_ready']) { ?>
	});
	<?php  } ?>
</script>
<?php  } ?>
<?php  } ?>

