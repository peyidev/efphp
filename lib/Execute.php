<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$e = new Execute();

$back = false;

if(!empty($_GET['back'])){
    $back = true;
}


$e->run($back);

class Execute{

    function getParams(){

        $p = explode("/", $_GET['e']);
        $u = new Utils();

        if(count($p)<=1)
            return false;

        $method = $p[1];
        $class = $p[0];
        $params = array();

        foreach($p as $key => $val){
            if($key != 0 && $key != 1){
                $params[] = $u->limpiar($val);
            }
        }


        $result = array();
        $result['method'] = $u->limpiar($method);
        $result['class'] = $u->limpiar($class);
        $result['params'] = implode(",",$params);

        return $result;
    }

    function run($back){


        try{

            require_once("Configuracion.php");
            $u = new Utils();

            $p = $this->getParams();
            $method = $p['method'];
            $class = $p['class'];
            $params = $p['params'];



            $ex = null;
            $message = new Messages();
            $message->initMessages();


            if($class == "Administrador" || $class == 'Mhmproperties'){

                $privileges = false;
                $insert = !empty($_GET['table-insert']) ? $_GET['table-insert'] :
                         (!empty($_GET['table']) ? $_GET['table'] : null);


                $interceptorData['header'] = $class . " - " . $insert;
                $interceptorData['method'] = $method;

                Log::logActivity($interceptorData);

                $user = new User();

                if(!empty($insert))
                    $privileges = $user->grantPermissions($_SESSION,$class,$method,$insert);
                else if(!$user->isLogged())
                    $privileges = false;
                else
                    $privileges = true;

                if(!$privileges){
                    $message->setMessage("error:No tienes permisos para realizar esta operación");

                    if($back)
                        header("Location: {$_SERVER['HTTP_REFERER']}");

                    return false;
                }
            }



            if(class_exists($class)){

                eval("\$ex = new {$class}(\$mysqli);");

                if(method_exists($ex,$method)){

                    eval("\$ex->{$method}(\$params);");

                    if($back)
                        header("Location: {$_SERVER['HTTP_REFERER']}");

                }else{

                    echo "Error de método";

                }

            }else{

                echo "Error de clase";

            }



        }catch(Exception $e){

            echo $e->getMessage(), "\n";

        }

    }

}

