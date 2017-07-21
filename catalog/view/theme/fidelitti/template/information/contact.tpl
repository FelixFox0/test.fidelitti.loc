<style></style>



<?php echo $header; ?>
<div class="breadcrumbs"></div>


<div class="row clientService"> 
    <div class="large-12 columns clientService__title">
        <?php echo $heading_title; ?>            
    </div>
    <div class="large-12 columns clientService__hr"><hr></div>
    <div class="large-3 columns clientService__left">
    <div class="large-3 columns clientService__left">
            <div class="clientService__left--title">Нужна помощь?</div>
            <ul>
                <li><a href="/index.php?route=faq/faq" rel="insert">Часто задаваемые вопросы</a></li>
                <li><a href="policy" rel="insert">Политика конфиденциальности</a></li>
                <li><a href="cookies" rel="insert">Политика cookies</a></li>
                <li><a href="contact-us" rel="insert">Связаться с нами</a></li>
            </ul>
             <div class="clientService__left--title">Политика продаж</div>
            <ul>
                <li><a href="payment" rel="insert">Оплата</a></li>
                <li><a href="deliverys">Доставка</a></li>
                <li><a href="return">Возврат</a></li>
                <li><a href="public-offer-contract">Публичная оферта</a></li>
            </ul>
             <div class="clientService__left--title">CAREERS</div>
            <ul>
                <li><a href="/works">Работай с нами</a></li>                
            </ul>
           <div class="clientService__left--title">Колл-центр</div>
            <ul>
                <li><span class="prmn-cmngr-message" data-key="phone"></span></li>                
            </ul>   
        </div>
        <?php echo $column_left; ?>

        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
        <?php } ?>           
    </div>
   <div id="content" class="large-9 columns clientService__right">
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
  
<!--  contact-->
    <style>
   .row > .laba1{
	
		width:400px;
		float: left;
		color:#000;
		border:1px solid #000;
		padding:5px;
		margin:10px 0px 10px 15px;
		cursor:pointer;
		text-align: center;
		height:35px	
		}
		.row >.laba2 {
		width:410px;
		float left;
		color:#000;
		border:1px solid #000;
		padding:5px;
	    margin:10px 5px 10px 10px;
		cursor:pointer;
		text-align: center;
		height:35px		}
		.mulo {
			height:112px;
		display: block;
		    background-color: #aaa;
    color: #fff;
	max-width: 820px;

		}
    .mulochil{
		float:left;
		margin-left:10px;
		width:390px;
		}
	.mulochil > .control-label{
		margin-top:5px;
		text-align:center;
		color:#fff;
		margin-bottom:0px;
		}
		  .alert{
		margin: 5px 0PX 0PX 0;
    text-align: center;
    background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
    max-width: 400px;
}
		  
		.form-group0{
			float:left;
			min-width: 50%;}
			
		.form-group00{
			float:left;
			width: 78%;
			min-width:400px;}
				
			.form-control{
				
				border-radius:5px;}
					.form-control select{
						font-size:12px;}
           .form-control:hover{
				border:1px solid #c00;} 
                
                 #submitContactOther{ 
		background: #000;
    color: #fff;
    border: 1px solid #000
    text-transform: uppercase;
    font-weight: lighter;
    border-radius: 0px;
    border: 1px solid #000;
    width: 150px;
    outline: none;
    padding: 10px;
    height: auto;
    margin: 10px 10px 10px 0 ;}
    #submitContactOther:hover{
      background: #FFF;
      color: #000;
    }
	.form-group0 label {
		margin-top:10px;
		
		}
		.form-group00 label {
		margin-top:10px;
		
		}
	
.eml,.firstname,.lname,.scat,.enq,.ssel {
	height:20px;
	margin-top:5px;}
	
                
                </style>
  
  <script>  


//переключалки форм
	$(document).ready(function(){
	 $(".laba1").css({'color':'#fff','background':'#000'});
	 $(".form-hiden").css({'visibility':'hidden','position':'absolute'});
	 $(".form-hiden1").css({'visibility':'hidden','position':'absolute'});
	  $("#requestWhy").click(function(){;
	  if($("#requestWhy").val()=='Return Order####Возврат заказа'){
		$(".form-hiden").css({'visibility':'visible','position':'relative'}); 
		$(".form-hiden1").css({'visibility':'hidden','position':'absolute'});
		$("#requestWhy2").val()=='';
		  }else{	
		    if($("#requestWhy").val()=='Shipping Question####Вопрос по доставке'){
		$(".form-hiden1").css({'visibility':'visible','position':'relative'});
		$(".form-hiden").css({'visibility':'hidden','position':'absolute'});
		$("#requestWhy1").val()=='';
		}else{
		$(".form-hiden").css({'visibility':'hidden','position':'absolute'});
		$(".form-hiden1").css({'visibility':'hidden','position':'absolute'});
		$("#requestWhy1").val()=='';
		$("#requestWhy2").val()=='';
		}}
	 
	  });
   
   $(".laba1").click(function(){
      $(".laba1").css({'color':'#fff','background':'#000'});
	   $(".laba2").css({'color':'#000','background':'#fff'});
	   	  $(".mulochil1").html('');
      });
	     $(".laba2").click(function(){
      $(".laba2").css({'color':'#fff','background':'#000'});
	   $(".laba1").css({'color':'#000','background':'#fff'});
	  $(".mulochil1").html('<div class="mulochil"> <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_order_number1; ?></label><input type="text" name="ord" value="<?php echo $ord; ?>" id="input-name" class="form-control" /> <div class="ordo"><?php if ($error_ord) { ?> <p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p><?php } ?></div></div>');
	  	$('[name *= "ord"]').blur(function() {
if($(this).val()==""){$('.ordo').html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')}
	})
      });
	//валидация

// validate 2


$('[name *= "email"]').blur(function() {
if($(this).val()!=""){$(".eml").html('');

}else{$(".eml").html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')};

	});
	
	$('[name *= "name"]').blur(function() {
if($(this).val()==""){$('.firstname').html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')}
else{$(".firstname").html('')};
	});
	
	$('[name *= "lastname"]').blur(function() {
if($(this).val()==""){$('.lname').html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')}
else{$(".lname").html('')};
	})
		$('[name *= "select_category"]').blur(function() {
if($(this).val()==""){$('.scat').html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')}
else{$(".scat").html('')};
	})
	
	$('[name *= "enquiry"]').blur(function() {
if($(this).val()==""){$('.enq').html('<p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>')}
else{$(".enq").html('')};	
	})
		
});
</script>


      
     <form action="<?php echo $action; ?>" method="post"  enctype="multipart/form-data" class="form-horizontal contact_forms">
        <fieldset>
          <legend><?php echo $text_contact; ?></legend>
          
  
          
      <div class="row"><div class="laba1"><?php echo $entry_email; ?></div><div class="laba2"><?php echo $entry_order_number; ?></div></div>
          
        
         <div class="mulo">
         
  
         
         
         <div class="mulochil">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email1; ?></label>
       
              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
           <div class="eml">
            <?php if ($error_email) { ?>
            
             <p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>
  <!--            <div class="text-danger"><?php echo $error_email; ?></div>-->
              <?php } ?></div>
    
         </div>
            <div class="mulochil1"></div>
          
          </div> 
          
          
          <div class="form-group0 required">
            <label class="col-sm-2 control-label" ng-model="firstname" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
              <div class="firstname" >
              <?php if ($error_name) { ?>
               <p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>
  <!--            <div class="text-danger"><?php echo $error_name; ?></div>-->
              <?php } ?></div>
            </div>
          </div>
          
          
         
          
                    <div class="form-group0 required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_lastname; ?></label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" id="input-name" class="form-control" />
             <div class="lname" >
             
              <?php if ($error_lastname) { ?>
               <p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>
   <!--           <div class="text-danger"><?php echo $error_lastname; ?></div>-->
              <?php } ?></div>
            </div>
          </div>
          

          <div class="form-group0 required"><label for="requestWhy"><?php echo $entry_select_category; ?></label><select name="select_category" id="requestWhy" ng-model="selection"required="" class="form-control" >
          <option value="" disabled="" >Выберите</option>
          <option  value="General Information about Fidelitti and our products####Общая информация о нашей продукции" >Общая информация о Fidelitti и нашей продукции</option>
          <option  value="Shop Information ####Информация о магазине " >Информация о магазине </option>
          <option  value="Press Office####Пресс-офис / Сотрудничество" >Пресс-офис / Сотрудничество</option>
          <option  value="Corporate gift####Корпоративные подарки / b2b заказы" >Корпоративные подарки / b2b заказы</option>
          <option  value="Billing Question####Вопрос по оплате" >Вопрос по оплате</option>
          <option  value="Order Question####Вопрос по заказу" >Вопрос по заказу</option>
          <option  value="Shipping Question####Вопрос по доставке" mailto="" >Вопрос по доставке</option>
          <option  value="Return Order####Возврат заказа" mailto="" >Возврат заказа</option>
          <option  value="Assistance and reports about our products####Помощь и отчет о нашей продукции" mailto="" >Помощь и отчет о нашей продукции</option>
          <option  value="Other####Другое" >Другое</option></select>
          <div class="scat" > </div></div>
          
          
          
          
           <div class="form-group0 required form-hiden" ><label for="secondWhy1"><?php echo $more; ?></label><select name="secondWhy1" id="secondWhy1" class="form-control" >
           <option value="" disabled="" selected="">Выберите</option>
           <option ng-repeat="subject in secondWhy.child" value="Возврат и возмещение средств за товары, приобретенные в магазине" class="ng-binding ng-scope">Возврат и возмещение средств за товары, приобретенные в магазине</option>
           <option ng-repeat="subject in secondWhy.child" value="Возврат и возмещение средств за товары, приобретенные онлайн" class="ng-binding ng-scope">Возврат и возмещение средств за товары, приобретенные онлайн</option></select>
        <div class="ssel" > </div></div>
           
           
          <div class="form-group0 required form-hiden1" >
                      <label for="secondWhy"><?php echo $more; ?></label>
                      <select name="secondWhy2" id="secondWhy2" class="form-control" >
                      <option value="? string:Возврат и возмещение средств за товары, приобретенные онлайн ?"></option><option value="" disabled="" selected="" >Выберите</option>
                      <option ng-repeat="subject in secondWhy.child" value="Мой заказ пришел поврежденным." class="ng-binding ng-scope">Мой заказ пришел поврежденным.</option>
                      <option ng-repeat="subject in secondWhy.child" value="Как мне узнать номер отслеживания заказа?" class="ng-binding ng-scope">Как мне узнать номер отслеживания заказа?</option>
                      <option ng-repeat="subject in secondWhy.child" value="Когда мой заказ будет доставлен?" class="ng-binding ng-scope">Когда мой заказ будет доставлен?</option>
                      <option ng-repeat="subject in secondWhy.child" value="Я получил товар, который я не заказывал." class="ng-binding ng-scope">Я получил товар, который я не заказывал.</option></select>
                      
                      </div>  <div class="ssel" > </div>
          
          
          
           <div class="form-group0 required"><label for="country"><?php echo $text_location ;?></label><input name="select_city" type="text" value='<?php echo $strana?>' class="form-control"> <div class="ssel" > </div></div> 
          
          

      
          
          <div class="form-group00 required" >
            <label class="col-sm-2 control-label" for="input-enquiry"><?php echo $entry_enquiry; ?></label>
            <div class="col-sm-10">
              <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
             <div class="enq">
         
              <?php if ($error_enquiry) { ?>
               <p ng-message="required" class="alert alert-danger ng-scope"><?php echo $error_enquiry_name; ?></p>
 <!--             <div class="text-danger"><?php echo $error_enquiry; ?></div>-->
              <?php } ?></div>
            </div>
          </div>
          <?php echo $captcha; ?>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input class="btn btn-primary" id="submitContactOther" type="submit" value="<?php echo $button_submit; ?>" />
          </div>
        </div>
      </form>
      <div class="large-12" style="text-align: right;">
        <div class="col-xs-12 right-infos">
          <p>Свяжитесь с офисами</p>          
          <p><strong>FIDELITTI</strong></p>
          <p class="text-muted details"><span><p>по телефону</p>
          <p><span class="prmn-cmngr-message" data-key="phone"></span></p>
          <!--<p>&nbsp;</p><p><strong>FIDELITTI</strong></p>
          <p>via Bellaria 3/5</p><p>40068 San Lazzaro di Savena</p>
          <p>Bologna ITALY</p></span></p> -->
          <p class="text-muted details"><strong></strong></p>
          <p class="text-muted details"> <span><p>Для клиентов интернет-магазина служба доступна с понедельника по пятницу,
          с 9.30 до 18.30 часа, и с 10 до 18 часа по выходным <br> UTC+02:00</p></span></p>
          <p class="text-muted details"><strong>Телефон</strong></p>
          <p>0 800 210 385</p>
          <p>+38 093 170 21 16</p>          
        </div>
      </div>
        </div>
        <?php echo $content_bottom; ?>
        <?php echo $column_right; ?>
    </div>
      
 <?php echo $column_right; ?>
      
</div>
        
        <?php echo $content_bottom; ?>
       
    </div>
</div>
<?php echo $footer; ?>
