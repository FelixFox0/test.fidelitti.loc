<?php foreach ($currencies as $currency) { ?>
<?php if ($currency['symbol_left']) { ?>
	<?php if ($currency['code'] == $code) { ?>
		<li><a href="javascript:void(0);" class="currency-select" name="<?php echo $currency['code']; ?>"><b><?php echo $currency['symbol_left']; ?> <?php echo $currency['title']; ?></b></a></li>
	<?php } else { ?>
		<li><a href="javascript:void(0);" class="currency-select" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_left']; ?> <?php echo $currency['title']; ?></a></li>
	<?php } ?>		
<?php } else { ?>
	<?php if ($currency['code'] == $code) { ?>
		<li><a href="javascript:void(0);" class="currency-select" name="<?php echo $currency['code']; ?>"><b><?php echo $currency['symbol_right']; ?> <?php echo $currency['title']; ?></b></a></li>
	<?php } else { ?>
		<li><a href="javascript:void(0);" class="currency-select" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_right']; ?> <?php echo $currency['title']; ?></a></li>
	<?php } ?>	
<?php } ?>
<?php } ?>

<input type="hidden" name="code" value="" />
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
