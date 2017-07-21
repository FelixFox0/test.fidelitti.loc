<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $insert; ?>" class="btn btn-default"><?php echo $language->get('button_insert'); ?></a>
                <a onclick="$('form').submit();" class="btn btn-default"><?php echo $language->get('button_delete'); ?></a>
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
        <?php if ($error) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error; ?></div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i><?php echo $success; ?></div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="content">
                <div class="panel-body">
                    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);"/>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_store'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_dest_country'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_dest_region'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_dest_postcode'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_dpd_service'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_shipping_method_enabled'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_condition'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_condition_threshold'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_shipping_price_calculation'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_shipping_price_value'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_cod_surcharge_calculation'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_cod_surcharge_amount'); ?>
                                    </td>
                                    <td class="left">
                                        <?php echo $language->get('column_cod_surcharge_min_amount'); ?>
                                    </td>
                                    <td class="right"><?php echo $language->get('column_action'); ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($rates) && count($rates)) { ?>
                                <?php foreach ($rates as $rate) { ?>
                                <tr>
                                    <td class="text-center"><?php if (!empty($rate['selected'])) { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $rate['id']; ?>"
                                               checked="checked"/>
                                        <?php } else { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $rate['id']; ?>"/>
                                        <?php } ?></td>
                                    <td class="left"><?php echo $rate['store']; ?></td>
                                    <td class="left"><?php echo $rate['dest_country']; ?></td>
                                    <td class="left"><?php echo $rate['dest_region']; ?></td>
                                    <td class="left"><?php echo $rate['dest_postcode']; ?></td>
                                    <td class="left"><?php echo $dppServicesSource->getById( $rate['dpd_service'] ); ?></td>
                                    <td class="left"><?php echo $yesnoSource->getById($rate['shipping_method_enabled']); ?></td>
                                    <td class="left"><?php echo $conditionSource->getById($rate['condition']); ?></td>
                                    <td class="left"><?php echo $rate['condition_threshold']; ?></td>
                                    <td class="left"><?php echo $shippingPriceSource->getById($rate['shipping_price_calculation']);
                                        ?>
                                    </td>
                                    <td class="left"><?php echo $rate['shipping_price_value']; ?></td>
                                    <td class="left"><?php echo $codSurchargeSource->getById($rate['cod_surcharge_calculation']);
                                        ?>
                                    </td>
                                    <td class="left"><?php echo $rate['cod_surcharge_amount']; ?></td>
                                    <td class="left"><?php echo $rate['cod_surcharge_min_amount']; ?></td>
                                    <td class="right">
                                        <?php if(!empty($rate['action'])){ ?>
                                        <?php foreach ($rate['action'] as $action) { ?>
                                         <a style="cursor: pointer" <?php echo !empty($action['href'])?'href="'.$action['href'].'"':''; ?>
                                        <?php echo isset($action['onclick'])? 'onclick="'.$action['onclick'].'"':''; ?>>
                                        <?php echo $action['text']; ?>
                                        </a>
                                        <br>
                                        <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="15"><?php echo $language->get('text_no_results'); ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>