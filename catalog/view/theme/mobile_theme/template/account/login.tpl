<?php echo $header; ?>
<div class="row login-page">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i><button type="button" class="close close_login" data-dismiss="alert">×</button> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><button type="button" class="close close_login" data-dismiss="alert">×</button> <?php echo $error_warning; ?></div>
  <?php } ?>
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="large-12 column login-page__auth"><?php echo $content_top; ?>
        <div class="large-5">
          <div class="well">
           <!-- <h4><?php echo $text_returning_customer; ?></h4>-->
            <div class="login-page__auth--desc"><?php echo $text_i_am_returning_customer; ?></div>
            <form action="<?php echo $action; ?>" class="login__form" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
                <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
                <input type="password" name="password" value="<?php echo $password; ?>" id="input-password" class="form-control" />
                <a href="<?php echo $forgotten; ?>" class="forgotten" ><?php echo $text_forgotten; ?></a></div>
              <input type="submit" value="<?php echo $button_login; ?>" class="btn btn-primary forgotten_bnt" />
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
          </div>
        </div>
        <div class="large-5">
          <div class="well">
            <h4><?php echo $text_new_customer; ?></h4>
            <p><?php echo $text_register_account; ?></p>
            <dl>
              <dt>
                  <span><i class="iconfendi-email"></i></span>
                  Получайте новостную рассылку Fidelitti
              </dt>
              <dt>
                  <span><i class="iconfendi-wishlist"></i></span>
                  Создайте Список желаний
              </dt>
            </dl>
            <a href="<?php echo $register; ?>" class="btn btn-primary login__reg-btn">
              <?php echo $text_register; ?>              
            </a>
          </div>
        </div> 
      </div>
</div>
<div class="product-line"></div>
<div class="row" style="margin-top: 31px">
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>