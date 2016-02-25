<?php
    /*Archivo inicial*/
	try{
	
		require_once("lib/Configuracion.php");
		require_once(BASE_PATH . "lib/Init.php");
	
	}catch(Exception $e){
		
		echo $e->getMessage(), "\n";
		
	}
