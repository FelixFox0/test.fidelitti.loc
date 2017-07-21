<?php echo $header; ?>
<div class="container top-extra-space bottom-extra-space">
	<nav id="top-extra" class="navbar navbar-fixed-top Fixed">
		<div class="container">
			<div class="row">
				<div class="col-xs-2">
					<div class="pull-center">
						<a href="<?php echo $back; ?>" class="btn btn-link history-back"><i class="fa fa-angle-left"></i></a>
					</div>	
				</div>		
				<div class="col-xs-8">
					<div class="pull-center">
						<a href="javascript:void(0);" class="btn btn-link page-title"><?php echo $heading_title; ?></a>
					</div>	
				</div>		
				<div class="col-xs-2">
					<div class="pull-center">
						<a href="" class="btn btn-link"><i class="fa"></i></a>
					</div>	
				</div>		
			</div>
		</div>
	</nav>

  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
		<div id="account-list">
			  <div class="heading-title m-bottom-10"><span><?php echo $text_my_account; ?></span></div>
			  <div class="list-group">
				<a href="<?php echo $edit; ?>" class="list-group-item"><?php echo $text_edit; ?></a>
				<a href="<?php echo $password; ?>" class="list-group-item"><?php echo $text_password; ?></a>
				<a href="<?php echo $address; ?>" class="list-group-item"><?php echo $text_address; ?></a>
			  </div>
			  
			  <?php if ($credit_cards) { ?>
			  <h2><?php echo $text_credit_card; ?></h2>
			  <ul class="list-unstyled">
				<?php foreach ($credit_cards as $credit_card) { ?>
				<li><a href="<?php echo $credit_card['href']; ?>"><?php echo $credit_card['name']; ?></a></li>
				<?php } ?>
			  </ul>
			  <?php } ?>			  
			  
			  <div class="heading-title m-bottom-10"><span><?php echo $text_my_orders; ?></span></div>
			  <div class="list-group">
				<a href="<?php echo $order; ?>" class="list-group-item"><?php echo $text_order; ?></a>
				<a href="<?php echo $download; ?>" class="list-group-item"><?php echo $text_download; ?></a>
				<?php if ($reward) { ?>
				<a href="<?php echo $reward; ?>" class="list-group-item"><?php echo $text_reward; ?></a>
				<?php } ?>
				<a href="<?php echo $return; ?>" class="list-group-item"><?php echo $text_return; ?></a>
				<a href="<?php echo $transaction; ?>" class="list-group-item"><?php echo $text_transaction; ?></a>
				<a href="<?php echo $recurring; ?>" class="list-group-item"><?php echo $text_recurring; ?></a>
			  </div>
			  
			  <div class="heading-title m-bottom-10"><span><?php echo $text_my_newsletter; ?></span></div>
			  <div class="list-group">
				<a href="<?php echo $newsletter; ?>" class="list-group-item"><?php echo $text_newsletter; ?></a>
			  </div>
		</div>	  
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>