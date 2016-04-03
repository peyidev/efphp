<?php

    class Log{

        public static function logActivity($interceptorData){

            if(!LOGGING)
                return false;

            $usuario = !empty($_SESSION['id_admin']) ? $_SESSION['id_admin'] : "0";
            $nombre = $interceptorData['header'];
            $metodo = $interceptorData['method'];

            if (preg_match("/ajax/i", $metodo) && !empty($usuario))
                return false;

                $data = !empty($_POST) ? $_POST : null;

            if(!empty($data))
                $data = serialize($data);
            else{
                $data = !empty($_GET) ? $_GET : null;

                if(!empty($data))
                    $data = serialize($data);
                else{
                    $data = "";
                }
            }


            $insert = array();
            $insert['id_admin'] = $usuario;
            $insert['nombre'] = $nombre;
            $insert['metodo'] = $metodo;
            $insert['data'] = $data;

            $dbo = new Dbo();
            $sql = $dbo->insert("log",$insert);
            $db = Database::connect();

            try{
                $tmp = $db->query($sql);
            }catch(Exception $e){
                return false;
            }


        }


    }