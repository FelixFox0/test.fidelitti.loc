<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a
                href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/shipping.png" alt=""/> <?php echo $heading_title; ?></h1>

            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a
                        href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">
                    <tr>
                        <td><?php echo $language->get('Store switcher'); ?></td>
                        <td>
                            <select name="store" id="store_switcher">
                                <option value="0"
                                        link="<?php echo $url->link('shipping/zitec_dpd/sender_settings', 'token=' . $this->session->data['token'], 'SSL'); ?>"><?php echo $config->get('config_name') . $language->get('- default values'); ?>
                                </option>
                                <?php foreach ($stores as $store) { ?>
                                <option value="<?php echo $store['store_id']; ?>"
                                        link="<?php echo $url->link('shipping/zitec_dpd/sender_settings', 'token=' . $this->session->data['token'].'&store_id='.$store['store_id'], 'SSL'); ?>"
                                <?php if(isset($this->session->data['form_data']['store']) &&
                                $this->session->data['form_data']['store']== $store['store_id']){ echo
                                'selected="selected"';} ?>
                                ><?php echo $store['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br/>
                <table class="form">
                    <tr>
                        <td><?php echo $sender_name_label; ?></td>
                        <td>
                            <input type="text" name="sender[sender_name]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('sender_name'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $additional_name_label; ?></td>
                        <td>
                            <input type="text" name="sender[additional_name]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('additional_name'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $street_label; ?></td>
                        <td>
                            <input type="text" name="sender[street]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('street'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $city_name_label; ?></td>
                        <td>
                            <input type="text" name="sender[city]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('city'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $postcode_label; ?></td>
                        <td>
                            <input type="text" name="sender[postcode]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('postcode'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $country_label; ?></td>
                        <td>
                            <input type="text" name="sender[country]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('country'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $telephone_label; ?></td>
                        <td>
                            <input type="text" name="sender[telephone]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('telephone'); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td><?php echo $email_address_label; ?></td>
                        <td>
                            <input type="text" name="sender[email_address]"
                                   value="<?php echo $dpd_settings_model->getSenderSettings('email_address'); ?>"/>
                        </td>
                    </tr>

                </table>
            </form>
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
