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

      function orderBy($query, $columna){

          if(is_array($columna))
              $columna = implode(",",$columna);

          return $query . " ORDER BY " . $columna;
      }

      function where($query, $condicion){

          $condicion = $this->limpiar($condicion);

          return $query . " WHERE " . $condicion;
      }

      function ajaxSearch(){

          if(empty($_GET['q']))
              echo $this->errorJSON("Cadena Vacía");

          $table = $_GET['table'];
          $query = $_GET['q'];

          $sql = $this->searchQuery($table,$query);
          $query = $this->db->query($sql);
          $result = array();

          while($row = $query->fetch_array(MYSQL_ASSOC))
              $result[] = $row;

          echo $this->toJSON($result);


      }

      function searchQuery($tabla, $query){

          if(empty($tabla) || empty($query))
              return "";

          $tabla = $this->limpiar($tabla);
          $query = $this->limpiar($query);
          $extra = $this->createMultiJoin($tabla, $query);

          return "SELECT main_table.* {$extra['select']}
                    FROM {$tabla} as main_table {$extra['exp']} WHERE main_table.nombre
                    LIKE '%{$query}%' {$extra['where']} LIMIT 10";

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

      function select($tabla){

          $tabla = $this->limpiar($tabla);
          return  "SELECT * FROM {$tabla}";

      }

      function generarSelect($tabla, $id){

          if(empty($tabla))
              return "";

          $tabla = $this->limpiar($tabla);
          $extra = $this->createMultiJoin($tabla);

          return "SELECT main_table.* {$extra['select']}
                    FROM {$tabla} as main_table {$extra['exp']} WHERE main_table.id = '{$id}'";

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

      function tableExist($tabla){

          $sql = "SHOW TABLES LIKE '{$tabla}'";
          $query = $this->db->query($sql);

          if($query->num_rows == 1)
              return true;
          else
              return false;

      }

      function createMultiJoin($table, $q = null){

          $sql = "DESCRIBE {$table}";
          $query = $this->db->query($sql);
          $exp = "";
          $select = "";
          $where = "";
          $res = array();

          while($parent = $query->fetch_array(MYSQL_ASSOC)) {

              $foreign = explode("id_", $parent['Field']);
              if (count($foreign) > 1) {

                  if ($this->tableExist($foreign[1])) {
                      $frg = $foreign[1];
                      $exp .= " JOIN {$frg} ON {$frg}.id = main_table.id_{$frg} ";
                      $select .= " {$frg}.nombre as {$frg}_nombre,";

                      if(!empty($q))
                        $where .= " OR {$frg}.nombre LIKE '%{$q}%'";

                  }
              }

          }

          if(!empty($select)){
              $select = substr($select, 0, -1);
              $select = " , " . $select;
          }

          $res['exp'] = $exp;
          $res['select'] = $select;
          $res['where'] = $where;

          return $res;
      }

      function handleImages($data){

          foreach($data as $key => $val){

              $img = explode("img_",$key);

              if(count($img) > 1){

                  $nombre = $this->subirImagen($val,"media/img");
                  echo $nombre;
                  echo $key;

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


