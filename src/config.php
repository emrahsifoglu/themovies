<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', str_replace("web","", dirname($_SERVER['PHP_SELF'])));
define('RESOURCES', ROOT.'resources/');
define('STYLES', RESOURCES.'public/css/');
define('SCRIPTS', RESOURCES.'public/js/');
define('LAYOUT', '../resources/views/layout.php');

define('SRC_PATH', $_SERVER['DOCUMENT_ROOT'].ROOT.'src');
define('CORE_PATH', SRC_PATH.'/app/core/');
define('CONTROLLER_PATH', SRC_PATH.'/mvc/controllers/');
define('MODEL_PATH', SRC_PATH.'/mvc/models/');
define('VIEW_PATH', SRC_PATH.'/mvc/views/');

define ("DB", serialize (array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'themovies'
)));