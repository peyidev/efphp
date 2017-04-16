<?php
	
	class Interceptor{

		public $mysqli;
		
		function __construct(){

			$this->mysqli = Database::connect();

		}
		
		function render(){
			
			$cuerpo = "DEFAULT_S";
			$cuerpoLimpio = '';
			$u = new Utils();

            if(!empty($_GET['s'])){
				
				$cuerpo =  $u->limpiar($_GET['s']) . ".php";
                $cuerpoLimpio = $u->limpiar($_GET['s']);

			}
			
			include("template.php");

		}
		
		
	}
