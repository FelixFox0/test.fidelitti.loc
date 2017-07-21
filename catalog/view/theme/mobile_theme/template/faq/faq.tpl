<?php echo $header; ?>
<div class="breadcrumbs"></div>
<div class="row clientService"> 
    <div class="large-12 clientService__title">
        <?php echo $heading_title; ?>            
    </div>
    <div class="large-12 clientService__desc">
        Найти нужный ответ, нажав на ссылку ниже.
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
    <div id="content" class="large-12 clientService__right">
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