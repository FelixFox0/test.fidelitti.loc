<?php echo $header; ?>
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <button type="button" class="close close_login" data-dismiss="alert">×</button> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="large-12 my_account__block"><?php echo $content_top; ?>
<div class="my_account__bg large-12">
  <h1>МОЯ УЧЕТНАЯ ЗАПИСЬ</h1>
</div>
<div class="large-12 my_account__welcome">
  ДОБРО ПОЖАЛОВАТЬ
</div>
<div class="my-account__list">
    <ul class="tabs" data-tabs id="example-tabs">
  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"><?php echo $text_my_account; ?></a></li>
  <li class="tabs-title"><a href="#panel2"><?php echo $text_my_orders; ?></a></li>
  <li class="tabs-title"><a href="#panel3"><?php echo $text_my_newsletter; ?></a></li>
</ul>
</div>
<div class="tabs-content" data-tabs-content="example-tabs">
  <div class="tabs-panel is-active" id="panel1">
      <div class="row collapse my-account-ajax">
        <div class="medium-3 columns">
          <ul class="vertical tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true"><?php echo $text_edit; ?></a></li>
            <li class="tabs-title"><a href="#panel2v"><?php echo $text_password; ?></a></li>
            <li class="tabs-title"><a href="#panel3v"><?php echo $text_address; ?></a></li>
            <li class="tabs-title"><a href="#panel4v"><?php echo $text_wishlist; ?></a></li>
          </ul>
        </div>
        <div class="medium-9 columns">
          <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1v"></div>
            <div class="tabs-panel" id="panel2v"></div>
            <div class="tabs-panel" id="panel3v"></div>
            <div class="tabs-panel" id="panel4v"></div>
            <div class="tabs-panel" id="panel5v"></div>
            <div class="tabs-panel" id="panel6v"></div>
          </div>
        </div>
      </div>
  </div>
  <div class="tabs-panel" id="panel2">
      <div class="row collapse my-account-ajax">
  <div class="medium-3 columns">
    <ul class="vertical tabs" data-tabs id="example-tabs">
      <li class="tabs-title is-active"><a href="#panel12v" aria-selected="true"><?php echo $text_order; ?></a></li>
      <li class="tabs-title"><a href="#panel7v"><?php echo $text_download; ?></a></li>
      <?php if ($reward) { ?>
      <li class="tabs-title"><a href="#panel8v"><?php echo $text_reward; ?></a></li>
      <?php } ?>
      <li class="tabs-title"><a href="#panel9v"><?php echo $text_return; ?></a></li>
      <li class="tabs-title"><a href="#panel10v"><?php echo $text_transaction; ?></a></li>
      <li class="tabs-title"><a href="#panel11v"><?php echo $text_recurring; ?></a></li>
    </ul>
  </div>
  <div class="medium-9 columns">
    <div class="tabs-content" data-tabs-content="example-tabs">
      <div class="tabs-panel is-active" id="panel12v"></div>
      <div class="tabs-panel" id="panel7v"></div>
      <div class="tabs-panel" id="panel8v"></div>
      <div class="tabs-panel" id="panel9v"></div>
      <div class="tabs-panel" id="panel10v"></div>
      <div class="tabs-panel" id="panel11v"></div>
    </div>
  </div>
</div>



  </div>
  <div class="tabs-panel" id="panel3">
      <div class="row collapse my-account-ajax">
  <div class="medium-3 columns">
    <ul class="vertical tabs" data-tabs id="example-tabs">
      <li class="tabs-title is-active"><a href="#panel13v" aria-selected="true"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
  <div class="medium-9 columns">
    <div class="tabs-content" data-tabs-content="example-tabs">
      <div class="tabs-panel is-active" id="panel13v"></div>
    </div>
  </div>
</div>
  </div>
</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<ol id="new-projects"></ol>
 
<script>
$( "#panel1v" ).load( "/index.php?route=account/simpleedit #content" );
$( "#panel2v" ).load( "/change-password/ #content" );
$( "#panel3v" ).load( "/address-book/ #content" );
$( "#panel4v" ).load( "/wishlist/ #content" );
//my orders
$( "#panel12v" ).load( "/order-history/ #content" );
$( "#panel7v" ).load( "/downloads/ #content" );
$( "#panel8v" ).load( "/reward-points/ #content" );
$( "#panel9v" ).load( "/returns/ #content" );
$( "#panel10v" ).load( "/transactions/ #content" );
$( "#panel11v" ).load( "/index.php?route=account/recurring #content" );
//
$( "#panel13v" ).load( "/newsletter/ #content" );
</script>
<?php echo $footer; ?> 