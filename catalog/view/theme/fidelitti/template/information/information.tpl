<?php echo $header; ?>

<? if($information_id == 21) {?>

<? }elseif($information_id == 22) {?>

  <? } else {?>
<div class="breadcrumbs"></div>
 <? } ?>
<? if($information_id == 21) {?>
  <div class="clientService">

  <? }elseif($information_id == 22) {?>
  <div class="clientService">
  <? } else {?>
<div class="row clientService"> 
  <? } ?>
       <? if($information_id == 21) {?>

       <? }elseif($information_id == 22) {?>

  <? } else {?>
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
  <? } ?>
  <? if($information_id == 21) {?>
  <div id="content">

  <? }elseif($information_id == 22) {?>
  <div id="content">
  <div class="my_company">
          <div class="my_company__text">
            <span class="my_company__title">FIDELITTI — УНИКАЛЬНЫЙ МОДНЫЙ БРЕНД — ПРОИЗВОДИТЕЛЬ СУМОК И АКСЕССУАРОВ,<br>
            СОЗДАННЫЙ В ОДЕССЕ В 2015-ОМ ГОДУ.</span> <div>О КОМПАНИИ
            </div>
          </div>
  </div>
  <div class="my_company_two">
    <div>
      Всего за один год у нас получилось заявить о себе, как о производителе продукции наивысшего качества. А все благодаря тому, что с самого начала нашей целью было стать самым <br>успешным проектом на рынке кожгалантереи. 
    </div>
  </div>
  <div class="my_company_three">
    <div class="large-4 columns"><img src="/catalog/view/theme/fidelitti/image/IMG_8947-708x700.jpg"></div>
    <div class="large-4 columns"><img src="/catalog/view/theme/fidelitti/image/fashion_day_odessa_fidelitti-1-708x700.jpg"></div>
    <div class="large-4 columns"><img src="/catalog/view/theme/fidelitti/image/gesheft_fidelitti-708x700.jpg"></div>
  </div>
  <? } else {?>
  <div id="content" class="large-9 columns clientService__right">
  <? } ?>
    <? if($information_id == 11) {?>
      <span class="prmn-cmngr-message" data-key="vozvrat" data-default='<p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Компания Fidelitti стремится максимально удовлетворить
запросы покупателей в отношении качества продукции и процесса покупки. Если по
какой-либо причине Вы не удовлетворены своим заказом, или если Вам пришли
изделия, не соответствующие вашему запросу, Вы можете вернуть приобретенный
товар в течение 14 дней со дня доставки.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Правом на возврат может воспользоваться только
покупатель, но не лицо, получившее изделие в подарок.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Возврат денежных средств осуществляется на карту с
которой происходила оплата в течении 7 (семи) дней после приёма Товара на склад
Поставщика.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Покупатель имеет право на обмен или возврат
приобретенного товара в течение 14 дней со дня передачи товара при условиях:<o:p></o:p></span></p><p class="MsoNormal" style="text-indent: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">-</span><span style="font-size:7.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU">сохранения
оригинальных ярлыков, маркировки и упаковки;<o:p></o:p></span></p><p class="MsoNormal" style="text-indent: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">-</span><span style="font-size:7.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU">отсутствия признаков
использования изделия;<o:p></o:p></span></p><p class="MsoNormal" style="text-indent: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">-</span><span style="font-size:7.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU">сохранения полной
комплектации изделия.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:14.0pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p><p>
</p><p class="MsoNormal"><o:p>&nbsp;</o:p></p>'></span>
    
     <? }elseif($information_id == 10) {?>
      <span class="prmn-cmngr-message" data-key="delivery" data-default='<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal"><span style="font-size: 14pt;">Доставка</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">осуществляется</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">различными</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">транспортными</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">компаниями</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">в</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">соответствии</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">с</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">географическим</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">местонахождением</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">клиента</span><span style="font-size: 14pt; font-family: GothamPro, serif;">.</span><span style="font-size: 14pt;">Основные</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">транспортные</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">компании</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> ,</span><span style="font-size: 14pt;">с</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">которыми</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">мы</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">работаем</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> : EMS,FedEx,DHL .</span><span style="font-size: 14pt;">Сроки</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">доставки</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">зависят</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">от</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">региона</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">доставки</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">и</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">расчитываются</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">индивидуально</span><span style="font-size: 14pt; font-family: GothamPro, serif;">.<br>
</span><span style="font-size: 14pt;">Отправка</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">заказа</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">происходит</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">только</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">после</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">поступления</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">оплаты</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">за</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">товар</span><span style="font-size: 14pt; font-family: GothamPro, serif;">.</span><span style="font-size: 14pt;">Процесс</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">перевода</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">может</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">занять</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">до</span><span style="font-size: 14pt; font-family: GothamPro, serif;">
24 </span><span style="font-size: 14pt;">часов</span><span style="font-size: 14pt; font-family: GothamPro, serif;">.&nbsp;<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal">

</p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal"><span style="font-size: 14pt;">Среднее</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">время</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">доставки</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">заказа</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">к</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> </span><span style="font-size: 14pt;">заказчику -</span><span style="font-size: 14pt; font-family: GothamPro, serif;"> 2 </span><span style="font-size: 14pt;">недели</span><span style="font-size: 14pt; font-family: GothamPro, serif;">.</span><span style="font-size:
14.0pt;mso-bidi-font-size:11.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;"><o:p></o:p></span></p>'></span>
    <? }elseif($information_id == 8) {?>
      <span class="prmn-cmngr-message" data-key="cookies" data-default='<p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Веб-сайт&nbsp;<b>fidelitti.com</b>&nbsp;использует
файлы cookie или похожие технологии в целях улучшения Вашей навигации по
веб-сайту, а также для отправки Вам рекламных сообщений, отвечающих Вашим
интересам, как приведено ниже.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">ПОНЯТИЯ</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Файлы Cookies - это простые текстовые файлы,
позволяющие веб-серверу хранить информацию о Вашем электронном устройстве
(компьютере, планшете, смартфоне и т.д.) на протяжении Вашего посещения
(сессионные файлы cookie) и для последующих посещений веб-сайта (постоянные
файлы cookie). Браузер сохраняет их в соответствии с выбранными Вами
настройками. Похожие механизмы, такие как, веб-маяки (web beacons), прозрачные
GIF-файлы и все формы местного хранения, введенные HTML5, также могут быть
использованы для сбора информации о предпочтениях пользователя. В целях
упрощения понятий, ссылаясь на файлы "cookie", мы подразумеваем все
приведенные выше механизмы. Файлы cookies не содержат и не используются
компанией Fidelitti, ее аффилированными лицами, и ни одним из её сторонних
провайдеров услуг для сбора, записи или хранения каких-либо Ваших персональных
данных, включая Вашу Ф.И.О., дату рождения, адрес, номера телефонов, паспортные
данные, данные платежных карт (кредитной, дебетовой или иной) и иные данные.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">ВИДЫ ФАЙЛОВ COOKIES</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Технические cookies</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Сессионные файлы cookies: Они необходимы для
обеспечения надлежащего функционирования нашего веб-сайта, и используются для
управления регистрацией/аутентификацией и доступом к определенным услугам. Они
временно сохраняются во время сеанса навигации и автоматически удаляются из
Вашего устройства при закрытии браузера. Обратите внимание на то, что при
отключении сессионных файлов cookies, Ваш доступ к тем услугам, требующим
регистрации/аутентификации, может быть ограничен. Постоянные, статистические и
связанные с оптимизацией файлы cookies: Они позволяют нам собирать и
анализировать (анонимно) траффик и навигацию по веб-сайту, наблюдать за
системой, а также улучшать текущие операции, например, сохранять Ваши
предпочтения для оптимизации Ваших последующих посещений веб-сайта. Они не
удаляются автоматически при закрытии браузера, а сохраняются на Вашем
компьютере на определенный срок (например, до конца следующего года), или же до
тех пор, пока Вы не удалите их. Для получения более подробной информации по
настройке и удалению файлов cookies, перейдите к разделу "Управление
файлами Cookies", приведенному ниже.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Профильные файлы cookies</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="mso-ascii-font-family:Calibri;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-hansi-font-family:Calibri;
mso-bidi-font-family:Calibri;color:#0A0A0A;mso-fareast-language:RU">Веб-сайт
Fidelitti.com использует профильные файлы cookies компании Fidelitti и
независимых провайдеров услуг для отслеживания Вашей навигации по нашему
веб-сайту, в целях создания профилей на основе Ваших вкусов, привычек, выбора и
т. д.; и, следовательно, позволяет нам отправлять Вам рекламные сообщения,
отвечающие Вашим предпочтениям. Обратите внимание, что их отключение или удаление
не позволит нам посылать рекламные сообщения, отвечающие Вашим предпочтениям, а
также может повлиять на правильное функционирование некоторых услуг и на доступ
к некоторым разделам веб-сайта.&nbsp;</span><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">















</p><p class="MsoNormal"><o:p>&nbsp;</o:p></p>'></span>
    <? }elseif($information_id == 7) {?>
      <span class="prmn-cmngr-message" data-key="policy" data-default='<p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Администрация сайта&nbsp;<b>fidelitti.com</b>&nbsp;(далее
Сайт) с уважением относится к правам посетителей Сайта. Мы безоговорочно
признаем важность конфиденциальности личной информации посетителей нашего
Сайта.<br>
Посещая Сайт, Вы полностью соглашаетесь с данной Политикой конфиденциальности.<br>
Основные положения нашей политики конфиденциальности формулируются следующим
образом:<o:p></o:p></span></p><ul style="margin-top:0cm" type="disc">
 <li class="MsoNormal" style="color: rgb(10, 10, 10); margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">Мы не
     передаем Вашу персональную информацию третьим лицам.<o:p></o:p></span></li>
 <li class="MsoNormal" style="color: rgb(10, 10, 10); margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">Мы не
     передаем Вашу контактную информацию без Вашего согласия.<o:p></o:p></span></li>
 <li class="MsoNormal" style="color: rgb(10, 10, 10); margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">Вы
     самостоятельно определяете объем раскрываемой персональной информации.<o:p></o:p></span></li>
</ul><div class="MsoNormal" align="center" style="margin: 5.25pt 0cm 7.5pt; text-align: center; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:
RU">

<hr size="0" width="100%" noshade="" style="color:#2B2B2B" align="center">

</span></div><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Собираемая информация</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Мы собираем следующую информацию:<o:p></o:p></span></p><ul style="margin-top:0cm" type="disc">
 <li class="MsoNormal" style="color: rgb(10, 10, 10); margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">Техническая
     информация, автоматически собираемая программным обеспечением Сайта во
     время его посещения.<o:p></o:p></span></li>
 <li class="MsoNormal" style="color: rgb(10, 10, 10); margin-bottom: 0.0001pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">Персональная
     информация, предоставляемая Вами при заполнении форм обратной связи.<o:p></o:p></span></li>
</ul><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">ТЕХНИЧЕСКАЯ ИНФОРМАЦИЯ.</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Во время посещения вами Сайта, администрации Сайта
автоматически становится доступной информация из стандартных журналов
регистрации сервера. Сюда включается IP-адрес Вашего компьютера (или прокси-сервера,
если он используется для выхода в Интернет), имя Интернет-провайдера, имя
домена, тип браузера и операционной системы, информация о сайте, с которого Вы
совершили переход на Сайт, страницах Сайта, которые Вы посещаете, дате и
времени этих посещений, файлах, которые Вы загружаете. Это информация
анализируется нами в агрегированном (обезличенном) виде для анализа
посещаемости Сайта, и используется при разработке предложений по его улучшению
и развитию. Связь между Вашим IP-адресом и Вашей персональной информацией
никогда не раскрывается третьим лицам, за исключением тех случаев, когда это
требует законодательство.<br>
Техническую информацию о посещении Сайта (обезличенную) также собирают
установленные на сайте счетчики статистики.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Использование полученной информации</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Информация, предоставляемая Вами при заполнении форм
обратной связи, а также техническая информация используется исключительно для
улучшения работы сайта. Вся контактная информация, которую Вы нам
предоставляете, раскрывается только с Вашего разрешения. Адреса электронной
почты никогда не публикуются на Сайте и используются нами только для связи с
Вами.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Предоставление информации третьим лицам</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Мы никогда не предоставляем Вашу личную информацию
третьим лицам, кроме</span><span lang="UK" style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-ansi-language:UK;mso-fareast-language:RU">:</span><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="text-indent: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">-</span><span style="font-size:7.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang="UK" style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-ansi-language:UK;mso-fareast-language:RU">случаев</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU">&nbsp;предотвращения
преступления или нанесения ущерба нам или третьим лицам;<o:p></o:p></span></p><p class="MsoNormal" style="text-indent: 18pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:
10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">-</span><span style="font-size:7.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU">третьи</span><span lang="UK" style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-ansi-language:UK;mso-fareast-language:RU">х
лиц</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:
RU">, которые предоставляют нам поддержку и услуги, с помощью которых Вы
получаете Ваш заказ.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">&nbsp;<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Защита данных</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size:10.5pt;font-family:
&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#0A0A0A;
mso-fareast-language:RU">Администрация Сайта осуществляет защиту информации,
предоставленной пользователями, и использует ее только в соответствии с
принятой Политикой конфиденциальности. На Сайте используются общепринятые
методы безопасности для обеспечения защиты информации от потери, искажения и
несанкционированного распространения. Безопасность реализуется программными
средствами сетевой защиты, процедурами проверки доступа, применением
криптографических средств защиты информации, соблюдением политики
конфиденциальности.<o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><b><span style="font-size:10.5pt;
font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:#0A0A0A;mso-fareast-language:RU">Заключительные положения</span></b><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="mso-ascii-font-family:Calibri;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-hansi-font-family:Calibri;
mso-bidi-font-family:Calibri;color:#0A0A0A;mso-fareast-language:RU">Никакие из
содержащихся здесь заявлений не означают заключения договора или соглашения
между Владельцем Сайта и Пользователем, предоставляющим персональную
информацию. Политика конфиденциальности лишь проинформирует Вас о подходах
Сайта к работе с персональными данными.<br>
Мы оставляем за собой право вносить изменения в настоящую политику
конфиденциальности в любое время без предварительного уведомления.</span><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:#0A0A0A;mso-fareast-language:RU"><o:p></o:p></span></p><p class="MsoNormal" style="line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">





































</p><p class="MsoNormal"><o:p>&nbsp;</o:p></p>'></span>
    <? }elseif($information_id == 21) {?>
      <div class="our_production">
        <div class="row">
          <div class="our_production__text large-12">
            <span class="our_production__title">НАШЕ ПРОИЗВОДСТВО</span> <div>СВЕЖИЙ ВЗГЛЯД ВЗГЛЯД НА ПРОИЗВОДСТВО СУМОК</div>
          </div>
        </div>
      </div>
      <div class="our_production_two">
        <div class="row">
        <div class="large-12">
          <div class="our_production_two_img"><img src="/catalog/view/theme/fidelitti/image/6ae3a7b044.jpg"></div>
          <div class="our_production_two_title">СОВРЕМЕННАЯ ФАБРИКА</div>
          <div class="our_production_two_img"><img src="/catalog/view/theme/fidelitti/image/e1b9856a9b.jpg"></div>
          <div class="our_production_two_text">
            На каждой ступени изготовления, наши изделия проходят жесткий<br> контроль качества. Отлаженная модель производства.<br> Своевременный выпуск готовых изделий. Современное <br>оборудование. Вот условия нужные для передового производства.
          </div>
          </div>
        </div>
      </div>
      <div class="our_production_trhee">
      <div class="large-6 our_production_trhee_one">
         <div class="our_production_trhee__title">РАСКРОЙНЫЙ</div>
         <div class="our_production_trhee__text">
          ЦЕХ №1<br>
          Для производства используем только лучшую лицевую кожу.<br> Используем различные методики раскроя для достижения наилучшего <br>результата.
          </div>
      </div>
      <div class="large-6">
        <img src="/catalog/view/theme/fidelitti/image/1-proizvostvo.jpg">
      </div>
      </div>
      <div class="our_production_trhee">      
      <div class="large-6">
        <img src="/catalog/view/theme/fidelitti/image/ceh_2.jpg">
      </div>
      <div class="large-6 our_production_trhee_one">
         <div class="our_production_trhee__title">ЗАГОТОИТЕЛЬНЫЙ</div>
         <div class="our_production_trhee__text">
          ЦЕХ №2<br>
      Тщательно подготавливаем каждую деталь кроя. Точность и щепетильность — главное правило.
          </div>
      </div>
      </div>


      <div class="our_production_trhee">
      <div class="large-6 our_production_trhee_one">
         <div class="our_production_trhee__title">ШВЕЙНЫЙ</div>
         <div class="our_production_trhee__text">
          ЦЕХ №3<br>
          Контролируем каждый стежок строчки. Нитки и фурнитуру покупаем<br> исключительно в Италии.
          </div>
      </div>
      <div class="large-6">
        <img src="/catalog/view/theme/fidelitti/image/4-1.jpg">
      </div>
      </div>
      <div class="our_production_trhee">      
      <div class="large-6">
        <img src="/catalog/view/theme/fidelitti/image/4-proizvostvo.jpg">
      </div>
      <div class="large-6 our_production_trhee_one">
         <div class="our_production_trhee__title">ОТДЕЛОЧНЫЙ</div>
         <div class="our_production_trhee__text">
          ЦЕХ №4
          Цех, где происходят чудеса. Наши изделия обрабатываются<br> исключительно итальянскими красками.
          </div>
      </div>
      </div>

    <? } else {?>
      <?php echo $description; ?>
    <? } ?>
    <?php echo $content_bottom; ?>
    <?php echo $column_right; ?>
  </div>
</div>    
<?php echo $footer; ?>