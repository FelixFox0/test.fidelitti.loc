<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="scp_grad" style="overflow: hidden;">
    <div style="float:left; margin-top: 10px;" >
    	<img src="view/image/blog-icon.png" style="height: 21px; margin-left: 10px; " >
    </div>

<div style="margin-left: 10px; float:left; margin-top: 10px;  color: #777;">
<ins style="color: #00A3D9; padding-top: 17px; text-shadow: 0 2px 1px #FFFFFF; padding-left: 3px;  font-weight: normal;  text-decoration: none; ">
<?php echo strip_tags($heading_title); ?>
</ins> ver.: <?php echo $langmark_version; ?>
</div>

    <div class="scp_grad_green" style=" height: 40px; float:right; ">
      <div style="color: #555;margin-top: 2px; line-height: 18px; margin-left: 9px; margin-right: 9px; overflow: hidden;"><?php echo $language->get('heading_dev'); ?></div>
    </div>

</div>

<script type="text/javascript">
function delayer(){
    window.location = 'index.php?route=catalog/langmark&token=<?php echo $token; ?>';
}
</script>

  <div class="page-header">
    <div class="container-fluid">

<?php
   	if (SC_VERSION < 20) {
?>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<?php
   	}
?>



<div id="content1" style="border: none;">

<div style="clear: both; line-height: 1px; font-size: 1px;"></div>


<?php if ($error_warning) { ?>
    <div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>

<?php if ($success) { ?>
    <div class="alert alert-success success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>


<div id="content" style="border: none;">

<div style="clear: both; line-height: 1px; font-size: 1px;"></div>


<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<?php if (isset($this->session->data['success'])) {unset($this->session->data['success']);
?>
<div class="success"><?php echo $language->get('text_success'); ?></div>
<?php } ?>


<div class="box1">

<div class="content">

<?php echo $agoo_menu; ?>


<div style="margin:5px; float:right;">
   <a href="#" class="mbutton langmark_save"><?php echo $button_save; ?></a>
   <a onclick="location = '<?php echo $cancel; ?>';" class="mbutton"><?php echo $button_cancel; ?></a>
</div>

<div style="clear: both; line-height: 1px; font-size: 1px;"></div>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">


 <div id="tabs" class="htabs"><a href="#tab-options"><?php echo $language->get('tab_options'); ?></a>
 <a href="#tab-pagination"><?php echo $language->get('tab_pagination'); ?></a>
 <a href="#tab-main"><?php echo $language->get('tab_main'); ?></a>
 <a href="#tab-ex"><?php echo $language->get('tab_ex'); ?></a>
 <a href="#tab-other"><?php echo $language->get('tab_other'); ?></a>
 <a href="#tab-install"> <?php echo $language->get('entry_install_update'); ?></a>

 <!-- <a href="#tab-about"><?php echo $language->get('entry_about'); ?></a> -->

 </div>
<!--
<div id="tab-about">

<?php
// echo $language->get('text_about');
?>

</div>
-->

  <div id="tab-options">

   <table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">

          <!--
          <tr>
              <td><?php echo $language->get('entry_cache_widgets'); ?></td>
              <td><div class="input-group"><select class="form-control" name="asc_langmark[cache_widgets]">
                  <?php if (isset($asc_langmark['cache_widgets']) && $asc_langmark['cache_widgets']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div></td>
            </tr>
            -->


	 <?php
	 foreach ($languages as $lang) { ?>
	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">
         <?php echo $lang['name']; ?> <img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" >
         <?php
           if ($lang['language_id'] == $config_language_id) echo "<br>".$language->get('entry_lang_default');
         ?>


		</td>
		<td></td>
	  </tr>

	<tr>

		<td><?php echo $language->get('tab_options'); ?></td>
		<td>
				<div style="clear: both; margin-top:5px;">
				<div>
				<?php echo $language->get('entry_prefix'); ?>
				</div>

							<div class="input-group">
							<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?>&nbsp;&nbsp;<img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>
								<input type="text" class="form-control" name="asc_langmark[prefix][<?php echo $lang['code']; ?>]" value="<?php if (isset($asc_langmark['prefix'][$lang['code']])) { echo $asc_langmark['prefix'][$lang['code']]; } else { echo ''; } ?>">
  							</div>


				<div style="clear: both; margin-top:10px;">
				<div>
				<?php echo $language->get('entry_hreflang'); ?>
				</div>


							<div class="input-group">
							<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?>&nbsp;&nbsp;<img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>
								<input type="text" class="form-control" name="asc_langmark[hreflang][<?php echo $lang['code']; ?>]" value="<?php if (isset($asc_langmark['hreflang'][$lang['code']])) { echo $asc_langmark['hreflang'][$lang['code']]; } else { echo ''; } ?>">
 							</div>


				</div>

				</div>


				 <?php if (isset($currencies) && is_array($currencies) && !empty($currencies)) { ?>
                 <div style="clear: both; margin-top:10px;">
                 <?php echo $language->get('entry_currencies'); ?>
                 </div>

	               <div class="input-group"><select class="form-control" name="asc_langmark[currency][<?php echo $lang['code']; ?>]">
	                 <option value=""></option>
	                 <?php foreach ($currencies as $num => $currency) { ?>
	                   <option value="<?php echo $currency['code']; ?>" <?php if (isset($asc_langmark['currency'][$lang['code']]) && $asc_langmark['currency'][$lang['code']] == $currency['code']) { ?> selected="selected" <?php } ?>><?php echo $currency['title']; ?></option>
	                  <?php } ?>
	                 </select></div>
                 <?php } ?>



		</td>

	</tr>



   <?php } ?>

	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">&nbsp;
		</td>
		<td></td>


	  </tr>


          <tr>
              <td><?php echo $language->get('entry_hreflang_status'); ?></td>
              <td>
              <div class="input-group"><select class="form-control" name="asc_langmark[hreflang_status]">
                  <?php if (isset($asc_langmark['hreflang_status']) && $asc_langmark['hreflang_status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div>
                </td>
            </tr>



          <tr>
              <td><?php echo $language->get('entry_jazz'); ?></td>
              <td><div class="input-group"><select class="form-control" name="asc_langmark[jazz]">
                  <?php if (isset($asc_langmark['jazz']) && $asc_langmark['jazz']) { ?>
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
     <td></td>
    </tr>
   </table>
  </div>

  <div id="tab-pagination">

   <table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">

          <tr>
              <td><?php echo $language->get('entry_pagination'); ?></td>
              <td><div class="input-group"><select class="form-control" name="asc_langmark[pagination]">
                  <?php if (isset($asc_langmark['pagination']) && $asc_langmark['pagination']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div></td>
            </tr>
          <tr>
              <td><?php echo $language->get('entry_remove_description_status'); ?></td>
              <td><div class="input-group"><select class="form-control" name="asc_langmark[description_status]">
                  <?php if (isset($asc_langmark['description_status']) && $asc_langmark['description_status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div></td>
            </tr>

          <tr>
              <td><?php echo $language->get('entry_url_close_slash'); ?></td>
              <td><div class="input-group">
              <select class="form-control" name="asc_langmark[url_close_slash]">
                  <?php if (isset($asc_langmark['url_close_slash']) && $asc_langmark['url_close_slash']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div></td>
            </tr>

    <tr>
     <td class="left"><?php echo $language->get('entry_pagination_prefix'); ?></td>
     <td class="left">
     <div class="input-group">
     <span class="input-group-addon"></span>

      <input type="text" class="form-control" name="asc_langmark[pagination_prefix]" value="<?php  if (isset($asc_langmark['pagination_prefix'])) echo $asc_langmark['pagination_prefix']; ?>" size="20" />
     </div>
     </td>
    </tr>

          <!--
          <tr>
              <td><?php echo $language->get('entry_cache_widgets'); ?></td>
              <td><div class="input-group"><select class="form-control" name="asc_langmark[cache_widgets]">
                  <?php if (isset($asc_langmark['cache_widgets']) && $asc_langmark['cache_widgets']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div></td>
            </tr>
            -->


	 <?php foreach ($languages as $lang) { ?>
	<tr>
		<td class="left">
			<?php echo $language->get('entry_title_pagination'); ?> (<?php echo $lang['name']; ?>)
		</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?>&nbsp;&nbsp;<img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>

				<input type="text" class="form-control" name="asc_langmark[pagination_title][<?php echo $lang['code']; ?>]" value="<?php if (isset($asc_langmark['pagination_title'][$lang['code']])) { echo $asc_langmark['pagination_title'][$lang['code']]; } else { echo ''; } ?>">
				</div>
			</td>

	</tr>
   <?php } ?>


<?php if (SC_VERSION > 15) { ?>

	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">
         &nbsp;
		</td>
		<td></td>


	  </tr>




					<tr>
						<td class="left">
							<?php echo $language->get('entry_desc_types'); ?>
						</td>
							<td>
								<div style="float: left;">

				   <table id="desc_types" class="list">
					   <thead>
				             <tr>
				                <td class="left"><?php echo $language->get('entry_id'); ?></td>
				                <td><?php echo $language->get('entry_title_template'); ?></td>
				                <td></td>
				             </tr>

				      </thead>

				      <?php if (isset($asc_langmark['desc_type']) && !empty($asc_langmark['desc_type'])) { ?>
				      <?php foreach ($asc_langmark['desc_type'] as $desc_type_id => $desc_type) { ?>
				      <?php $desc_type_row = $desc_type_id; ?>
				      <tbody id="desc_type_row<?php echo $desc_type_row; ?>">
				          <tr>
				               <td class="left">
								<input type="text" name="asc_langmark[desc_type][<?php echo $desc_type_id; ?>][type_id]" value="<?php if (isset($desc_type['type_id'])) echo $desc_type['type_id']; ?>" size="3">
				               </td>

								<td class="right">

									<div style="margin-bottom: 3px;">
									<input type="text" name="asc_langmark[desc_type][<?php echo $desc_type_id; ?>][title]" value="<?php if (isset($desc_type['title'])) echo $desc_type['title']; ?>" style="width: 300px;">
									</div>

								</td>

				                <td class="left"><a onclick="$('#desc_type_row<?php echo $desc_type_row; ?>').remove();" class="markbutton button_purple nohref"><?php echo $button_remove; ?></a></td>
				              </tr>
				            </tbody>

				            <?php } ?>
				            <?php } ?>
				            <tfoot>
				              <tr>
				                <td colspan="2"></td>
				                <td class="left"><a onclick="addDescType();" class="markbutton nohref"><?php echo $language->get('entry_add_rule'); ?></a></td>
				              </tr>
				            </tfoot>
				          </table>


								</div>
							</td>
					</tr>


<?php } ?>


    <tr>
     <td></td>
     <td></td>
    </tr>
   </table>
  </div>



  <div id="tab-main">

   <table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">


	 <?php foreach ($languages as $lang) { ?>

	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">
         <?php echo $lang['name']; ?> <img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" >
		</td>
		<td></td>
	  </tr>

          <tr>
              <td><?php echo $language->get('entry_prefix_home_default'); ?></td>
              <td>
              <div class="input-group">
              <select class="form-control" name="asc_langmark[prefix_home_default][<?php echo $lang['code']; ?>]">
                  <?php if (isset($asc_langmark['prefix_home_default'][$lang['code']]) && $asc_langmark['prefix_home_default'][$lang['code']]) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
                </div>
                </td>
            </tr>


	<tr>
		<td class="left">
			<?php echo $language->get('entry_main_title'); ?>
		</td>
			<td>
				<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?><br><img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>
					<textarea class="form-control" cols="50" rows="3" name="asc_langmark[main_title][<?php echo $lang['code']; ?>]"><?php if (isset($asc_langmark['main_title'][$lang['code']])) { echo $asc_langmark['main_title'][$lang['code']]; } else { echo ''; } ?></textarea>
				</div>
				</div>
			</td>
	</tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_main_description'); ?>
		</td>
			<td>
				<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?><br><img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>
					<textarea class="form-control" cols="50" rows="3" name="asc_langmark[main_description][<?php echo $lang['code']; ?>]"><?php if (isset($asc_langmark['main_description'][$lang['code']])) { echo $asc_langmark['main_description'][$lang['code']]; } else { echo ''; } ?></textarea>
				</div>
				</div>
			</td>
	</tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_main_keywords'); ?>
		</td>
			<td>
				<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"><?php echo strtoupper($lang['code']); ?><br><img src="<?php echo $lang['image']; ?>" title="<?php echo $lang['name']; ?>" ></span>
					<textarea class="form-control" cols="50" rows="3" name="asc_langmark[main_keywords][<?php echo $lang['code']; ?>]"><?php if (isset($asc_langmark['main_keywords'][$lang['code']])) { echo $asc_langmark['main_keywords'][$lang['code']]; } else { echo ''; } ?></textarea>
				</div>
				</div>
			</td>
	</tr>



   <?php } ?>





          <tr>
              <td><?php echo $language->get('entry_commonhome_status'); ?></td>
              <td>
              <div class="input-group"><select class="form-control" name="asc_langmark[commonhome_status]">
                  <?php if (isset($asc_langmark['commonhome_status']) && $asc_langmark['commonhome_status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></div>
                </td>
            </tr>

  <tr>
     <td></td>
     <td></td>
    </tr>
   </table>
  </div>

<div id="tab-other">
	<table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">
	          <tr>
	              <td><?php echo $language->get('entry_two_status'); ?></td>
	              <td>
	              <div class="input-group"><select class="form-control" name="asc_langmark[two_status]">
	                  <?php if (isset($asc_langmark['two_status']) && $asc_langmark['two_status']) { ?>
	                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	                  <option value="0"><?php echo $text_disabled; ?></option>
	                  <?php } else { ?>
	                  <option value="1"><?php echo $text_enabled; ?></option>
	                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	                  <?php } ?>
	                </select></div>
	                </td>
	            </tr>
	</table>
</div>

  <div id="tab-ex">

   <table class="mynotable" style="margin-bottom:20px; background: white; vertical-align: center;">

	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">
         <?php echo $language->get('entry_ex_multilang'); ?>
		</td>
		<td></td>
	  </tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_ex_multilang_route'); ?>
		</td>
		<td>
			<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"></span>
					<textarea class="form-control" cols="50" rows="3" name="asc_langmark[ex_multilang_route]"><?php if (isset($asc_langmark['ex_multilang_route'])) { echo $asc_langmark['ex_multilang_route']; } else { echo ''; } ?></textarea>
				</div>
			</div>
		</td>
	</tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_ex_multilang_uri'); ?>
		</td>
		<td>
			<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"></span>
				<textarea class="form-control" cols="50" rows="3" name="asc_langmark[ex_multilang_uri]"><?php if (isset($asc_langmark['ex_multilang_uri'])) { echo $asc_langmark['ex_multilang_uri']; } else { echo ''; } ?></textarea>
			</div>
			</div>
		</td>
	</tr>

	  <tr>
	 	<td colspan="3" style="text-align: center; background-color: #EEE;">
         <?php echo $language->get('entry_ex_url'); ?>
		</td>
		<td></td>
	  </tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_ex_url_route'); ?>
		</td>
		<td>
			<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"></span>
				<textarea class="form-control" cols="50" rows="3" name="asc_langmark[ex_url_route]"><?php if (isset($asc_langmark['ex_url_route'])) { echo $asc_langmark['ex_url_route']; } else { echo ''; } ?></textarea>
			</div>
			</div>
		</td>
	</tr>

	<tr>
		<td class="left">
			<?php echo $language->get('entry_ex_url_uri'); ?>
		</td>
		<td>
			<div style="float: left;">
				<div class="input-group">
				<span class="input-group-addon"></span>
				<textarea class="form-control" cols="50" rows="3" name="asc_langmark[ex_url_uri]"><?php if (isset($asc_langmark['ex_url_uri'])) { echo $asc_langmark['ex_url_uri']; } else { echo ''; } ?></textarea>
			</div>
			</div>
		</td>
	</tr>







 <tr>
     <td></td>
     <td></td>
    </tr>
   </table>
  </div>




<div id="tab-install">
 <div id="create_tables" style="color: green; font-weight: bold;"></div>
    <a href="#" onclick="
		$.ajax({
			url: '<?php echo $url_create; ?>',
			dataType: 'html',
			beforeSend: function()
				{
                     $('#create_tables').html('<?php echo $language->get('text_loading_small'); ?>');
				},

			success: function(json) {
				$('#create_tables').html(json);
				setTimeout('delayer()', 2000);
			},
			error: function(json) {
			$('#create_tables').html('error');
			}
		}); return false;" class="markbuttono" style=""><?php echo $url_create_text; ?></a>


   <a href="#" onclick="
		$.ajax({
			url: '<?php echo $url_delete; ?>',
			dataType: 'html',
			beforeSend: function()
					{
                     $('#create_tables').html('<?php echo $language->get('text_loading_small'); ?>');
					},
			success: function(json) {
				$('#create_tables').html(json);
				//setTimeout('delayer()', 2000);
			},
			error: function(json) {
			$('#create_tables').html('error');
			}
		}); return false;" class="mbuttonr" style=""><?php echo $url_delete_text; ?></a>


<?php if (isset($text_update) && $text_update!='' ) { ?>
<div style="font-size: 18px; color: red;"><?php echo $text_update; ?></div>
<?php } ?>

</div>


 </div>

 </form>
</div>

<?php if (SC_VERSION > 15) { ?>
<script type="text/javascript">

var array_desc_type_row = Array();
array_desc_type_row.push(0);
<?php
 foreach ($asc_langmark['desc_type'] as $indx => $desc_type) {
?>
array_desc_type_row.push(<?php echo $indx; ?>);
<?php
}
?>

var desc_type_row = <?php echo $desc_type_row + 1; ?>;

function addDescType() {

	var aindex = -1;
	for(i = 0; i < array_desc_type_row.length; i++) {
	 flg = jQuery.inArray(i, array_desc_type_row);
	 if (flg == -1) {
	  aindex = i;
	 }
	}
	if (aindex == -1) {
	  aindex = array_desc_type_row.length;
	}
	desc_type_row = aindex;
	array_desc_type_row.push(aindex);

    html  = '<tbody id="desc_type_row' + desc_type_row + '">';
	html += '  <tr>';
    html += '  <td class="left">';
	html += ' 	<input type="text" name="asc_langmark[desc_type]['+ desc_type_row +'][type_id]" value="'+ desc_type_row +'" size="3">';
    html += '  </td>';

 	html += '  <td class="right">';


	html += '	<div style="margin-bottom: 3px;">';
	html += '		<input type="text" name="asc_langmark[desc_type]['+ desc_type_row +'][title]" value="" style="width: 300px;">';
	html += '	</div>';


    html += '  </td>';
    html += '  <td class="left"><a onclick="$(\'#desc_type_row'+desc_type_row+'\').remove(); array_desc_type_row.remove(desc_type_row);" class="markbutton button_purple nohref"><?php echo $button_remove; ?></a></td>';




	html += '  </tr>';
	html += '</tbody>';

	$('#desc_types tfoot').before(html);

	desc_type_row++;
}
</script>
<?php } ?>


	<script type="text/javascript">

	 form_submit = function() {
		$('#form').submit();
		return false;
	}
	$('.langmark_save').bind('click', form_submit);
	</script>

<script type="text/javascript">
$('#tabs a').tabs();
</script>


<script type="text/javascript">

function odd_even() {
	var kz = 0;
	$('table tr').each(function(i,elem) {
	$(this).removeClass('odd');
	$(this).removeClass('even');
		if ($(this).is(':visible')) {
			kz++;
			if (kz % 2 == 0) {
				$(this).addClass('odd');
			}
		}
	});
}

$(document).ready(function(){
	odd_even();

	$('.htabs a').click(function() {
		odd_even();
	});

	$('.vtabs a').click(function() {
		odd_even();
	});

});

function input_select_change() {

	$('input').each(function(){
		if (!$(this).hasClass('no_change')) {
	        $(this).removeClass('sc_select_enable');
	        $(this).removeClass('sc_select_disable');

			if ( $(this).val() != '' ) {
				$(this).addClass('sc_select_enable');
			} else {
				$(this).addClass('sc_select_disable');
			}
		}
	});

	$('select').each(function(){
		if (!$(this).hasClass('no_change')) {
	        $(this).removeClass('sc_select_enable');
	        $(this).removeClass('sc_select_disable');

			this_val = $(this).find('option:selected').val()

			if (this_val == '1' ) {
				$(this).addClass('sc_select_enable');
			}

			if (this_val == '0' || this_val == '') {
				$(this).addClass('sc_select_disable');
			}

			if (this_val != '0' && this_val != '1' && this_val != '') {
				$(this).addClass('sc_select_other');
			}
		}
	});
}


$(document).ready(function(){
	$('.help').hide();

	input_select_change();

	$( "select" )
	  .change(function () {
		input_select_change();

	  });

	$( "input" )
	  .blur(function () {
		input_select_change();
	  });


});
</script>




</div>

</div>
<?php echo $footer; ?>
</div>