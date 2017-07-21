<?php if (count($languages) > 1) { ?>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
    <div class="language-now">
      <button>
      <?php foreach ($languages as $language) { ?>
      <?php if ($language['code'] == $code) { ?>
      <?php echo $language['name']; ?>
      <?php } ?>
      <?php } ?>
      </button>   
      <ul class="language-none">
      <?php foreach ($languages as $language) { ?>
      <li><button class="btn btn-link btn-block language-select" type="button" name="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></button></li>
      <?php } ?>
    </ul>   
    </div>

    
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
<?php } ?>
