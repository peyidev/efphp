<?php
	
	class Interceptor{

		public $mysqli;
		
		function __construct(){

			$this->mysqli = Database::connect();

		}
		
		function render(){
			
			$cuerpo = "DEFAULT_S";
			$u = new Utils();

            if(!empty($_GET['s'])){
				
				$cuerpo =  $u->limpiar($_GET['s']) . ".php";

			}
			
			include("template2.php");

		}
		
		
	}
