<?php
	
	class User{
		
		public $mysqli;
		
		function __construct($mysqli){
			
			$this->mysqli = $mysqli;
			
		}
		

		
		function login(){
			
			echo $usr . "->" . $psw;
			
		}
		
		function logout(){
			
			session_destroy();
			
		}
		
	}

?>