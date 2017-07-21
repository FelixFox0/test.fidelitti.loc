<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
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
<?php if (isset($error_warning)) { ?>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
<?php if (isset($success)) { ?>
<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"
      class="form-horizontal">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $main_settings; ?></h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="source_language_code"><?php echo $source_language; ?></label>

            <div class="col-sm-10">
                <select name="source_language_code" id="source_language_code" class="form-control">
                    <?php foreach ($languages as $language) {
                                    echo '<option value="' . $language['code'] . '"' . ($language['code'] == $source_language_code ? ' selected="selected"' : '') . '>' . $language['name'] . '</option>';
                    }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="do_transliteration"><?php echo $transliteration; ?></label>

            <div class="col-sm-10">
                <input type="hidden" name="do_transliteration" value="0">

                <div class="checkbox">
                    <label><input type="checkbox" name="do_transliteration"<?php if ($do_transliteration == 1) echo ' checked="checked"'; ?> value="1"> <?php echo $transliteration_detail; ?></label></div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $categories; ?></h3>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="categories_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <input type="text" id="categories_template" name="categories_template" value="<?php echo $categories_template; ?>" class="form-control">

                <p><?php echo $available_category_tags; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="categories_suffix"><?php echo $extension; ?></label>

            <div class="col-sm-10">
                <input type="text" id="categories_suffix" name="categories_suffix" value="<?php echo $categories_suffix; ?>" class="form-control">

                <p><?php echo $extension_warning; ?></p>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="categories_suffix"><?php echo $overwrite; ?></label>

            <div class="col-sm-10">
                <select name="overwrite_categories" id="overwrite_categories" class="form-control">
                    <option value="overwrite"><?php echo $overwrite_all; ?></option>
                    <option value="dont_overwrite"><?php echo $dont_overwrite; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="categories"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" id="categories" name="categories" value="categories" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear; ?></p>
            </div>
        </div>

    </div>
</div>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $products; ?></h3>
    </div>

    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="products_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <input type="text" id="products_template" name="products_template" value="<?php echo $products_template; ?>" class="form-control">

                <p><?php echo $available_product_tags; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="products_suffix"><?php echo $extension; ?></label>

            <div class="col-sm-10">
                <input type="text" id="products_suffix" name="products_suffix" value="<?php echo $products_suffix; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="overwrite_products"><?php echo $overwrite; ?></label>

            <div class="col-sm-10">
                <select name="overwrite_products" id="overwrite_products" class="form-control">
                    <option value="overwrite"><?php echo $overwrite_all; ?></option>
                    <option value="dont_overwrite"><?php echo $dont_overwrite; ?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="products"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" name="products" value="products" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear; ?></p>
            </div>
        </div>

    </div>

</div>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $manufacturers; ?></h3>
    </div>

    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="manufacturers_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <input type="text" id="manufacturers_template" name="manufacturers_template" value="<?php echo $manufacturers_template; ?>" class="form-control">

                <p><?php echo $available_manufacturer_tags; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="manufacturers_suffix"><?php echo $extension; ?></label>

            <div class="col-sm-10">
                <input type="text" id="manufacturers_suffix" name="manufacturers_suffix" value="<?php echo $manufacturers_suffix; ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="overwrite_manufacturers"><?php echo $overwrite; ?></label>

            <div class="col-sm-10">
                <select name="overwrite_manufacturers" id="overwrite_manufacturers" class="form-control">
                    <option value="overwrite"><?php echo $overwrite_all; ?></option>
                    <option value="dont_overwrite"><?php echo $dont_overwrite; ?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="manufacturers"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" name="manufacturers" value="manufacturers" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear; ?></p>
            </div>
        </div>

    </div>

</div>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $products_meta_keywords; ?></h3>
    </div>

    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="meta_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <input type="text" id="meta_template" name="meta_template" value="<?php echo $meta_template; ?>" class="form-control">

                <p><?php echo $available_meta_tags; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="meta_keywords"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" name="meta_keywords" value="meta_keywords" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear_meta; ?></p>
            </div>
        </div>

    </div>

</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $categories_meta_keywords; ?></h3>
    </div>

    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="categories_meta_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <select id="categories_meta_template" name="categories_meta_template" class="form-control">
                    <option value="parents"><?php echo $categories_meta_keywords_template_parents; ?></option>
                    <option value="no_parents"><?php echo $categories_meta_keywords_template_no_parents; ?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="meta_keywords"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" id="categories_meta_keywords" name="categories_meta_keywords" value="categories_meta_keywords" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear_meta; ?></p>
            </div>
        </div>

    </div>

</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $tags; ?></h3>
    </div>

    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="tags_template"><?php echo $template; ?></label>

            <div class="col-sm-10">
                <input type="text" id="tags_template" name="tags_template" value="<?php echo $tags_template; ?>" class="form-control">

                <p><?php echo $available_tags_tags; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="tags"><?php echo $generate; ?></label>

            <div class="col-sm-10">
                <button type="submit" name="tags" value="tags" class="btn btn-primary"><?php echo $generate; ?></button>
                <p><?php echo $warning_clear_tags; ?></p>
            </div>
        </div>

    </div>

</div>


</form>

</div>
</div>
<?php echo $footer; ?>