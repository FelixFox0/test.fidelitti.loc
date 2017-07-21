<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">

        <div class="form-group">
                <label class="col-sm-2 control-label" for="input-power_ct_block"><span data-toggle="tooltip" title="<?php echo $help_power_ct_block; ?>"><?php echo $entry_power_ct_block; ?></span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($power_ct_block) { ?>
                      <input type="checkbox" name="power_ct_block" value="1" checked="checked" id="input-power_ct_block" />
                      <?php } else { ?>
                      <input type="checkbox" name="power_ct_block" value="1" id="input-power_ct_block" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>


          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
            <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
            <?php if($power_ct_block == 1) { ?>
            <li><a href="#tab-cat-one" data-toggle="tab">Категория первая</a></li>
            <li><a href="#tab-cat-two" data-toggle="tab">Категория Вторая</a></li>
            <li><a href="#tab-cat-three" data-toggle="tab">Категория Третья</a></li>
            <? } ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">



          <div class="tab-content">
            <div class="tab-pane active" id="tab-cat-one-w">

                  
                 
                 
                  <!-- name button -->
                   
                  <!-- end name button -->
                  <!-- link button -->
                   
                  <!-- end link button -->

                 
              <!-- name images three -->
                  
                  <!-- end name images three -->

                  
                  <!-- product name image one -->
                   
                  <!-- end product name image one -->   
                  <!-- product desc image one  -->
                   
                  <!-- end product desc image one -->  









                  <!-- product name image two -->
                   
                  <!-- end product name image two -->
                  <!-- product desc image one -->   
                 
                  <!-- end product desc image one -->
                  <!-- link button product two -->
                  
                  <!-- end link button product two -->
                   <!-- link button product two -->
                   
                  <!-- end link button product two --> 
                  </div>
                   <div class="tab-pane active" id="tab-cat-two-w">
asasasa
                   </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  







                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-h1<?php echo $language['language_id']; ?>"><?php echo $entry_meta_h1; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="category_description[<?php echo $language['language_id']; ?>][meta_h1]" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_h1'] : ''; ?>" placeholder="<?php echo $entry_meta_h1; ?>" id="input-meta-h1<?php echo $language['language_id']; ?>" class="form-control" />
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php } ?>                 
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_parent; ?></label>
                <div class="col-sm-10">
                  <select name="parent_id" class="form-control">
                    <option value="0" selected="selected"><?php echo $text_none; ?></option>
                    <?php foreach ($categories as $category) { ?>
                    <?php if ($category['category_id'] == $parent_id) { ?>
                    <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="<?php echo $help_filter; ?>"><?php echo $entry_filter; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="filter" value="" placeholder="<?php echo $entry_filter; ?>" id="input-filter" class="form-control" />
                  <div id="category-filter" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($category_filters as $category_filter) { ?>
                    <div id="category-filter<?php echo $category_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category_filter['name']; ?>
                      <input type="hidden" name="category_filter[]" value="<?php echo $category_filter['filter_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $category_store)) { ?>
                        <input type="checkbox" name="category_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="category_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $category_store)) { ?>
                        <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
                      
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="<?php echo $help_top; ?>"><?php echo $entry_top; ?></span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($top) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-column"><span data-toggle="tooltip" title="<?php echo $help_column; ?>"><?php echo $entry_column; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="column" value="<?php echo $column; ?>" placeholder="<?php echo $entry_column; ?>" id="input-column" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_store; ?></td>
                      <td class="text-left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?php echo $text_default; ?></td>
                      <td class="text-left"><select name="category_layout[0]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[0]) && $category_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php foreach ($stores as $store) { ?>
                    <tr>
                      <td class="text-left"><?php echo $store['name']; ?></td>
                      <td class="text-left"><select name="category_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[$store['store_id']]) && $category_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>










            <div class="tab-pane" id="tab-cat-one">
              <div class="table-responsive">
              <div class="clientService__right--click_one" id="xxxx">
      <!-- dop images -->
      <div class="cat__click--one">
                    <div class="col-sm-8"><a href="" id="thumb-top_tab_icon" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbtop_tab_icon; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="top_tab_icon" value="<?php echo $top_tab_icon; ?>" id="input-top_tab_icon" />
                    </div>
                  </div>
       <div class="row">
                  <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[1][nameTabCategory]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameTabCategory'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategory1" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[2][nameTabCategory]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameTabCategory'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategory2" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[3][nameTabCategory]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameTabCategory'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategory3" class="form-control" />
                  </div>

       <div class="cat__click--one" style="background: url(<? echo $thumbimagetwo; ?>)no-repeat;background-size: 100%;">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_imagetwo; ?>"><?php echo $entry_imagetwo; ?></label>
                    
                    <div class="col-sm-8"><a href="" id="thumb-imagetwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagetwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="imagetwo" value="<?php echo $imagetwo; ?>" id="input-imagetwo" />
                    </div>
                  </div>
                  
                    <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[1][descbannerone]" value="<?php echo isset($category_description[1]) ? $category_description[1]['descbannerone'] : ''; ?>" placeholder="<?php echo $descbannerone; ?>" id="input-descbannerone1" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[2][descbannerone]" value="<?php echo isset($category_description[2]) ? $category_description[2]['descbannerone'] : ''; ?>" placeholder="<?php echo $descbannerone; ?>" id="input-descbannerone2" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[3][descbannerone]" value="<?php echo isset($category_description[3]) ? $category_description[3]['descbannerone'] : ''; ?>" placeholder="<?php echo $descbannerone; ?>" id="input-descbannerone3" class="form-control" />
                    </div>
                  <!-- end desc banner one -->  
      </div>
      <div class="row">
        <div class="col-lg-12 columns cat__click--block">
        <div>
          <h3><?php echo isset($category_description[1]) ? $category_description[1]['titletwo'] : ''; ?>
            <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[1][titletwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['titletwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwo1" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[2]) ? $category_description[2]['titletwo'] : ''; ?>
            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[2][titletwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['titletwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwo2" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[3]) ? $category_description[3]['titletwo'] : ''; ?>
            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[3][titletwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['titletwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwo3" class="form-control" />
        </div>
              

          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][description_two]" placeholder="<?php echo $entry_description; ?>" id="input-description1" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['description_two'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][description_two]" placeholder="<?php echo $entry_description; ?>" id="input-description2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['description_two'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <textarea name="category_description[3][description_two]" placeholder="<?php echo $entry_description; ?>" id="input-description3" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[3]) ? $category_description[3]['description_two'] : ''; ?></textarea>
          </div>
        </div>
      </div>
      
        <div class="col-lg-12 columns cat__click--buttom">
        <div class="col-lg-4">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkbuttom]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkbuttom'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h11" class="form-control" />
            <input type="text" name="category_description[1][textbuttom]" value="<?php echo isset($category_description[1]) ? $category_description[1]['textbuttom'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h11" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkbuttom]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkbuttom'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h12" class="form-control" />
            <input type="text" name="category_description[2][textbuttom]" value="<?php echo isset($category_description[2]) ? $category_description[2]['textbuttom'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h12" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkbuttom]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkbuttom'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h1<?php echo $language['language_id']; ?>" class="form-control" />
            <input type="text" name="category_description[3][textbuttom]" value="<?php echo isset($category_description[3]) ? $category_description[3]['textbuttom'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h13" class="form-control" />
        </div>
        </div>
        <div class="col-lg-12 cat__click--twoimg columns" style="background: url(../image/<?php echo $imagethree; ?>) no-repeat;background-size: 100%;">
            <a href="" id="thumb-imagethree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagethree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
            <input type="hidden" name="imagethree" value="<?php echo $imagethree; ?>" id="input-imagethree" />
            
              <div class="col-lg-3">
              <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[1][nameimgthree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameimgthree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h11" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[2][nameimgthree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameimgthree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h12" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[3][nameimgthree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameimgthree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h13" class="form-control" />
              </div>

        </div>
        <div class="col-lg-8 cat__click--prodimgone">
          <img src="../image/<?php echo $productimgone; ?>" class="img-responsive" />        
        </div>
        <div class="col-lg-4"><a href="" id="thumb-productimgone" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductimgone; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="productimgone" value="<?php echo $productimgone; ?>" id="input-productimgone" />
        </div>
        <div class="col-lg-6 columns cat__click--prodone">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodDescImgOne]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOne1" class="form-control" />

        <img src="language/ua-ua/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodDescImgOne]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOne2" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodDescImgOne]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodDescImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOne3" class="form-control" />
          <br />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][prodNameImgOne]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOne1" class="form-control" />

           <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][prodNameImgOne]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOne2" class="form-control" />

           <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][prodNameImgOne]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgOne'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOne3" class="form-control" />
          </div>
        </div>
        <div class="col-lg-4 cat__click--prodtwo">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodNameImgTwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgTwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h11" class="form-control" />

        <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodNameImgTwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgTwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h12" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodNameImgTwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgTwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h13" class="form-control" />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][prodDescImgTwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwo1" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgTwo'] : ''; ?></textarea>

          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwo2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwo'] : ''; ?></textarea>

          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwo2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwo'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkButProdTwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h11" class="form-control" />               
            <input type="text" name="category_description[1][NameButProdTwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['NameButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h11" class="form-control" />


            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkButProdTwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h12" class="form-control" />               
            <input type="text" name="category_description[2][NameButProdTwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['NameButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h12" class="form-control" />


            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkButProdTwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h13" class="form-control" />               
            <input type="text" name="category_description[3][NameButProdTwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['NameButProdTwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h13" class="form-control" />
          </div>
        </div>
        <div class="col-lg-3 cat__click--prodimgtwo">
          <img src="../image/<?php echo $productImgTwo; ?>" alt="" style="max-width:100%;">
          <a href="" id="thumb-productImgTwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgTwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgTwo" value="<?php echo $productImgTwo; ?>" id="input-productImgTwo" />
        </div>
        <div class="col-lg-5 cat__click--prodimgthree">
          <img src="../image/<?php echo $productImgThree; ?>" style="max-width:100%;" alt="">
          <a href="" id="thumb-productImgThree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgThree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgThree" value="<?php echo $productImgThree; ?>" id="input-productImgThree" />
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>






                ddddddddddddddd
               
                   <!-- dop images -->
             
              <!-- end dop images -->
               <!-- product images one -->
                 
                  <!-- end product images one -->
                   <!-- product images two -->
                  
                  <!-- end product images two --> 
                   <!-- product images three -->
                 
                  <!-- end product images one --> 
                   <!-- category banner in product -->
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_categoryBanner; ?>"><?php echo $entry_categoryBanner; ?></label>
                    
                    <div class="col-sm-10"><a href="" id="thumb-categoryBanner" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbcategoryBanner; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="categoryBanner" value="<?php echo $categoryBanner; ?>" id="input-categoryBanner" />
                    </div>
                  </div>
                  <!-- end category banner in product -->    
                   <!-- category banner in product two-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_categoryBannerTwo; ?>"><?php echo $entry_categoryBannerTwo; ?></label>
                    
                    <div class="col-sm-10"><a href="" id="thumb-categoryBannerTwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbcategoryBannerTwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="categoryBannerTwo" value="<?php echo $categoryBannerTwo; ?>" id="input-categoryBannerTwo" />
                    </div>
                  </div>
                  <!-- end category banner in product two-->     
              </div>































              <div class="tab-pane" id="tab-cat-two">
              <div class="table-responsive">
              <div class="clientService__right--click" id="xxxx">
      <!-- dop images -->
      <div class="cat__click--one">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_top_tab_icon_two; ?>"><?php echo $entry_top_tab_icon_two; ?></label>
                    
                    <div class="col-sm-8"><a href="" id="thumb-top_tab_icon_two" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbtop_tab_icon_two; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="top_tab_icon_two" value="<?php echo $top_tab_icon_two; ?>" id="input-top_tab_icon_two" />
                    </div>
                  </div>
      
       <div class="row">
                  <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[1][nameTabCategorytwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameTabCategorytwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorytwo1" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[2][nameTabCategorytwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameTabCategorytwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorytwo2" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[3][nameTabCategorytwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameTabCategorytwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorytwo3" class="form-control" />
                  </div>

      <div class="cat__click--one" style="background: url(<? echo $thumbimagetwotwo; ?>)no-repeat;background-size: 100%;">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_imagetwotwo; ?>"><?php echo $entry_imagetwotwo; ?></label>
                    
                    <div class="col-sm-8"><a href="" id="thumb-imagetwotwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagetwotwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="imagetwotwo" value="<?php echo $imagetwotwo; ?>" id="input-imagetwotwo" />
                    </div>
                  </div>
                  
                    <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[1][descbanneronetwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['descbanneronetwo'] : ''; ?>" placeholder="<?php echo $descbanneronetwo; ?>" id="input-descbanneronetwo1" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[2][descbanneronetwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['descbanneronetwo'] : ''; ?>" placeholder="<?php echo $descbanneronetwo; ?>" id="input-descbanneronetwo2" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[3][descbanneronetwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['descbanneronetwo'] : ''; ?>" placeholder="<?php echo $descbanneronetwo; ?>" id="input-descbanneronetwo3" class="form-control" />
                    </div>
                  <!-- end desc banner one -->  
      </div>
      <div class="row">
        <div class="col-lg-12 columns cat__click--block">
        <div>
          <h3><?php echo isset($category_description[1]) ? $category_description[1]['titletwotwo'] : ''; ?>
            <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[1][titletwotwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['titletwotwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwotwo1" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[2]) ? $category_description[2]['titletwotwo'] : ''; ?>
            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[2][titletwotwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['titletwotwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwotwo2" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[3]) ? $category_description[3]['titletwotwo'] : ''; ?>
            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[3][titletwotwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['titletwotwo'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwotwo3" class="form-control" />
        </div>
              

          <div>
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][description_twotwo]" placeholder="<?php echo $entry_description; ?>" id="input-descriptiontwotwo3" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['description_twotwo'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][description_twotwo]" placeholder="<?php echo $entry_description; ?>" id="input-descriptiontwotwo3" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['description_twotwo'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[3][description_twotwo]" placeholder="<?php echo $entry_description; ?>" id="input-descriptiontwotwo3" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[3]) ? $category_description[3]['description_twotwo'] : ''; ?></textarea>
          </div>
        </div>
      </div>
      
        <div class="col-lg-12 columns cat__click--buttom">
        <div class="col-lg-4">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkbuttomtwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-twotwo" class="form-control" />
            <input type="text" name="category_description[1][textbuttomtwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['textbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-two" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkbuttomtwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h12" class="form-control" />
            <input type="text" name="category_description[2][textbuttomtwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['textbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h12" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkbuttomtwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h13" class="form-control" />
            <input type="text" name="category_description[3][textbuttomtwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['textbuttomtwo'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h13" class="form-control" />
        </div>
        </div>
        <div class="col-lg-12 cat__click--twoimg columns" style="background: url(../image/<?php echo $imagethreetwo; ?>) no-repeat;background-size: 100%;">
            <a href="" id="thumb-imagethree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagethreetwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
            <input type="hidden" name="imagethreetwo" value="<?php echo $imagethreetwo; ?>" id="input-imagethreetwo" />
            
              <div class="col-lg-3">
              <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[1][nameimgthreetwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameimgthreetwo'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h11" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[2][nameimgthreetwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameimgthreetwo'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h12" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[3][nameimgthreetwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameimgthreetwo'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h13" class="form-control" />
              </div>

        </div>
        <div class="col-lg-8 cat__click--prodimgone">
          <img src="../image/<?php echo $productimgonetwo; ?>" class="img-responsive" />        
        </div>
        <div class="col-lg-4"><a href="" id="thumb-productimgone" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductimgonetwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="productimgonetwo" value="<?php echo $productimgonetwo; ?>" id="input-productimgonetwo" />
        </div>
        <div class="col-lg-6 columns cat__click--prodone">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodDescImgOnetwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnetwo1" class="form-control" />

        <img src="language/ua-ua/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodDescImgOnetwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnetwo2" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodDescImgOnetwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodDescImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnetwo3" class="form-control" />
          <br />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][prodNameImgOnetwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnetwo1" class="form-control" />

           <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][prodNameImgOnetwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnetwo2" class="form-control" />

           <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][prodNameImgOnetwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgOnetwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnetwo3" class="form-control" />
          </div>
        </div>
        <div class="col-lg-4 cat__click--prodtwo">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodNameImgTwotwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgTwotwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h11" class="form-control" />

        <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodNameImgTwotwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgTwotwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h12" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodNameImgTwotwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgTwotwo'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h13" class="form-control" />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][prodDescImgTwotwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwotwo1" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgTwotwo'] : ''; ?></textarea>

          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwotwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwotwo2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwotwo'] : ''; ?></textarea>

          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwotwo]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwotwo2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwotwo'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkButProdTwotwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h11" class="form-control" />               
            <input type="text" name="category_description[1][NameButProdTwotwo]" value="<?php echo isset($category_description[1]) ? $category_description[1]['NameButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h11" class="form-control" />


            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkButProdTwotwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h12" class="form-control" />               
            <input type="text" name="category_description[2][NameButProdTwotwo]" value="<?php echo isset($category_description[2]) ? $category_description[2]['NameButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h12" class="form-control" />


            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkButProdTwotwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h13" class="form-control" />               
            <input type="text" name="category_description[3][NameButProdTwotwo]" value="<?php echo isset($category_description[3]) ? $category_description[3]['NameButProdTwotwo'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h13" class="form-control" />
          </div>
        </div>
        <div class="col-lg-3 cat__click--prodimgtwo">
          <img src="../image/<?php echo $productImgTwotwo; ?>" alt="" style="max-width:100%;">
          <a href="" id="thumb-productImgTwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgTwotwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgTwotwo" value="<?php echo $productImgTwotwo; ?>" id="input-productImgTwo" />
        </div>
        <div class="col-lg-5 cat__click--prodimgthree">
          <img src="../image/<?php echo $productImgThreetwo; ?>" style="max-width:100%;" alt="">
          <a href="" id="thumb-productImgThreetwo" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgThreetwo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgThreetwo" value="<?php echo $productImgThreetwo; ?>" id="input-productImgThreetwo" />
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>             
              </div>





































 <div class="tab-pane" id="tab-cat-three">
              <div class="table-responsive">
              <div class="clientService__right--click" id="xxxx">
       <!-- dop images -->
      <div class="cat__click--one">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_top_tab_icon_three; ?>"><?php echo $entry_top_tab_icon_three; ?></label>
                    
                    <div class="col-sm-8"><a href="" id="thumb-top_tab_icon_three" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbtop_tab_icon_three; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="top_tab_icon_three" value="<?php echo $top_tab_icon_three; ?>" id="input-top_tab_icon_three" />
                    </div>
                  </div>
      
       <div class="row">
                  <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[1][nameTabCategorythree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameTabCategorythree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorythree1" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[2][nameTabCategorythree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameTabCategorythree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorythree2" class="form-control" />
                  </div>

                  <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                      <input type="text" name="category_description[3][nameTabCategorythree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameTabCategorythree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-nameTabCategorythree3" class="form-control" />
                  </div>

       <div class="cat__click--one" style="background: url(<? echo $thumbimagetwothree; ?>)no-repeat;background-size: 100%;">
                    <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_imagetwo; ?>"><?php echo $entry_imagetwo; ?></label>
                    
                    <div class="col-sm-8"><a href="" id="thumb-imagetwothree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagetwothree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="imagetwothree" value="<?php echo $imagetwothree; ?>" id="input-imagetwothree" />
                    </div>
                  </div>
                  
                    <div class="col-sm-4">
                    <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[1][descbanneronethree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['descbanneronethree'] : ''; ?>" placeholder="<?php echo $descbanneronethree; ?>" id="input-descbanneronethree1" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/en-gb/en-gb.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[2][descbanneronethree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['descbanneronethree'] : ''; ?>" placeholder="<?php echo $descbanneronethree; ?>" id="input-descbanneronethree2" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                    <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;" title="<?php echo $language['name']; ?>" />
                      <input type="text" name="category_description[3][descbanneronethree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['descbanneronethree'] : ''; ?>" placeholder="<?php echo $descbanneronethree; ?>" id="input-descbanneronethree3" class="form-control" />
                    </div>
                  <!-- end desc banner one -->  
      </div>
      <div class="row">
        <div class="col-lg-12 columns cat__click--block">
        <div>
          <h3><?php echo isset($category_description[1]) ? $category_description[1]['titletwothree'] : ''; ?>
            <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[1][titletwothree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['titletwothree'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwothree1" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[2]) ? $category_description[2]['titletwothree'] : ''; ?>
            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[2][titletwothree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['titletwothree'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwothree2" class="form-control" />
        </div>
         <div>
          <h3><?php echo isset($category_description[3]) ? $category_description[3]['titletwothree'] : ''; ?>
            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          </h3>
          <input type="text" name="category_description[3][titletwothree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['titletwothree'] : ''; ?>" placeholder="<?php echo $entry_titletwo; ?>" id="input-titletwothree3" class="form-control" />
        </div>
              

          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][description_twothree]" placeholder="<?php echo $entry_description; ?>" id="input-description1three" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['description_twothree'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][description_twothree]" placeholder="<?php echo $entry_description; ?>" id="input-description2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['description_twothree'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <textarea name="category_description[3][description_twothree]" placeholder="<?php echo $entry_description; ?>" id="input-descriptionthree3" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[3]) ? $category_description[3]['description_twothree'] : ''; ?></textarea>
          </div>
        </div>
      </div>
      
        <div class="col-lg-12 columns cat__click--buttom">
        <div class="col-lg-4">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkbuttomthree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h11" class="form-control" />
            <input type="text" name="category_description[1][textbuttomthree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['textbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h11" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkbuttomthree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h12" class="form-control" />
            <input type="text" name="category_description[2][textbuttomthree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['textbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h12" class="form-control" />
        </div>
        <div class="col-lg-4">
          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkbuttomthree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_linkbuttom; ?>" id="input-meta-h13" class="form-control" />
            <input type="text" name="category_description[3][textbuttomthree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['textbuttomthree'] : ''; ?>" placeholder="<?php echo $entry_textbuttom; ?>" id="input-meta-h13" class="form-control" />
        </div>
        </div>
        <div class="col-lg-12 cat__click--twoimg columns" style="background: url(../image/<?php echo $imagethreethree; ?>) no-repeat;background-size: 100%;">
            <a href="" id="thumb-imagethreethree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimagethreethree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
            <input type="hidden" name="imagethreethree" value="<?php echo $imagethreethree; ?>" id="input-imagethreethree" />
            
              <div class="col-lg-3">
              <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[1][nameimgthreethree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['nameimgthreethree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h11" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[2][nameimgthreethree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['nameimgthreethree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h12" class="form-control" />
              </div>
              <div class="col-lg-3">
              <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
                <input type="text" name="category_description[3][nameimgthreethree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['nameimgthreethree'] : ''; ?>" placeholder="<?php echo $entry_nameimgthree; ?>" id="input-meta-h13" class="form-control" />
              </div>

        </div>
        <div class="col-lg-8 cat__click--prodimgone">
          <img src="../image/<?php echo $productimgonethree; ?>" class="img-responsive" />        
        </div>
        <div class="col-lg-4"><a href="" id="thumb-productimgonethree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductimgonethree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="productimgonethree" value="<?php echo $productimgonethree; ?>" id="input-productimgonethree" />
        </div>
        <div class="col-lg-6 columns cat__click--prodone">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodDescImgOnethree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnethree1" class="form-control" />

        <img src="language/ua-ua/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodDescImgOnethree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnethree2" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodDescImgOnethree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodDescImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodDescImgOne; ?>" id="input-prodDescImgOnethree3" class="form-control" />
          <br />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][prodNameImgOnethree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnethree1" class="form-control" />

           <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][prodNameImgOnethree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnethree2" class="form-control" />

           <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][prodNameImgOnethree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgOnethree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgOne; ?>" id="input-prodNameImgOnethree3" class="form-control" />
          </div>
        </div>
        <div class="col-lg-4 cat__click--prodtwo">
        <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[1][prodNameImgTwothree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['prodNameImgTwothree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h11" class="form-control" />

        <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[2][prodNameImgTwothree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['prodNameImgTwothree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h12" class="form-control" />

        <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
          <input type="text" name="category_description[3][prodNameImgTwothree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['prodNameImgTwothree'] : ''; ?>" placeholder="<?php echo $entry_prodNameImgTwo; ?>" id="input-meta-h13" class="form-control" />
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <textarea name="category_description[1][prodDescImgTwothree]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwothree1" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[1]) ? $category_description[1]['prodDescImgTwothree'] : ''; ?></textarea>

          <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwothree]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwothree2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwothree'] : ''; ?></textarea>

          <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <textarea name="category_description[2][prodDescImgTwothree]" placeholder="<?php echo $entry_prodDescImgTwo; ?>" id="input-prodDescImgTwothree2" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($category_description[2]) ? $category_description[2]['prodDescImgTwothree'] : ''; ?></textarea>
          </div>
          <div>
          <img src="language/ru-ru/ru-ru.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[1][linkButProdTwothree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['linkButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h11" class="form-control" />               
            <input type="text" name="category_description[1][NameButProdTwothree]" value="<?php echo isset($category_description[1]) ? $category_description[1]['NameButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h11" class="form-control" />


            <img src="language/en-gb/en-gb.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[2][linkButProdTwothree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['linkButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h12" class="form-control" />               
            <input type="text" name="category_description[2][NameButProdTwothree]" value="<?php echo isset($category_description[2]) ? $category_description[2]['NameButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h12" class="form-control" />


            <img src="language/ua-ua/ua-ua.png" style="max-width: 20px;"/>
            <input type="text" name="category_description[3][linkButProdTwothree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['linkButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_linkButProdTwo; ?>" id="input-meta-h13" class="form-control" />               
            <input type="text" name="category_description[3][NameButProdTwothree]" value="<?php echo isset($category_description[3]) ? $category_description[3]['NameButProdTwothree'] : ''; ?>" placeholder="<?php echo $entry_NameButProdTwo; ?>" id="input-meta-h13" class="form-control" />
          </div>
        </div>
        <div class="col-lg-3 cat__click--prodimgtwo">
          <img src="../image/<?php echo $productImgTwothree; ?>" alt="" style="max-width:100%;">
          <a href="" id="thumb-productImgTwothree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgTwothree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgTwothree" value="<?php echo $productImgTwo; ?>" id="input-productImgTwothree" />
        </div>
        <div class="col-lg-5 cat__click--prodimgthree">
          <img src="../image/<?php echo $productImgThreethree; ?>" style="max-width:100%;" alt="">
          <a href="" id="thumb-productImgThreethree" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbproductImgThreethree; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="productImgThreethree" value="<?php echo $productImgThreethree; ?>" id="input-productImgThreethree" />
        </div>
      </div>
      <!--<?php echo $category['short_description']; ?>-->
      
    </div>             
              </div>





















            </div>





























          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
  <?php if ($ckeditor) { ?>
    <?php foreach ($languages as $language) { ?>
        ckeditorInit('input-description<?php echo $language['language_id']; ?>', getURLVar('token'));
    <?php } ?>
  <?php } ?>
  //--></script>
  <script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['filter_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter\']').val('');

		$('#category-filter' + item['value']).remove();

		$('#category-filter').append('<div id="category-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_filter[]" value="' + item['value'] + '" /></div>');
	}
});

$('#category-filter').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>
