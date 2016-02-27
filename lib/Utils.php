<?php
  
  class Utils{


      function checkSession(){
          if(!empty($_SESSION['id_user']))
              print'logged';
          else
              print'noLogged';
      }


      function transformName($string){

          $str = explode('-',$string);
          return $str[0];

      }

      function checkInscrito(){
          if(!empty($_SESSION['inscrito']))
              print'inscrito';
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
          }

      }

      function incluirSeccionAdmin($seccion){

          if(file_exists(BASE_PATH . "/" . ADMINURL .  "/vistas/" . $seccion)){

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

      function generarUpdate($tabla, $formulario, $id){

          $llaves = "";
          $valores = "";

          foreach($formulario as $llave => $valor){

              if($llave == "password"){
                  $valor = md5($valor);
              }

              if($llave != "id")
                  $valores.="$llave ='" . $this->limpiar($valor) . "',";

          }

          $valores = substr($valores,0, (strlen($valores) - 1));

          return "UPDATE $tabla set $valores WHERE id='$id'";



      }

      function generarDelete($tabla, $id){

          $id = $this->limpiar($id);
          return "DELETE FROM $tabla WHERE id = '$id'";

      }

      function generarInsert($tabla, $formulario){

          $llaves = "";
          $valores = "";

          foreach($formulario as $llave => $valor){

              if($llave == "password"){
                  $valor = md5($valor);
              }

              $llaves.="`$llave`,";
              $valores.="'" . $this->limpiar($valor) . "',";

          }
          $llaves = substr($llaves,0, (strlen($llaves) - 1));
          $valores = substr($valores,0, (strlen($valores) - 1));

          return "INSERT INTO $tabla ($llaves) VALUES ($valores)";



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
                  /*
                  echo "Upload: " . $file["name"] . "<br>";
                  echo "Type: " . $file["type"] . "<br>";
                  echo "Size: " . ($file["size"] / 1024) . " kB<br>";
                  echo "Temp file: " . $file["tmp_name"] . "<br>";
                  */

                  $nombre = time() . rand(0,9) . "." . $extension[1];
                  if (file_exists("../../" . $carpeta . "/" . $nombre ))
                  {
                      return false;
                  }
                  else
                  {
                      move_uploaded_file($file["tmp_name"],
                          "../../" . $carpeta . "/" . $nombre );
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


