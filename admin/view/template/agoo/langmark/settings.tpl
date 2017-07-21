<table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">

	<tr>
	  <td><?php echo $language->get('entry_langmark_widget_status'); ?></td>
	  <td>
	  <div class="input-group"><select class="form-control" name="ascp_settings[langmark_widget_status]">
	      <?php if (isset($ascp_settings['langmark_widget_status']) && $ascp_settings['langmark_widget_status']) { ?>
	      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	      <option value="0"><?php echo $text_disabled; ?></option>
	      <?php } else { ?>
	      <option value="1"><?php echo $text_enabled; ?></option>
	      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	      <?php } ?>
	    </select></div></td>
	</tr>


	<tr>
	  <td></td>
	  <td>
		<div>
		<a href="<?php echo $url_langmark; ?>" class="markbutton"><div><img src="view/image/seocms/sc_menu_o.png"></div>
		<div style=""><?php echo $language->get('entry_url_langmark'); ?></div>
		</a>
		</div>

	   </td>
	</tr>

</table>
