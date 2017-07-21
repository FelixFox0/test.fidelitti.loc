<?php if (count($languages) > 1) { ?>
<li class="dropdown-header"><?php echo $text_language; ?></li>
<li class="hidden">
</li>
<?php foreach ($languages as $language) { ?>
<li <?php if ($language['code']==$code) { ?>class="active"<?php } ?>><a href="<?php echo $language['url']; ?>" ><span><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" /></span>  <?php echo $language['name']; ?></a></li>
<?php } ?>
<li role="separator" class="divider"></li>
<?php } ?>
