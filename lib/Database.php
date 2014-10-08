<?php

	class Database  {

	    var $host = HOSTNAME;
	    var $user = DB_USERNAME;
	    var $pass = DB_PASSWORD;
	    var $db = DATABASE;
	    var $myconn;

	    function connect() {
	        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
	        if (!$con) {
	            die('Could not connect to database!');
	        } else {
	            $this->myconn = $con;
			}
	        return $this->myconn;
	    }

	    function close() {
	        mysqli_close($myconn);
	    }

	}

?>