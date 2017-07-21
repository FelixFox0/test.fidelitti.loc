<form action="<?php echo $action_general; ?>">
<div class="form-group">
    <label class="col-sm-2 control-label" for="input-license"><?php echo $entry_set_zone; ?></label>

    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="geoip_setting[set_zone]" value="1"
                    <?php echo !empty($geoip_setting['set_zone']) ? ' checked="checked"' : ''; ?>/>
            <?php echo $text_yes; ?>
        </label>
        <label class="radio-inline">
            <input type="radio" name="geoip_setting[set_zone]" value="0"
                    <?php echo empty($geoip_setting['set_zone']) ? ' checked="checked"' : ''; ?>/>
            <?php echo $text_no; ?>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="input-license"><?php echo $entry_from_ajax; ?></label>

    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="geoip_setting[from_ajax]" value="1"
                    <?php echo !empty($geoip_setting['from_ajax']) ? ' checked="checked"' : ''; ?>/>
            <?php echo $text_yes; ?>
        </label>
        <label class="radio-inline">
            <input type="radio" name="geoip_setting[from_ajax]" value="0"
                    <?php echo empty($geoip_setting['from_ajax']) ? ' checked="checked"' : ''; ?>/>
            <?php echo $text_no; ?>
        </label>
    </div>
</div>
</form>