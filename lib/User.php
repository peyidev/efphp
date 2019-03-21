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
            $row = $query->fetch_array(MYSQLI_ASSOC);


            if(!empty($row)){

                $_SESSION["id_admin"] = $row['id'];
                $_SESSION["nombre"] = $row['nombre'];
                $_SESSION["rol"] = $row['rolNombre'];
                $_SESSION["permissions"] = $this->createPermissions();


            }else{

                $message = new Messages();
                $message->setMessage("error:Error de usuario y/o contraseña");

            }

        }


        function grantRenderPermissions($render){

            if(!empty($render['module'])){

                if(!empty($_SESSION['permissions'][$render['module']])){

                    return !empty($_SESSION['permissions'][$render['module']]['pkg'])
                        ? $_SESSION['permissions'][$render['module']]['pkg'] : "nopkg" ;
                }

            }else{

                return false;

            }

        }

        function grantRenderPermissionsFromUrl(){

            if(!empty($_GET['s'])){

                $module = $_GET['s'];
                $module = explode("-", $module);
                $module['module'] = $module[0];

                $res = array();

                $res['module'] = $module;
                $res['pkg'] = $this->grantRenderPermissions($module);

                return $res;


            }

            return false;

        }

        function createPermissions(){

            $xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");
            $xml = $xml;
            $permissions = array();

            foreach($xml as $item){

                if($item->rol == $_SESSION['rol']){
                    foreach($item->subitem as $subitem){

                        $permissions[(String)$subitem->module]['subitemLink'] = (String)$subitem->subitemLink;
                        $permissions[(String)$subitem->module]['pkg'] = !empty($subitem->pkg) ? (String)$subitem->pkg : "";
                    }
                }
            }
            return $permissions;
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

