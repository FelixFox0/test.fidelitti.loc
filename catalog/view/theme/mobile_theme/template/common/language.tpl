<?php if (count($languages) > 1) { ?>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
    <div class="language-now">
     <!-- <button disabled>
      <?php foreach ($languages as $language) { ?>
      <?php if ($language['code'] == $code) { ?>
      <?php echo $language['name']; ?>
      <?php } ?>
      <?php } ?>
      </button>  -->
      <div style="display: none;" id="hidden-content" class="modal_all">
      <div class="mobile_lang__title">Выберите язык</div> 
      <ul class="language-none">
      <?php foreach ($languages as $language) { ?>
      <li><button class="btn btn-link btn-block language-select header<?php echo $language['code']; ?>" type="button" name="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></button></li>
      <?php } ?>
      </ul>  
      </div> 
    </div>

    
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>

<?php } ?>
