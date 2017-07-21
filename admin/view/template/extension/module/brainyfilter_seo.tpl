<?php
/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
?>
<?php echo $header; ?>
<?php echo $column_left; ?>

<div id="content">
    <div class="box">
        <div class="heading page-header">
            <div class="container-fluid">
                <h1><?php echo $lang->heading_title; ?></h1>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="pull-right">
                    <a onclick="jQuery('[name=action]').val('apply');BFSEO.submitForm();" class="btn btn-success" data-toggle="tooltip" title="<?php echo $lang->button_save; ?>"><i class="fa fa-save"></i></a>
                    <a onclick="BFSEO.submitForm();" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $lang->button_save_n_close; ?>"><span class="icon"></span><i class="fa fa-save"></i></a>
                    <a onclick="location = '<?php echo $cancel; ?>';" class="btn btn-default" data-toggle="tooltip" title="<?php echo $lang->button_cancel; ?>"><i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($success) : ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>
        <?php if (count($error_warning)) : ?>
            <?php foreach ($error_warning as $err) : ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $err; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- settings block -->
    <form action="<?php echo $seoUrl; ?>" method="post" enctype="application/x-www-form-urlencoded" id="form">
        <input type="hidden" name="action" value="save" />
        <input type="hidden" name="bf" value="" />
    </form>
    <form action="" id="bf-form" class="container-fluid">
        <!-- main menu -->
        <div id="bf-adm-main-menu">
            <ul class="clearfix">
                <?php if ($legacyMode) : ?>
                <li class="tab">
                    <a href="<?php echo $bfModuleUrl; ?>">
                        <span class="icon basic"></span>
                        <?php echo $lang->text_mm_basic_settings; ?>
                    </a>
                </li>
                <li class="tab">
                    <a href="<?php if (isset($modules[0])) { echo $bfModuleUrl . '&module_id=' . $modules[0]['module_id']; } ?>">
                        <span class="icon layouts"></span>
                        <?php echo $lang->text_mm_module_instances; ?>
                    </a>
                </li>
                <li class="tab selected" data-target="#bf-adm-seo" style="padding:0;">
                    <a href="<?php echo $seoUrl; ?>">
                        <span class="icon seo"></span>
                        <?php echo $lang->top_menu_seo_urls; ?>
                    </a>
                </li>
                <?php else : ?>
                <li>
                    <div>
                        <a href="<?php echo $bfModuleUrl . '&module_id=basic'; ?>">
                            <span class="icon basic"></span>
                            <?php echo $lang->top_menu_basic_settings; ?>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon layouts"></span>
                            <?php echo $lang->top_menu_module_instances; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <?php foreach ($modules as $module) : ?>
                            <li>
                                <a href="<?php echo $bfModuleUrl . '&module_id=' . $module['module_id']; ?>">
                                    <?php echo $module['name']; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $bfModuleUrl . '&module_id=new'; ?>">
                                    <i class="fa fa-plus"></i> <?php echo $lang->top_menu_add_new_instance; ?></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="selected">
                    <div>
                        <a href="<?php echo $seoUrl; ?>">
                            <span class="icon seo"></span>
                            <?php echo $lang->top_menu_seo_urls; ?>
                        </a>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- main menu block end -->
        
        <div id="bf-adm-main-container">
            
            <!-- basic settings container -->
            <div id="bf-adm-basic-settings" class="tab-content" data-group="main" style="display:block">
                <div class="bf-panel">
                    <div class="tab-content-inner">
                        <!-- Basic section tabs -->
                        <ul class="tabs vertical clearfix">
                            <li class="tab selected" data-tab-name="basic" data-target="#bf-basic-settings"><?php echo $lang->tab_basic_settings; ?></li>
                            <li class="tab" data-tab-name="replacement_rules" data-target="#bf-replacement-rules"><?php echo $lang->tab_replacement_rules; ?></li>
                            <li class="tab" data-tab-name="replacements" data-target="#bf-replacements"><?php echo $lang->tab_replacements; ?></li>
                        </ul>
                        <!-- Containers for Filter Embedding -->
                        <div id="bf-basic-settings" class="tab-content with-border" data-group="settings">
                            <div class="bf-th-header-static"><?php echo $lang->seo_basic_settings; ?></div>
                            <p class="bf-info"><?php echo $lang->seo_basic_settings_descr; ?></p>
                            <table class="bf-adm-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-enabled"><?php echo $lang->enable_seo; ?></label></span>
                                    </td>
                                    <td class="center bf-w135">
                                        <span class="bf-switcher">
                                            <input id="bf-seo-enabled" type="hidden" name="bf[enabled]" value="0" />
                                            <span class="bf-no"></span><span class="bf-yes"></span>
                                        </span>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-transliteration"><?php echo $lang->seo_enable_transliteration; ?></label></span>
                                    </td>
                                    <td class="center">
                                        <span class="bf-switcher">
                                            <input id="bf-seo-transliteration" type="hidden" name="bf[transliteration]" value="0" />
                                            <span class="bf-no"></span><span class="bf-yes"></span>
                                        </span>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper">
                                            <label for="bf-seo-lowercase"><?php echo $lang->seo_enable_lowercase; ?></label>
                                        </span>
                                    </td>
                                    <td class="center">
                                        <span class="bf-switcher">
                                            <input id="bf-seo-transliteration" type="hidden" name="bf[lowercase]" value="0" <?php if (!$mbModuleEnabled) { echo 'disabled="disabled"'; } ?> />
                                            <span class="bf-no"></span><span class="bf-yes"></span>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!$mbModuleEnabled) : ?>
                                        <p class="bf-alert bf-sml" style="display: inherit"><?php echo $lang->seo_mb_php_module_disabled; ?></p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="bf-gray-panel">
                                <?php echo $lang->seo_friendly_url_example; ?>
                                <div class="bf-browser">
                                    <div class="bf-browser-addr-line">
                                        demo.giantleaplab.com/phones?<span 
                                            class="bf-seo-param-name">bfilter</span>=price<span 
                                            class="bf-seo-opening">[</span>100<span 
                                            class="bf-seo-range-separator">-</span>200<span 
                                            class="bf-seo-closing">]</span><span 
                                            class="bf-seo-next-filter">/</span>brand<span 
                                            class="bf-seo-opening">[</span>Apple<span 
                                            class="bf-seo-closing">]</span><span 
                                            class="bf-seo-next-filter">/</span>colour<span 
                                            class="bf-seo-opening">[</span>white<span 
                                            class="bf-seo-list-separator">,</span>black<span 
                                            class="bf-seo-closing">]</span>
                                    </div>
                                </div>
                                <?php echo $lang->seo_friendly_url_descr; ?>
                            </div>
                            <table class="bf-adm-table">
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="border:0;">
                                            <div class="bf-alert bf-url-validation-msg"></div>
                                        </td>
                                    </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-param-name-inp"><?php echo $lang->seo_filter_url_name; ?></label></span>
                                    </td>
                                    <td>
                                        <input id="bf-seo-param-name-inp" type="text" name="bf[param_name]" class="bf-w100 bf-seo-separator" />
                                    </td>
                                    <td>
                                        <p class="bf-info bf-sml"><?php echo $lang->seo_param_name_must_be_unique; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-next-filter-inp"><?php echo $lang->seo_parameters_separator; ?></label></span>
                                    </td>
                                    <td>
                                        <input id="bf-seo-next-filter-inp" type="text" name="bf[separator][next_filter]" class="bf-w100 bf-seo-separator" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label><?php echo $lang->seo_range_characters; ?></label></span>
                                    </td>
                                    <td colspan="2" style="vertical-align: top;">
                                        <div class="bf-seo-two-col-inputs">
                                            <div><?php echo $lang->seo_opening; ?></div>
                                            <input id="bf-seo-opening-inp" type="text" name="bf[separator][values_start]" class="bf-w100 bf-seo-separator" />
                                        </div>
                                        <div class="bf-seo-two-col-inputs">
                                            <div><?php echo $lang->seo_closing; ?></div>
                                            <input id="bf-seo-closing-inp" type="text" name="bf[separator][values_end]" class="bf-w100 bf-seo-separator" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-range-separator-inp"><?php echo $lang->seo_values_range_separator; ?></label></span>
                                    </td>
                                    <td>
                                        <input id="bf-seo-range-separator-inp" type="text" name="bf[separator][range_separator]" class="bf-w100 bf-seo-separator" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="bf-adm-label-td">
                                        <span class="bf-wrapper"><label for="bf-seo-list-separator-inp"><?php echo $lang->seo_values_list_separator; ?></label></span>
                                    </td>
                                    <td>
                                        <input id="bf-seo-list-separator-inp" type="text" name="bf[separator][list_separator]" value="/" class="bf-w100 bf-seo-separator" />
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Replacement Rules -->
                        <div id="bf-replacement-rules" class="tab-content with-border" data-group="settings">
                            <div class="bf-th-header-static"><?php echo $lang->seo_replacement_rules; ?></div>
                            <p class="bf-info"><?php echo $lang->seo_replacement_rules_descr; ?></p>
                            <p class="bf-info"><?php echo $lang->seo_replacement_rules_warning; ?></p>
                            <div>
                                <table class="bf-adm-table">
                                    <thead>
                                        <tr>
                                            <th class="center"><?php echo $lang->seo_replacement_target; ?></th>
                                            <th class="center"><?php echo $lang->seo_replacement_replacement; ?></th>
                                            <th class="center"><?php echo $lang->seo_replacement_description; ?></th>
                                            <th class="center">
                                                <?php echo $lang->seo_enabled; ?><br />
                                            </th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bf-enabled-rules">
                                        <tr>
                                            <td colspan="6"><?php echo $lang->seo_no_replacement_rules; ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input id="bf-target-inp" type="text" /></td>
                                            <td><input id="bf-replacement-inp" type="text" /></td>
                                            <td><textarea id="bf-description-inp"></textarea></td>
                                            <td><button class="btn" id="bf-add-seo-rule"><i class="fa fa-plus"></i> <?php echo $lang->seo_add_new_rule; ?></button></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="border: 0;">
                                                <div class="bf-alert bf-validation-rule-msg"></div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Replacements -->
                        <div id="bf-replacements" class="tab-content with-border" data-group="settings">
                            <div class="bf-th-header-static"><?php echo $lang->seo_replacements; ?></div>
                            <p class="bf-info"><?php echo $lang->seo_replacements_descr; ?></p>
                            <p class="bf-info"><?php echo $lang->seo_replacements_warning; ?></p>
                            <div>
                                <table class="bf-adm-table bf-hide-if-empty" data-select-all-group="replacements">
                                    <thead>
                                        <tr>
                                            <th><?php echo $lang->seo_term_type; ?></th>
                                            <th><?php echo $lang->seo_original_name; ?></th>
                                            <th><?php echo $lang->seo_custom_name; ?></th>
                                            <th><?php echo $lang->seo_generated_name; ?></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="seo-replacements">
                                        <tr>
                                            <td colspan="5"><?php echo $lang->seo_no_manual_replacements; ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <select class="bf-seo-term-type-select">
                                                    <option value=""><?php echo $lang->seo_select_search_in; ?></option>
                                                    <option value="a"><?php echo $lang->seo_select_attribute; ?></option>
                                                    <option value="o"><?php echo $lang->seo_select_option; ?></option>
                                                    <option value="f"><?php echo $lang->seo_select_filter; ?></option>
                                                    <option value="c"><?php echo $lang->seo_select_category; ?></option>
                                                    <option value="m"><?php echo $lang->seo_select_manufacturer; ?></option>
                                                    <option value="s"><?php echo $lang->seo_select_stock_status; ?></option>
                                                    <option value="x"><?php echo $lang->seo_select_common; ?></option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" id="bf-seo-term-search" class="bf-w165" />
                                            </td>
                                            <td>
                                                <input type="text" id="bf-seo-term-custom-name" class="bf-w165" />
                                            </td>
                                            <td>
                                                <button id="bf-add-replacement" class="btn btn-success bf-add-row" data-filter-data="" data-row-tpl="#manual-replacement-row-template" data-target-tbl="#seo-replacements">
                                                    <i class="fa fa-plus"></i> <?php echo $lang->btn_select_term; ?>
                                                </button>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="bf-signature"><?php echo $lang->bf_signature; ?></div>
    <!--                -->
</div>

<table style="display:none;">
    <tbody id="replacement-rule-row-template">
        <tr>
            <td class="bf-adm-label-td"><span class="bf-wrapper bf-rule-target">&nbsp;</span></td>
            <td class="bf-adm-label-td"><span class="bf-wrapper bf-rule-replacement">&nbsp;</span></td>
            <td class="bf-rule-description">&nbsp;</td>
            <td class="center">
                <span class="bf-switcher">
                    <input class="bf-rule-enabled" type="hidden" name="bf[rules][{i}][enabled]" value="1" />
                    <span class="bf-no"></span><span class="bf-yes"></span>
                </span>
                <input type="hidden" class="bf-rule-target-field" name="bf[rules][{i}][target]" />
                <input type="hidden" class="bf-rule-replacement-field" name="bf[rules][{i}][replacement]" />
                <input type="hidden" class="bf-rule-description-field" name="bf[rules][{i}][descr]" />
            </td>
            <td><a class="bf-remove-row"><i class="fa fa-times"></i></a></td>
            <td></td>
        </tr>
    </tbody>
</table>
<table style="display:none;">
    <tbody id="manual-replacement-row-template">
        <tr>
            <td><span class="bf-wrapper bf-seo-term-type">&nbsp;</span></td>
            <td class="bf-adm-label-td"><span class="bf-wrapper bf-seo-original-name">&nbsp;</span></td>
            <td class="bf-adm-label-td">
                <span class="bf-wrapper bf-seo-custom-name">&nbsp;</span>
                <input type="hidden" name="bf[replacements][{i}][custom_name]" class="bf-seo-custom-name-field" />
                <input type="hidden" name="bf[replacements][{i}][filter_group]" class="bf-replacement-fg-field" />
                <input type="hidden" name="bf[replacements][{i}][filter_id]" class="bf-replacement-fid-field" />
            </td>
            <td><span class="bf-wrapper bf-seo-generated-name">&nbsp;</span></td>
            <td><a class="bf-remove-row"><i class="fa fa-times"></i></a></td>
            <td>
            </td>
        </tr>
    </tbody>
</table>

<script>
var BF = BF || BrainyFilterAdm || {};
BF.lang = {
        'seo_rule_target_not_valid' : "<?php echo $lang->seo_rule_target_not_valid; ?>",
        'seo_rule_replacement_not_valid' : "<?php echo $lang->seo_rule_replacement_not_valid; ?>",
        'seo_cannot_contain_special_chars' : "<?php echo $lang->seo_cannot_contain_special_chars; ?>",
        'seo_separator_cannot_be_empty' : "<?php echo $lang->seo_separator_cannot_be_empty; ?>",
        'seo_param_name_cannot_contain' : "<?php echo $lang->seo_param_name_cannot_contain; ?>",
        'seo_cannot_match_with_next_filter_sep' : "<?php echo $lang->seo_cannot_match_with_next_filter_sep; ?>",
        'seo_term_type_a' : "<?php echo $lang->seo_select_attribute; ?>",
        'seo_term_type_o' : "<?php echo $lang->seo_select_option; ?>",
        'seo_term_type_f' : "<?php echo $lang->seo_select_filter; ?>",
        'seo_term_type_av' : "<?php echo $lang->seo_select_attribute_value; ?>",
        'seo_term_type_ov' : "<?php echo $lang->seo_select_option_value; ?>",
        'seo_term_type_fv' : "<?php echo $lang->seo_select_filter_value; ?>",
        'seo_term_type_rv' : "<?php echo $lang->seo_select_rating_value; ?>",
        'seo_term_type_c' : "<?php echo $lang->seo_select_category; ?>",
        'seo_term_type_m' : "<?php echo $lang->seo_select_manufacturer; ?>",
        'seo_term_type_s' : "<?php echo $lang->seo_select_stock_status; ?>",
        'seo_term_type_x' : "<?php echo $lang->seo_select_common; ?>",
    };
BFSEO.settings = <?php echo json_encode($settings); ?>;
BFSEO.autocompleteUrl = '<?php echo $autocompleteUrl; ?>';
BFSEO.legacyMode = <?php echo $legacyMode ? 'true' : 'false'; ?>;
jQuery(document).ready(function(){ BFSEO.init(); });
</script>
<style>
    .bf-def:before {
        content: '<?php echo $lang->default; ?>';
    }
    .bf-no:before {
        content: '<?php echo $lang->no; ?>';
    }
    .bf-yes:before {
        content: '<?php echo $lang->yes; ?>';
    }
    .bf-disable-enable .bf-no:before {
        content: '<?php echo $lang->disable_all; ?>';
    }
    .bf-disable-enable .bf-yes:before {
        content: '<?php echo $lang->enable_all; ?>';
    }
</style>
<?php echo $footer;