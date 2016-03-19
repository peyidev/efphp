<?php

class Administrador{

    public $db;
    public $util;

    function __construct(){

        $this->db = Database::connect();
        $this->util = new Utils();

    }

    function loginAdmin(){

        $u = $this->util;
        $usr = $u->limpiarParams($_REQUEST['usr']);
        $psw = $u->limpiarParams($_REQUEST['psw']);
        $psw = md5($psw);
        $sql = "SELECT a.*, r.nombre as rolNombre FROM admin a, rol r WHERE email = '$usr' AND password = '$psw'
					AND a.id_rol = r.id";
        $query = $this->db->query($sql);
        $row = $query->fetch_array(MYSQL_ASSOC);

        if(!empty($row)){

            $_SESSION["id_admin"] = $row['id'];
            $_SESSION["nombre"] = $row['nombre'];
            $_SESSION["rol"] = $row['rolNombre'];

        }else{

            $message = new Messages();
            $message->setMessage("error:Error de usuario y/o contraseña");

        }

    }



    function renderAdmin($title = ""){

        $tabla = "";
        $u = $this->util;

        if(!empty($_GET['s'])){

            $tabla = $_GET['s'];
            $tabla = explode("-", $tabla);

            if(count($tabla) > 1){

                echo "<div class='admin-generic'>";
                echo "<h1 class='title-general'>{$title}</h1>";
                switch($tabla[1]){

                    case "admin":
                        echo "<div class='admin-left-column'>";
                        $this->createAdminTable($tabla[0]);
                        echo "</div>";

                        echo "<div class='admin-right-column'>";
                        $this->createGrid($tabla[0]);
                        echo "</div>";
                        break;

                    case "update":

                        $id = $_GET['id'];
                        echo "<div class='admin-left-column'>";
                        $this->createUpdateForm($tabla[0],$id);
                        echo "</div>";

                        echo "<div class='admin-right-column'>";
                        $this->createGrid($tabla[0]);
                        echo "</div>";

                        break;

                    case "report":
                        $this->createGrid($tabla[0],"report");
                        break;

                    case "detail":
                        $detail = $_GET['s'];
                        $detail = explode("-",$detail);
                        $detail = $detail[0];
                        $include = BASE_PATH . ADMINURL . "reportes/{$detail}.php";
                        if(file_exists($include)){
                            include($include);
                        }else{
                            $id = !empty($_GET['id']) ? $_GET['id'] : null;

                            if(!empty($id)){
                                $this->createDetail($tabla[0],$id);
                            }
                        }
                        break;



                }

                echo "</div>";
            }else{
                return false;
            }

        }else{
            return false;
        }

        return true;


    }

    function controles(){

        if(!empty($_SESSION['id_admin'])){
            $logo = LOGO;
            echo "
                <div id='logo'><img src='../{$logo}' alt='' /></div>
                <div id='general-controls'>
					<p>Bienvenido:" . $_SESSION['nombre'] . "</p>
					<a href='../lib/Execute.php?e=User/logout&back=1'>Salir</a>
				</div>";

        }

    }

    function menu(){

        if(!empty($_SESSION['id_admin'])){

            $xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");

            $title = "";
            $s = !empty($_GET['s']) ? ("?s=" . $_GET['s']) : "";

            $menu = "<ul id='main-menu'>";

            for($i = 0; $i < count($xml->item); $i++){

                $rolSize = count($xml->item[$i]->rol);

                if($rolSize > 0){

                    foreach($xml->item[$i]->rol as $rol){

                        if($rol == $_SESSION["rol"]){

                            $menu.="<li class='menu-item'><a href='{$xml->item[$i]->itemLink}' class='menu-item-link'>{$xml->item[$i]->itemName}</a>";

                            if($s == $xml->item[$i]->itemLink)
                                $title = $xml->item[$i]->itemName;

                            if(count($xml->item[$i]->subitem) > 0){
                                $menu.= "<ul>";
                                foreach($xml->item[$i]->subitem as $subitem){

                                    if($s == $subitem->subitemLink)
                                        $title =$subitem->subitemName;

                                    $menu .= "<li class='submenu-item'><a href='{$subitem->subitemLink}' class='menu-subitem-link'>" . $subitem->subitemName . "</a></li>";

                                }
                                $menu.= "</ul>";
                            }


                            $menu.="</li>";

                        }

                    }

                }

            }

            $menu .= "</ul>";

            echo $menu;

            if(empty($title) && !empty($s)){
                $title = explode("?s=",$s);
                $title = explode("-",$title[1]);
                $title = $title[0];

                $id = !empty($_GET['id']) ? (" - "  . $_GET['id']) : "";
                $title .= $id;
            }

            return $title;
        }

    }

    function deleteRow(){

        $u = $this->util;
        $table = $_GET['table'];
        $id = $_GET['id'];
        $sql = $u->generarDelete($table, $id);

        $query = $this->db->query($sql);
        $message = new Messages();

        if(!$query)
            $message->setMessage("error:" . "No es posible eliminar tu item");
        else
            $message->setMessage("message:1");

        echo $u->mensajeJSON("1");
    }

    function updateRow(){

        $table = $_GET['table-insert'];
        $id = $_GET['id'];
        $u = $this->util;
        $sql = $u->generarUpdate($table,$_POST,$id);
        //echo $sql;
        $query = $this->db->query($sql);
        $message = new Messages();
        $message->setMessage("message:1");
        return true;

    }

    function insertRow(){

        $table = $_GET['table-insert'];
        $u = $this->util;
        $canInsert = $u->handleImages($_FILES);
        $message = new Messages();

        if($canInsert){

            $sql = $u->generarInsert($table,$_POST);
            //echo $sql;
            $query = $this->db->query($sql);

            if(!$query)
                $message->setMessage("error:" . "Hubo un error al insertar, verifica tus datos");

        }else{

            $message->setMessage("error:" . "Hubo un error al insertar tu imagen, verifícala");
        }

        //$message->setMessage("message:$sql");
        return true;

    }

    function createDetail($tabla,$id){

        $sql =  $this->util->generarSelect($tabla,$id);
        $query = $this->db->query($sql);
        $columns = array();
        $row = $query->fetch_array(MYSQL_ASSOC);

        echo "<div class='detail-list'>";

        foreach($row as $key => $val){

            $img = explode("img_",$key);

            echo "<div class='detail-list-item'>";
                echo "<p  class='detail-list-item-key'>{$key}</p>";
                if($key == "data"){
                    $tmp = unserialize($val);
                    $tmp = print_r($tmp,true);
                    echo "<pre  class='detail-list-item-val'>{$tmp}</pre>";
                }else{

                    if(count($img) > 1){

                        echo "<p  class='detail-list-item-val'><img class='detail-img' src='../media/img/$val' alt='img' /></p>";

                    }else{
                        echo "<p  class='detail-list-item-val'>{$val}</p>";

                    }
                }

            echo "</div>";


        }

        echo "</div>";

    }

    function createGrid($tabla,$report = false){

        $sql = "SELECT * FROM {$tabla}";
        $query = $this->db->query($sql);
        $columns = "";
        $tbody = "";
        $thead = "";
        $flag = true;
        $controles = "";


        if($report){
            $controles .= "<th>Consultar</th>";
        }else{
            $controles .= "<th>Editar</th><th>Eliminar</th>";
        }

        $sqlRow = "SHOW FULL COLUMNS FROM {$tabla}";
        $queryRow = $this->db->query($sqlRow);

        while ($rowRow = $queryRow->fetch_array(MYSQL_ASSOC)) {
            $columns[] = $rowRow;
        }

        while($row = $query->fetch_array(MYSQL_ASSOC)){

            $tbody .= "<tr>";
            $id = "";

            for($i = 0; $i < count($columns); $i++){

                if($columns[$i]["Field"] == "password")
                    continue;

                if($flag){
                    $thead .= "<th>" . $columns[$i]["Field"] . "</th>";
                }

                if($columns[$i]["Field"] == "id"){
                    $id = $row[$columns[$i]["Field"]];
                }

                $val = $row[$columns[$i]["Field"]];

                /*
                 * Find foreign keys
                 * */

                if(empty($_GET['lazy'])){

                    $field = $columns[$i]["Field"];
                    $field = str_replace('_ajax','',$field);
                    $foreign = explode("id_",$field);

                    if(count($foreign) > 1) {

                        if ($this->util->tableExist($foreign[1])) {

                            $sqlForeign = "SELECT * FROM {$foreign[1]} WHERE id = '{$val}'";
                            $queryForeign = $this->db->query($sqlForeign);

                            while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                $val = $rowForeign['nombre'];
                            }
                        }
                    }

                }

                if($columns[$i]["Field"] == "id"){
                    $tbody .= "<td><a href='?s={$tabla}-detail&id={$id}' class='detail-report'>" . $val . "</a></td>";

                }else{
                    $tbody .= "<td>" . $val . "</td>";
                }

            }

            $flag = false;

            if($report){
                $tbody .= "	<td style='text-align:center;'>
									<a href='?s={$tabla}-detail&id={$id}'><img src='../css/img/consulta.png' /></a>
								</td>
							</tr>";


            }else{
                $tbody .= "	<td style='text-align:center;'>
									<a href='?s={$tabla}-update&id={$id}'><img src='../css/img/editar.png' /></a>
								</td>
								<td style='text-align:center;'>
									<a href='?s={$tabla}&id={$id}' class='delete-admin'><img src='../css/img/eliminar.png' /></a>
								</td>
							</tr>";

            }

        }

        echo "<table class='table-admin'>
					<thead><tr>{$thead}{$controles}</tr></thead>
					<tfoot><tr>{$thead}{$controles}</tr></tfoot>
					<tbody>{$tbody}</tbody>
				</table>";

    }

    function createGenericForm($tabla, $id = null, $type = "insert"){

        $extra = !empty($id) ? "&id={$id}" : "";

        echo "<form class='validation-form'  action=\"../lib/Execute.php?e=Administrador/{$type}Row&table-insert={$tabla}{$extra}&back=1\" method=\"post\" enctype=\"multipart/form-data\">";

        $sql = "SHOW FULL COLUMNS FROM {$tabla}";
        $query = $this->db->query($sql);

        if($type == "update"){
            $sqlInfo = "SELECT * FROM {$tabla} WHERE id='{$id}'";
            $infoQuery = $this->db->query($sqlInfo);
            $info = $infoQuery->fetch_array(MYSQL_ASSOC);
        }


        $data = array();
        while ($row = $query->fetch_array(MYSQL_ASSOC)) {
            $data[] = $row;
        }

        foreach($data as $row){

            if($row['Field'] != "id"){

                $foreign = explode("id_",$row['Field']);
                $img = explode("img_",$row['Field']);
                $ajax = explode("_ajax",$row['Field']);
                $isAjax = "";

                if(count($ajax) > 1)
                    $isAjax = 'ajax-search';


                $description = empty($row['Comment']) ? $row['Field'] : $row['Comment'];
                $validation = empty($row['Comment']) ? $row['Field'] : $row['Comment'];
                $serviceType = empty($row['Comment']) ? $row['Field'] : $row['Comment'];

                $description = $this->util->transformName($description);
                $validation = $this->util->getValidationType($validation);
                $serviceType = $this->util->getServiceType($serviceType);


                $flag = true;

                if(count($foreign) > 1){

                    if($this->util->tableExist($foreign[1])){

                        $sqlForeign = "SELECT * FROM {$foreign[1]}";
                        $queryForeign = $this->db->query($sqlForeign);
                        $combo = "";

                        while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ){

                            $selected = "";

                            if($type == "update"){
                                if($rowForeign['id'] == $info[$row['Field']]){
                                    $selected = " selected=selected";
                                }
                            }

                            $combo.="<option value='{$rowForeign['id']}' {$selected}>{$rowForeign['nombre']}</option>";

                        }


                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'><select name='{$row['Field']}'>{$combo}</select></p>
                              </div>";

                        $flag = false;

                    }


                }else if(count($img) > 1){
                    echo "<div class='row-abc'>
                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'><input type='file' name='{$row['Field']}' class='{$row['Type']}' /></p>
                              </div>";
                    $flag = false;
                }


                if($flag){

                    $val = !empty($info) ? $info[$row['Field']] : "";

                    if($row['Type'] == "text"){

                        echo "<div class='row-abc'>
	                                 <p class='descripcion'>{$description}</p>
	                                 <p class='input'>
	                                    <textarea name='{$row['Field']}' class='{$row['Type']} $validation'>{$val}</textarea>
	                                 </p>
	                              </div>";

                    }else{

                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'>
                                     <input type='text' name='{$row['Field']}'
                                     class='{$row['Type']} $validation $isAjax'  value='{$val}' />
                                  </p>
                              </div>";
                    }
                }



            }

        }

        if($type == "update")
            echo '<input type="submit" value="Actualizar"/>';
        else
            echo '<div class="row-abc"><p class="input"><input type="submit" value="Insertar"/></p></div>';

        echo '</form>';



    }

    function createUpdateForm($tabla, $id){

        $this->createGenericForm($tabla,$id,"update");

    }

    function createAdminTable($tabla){

        $this->createGenericForm($tabla);
    }

    function createLeft($tabla){

    }

    function insertRegister(){

    }

}
