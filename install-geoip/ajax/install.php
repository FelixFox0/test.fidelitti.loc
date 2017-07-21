<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    // Autoloader
    function autoload($class) {

        $file = DIR_SYSTEM . 'library/' . str_replace('\\', '/', strtolower($class)) . '.php';

        if (file_exists($file)) {
            include($file);

            return true;
        }
        else {
            return false;
        }
    }

    spl_autoload_register('autoload');
    spl_autoload_extensions('.php');

    require_once '../config.php';
    require_once '../library/install.php';
    require_once '../library/step.php';

    $count_steps = count($config['steps']);

    if (empty($_SESSION['pr']['step'])) {
        $_SESSION['pr']['step'] = 0;
    }

    $step_number = $_SESSION['pr']['step'];
    $json = array();

    if ($step_number < $count_steps) {

        $install = new Install();

        if ($install->step($config['steps'][$step_number])) {
            $json['status'] = 'process';
            $json['percentage'] = ($step_number + 1) * floor(100 / $count_steps);
            $_SESSION['pr']['step']++;
        }
        else {
            $json['status'] = 'error';
            $json['text'] = $install->getError();
        }
    }
    else {
        $json['status'] = 'success';
        $json['text'] = 'Установка модуля успешно завершена<br>Удалите папку "install-geoip" из корня сайта';
        unset($_SESSION['pr']);
    }

    if (isset($_GET['callback'])) {
        echo $_GET['callback'] . '(' . json_encode($json) . ')';
    }
    else {
        echo '<pre>';
        print_r($json);
    }
    die;