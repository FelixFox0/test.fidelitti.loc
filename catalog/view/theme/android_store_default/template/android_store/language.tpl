<?php foreach ($languages as $language) { ?>
<?php if ($language['code'] == $code) { ?>
<li><a href="javascript:void(0);" class="language-select" name="<?php echo $language['code']; ?>"><b><?php echo $language['name']; ?></b></a></li>
<?php } else { ?>
<li><a href="javascript:void(0);" class="language-select" name="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></a></li>
<?php } ?>
<?php } ?>

<input type="hidden" name="code" value="" />
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />