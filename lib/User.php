<?php
	
	class User{
		
		public $db;
        public $util;
		
		function __construct(){

            $this->db = Database::connect();
            $this->util = new Utils();
			
		}

        function hasRol($item,$rol){

            foreach($item->rol as $tmp){
                if($tmp == $rol)
                    return true;
            }
            return false;
        }


        function hasModule($item, $insert){

            foreach($item->subitem as $subitem){
                if($subitem->module == $insert)
                    return true;
            }
            return false;
        }

        function grantPermissions($session,$class,$method,$insert){

            $xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");
            $xml = $xml;
            $rol = $session['rol'];

            $grant = false;

            foreach($xml as $item){

                $hasRol = $this->hasRol($item,$rol);
                $hasModule = $this->hasModule($item,$insert);

                if($hasRol && $hasModule)
                    return true;
            }

            return false;



        }

		
		function login(){
			

		}
		
		function logout(){
			
			session_destroy();
			
		}
		
	}

?>