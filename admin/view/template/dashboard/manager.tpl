<link rel="stylesheet" type="text/css" href="<?php echo (defined('JPATH_ADMINISTRATOR') ? 'admin/' : ''); ?>view/stylesheet/<?php echo $extension; ?>.css" />
					
<div class="order-manager">
	<form action="" method="post" enctype="multipart/form-data" id="manager-form">
	<input type="hidden" name="page" value="home" />
	<div class="orders-header">
		<h2><i class="fa fa-list"></i><?php echo $text_title; ?></h2>
	
		<?php if ($notice) { ?>
			<div class="manager-notice">
				<div>
					<span><?php echo $notice; ?></span>
				</div>
			</div>
		<?php } ?>
				
		<div class="orders-buttons">
			<?php if (in_array('history', $buttons) && $history && $manager_orders) { ?>
				<span class="button-history disabled" title="<?php echo $button_history; ?>"><i class="fa white fa-bars"></i></span>
			<?php } ?>
					
			<?php if (in_array('invoice', $buttons) && $invoice && $manager_orders) { ?>
				<span class="button-invoice disabled" target="_blank" title="<?php echo $button_invoice; ?>"><i class="fa white fa-print"></i></span>
			<?php } ?>
					
			<?php if (in_array('shipping', $buttons) && $shipping && $manager_orders) { ?>
				<span class="button-shipping disabled" target="_blank" title="<?php echo $button_shipping; ?>"><i class="fa white fa-truck"></i></span>
			<?php } ?>
					
			<?php if (in_array('delete', $buttons) && $delete && $manager_orders) { ?>
				<span class="button-delete disabled" title="<?php echo $button_delete; ?>"><i class="fa red fa-trash"></i></span>
			<?php } ?>
					
			<?php if (in_array('create', $buttons) && $create) { ?>
				<a href="<?php echo $create; ?>" class="button-create" title="<?php echo $button_create; ?>"><i class="fa green fa-plus"></i></a>
			<?php } ?>

			<?php if (in_array('minimize', $buttons)) { ?>
				<a class="button-minimize" title="<?php echo $button_minimize; ?>"><i class="fa blue fa-minus"></i></a>
			<?php } ?>					
		</div>
	</div>
	<div class="orders-container">
   		<div class="orders-table">
    		<div class="table-header">

				<?php if (in_array('select', $columns) && $manager_orders) { ?>
					<div class="select center text-center">
						<input type="checkbox" name="toggle" />
					</div>
				<?php } ?>
					
				<?php if (in_array('order_id', $columns)) { ?>
					<div class="order-id center text-center sortable">
            			<a href="<?php echo $sort_order_id; ?>" title="<?php echo $text_sort; ?>">
            				<?php echo $column_order_id; ?><?php if ($sort == 'o.order_id') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
            			</a>
					</div>
				<?php } ?>
							
				<?php if (in_array('order_status_id', $columns)) { ?>
					<div class="order-status-id left text-left sortable">
              			<a href="<?php echo $sort_order_status_id; ?>" title="<?php echo $text_sort; ?>">
              				<?php echo $column_order_status_id; ?><?php if ($sort == 'o.order_status_id') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
              			</a>
					</div>
				<?php } ?>
            				
				<?php if (in_array('customer', $columns)) { ?>
           			<div class="customer left text-left sortable">
            			<a href="<?php echo $sort_customer; ?>" title="<?php echo $text_sort; ?>">
            				<?php echo $column_customer; ?><?php if ($sort == 'customer') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
            			</a>
            			<?php if (in_array('toggle', $buttons) && $manager_orders) { ?>
            				<span id="toggle-paymentaddress" class="toggle-all expand" title="<?php echo $button_toggle; ?>"><i class="fa green fa-arrow-circle-down"></i></span>
            			<?php } ?>
	           		</div>
    	    	<?php } ?>
            				            				
				<?php if (in_array('recipient', $columns)) { ?>
            		<div class="recipient left text-left sortable">
            			<a href="<?php echo $sort_recipient; ?>" title="<?php echo $text_sort; ?>">
            				<?php echo $column_recipient; ?><?php if ($sort == 'recipient') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
            			</a>
            			<?php if (in_array('toggle', $buttons) && $manager_orders) { ?>
             				<span id="toggle-shippingaddress" class="toggle-all expand" title="<?php echo $button_toggle; ?>"><i class="fa green fa-arrow-circle-down"></i></span>
             			<?php } ?>
            		</div>
				<?php } ?>
							
				<?php if (in_array('date_added', $columns)) { ?>
    	        	<div class="added center text-center sortable">
						<a href="<?php echo $sort_date_added; ?>" title="<?php echo $text_sort; ?>">
							<?php echo $column_date_added; ?><?php if ($sort == 'o.date_added') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
              			</a>
					</div>
				<?php } ?>
							
				<?php if (in_array('date_modified', $columns)) { ?>
        	    	<div class="date-modified center text-center sortable">
						<a href="<?php echo $sort_date_modified; ?>" title="<?php echo $text_sort; ?>">
							<?php echo $column_date_modified; ?><?php if ($sort == 'o.date_modified') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
						</a>
					</div>
				<?php } ?>
							
				<?php if (in_array('products', $columns)) { ?>
					<div class="products left text-left">
						<?php echo $column_products; ?>
						<?php if (in_array('toggle', $buttons) && $manager_orders) { ?>
							<span id="toggle-products" class="toggle-all expand" title="<?php echo $button_toggle; ?>"><i class="fa green fa-arrow-circle-down"></i></span>
						<?php } ?>
					</div>
				<?php } ?>
							
				<?php if (in_array('payment', $columns)) { ?>
					<div class="payment center text-center sortable">
              			<a href="<?php echo $sort_payment; ?>" title="<?php echo $text_sort; ?>">
              				<?php echo $column_payment; ?><?php if ($sort == 'o.payment_method') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
              			</a>
             		</div>
				<?php } ?>



				<div class="newAddress center text-center sortable">
          			<a href="<?php echo $sort_shipping; ?>" title="<?php echo $text_sort; ?>">
          				<?php echo "Адрес"; ?>              				
          			</a>
           		</div>

							
				<?php if (in_array('shipping', $columns)) { ?>
					<div class="shipping center text-center sortable">
              			<a href="<?php echo $sort_shipping; ?>" title="<?php echo $text_sort; ?>">
              				<?php echo $column_shipping; ?><?php if ($sort == 'o.shipping_method') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
              			</a>
               		</div>
				<?php } ?>
							
				<?php if (in_array('subtotal', $columns)) { ?>
					<div class="subtotal center text-center sortable">
             			<a href="<?php echo $sort_subtotal; ?>" title="<?php echo $text_sort; ?>">
             				<?php echo $column_subtotal; ?><?php if ($sort == 'subtotal') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
             			</a>
					</div>
				<?php } ?>
														
				<?php if (in_array('total', $columns)) { ?>
					<div class="total center text-center sortable">
             			<a href="<?php echo $sort_total; ?>" title="<?php echo $text_sort; ?>">
             				<?php echo $column_total; ?><?php if ($sort == 'o.total') { ?><i class="fa sort fa-<?php echo (strtolower($sort_order) == 'asc' ? 'angle-up' : 'angle-down'); ?>"></i><?php } ?>
             			</a>
					</div>
				<?php } ?>
							
				<?php if (in_array('actions', $columns) && (in_array('filter', $buttons) || in_array('clear', $buttons) || ($manager_orders && $manager_orders[0]['action']))) { ?>
					<div class="actions center text-center nowrap">
						<?php echo $column_actions; ?>
					</div>
				<?php } ?>
			</div>
			
			<?php if ($filters) { ?>
				<div class="order-filters">
					<?php if (in_array('select', $columns) && $manager_orders) { ?>
        	    		<div class="select center text-center">&nbsp;</div>
					<?php } ?>
              				
					<?php if (in_array('order_id', $columns)) { ?>
    	        		<div class="order-id center text-center">
        	      			<input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" class="center text-center" />
            	  		</div>
	            	<?php } ?>
              		
					<?php if (in_array('order_status_id', $columns)) { ?>
    	        		<div class="order-status-id left text-left">
            				<select name="filter_order_status_id">
              					<option value="*"><?php echo $text_any; ?></option>
                  				<?php foreach ($statuses as $key => $item) { ?>
                 					<option value="<?php echo $key; ?>"<?php echo (!is_null($filter_order_status_id) && ($key === (int)$filter_order_status_id) ? ' selected="selected"' : ''); ?>>
              							<?php echo $item['name']; ?>
	                  				</option>
    	              			<?php } ?>
        	        		</select>
            	    	</div>
					<?php } ?>
             				
					<?php if (in_array('customer', $columns)) { ?>
        	    		<div class="customer left text-left">
            	  			<input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" />
              			</div>
	            	<?php } ?>
              				              		
					<?php if (in_array('recipient', $columns)) { ?>
    	        		<div class="recipient left text-left">
        	      			<input type="text" name="filter_recipient" value="<?php echo $filter_recipient; ?>" />
            	  		</div>
					<?php } ?>
                	
					<?php if (in_array('date_added', $columns)) { ?>
        	      		<div class="date-added center text-center">
            	  			<input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" class="date center text-center" />
              			</div>
					<?php } ?>
              		
					<?php if (in_array('date_modified', $columns)) { ?>
        	      		<div class="date-modified center text-center">
            	  			<input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" class="date center text-center" />
              			</div>
					<?php } ?>
              		
					<?php if (in_array('products', $columns)) { ?>
        	      		<div class="products left text-left">
        	      			<input type="text" name="filter_products" value="<?php echo $filter_products; ?>" class="products left text-left" />
        	      		</div>
					<?php } ?>
              		
					<?php if (in_array('payment', $columns)) { ?>
						<div class="payment center text-center">
        	      			<select name="filter_payment">
            	    			<option value="*"><?php echo $text_any; ?></option>
                				<?php foreach ($payments as $key => $item) { ?>
                					<option value="<?php echo $item['name']; ?>"<?php echo ($item['name'] == $filter_payment ? ' selected="selected"' : ''); ?>><?php echo $item['name']; ?></option>
	                			<?php } ?>
    	            		</select>
        	        	</div>
					<?php } ?>

    	      		<div class="products left text-left">
    	      			<input type="text" disabled name="filter_products" value="<?php echo $filter_products; ?>" class="products left text-left" />
    	      		</div>
                	
					<?php if (in_array('shipping', $columns)) { ?>
						<div class="shipping center text-center">
        	      			<select name="filter_shipping">
            	    			<option value="*"><?php echo $text_any; ?></option>
                				<?php foreach ($shippings as $key => $item) { ?>
                					<option value="<?php echo $item['name']; ?>"<?php echo ($item['name'] == $filter_shipping ? ' selected="selected"' : ''); ?>><?php echo $item['name']; ?></option>
	                			<?php } ?>
    	            		</select>
        	        	</div>
					<?php } ?>
                	                	
					<?php if (in_array('subtotal', $columns)) { ?>
    	          		<div class="subtotal center text-center">
        	      			<input type="text" name="filter_subtotal" value="<?php echo $filter_subtotal; ?>" class="center text-center" />
            	  		</div>
					<?php } ?>
							
					<?php if (in_array('total', $columns)) { ?>
    	          		<div class="total center text-center">
        	      			<input type="text" name="filter_total" value="<?php echo $filter_total; ?>" class="center text-center" />
            	  		</div>
					<?php } ?>
              		
					<?php if (in_array('actions', $columns) && (in_array('filter', $buttons) || in_array('clear', $buttons) || ($manager_orders && $manager_orders[0]['action']))) { ?>
        	      		<div class="actions center text-center nowrap">
            	  			<?php if (in_array('filter', $buttons)) { ?>
              					<a class="filter-orders" title="<?php echo $button_filter; ?>"><i class="fa white fa-filter"></i></a>
              				<?php } ?>
              				
	              			<?php if (in_array('clear', $buttons)) { ?>
    	          				<a class="remove-filters" title="<?php echo $button_clear; ?>"><i class="fa red fa-remove"></i></a>
        	      			<?php } ?>
            	  		</div>
					<?php } ?>
				</div>
			<?php } ?>
				
			<?php if ($manager_orders) { ?>

           		<?php foreach ($manager_orders as $manager_order) { ?>
             		<div id="order-<?php echo $manager_order['order_id']; ?>" class="order-row">
						<?php if (in_array('select', $columns) && $manager_orders) { ?>
              				<div class="select center text-center">
                				<input type="checkbox" name="selected[]" value="<?php echo $manager_order['order_id']; ?>"<?php echo ($manager_order['selected'] ? ' checked="checked"' : ''); ?> />
                			</div>
                		<?php } ?>
                					
						<?php if (in_array('order_id', $columns)) { ?>
							<div class="order-id center text-center">
								<?php echo $manager_order['order_id']; ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('order_status_id', $columns)) { ?>
							<div class="order-status-id left text-left">
								<span class="status-text"<?php echo (!empty($statuses[$manager_order['order_status_id']]['color']) ? " style='color: ".$statuses[$manager_order['order_status_id']]['color']."'" : ""); ?>><?php echo ($manager_order['order_status_id'] != 0 ? $manager_order['status'] : $text_missing); ?></span>
								<?php if (in_array('history', $buttons)) { ?>
									<i class="fa white change-status fa-history" title="<?php echo $button_change; ?>"></i>
									<div class="manager-tooltip history-comment">
										<div class="container">
											<span><?php echo $text_add_info; ?></span>
											<i class="fa fa-times close" title="<?php echo $button_close; ?>"></i>
											<?php if ($rptracking_status) { ?>
												<input type="text" name="trackings[<?php echo $manager_order['order_id']; ?>]" placeholder="<?php echo $text_tracking; ?>" value="">
											<?php } ?>
											<textarea name="comments[<?php echo $manager_order['order_id']; ?>]" placeholder="<?php echo $text_comment; ?>"></textarea>
										</div>
										<div class="arrow" style="display: none;"></div>
										<i class="fa white comment-status fa-comment" title="<?php echo $button_comment; ?>" style="display: none;"></i>
									</div>
									<input type="hidden" name="statuses[<?php echo $manager_order['order_id']; ?>]" value="<?php echo $manager_order['order_status_id']; ?>">
								<?php } ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('customer', $columns)) { ?>
							<div class="customer paymentaddress left text-left">
								<?php if ($manager_order['customer']) { ?>
									<span id="show-paymentaddress-<?php echo $manager_order['order_id']; ?>" title="<?php echo $text_toggle_address; ?>" class="show-more"><?php echo $manager_order['customer']; ?></span>
								<?php } else { ?>
									<span class="unspecified"><?php echo $text_unspecified; ?></span>
								<?php } ?>
								<?php if (in_array('edit_customer', $buttons)) { ?>
									<a href="<?php echo $manager_order['edit_customer']; ?>" class="edit-customer pencil" title="<?php echo $button_edit_customer; ?>"><i class="fa blue fa-pencil"></i></a>
								<?php } ?>
								<?php if ($manager_order['payment_address']) { ?>
									<div id="paymentaddress-<?php echo $manager_order['order_id']; ?>" class="more" style="display: none;">
										<div>
											<?php echo $manager_order['payment_address']; ?>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
																			
						<?php if (in_array('recipient', $columns)) { ?>
							<div class="recipient shippingaddress left text-left">
								<?php if ($manager_order['recipient']) { ?>
									<span id="show-shippingaddress-<?php echo $manager_order['order_id']; ?>" title="<?php echo $text_toggle_address; ?>" class="show-more"><?php echo $manager_order['recipient']; ?></span>
								<?php } else { ?>
									<span class="unspecified"><?php echo $text_unspecified; ?></span>
								<?php } ?>
								<?php if (in_array('edit_customer', $buttons) && !in_array('customer', $columns)) { ?>
									<a href="<?php echo $manager_order['edit_customer']; ?>" class="edit-customer pencil" title="<?php echo $button_edit_customer; ?>"><i class="fa blue fa-pencil"></i></a>
								<?php } ?>
								<?php if ($manager_order['shipping_address']) { ?>						
									<div id="shippingaddress-<?php echo $manager_order['order_id']; ?>" class="more" style="display: none;">
										<div>
											<?php echo $manager_order['shipping_address']; ?>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('date_added', $columns)) { ?>
							<div class="date-added center text-center">
								<?php echo $manager_order['date_added']; ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('date_modified', $columns)) { ?>
							<div class="date-modified center text-center">
								<?php echo $manager_order['date_modified']; ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('products', $columns)) { ?>
							<div class="products left text-left">
								<span id="show-products-<?php echo $manager_order['order_id']; ?>" class="show-more" title="<?php echo $text_toggle_products; ?>"><?php echo sprintf($text_products, $manager_order['quantity']); ?></span>
								<?php if ($manager_order['comment']) { ?>
									<div class="manager-tooltip comment">
										<span class="container hover">
											<?php echo $manager_order['comment']; ?>
										</span>
										<div class="arrow hover"></div>
										<i class="fa orange fa-exclamation"></i>
									</div>
								<?php } ?>							
								<div id="products-<?php echo $manager_order['order_id']; ?>" class="more" style="display: none;">
									<div>
										<ul>
											<?php foreach ($manager_order['products'] as $product) { ?>
												<li>

													<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a> x <?php echo $product['quantity']; ?> <br>
													<span><?php echo $product['model']; ?></span>
													<?php if (!empty($product['options'])) { ?>
														<span class="options">
															<?php foreach ($product['options'] as $option) { ?>
																<?php echo "- ".$option['name'].": ".$option['value']."<br/>"; ?>
															<?php } ?>
														</span>
													<?php } ?>
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						<?php } ?>
											
						<?php if (in_array('payment', $columns)) { ?>
							<div class="payment center text-center">
								<span<?php echo (!empty($payments[$manager_order['payment_code']]['color']) ? " style='color: ".$payments[$manager_order['payment_code']]['color']."'" : ""); ?>>
									<?php if ($manager_order['payment_method']) { ?>
										<?php echo $manager_order['payment_method']; ?>
									<?php } elseif ($manager_order['payment_code']) { ?>
										<?php echo $manager_order['payment_code']; ?>
									<?php } else { ?>
										<span class="unspecified"><?php echo $text_unspecified; ?></span>
									<?php } ?>
								</span>
							</div>
						<?php } ?>

						<?php //var_dump($manager_order['newAddress']); //die; ?>
							<div class="newAddress center text-center">
								<span<?php echo (!empty($manager_order['newAddress']) ? " style='color: ".$shippings[$manager_order['shipping_code']]['color']."'" : ""); ?>>
									<?php if ($manager_order['newAddress']['address']) { ?>
										<?php echo $manager_order['newAddress']['address']; ?>
									<?php } if ($manager_order['newAddress']['city']) { ?>
										<?php echo $manager_order['newAddress']['city']; ?>
									<?php } if   ($manager_order['newAddress']['country']) { ?>
										<span class="unspecified"><?php echo $manager_order['newAddress']['country']; ?></span>
									<?php } ?></span>
							</div>

						<?php if (in_array('shipping', $columns)) { ?>
							<div class="shipping center text-center">
								<span<?php echo (!empty($shippings[$manager_order['shipping_code']]['color']) ? " style='color: ".$shippings[$manager_order['shipping_code']]['color']."'" : ""); ?>>
									<?php if ($manager_order['shipping_method']) { ?>
										<?php echo $manager_order['shipping_method']; ?>
									<?php } elseif ($manager_order['shipping_code']) { ?>
										<?php echo $manager_order['shipping_code']; ?>
									<?php } else { ?>
										<span class="unspecified"><?php echo $text_unspecified; ?></span>
									<?php } ?></span>
							</div>
						<?php } ?>
								
						<?php if (in_array('subtotal', $columns)) { ?>
							<div class="subtotal center text-center">
								<?php echo $manager_order['subtotal']; ?>
							</div>
						<?php } ?>
																	
						<?php if (in_array('total', $columns)) { ?>
							<div class="total center text-center">
								<?php echo $manager_order['total']; ?>
							</div>
						<?php } ?>
									
						<?php if (in_array('actions', $columns) && $manager_order['action']) { ?>
                			<div class="actions center text-center nowrap">
                				<div>
                					<?php foreach ($manager_order['action'] as $action) { ?>
                 						<a href="<?php echo $action['href']; ?>" class="action <?php echo $action['type']; ?>" title="<?php echo $action['text']; ?>"><i class="fa white fa-<?php echo $action['type']; ?>"></i></a>
                  					<?php } ?>
                  				</div>
                  			</div>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } else { ?>
            	<div class="empty"><div><?php echo $text_empty_list; ?></div></div>
			<?php } ?>
		</div>
    	<?php echo $manager_pagination; ?>
    </div>
    <?php if (in_array('history', $buttons)) { ?>	
		<select name="ocstatuses" class="ocstatuses" style="display: none;">
			<?php foreach ($ocstatuses as $item) { ?>
				<option value="<?php echo $item['order_status_id']; ?>"><?php echo $item['name']; ?></option>
			<?php } ?>
		</select>
	<?php } ?>	
	</form>
</div>
<script type="text/javascript">

$(document).ready(function()
{
	<?php if (version_compare(VERSION, '2.0', '<')) { ?>
		$(".date").datepicker({dateFormat: "dd.mm.yy"});
	<?php } else { ?>
		$(".date").datetimepicker({pickTime: false, format: "DD.MM.YYYY"});
	<?php } ?>
});

<?php if (in_array('history', $buttons)) { ?>

$(".order-manager .order-row .change-status").click(function()
{
	str = $(this).closest(".order-row").attr("id");
	values = str.split("-");
	id = values[1];	
	
	$(".order-manager .order-row .order-status-id .status-text").show();
	
	if ($(".order-manager #order-" + id + " .ocstatuses").is(':visible')) {
		$(".order-manager #order-" + id + " .ocstatuses").hide();
	} else {
		$(".order-manager .ocstatuses").hide();
		$(".order-manager .order-row .order-status-id .status-text").show();
		$(".order-manager .ocstatuses").val($(".order-manager #order-" + id + " .order-status-id input[name*='statuses']").val());
		$(".order-manager #order-" + id + " .order-status-id .status-text").before($(".order-manager .ocstatuses").detach());
		$(".order-manager #order-" + id + " .order-status-id .status-text").hide();
		$(".order-manager .ocstatuses").show();
		$(".order-manager .ocstatuses").focus();
	}
});

$(".order-manager .ocstatuses").change(function()
{
	str = $(this).closest(".order-row").attr("id");
	values = str.split("-");
	id = values[1];
	
	$(".order-manager #order-" + id + " .order-status-id input[name*='statuses']").val($(this).val());
	$(".order-manager #order-" + id + " .order-status-id .status-text").text($(".order-manager .ocstatuses option[value='" + $(this).val() + "']").text());
	$(".order-manager #order-" + id + " .history-comment .comment-status").show();
	$(".order-manager #order-" + id + " input[name*='selected']").attr('checked', true);
	$(".order-manager #order-" + id).addClass('changed');
	$(".order-manager .orders-buttons span").removeClass('disabled');
});

$(".order-manager .comment-status").click(function()
{
	str = $(this).closest(".order-row").attr("id");
	values = str.split("-");
	id = values[1];
			
	if ($(".order-manager #order-" + id + " .history-comment div").is(':visible')) {
		$(".order-manager #order-" + id + " .history-comment div").hide();
	} else {
		$(".order-manager .history-comment div").hide();	
		$(".order-manager #order-" + id + " .history-comment .container").css('margin-top', -($(".order-manager #order-" + id + " .history-comment .container").height() + 32));
		$(".order-manager #order-" + id + " .history-comment div").show();
		$(".order-manager #order-" + id + " .history-comment textarea").focus();
	}
});

$(".order-manager .history-comment .close").click(function()
{
	$(".order-manager .history-comment div").hide();
});

$(document).keyup(function(e)
{
	if (e.which == 27) {
		$(".order-manager .history-comment div").hide();
		$(".order-manager .ocstatuses").hide();
	}
});

$(".order-manager .button-history").click(function()
{
	if (!$(this).hasClass('disabled')) {
		url = "<?php echo html_entity_decode($history, ENT_NOQUOTES, 'UTF-8'); ?>" + getFilters();
  		$('#manager-form').attr('action', url);
  		$('#manager-form').attr('target', '_self');
  		$('#manager-form').submit();
	}
});

<?php } ?>

<?php if (in_array('invoice', $buttons)) { ?>
	
$(".order-manager .button-invoice").click(function()
{
	if (!$(this).hasClass('disabled')) {
		url = "<?php echo html_entity_decode($invoice, ENT_NOQUOTES, 'UTF-8'); ?>" + getFilters();
  		$('#manager-form').attr('action', url);
  		$('#manager-form').attr('target', '_blank');
  		$('#manager-form').submit();
	}
});
	
<?php } ?>

<?php if (in_array('shipping', $buttons)) { ?>
	
$(".order-manager .button-shipping").click(function()
{
	if (!$(this).hasClass('disabled')) {
		url = "<?php echo html_entity_decode($shipping, ENT_NOQUOTES, 'UTF-8'); ?>" + getFilters();
  		$('#manager-form').attr('action', url);
  		$('#manager-form').attr('target', '_blank');
  		$('#manager-form').submit();
	}
});
	
<?php } ?>
			
<?php if (in_array('delete', $buttons)) { ?>

$(".order-manager .button-delete").click(function()
{
	if (!$(this).hasClass('disabled')) {
		if (confirm("<?php echo $text_delete_confirm; ?>")) {
			url = "<?php echo html_entity_decode($delete, ENT_NOQUOTES, 'UTF-8'); ?>" + getFilters();
	  		$('#manager-form').attr('action', url);
	  		$('#manager-form').attr('target', '_self');
	  		$('#manager-form').submit();
  	  	}
	}
});	

<?php } ?>

<?php if (in_array('minimize', $buttons)) { ?>

$(".order-manager .button-minimize").click(function()
{
	if ($(".order-manager .orders-container").is(':visible')) {
		$(".order-manager .orders-container").slideUp('fast');
	} else {
		$(".order-manager .orders-container").slideDown('fast');
	}
});	

<?php } ?>

<?php if (in_array('toggle', $buttons)) { ?>
	
$(".order-manager .toggle-all").click(function()
{
	str = $(this).attr("id");
	values = str.split("-");
	item = values[1];

	if ($(this).hasClass("expand")) {
		$(this).removeClass("expand");
		$("." + item + " .more").show();
	} else {
		$(this).addClass("expand");
		$("." + item + " .more").hide();
	}
});

<?php } ?>

<?php if ($filters) { ?>

$(".order-manager .filter-orders").click(function()
{
	location = "<?php echo html_entity_decode($dashboard, ENT_NOQUOTES, 'UTF-8'); ?>" +	getFilters();
});

$(".order-manager .order-filters input").keydown(function(e)
{
	if (e.keyCode == 13) {
		$(".order-manager .filter-orders").trigger('click');
	}
});
						
$(".order-manager .remove-filters").click(function()
{
	$(".order-manager .order-filters input").val("");
	$(".order-manager .order-filters select").val("*");
	$(".order-manager .filter-orders").trigger('click');
});

<?php } ?>
	
$(".order-manager .manager-tooltip.comment").hover(function()
{
	str = $(this).closest(".order-row").attr("id");
	values = str.split("-");
	id = values[1];
	
	$(".order-manager #order-" + id + " .manager-tooltip.comment span").css('margin-top', -($(".order-manager #order-" + id + " .manager-tooltip.comment span").height() + 32));
});
					
$(".order-manager .show-more").click(function()
{
	str = $(this).attr("id");
	values = str.split("-");
	item = values[1];
	id = values[2];
		
	if ($("#" + item + "-" + id).is(":visible")) {
		$("#" + item + "-" + id).hide();
	} else {
		$("#" + item + "-" + id).show();
	}				
});

$(".order-manager input[name='toggle']").click(function()
{
	$(".order-manager input[name*='selected']").attr('checked', this.checked);

	if (this.checked) {
		$(".order-manager .orders-buttons span").removeClass('disabled');
  	} else {
  		$(".order-manager .orders-buttons span").addClass('disabled');
  	}	
});

$(".order-manager input[name*='selected']").click(function()
{
	checked = $(".order-manager input[name*='selected']:checked").map(function(){ return this.value; }).toArray();

	if (checked != "") {
		$(".order-manager .orders-buttons span").removeClass('disabled');
  	} else {
  		$(".order-manager .orders-buttons span").addClass('disabled');
  	}
});
	
$(".order-manager input[name='limit']").keydown(function(e)
{
	if (e.keyCode == 13) {
		$(".order-manager .filter-orders").trigger('click');
	}
});

$(".order-manager select[name='mode']").change(function()
{
	$(".order-manager .filter-orders").trigger('click');	
});
	
$(".order-manager textarea[name^='comments']").keydown(function(e)
{
	if (((e.keyCode == 10) || (e.keyCode == 13)) && e.ctrlKey) {
		$(".order-manager .history-comment .close").trigger('click');
	}
});

<?php if ($rptracking_status) { ?>
	
$(".order-manager input[name^='trackings']").keydown(function(e)
{
	if (e.keyCode == 13) {
		$(".order-manager .history-comment .close").trigger('click');
	}
});

<?php } ?>

function getFilters()
{
	url = "";
	
	var filter_order_id = $(".order-manager input[name='filter_order_id']").val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
		
	var filter_customer = $(".order-manager input[name='filter_customer']").val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
			
	var filter_recipient = $(".order-manager input[name='filter_recipient']").val();
	
	if (filter_recipient) {
		url += '&filter_recipient=' + encodeURIComponent(filter_recipient);
	}
			
	var filter_order_status_id = $(".order-manager select[name='filter_order_status_id']").val();
	
	if (filter_order_status_id && (filter_order_status_id != '*')) {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}	
	
	var filter_date_added = $(".order-manager input[name='filter_date_added']").val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var filter_date_modified = $(".order-manager input[name='filter_date_modified']").val();
	
	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}
		
	var filter_products = $(".order-manager input[name='filter_products']").val();
	
	if (filter_products) {
		url += '&filter_products=' + encodeURIComponent(filter_products);
	}
			
	var filter_payment = $(".order-manager select[name='filter_payment']").val();
	
	if (filter_payment && (filter_payment != '*')) {
		url += '&filter_payment=' + encodeURIComponent(filter_payment);
	}
		
	var filter_shipping = $(".order-manager select[name='filter_shipping']").val();
	
	if (filter_shipping && (filter_shipping != '*')) {
		url += '&filter_shipping=' + encodeURIComponent(filter_shipping);
	}
		
	var filter_subtotal = $(".order-manager input[name='filter_subtotal']").val();

	if (filter_subtotal) {
		url += '&filter_subtotal=' + encodeURIComponent(filter_subtotal);
	}
			
	var filter_total = $(".order-manager input[name='filter_total']").val();

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}
		
	var limit = $(".order-manager input[name='limit']").val();

	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
		
	var mode = $(".order-manager select[name='mode']").val();

	if (mode) {
		url += '&mode=' + encodeURIComponent(mode);
	}
	
	return url;
}

</script>