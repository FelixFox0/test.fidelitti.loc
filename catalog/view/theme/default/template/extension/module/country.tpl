<div class="simplecheckout-block" id="simplecheckout_country" <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>
    <div class="checkout-heading panel-heading"><?php echo $heading_title ?></div>
    <div class="simplecheckout-block-content">
        <fieldset class="form-horizontal">
            <div class="form-group required">
                <label class="control-label col-sm-3" for=""><?php echo $entry_country; ?></label>
                <div class="col-sm-9">
                    <select class="form-control" name="c_country_id" id="c_country_id">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($countries as $country) { ?>
                        <?php if ($country['country_id'] == $c_country_id) { ?>
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
            
        </fieldset>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#c_country_id').on('change', function() {
            $('#payment_address_country_id').val($('#c_country_id').val());
            $('#shipping_address_country_id').val($('#c_country_id').val());
            reloadAll();
        });
    });
</script>