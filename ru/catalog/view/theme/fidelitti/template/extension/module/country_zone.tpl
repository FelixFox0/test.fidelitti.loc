<div class="simplecheckout-block" id="simplecheckout_country_zone" <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>
    <div class="checkout-heading panel-heading"><?php echo $heading_title ?></div>
    <div class="simplecheckout-block-content">
        <fieldset class="form-horizontal">
            <div class="form-group required">
                <label class="control-label col-sm-3" for=""><?php echo $entry_country; ?></label>
                <div class="col-sm-9">
                    <select class="form-control" name="cz_country_id" id="cz_country_id">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($countries as $country) { ?>
                        <?php if ($country['country_id'] == $cz_country_id) { ?>
                        <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if ($error_country && $display_error) { ?>
                    <span class="error"><?php echo $error_country; ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group required">
                <label class="control-label col-sm-3" for=""><?php echo $entry_zone; ?></label>
                <div class="col-sm-9">
                    <select class="form-control" name="cz_zone_id" id="cz_zone_id">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($zones as $zone) { ?>
                        <?php if ($zone['zone_id'] == $cz_zone_id) { ?>
                        <option value="<?php echo $zone['zone_id']; ?>" selected="selected"><?php echo $zone['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if ($error_zone && $display_error) { ?>
                    <span class="error"><?php echo $error_zone; ?></span>
                    <?php } ?>
                </div>
            </div>
           <!-- <div class="form-group required">
                <label class="control-label col-sm-3" for=""><?php echo $entry_city; ?></label>
                <div class="col-sm-9">
                    <input  class="form-control"name="cz_city" id="cz_city" value="<?php echo $cz_city ?>">
                    <?php if ($error_city && $display_error) { ?>
                    <span class="error"><?php echo $error_city; ?></span>
                    <?php } ?>
                </div>
            </div> -->
        </fieldset>
    </div>
</div>
<script type="text/javascript">
function copyAddressToSimple() {
    jQuery('#payment_address_country_id').val(jQuery('#cz_country_id').val());
    jQuery('#shipping_address_country_id').val(jQuery('#cz_country_id').val());
    jQuery('#payment_address_zone_id').val(jQuery('#cz_zone_id').val());
    jQuery('#shipping_address_zone_id').val(jQuery('#cz_zone_id').val());
    jQuery('#payment_address_city').val(jQuery('#cz_city').val());
    jQuery('#shipping_address_city').val(jQuery('#cz_city').val());
    reloadAll();
}

jQuery(function(){
    jQuery('#cz_country_id').change(function() {
        jQuery('#cz_zone_id').load('index.php?route=module/country_zone/zone&cz_country_id=' + jQuery(this).val(), function(data){
            jQuery('#payment_address_zone_id').html(data);
            jQuery('#shipping_address_zone_id').html(data);
            copyAddressToSimple();
        });
    });

    jQuery('#cz_zone_id').change(function() {
        copyAddressToSimple();
    });

    jQuery('#cz_city').change(function() {
        copyAddressToSimple();
    });
});
</script>