<?php
	
	class Interceptor{

		public $mysqli;
		
		function __construct(){

			$this->mysqli = Database::connect();

		}
		
		function render(){
			
			$cuerpo = '404.php';
			$u = new Utils();

            if(!empty($_GET['s'])){
				
				$cuerpo =  $u->limpiar($_GET['s']) . ".php";

			}else{

                $cuerpo = DEFAULT_S;
            }
			
			include("template.php");

		}
		
		
	}
