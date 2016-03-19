<?php
    /*Archivo inicial*/
	try{

		require_once(realpath("lib/Configuracion.php"));
		require_once(realpath(BASE_PATH . "lib/Init.php"));
	
	}catch(Exception $e){
		
		echo $e->getMessage(), "\n";
		
	}
