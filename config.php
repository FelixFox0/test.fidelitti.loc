<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
$http_host = $_SERVER['HTTP_HOST'];
// HTTP
define('HTTP_SERVER', 'http://' . $http_host . '/');

// HTTPS
define('HTTPS_SERVER', 'http://' . $http_host . '/');

// DIR
define('DIR_APPLICATION', $document_root . '/catalog/');
define('DIR_SYSTEM', $document_root . '/system/');
define('DIR_IMAGE', $document_root . '/image/');
define('DIR_LANGUAGE', $document_root . '/catalog/language/');
define('DIR_TEMPLATE', $document_root . '/catalog/view/theme/');
define('DIR_CONFIG', $document_root . '/system/config/');
define('DIR_CACHE', $document_root . '/system/storage/cache/');
define('DIR_DOWNLOAD', $document_root . '/system/storage/download/');
define('DIR_LOGS', $document_root . '/system/storage/logs/');
define('DIR_MODIFICATION', $document_root . '/system/storage/modification/');
define('DIR_UPLOAD', $document_root . '/system/storage/upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'admin_fidelitti');
define('DB_PORT', '3306');
define('DB_PREFIX', 'f_');
