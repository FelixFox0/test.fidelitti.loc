<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
          <a onclick="$('#form_seo').submit(); return false;" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></a>
          <a href="<?php echo $back; ?>" data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="form_seo">
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            
                            <td>
                                <select name="status">
                                <?php if ($status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td><?php echo $entry_status; ?></td>
                            </tr>
                            <tr>
                            
                            <td class="right">
                                <select name="only_to_latin">
                                <?php if ($only_to_latin) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                                </select> 
                            </td>
                            <td><?php echo $text_only_to_latin ?></td>
			</tr>
                        
                        <tr>
                            
                            <td class="right">
                                <select name="canonical_products">
                                <?php if ($canonical_products) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                                </select> 
                            </td>
                            <td><?php echo $text_canonical_products ?></td>
			</tr>
                        
                        <?php if($check_main_category){ ?>
                            <tr>
                                <td class="right">
                                    <select name="select_main_category">
                                    <?php if ($select_main_category) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                    </select> 
                                </td>
                                <td><?php echo $text_select_main_category ?></td>
                            </tr>
                        <?php } ?>
                        
                        <tr>
                            
                            <td class="right">
                                <select name="breadcrumb_list">
                                <?php if ($breadcrumb_list) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                                </select> 
                            </td>
                            <td><?php echo $text_breadcrumb_list ?></td>
			</tr>
                        
                        
                        <tr>
                            <td class="right">
                                <select name="product_microdata_status[status]">
                                <?php if (isset($product_microdata_status['status']) && $product_microdata_status['status']) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td>
                                <?php echo $text_product_microdata_status ?>
                                <br><span onclick="openHideBox('product_microdata_status')" style="color: #F00; cursor: pointer; border-bottom: 1px dashed"><?php echo $text_product_microdata_settings ?></span>
                            </td>
			</tr>
                        <tr  id='product_microdata_status' style="display: none">
                            <td colspan="2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[priceCurrency]">
                                                <?php if (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] && $product_microdata_status['priceCurrency']=='RUB') { ?>
                                                <option value="RUB" selected="selected">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }elseif (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] 
                                                && $product_microdata_status['priceCurrency']=='RUB') { ?>
                                                <option value="RUB" selected="selected">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }elseif (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] 
                                                && $product_microdata_status['priceCurrency']=='UAH') { ?>
                                                <option value="RUB">RUB</option>
                                                <option value="UAH" selected="selected">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }elseif (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] 
                                                && $product_microdata_status['priceCurrency']=='USD') { ?>
                                                <option value="RUB">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD" selected="selected">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }elseif (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] 
                                                && $product_microdata_status['priceCurrency']=='EUR') { ?>
                                                <option value="RUB">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR" selected="selected">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }elseif (isset($product_microdata_status['priceCurrency']) && $product_microdata_status['priceCurrency'] 
                                                && $product_microdata_status['priceCurrency']=='KZT') { ?>
                                                <option value="RUB">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT" selected="selected">KZT</option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php }else{ ?>
                                                <option value="RUB">RUB</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="KZT">KZT</option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_priceCurrency ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[image]">
                                                <?php if (isset($product_microdata_status['image']) && $product_microdata_status['image']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_image ?>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[brand]">
                                                <?php if (isset($product_microdata_status['brand']) && $product_microdata_status['brand']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_brand ?>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[aggregateRating]">
                                                <?php if (isset($product_microdata_status['aggregateRating']) && $product_microdata_status['aggregateRating']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_aggregateRating ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[review]">
                                                <?php if (isset($product_microdata_status['review']) && $product_microdata_status['review']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_review ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[offerCount]">
                                                <?php if (isset($product_microdata_status['offerCount']) && $product_microdata_status['offerCount']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_offerCount ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[brand]">
                                                <?php if (isset($product_microdata_status['brand']) && $product_microdata_status['brand']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_brand ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="product_microdata_status[availability]">
                                                <?php if (isset($product_microdata_status['availability']) && $product_microdata_status['availability']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php echo $text_product_microdata_availability ?>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </td>
                        </tr>
                        
                        
                        <tr>
                            <td class="left" colspan="2">
                                <p><a onclick="$('#form_seo').attr('action', '<?php echo $seo_setting; ?>');$('#form_seo').submit();  return false;" href="<?php echo $seo_setting; ?>" class="btn btn-primary"><?php echo $button_setting; ?></a></p>
                            </td>
			</tr>
                     </table>
                </div>
                <p><a onclick="$('#form_seo').attr('action', '<?php echo $seo_generate; ?>');$('#form_seo').submit();  return false;" href="<?php echo $seo_generate; ?>" class="btn btn-primary"><?php echo $button_seo_generate; ?></a> <span class="small"><?php echo $text_seo_generate; ?></span></p>
            </div>
            <div class="panel-body">
                
                    <ul class="nav nav-tabs">
                        <li <?php if($tab=='products'){ ?> class="active" <?php } ?>><a href="<?php echo $seo_products ?>"  ><?php echo $text_seo_products ?></a></li>
                        <li <?php if($tab=='categories'){ ?> class="active" <?php } ?>><a href="<?php echo $seo_categories ?>" ><?php echo $text_seo_categories ?></a></li>
                        <li <?php if($tab=='manufactures'){ ?> class="active" <?php } ?> ><a href="<?php echo $seo_manufactures ?>"><?php echo $text_seo_manufactures ?></a></li>
                        <li <?php if($tab=='informations'){ ?> class="active" <?php } ?> ><a href="<?php echo $seo_informations ?>"><?php echo $text_seo_informations ?></a></li>
                        
                        <?php if($simple_blog){ ?>
                        <li <?php if($tab=='simpleblogarticles'){ ?> class="active" <?php } ?> ><a href="<?php echo $seo_simpleblogarticles ?>"><?php echo $text_seo_simpleblogarticles ?></a></li>
                        <li <?php if($tab=='simpleblogcategories'){ ?> class="active" <?php } ?> ><a href="<?php echo $seo_simpleblogcategories ?>"><?php echo $text_seo_simpleblogcategories ?></a></li>
                        <?php } ?>
                        
                    </ul>
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" style="width: 100%" name="filter_name" value="<?php echo $filter_name; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a onclick="$('#form_seo').attr('action', '<?php echo $seo_filter; ?>');$('#form_seo').submit();  return false;" class="btn btn-primary"><?php echo $button_filter; ?></a>
                            </div>
                        </div>
                    </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                          <td class="left"><a class="<?php echo $order_id ?>" href="<?php echo $sort_id ?>"><?php echo $column_id; ?></a></td>
                          <td class="right"><?php echo $column_name; ?></td>
                          <td class="right" width="40%"><?php echo $column_keyword; ?> <a style="cursor: pointer" onclick="$('.seourl').val('')">(<?php echo $text_remove_seorl; ?>)</a></td>
                        </tr>
                      </thead>



                      <tbody>
                        <?php if ($seos) { ?>
                        <?php foreach ($seos as $id_seos => $seos_row) { ?>
                        <tr>
                          <td style="text-align: center;"><?php if ($seos_row['selected']) { ?>
                            <input type="checkbox" name="selected[<?php echo $id_seos; ?>]" value="<?php echo $id_seos; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="checkbox" name="selected[<?php echo $id_seos; ?>]" value="<?php echo $id_seos; ?>" />
                            <?php } ?></td>
                          <td class="left"><?php echo $id_seos; ?></td>
                          <td class="left"><?php echo $seos_row['name']; ?></td>
                          <td class="left"><input class="seourl" style="width: 80%; <?php if(isset($dublicates[$id_seos])){ ?> color:red; <?php }?> <?php if(isset($new_seo_urls[$id_seos])){ ?> color:green; <?php } ?> " type="text" name="name[<?php echo $id_seos; ?>]" value="<?php if(isset($new_seo_urls[$id_seos])){ echo $new_seo_urls[$id_seos]; }else{ echo $seos_row['url_alias']; } ?>" /></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                          <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                </table>
                
                <div class="row" style="width:95%">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        <hr>
        <?php if ((!$error_warning) && (!$success)) { ?>
        <div id="ocext_notification" class="alert alert-info"><i class="fa fa-info-circle"></i>
                <div id="ocext_loading"><img src="<?php echo HTTP_SERVER; ?>/view/image/ocext/loading.gif" /></div>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <script type="text/javascript"><!--
            
            function openHideBox(idDiv){
                $('#'+idDiv).show();
            }
            
        function getNotifications() {
	$.ajax({
            type: 'GET',
            url: 'index.php?route=module/seourlgenerator/getNotifications&token=<?php echo $token; ?>',
            dataType: 'json',
            success: function(json) {
                    if (json['error']) {
                            $('#ocext_notification').html('<i class="fa fa-info-circle"></i><button type="button" class="close" data-dismiss="alert">&times;</button> '+json['error']+' <span style="cursor:pointer;font-weight:bold;text-decoration:underline;float:right;" onclick="getNotifications();"></span>');
                    } else if (json['message'] && json['message']!='' ) {
                            $('#ocext_notification').html('<i class="fa fa-info-circle"></i><button type="button" class="close" data-dismiss="alert">&times;</button> '+json['message']);
                    }else{
                        $('#ocext_notification').remove();
                    }
            },
            failure: function(){
                    $('#ocext_notification').remove();
            },
            error: function() {
                    $('#ocext_notification').remove();
            }
    });
}
getNotifications();

//--></script> 
        
        
        </div>
    </div>
</div>
    </form>
</div>
<?php echo $footer; ?>