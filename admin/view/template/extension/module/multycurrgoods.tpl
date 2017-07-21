<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>Мультивалютные товары v. 2.0</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><a href="http://opencart.zone/"><img src="http://opencart.zone/ocz_logo.png" style="width:177px; height:31px; border:0;" alt="Разработка и сопровождение модулей и сайтов" title="Разработка и сопровождение модулей и сайтов" /></a><div style="position: relative;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Разработчик: <a href="http://opencart.zone/autor">Игорь Голубев</a> (ambalocha69@yandex.ru). Официальная страница модуля: <a href="http://opencart.zone/modules-2-0/mcg-2.html">http://opencart.zone/modules-2-0/mcg-2.html</a></div> </h3>
      </div>
      <div class="panel-body">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-cron" data-toggle="tab">Задачи\Планировщик</a></li>
            <li><a href="#tab-options" data-toggle="tab">Настройки</a></li>
            <li><a href="#tab-log" data-toggle="tab">Лог операций</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-cron">
              <div class="table-responsive">
                <form action="<?php echo $action_cron; ?>" method="post" enctype="multipart/form-data" id="action_cron">
                <table id="cron_tab" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Валюта</td>
                      <td class="text-left">Производитель</td>
                      <td class="text-left">Поставщик</td>
                      <td class="text-left">Округление курса</td>
                      <td class="text-left">Прибавить к валютной цене</td>
                      <td class="text-left">Умножить результат</td>
                      <td class="text-left">Прибавить к результату</td>
                      <td class="text-left">Округлить результат</td>
                      <td class="text-left" style="width:1%">
                        <button type="button" onclick="$('#cron_tab tbody').html('');" data-toggle="tooltip" title="Удалить все" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                      </td>
                      <td class="text-left">
                        <button type="button" onclick="addTask();" data-toggle="tooltip" title="Добавить задачу" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                      </td>
                      <td class="text-left">
                        <button type="button" onclick="$('#action_cron').submit();" data-toggle="tooltip" title="Сохранить список задач" class="btn btn-primary"><i class="fa fa-save"></i></button>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $task_id=0; foreach ($mccron as $task) { ?>
                    <tr id="task-row<?php echo $task_id; ?>">
                      <td class="text-left">
                        <select name="mccron[<?php echo $task_id; ?>][currency_id]" class="form-control">
                            <?php foreach ($currencies as $currency) { ?>
                              <?php if ($currency['value']==1) continue; ?>   
                              <option value="<?php echo $currency['currency_id']; ?>" <?php echo (($currency['currency_id']==$task['currency_id'])?'selected="selected"':''); ?> ><?php echo $currency['title']; ?></option>
                            <?php } ?>
                        </select>          
                      </td>
                      <td class="text-left">
                          <select name="mccron[<?php echo $task_id; ?>][vendor_id]" class="form-control">
                              <option value="0" selected="selected">-- все производители --</option>
                              <?php foreach ($manufacturer as $vendor) { ?>
                                <option value="<?php echo $vendor['manufacturer_id']; ?>" <?php echo ($vendor['manufacturer_id']==$task['vendor_id']?'selected="selected"':''); ?> ><?php echo $vendor['name']; ?></option>
                              <?php } ?>
                          </select>          
                      </td>
                      <td class="text-left">
                          <select name="mccron[<?php echo $task_id; ?>][supplier]" class="form-control">
                              <option value="0" selected="selected">-- все поставщики --</option>
                              <?php $task_supplier = isset($task['supplier'])?$task['supplier']:''; ?>
                              <?php foreach ($suppliers as $supplier) { ?>
                                <option value="<?php echo $supplier['name']; ?>" <?php echo ($supplier['name']==$task_supplier?'selected="selected"':''); ?> ><?php echo $supplier['name']; ?></option>
                              <?php } ?>
                          </select>          
                      </td>
                      <td class="text-left">
                        <select name="mccron[<?php echo $task_id; ?>][curr_round_mode]" class="form-control">
                          <option <?php if ($task['curr_round_mode']==-2) { ?> selected="selected"<?php } ?> value="-2">До сотен</option>
                          <option <?php if ($task['curr_round_mode']==-1) { ?> selected="selected"<?php } ?> value="-1">До десятков</option>
                          <option <?php if ($task['curr_round_mode']==0)  { ?> selected="selected"<?php } ?> value="0">До ближайшего целого</option>
                          <option <?php if ($task['curr_round_mode']==1)  { ?> selected="selected"<?php } ?> value="1">До одного знака после запятой</option>
                          <option <?php if ($task['curr_round_mode']==2)  { ?> selected="selected"<?php } ?> value="2">До двух знаков после запятой</option>
                          <option <?php if ($task['curr_round_mode']==3)  { ?> selected="selected"<?php } ?> value="3">До трех знаков после запятой</option>
                        </select>
                      </td>
                      <td class="text-left">
                          <input type="text"  name="mccron[<?php echo $task_id; ?>][add_before]" value="<?php echo $task['add_before']; ?>" class="form-control">
                      </td>
                      <td class="text-left">
                          <input type="text"  name="mccron[<?php echo $task_id; ?>][mul_after]" value="<?php echo $task['mul_after']; ?>" class="form-control">
                      </td>
                      <td class="text-left">
                          <input type="text"  name="mccron[<?php echo $task_id; ?>][add_after]" value="<?php echo $task['add_after']; ?>" class="form-control">
                      </td>
                      <td class="text-left">
                        <select name="mccron[<?php echo $task_id; ?>][round_mode]" class="form-control">
                          <option <?php if ($task['round_mode']==-2) { ?> selected="selected"<?php } ?> value="-2">До сотен</option>
                          <option <?php if ($task['round_mode']==-1) { ?> selected="selected"<?php } ?> value="-1">До десятков</option>
                          <option <?php if ($task['round_mode']==0)  { ?> selected="selected"<?php } ?> value="0">До ближайшего целого</option>
                          <option <?php if ($task['round_mode']==1)  { ?> selected="selected"<?php } ?> value="1">До одного знака после запятой</option>
                          <option <?php if ($task['round_mode']==2)  { ?> selected="selected"<?php } ?> value="2">До двух знаков после запятой</option>
                          <option <?php if ($task['round_mode']==3)  { ?> selected="selected"<?php } ?> value="3">До трех знаков после запятой</option>
                        </select>
                      </td>
                      <td class="text-right">
                        <button type="button" onclick="$('#task-row<?php echo $task_id; ?>').remove();" data-toggle="tooltip" title="Удалить задачу" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                      </td>
                      <td class="text-right">
                        <button type="button" onclick="StartTask(<?php echo $task_id; ?>);" data-toggle="tooltip" title="Немедленный старт с курсом:" class="btn btn-primary" style="background-color:yellow;color: black;font-size: 16px;"><i id="fa<?php echo $task_id; ?>" class="fa fa-fast-forward"></i></button>
                      </td>
                      <td class="text-left">
                        <input type="text" placeholder="Курс" size="8" name="start[<?php echo $task_id; ?>]" value="" class="form-control">
                      </td>
                    </tr>
                  <?php $task_id++; } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="11" style="text-align:center;padding-top:20px;">При запуске через планировщик(cron) задачи выполняются в том порядке, в котором они идут в списке</td>
                    </tr>
                  </tfoot>
                </table>
                </form>
              </div>
            </div>
     
            <div class="tab-pane" id="tab-options">
              <div class="form-group">
                <label class="col-sm-4 control-label" for="input-round_mode">Округление цен при пересчете:</label>
                <div class="col-sm-7">
                  <select name="round_mode" class="form-control">
                    <option <?php if ($round_mode==-2) { ?> selected="selected"<?php } ?> value="-2">До сотен</option>
                    <option <?php if ($round_mode==-1) { ?> selected="selected"<?php } ?> value="-1">До десятков</option>
                    <option <?php if ($round_mode==0)  { ?> selected="selected"<?php } ?> value="0">До ближайшего целого</option>
                    <option <?php if ($round_mode==1)  { ?> selected="selected"<?php } ?> value="1">До одного знака после запятой</option>
                    <option <?php if ($round_mode==2)  { ?> selected="selected"<?php } ?> value="2">До двух знаков после запятой</option>
                    <option <?php if ($round_mode==3)  { ?> selected="selected"<?php } ?> value="3">До трех знаков после запятой</option>
                  </select>
                </div>
                <div class="col-sm-1">
                  <button type="button" onclick="setRoundMode($('select[name=\'round_mode\']').val());" data-toggle="tooltip" title="Сохранить" class="btn btn-primary"><i id="fa-save-round" class="fa fa-save"></i></button>
                </div>
              </div>
              <br /><br />
              <div class="form-group">
                <label class="col-sm-4 control-label" for="input-save_mode">Сохранять новый курс в <b>"Сиcтема>Локализация->Валюты"</b>:</label>
                <div class="col-sm-7">
                  <select name="save_mode" class="form-control">
                    <option <?php if ($save_mode==0)  { ?> selected="selected"<?php } ?> value="0">Не сохранять</option>
                    <option <?php if ($save_mode==1)  { ?> selected="selected"<?php } ?> value="1">Сохранять</option>
                  </select>
                </div>
                <div class="col-sm-1">
                  <button type="button" onclick="setSaveMode($('select[name=\'save_mode\']').val());" data-toggle="tooltip" title="Сохранить" class="btn btn-primary"><i id="fa-save-save" class="fa fa-save"></i></button>
                </div>
              </div>
            </div>
     
            <div class="tab-pane" id="tab-log">
              <?php if (count($log)==0) { ?>
                Лог пустой 
              <?php } else { ?>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Дата и время</td>
                      <td class="text-left">Пользователь</td>
                      <td class="text-left">Код валюты</td>
                      <td class="text-left">Установленный курс</td>
                      <td class="text-left">Пересчитано товаров</td>
                      <td class="text-left" style="width:1%">
                        <button type="button" onclick="del_history();" data-toggle="tooltip" title="Удалить все" class="btn btn-danger"><i id="fa_del_history" class="fa fa-minus-circle"></i></button>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=0; foreach ($log as $his) { ?>
                    <tr id="log-row_<?php echo $i; ?>">
                      <td class="text-left"><?php echo $his['date']; ?></td>
                      <td class="text-left"><?php echo $his['user']; ?></td>
                      <td class="text-left"><?php echo $currencies[$his['code']]['code']; ?> (ID: <?php echo $his['code']; ?>)</td>
                      <td class="text-left"><?php echo $his['kurs']; ?></td>
                      <td class="text-left"><?php echo $his['total']; ?></td>
                      <td class="text-left" style="width:1%">
                        <button type="button" onclick="del_history_row(<?php echo $his['id']; ?>)" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i id="fa_del_history_<?php echo $his['id']; ?>" class="fa fa-minus-circle"></i></button>
                      </td>
                    </tr>
                  <?php $i++; } ?>
                  </tbody>
                </table>
              </div>
              <?php } ?>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script>   
var task_id = <?php echo $task_id; ?>;

function addTask() {	
	html  = '<tr id="task-row' + task_id + '" style="height: 50px;">';
  html  += '  <td class="text-left">';
  html  += '      <select name="mccron[' + task_id + '][currency_id]" class="form-control">';
            <?php foreach ($currencies as $currency) { ?>
              <?php if ($currency['value']==1) continue; ?>
  html  += '            <option value="<?php echo $currency['currency_id']; ?>"><?php echo $currency['title']; ?></option>';
            <?php } ?>
  html  += '      </select>';          
  html  += '    </td>';
  html  += '  <td class="text-left">';
  html  += '      <select name="mccron[' + task_id + '][vendor_id]" class="form-control">';
  html  += '          <option value="0" selected="selected">-- все производители --</option>';
            <?php foreach ($manufacturer as $vendor) { ?>
  html  += '            <option value="<?php echo $vendor['manufacturer_id']; ?>"><?php echo $vendor['name']; ?></option>';
            <?php } ?>
  html  += '      </select>';          
  html  += '  </td>';
   html  += '<td class="text-left">';
   html  += '   <select name="mccron[' + task_id + '][supplier]" class="form-control">';
   html  += '       <option value="0" selected="selected">-- все поставщики --</option>';
          <?php foreach ($suppliers as $supplier) { ?>
   html  += '         <option value="<?php echo $supplier['name']; ?>"><?php echo $supplier['name']; ?></option>';
          <?php } ?>
   html  += '   </select>';          
   html  += '</td>';
  html  += '  <td class="text-left">';
  html  += '    <select name="mccron[' + task_id + '][curr_round_mode]" class="form-control">';
  html  += '      <option value="-2">До сотен</option>';
  html  += '      <option value="-1">До десятков</option>';
  html  += '      <option value="0">До ближайшего целого</option>';
  html  += '      <option value="1">До одного знака после запятой</option>';
  html  += '      <option value="2">До двух знаков после запятой</option>';
  html  += '      <option selected="selected" value="3">До трех знаков после запятой</option>';
  html  += '    </select>';
  html  += '  </td>';
  html  += '  <td class="text-left">';
  html  += '      <input type="text"  name="mccron[' + task_id + '][add_before]" value="0" class="form-control">';
  html  += '  </td>';
  html  += '  <td class="text-left">';
  html  += '      <input type="text"  name="mccron[' + task_id + '][mul_after]" value="1" class="form-control">';
  html  += '  </td>';
  html  += '  <td class="text-left">';
  html  += '      <input type="text"  name="mccron[' + task_id + '][add_after]" value="0" class="form-control">';
  html  += '  </td>';
  html  += '  <td class="text-left">';
  html  += '    <select name="mccron[' + task_id + '][round_mode]" class="form-control">';
  html  += '      <option value="-2">До сотен</option>';
  html  += '      <option value="-1">До десятков</option>';
  html  += '      <option selected="selected" value="0">До ближайшего целого</option>';
  html  += '      <option value="1">До одного знака после запятой</option>';
  html  += '      <option value="2">До двух знаков после запятой</option>';
  html  += '      <option value="3">До трех знаков после запятой</option>';
  html  += '    </select>';
  html  += '  </td>';
  html  += '  <td class="text-right">';
  html  += '  <button type="button" onclick="$(\'#task-row' + task_id + '\').remove();" data-toggle="tooltip" title="Удалить задачу" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>';
  html  += '  </td>';
  html  += '  <td class="text-right">';
  html  += '  <button type="button" onclick="StartTask(' + task_id + ');" data-toggle="tooltip" title="Немедленный старт с курсом:" class="btn btn-primary" style="background-color:yellow;color: black;font-size: 16px;"><i id="fa' + task_id + '" class="fa fa-fast-forward"></i></button>';
  html  += '  </td>';
  html  += '  <td class="text-left">';
  html  += '  <input type="text" placeholder="Курс" size="8" name="start[' + task_id + ']" value="" class="form-control">';
  html  += '  </td>';
  html  += '</tr>';
	
	$('#cron_tab tbody').append(html);
//	$('.form-control').init();
	task_id++;
}
//------------------------------------------------------------------------------
function StartTask(task_id) {
if ($('input[name=\'start[' + task_id + ']\']').val()<=0) {alert ("ОШИБКА: не введен курс!"); return;}
var url = 'index.php?route=module/multycurrgoods/start&token=<?php echo $token; ?>';
var data = { 
    currency_id:      $('select[name=\'mccron[' + task_id + '][currency_id]\']').val(),
    manufacturer_id:  $('select[name=\'mccron[' + task_id + '][vendor_id]\']').val(),
    supplier:         $('select[name=\'mccron[' + task_id + '][supplier]\']').val(),
    curr_round_mode:  $('select[name=\'mccron[' + task_id + '][curr_round_mode]\']').val(),
    add_before:       $('input[name=\'mccron[' + task_id + '][add_before]\']').val(),
    mul_after:        $('input[name=\'mccron[' + task_id + '][mul_after]\']').val(),
    add_after:        $('input[name=\'mccron[' + task_id + '][add_after]\']').val(),
    round_mode:       $('select[name=\'mccron[' + task_id + '][round_mode]\']').val(),
    kurs:             $('input[name=\'start[' + task_id + ']\']').val()
    };
$.ajax({
type:'post',
url: url,
data: data,
beforeSend: function() { 
    $('#fa'+task_id).removeClass('fa-fast-forward').addClass('fa-spinner'); 
    },
success: function() {
  alert ("Завершено");
  location = 'index.php?route=module/multycurrgoods&token=<?php echo $token; ?>';
  },
error: function(xhr, ajaxOptions, thrownError) {
  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
});
}
//------------------------------------------------------------------------------
function del_history() {
var url = 'index.php?route=module/multycurrgoods/del_history&token=<?php echo $token; ?>';
$.ajax({
type:'post',
url: url,
beforeSend: function() { 
    $('#fa_del_history').removeClass('fa-minus-circle').addClass('fa-spinner').css('color','black').css('font-size','16px'); 
    },
success: function() {
  alert ("Завершено");
  location = 'index.php?route=module/multycurrgoods&token=<?php echo $token; ?>';
  },
error: function(xhr, ajaxOptions, thrownError) {
  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
});
}
//------------------------------------------------------------------------------
function del_history_row(id) {
var url = 'index.php?route=module/multycurrgoods/del_history_row&token=<?php echo $token; ?>';
var data = { 
    id:      id
    };
$.ajax({
type:'post',
url: url,
data: data,
beforeSend: function() { 
    $('#fa_del_history_' + id).removeClass('fa-minus-circle').addClass('fa-spinner').css('color','black').css('font-size','16px');
    },
success: function() {
  alert ("Завершено");
  location = 'index.php?route=module/multycurrgoods&token=<?php echo $token; ?>';
  },
error: function(xhr, ajaxOptions, thrownError) {
  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
  });
}
//------------------------------------------------------------------------------
function setRoundMode (round_mode) {
var url = 'index.php?route=module/multycurrgoods/settings&token=<?php echo $token; ?>';
var data = { 
    round_mode:      round_mode
    };
$.ajax({
type:'post',
url: url,
data: data,
beforeSend: function() { 
    $('#fa-save-round').removeClass('fa-save').addClass('fa-spinner').css('color','black').css('font-size','16px');
    },
success: function() {
  alert ("Завершено");
  location = 'index.php?route=module/multycurrgoods&token=<?php echo $token; ?>';
  },
error: function(xhr, ajaxOptions, thrownError) {
  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
  });
}
//------------------------------------------------------------------------------
function setSaveMode (save_mode) {
var url = 'index.php?route=module/multycurrgoods/settings&token=<?php echo $token; ?>';
var data = { 
    save_mode:      save_mode
    };
$.ajax({
type:'post',
url: url,
data: data,
beforeSend: function() { 
    $('#fa-save-save').removeClass('fa-save').addClass('fa-spinner').css('color','black').css('font-size','16px');
    },
success: function() {
  alert ("Завершено");
  location = 'index.php?route=module/multycurrgoods&token=<?php echo $token; ?>';
  },
error: function(xhr, ajaxOptions, thrownError) {
  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
  });
}
</script>   



<?php echo $footer; ?>