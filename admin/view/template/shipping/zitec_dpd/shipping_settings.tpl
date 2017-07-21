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
                                    <option value="0" link="<?php echo $url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL'); ?>">
                                        <?php echo $config->get('config_name') . $language->get('- default values'); ?>
                                    </option>
                                    <?php foreach ($stores as $store) { ?>
                                    <option value="<?php echo $store['store_id']; ?>"
                                            link="<?php echo $url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'].'&store_id='.$store['store_id'], 'SSL'); ?>"
                                    <?php if(isset($this->session->data['form_data']['store']) &&
                                    $this->session->data['form_data']['store']== $store['store_id']){ echo
                                    'selected="selected"';} ?>
                                    ><?php echo $store['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $method_title_label; ?></td>
                            <td>
                                <input type="text" name="shipping[method_title]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('method_title'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $dpd_enabled_label; ?></td>
                            <td>
                                <select name="shipping[dpd_enabled]" class="form-control">
                                    <option value="1"
                                    <?php echo ($dpd_settings_model->getShippingSettings('dpd_enabled')=="1"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('Yes'); ?></option>
                                    <option value="0"
                                    <?php echo ($dpd_settings_model->getShippingSettings('dpd_enabled')=="0"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('No'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $postcode_autocomplete_label; ?></td>
                            <td>
                                <select name="shipping[postcode_autocomplete]" class="form-control">
                                    <option value="1"
                                    <?php echo ($dpd_settings_model->getShippingSettings('postcode_autocomplete')=="1"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('Yes'); ?></option>
                                    <option value="0"
                                    <?php echo ($dpd_settings_model->getShippingSettings('postcode_autocomplete')=="0"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('No'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $zitecdpd_mode_label; ?></td>
                            <td>
                                <select name="shipping[zitecdpd_mode]" class="form-control">
                                    <option value="1"
                                    <?php echo ($dpd_settings_model->getShippingSettings('zitecdpd_mode')=="1"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('Yes'); ?></option>
                                    <option value="0"
                                    <?php echo ($dpd_settings_model->getShippingSettings('zitecdpd_mode')=="0"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('No'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $debug_label; ?></td>
                            <td>
                                <select name="shipping[debug]" class="form-control">
                                    <option value="1"
                                    <?php echo ($dpd_settings_model->getShippingSettings('debug')=="1"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('Yes'); ?></option>
                                    <option value="0"
                                    <?php echo ($dpd_settings_model->getShippingSettings('debug')=="0"?'
                                    selected="selected" ':''); ?> ><?php echo $language->get('No'); ?></option>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <td><?php echo $debug_file_label; ?></td>
                                <td>
                                    <input type="text" name="shipping[debugfile]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('debugfile'); ?>"/>
                                </td>
                            </tr>
                        <tr>
                            <td><?php echo $wsurlproduction_label; ?></td>
                            <td>
                                <input type="text" name="shipping[wsurl_production]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('wsurl_production'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $wsurltest_label; ?></td>
                            <td>
                                <input type="text" name="shipping[wsurl_test]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('wsurl_test'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $ws_username_label; ?></td>
                            <td>
                                <input type="text" name="shipping[ws_username]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('ws_username'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $ws_password_label; ?></td>
                            <td>
                                <input type="text" name="shipping[ws_password]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('ws_password'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $ws_connection_timeout_label; ?></td>
                            <td>
                                <input type="text" name="shipping[ws_connection_timeout]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('ws_connection_timeout'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $payer_id_label; ?></td>
                            <td>
                                <input type="text" name="shipping[payer_id]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('payer_id'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $sender_id_label; ?></td>
                            <td>
                                <input type="text" name="shipping[sender_id]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('sender_id'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $dpd_services; ?></td>
                            <td>
                                <?php echo $dppServicesSource->getMultiSelectHtml(array('name'=>'shipping[dpd_services]'),
                                $dpd_settings_model->getShippingSettings('dpd_services') ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $dpd_services_predict; ?></td>
                            <td>
                                <input type="hidden" name="shipping[dpd_services_predict]" value="-"/>
                                <?php echo $dppServicesSource->getMultiSelectHtml(array('name'=>'shipping[dpd_services_predict]'),
                                $dpd_settings_model->getShippingSettings('dpd_services_predict') ); ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><h2><?php echo $language->get('Service Frontend Labels') ; ?></h2></td>
                        </tr>
                        <?php $services = $dppServicesSource->getOptions(); ?>
                        <?php foreach ($services as $serviceId => $service) : ?>
                        <tr>
                            <td><?php echo $service .$language->get(' - service title on frontend') ; ?></td>
                            <td>
                                <input type="text" name="shipping[dpd_service_<?php echo $serviceId; ?>]" class="form-control" value="<?php echo $dpd_settings_model->getShippingSettings('dpd_service_'.$serviceId); ?>"/>
                            </td>
                        </tr>
                            <?php endforeach; ?>
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
