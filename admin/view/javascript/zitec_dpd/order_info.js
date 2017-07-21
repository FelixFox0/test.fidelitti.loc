/**
 * Created by george.babarus on 1/9/2015.
 */

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1] || 0;
    }
}

$(document).ready(function () {
    /*$('#tab-shipments-button').click(function (e) {
        var order_id = ($.urlParam('order_id'));
        $('.content').loadingOverlay();

        $.post("/admin/index.php?route=dpd/shipment/shipment_info&order_id=" + order_id + "&token=" + $.urlParam('token'),
            {
                order_id: order_id
            },
            function (data, status) {
                $('.content').loadingOverlay('remove');

                data = JSON.parse(data);
                if (status == 'success') {
                    $('#tab-shipment-management').html(data.content);
                }
            });
    });*/

});
