<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-pochtaros" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
</div>
<div class="panel-body">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pochtaros" class="form-horizontal">

<div class="row">
    <div class="col-sm-2">
        <ul class="nav nav-pills nav-stacked" id="modules">
            <li><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <?php $module_row = 1; ?>
            <?php foreach ($modules as $module) { ?>
                <li><a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>" data-toggle="tab"><?php echo isset($module['title'][$config_language_id]) ? $module['title'][$config_language_id] : $tab_module . ' ' . $module_row; ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-minus-circle" onClick="$('#modules li > a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false; "></i></a></li>
                <?php $module_row++; ?>
            <?php } ?>
            <button id="module-add" type="button" onclick="addModule();" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus-circle">&nbsp;Добавить модуль</i></button>
        </ul>
    </div>
    <div class="col-sm-10">
        <div class="tab-content" id="modules-tabs">
            <div class="tab-pane" id="tab-general">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_name; ?>"><?php echo $entry_name; ?></span></label>
                    <div class="col-sm-10">
                        <?php foreach ($languages as $language) {
                        if ($language['status'] == 1) {
                    ?>
                        <div class="input-group pull-left"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> </span>
                            <input size="50" type="text" name="<?php echo $name; ?>_name[<?php echo $language['language_id']; ?>]" value="<?php isset(${$name.'_name'}) ? $mname = ${$name.'_name'} : $mname = ''; echo isset($mname[$language['language_id']]) ? $mname[$language['language_id']] : '';  ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" /></div>
                        <?php }
                    } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tax"><?php echo $entry_tax_class; ?></label>
                    <div class="col-sm-10">
                        <select name="<?php echo $name; ?>_tax_class_id" id="input-tax" class="form-control">
                            <option value="0"><?php echo $text_none; ?></option>
                            <?php foreach ($tax_classes as $tax_class) { ?>
                            <?php if ($tax_class['tax_class_id'] == ${$name.'_tax_class_id'}) { ?>
                            <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                    <div class="col-sm-10">
                        <select name="<?php echo $name; ?>_status" id="input-status" class="form-control">
                            <?php if (${$name.'_status'}) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" name="<?php echo $name; ?>_sort_order" value="<?php echo ${$name.'_sort_order'}; ?>" placeholder="1" id="input-sort-order" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $module_row = 1;
                foreach ($modules as $module) { ?>
                <div class="tab-pane" id="tab-module-<?php echo $module_row; ?>">

                    <ul class="nav nav-tabs" id="language-<?php echo $module_row; ?>">
                        <?php foreach ($languages as $language) {
                            if ($language['status'] == 1) {
                        ?>
                            <li><a href="#language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php
                            }
                        } ?>
                    </ul>

                    <div class="tab-content">
                        <?php foreach ($languages as $language) {
                            if ($language['status'] == 1) {
                        ?>
                        <div class="tab-pane" id="language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-title-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                                <div class="col-sm-10">
                                    <input size="100" type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['title'][$language['language_id']]) ? $module['title'][$language['language_id']] : ''; ?>" id="input-title-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>" class="form-control" /><br/>
                                    <?php if (isset($error_title[$module_row][$language['language_id']]) and !empty($error_title[$module_row][$language['language_id']])) { ?>
                                        <div class="text-danger"><?php echo $error_title[$module_row][$language['language_id']]; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textarea-description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><?php echo $entry_info; ?></label>
                                <div class="col-sm-10">
                                    <textarea name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][info][<?php echo $language['language_id']; ?>]" id="textarea-description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><?php echo isset($module['info'][$language['language_id']]) ? $module['info'][$language['language_id']] : ''; ?></textarea>
                                </div>
                            </div>

                        </div>
                        <?php
                            }
                        }
                        ?>

                        <fieldset>
                            <legend><?php echo $text_settings; ?></legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-price-<?php echo $module_row; ?>"><?php echo $entry_price; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][price]" value="<?php if (isset($module['price'])) echo $module['price']; ?>" id="input-price-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-price-text-<?php echo $module_row; ?>"><?php echo $entry_price_text; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][price_text]" value="<?php if (isset($module['price_text'])) echo $module['price_text']; ?>" id="input-price-text-<?php echo $module_row; ?>" placeholder="<?php echo $text_for_free; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-weight-class-id-<?php echo $module_row; ?>"><?php echo $entry_weight_class; ?></label>
                                <div class="col-sm-10">
                                    <select name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][weight_class_id]" id="input-weight-class-id-<?php echo $module_row; ?>" class="form-control">
                                        <?php foreach ($weight_classes as $weight_class) { ?>
                                        <?php if ($weight_class['weight_class_id'] == $module['weight_class_id']) { ?>
                                        <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-rate-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_rate; ?>"><?php echo $entry_rate; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][rate]" rows="5" id="input-rate-<?php echo $module_row; ?>" class="form-control"><?php if (isset($module['rate'])) echo $module['rate']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-cost-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_cost; ?>"><?php echo $entry_cost; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][cost]" value="<?php if (isset($module['cost'])) echo $module['cost']; ?>" id="input-cost-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image-<?php echo $module_row; ?>"><?php echo $entry_image; ?></label>
                                <div class="col-sm-10">
                                    <a href="" id="thumb-image-<?php echo $module_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $module['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][image]" value="<?php if (isset($module['image'])) echo $module['image']; ?>" id="input-image-<?php echo $module_row; ?>" />
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>

                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 100px; overflow: auto;">
                                        <?php foreach ($stores as $store) { ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>" <?php if (isset($module['store']) and in_array($store['store_id'], $module['store'])) { ?>checked="checked"<?php } ?> />
                                                <?php echo $store['name']; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php if (isset($error_store[$module_row])) { ?>
                                        <div class="text-danger"><?php echo $error_store[$module_row]; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-city-rate-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_city_rate; ?>"><?php echo $entry_city_rate; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][city_rate]" rows="5" id="input-city-rate-<?php echo $module_row; ?>" class="form-control"><?php if (isset($module['city_rate'])) echo $module['city_rate']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-city-rate2-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_city_rate2; ?>"><?php echo $entry_city_rate2; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][city_rate2]" rows="5" id="input-city-rate2-<?php echo $module_row; ?>" class="form-control"><?php if (isset($module['city_rate2'])) echo $module['city_rate2']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-value-for-total-<?php echo $module_row; ?>"><?php echo $entry_value_for_total; ?></label>
                                <div class="col-sm-10">
                                    <select name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][total_value]" id="input-value-for-total-<?php echo $module_row; ?>" class="form-control">
                                        <?php
                                        $total_value = (isset($module['total_value'])) ? $module['total_value'] : 'sub_total';
                                        foreach ($totals as $key => $val) {
                                        ?>
                                        <option value="<?php echo $key;?>" <?php if ($total_value == $key) echo 'selected="selected"'; ?> ><?php echo $val; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-min-total-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_min_total; ?>"><?php echo $entry_min_total; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][min_total]" value="<?php if (isset($module['min_total'])) echo $module['min_total']; ?>" id="input-min-total-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-max-total-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_max_total; ?>"><?php echo $entry_max_total; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][max_total]" value="<?php if (isset($module['max_total'])) echo $module['max_total']; ?>" id="input-max-total-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-min-weight-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_min_weight; ?>"><?php echo $entry_min_weight; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][min_weight]" value="<?php if (isset($module['min_weight'])) echo $module['min_weight']; ?>" id="input-min-weight-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-max-weight-<?php echo $module_row; ?>"><span data-toggle="tooltip" title="<?php echo $help_max_weight; ?>"><?php echo $entry_max_weight; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][max_weight]" value="<?php if (isset($module['max_weight'])) echo $module['max_weight']; ?>" id="input-max-weight-<?php echo $module_row; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-geo-zone-<?php echo $module_row; ?>"><?php echo $entry_geo_zone; ?></label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 100px; overflow: auto;">
                                        <?php foreach ($geo_zones as $geo_zone) { ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][geo_zone][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" <?php if (isset($module['geo_zone']) and in_array($geo_zone['geo_zone_id'], $module['geo_zone'])) { ?>checked="checked"<?php } ?> />
                                                <?php echo $geo_zone['name']; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-bibb-<?php echo $module_row; ?>"><?php echo $entry_bibb; ?></label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 100px; overflow: auto;">
                                        <?php foreach ($arr_bibb as $code) {  ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][bibb][]" value="<?php echo $code; ?>" <?php if (isset($module['bibb']) and in_array($code, $module['bibb'])) { ?>checked="checked"<?php } ?> />
                                                <?php echo ${'text_bib_'.$code}; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer_group-<?php echo $module_row; ?>"><?php echo $entry_customer_group; ?></label>
                                <div class="col-sm-10">
                                    <div class="well well-sm" style="height: 100px; overflow: auto;">
                                        <?php foreach ($customer_groups as $group) { ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][group][]" value="<?php echo $group['customer_group_id']; ?>" <?php if (isset($module['group']) and in_array($group['customer_group_id'], $module['group'])) { ?>checked="checked"<?php } ?> />
                                                <?php echo $group['name']; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($show_product_groups) { ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-filter-group-id-<?php echo $module_row; ?>"><?php echo $entry_group; ?></label>
                                <div class="col-sm-10">
                                    <select name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][filter_group_id]" id="input-filter-group-id-<?php echo $module_row; ?>" class="form-control">
                                        <option value="0" selected="selected"><?php echo $text_group; ?></option>
                                        <?php
                                      foreach ($groups as $group) {
                                        if ($group['status'] == 1) {
                                        ?>
                                        <option value="<?php echo $group['group_id']; ?>" <?php if (isset($module['filter_group_id']) and ($module['filter_group_id'] == $group['group_id'])) { echo "selected"; } ?>><?php echo $group['name']; ?></option>
                                        <?php
                                        }
                                      }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status-<?php echo $module_row; ?>"><?php echo $entry_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][status]" id="input-status-<?php echo $module_row; ?>" class="form-control">
                                        <?php if ($module['status']) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order-<?php echo $module_row; ?>"><?php echo $entry_sort_order; ?></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][sort_order]" value="<?php if (isset($module['sort_order'])) echo $module['sort_order']; else echo 1; ?>" placeholder="1" id="input-sort-order-<?php echo $module_row; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                    </div>
                </div>
            <?php
                $module_row++;
            } ?>

        </div>
    </div>
</div>


                <input type="hidden" name="<?php echo $name; ?>_license" size="50" value="<?php echo ${$name.'_license'}; ?>" >
            </form>
        </div>
    </div>
</div>


<script type="text/javascript"><!--
    <?php $module_row = 1; ?>
    <?php foreach ($modules as $module) { ?>
        $('#language-<?php echo $module_row; ?> a:first').tab('show');
        <?php
        foreach ($languages as $language) {
        ?>
            $('#textarea-description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>').summernote({height: 150});
        <?php
        }
        $module_row++; ?>
    <?php } ?>

    $('#modules a:first').tab('show');
//--></script></div>



<script type="text/javascript"><!--
    <?php $module_row = count($modules) + 1; ?>

    var module_row = <?php echo $module_row; ?>;

    function addModule() {
        html = '<div class="tab-pane" id="tab-module-' + module_row + '">';

        html += '<ul class="nav nav-tabs" id="language-' + module_row + '">';
        <?php foreach ($languages as $language) {
            if ($language['status'] == 1) {
                ?>
                html += '<li><a href="#language-' + module_row + '-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>';
            <?php
            }
        } ?>
        html += '</ul>';

        html += '   <div class="tab-content">';
        <?php foreach ($languages as $language) {
            if ($language['status'] == 1) {
                ?>
                html += '<div class="tab-pane" id="language-' + module_row + '-<?php echo $language['language_id']; ?>">';
                html += '   <div class="form-group required">';
                html += '       <label class="col-sm-2 control-label" for="input-title-' + module_row + '-<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>';
                html += '       <div class="col-sm-10">';
                html += '           <input size="100" type="text" name="<?php echo $name; ?>_module[' + module_row + '][title][<?php echo $language['language_id']; ?>]" value="" id="input-title-' + module_row + '-<?php echo $language['language_id']; ?>" class="form-control" />';
                html += '       </div>';
                html += '   </div>';
                html += '   <div class="form-group">';
                html += '       <label class="col-sm-2 control-label" for="textarea-description-' + module_row + '-<?php echo $language['language_id']; ?>"><?php echo $entry_info; ?></label>';
                html += '       <div class="col-sm-10">';
                html += '           <textarea name="<?php echo $name; ?>_module[' + module_row + '][info][<?php echo $language['language_id']; ?>]" id="textarea-description-' + module_row + '-<?php echo $language['language_id']; ?>"></textarea>';
                html += '       </div>';
                html += '   </div>';

                html += '</div>';
        <?php
            }
        }
        ?>

        html += '   <fieldset>';
        html += '       <legend><?php echo $text_settings; ?></legend>';
        html += '       <div class="form-group">';
        html += '           <label class="col-sm-2 control-label" for="input-price-' + module_row + '"><?php echo $entry_price; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][price]" value="" id="input-price-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-price-text-' + module_row + '"><?php echo $entry_price_text; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][price_text]" value="" id="input-price-text-' + module_row + '" placeholder="<?php echo $text_for_free; ?>" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-weight-class-id-' + module_row + '"><?php echo $entry_weight_class; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '       <select name="<?php echo $name; ?>_module[' + module_row + '][weight_class_id]" id="input-weight-class-id-' + module_row + '" class="form-control">';
                        <?php foreach ($weight_classes as $weight_class) { ?>
                            html += '   <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>';
                        <?php } ?>
        html += '       </select>';
        html += '   </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-rate-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_rate; ?>"><?php echo $entry_rate; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <textarea name="<?php echo $name; ?>_module[' + module_row + '][rate]" rows="5" id="input-rate-' + module_row + '" class="form-control"></textarea>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-cost-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_cost; ?>"><?php echo $entry_cost; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][cost]" value="" id="input-cost-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-image-' + module_row + '"><?php echo $entry_image; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <a href="" id="thumb-image-' + module_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
        html += '           <input type="hidden" name="<?php echo $name; ?>_module[' + module_row + '][image]" value="" id="input-image-' + module_row + '" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group required">';
        html += '       <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>';

        html += '       <div class="col-sm-10">';
        html += '           <div class="well well-sm" style="height: 100px; overflow: auto;">';
        <?php foreach ($stores as $store) { ?>
            html += '           <div class="checkbox">';
            html += '               <label>';
            html += '                   <input type="checkbox" name="<?php echo $name; ?>_module[' + module_row + '][store][]" value="<?php echo $store['store_id']; ?>" checked="checked" />';
            html += '<?php echo $store['name']; ?>';
            html += '               </label>';
            html += '           </div>';
        <?php } ?>
        html += '           </div>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-city-rate-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_city_rate; ?>"><?php echo $entry_city_rate; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <textarea name="<?php echo $name; ?>_module[' + module_row + '][city_rate]" rows="5" id="input-city-rate-' + module_row + '" class="form-control"></textarea>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-city-rate2-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_city_rate2; ?>"><?php echo $entry_city_rate2; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <textarea name="<?php echo $name; ?>_module[' + module_row + '][city_rate2]" rows="5" id="input-city-rate2-' + module_row + '" class="form-control"></textarea>';
        html += '       </div>';
        html += '   </div>';


        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-value-for-total-' + module_row + '"><?php echo $entry_value_for_total; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <select name="<?php echo $name; ?>_module[' + module_row + '][total_value]" id="input-value-for-total-' + module_row + '" class="form-control">';
        <?php
            $total_value = (isset($module['total_value'])) ? $module['total_value'] : 'sub_total';
            foreach ($totals as $key => $val) {
        ?>
            html += '           <option value="<?php echo $key;?>"><?php echo $val; ?></option>';
        <?php } ?>
        html += '           </select>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-min-total-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_min_total; ?>"><?php echo $entry_min_total; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][min_total]" value="" id="input-min-total-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-max-total-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_max_total; ?>"><?php echo $entry_max_total; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][max_total]" value="" id="input-max-total-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-min-weight-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_min_weight; ?>"><?php echo $entry_min_weight; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][min_weight]" value="" id="input-min-weight-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-max-weight-' + module_row + '"><span data-toggle="tooltip" title="<?php echo $help_max_weight; ?>"><?php echo $entry_max_weight; ?></span></label>';
        html += '       <div class="col-sm-10">';
        html += '           <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][max_weight]" value="" id="input-max-weight-' + module_row + '" class="form-control" />';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-geo-zone-' + module_row + '"><?php echo $entry_geo_zone; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <div class="well well-sm" style="height: 100px; overflow: auto;">';
        <?php foreach ($geo_zones as $geo_zone) { ?>
            html += '   <div class="checkbox">';
            html += '       <label>';
            html += '           <input type="checkbox" name="<?php echo $name; ?>_module[' + module_row + '][geo_zone][]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />';
            html += '           <?php echo $geo_zone['name']; ?>';
            html += '       </label>';
            html += '   </div>';
        <?php } ?>
        html += '           </div>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-bibb-' + module_row + '"><?php echo $entry_bibb; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <div class="well well-sm" style="height: 100px; overflow: auto;">';
        <?php foreach ($arr_bibb as $code) {  ?>
            html += '   <div class="checkbox">';
            html += '       <label>';
            html += '           <input type="checkbox" name="<?php echo $name; ?>_module[' + module_row + '][bibb][]" value="<?php echo $code; ?>" />';
            html += '           <?php echo ${'text_bib_'.$code}; ?>';
            html += '       </label>';
            html += '   </div>';
        <?php } ?>
        html += '           </div>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-customer_group-' + module_row + '"><?php echo $entry_customer_group; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <div class="well well-sm" style="height: 100px; overflow: auto;">';
        <?php foreach ($customer_groups as $group) { ?>
            html += '   <div class="checkbox">';
            html += '       <label>';
            html += '       <input type="checkbox" name="<?php echo $name; ?>_module[' + module_row + '][group][]" value="<?php echo $group['customer_group_id']; ?>" checked="checked" />';
            html += '       <?php echo $group['name']; ?>';
            html += '       </label>';
            html += '   </div>';
        <?php } ?>
        html += '           </div>';
        html += '       </div>';
        html += '   </div>';

        <?php if ($show_product_groups) { ?>
            html += '<div class="form-group">';
            html += '<label class="col-sm-2 control-label" for="input-filter-group-id-<?php echo $module_row; ?>"><?php echo $entry_group; ?></label>';
            html += '<div class="col-sm-10">';
            html += '<select name="<?php echo $name; ?>_module[<?php echo $module_row; ?>][filter_group_id]" id="input-filter-group-id-<?php echo $module_row; ?>" class="form-control">';
            html += '<option value="0" selected="selected"><?php echo $text_group; ?></option>';
            <?php
                foreach ($groups as $group) {
                if ($group['status'] == 1) {
                    ?>
                    html += '<option value="<?php echo $group['group_id']; ?>" <?php if (isset($module['filter_group_id']) and ($module['filter_group_id'] == $group['group_id'])) { echo "selected"; } ?>><?php echo $group['name']; ?></option>';
                            <?php
                }
            }
            ?>
            html += '</select>';
            html += '</div>';
            html += '</div>';
        <?php } ?>

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-status-' + module_row + '"><?php echo $entry_status; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <select name="<?php echo $name; ?>_module[' + module_row + '][status]" id="input-status-' + module_row + '" class="form-control">';
        html += '               <option value="1"><?php echo $text_enabled; ?></option>';
        html += '               <option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
        html += '           </select>';
        html += '       </div>';
        html += '   </div>';

        html += '   <div class="form-group">';
        html += '       <label class="col-sm-2 control-label" for="input-sort-order-' + module_row + '"><?php echo $entry_sort_order; ?></label>';
        html += '       <div class="col-sm-10">';
        html += '           <div class="row">';
        html += '               <div class="col-sm-4">';
        html += '                   <input type="text" name="<?php echo $name; ?>_module[' + module_row + '][sort_order]" value="" placeholder="1" id="input-sort-order-' + module_row + '" class="form-control" />';
        html += '               </div>';
        html += '           </div>';
        html += '       </div>';
        html += '   </div>';


        html += '   </fieldset>';

        html += '   </div>';
        html += '</div>';

        $('#modules-tabs').append(html);

        $('#language-' + module_row + ' a:first').tab('show');


        <?php foreach ($languages as $language) { ?>
            $('#textarea-description-' + module_row + '-<?php echo $language['language_id']; ?>').summernote({height: 150});
        <?php } ?>

        $('#module-add').before('<li><a href="#tab-module-' + module_row + '" id="module-' + module_row + '" data-toggle="tab"><?php echo $tab_module; ?> ' + module_row + '&nbsp;&nbsp;&nbsp;<i class="fa fa-minus-circle" onClick="$(\'#modules li > a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false; "></i></a></li>');

        $('#module-' + module_row).trigger('click');

        module_row++;
    }
//-->
</script>


<?php echo $footer; ?>