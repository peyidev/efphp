<?php
	
	class User{
		
		public $db;
        public $util;
        public $dbo;
		
		function __construct(){

            $this->db = Database::connect();
            $this->util = new Utils();
            $this->dbo = new Dbo();
			
		}

        function isLogged(){
            return !empty($_SESSION["id_admin"]) ? true : false;
        }

        function loginAdmin(){

            $u = $this->util;
            $usr = $u->limpiarParams($_REQUEST['usr']);
            $psw = $u->limpiarParams($_REQUEST['psw']);
            $psw = md5($psw);

            $sql = $this->dbo
                ->select("admin a, rol r",
                    "email = '{$usr}' AND password = '{$psw}' AND  a.id_rol = r.id",
                    "a.*,r.nombre as rolNombre" );

            $query = $this->db->query($sql);
            $row = $query->fetch_array(MYSQL_ASSOC);

            if(!empty($row)){

                $_SESSION["id_admin"] = $row['id'];
                $_SESSION["nombre"] = $row['nombre'];
                $_SESSION["rol"] = $row['rolNombre'];
                header("Location: ../admin/index.php");

            }else{

                $message = new Messages();
                $message->setMessage("error:Error de usuario y/o contraseña");
                header("Location: ../admin/login.php");

            }

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