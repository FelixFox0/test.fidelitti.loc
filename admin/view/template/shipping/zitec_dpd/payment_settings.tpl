<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a onclick="$('#form').submit();" class="btn btn-default"><?php echo $button_save; ?></a>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><?php echo $button_cancel; ?></a>
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
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i><?php echo $success; ?></div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="content">
                <div class="panel-body">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td><?php echo $language->get('Store switcher'); ?></td>
                                    <td>
                                        <select name="store" id="store_switcher" class="form-control">
                                            <option value="0"
                                                    link="<?php echo $url->link('shipping/zitec_dpd/payment_settings', 'token=' . $session->data['token'], 'SSL'); ?>"><?php echo $config->get('config_name') . $language->get('- default values'); ?>
                                            </option>
                                            <?php foreach ($stores as $store) { ?>
                                            <option value="<?php echo $store['store_id']; ?>"
                                                    link="<?php echo $url->link('shipping/zitec_dpd/payment_settings', 'token=' . $session->data['token'].'&store_id='.$store['store_id'], 'SSL'); ?>"
                                            <?php if(isset($session->data['form_data']['store']) &&
                                            $session->data['form_data']['store']== $store['store_id']){ echo
                                            'selected="selected"';} ?>
                                            ><?php echo $store['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $method_title_label; ?></td>
                                    <td>
                                        <input type="text" name="payment[method_title]" class="form-control" value="<?php echo $dpd_settings_model->getPaymentSettings('method_title'); ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $dpd_enabled_label; ?></td>
                                    <td>
                                        <select name="payment[dpd_enabled]" class="form-control">
                                            <option value="1"
                                            <?php echo ($dpd_settings_model->getPaymentSettings('dpd_enabled')=="1"?'
                                            selected="selected" ':''); ?> ><?php echo $language->get('Yes'); ?></option>
                                            <option value="0"
                                            <?php echo ($dpd_settings_model->getPaymentSettings('dpd_enabled')=="0"?'
                                            selected="selected" ':''); ?> ><?php echo $language->get('No'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $description_label; ?></td>
                                    <td>
                                        <textarea type="text" name="payment[description]" class="form-control"><?php echo $dpd_settings_model->getPaymentSettings('description'); ?></textarea>
                                    </td>
                                </tr>


                                <tr>
                                    <td><?php echo $language->get('Payment type'); ?></td>
                                    <td>
                                        <?php echo $paymentTypeSource->
                                        getSelectHtml(array('name'=>'payment[cod_surcharge_calculation]'),
                                        $dpd_settings_model->getPaymentSettings('cod_surcharge_calculation') ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('Payment method on delivery'); ?></td>
                                    <td>
                                        <?php echo $paymentMethodsSource->
                                        getSelectHtml(array('name'=>'payment[cod_methods]'),
                                        $dpd_settings_model->getPaymentSettings('cod_methods') ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo  $language->get('Payment amount'); ?></td>
                                    <td>
                                        <input type="text" name="payment[cod_surcharge_amount]" class="form-control" value="<?php echo $dpd_settings_model->getPaymentSettings('cod_surcharge_amount'); ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo  $language->get('Cash On Delivery Surcharge minimum amount'); ?></td>
                                    <td>
                                        <input type="text" name="payment[cod_surcharge_min_amount]" class="form-control" value="<?php echo $dpd_settings_model->getPaymentSettings('cod_surcharge_min_amount'); ?>"/>
                                    </td>
                                </tr>


                                <tr>
                                    <td><?php echo $dpd_services; ?></td>
                                    <td>
                                        <?php echo $dppServicesSource->getMultiSelectHtml(array('name'=>'payment[dpd_services]'),
                                        $dpd_settings_model->getPaymentSettings('dpd_services') ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><h2><?php echo $language->get('Payment method labels') ; ?></h2></td>
                                </tr>
                                <?php $services = $dppServicesSource->getOptions(); ?>
                                <?php foreach ($services as $serviceId => $service) : ?>
                                <tr>
                                    <td><?php echo $service .$language->get(' - payment service title on frontend') ; ?></td>
                                    <td>
                                        <input type="text" name="payment[dpd_service_<?php echo $serviceId; ?>]" class="form-control" value="<?php echo $dpd_settings_model->getPaymentSettings('dpd_service_'.$serviceId); ?>"/>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td><?php echo $language->get('Checkout total title for DPD surcharge'); ?></td>
                                    <td>
                                        <input type="text" name="payment[cod_subtotal_title]" class="form-control" value="<?php echo $dpd_settings_model->getPaymentSettings('cod_subtotal_title'); ?>"/>
                                    </td>
                                </tr>


                            </table>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#store_switcher').change(function () {
            window.location = $('#store_switcher option[value="' + $(this).val() + '"]').attr('link');
        });
    });

</script>
