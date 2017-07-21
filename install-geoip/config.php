<?php
    define('DIR_PRINSTALL', rtrim(dirname(__FILE__), '/') . '/');
    define('DIR_PRINSTALL_DATA', DIR_PRINSTALL . 'data/');

    $config['steps'] = array('import_db', 'import_db_fias_ru', 'import_db_fias_ua', 'import_db_fias_by', 'import_db_fias_kz');

    function prlog($message) {
        $file = fopen(DIR_PRINSTALL . 'error.log', 'a');
        fwrite($file, date('[Y-m-d H:i:s] ') . $message . PHP_EOL);
        fclose($file);
    }

    function error_handler($errno, $errstr, $errfile, $errline) {

        switch ($errno) {
            case E_NOTICE:
            case E_USER_NOTICE:
                $error = 'Notice';
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $error = 'Warning';
                break;
            case E_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
                break;
            default:
                $error = 'Unknown';
                break;
        }

        prlog($error . ': ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);

        return true;
    }

    // Error Handler
    set_error_handler('error_handler');