<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a onclick="$('#form').submit();" class="btn btn-default"><?php echo $language->get('Create manifest'); ?></a>
            </div>
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
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?></div>
        <?php } ?>
        <?php if ($error) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error; ?></div>
        <?php } ?>
        <?php if ($notification_array) { ?>
        <?php foreach($notification_array as  $notification) { ?>
            <div class="warning"><?php echo $notification; ?></div>
        <?php } ?>
        <?php } ?>
        <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i><?php echo $success; ?></div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo $manifest; ?>" method="post" enctype="multipart/form-data" id="form">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);"/>
                            </td>
                            <td class="left" style="width: 70px;"><?php echo $language->get('Shipment id'); ?></td>
                            <td class="left" style="width: 70px;"><?php echo $language->get('Order id'); ?></td>
                            <td class="left" style="width: 200px;"><?php echo $language->get('Shipment'); ?></td>
                            <td class="left" style="width: 200px;"><?php echo $language->get('Shipment created'); ?></td>
                            <td class="left" style="width: 200px;"><?php echo $language->get('Manifest'); ?></td>
                            <td class="left" style="width: 200px;"><?php echo $language->get('Tracking'); ?></td>
                            <td class="right"><?php echo $language->get('Action'); ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="filter">
                            <td></td>
                            <td><input class="form-control" type="text" name="filter_shipment_id" value="<?php echo $filter_shipment_id; ?>"  /></td>
                            <td><input class="form-control" type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" /></td>
                            <td><input class="form-control" type="text" name="filter_shipment" value="<?php echo $filter_shipment; ?>" /></td>
                            <td><input class="form-control" type="text" name="filter_shipment_created" value="<?php echo $filter_shipment_created; ?>"  class="date"  /></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right"><a onclick="filter();" class="btn btn-default"><?php echo $language->get('Filter'); ?></a></td>
                        </tr>
                        <?php if ($shipments) { ?>
                        <?php foreach ($shipments as $shipment) { ?>
                        <tr>
                            <td style="text-align: center;"><?php if ($shipment['selected']) { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $shipment['shipment_id']; ?>" checked="checked"/>
                                <?php } else { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $shipment['shipment_id']; ?>"/>
                                <?php } ?></td>
                            <td class="left"><?php echo $shipment['shipment_id']; ?></td>
                            <td class="left"><?php echo $shipment['order_id']; ?></td>
                            <td class="left"><a
                                        href="<?php echo $shipment['print_shipment']; ?>"><?php echo $shipment['dpd_shipment_reference_number']; ?></a>
                            </td>
                            <td class="left"><?php echo $shipment['created']; ?></td>
                            <td class="left"><a
                                        href="<?php echo $shipment['print_manifest']; ?>"><?php echo (isset($manifest_list[$shipment['manifest']]['manifestName'])?$manifest_list[$shipment['manifest']]['manifestName']:$shipment['manifest']); ?></a>
                            </td>
                            <td>
                                <?php if (!empty($shipment['tracking_url'])) { ?>
                                    <a href="<?php echo $shipment['tracking_url']; ?>" target="_blank"><img src="/catalog/view/theme/default/image/delivery.gif" alt="<?php echo $language->get('Track order');?>" title="<?php echo $language->get('Track order');?>"></a>
                                <?php  } ?>
                            </td>
                            <td class="right"><?php foreach ($shipment['action'] as $action) { ?>
                                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                                <?php } ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </form>
                <div class="pagination"><?php echo $pagination; ?></div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>

<script type="text/javascript"><!--
    function filter() {
        url = 'index.php?route=dpd/shipment_list/index&token=<?php echo $token; ?>';

        var filter_order_id = $('input[name=\'filter_order_id\']').val();

        if (filter_order_id) {
            url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
        }

        var filter_shipment_id = $('input[name=\'filter_shipment_id\']').val();

        if (filter_shipment_id) {
            url += '&filter_shipment_id=' + encodeURIComponent(filter_shipment_id);
        }

        var filter_shipment = $('input[name=\'filter_shipment\']').val();

        if (filter_shipment) {
            url += '&filter_shipment=' + encodeURIComponent(filter_shipment);
        }

        var filter_manifest = $('input[name=\'filter_manifest\']').val();

        if (filter_manifest) {
            url += '&filter_manifest=' + encodeURIComponent(filter_manifest);
        }

        var filter_shipment_created = $('input[name=\'filter_shipment_created\']').val();

        if (filter_shipment_created) {
            url += '&filter_shipment_created=' + encodeURIComponent(filter_shipment_created);
        }


        location = url;
    }
    //--></script>
<script type="text/javascript">
    //-----------------------------------------
    // Confirm Actions (createManifest)
    //-----------------------------------------
    $(document).ready(function () {
        // Confirm Delete
        $('#form').submit(function () {
            if ($(this).attr('action').indexOf('createManifest', 1) != -1) {
                if (!confirm('Create manifest for selected shipments. Are you sure you want to do this?')) {
                    return false;
                }
            }
        });

    });

</script>
<script type="text/javascript"><!--

    $(document).ready(function() {
        $('.date').datetimepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    //--></script>