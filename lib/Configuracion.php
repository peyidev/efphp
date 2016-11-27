<?php
session_start();

$path = realpath(dirname(__FILE__));
$path = substr($path,0,-3);

$port = ($_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domain = $port . $_SERVER['SERVER_NAME'];
$domainGlobal = "https://" . $_SERVER['SERVER_NAME'];

define('BASE_PATH', $path);

define('HOSTNAME', '127.0.0.1');
define('DATABASE', 'mhmproperties');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'admin');

#Paypal config

define('USR','');
define('PWD','');
define('SIGNATURE','');
define('PAYPALURL','');

#Global config
define('GOOGLEANALYTICS', 'UA-6593369-14');
define('ADMINURL', 'admin/');
define('DEFAULT_S', 'home.php');
define('GLOBALURL', $domainGlobal);
define('LOGO', 'css/img/logo.png');
define('LOGGING', true);

#Fix for php7

@define('MYSQL_BOTH',MYSQLI_BOTH);
@define('MYSQL_NUM',MYSQLI_NUM);
@define('MYSQL_ASSOC',MYSQLI_ASSOC);






function __autoload($f) {

    if(file_exists(BASE_PATH . "lib/$f.php")){

        require_once realpath(BASE_PATH . "lib/$f.php");
    }

}

$mysqli = Database::connect();
