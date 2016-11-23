<?php
  
  class Utils{

      protected $db;

      function __construct(){
          $this->db = Database::connect();
      }

      public static function queryArray($query){

          $data = array();

          if(!$query)
              return $data;

          while ($row = $query->fetch_array(MYSQL_ASSOC)) {
              $data[] = $row;
          }

          return $data;

      }

      function  safe_json_encode($value){
          if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
              $encoded = json_encode($value);
          } else {
              $encoded = json_encode($value);
          }
          switch (json_last_error()) {
              case JSON_ERROR_NONE:
                  return $encoded;
              case JSON_ERROR_DEPTH:
                  return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
              case JSON_ERROR_STATE_MISMATCH:
                  return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
              case JSON_ERROR_CTRL_CHAR:
                  return 'Unexpected control character found';
              case JSON_ERROR_SYNTAX:
                  return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
              case JSON_ERROR_UTF8:
                  $clean = $this->utf8ize($value);
                  return $this->safe_json_encode($clean);
              default:
                  return 'Unknown error'; // or trigger_error() or throw new Exception()

          }
      }

      function utf8ize($mixed) {
          if (is_array($mixed)) {
              foreach ($mixed as $key => $value) {
                  $mixed[$key] = $this->utf8ize($value);
              }
          } else if (is_string ($mixed)) {
              return utf8_encode($mixed);
          }
          return $mixed;
      }


      function foreingList($data_){
          echo "<ul class='list-group'>";

            foreach($data_ as $val){
                foreach($val as $key => $v){
                    if($key != 'id'){
                        echo '<li class="list-group-item">' . $v . '</li>';

                    }

                }
            }

          echo "</ul>";
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

      function getTitle($string){
          $str = explode('-',$string);
          return !empty($str[3]) ? $str[3] : "";
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

          return "for(;;);(" . $this->safe_json_encode($array) . ")";

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

        if(!empty($valor))
            $valor = filter_var($valor,FILTER_SANITIZE_MAGIC_QUOTES);
        else
            $valor = "";

          return $valor;
      }

      function loginSecurity(){

          if(empty($_SESSION['id_admin']) && @$_GET['s'] != "login"){

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

      function handleImages($data,$type = null){

          foreach($data as $key => $val){

              $img = explode("img_",$key);

              if(count($img) > 1){

                  $nombre = $this->subirImagen($val,"media/img");
//                  echo $nombre;
//                  echo $key;

                  if(($type == "update"  && empty($nombre)) ||
                      ($type == "update"  && $nombre == "default.png")){
                       continue;
                  }

                  if(!empty($nombre)){
                      $_POST[$key] = GLOBALURL . "/media/img/" . $nombre;
                  }else{
                      continue;
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

              if(empty($file['name'])){
                  return "default.png";
              }

              return false;
          }

      }

  }


