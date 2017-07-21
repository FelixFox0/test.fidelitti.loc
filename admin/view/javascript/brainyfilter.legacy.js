/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
;(function(BF, $){
    "use strict";
    
    var origInitSwitchers = BF.initSwitchers.bind(BF);
    
    BF.initSwitchers = function() {
        $('.bf-layout-enable .bf-def').remove();
        $('#bf-form').on('click', '.bf-switcher', function(e){
            var $choice = $(e.target),
                $switch = $(this),
                $input  = $switch.find('input').first(),
                val = $choice.is('.bf-no') ? 0 : ($choice.is('.bf-yes') ? 1 : 2);
            if (!$input.is('[disabled]')) {
                $input.val(val).change();
                $switch.find('span').removeClass('bf-active');
                $choice.addClass('bf-active');
            }
        });
        $('.bf-switcher').each(function(){
            var $switch = $(this),
                val = ~~$switch.find('input').first().val(),
                active = val === 0 ? '.bf-no' : (val === 1) ? '.bf-yes' : '.bf-def';
                $switch.find(active).addClass('bf-active');
        });
    };
    
    BF.removeRow = function() {
        var $tbl = $(this).closest('table');
        $(this).closest('tr').remove();
        BF.hideEmptyTables($tbl);
    };
    
    var origFillForm = BF.fillForm.bind(BF);
    
    BF.fillForm = function(form, settingsObj) {
        var settings = BF._convertToFormNames(settingsObj);
        for (var name in settings) {
            var field = form.find('[name="bf'+name+'"]');
            if (field.size()) {
                var type = field.eq(0).attr('type') ? field.eq(0).attr('type').toLowerCase() : '';
                var tag  = field.eq(0).prop('tagName').toLowerCase();
                if (type === 'text' || type === 'hidden' || tag === 'select') {
                    field.val(settings[name]);
                } else if (type === 'radio' || type === 'checkbox') {
                    field.filter('[value="'+settings[name]+'"]').attr('checked', 'checked');
                }
            } else {
//                console.log(name + ' - not found');
            }
        }
    };
        
})(BrainyFilterAdm, jQuery);

var BF = BF || BrainyFilterAdm;
