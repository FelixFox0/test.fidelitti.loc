/**
 * Created by george.babarus on 1/15/2015.
 */

$(document).ready(function () {


    var listenForChanges = function(event) {
        var fields = ['address_1', 'address_2', 'city', 'country_id', 'zone_id'];
        var target = $(event.target);
        if($.inArray( target.attr('name'), fields) >= 0){
            checkForChanges(target, fields);
        }
    };

    function checkForChanges(target, fields) {
        var section = getSection(target);
        //remove address 2 because is not required and it's not marked in any way
        var required_fields = fields;
        var index = $.inArray('address_2', required_fields);
        if(index > -1) {
            required_fields.splice(index, 1);
        }
        var all_completed = true;
        var jqueryFields = [];
        $(required_fields).each(function(index, item) {
            var field = $('[name=' + item  +']', section);
            if(field.val() === '') {
                all_completed = false;
            }
            jqueryFields.push(field);
        });
        if(all_completed) {
            jqueryFields.push($('[name=address_2]', section));
            triggerPostcodeAutocomplete(section, jqueryFields);
        }
    }
    function triggerPostcodeAutocomplete(section, fields) {
        var field = $('[name=postcode]', section);
        if(field) {
            setupAutocompleter(fields, field);
            var e = jQuery.Event( "keydown" );
            e.keyCode = 50;
            // trigger an artificial click event
            $(field).trigger( e );
        }
    }

    function setupAutocompleter(fields, field) {
        if($(field).data('postcode-autocomplete') !== true) {
            $(field).autocomplete({
                source: function (request, response) {
                    var formData = {};
                    $(fields).each(function (index, item) {
                        formData[$(item).attr('name')] = $(item).val();
                    });
                    $.ajax({
                        url: shipmentUrl,
                        data: $.param(formData),
                        success: function (data) {
                            //$('.content').loadingOverlay('remove');
                            data = jQuery.parseJSON(data);
                            if (data.length !== 0) {
                                response(data);
                            }
                        }
                    });
                },
                error: function (request, status, error) {
                    $('.content').loadingOverlay('remove');
                },
                minLength: 0,
                select: function (item) {
                    $(field).val(item.postcode);
                    var e = jQuery.Event( "keydown" );
                    e.keyCode = 27;
                    // trigger an artificial click event
                    $(field).trigger( e );
                }
            });
            $(field).data('postcode-autocomplete', true);
        }
    }
    function getSection(target) {
        var sections = ['collapse-payment-address', 'collapse-shipping-address'];
        var section = null;
        $(sections).each(function(index, item) {
            if(target.parents('#' + item).length == 1) {
                section = item;
            }
        });
        if(section !== null) {
            return $('#' + section);
        } else {
            return $('body');
        }
    }

    $(document).on("change", 'body :input', listenForChanges);

});


function dpdAlertErrorProblems() {
    $("#dpdAlertErrorProblems").remove();
    if (dpdCheckAddressLength() === false) {
        $('a[href="#tab-shipping"]').click();
        $('[name="shipping_address_2"]').after('<div style="color: red; padding: 10px;" id="dpdAlertErrorProblems">' + dpd_address_validation_length + '</div>');
        $('#dpdAlertErrorProblems').fadeOut("slow");
        $('#dpdAlertErrorProblems').fadeIn("slow");
    }
}


function keyPressUpdate() {
    if (dpdCheckAddressLength() === true) {
        $("#dpdAlertErrorProblems").remove();
    }
}


function dpdCheckAddressLength() {
    var $addressLength = $('[name="shipping_address_1"]').val().length + $('[name="shipping_address_2"]').val().length;
    if ($addressLength < 70) {
        return true;
    }
    return false;
}

function log(message) {
    alert(message);
}

