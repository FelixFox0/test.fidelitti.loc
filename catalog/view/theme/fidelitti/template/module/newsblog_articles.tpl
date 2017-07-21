<div class="all-news__name">

  
  <?php foreach ($categories as $category) { ?>
    <a href="<?php echo $category['href']; ?>"><h2><?php echo $category['name']; ?></h2></a>
  <?php } ?>
</div>

<?php if ($link_to_category) { ?>
<a href="<?php echo $link_to_category; ?>"><?php echo $text_more; ?> <?php echo $heading_title; ?></a>
<?php } ?>