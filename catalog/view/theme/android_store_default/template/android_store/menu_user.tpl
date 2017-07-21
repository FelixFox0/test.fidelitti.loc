<div>
	<div id="account-register-login">
		<div class="avatar"></div>
		<div class="arl-links">
			<?php if (!$logged) { ?>
			<a href="<?php echo $login; ?>" class="btn btn-link"><?php echo $text_login; ?></a> |
			<a href="<?php echo $register; ?>" class="btn btn-link"><?php echo $text_register; ?></a>				
			<?php } else { ?>
			<a href="<?php echo $account; ?>" class="btn btn-link"><?php echo $customer_name; ?></a> |
			<a href="<?php echo $logout; ?>" class="btn btn-link"><?php echo $text_logout; ?></a>
			<?php } ?>
		</div>	
	</div>
	<ul>
		<li><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a></li>
		<li><a href="#mmo-account"><?php echo $text_account; ?></a>
			<ul id="mmo-account">
				<li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
				<li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
				<li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
				<li class="menu-divider"></li>
				<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
				<li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
				<li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
				<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
				<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
				<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
				<li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
			</ul>				
		</li>	
		<li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>			
		<li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>						
	</ul>
	<div class="menu-divider"></div>
	<ul>
		<li><a href="#mmo-language"><?php echo $text_language; ?></a>
			<ul id="mmo-language" class="language-container">
			<?php echo $language; ?>
			</ul>
		</li>	
		<li><a href="#mmo-currency"><?php echo $text_currency; ?></a>
			<ul id="mmo-currency" class="currency-container">
			<?php echo $currency; ?>
			</ul>
		</li>
	</ul>
	<div class="menu-divider"></div>
	<ul>
		<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		<li><a href="#mmo-information"><?php echo $text_information; ?></a>
			<ul id="mmo-information">
				<?php foreach ($informations as $information) { ?>
				<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
				<?php } ?>
			</ul>
		</li>	
		<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
	</ul>		
</div>