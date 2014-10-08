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

    function run($back){


        try{

            require_once("Configuracion.php");
            $u = new Utils();

            $class = explode("/", $_GET['e']);
            $method = $class[1];
            $class = $class[0];
            $class = $u->limpiarParams($class);
            $method = $u->limpiarParams($method);


            if(class_exists($class)){

                eval("\$ex = new {$class}(\$mysqli);");

                if(method_exists($ex,$method)){

                    eval("\$ex->{$method}();");

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

?>