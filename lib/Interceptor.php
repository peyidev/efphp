<?php
	
	class Interceptor{

		public $mysqli;
		
		function __construct(){

			$this->mysqli = Database::connect();

		}
		
		function render($ajax = false){
			
			$cuerpo = "DEFAULT_S";
			$u = new Utils();

            if(!empty($_GET['s'])){
				
				$cuerpo =  $u->limpiar($_GET['s']) . ".php";

			}

			if(empty($ajax))
			    include("template.php");
			else
			    include("ajaxTemplate.php");

		}
		
		
	}
