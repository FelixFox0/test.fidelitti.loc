<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <div class="buttons">
                    <a href="<?php echo $cancel; ?>" class="btn btn-default"><?php echo $language->get('button_cancel'); ?></a>
                </div>
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
        <div class="panel-body">
            <div class="well">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2><?php echo $language->get('Shipping Settings'); ?></h2>
                        <p><?php echo $language->get('shipping_settings_details')!=
                            'shipping_settings_details'?$language->get('shipping_settings_details'):''; ?></p>
                        <a href="<?php echo $test; ?>" class="btn btn-default"><?php echo $language->get('Shipping Settings'); ?></a>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
                <!-- IT IS NOT RELEASED YET
                <div>
                    <h2><?php echo $language->get('Sender Settings'); ?></h2>

                    <p><?php echo $language->get('sender_settings_details')!=
                        'sender_settings_details'?$language->get('sender_settings_details'):''; ?></p>
                    <a href="<?php echo $sender_settings_url; ?>" class="button"><?php echo $language->get('Sender
                        Settings'); ?></a>
                    <br/>
                    <br/>
                    <br/>
                </div>
                -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2><?php echo $language->get('Payment settings'); ?></h2>
                        <p><?php echo $language->get('payment_settings_details')!=
                            'payment_settings_details'?$language->get('payment_settings_details'):''; ?></p>
                        <a href="<?php echo $payment_settings_url; ?>" class="btn btn-default"><?php echo $language->get('Payment
                            settings'); ?></a>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2><?php echo $language->get('Table Rates'); ?></h2>
                        <p><?php echo $language->get('table_rates_details')!=
                            'table_rates_details'?$language->get('table_rates_details'):''; ?></p>
                        <a href="<?php echo $table_rates_url; ?>" class="btn btn-default"><?php echo $language->get('Table Rates');
                            ?></a>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2><?php echo $language->get('Upgrade to a newer version'); ?></h2>
                        <p><?php echo $language->get('upgrade_details')!=
                            'upgrade_details'?$language->get('upgrade_details'):''; ?></p>
                        <a href="<?php echo $upgrade_url; ?>" class="btn btn-default"><?php echo $language->get('Upgrade now');
                            ?></a>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2><?php echo $language->get('text_shipment'); ?></h2>
                        <p><?php echo $language->get('shipping_details')!=
                            'shipping_details'?$language->get('shipping_details'):''; ?></p>
                        <a class="btn btn-default" href="<?php echo $dpd_shipment_list_index; ?>"><?php echo $text_shipment; ?></a>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $footer; ?>