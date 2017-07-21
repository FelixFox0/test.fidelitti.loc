/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
(function($, BF){
    var BFSEO = {
        settings : {},
        init : function() {
            BF.$elem = $('#bf-form');
            BF.fillForm(BF.$elem, this.settings);
            $(this.settings.rules).each(function(){
                var rule = this;
                BFSEO.addRule(rule.target, rule.replacement, rule.descr, rule.enabled);
            });
            $(this.settings.replacements).each(function(){
                var repl = this;
                BFSEO.addReplacement(repl.filter_group, repl.filter_id, repl.orig_name, repl.name, repl.custom_name);
            });
            this.updateUrlSample();
            this.initTermAutocomplete();
            BF.initTabs($('#bf-adm-main-container'));
            BF.initSwitchers();
            $('#bf-add-seo-rule').on('click', function(){ 
                if (!BFSEO.validateRule()) {
                    return false;
                }
                var $tf = $('#bf-target-inp'),
                    $rf = $('#bf-replacement-inp'),
                    $df = $('#bf-description-inp')
                BFSEO.addRule($tf.val(), $rf.val(), $df.val(), 1); 
                $tf.val('');
                $rf.val('');
                $df.val('');
                return false; 
            });
            $('#bf-add-replacement').on('click', function(){
                var data = $('#bf-seo-term-search').data('selectedTerm'),
                    customName = $('#bf-seo-term-custom-name').val();
                if (data && customName) {
                    BFSEO.addReplacement(data.filter_group, data.filter_id, data.name, data.gen_name, customName);
                    $('#bf-seo-term-custom-name').val('');
                    $('#bf-seo-term-search').data('selectedTerm', null).val('');
                }
                return false;
            });
            $(document).on('click', '.bf-remove-row', BF.removeRow);
            $('.bf-seo-separator').on('keyup', this.updateUrlSample);
            $('.bf-seo-separator').on('change', this.validateUrlSeparators);
        },
        
        updateUrlSample : function() {
            $('.bf-seo-param-name').text($('#bf-seo-param-name-inp').val());
            $('.bf-seo-next-filter').text($('#bf-seo-next-filter-inp').val());
            $('.bf-seo-opening').text($('#bf-seo-opening-inp').val());
            $('.bf-seo-closing').text($('#bf-seo-closing-inp').val());
            $('.bf-seo-range-separator').text($('#bf-seo-range-separator-inp').val());
            $('.bf-seo-list-separator').text($('#bf-seo-list-separator-inp').val());
        },
        
        validateUrlSeparators : function() {
            var success = true,
                nf = $('#bf-seo-next-filter-inp').val(),
                rs = $('#bf-seo-range-separator-inp').val(),
                ls = $('#bf-seo-list-separator-inp').val();
            
            $('.bf-seo-separator').each(function(){
                var val = $(this).val();
                if (val.match(/[\?\=\&]/)) {
                    $('.bf-url-validation-msg').text(BF.lang.seo_cannot_contain_special_chars).show();
                    success = false;
                    return false;
                }
                if (val === '' && !$(this).is('#bf-seo-closing-inp')) {
                    $('.bf-url-validation-msg').text(BF.lang.seo_separator_cannot_be_empty).show();
                    success = false;
                    return false;
                }
            });
            if (!success) {
                return false;
            }
            if ($('#bf-seo-param-name-inp').val().match(/[^0-9a-z_]/i)) {
                $('.bf-url-validation-msg').text(BF.lang.seo_param_name_cannot_contain).show();
                return false;
            }
            
            if (rs.indexOf(nf) !== -1 || ls.indexOf(nf) !== -1) {
                $('.bf-url-validation-msg').text(BF.lang.seo_cannot_match_with_next_filter_sep).show();
                return false;
            }
            $('.bf-url-validation-msg').text('').hide();
            return true;
        },
        
        addRule : function(target, replacement, description, enabled) {
            var $tbl = $('#bf-replacement-rules tbody'),
                $row = $($('#replacement-rule-row-template').html().split('{i}').join($tbl.find('tr').size() - 1));
                
            $row.find('.bf-rule-target').html(target + '&nbsp;');
            $row.find('.bf-rule-replacement').html(replacement + '&nbsp;');
            $row.find('.bf-rule-description').html(description);
            $row.find('.bf-rule-target-field').val(target);
            $row.find('.bf-rule-replacement-field').val(replacement);
            $row.find('.bf-rule-description-field').val(description);
            $row.find('.bf-switcher input[type=hidden]').val(enabled);
            $row.insertBefore($tbl.find('tr').last());
        },
        
        validateRule : function() {
            var t = $('#bf-target-inp').val(),
                r = $('#bf-replacement-inp').val();
                
            $('.bf-validation-rule-msg').hide();
            
            if (t === '') {
                $('.bf-validation-rule-msg').text(BF.lang.seo_rule_target_not_valid).show();
                return false;
            }
            if (r.match(/[\&\?\s]/)) {
                $('.bf-validation-rule-msg').text(BF.lang.seo_rule_replacement_not_valid).show();
                return false;
            }
            return true;
        },
        
        addReplacement : function(gid, id, name, genName, customName) {
            id = parseInt(id);
            var $tbl = $('#bf-replacements tbody'),
                $row = $($('#manual-replacement-row-template').html().split('{i}').join($tbl.find('tr').size() - 1)),
                lang = 'seo_term_type_' + gid[0] + (['a','o','f','r'].indexOf(gid[0]) !== -1 && id ? 'v' : '');
        
            if (['m','s','p','r','c','k'].indexOf(gid[0]) !== -1 && !id) {
                lang = 'seo_term_type_x';
            }
            $row.find('.bf-seo-term-type').html(BF.lang[lang]);
            $row.find('.bf-seo-original-name').html(name);
            $row.find('.bf-seo-generated-name').html(genName);
            $row.find('.bf-seo-custom-name').html(customName);
            $row.find('.bf-replacement-fg-field').val(gid);
            $row.find('.bf-replacement-fid-field').val(id);
            $row.find('.bf-seo-custom-name-field').val(customName);
            $row.insertBefore($tbl.find('tr').last());
        },
        
        initTermAutocomplete : function() {
            $('#bf-seo-term-search').autocomplete({
                minChars: 0,
                lookup: function(request, response) {
                    $.ajax({
                        url: BFSEO.autocompleteUrl.split('&amp;').join('&'),
                        data: {type : $('.bf-seo-term-type-select').val(), query : request},
                        dataType: 'json',
                        success: function(json) {
                            response({
                                'query' : request,
                                'suggestions' : $.map(json, function(item) {
                                        return {
                                            value: item.name,
                                            data: item
                                        };
                                    })
                            });
                        }
                    });
                },
                onSelect: function (suggestion) {
                    $(this).data('selectedTerm', suggestion.data);
                }
            });
        },
        
        submitForm : function(e) {
            if (e) {
                e.preventDefault();
            }
            if (!this.validateUrlSeparators()) {
                return;
            }

            var data = BF._convertFormToObj(BF.$elem);

            $('#form [name=bf]').val(JSON.stringify(data));
            $('#form').submit();
        }
    };
    
    window['BFSEO'] = BFSEO;
})(jQuery, BF);
