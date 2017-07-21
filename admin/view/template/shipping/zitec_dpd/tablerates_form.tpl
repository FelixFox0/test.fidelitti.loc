<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a onclick="$('#form').submit();" class="btn btn-default"><?php echo $language->get('button_save'); ?></a>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><?php echo $language->get('button_cancel'); ?></a>
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
        <div class="panel panel-default">
            <div class="content">
                <div class="panel-body">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                        <div class="table-responsive">
                            <?php if(!empty($session->data['form_data']['id'])){ ?>
                            <input type="hidden" name="id" value="<?php echo $session->data['form_data']['id']; ?>"/>
                            <?php }; ?>
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td><?php echo $language->get('column_store'); ?></td>
                                    <td>
                                        <select name="store" class="form-control">
                                            <option value="0"><?php echo $config->get('config_name'); ?></option>
                                            <?php foreach ($stores as $store) { ?>
                                            <option value="<?php echo $store['store_id']; ?>"
                                            <?php if(isset($session->data['form_data']['store']) &&
                                            $session->data['form_data']['store']== $store['store_id']){ echo
                                            'selected="selected"';} ?>
                                            ><?php echo $store['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_dest_country'); ?></td>
                                    <td>
                                        <select name="dest_country" class="form-control">
                                            <option value=""></option>
                                            <?php foreach($countryModel->getCountries() as $country){ ?>
                                            <option value="<?php echo $country['iso_code_2']; ?>"
                                            <?php if(isset($session->data['form_data']['dest_country']) &&
                                            $session->data['form_data']['dest_country']==$country['iso_code_2']){ echo
                                            'selected="selected"';} ?>
                                            ><?php echo $country['name']; ?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td><?php echo $language->get('column_dest_region'); ?></td>
                                    <td>
                                        <input type="text" name="dest_region" class="form-control" value="<?php echo isset($session->data['form_data']['dest_region'])?$session->data['form_data']['dest_region']:''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_dest_postcode'); ?></td>
                                    <td>
                                        <input type="text" name="dest_postcode" class="form-control" value="<?php echo isset($session->data['form_data']['dest_postcode'])?$session->data['form_data']['dest_postcode']:''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_dpd_service'); ?></td>
                                    <td>
                                        <?php echo $dppServicesSource->getSelectHtml(array('name'=>'dpd_service')); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo $language->get('column_shipping_method_enabled'); ?></td>
                                    <td>
                                        <?php echo $yesnoSource->getSelectHtml(array('name'=>'shipping_method_enabled')); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_condition'); ?></td>
                                    <td>
                                        <?php echo $conditionSource->getSelectHtml(array('name'=>'condition')); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo $language->get('column_condition_threshold'); ?></td>
                                    <td>
                                        <input type="text" name="condition_threshold" class="form-control" value="<?php echo isset($session->data['form_data']['condition_threshold'])?$session->data['form_data']['condition_threshold']:''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_shipping_price_calculation'); ?></td>
                                    <td>
                                        <?php echo $shippingPriceSource->getSelectHtml(array('name'=>'shipping_price_calculation'));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_shipping_price_value'); ?></td>
                                    <td>
                                        <input type="text" name="shipping_price_value" class="form-control" value="<?php echo isset($session->data['form_data']['shipping_price_value'])?$session->data['form_data']['shipping_price_value']:''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_cod_surcharge_calculation'); ?></td>
                                    <td>
                                        <?php echo $codSurchargeSource->getSelectHtml(array('name'=>'cod_surcharge_calculation')); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_cod_surcharge_amount'); ?></td>
                                    <td>
                                        <input type="text" name="cod_surcharge_amount" class="form-control" value="<?php echo isset($session->data['form_data']['cod_surcharge_amount'])?$session->data['form_data']['cod_surcharge_amount']:''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $language->get('column_cod_surcharge_min_amount'); ?></td>
                                    <td>
                                        <input type="text" name="cod_surcharge_min_amount" class="form-control" value="<?php echo isset($session->data['form_data']['cod_surcharge_min_amount'])?$session->data['form_data']['cod_surcharge_min_amount']:''; ?>"/>
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
