<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">

<style type="text/css">
.move_zone { /*FOR DRAG&DROP SORT*/
	background-image: url("view/image/move_zone.png");
	background-repeat: repeat;
 	cursor: move;
	height: 16px;
	width: 20px;
	margin-left: 50%;
}
.drop_hover { /*FOR DRAG&DROP SORT*/
	background:red !important;
}
</style>
			
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
			<!--BOF Product Series-->
			<button class="btn btn-primary" title="" data-toggle="tooltip" formaction="<?php echo $create_product_series; ?>" form="form-product" type="submit" data-original-title="<?php echo $button_create_product_series; ?>"><?php echo $button_create_product_series; ?></button>
			<!--EOF Product Series--><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">

<?php //FOR DRAG&DROP SORT ?>
	<div id="page" style="display:none"><?php echo $page; ?></div>
<?php //FOR DRAG&DROP SORT ?>
			
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $column_category; ?></label>
                <select name="filter_category" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if ($category['product_count'] >= 1) { ?>
                  <?php if ($category['category_id']==$filter_category) { ?>
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>">&nbsp;&nbsp;<?php echo $category['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
                <input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                <input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-image"><?php echo $entry_image; ?></label>
                <select name="filter_image" id="input-image" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_image) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_image && !is_null($filter_image)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            
<table id="list" class="table table-bordered table-hover">
			
              <thead>
                <tr>

<?php //FOR DRAG&DROP SORT ?>
             <td class="text-center"><?php echo $text_sort ; ?></td>
<?php //FOR DRAG&DROP SORT ?>
			
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php echo $column_image; ?></td>
                  <td class="text-left"><?php if ($sort == 'pd.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'p.model') { ?>
                    <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'p.price') { ?>
                    <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $column_category; ?></td>
                  <td class="text-right"><?php if ($sort == 'p.quantity') { ?>
                    <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'p.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($products) { ?>
                
            <?php foreach ($products as $product) { ?>
            <tr id="<?php echo $product['order'] ;//FOR DRAG&DROP SORT ?>" >
<?php //FOR DRAG&DROP SORT ?>
             <td class="text-right"><div class="first"></div></td>
<?php //FOR DRAG&DROP SORT ?>
			
                  <td class="text-center"><?php if (in_array($product['product_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-center"><?php if ($product['image']) { ?>
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $product['name']; ?></td>
                  <td class="text-left"><?php echo $product['model']; ?></td>
                  <td class="text-right"><?php if ($product['special']) { ?>
                    <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                    <div class="text-danger"><?php echo $product['special']; ?></div>
                    <?php } else { ?>
                    <?php echo $product['price']; ?>
                    <?php } ?></td>

                  <td class="text-left">
                    <?php foreach ($categories as $category) { ?>
                    <?php if (in_array($category['category_id'], $product['category'])) { ?>
                    <?php echo $category['name'];?><br>
                    <?php } ?>
                    <?php } ?></td>

                  <td class="text-right"><?php if ($product['quantity'] <= 0) { ?>
                    <span class="label label-warning"><?php echo $product['quantity']; ?></span>
                    <?php } elseif ($product['quantity'] <= 5) { ?>
                    <span class="label label-danger"><?php echo $product['quantity']; ?></span>
                    <?php } else { ?>
                    <span class="label label-success"><?php echo $product['quantity']; ?></span>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $product['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8">
              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
			
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/product&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();

	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}


            var filter_category = $('select[name=\'filter_category\']').val();           
            if (filter_category != '*') {
                url += '&filter_category=' + encodeURIComponent(filter_category);
            }
            
	var filter_price = $('input[name=\'filter_price\']').val();

	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}


	var filter_category = $('select[name=\'filter_category\']').val();

  if (filter_category != '*') {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();

	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

  var filter_image = $('select[name=\'filter_image\']').val();

  if (filter_image != '*') {
    url += '&filter_image=' + encodeURIComponent(filter_image);
  }

	location = url;
});
//--></script>
  <script type="text/javascript"><!--

<?php if (isset($aaplus) && $aaplus) { ?>
$('input[name=\'filter_name\']').autocompleteplus({
<?php } else { ?>
$('input[name=\'filter_name\']').autocomplete({
<?php } ?>
			
	'source': function(request, response) {
		$.ajax({
			
			<?php if (isset($aaplus) && $aaplus) { ?>
			url: 'index.php?route=catalog/product/autocompleteplus&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			<?php } else { ?>
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			<?php } ?>
			
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],

				<?php if (isset($aaplus) && $aaplus) { ?>
						model: item['model'],
						image: item['image'],
					  special: item['special'],
						price: item['price'],
					   dprice: item['dprice'],
					   dfield: item['dfield'],
				<?php } ?>
			
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});
//--></script></div>

<?php //FOR DRAG&DROP SORT ?>
<script type="text/javascript">
var bisy = 0;
$(document).ready(function(){ 

	var c = $('#input-price').val() + $('#input-name').val()  + $('#input-quantity').val() ;
	var t = $('select[name=\'filter_category\'] option:selected').val();
	var k = $('select[name=\'filter_status\'] option:selected').val();

	if (c == '' && t != '*' && k == '*'){ //Если не выбрана категория отключаем сортировку D&D
		$('.first').addClass("move_zone");
	}
	
	  function slideout(){
  setTimeout(function(){ $("#response").slideUp("slow", function () { });}, 2000);
	  }
	
  	$("#response").hide();
	$(function() {
	$("#list tbody").sortable({ handle: ".move_zone",opacity: 0.8, cursor: 'move', update: function() {

			var act_product = arguments[1].item[0].id;
			var category_id = $('select[name=\'filter_category\'] option:selected').val();
			if (category_id == '*'){ alert('Сначала выберите категорию!'); return false;}
			var page = $('#page').text();			
			var data_send = $(this).sortable("serialize") + '&update=update' + '&product=' + act_product + '&category_id=' + category_id + '&page=' + page;



	if (bisy == 1) { return false;}
	$.ajax({
		url: 'index.php?route=catalog/product/updateOrder&token=<?php echo $token; ?>', 
		type: 'post',
		data: data_send,
		dataType: 'json',
		beforeSend: function() {

		},	
		complete: function() {

		},			
		success: function(json) {
//			$("#response").html(json);
			$("#response").slideDown('slow');
			slideout();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "
" + xhr.statusText + "
" + xhr.responseText);
		}
	});	
		}								  
		});
	});

});

	// Перенос товара на другую страницу
	$(".pagination li a").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){ 
			bisy=1;//запрещаем отправку запроса сортировки на странице
//			$(ui.helper).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			var product_id = $(ui.helper).find('input[type="checkbox"][name*="selected[]"]').val();
			var newPage = $(this).html();
			var oldPage = $('#page').text();
			var category_id = $('select[name=\'filter_category\'] option:selected').val();
//			var url = window.location.href ;

			var url = $('.pagination li a:contains(' + newPage + ')').attr("href");

			$.ajax({
 		       		type: 'GET',
 		 	  	url: 'index.php?route=catalog/product/updateOrder',
				data: {token:"<?php echo $token; ?>",product_id:product_id,category_id:category_id,move2page:newPage,page:oldPage},
 		   	  	success: function() {
 		       	  		location = url;
 		   	 	   }
  			});
		return false;	
		}		
	});	
</script>
<?php //FOR DRAG&DROP SORT ?>
			
<?php echo $footer; ?>