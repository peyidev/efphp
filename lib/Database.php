<?php

	class Database  {

	    private static $host = HOSTNAME;
        private static $user = DB_USERNAME;
        private static $pass = DB_PASSWORD;
        private static $db = DATABASE;
        private static $myconn;

	    public static function connect($type = "mysql") {

            $host = self::$host;
            $user = self::$user;
            $pass = self::$pass;
            $db = self::$db;

            switch($type){

                case "PDO":

                    $con = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$myconn = $con;
                    return self::$myconn;

                    break;

                case "mysql":

                    $con = mysqli_connect($host, $user, $pass);

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

