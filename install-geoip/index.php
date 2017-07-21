<?php
    include_once '../config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Установка</title>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        $(function() {
            function process(percentage) {
                if (!percentage) {
                    percentage = 0;
                }

                $('#progress-bar-install').width(percentage + '%');

                $.ajax({
                    url:      '<?php echo HTTPS_SERVER; ?>install-geoip/ajax/install.php',
                    data:     $('#form-install').find("input[type='checkbox']:checked, input[type='radio']:checked"),
                    dataType: 'jsonp',
                    crossDomain: true,
                    cache: false,
                    success:  function(json) {
                        switch (json.status) {
                            case 'process':
                                process(json.percentage);
                                break;

                            case 'success':
                                success(json.text);
                                break;

                            case 'error':
                                error(json.text);
                                break;

                            default:
                                error('Неизвестная ошибка');
                        }
                    },
                    error:    function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }

            function error(text) {
                $('#myModal').modal('hide');
                var panel = $('#panel-install').removeClass('panel-primary').addClass('panel-danger');
                panel.find('.panel-title').html('Ошибка');
                panel.find('.panel-content').html(text);
            }

            function success(text) {
                $('#myModal').modal('hide');
                var panel = $('#panel-install').removeClass('panel-primary').addClass('panel-success');
                panel.find('.panel-title').html('Установка завершена');
                panel.find('.panel-content').html(text);
            }

            $('#btn-install').click(function() {
                $('#myModal').modal({backdrop: 'static'});
                process();
            });
        });
    </script>
</head>
<body>
<div class="container" style="position: relative; top: 150px;">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div id="panel-install" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        Установка модуля GeoIP
                    </div>
                </div>

                <div class="panel-content">
                    <form class="form-horizontal" id="form-install">
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                Установить базу населенных пунктов России:
                                <div class="col-lg-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="install_ru" value="none">
                                            нет
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="install_ru" value="city">
                                            Только города
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="install_ru" value="all" checked>
                                            Полностью (города, поселки, деревни и т.д.)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="install_ua" value="1">
                                        Установить базу населенных пунктов Украины
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="install_by" value="1">
                                        Установить базу населенных пунктов Белоруссии
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="install_kz" value="1">
                                        Установить базу населенных пунктов Казахстана
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <a href="#myModal" id="btn-install" class="btn btn-primary">Установить</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active">
                    <div id="progress-bar-install" class="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>