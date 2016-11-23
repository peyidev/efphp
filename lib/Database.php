<?php

class Database  {

    private static $host = HOSTNAME;
    private static $user = DB_USERNAME;
    private static $pass = DB_PASSWORD;
    private static $db = DATABASE;
    private static $myconn;
    private static $myconnPDO;
    public $util;

    function __construct(){
        $this->util = new Utils();
    }


    public static function connect($type = "mysql",$host = null,$user = null, $pass = null, $db = null) {

        $host = empty($host) ? self::$host : $host;
        $user = empty($user) ? self::$user : $user;
        $pass = empty($pass) ? self::$pass : $pass;
        $db = empty($db) ? self::$db : $db;

        switch($type){

            case "PDO":

                $con = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$myconnPDO = $con;
                return self::$myconnPDO;

                break;

            case "mysql":


                if(empty(self::$myconn))
                    $con = mysqli_connect($host, $user, $pass);
                else
                    return self::$myconn;

                if(!$con->select_db($db)){

                    $sql = "CREATE DATABASE " . $db;

                    if ($con->query($sql))
                        $con->select_db($db);
                    else
                        die("Error creating database: " . $con->error);

                }else{
                    $con->select_db($db);
                }

                if (!$con) {
                    die('Could not connect to database!');
                } else {
                    self::$myconn = $con;
                }
                return self::$myconn;

                break;

        }

    }


    function close() {
        mysqli_close($this->myconn);
    }


}

