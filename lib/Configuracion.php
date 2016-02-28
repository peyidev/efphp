<?php
session_start();

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/medios/ephp/');

define('HOSTNAME', 'localhost');
define('DATABASE', 'medios');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

#Paypal config

define('USR','');
define('PWD','');
define('SIGNATURE','');
define('PAYPALURL','');

#Global config
define('ADMINURL', 'admin/');
define('DEFAULT_S', 'home.php');
define('GLOBALURL', 'http://localhost');
define('LOGO', 'css/img/logo.png');
define('LOGGING', true);

function __autoload($f) {

    if(file_exists(BASE_PATH . "lib/$f.php")){

        require_once BASE_PATH . "lib/$f.php";
    }

}

$mysqli = Database::connect();
