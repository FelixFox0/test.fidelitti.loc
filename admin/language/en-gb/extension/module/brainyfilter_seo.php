<?php
/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com 
 */ 

// SEO
$_['heading_title']                         = 'Brainy Filter <b style="color: #fff;background:#848484;border-radius:0.3em;padding: 0 0.3em;">SEO Plugin</b>';
$_['heading_title_text']                    = 'Brainy Filter SEO';
$_['bf_heading_title']                      = 'Brainy Filter';
$_['message_success_save']                  = 'Success: You have modified Brainy Filter SEO module!';
$_['brainyfilter_not_istalled']             = 'The Brainy Filter extension is not installed';
$_['top_menu_seo_urls']                     = 'SEO settings<span class="help">Search engine friendly URLs settings</span>';
$_['tab_basic_settings']                    = 'Basic Settings'; 
$_['tab_replacement_rules']                 = 'Replacement Rules'; 
$_['tab_replacements']                      = 'Replacements'; 
$_['seo_urls']                              = 'SEO settings';
$_['seo_basic_settings']                    = 'Basic settings';
$_['enable_seo']                            = '<b>Enable SEO URLs</b>';
$_['seo_enable_transliteration']            = '<b>Enable Transliteration</b><span class="help">All the non-latin letters will be replaced with their respective latin alternatives. All the non-letter characters and spaces will be replaced with low dashes</span>';
$_['seo_enable_lowercase']                  = '<b>Put words to lowercase</b><span class="help">If the setting is disabled, all the words in URL will be the same case as the original ones</span>';
$_['seo_mb_php_module_disabled']            = 'Seems like the <a href="http://php.net/manual/en/book.mbstring.php">Multibyte String PHP module</a> is disabled on your web-server. The module is mandatory for the option to work. Please contact your hoster in order to enable the module.';
$_['name_value_separator']                  = '<b>Name/Value separator in URLs</b><span class="help">The selected symbol will be used to separate a name of an attribute, option or a filter from its value</span>';
$_['range_separator']                       = '<b>Range separator in URLs</b><span class="help">The selected symbol will be used to separate minimum and maximum values of a range</span>';
$_['seo_basic_settings_descr']              = 'Here you can enable the SEO plugin and do basic configuration of how it forms URLs of Brainy Filter. Live preview of the final URL format is available below.';
$_['seo_replacement_rules']                 = 'Replacement Rules';
$_['seo_replacement_rules_descr']           = 'In this section you can create custom rules in order to replace all occurrancies of certain symbols or sets of symbols with other symbols';
$_['seo_replacement_rules_warning']         = '<i>After</i> the custom rules defined below are applied the module processes names and values of URL parameters to make sure valid URLs are generated. For instance, it translates non-latin characters into latin, removes any non-URL complient symbols, etc.';
$_['seo_replacement_target']                = 'Target';
$_['seo_replacement_replacement']           = 'Replacement';
$_['seo_replacement_description']           = 'Description';
$_['seo_enabled']                           = 'Enabled';
$_['seo_no_replacement_rules']              = 'No rules';
$_['seo_add_new_rule']                      = 'Add New Rule';
$_['seo_rule_target_not_valid']             = 'Rule target cannot be blank';
$_['seo_rule_replacement_not_valid']        = 'Replacement cannot contain symbols &, ? and spaces';
$_['seo_replacements']                      = 'Replacements';
$_['seo_replacements_descr']                = 'In this section you can replace all occurrencies of certain symbols or sets of symbols with other symbols for particular attributes, options, or OpenCart filters.';
$_['seo_replacements_warning']               = '<i>After</i> the custom rules defined below are applied the module processes names and values of URL parameters to make sure valid URLs are generated. For instance, it translates non-latin characters into latin, removes any non-URL complient symbols, etc.';
$_['btn_select_term']                       = 'Select Term';
$_['seo_autocomplete_hint']                 = 'Start typing the name of the term you would like to change, click its name and then press the “%s” button';
$_['seo_term_type']                         = 'Term type';
$_['seo_original_name']                     = 'Original name';
$_['seo_generated_name']                    = 'Generated SEO name';
$_['seo_custom_name']                       = 'Custom SEO name';
$_['seo_no_manual_replacements']            = 'No manual replacements';
$_['seo_friendly_url_example']              = 'Sample search engine friendly URL according to the current settings';
$_['seo_friendly_url_descr']                = 'Use the settings below to change the format of the URL generated by Brainy Filter';
$_['seo_filter_url_name']                   = '<b>Filter URL name</b>';
$_['seo_parameters_separator']              = '<b>Parameters separator</b>';
$_['seo_range_characters']                  = '<b>Opening and closing characters</b><span class="help">The opening character is inserted after a parameter name and before its value (multiple values), the closing character is added after the value (values) and is optional</span>';
$_['seo_values_range_separator']            = '<b>Values range separator in URLs</b><span class="help">The chosen character will be used to separate minimum and maximum values of a range</span>';
$_['seo_values_list_separator']             = '<b>Values list separator in URLs</b><span class="help">The chosen character will be used when a list of values is used</span>';
$_['seo_opening']                           = 'Opening';
$_['seo_closing']                           = 'Closing';
$_['seo_param_name_must_be_unique']         = 'This parameter must be unique for your URL';
$_['seo_cannot_contain_special_chars']      = 'Such characters as ?, &, = are reserved characters of URL syntax, thus can\'t be used as separators. Please make sure any separator below doesn\'t contain these characters';
$_['seo_param_name_cannot_contain']         = 'Filter URL name cannot contain other characters than alphabet characters, digits and low dash ( _ )';
$_['seo_separator_cannot_be_empty']         = 'All the separator fields except the Closing one are mandatory and can\'t be blank';
$_['seo_cannot_match_with_next_filter_sep'] = 'The Parameters separator can\'t be equal or be a substring of values list separator or values range separator';
$_['seo_select_search_in']                  = '- Any type -';
$_['seo_select_attribute']                  = 'Attribute';
$_['seo_select_attribute_value']            = 'Attribute value';
$_['seo_select_option']                     = 'Option';
$_['seo_select_option_value']               = 'Option value';
$_['seo_select_filter']                     = 'Filter';
$_['seo_select_filter_value']               = 'Filter value';
$_['seo_select_category']                   = 'Category';
$_['seo_select_manufacturer']               = 'Brand';
$_['seo_select_stock_status']               = 'Stock Status';
$_['seo_select_common']                     = 'Common Term';
$_['seo_select_keywords']                   = 'Keywords';
$_['seo_select_price']                      = 'Price';
$_['seo_select_rating']                     = 'Rating';
$_['seo_select_rating_value']               = 'Rating value';
$_['seo_select_rating_1']                   = 'Rating: Aweful';
$_['seo_select_rating_2']                   = 'Rating: Poor';
$_['seo_select_rating_3']                   = 'Rating: Fair';
$_['seo_select_rating_4']                   = 'Rating: Good';
$_['seo_select_rating_5']                   = 'Rating: Excelent';
$_['seo_duplicates_found_warning']          = '<b>Warning!</b> Some of filters in your store have duplicated values which may lead to unpredictable work of the filter. Please resolve the conflicts by removing duplicates from your attributes/options/filters or by manual renaming them on the Replacements tab.<br> The following filters contain duplicates:';
$_['seo_filter_has_duplicates']             = '<br>- %s "<b>%s</b>" has multiple "<b>%s</b>" values';
$_['seo_section_has_duplicates']            = '<br>- There is more than one %s with name "<b>%s</b>"';
$_['seo_filter_duplicate']                  = '<br>- Multiple attributes/filters/options in your store have name "<b>%s</b>"';
