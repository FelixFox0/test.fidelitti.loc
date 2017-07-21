<div id="modal-quicksignup" class="modal">
	<div class="modal-dialog" id="modal-quicksignups">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="setCookie" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="modal-quicksignup__logo"><img src="/image/catalog/logo.png" title="Мой Магазин" alt="Мой Магазин" class="img-responsive"></div>
			</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-6 coupon_promo" id="quick-register">
					<h2 class="modal-title"><?php echo $text_new_customer ?></h2>
					<span class="coupon_promo__desc"><?php echo $text_details; ?></span>
					<div class="form-group required large-5 coupon_promo__form">
						<input type="text" name="name" placeholder="<?php echo $entry_name; ?>" value="" id="input-name" class="form-control" />
					</div>
					<div class="form-group required large-5 coupon_promo__form">
						<input type="text" name="email" placeholder="<?php echo $entry_email; ?>" value="" id="input-email" class="form-control" />
					</div>
					<div class="form-group required large-5 coupon_promo__form">
						<input type="text" name="telephone" placeholder="<?php echo $entry_telephone; ?>" value="" id="input-telephone" class="form-control" />
					</div>
					<div class="form-group required large-5 coupon_promo__form">
						<input type="password" name="password" placeholder="<?php echo $entry_password; ?>" value="" id="input-password" class="form-control" />
					</div>
					<?php if ($text_agree) { ?>
					<div class="coupon_promo__buttons">
					  <div class="pull-right">
						<input type="checkbox" name="agree" value="1" />&nbsp;<span><?php echo $text_agree; ?></span>
						<button type="button" class="btn btn-primary coupon_promo__createaccount createaccount"  data-loading-text="<?php echo $text_loading; ?>" ><?php echo $button_continue; ?></button>
					  </div>
					</div>
					<?php }else{ ?>
					<div class="buttons">
						<div class="pull-right">
							<button type="button" class="btn btn-primary coupon_promo__createaccount createaccount" data-loading-text="<?php echo $text_loading; ?>" ><?php echo $button_continue; ?></button>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<style>
.quick_signup{
	cursor:pointer;
}
#modal-quicksignup .form-control{
	height:auto;
}</style>

<script type="text/javascript"><!--
$(document).delegate('.quick_signup', 'click', function(e) {
	$('#modal-quicksignup').modal('show');
});
//--></script>
<script type="text/javascript"><!--
$('#quick-register input').on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#quick-register .createaccount').trigger('click');
	}
});
$('#quick-register .createaccount').click(function() {
	$.ajax({
		url: 'index.php?route=common/quicksignup/register',
		type: 'post',
		data: $('#quick-register input[type=\'text\'], #quick-register input[type=\'password\'], #quick-register input[type=\'checkbox\']:checked'),
		dataType: 'json',
		beforeSend: function() {
			$('#quick-register .createaccount').button('loading');
			$('#modal-quicksignup .alert-danger').remove();
		},
		complete: function() {
			$('#quick-register .createaccount').button('reset');
		},
		success: function(json) {
			$('#modal-quicksignup .form-group').removeClass('has-error');
			
			if(json['islogged']){
				 window.location.href="index.php?route=account/account";
			}
			if (json['error_name']) {
				$('#quick-register #input-name').parent().addClass('has-error');
				$('#quick-register #input-name').focus();
			}
			if (json['error_email']) {
				$('#quick-register #input-email').parent().addClass('has-error');
				$('#quick-register #input-email').focus();
			}
			if (json['error_telephone']) {
				$('#quick-register #input-telephone').parent().addClass('has-error');
				$('#quick-register #input-telephone').focus();
			}
			if (json['error_password']) {
				$('#quick-register #input-password').parent().addClass('has-error');
				$('#quick-register #input-password').focus();
			}
			if (json['error']) {
				$('#modal-quicksignup .modal-header').after('<div class="alert alert-danger" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}
			
			if (json['now_login']) {
				$('.quick-login').before('<li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li><li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li><li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li><li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li><li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li></ul></li>');
				
				$('.quick-login').remove();
			}
			if (json['success']) {
				$('#modal-quicksignup .main-heading').html(json['heading_title']);
				success = json['text_message'];
				success += '<div class="buttons"><div class="text-center"><a onclick="loacation();" class="btn btn-primary coupon_promo__createaccount_link">'+ json['button_continue'] +'</a></div></div>';
				$('#modal-quicksignup .modal-body').html(success);
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#quick-login input').on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#quick-login .loginaccount').trigger('click');
	}
});
$('#quick-login .loginaccount').click(function() {
	$.ajax({
		url: 'index.php?route=common/quicksignup/login',
		type: 'post',
		data: $('#quick-login input[type=\'text\'], #quick-login input[type=\'password\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#quick-login .loginaccount').button('loading');
			$('#modal-quicksignup .alert-danger').remove();
		},
		complete: function() {
			$('#quick-login .loginaccount').button('reset');
		},
		success: function(json) {
			$('#modal-quicksignup .form-group').removeClass('has-error');
			if(json['islogged']){
				 window.location.href="index.php?route=account/account";
			}
			
			if (json['error']) {
				$('#modal-quicksignup .modal-header').after('<div class="alert alert-danger" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				$('#quick-login #input-email').parent().addClass('has-error');
				$('#quick-login #input-password').parent().addClass('has-error');
				$('#quick-login #input-email').focus();
			}
			if(json['success']){
				loacation();
				$('#modal-quicksignup').modal('hide');
			}
			
		}
	});
});
//--></script>
<script type="text/javascript"><!--
function loacation() {
	location.reload();
}
//--></script>