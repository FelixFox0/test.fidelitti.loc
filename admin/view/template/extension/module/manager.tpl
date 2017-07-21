<?php echo $header;?>
<?php $extension_id = str_replace('_', '-', $extension); ?>
<link rel="stylesheet" type="text/css" href="<?php echo (defined('JPATH_ADMINISTRATOR') ? 'admin/' : ''); ?>view/stylesheet/<?php echo $stylesheet; ?>.css" />


<?php echo $column_left; ?>

<div id="content" class="<?php echo $extension_id; ?>">

<!-- Generic OpenCart 2.3 template -->

	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-<?php echo $extension_id; ?>" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<button onclick="$('#apply').attr('value', '1'); $('#form-<?php echo $extension_id; ?>').submit();" form="form-<?php echo $extension_id; ?>" data-toggle="tooltip" title="<?php echo $button_apply; ?>" class="btn btn-success"><i class="fa fa-check"></i></button>
        		<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
    		</div>
      		<h1><?php echo $heading_title; ?></h1>
      		<ul class="breadcrumb">
        		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
        			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        		<?php } ?>
      		</ul>
    	</div>
  	</div>
	<div class="container-fluid">
		<?php if ($errors) { ?>
			<?php foreach ($errors as $error) { ?>
				<div class="alert alert-danger">
    				<i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      				<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php } ?>
		<?php } elseif ($success) { ?>
			<div class="alert alert-success">
				<i class="fa fa-check-circle"></i> <?php echo $success; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
				
			</div>
			<div class="panel-body">
        		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-<?php echo $extension_id; ?>" class="form-horizontal">
        			<input type="hidden" name="apply" id="apply" value="0">
		
      				<!-- Extension specific code -->
            					
          			<div class="form-group buttons">
		            	<label class="col-sm-2 control-label" for="input-buttons">
        		    		<?php if ($help_buttons) { ?>
            					<span data-toggle="tooltip" title="<?php echo $help_buttons; ?>">
            				<?php } ?>
            				<?php echo $entry_buttons; ?>
            				<?php if ($help_buttons) { ?>
		            			</span>
        		    		<?php } ?>
            			</label>
						<div class="col-sm-10">            					
              				<div class="well well-sm" style="height: 100px; overflow: auto;">
              					<?php foreach ($buttons as $button => $name) { ?>
                					<div class="checkbox item-name">
		              					<label>
        		           					<input type="checkbox" name="<?php echo $extension; ?>_buttons[]" id="input-buttons" class="form-control" value="<?php echo $button; ?>"<?php echo (in_array($button, ${$extension.'_buttons'}) ? ' checked="checked"' : ""); ?> /><?php echo $name; ?>
                		  				</label>
                					</div>
                				<?php } ?>
		                	</div>
        		        	<div class="checkbox-select">
								<a onclick="$(this).parent().parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all;?></a>
							</div>
						</div>
					</div>
					<div class="form-group columns">
		            	<label class="col-sm-2 control-label" for="input-columns">
        		    		<?php if ($help_columns) { ?>
            					<span data-toggle="tooltip" title="<?php echo $help_columns; ?>">
            				<?php } ?>
            				<?php echo $entry_columns; ?>
            				<?php if ($help_columns) { ?>
		            			</span>
        		    		<?php } ?>
            			</label>
						<div class="col-sm-10">            					
              				<div class="well well-sm" style="height: 100px; overflow: auto;">
              					<?php foreach ($columns as $column => $name) { ?>
                					<div class="checkbox item-name">
		              					<label>
        		           					<input type="checkbox" name="<?php echo $extension; ?>_columns[]" id="input-columns" class="form-control" value="<?php echo $column; ?>"<?php echo (in_array($column, ${$extension.'_columns'}) ? ' checked="checked"' : ""); ?> /><?php echo $name; ?>
                		  				</label>
                					</div>
                				<?php } ?>
		                	</div>
        		        	<div class="checkbox-select">
								<a onclick="$(this).parent().parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all;?></a>
							</div>
						</div>
					</div>
					<div class="form-group statuses">
		            	<label class="col-sm-2 control-label" for="input-statuses">
        		    		<?php if ($help_statuses) { ?>
            					<span data-toggle="tooltip" title="<?php echo $help_statuses; ?>">
            				<?php } ?>
            				<?php echo $entry_statuses; ?>
            				<?php if ($help_statuses) { ?>
		            			</span>
        		    		<?php } ?>
            			</label>
						<div class="col-sm-10">            					
              				<div class="well well-sm" style="height: 100px; overflow: auto;">
              					<?php foreach (${$extension.'_statuses'} as $key => $item) { ?>
                					<div class="checkbox item-name">
		              					<label>
        		           					<input type="checkbox" name="<?php echo $extension; ?>_statuses[<?php echo $key; ?>][checked]" id="input-statuses" value="1" class="form-control"<?php echo (isset($item['checked']) && $item['checked'] ? ' checked="checked"' : ""); ?> /><?php echo $item['name']; ?>
                		  				</label>
                					</div>
                					<div class="item-color">
                   						<input type="text" name="<?php echo $extension; ?>_statuses[<?php echo $key; ?>][color]" class="form-control" value="<?php echo $item['color']; ?>" placeholder="<?php echo $text_color; ?>"/>
                   					</div>  
                				<?php } ?>
		                	</div>
        		        	<div class="checkbox-select">
								<a onclick="$(this).parent().parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all;?></a>
							</div>
						</div>
					</div>
					<div class="form-group payments">
		            	<label class="col-sm-2 control-label" for="input-payments">
        		    		<?php if ($help_payments) { ?>
            					<span data-toggle="tooltip" title="<?php echo $help_payments; ?>">
            				<?php } ?>
            				<?php echo $entry_payments; ?>
            				<?php if ($help_payments) { ?>
		            			</span>
        		    		<?php } ?>
            			</label>
						<div class="col-sm-10">            					
              				<div class="well well-sm" style="height: 100px; overflow: auto;">
              					<?php foreach (${$extension.'_payments'} as $key => $item) { ?>
                					<div class="item-name">
                  						<?php echo $item['name']; ?>
                   					</div>
									<div class="item-color">
                   						<input type="text" name="<?php echo $extension; ?>_payments[<?php echo $key; ?>][color]" id="input-payments" class="form-control" value="<?php echo $item['color']; ?>" placeholder="<?php echo $text_color; ?>"/>
                   					</div>
                				<?php } ?>
		                	</div>
						</div>
					</div>
					<div class="form-group shippings">
		            	<label class="col-sm-2 control-label" for="input-shippings">
        		    		<?php if ($help_shippings) { ?>
            					<span data-toggle="tooltip" title="<?php echo $help_shippings; ?>">
            				<?php } ?>
            				<?php echo $entry_shippings; ?>
            				<?php if ($help_shippings) { ?>
		            			</span>
        		    		<?php } ?>
            			</label>
						<div class="col-sm-10">            					
              				<div class="well well-sm" style="height: 100px; overflow: auto;">
              					<?php foreach (${$extension.'_shippings'} as $key => $item) { ?>
                					<div class="item-name">
                  						<?php echo $item['name']; ?>
                   					</div>
									<div class="item-color">
                   						<input type="text" name="<?php echo $extension; ?>_shippings[<?php echo $key; ?>][color]" id="input-shippings" class="form-control" value="<?php echo $item['color']; ?>" placeholder="<?php echo $text_color; ?>"/>
                   					</div>
                				<?php } ?>
		                	</div>
						</div>
					</div>
						
      				<!-- Generic code -->
      			
        			<?php foreach ($options as $key => $type) { ?>
        				<?php $key_id = str_replace('_', '-', $key); ?>
        				<?php if ($type == 'title') { ?>
	          	  			<h2><?php echo ${$extension.'_'.$key}; ?></h2>
						<?php } elseif ($type == 'hidden') { ?>
            				<input type="hidden" name="<?php echo $extension.'_'.$key; ?>" value="<?php echo ${$extension.'_'.$key}; ?>" />
	          	  		<?php } else { ?>
          					<div class="form-group <?php echo $extension_id.'-'.$key_id; ?>">
            					<label class="col-sm-2 control-label" for="input-<?php echo $key_id; ?>">
            						<?php if (${'help_'.$key}) { ?>
            							<span data-toggle="tooltip" title="<?php echo ${'help_'.$key}; ?>">
            						<?php } ?>
            						<?php echo ${'entry_'.$key}; ?>
            						<?php if (${'help_'.$key}) { ?>
            							</span>
            						<?php } ?>
            					</label>
								<div class="col-sm-10">
									<?php if ($type == 'text') { ?>
										<span id="input-<?php echo $key_id; ?>" class="input-text">
											<?php echo ${$extension.'_'.$key}; ?>
										</span>
									<?php } elseif ($type == 'date') { ?>
										<div class="input-group date">
											<input type="text" name="<?php echo $extension.'_'.$key; ?>" value="<?php echo ${$extension.'_'.$key}; ?>" placeholder="<?php echo ${'entry_'.$key}; ?>" id="input-<?php echo $key_id; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
											<span class="input-group-btn">
                          						<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                          					</span>
                        				</div>
            						<?php } elseif (($type == 'input') || ($type == 'multi-input')) { ?>
            							<?php if ($type == 'multi-input') { ?>
              								<?php foreach ($languages as $language) { ?>
              									<div class="input-group">
              										<span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                									<input type="text" name="<?php echo $extension.'_'.$key; ?>[<?php echo $language['language_id']; ?>]" value="<?php echo (isset(${$extension.'_'.$key}[$language['language_id']]) ? ${$extension.'_'.$key}[$language['language_id']] : ''); ?>" placeholder="<?php echo ${'entry_'.$key}; ?>" id="input-<?php echo $key_id; ?>" class="form-control" />
              									</div>
              									<?php if (isset($error_name[$language['language_id']])) { ?>
              										<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
              									<?php } ?>
              								<?php } ?>
              							<?php } else { ?>
            								<input type="text" name="<?php echo $extension.'_'.$key; ?>" value="<?php echo ${$extension.'_'.$key}; ?>" placeholder="<?php echo ${'entry_'.$key}; ?>" id="input-<?php echo $key_id; ?>" class="form-control" />
            							<?php } ?>
            						<?php } elseif ($type == 'textarea') { ?>
	          	  						<textarea name="<?php echo $extension; ?>_<?php echo $key; ?>" placeholder="<?php echo ${'entry_'.$key}; ?>" id="input-<?php echo $key_id; ?>" class="form-control"><?php echo ${$extension.'_'.$key}; ?></textarea>
            						<?php } elseif ($type == 'select') { ?>
              							<select name="<?php echo $extension.'_'.$key; ?>" id="input-<?php echo $key_id; ?>" class="form-control">
                							<?php foreach (${$key} as $item) { ?>
               									<option value="<?php echo $item[0]; ?>"<?php echo ($item[0] == ${$extension.'_'.$key} ? ' selected="selected"' : ''); ?>><?php echo $item[1]; ?></option>
                							<?php } ?>
              							</select>
              						<?php } elseif ($type == 'checkbox') { ?>
              							<div class="well well-sm" style="height: 100px; overflow: auto;">
              								<?php foreach (${$key} as $item) { ?>
                								<div class="checkbox">
                  									<label>
                   										<input type="checkbox" name="<?php echo $extension.'_'.$key; ?>[]" value="<?php echo $item[0]; ?>"<?php echo (in_array($item[0], ${$extension.'_'.$key}) ? ' checked="checked"' : ''); ?> /> <?php echo $item[1]; ?>
                  									</label>
                								</div>
                							<?php } ?>
                						</div>
                						<div class="checkbox-select">
											<a onclick="$(this).parent().parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all;?></a>
										</div>
              						<?php } elseif ($type == 'autocomplete') { ?>
                						<input type="text" name="autocomplete_<?php echo $key; ?>" value="" placeholder="<?php echo ${'entry_'.$key}; ?>" id="input-<?php echo $key_id; ?>" class="form-control" />
                  						<div id="<?php echo $extension_id.'-'.$key_id; ?>" class="well well-sm autocomplete" style="height: 150px; overflow: auto;">
                    						<?php foreach (${$key} as $item) { ?>
                    							<div id="<?php echo $extension_id.'-'.$key_id.'-'.$item[0]; ?>">
                    								<i class="fa fa-minus-circle"></i> <?php echo $item[1]; ?>
                      								<input type="hidden" name="<?php echo $extension.'_'.$key; ?>[]" value="<?php echo $item[0]; ?>" />
                    							</div>
                    						<?php } ?>
                  						</div>
                					<?php } elseif ($type == 'radio') { ?>
             							<label class="radio-inline">
                							<input type="radio" name="<?php echo $extension.'_'.$key; ?>" value="1"<?php echo (${$extension.'_'.$key} ? ' checked="checked"' : ''); ?> /><?php echo $text_yes; ?>
                						</label>
	                					<label class="radio-inline">
                							<input type="radio" name="<?php echo $extension.'_'.$key; ?>" value=""<?php echo (!${$extension.'_'.$key} ? ' checked="checked"' : ''); ?> /><?php echo $text_no; ?>
										</label>
              	  					<?php } ?>
								</div>
            				</div>
            			<?php } ?>
            		<?php } ?>
					
            	</form>
				<div class="copyright">Еще больше модулей и шаблонов для Opencart 2.x <a href="https://opencart2x.ru/">на нашем сайте</a>!</div>            		
          	</div>
      	</div>
    </div>

<!-- Generic OpenCart 2.0 template -->

</div>

<?php echo $footer; ?>