<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error; ?></div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i><?php echo $success; ?></div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="content">
                <div class="panel-body">
                    <form action="<?php echo $uploadAndImportAction; ?>" method="post" enctype="multipart/form-data" name="upload-and-import" id="upload-and-import-form">
                        <div id="upload-and-import" class="box">
                            <div class="heading">
                                <h2><?php echo $language->get('Upload and run import'); ?></h2>
                            </div>
                            <div class="">
                                <div class="box">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <td><?php echo $language->get('CSV file received from DPD'); ?></td>
                                            <td>
                                                <input type="file" name="csv"/>
                                                <input type="submit" value="<?php echo $language->get('Upload & Import'); ?>"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="<?php echo $importAction; ?>" method="post" name="import" id="import-form">
                        <div id="import" class="box">
                            <div class="heading">
                                <h2><?php echo $language->get('Import an existing file'); ?></h2>
                                <div class="buttons">
                                </div>
                            </div>
                            <div class="">
                                <div class="box">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <td><?php echo $language->get('File name of the CSV found in download/dpd/postcode_update/'); ?></td>
                                            <td>
                                                <input class="form-control" type="text" name="csv_path" size="100" value="">
                                                <input type="submit" value="<?php echo $language->get('Import'); ?>">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="available-list" class="box">
                        <div class="heading">
                            <h2><?php echo $language->get('Available files'); ?></h2>
                            <div class="buttons">
                            </div>
                        </div>

                        <div class="">
                            <div class="box">
                                <?php if(isset($uploaded_files)) { ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="left"><?php echo $language->get('Filename'); ?></td>
                                        <td class="left"><?php echo $language->get('Modified'); ?></td>
                                    </tr>
                                    </thead>
                                    <?php foreach($uploaded_files as $file => $modified) { ?>
                                    <tr>
                                        <td class="left"><?php echo $file; ?></td>
                                        <td class="left"><?php echo date('d-m-Y H:i',$modified); ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <?php } else { ?>
                                <p><?php echo $language->get('No files available'); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>