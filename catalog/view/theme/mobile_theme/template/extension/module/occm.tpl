<style type="text/css">
	#occm-form-container {
		min-width: <?php echo 1.1 * $z->c('occm_image_size_x') ?>px;
		background-color: white;
		padding: 1em;
		border-radius: 1em;
		overflow: hidden;
	}
	#occm-form-container #occm-button-confirm {
		max-width: 85%;
		margin-left: 1.4em;
	}
	#occm-form-container div.occm-line {
		margin: 5px;
		white-space: nowrap;
	}
	#occm-form-container img.occm-icon {
		width: 1.2em;
		height: 1.2em;
	}
	#occm-form-container div.center {
		text-align: center;
	}
	#occm-form-container input[type=text] {
		width: 85%;
		font-size: 1em;
	}
	#occm-form-container textarea {
		width: 85%;
		font-size: 1em;
		margin-left: 1.4em;
	}
	#occm-form-container input.error-in-input-text[type=text] {
		background: #FFD9D9;
	}
	#occm-form-container span.required {
		color: #F00;
	}
</style>
<div id="occm-form-container">
<div class="occm-line">
	<h3 style="text-align: center;"><?php echo $z->l('Buy one click') ?></h3>
</div>
<?php if ($productInfo) { ?>
<div class="center">
	<img src="<?php echo $productInfo['image'] ?>" title="<?php echo $productInfo['name'] ?>" alt="<?php echo $productInfo['name'] ?>">
	<h3 style="text-align: center;"><?php echo $productInfo['name'] ?></h3>
</div>
<?php } ?>
<?php if (0 < $z->c('occm_name_field')) { ?>
<div class="occm-line">
	<img class="occm-icon" alt="<?php echo $z->l('Name') ?>" src="<?php echo $z->imageUrl('name.png') ?>" />
	<input type="text" placeholder="<?php echo $z->l('Name') ?>" name="occ_customer[firstname]" size="30" />
	<?php if (1 < $z->c('occm_name_field')) { ?>
	<span class="required">*</span>
	<?php } ?>
</div>
<?php } if (0 < $z->c('occm_phone_field')) { ?>
<div class="occm-line">
	<img class="occm-icon" alt="<?php echo $z->l('Phone') ?>" src="<?php echo $z->imageUrl('tel.png') ?>" />
	<input type="text" placeholder="<?php echo $z->l('Phone') ?>" name="occ_customer[telephone]" size="30" />
	<?php if (1 < $z->c('occm_phone_field')) { ?>
	<span class="required">*</span>
	<?php } ?>
</div>
<?php } if (0 < $z->c('occm_mail_field')) { ?>
<div class="occm-line">
	<img class="occm-icon" alt="<?php echo $z->l('Mail') ?>" src="<?php echo $z->imageUrl('mail.png') ?>" />
	<input type="text" placeholder="<?php echo $z->l('Mail') ?>" name="occ_customer[email]" size="30" />
	<?php if (1 < $z->c('occm_mail_field')) { ?>
	<span class="required">*</span>
	<?php } ?>
</div>
<?php } if (0 < $z->c('occm_comment_field')) { ?>
<div class="occm-line">
	<textarea rows="4" name="occ_customer[comment]" placeholder="<?php echo $z->l('Comment') ?>"></textarea>
</div>
<?php } ?>
<div class="occm-line" style="text-align: right;">
	<input id="occm-button-confirm" type="button" value="<?php echo $z->l('Buy') ?>" class="button btn btn-primary btn-lg btn-block" />
</div>
</div>