<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-reward-point" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-reward-point" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="reward_point_status" id="input-status" class="form-control">
                <?php if ($reward_point_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-registration"><span data-toggle="tooltip" title="<?php echo $help_registration; ?>"><?php echo $entry_registration; ?></span></label>
            <div class="col-sm-6">
              <input type="text" name="reward_point_registration" value="<?php echo $reward_point_registration; ?>" placeholder="<?php echo $entry_registration; ?>" id="input-registration" class="form-control" />
            </div>
            <label class="col-sm-2 control-label" for="input-registration"><?php echo $entry_status; ?></label>
            <div class="col-sm-2 switch-field">
			  <?php if ($reward_point_registration_status) { ?>
				<input type="radio" id="switch_left_registration" name="reward_point_registration_status" value="1" checked />
				<label for="switch_left_registration">Да</label>
			  <?php } else { ?>
				<input type="radio" id="switch_left_registration" name="reward_point_registration_status" value="1" />
				<label for="switch_left_registration">Да</label>
			  <?php } ?>
			  <?php if (!$reward_point_registration_status) { ?>
				<input type="radio" id="switch_right_registration" name="reward_point_registration_status" value="0" checked />
				<label for="switch_right_registration">Нет</label>
			  <?php } else { ?>
				<input type="radio" id="switch_right_registration" name="reward_point_registration_status" value="0" />
				<label for="switch_right_registration">Нет</label>
			  <?php } ?>
			</div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-newsletter"><span data-toggle="tooltip" title="<?php echo $help_newsletter; ?>"><?php echo $entry_newsletter; ?></span></label>
            <div class="col-sm-6">
              <input type="text" name="reward_point_newsletter" value="<?php echo $reward_point_newsletter; ?>" placeholder="<?php echo $entry_newsletter; ?>" id="input-newsletter" class="form-control" />
            </div>
            <label class="col-sm-2 control-label" for="input-newsletter"><?php echo $entry_status; ?></label>
            <div class="col-sm-2 switch-field">
			  <?php if ($reward_point_newsletter_status) { ?>
				<input type="radio" id="switch_left_newsletter" name="reward_point_newsletter_status" value="1" checked />
				<label for="switch_left_newsletter">Да</label>
			  <?php } else { ?>
				<input type="radio" id="switch_left_newsletter" name="reward_point_newsletter_status" value="1" />
				<label for="switch_left_newsletter">Да</label>
			  <?php } ?>
			  <?php if (!$reward_point_newsletter_status) { ?>
				<input type="radio" id="switch_right_newsletter" name="reward_point_newsletter_status" value="0" checked />
				<label for="switch_right_newsletter">Нет</label>
			  <?php } else { ?>
				<input type="radio" id="switch_right_newsletter" name="reward_point_newsletter_status" value="0" />
				<label for="switch_right_newsletter">Нет</label>
			  <?php } ?>
			</div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-firstorder"><span data-toggle="tooltip" title="<?php echo $help_firstorder; ?>"><?php echo $entry_firstorder; ?></span></label>
            <div class="col-sm-6">
              <input type="text" name="reward_point_firstorder" value="<?php echo $reward_point_firstorder; ?>" placeholder="<?php echo $entry_firstorder; ?>" id="input-firstorder" class="form-control" />
            </div>
            <label class="col-sm-2 control-label" for="input-firstorder"><?php echo $entry_status; ?></label>
            <div class="col-sm-2 switch-field">
			  <?php if ($reward_point_firstorder_status) { ?>
				<input type="radio" id="switch_left_firstorder" name="reward_point_firstorder_status" value="1" checked />
				<label for="switch_left_firstorder">Да</label>
			  <?php } else { ?>
				<input type="radio" id="switch_left_firstorder" name="reward_point_firstorder_status" value="1" />
				<label for="switch_left_firstorder">Да</label>
			  <?php } ?>
			  <?php if (!$reward_point_firstorder_status) { ?>
				<input type="radio" id="switch_right_firstorder" name="reward_point_firstorder_status" value="0" checked />
				<label for="switch_right_firstorder">Нет</label>
			  <?php } else { ?>
				<input type="radio" id="switch_right_firstorder" name="reward_point_firstorder_status" value="0" />
				<label for="switch_right_firstorder">Нет</label>
			  <?php } ?>
			</div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-reviews"><span data-toggle="tooltip" title="<?php echo $help_reviews; ?>"><?php echo $entry_reviews; ?></span></label>
            <div class="col-sm-6">
              <input type="text" name="reward_point_reviews" value="<?php echo $reward_point_reviews; ?>" placeholder="<?php echo $entry_reviews; ?>" id="input-reviews" class="form-control" />
            </div>
            <label class="col-sm-2 control-label" for="input-reviews-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-2 switch-field">
			  <?php if ($reward_point_reviews_status) { ?>
				<input type="radio" id="switch_left_reviews" name="reward_point_reviews_status" value="1" checked />
				<label for="switch_left_reviews">Да</label>
			  <?php } else { ?>
				<input type="radio" id="switch_left_reviews" name="reward_point_reviews_status" value="1" />
				<label for="switch_left_reviews">Да</label>
			  <?php } ?>
			  <?php if (!$reward_point_reviews_status) { ?>
				<input type="radio" id="switch_right_reviews" name="reward_point_reviews_status" value="0" checked />
				<label for="switch_right_reviews">Нет</label>
			  <?php } else { ?>
				<input type="radio" id="switch_right_reviews" name="reward_point_reviews_status" value="0" />
				<label for="switch_right_reviews">Нет</label>
			  <?php } ?>
			</div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-reviews"><span data-toggle="tooltip" title="<?php echo $help_unsubscribe; ?>"><?php echo $entry_unsubscribe; ?></span></label>
            <div class="col-sm-10 switch-field">
			  <?php if ($reward_point_unsubscribe) { ?>
				<input type="radio" id="switch_left_unsubscribe" name="reward_point_unsubscribe" value="1" checked />
				<label for="switch_left_unsubscribe">Да</label>
			  <?php } else { ?>
				<input type="radio" id="switch_left_unsubscribe" name="reward_point_unsubscribe" value="1" />
				<label for="switch_left_unsubscribe">Да</label>
			  <?php } ?>
			  <?php if (!$reward_point_unsubscribe) { ?>
				<input type="radio" id="switch_right_unsubscribe" name="reward_point_unsubscribe" value="0" checked />
				<label for="switch_right_unsubscribe">Нет</label>
			  <?php } else { ?>
				<input type="radio" id="switch_right_unsubscribe" name="reward_point_unsubscribe" value="0" />
				<label for="switch_right_unsubscribe">Нет</label>
			  <?php } ?>
			</div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
