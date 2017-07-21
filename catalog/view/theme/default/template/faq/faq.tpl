<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <div class="row">
        <?php echo $column_left; ?>

        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
        <?php } ?>

        <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
            <h1><?php echo $heading_title; ?></h1>

            <?php if ($answers): ?>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($answers as $answer): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?=$answer['id']?>">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$answer['id']?>" aria-expanded="true" aria-controls="collapseOne" class="link-collapse">
                                    <i class="fa fa-plus"></i> <?=$answer['title']?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?=$answer['id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$answer['id']?>">
                            <div class="panel-body">
                                <?php if ($answer['description']): ?>
                                    <?=html_entity_decode($answer['description'])?>
                                <?php else: ?>
                                    <?=$answer_empty?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><br>
                <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p><?php echo $questions_empty; ?></p>
            <?php endif; ?>

            <?php echo $content_bottom; ?>
        </div>

        <?php echo $column_right; ?>
    </div>
</div>
<?php echo $footer; ?>