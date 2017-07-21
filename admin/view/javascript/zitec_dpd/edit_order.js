/**
 * Created by george.babarus on 1/15/2015.
 */

$(document).ready(function () {
    var addressForm = $('.form-horizontal');
    if (addressForm) {
        var postcodeField = $('#input-shipping-postcode');
        if (postcodeField) {
            postcodeField.before('<a id="refresh-postcode" href="#">' + dpdSearchButtons + '</a>');
            $('#refresh-postcode').bind('click', function (event) {
                event.preventDefault();
                $(postcodeField).focus();
            });
            $(postcodeField).autocomplete({
                'source': function(request, response) {
                    $.ajax({
                        url: shipmentUrl,
                        data: addressForm.serialize(),
                        dataType: 'json',
                        success: function(json) {
                            response($.map(json, function(item) {
                                return {
                                    label: item['label'],
                                    value: item['postcode']
                                }
                            }));
                        }
                    });
                },
                'select': function(item) {
                    $(postcodeField).val(item['value']);
                }
            });

        }
    }

    //connect just postcode validation for orders not placed using dpd
    if(parseInt(isDPDShippingMethod)==0){
        return true;
    }

    $('#form').submit(function (event) {
        if (dpdCheckAddressLength() === false) {
            event.preventDefault();
            dpdAlertErrorProblems();
            $("body").scrollTop($('[name="shipping_postcode"]').offset().top - 150);
        }
    });

    $('[name="shipping_address_1"], [name="shipping_address_2"]').blur(function () {
        dpdAlertErrorProblems();
    });

    $('[name="shipping_address_1"], [name="shipping_address_2"]').keyup(function () {
        keyPressUpdate();
    });

});

function dpdAlertErrorProblems() {
    $("#dpdAlertErrorProblems").remove();
    if (dpdCheckAddressLength() === false) {
        $('a[href="#tab-shipping"]').click();
        $('[name="address_2"]').after('<div style="color: red; padding: 10px;" id="dpdAlertErrorProblems">' + dpd_address_validation_length + '</div>');
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
    var $addressLength = $('[name="address_1"]').val().length + $('[name="address_2"]').val().length;
    if ($addressLength < 70) {
        return true;
    }
    return false;
}

function log(message) {
    alert(message);
}

function dpdUpdatePaymentMethods (pleaseSelect) {
    // Payment Methods
    var store = $('select[name=\'store\'] option:selected').val();
    $.ajax({
        url: store + 'index.php?route=api/payment/methods&token='+token+'&store_id=' + store,
        dataType: 'json',
        beforeSend: function() {
            $('#button-payment-address i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
            $('#button-payment-address').prop('disabled', true);
        },
        complete: function() {
            $('#button-payment-address i').replaceWith('<i class="fa fa-arrow-right"></i>');
            $('#button-payment-address').prop('disabled', false);
        },
        success: function(json) {
            if (json['error']) {
                $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            } else {
                html = '<option value="">'+pleaseSelect+'</option>';

                if (json['payment_methods']) {
                    for (i in json['payment_methods']) {
                        if (json['payment_methods'][i]['code'] == $('select[name=\'payment_method\'] option:selected').val()) {
                            html += '<option value="' + json['payment_methods'][i]['code'] + '" selected="selected">' + json['payment_methods'][i]['title'] + '</option>';
                        } else {
                            html += '<option value="' + json['payment_methods'][i]['code'] + '">' + json['payment_methods'][i]['title'] + '</option>';
                        }
                    }
                }

                $('select[name=\'payment_method\']').html(html);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

}
