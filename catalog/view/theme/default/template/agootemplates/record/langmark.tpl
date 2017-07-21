<?php if (count($languages) > 1) { ?>
<?php if (SC_VERSION < 20) { ?>
<div id="langmark">
  <?php echo $text_language; ?>
    <?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <a href="<?php echo $language['url']; ?>#"><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"></a>
    <?php } else { ?>
    <a href="<?php echo $language['url']; ?>"><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"></a>
    <?php } ?>
    <?php } ?>
</div>
<?php } else { ?>
<div class="pull-left">
  <div class="btn-group">
    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <?php if (SC_VERSION < 22) { ?>
    <img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
    <?php } else { ?>
    <img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_language; ?></span> <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
      <?php foreach ($languages as $language) { ?>
      <li><a href="<?php echo $language['url']; ?><?php if ($language['code'] == $code) { echo '#'; }?>"><?php if (SC_VERSION < 22) { ?><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /><?php } else { ?><img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"><?php } ?> <?php echo $language['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<?php } ?>
