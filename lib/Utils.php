<?php
  
  class Utils{

      protected $db;

      function __construct(){
          $this->db = Database::connect();
      }

      function checkSession(){
          if(!empty($_SESSION['id_user']))
              print'logged';
          else
              print'noLogged';
      }

      function getStatusIcon($status){

          $res = "";

          switch($status){

              case 0:
                  $res = "<i class='fa fa-close fa-fw no-style'></i>";
                break;

              case 2:
                  $res = "<i class='fa fa-exclamation-triangle fa-fw pendiente-style'></i>";
                  break;

              case 1:
                  $res = "<i class='fa fa-check fa-fw si-style'></i>";
                  break;

              default:
                  $res = "<i class='fa fa-info-circle fa-fw default-style'></i>";
                  break;

          }

          return $res;

      }

      function getIconOptions($type = "status"){

          $res = array();

          if($type == "status"){

              $res[0] = "No";
              $res[1] = "Sí";
              $res[2] = "Pendiente";
          }else{

              $res[0] = "No";
              $res[1] = "Sí";

          }

          return $res;

      }

      function getValidationType($string){
          $str = explode('-',$string);
          return !empty($str[1]) ? ("validation-" . $str[1] ) : "";
      }

      function getServiceType($string){
          $str = explode('-',$string);
          return !empty($str[2]) ? $str[2] : "";
      }

      function transformName($string){

          $str = explode('-',$string);
          return $str[0];

      }

      function mensajeJSON($mensaje){


          return "for(;;);({\"idMensaje\":\"{$mensaje}\"})";


      }

      function errorJSON($error){


          return "for(;;);({\"idError\":\"{$error}\"})";


      }

      function toJSON($array){

          return "for(;;);(" . json_encode($array) . ")";

      }

      function utf8_encode_deep(&$input) {

          if (is_string($input)) {
              $input = utf8_encode($input);
          } else if (is_array($input)) {
              foreach ($input as &$value) {
                  echo utf8_encode_deep($value);
              }

              unset($value);
          } else if (is_object($input)) {
              $vars = array_keys(get_object_vars($input));

              foreach ($vars as $var) {
                  utf8_encode_deep($input->$var);
              }
          }
      }

      function limpiar($valor){

          $valor = filter_var($valor,FILTER_SANITIZE_MAGIC_QUOTES);
          return $valor;

      }

      function loginSecurity(){

          if(empty($_SESSION['id_admin']) && $_GET['s'] != "login"){

              header("Location: ../admin/index.php?s=login");

          }else if(!empty($_SESSION['id_admin']) && !empty($_GET['s']) && $_GET['s'] == "login"){

              header("Location: ../admin/index.php?s=home");

          }else if(!empty($_GET['s']) && $_GET['s'] == "login"){

              return "login-form";
          }

      }

      function incluirSeccionAdmin($seccion){

          if(file_exists(realpath(BASE_PATH . "/" . ADMINURL .  "/vistas/" . $seccion))){
              return $seccion;
          }else{
              return DEFAULT_S;
          }

      }

      function incluirSeccion($seccion){

          if(file_exists(BASE_PATH . "vistas/" . $seccion)){

              return $seccion;

          }else{

              return DEFAULT_S;

          }

      }

      function limpiarParams($valor){
          $valor = explode(' ', $valor);
          $valor = $valor[0];
          $valor = filter_var($valor,FILTER_SANITIZE_MAGIC_QUOTES);
          return $valor;

      }

      function seccion(){

          $currentFile = $_SERVER["PHP_SELF"];
          $parts = explode('/', $currentFile);
          $parts = $parts[count($parts) - 1];
          $parts = explode(".",$parts);
          return $parts[1];

      }

      function handleImages($data){

          foreach($data as $key => $val){

              $img = explode("img_",$key);

              if(count($img) > 1){

                  $nombre = $this->subirImagen($val,"media/img");
//                  echo $nombre;
//                  echo $key;

                  if(!empty($nombre)){
                      $_POST[$key] = $nombre;
                  }else{
                      return false;
                  }
              }

          }

          return true;

      }

      function subirImagen($file,$carpeta){


          $allowedExts = array("jpg", "jpeg", "gif", "png");
          $extension = explode(".", $file["name"]);
          if ((($file["type"] == "image/gif")
              || ($file["type"] == "image/jpeg")
              || ($file["type"] == "image/png")
              || ($file["type"] == "image/pjpeg")))
          {
              if ($file["error"] > 0)
              {
                  return false;
              }
              else
              {

                  /*echo "Upload: " . $file["name"] . "<br>";
                  echo "Type: " . $file["type"] . "<br>";
                  echo "Size: " . ($file["size"] / 1024) . " kB<br>";
                  echo "Temp file: " . $file["tmp_name"] . "<br>";*/


                  $nombre = time() . rand(0,9) . "." . $extension[(count($extension) - 1)];
                  if (file_exists("../" . $carpeta . "/" . $nombre ))
                  {
                      return false;
                  }
                  else
                  {
                      move_uploaded_file($file["tmp_name"],
                          "../" . $carpeta . "/" . $nombre );
                      return $nombre ;
                  }
              }
          }
          else
          {
              return false;
          }

      }

  }


