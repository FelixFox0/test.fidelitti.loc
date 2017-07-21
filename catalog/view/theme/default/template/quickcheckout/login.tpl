<div id="login">
  <div class="col-sm-6 text-left">
	<label class="col-sm-3" for="input-login-email"><?php echo $entry_email; ?></label>
	<div class="col-sm-9">
	  <input type="text" name="email" value="" class="form-control" id="input-login-email" />
	</div>
  </div>
  <div class="col-sm-6 text-left">
	<label class="col-sm-3" for="input-login-password"><?php echo $entry_password; ?></label>
	<div class="col-sm-9">
	  <div class="input-group">
		<input type="password" name="password" value="" class="form-control" />
		<span class="input-group-btn">
		  <input type="button" value="<?php echo $button_login; ?>" id="button-login" class="btn btn-primary" />
		</span>
	  </div>
	</div>
  </div>
</div>

<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-login').click();
	}
});
//--></script>   