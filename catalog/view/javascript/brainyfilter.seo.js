/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
!(function(bf, $, window) {
    if (bf && !bf.seoEnabled) {
        
        var originalInit = bf.init.bind(bf);
        
        var serializeForm = function(bfilter) {
            return bf.serializeFilterForm().replace(/(^|\?|\&)bfilter=[^&]+/, '$1' + bfilter);
        };
        
        bf.init = function() {
            originalInit();
            
            if (bf.sefParam && bf.sefValue) {
                this.addBFilterParam(serializeForm(bf.sefParam + '=' + bf.sefValue));
            }
        };
        
        $.fn.bfparam1 = function(bfparam){
            if (bfparam !== '') {
                this.each(function(){
                    var $this = $(this), attr = $this.is('[value]') ? 'value' : 'href',
                    url = $(this).attr(attr);
                    url = url.replace(new RegExp("[\?\&]+(bfilter|manufacturer_id|search|category_id|" + bf.sefParam + ")\=[^\&]+", 'g'), '');
                    url += /\?/.test(url) ? '&' : '?';
                    url += bfparam;
                    $this.attr(attr, url);
                });
            }
            return this;
        };
        
        var originalAddBFilterParam = bf.addBFilterParam.bind(bf);
        
        bf.addBFilterParam = function(bfilter) {
            //originalAddBFilterParam();
            bfilter = bfilter|| bf.serializeFilterForm();
            $('body').find('option[value^="http"]').bfparam1(bfilter);
            $(bf.selectors.paginator).find('a').bfparam1(bfilter);
        };
        
        var originalHistoryPushState = bf.historyPushState.bind(bf);
        
        bf.historyPushState = function(data, url) {
            if (data.seoUrl && bf.sefParam) {
                var bfilter = bf.sefParam + '=' + data.seoUrl;
                url = url.replace(/([\?\&])bfilter=[^&]+/, '$1' + bfilter);
                bf.addBFilterParam(serializeForm(bfilter));
            }
            originalHistoryPushState(data, url);
        };
        
        
        var originalPrepareFilterData = bf.prepareFilterData.bind(bf);
        
        bf.prepareFilterData = function(full, route) {
            
            var query = originalPrepareFilterData(full, route);
            
            if (bf.sefParam && bf.sefParam !== 'bfilter') {
                query = query.replace(new RegExp("[\?\&]+" + bf.sefParam + "\=[^&]+"), '');
                if (!query.match(/\?/)) {
                    query = query.replace('&', '?');
                }
            }
            return query;
        };
        
        var originalSendRequest = bf.sendRequest.bind(bf);
        
        bf.sendRequest = function() {
            if (bf.ajaxEnabled) {
                originalSendRequest();
            } else {
                $.get(window.location.origin + bf.baseUrl + 'index.php?route=module/brainyfilter/ajaxGetSefUrlParam&' + bf.serializeFilterForm(), 
                    function(data){
                        if (data.seoUrl) {
                            var url = window.location.origin + bf.prepareFilterData(true),
                                bfilter = bf.sefParam + '=' + data.seoUrl;
                        
                            url = url.replace(/([\?\&])bfilter=[^&]+/, '$1' + bfilter);
                            window.location.href = url;
                        } else {
                            originalSendRequest();
                        }
                    });
            }
        };
        
        bf.seoEnabled = true;
    }
})(BrainyFilter, jQuery, window);