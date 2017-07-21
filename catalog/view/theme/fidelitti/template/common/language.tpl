<?php if (count($languages) > 1) { ?>
   <div class="dropdown">
   <button onclick="myFunctionss()" class="dropbtn">
      <?php foreach ($languages as $language) { ?>
      <?php if ($language['code'] == $code) { ?>
      <?php echo $language['name']; ?>
      <?php } ?>
      <?php } ?>
   </button>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">


  <div id="myDropdown" class="dropdown-content">
    <?php foreach ($languages as $language) { ?>
      <li><button class="btn btn-link btn-block language-select header<?php echo $language['code']; ?>" type="button" name="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></button></li>
      <?php } ?>
  </div>


    
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>

<?php } ?>
</div>