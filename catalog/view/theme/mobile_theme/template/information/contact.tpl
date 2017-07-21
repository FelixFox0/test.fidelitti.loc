<?php echo $header; ?>
<div class="breadcrumbs"></div>


<div class="row clientService"> 
    <div class="large-12 clientService__title">
        <?php echo $heading_title; ?>            
    </div>
    <div class="large-12 clientService__left">
        <?php echo $column_left; ?>

        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
        <?php } ?>           
    </div>
    <div class="clientService__right--formtitle"><?php echo $text_contact; ?></div>
    <div class="clientService__right--formdesc">
     Мы будем реагировать на каждое письмо в течение 24 рабочих часов, с понедельника по пятницу.
    </div>
    <div id="content" class="large-12 clientService__right">
        <?php echo $content_top; ?>
        <div class="clientService__right--click" id="faq">
      <?php if ($locations) { ?>
      <h3><?php echo $text_store; ?></h3>
      <div class="panel-group" id="accordion">
        <?php foreach ($locations as $location) { ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
            <div class="panel-body">
              <div class="row">
                <?php if ($location['image']) { ?>
                <div class="col-sm-3"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
                <?php } ?>
                <div class="col-sm-3"><strong><?php echo $location['name']; ?></strong><br />
                  <address>
                  <?php echo $location['address']; ?>
                  </address>
                  <?php if ($location['geocode']) { ?>
                  <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=<?php echo $geocode_hl; ?>&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                  <?php } ?>
                </div>
                <div class="col-sm-3"> <strong><?php echo $text_telephone; ?></strong><br>
                  <?php echo $location['telephone']; ?><br />
                  <br />
                  <?php if ($location['fax']) { ?>
                  <strong><?php echo $text_fax; ?></strong><br>
                  <?php echo $location['fax']; ?>
                  <?php } ?>
                </div>
                <div class="col-sm-3">
                  <?php if ($location['open']) { ?>
                  <strong><?php echo $text_open; ?></strong><br />
                  <?php echo $location['open']; ?><br />
                  <br />
                  <?php } ?>
                  <?php if ($location['comment']) { ?>
                  <strong><?php echo $text_comment; ?></strong><br />
                  <?php echo $location['comment']; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <!-- Скрипт плавного открытия и закрытия блока -->
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
       <input type="button" class="email_but" value="ЭЛЕКТРОННАЯ ПОЧТА" onClick="fs()">
       <input type="button" class="email_order" value="НОМЕР ЗАКАЗА" onClick="f()">
        <fieldset>
          <div class="form-group required contact__email">
             <div class="col-sm-10" id="orderbox" style="display: none;"">
              <label>Введите номер Вашего заказа</label>
              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
            <div class="col-sm-10">
              <label><?php echo $entry_email; ?></label>
              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <div class="col-sm-10">
              <label><?php echo $entry_name; ?></label>
              <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>   
          <div class="form-group required">
            <div class="col-sm-10">
              <label><?php echo $entry_lastname; ?></label>
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" id="input-lastname" class="form-control" />
              <?php if ($error_lastname) { ?>
              <div class="text-danger"><?php echo $error_lastname; ?></div>
              <?php } ?>
            </div>
          </div> 
          <div class="form-group required">
            <div class="col-sm-10">
              <label><?php echo $entry_select_category; ?></label>
              <select name="select_category">
                <option value="" selected="selected" disabled="">Выберите</option>
                <option value="Общая информация о Fidelitti и нашей продукции">Общая информация о Fidelitti и нашей продукции</option>
                <option value="Информация о магазине ">Информация о магазине </option>
                <option value="Пресс-офис / Сотрудничество">Пресс-офис / Сотрудничество</option>
                <option value="Корпоративные подарки / b2b заказы">Корпоративные подарки / b2b заказы</option>
                <option value="Вопрос по оплате">Вопрос по оплате</option>
                <option value="Вопрос по заказу">Вопрос по заказу</option>
                <option value="Вопрос по доставке">Вопрос по доставке</option>
                <option value="Возврат заказа">Возврат заказа</option>
                <option value="Помощь и отчет о нашей продукции">Помощь и отчет о нашей продукции</option>
                <option value="Другое">Другое</option>
              </select>
              <?php if ($error_select_category) { ?>
              <div class="text-danger"><?php echo $error_select_category; ?></div>
              <?php } ?>
            </div>
          </div> 
          <div class="form-group required">
            <div class="col-sm-10">
              <label><?php echo $entry_select_city; ?></label>
              <input type="text" name="select_city" value="<?php echo $select_city; ?>" id="input-select_city" class="form-control" />
              <?php if ($error_select_city) { ?>
              <div class="text-danger"><?php echo $error_select_city; ?></div>
              <?php } ?>
            </div>
          </div>       
          <div class="form-group required">
            <div class="col-sm-10">
              <textarea name="enquiry" placeholder="<?php echo $entry_enquiry; ?>" rows="10" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
              <?php if ($error_enquiry) { ?>
              <div class="text-danger"><?php echo $error_enquiry; ?></div>
              <?php } ?>
            </div>
          </div>
          <?php echo $captcha; ?>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input class="btn btn-primary clientService__right--submit" type="submit" value="<?php echo $button_submit; ?>" />
          </div>
        </div>
      </form>
      <div class="large-12">
        <br><br> Свяжитесь с офисами <br><br>
        <strong>FIDELITTI</strong> <br><br>
        по телефону<br><br>
        <span class="prmn-cmngr-message" data-key="phone"></span> <br><br>
        <span><p>Для клиентов интернет-магазина служба доступна с понедельника по пятницу,
          с 9.30 до 18.30 часа, и с 10 до 18 часа по выходным  UTC+02:00 </p></span></p>
           <p class="text-muted details"><strong>Телефон</strong></p>
          <p>0 800 210 385</p>
          <p>+38 093 170 21 16</p>
      </div>
        </div>
        <?php echo $content_bottom; ?>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>
