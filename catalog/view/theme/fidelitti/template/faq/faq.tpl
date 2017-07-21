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
                <li><a href="payment_en" rel="insert">Оплата</a></li>
                <li><a href="deliverys_en">Доставка</a></li>
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
        <?php if ($answers): ?>
            <ul class="accordion" data-accordion data-allow-all-closed="true">
                <?php foreach ($answers as $answer): ?>
            <li class="accordion-item" data-accordion-item>
            <a href="#" class="accordion-title"><?=$answer['title']?></a>
            <div class="accordion-content" data-tab-content>
            <?php if ($answer['description']): ?>
            <?=html_entity_decode($answer['description'])?>
            <?php else: ?>
            <?=$answer_empty?>
            <?php endif; ?>
            </div>
            </li> 
            <?php endforeach; ?>            
            </ul>
            <?php else: ?>
                <p><?php echo $questions_empty; ?></p>
            <?php endif; ?>
                </div>
        <?php echo $content_bottom; ?>
        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>