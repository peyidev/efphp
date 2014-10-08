<?php
session_start();

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/ephp/');

define('HOSTNAME', 'localhost');
define('DATABASE', 'killerrace');
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
define('GLOBALURL', 'http://killerrace.com/');

function __autoload($f) {

    if(file_exists(BASE_PATH . "lib/$f.php")){

        require_once BASE_PATH . "lib/$f.php";
    }

}

$mysqli = new Database();
$mysqli = $mysqli->connect();
