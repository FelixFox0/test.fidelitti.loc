<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php $z('button_save') ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $z->url->link('extension/module','token='.$z->session->data['token'],'SSL') ?>" data-toggle="tooltip" title="<?php $z('button_cancel') ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php $z('text_edit') ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $z->url->link('extension/module/occm','token='.$z->session->data['token'],true) ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-occm_status"><?php $z('Status:') ?></label>
            <div class="col-sm-10">
              <select name="occm_status" id="input-occm_status" class="form-control">
                <?php if ($occm_status) { ?>
                <option value="1" selected="selected"><?php $z('text_enabled') ?></option>
                <option value="0"><?php $z('text_disabled') ?></option>
                <?php } else { ?>
                <option value="1"><?php $z('text_enabled') ?></option>
                <option value="0" selected="selected"><?php $z('text_disabled') ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-occm_name_field"><?php $z('Name field:') ?></label>
              <div class="col-sm-10">
                <select name="occm_name_field" id="input-occm_name_field" class="form-control">
                  <option value="0" <?php echo $occm_name_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_disabled') ?>
                  </option>
                  <option value="1" <?php echo 1 != $occm_name_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_enabled') ?>
                  </option>
                  <option value="2" <?php echo 2 != $occm_name_field ? '' : 'selected="selected"' ?>>
                    <?php $z('Required') ?>
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-occm_phone_field"><?php $z('Phone field:') ?></label>
              <div class="col-sm-10">
                <select name="occm_phone_field" id="input-occm_phone_field" class="form-control">
                  <option value="0" <?php echo $occm_phone_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_disabled') ?>
                  </option>
                  <option value="1" <?php echo 1 != $occm_phone_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_enabled') ?>
                  </option>
                  <option value="2" <?php echo 2 != $occm_phone_field ? '' : 'selected="selected"' ?>>
                    <?php $z('Required') ?>
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-occm_mail_field"><?php $z('Mail field:') ?></label>
              <div class="col-sm-10">
                <select name="occm_mail_field" id="input-occm_mail_field" class="form-control">
                  <option value="0" <?php echo $occm_mail_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_disabled') ?>
                  </option>
                  <option value="1" <?php echo 1 != $occm_mail_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_enabled') ?>
                  </option>
                  <option value="2" <?php echo 2 != $occm_mail_field ? '' : 'selected="selected"' ?>>
                    <?php $z('Required') ?>
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-occm_comment_field"><?php $z('Comment field:') ?></label>
              <div class="col-sm-10">
                <select name="occm_comment_field" id="input-occm_comment_field" class="form-control">
                  <option value="0" <?php echo $occm_comment_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_disabled') ?>
                  </option>
                  <option value="1" <?php echo 1 != $occm_comment_field ? '' : 'selected="selected"' ?>>
                    <?php $z('text_enabled') ?>
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-occm_order_status_id">
                <span data-toggle="tooltip" title="" data-original-title="<?php $z('order_status_help') ?>"><?php $z('Order status:') ?>
                </span>
              </label>
              <div class="col-sm-10">
                <select name="occm_order_status_id" id="input-occm_order_status_id" class="form-control">
                <?php foreach ($z->m('localisation/order_status')->getOrderStatuses() as $orderStatus) { ?>
                  <?php if ($orderStatus['order_status_id'] == $occm_order_status_id) { ?>
                    <option value="<?php echo $orderStatus['order_status_id']; ?>" selected="selected"><?php echo $orderStatus['name']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $orderStatus['order_status_id']; ?>"><?php echo $orderStatus['name']; ?></option>
                  <?php } ?>
                <?php } ?>
                </select>
              </div>
            </div>
               
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-occm_image_size_x">
               <span data-toggle="tooltip" title="" data-original-title="<?php $z('image_size_help') ?>">
                <?php $z('Image size:') ?>
              </span>
            </label>
            <div class="col-sm-10">
              <input type="text" name="occm_image_size_x" value="<?php echo $occm_image_size_x; ?>" id="input-occm_image_size_x" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-occm_image_size_y">
               <span data-toggle="tooltip" title="" data-original-title="<?php $z('image_size_help') ?>">
                <?php $z('Image size:') ?>
              </span>
            </label>
            <div class="col-sm-10">
              <input type="text" name="occm_image_size_y" value="<?php echo $occm_image_size_y; ?>" id="input-occm_image_size_y" class="form-control" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>