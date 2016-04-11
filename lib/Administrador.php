<?php

class Administrador{

    public $db;
    public $util;
    public $dbo;

    function __construct(){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();

    }

    function renderAdmin($info = array()){


        $title = !empty($info['title']) ? $info['title'] : "";
        $icon = !empty($info['icon']) ? $info['icon'] : '<i class="fa fa-info-circle fa-fw"></i>';

        $tabla = "";
        $u = $this->util;

        if(!empty($_GET['s'])){

            $tabla = $_GET['s'];
            $tabla = explode("-", $tabla);

            if(!$this->dbo->tableExist($tabla[0]))
                return false;

            if(count($tabla) > 1){

                echo "<div class='admin-generic'>";
                echo "<h1 class='title-general' id='{$tabla[0]}'>{$icon} {$title}</h1>";
                switch($tabla[1]){

                    case "admin":
                        echo "<div class='add-new-record'>Insertar nuevo registro<i class='fa fa-plus fa-fw'></i></div>";
                        echo "<div class='admin-left-column admin-only-left well'>";
                        $this->createAdminTable($tabla[0]);
                        echo "</div>";

                        echo "<div class='admin-right-column admin-only-right'>";
                        //$this->createGrid($tabla[0]);
                        $this->createGridBase($tabla[0]);
                        echo "</div>";
                        break;

                    case "update":

                        $id = $_GET['id'];
                        echo "<div class='add-new-record-update'>
                                <a href='?s={$tabla[0]}-admin'>Regresar <i class='fa fa-rotate-left fa-fw'></i></a>
                              </div>";

                        echo "<div class='admin-left-column well'>";
                        $this->createUpdateForm($tabla[0],$id);
                        echo "</div>";

                        echo "<div class='admin-right-column'>";
                        $this->createGridBase($tabla[0]);
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
            echo "<div id='logo'><img src='../{$logo}' alt='' /></div>";

        }

    }

    function menu(){

        if(!empty($_SESSION['id_admin'])){

            $xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");

            $title = "";
            $ico = "";
            $s = !empty($_GET['s']) ? ("?s=" . $_GET['s']) : "";

            $menu = "<ul id='main-menu'>";


            $menu .= "<li class='menu-item profile'>
                        <div class='input-group margin-bottom-sm'>
                            <span class='input-group-addon'><i class='fa fa-angle-down fa-fw'></i></span>
                            <a href='#' class='menu-item-link'>{$_SESSION['nombre']}</a>
                        </div>
                        <ul>
                            <li class='submenu-item'><a class='menu-subitem-link' href='../lib/Execute.php?e=User/logout&back=1'>Salir</a></li>
                        </ul>
                        </li>";


            for($i = 0; $i < count($xml->item); $i++){

                $rolSize = count($xml->item[$i]->rol);

                if($rolSize > 0){

                    foreach($xml->item[$i]->rol as $rol){

                        if($rol == $_SESSION["rol"]){

                            $icon = !empty($xml->item[$i]->icon) ?
                                "<i class='fa {$xml->item[$i]->icon} fa-fw'></i>":
                                "<i class='fa fa-chevron-right fa-fw'></i>";

                            $menu.="<li class='menu-item'>
                                        <div class='input-group margin-bottom-sm'>
                                            <span class='input-group-addon'>{$icon}</span>
                                            <a href='{$xml->item[$i]->itemLink}' class='menu-item-link'>{$xml->item[$i]->itemName}</a>
                                        </div>";

                            if($s == $xml->item[$i]->itemLink){
                                $title = $xml->item[$i]->itemName;
                                $ico = $icon;
                            }

                            if(count($xml->item[$i]->subitem) > 0){
                                $menu.= "<ul>";
                                foreach($xml->item[$i]->subitem as $subitem){

                                    if($s == $subitem->subitemLink){
                                        $title =$subitem->subitemName;
                                        $ico = $icon;
                                    }


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

            $r = array();

            $r['title'] = $title;
            $r['icon'] = $ico;

            return $r;
        }

    }

    function deleteRow(){

        $u = $this->util;
        $dbo = $this->dbo;
        $table = $_GET['table'];
        $id = $_GET['id'];
        $sql = $dbo->delete($table, $id);

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
        $dbo = $this->dbo;
        $sql = $dbo->update($table,$_POST,$id);
        //echo $sql;
        $query = $this->db->query($sql);
        $message = new Messages();
        $message->setMessage("message:1");
        return true;

    }

    function insertRow(){

        $table = $_GET['table-insert'];
        $u = $this->util;
        $dbo = $this->dbo;
        $canInsert = $u->handleImages($_FILES);
        $message = new Messages();

        if($canInsert){

            $sql = $dbo->insert($table,$_POST);
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

        $sql =  $this->dbo->selectAutoJoin($tabla,$id,"LEFT");
        $query = $this->db->query($sql);
        $columns = array();
        $row = $query->fetch_array(MYSQL_ASSOC);

        echo "<ul class='detail-list list-group'>";

        foreach($row as $key => $val){

            $img = explode("img_",$key);

            echo "<li class='detail-list-item list-group-item'>";
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

            echo "</li>";


        }

        echo "</ul>";

    }

    function createGrid($tabla,$report = false){

        $sql = $this->dbo->select($tabla);
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

        $sqlRow = $this->dbo->getColumns($tabla);
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

                        if ($this->dbo->tableExist($foreign[1])) {

                            $sqlForeign = $this->dbo->select($foreign[1],"id = '{$val}'");
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

    function createGridBase($tabla,$report = false){

        $sql = $this->dbo->select($tabla,"","*","","1");
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

        $sqlRow = $this->dbo->getColumns($tabla);
        $queryRow = $this->db->query($sqlRow);

        while ($rowRow = $queryRow->fetch_array(MYSQL_ASSOC)) {
            $columns[] = $rowRow;
        }

        while($row = $query->fetch_array(MYSQL_ASSOC)){

            $tbody .= "<tr>";

            for($i = 0; $i < count($columns); $i++){

                if($columns[$i]["Field"] == "password")
                    continue;

                if($flag){
                    $thead .= "<th>" . $columns[$i]["Field"] . "</th>";
                }

            }

            $flag = false;

        }

        echo "<table class='table-admin'>
					<thead><tr>{$thead}{$controles}</tr></thead>
					<tfoot><tr>{$thead}{$controles}</tr></tfoot>
				</table>";

    }

    function createGenericForm($tabla, $id = null, $type = "insert"){

        $extra = !empty($id) ? "&id={$id}" : "";

        echo "<form class='validation-form'  action=\"../lib/Execute.php?e=Administrador/{$type}Row&table-insert={$tabla}{$extra}&back=1\" method=\"post\" enctype=\"multipart/form-data\">";

        $iconOp = ($type == "insert") ?
            "<i class='fa fa-search-plus fa-plus-square-o'></i> Insertar nuevo registro" :
            "<i class='fa fa-search-plus fa-pencil-square-o'></i> Actualizar registro";

        echo "<p class='form-operation'>{$iconOp}</p>";

        $sql = $this->dbo->getColumns($tabla);
        $query = $this->db->query($sql);

        if($type == "update"){
            $sqlInfo = $this->dbo->select($tabla,"id='{$id}'");
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

                    if($this->dbo->tableExist($foreign[1])){

                        $sqlForeign = $this->dbo->select($foreign[1]);
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
                                 <p class='input'><input type='file' name='{$row['Field']}' class='{$row['Type']} form-control' /></p>
                              </div>";
                    $flag = false;
                }


                if($flag){

                    $val = !empty($info) ? $info[$row['Field']] : "";

                    if($row['Type'] == "text"){

                        echo "<div class='row-abc'>
	                                 <p class='descripcion'>{$description}</p>
	                                 <p class='input'>
	                                    <textarea name='{$row['Field']}' class='{$row['Type']} $validation form-control'>{$val}</textarea>
	                                 </p>
	                              </div>";

                    }else{

                        echo "<div class='row-abc'>
                                 <p class='input'>
                                     <input type='text' name='{$row['Field']}'
                                     class='{$row['Type']} $validation $isAjax form-control'
                                     value='{$val}' placeholder='{$description}'/>
                                  </p>
                              </div>";
                    }
                }



            }

        }

        if($type == "update")
            echo '<div class="row-abc"><p class="input"><button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Actualizar</button></p></div>';
        else
            echo '<div class="row-abc"><p class="input"><button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Insertar</button></p></div>';

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

    function createAjaxTable($table){

        $primaryKey = 'id';
        $sqlRow = $this->dbo->getColumns($table);
        $queryRow = $this->db->query($sqlRow);

        while ($rowRow = $queryRow->fetch_array(MYSQL_ASSOC)) {
            $c[] = $rowRow;
        }

        $columns = array();

        $cont = 0;

        for($i = 0; $i < count($c); $i++){

            if($c[$i]["Field"] == "password")
                continue;

            if($c[$i]["Field"] == "id"){

                $columns[] = array(
                    'db' => 'id',
                    'dt' => $cont,
                    'formatter' =>
                        function( $d, $row, $table ) {
                            return "<a href='?s={$table}-detail&id={$d}' class='detail-report'><i class='fa fa-search-plus fa-fw fa-2x'></i></a>";
                        }
                );
                $cont++;
            }else{

                $columns[] = array(
                    'db' => $c[$i]["Field"],
                    'dt' => $cont,
                    'formatter' =>
                        function( $d, $row, $table, $field ) {

                            $field = str_replace('_ajax','',$field);
                            $foreign = explode("id_",$field);

                            if(count($foreign) > 1) {

                                $db = Database::connect();
                                $dbo = new Dbo();
                                if ($dbo->tableExist($foreign[1])) {

                                    $sqlForeign = $dbo->select($foreign[1],"id = '{$d}'");
                                    $queryForeign = $db->query($sqlForeign);

                                    while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                        $d = $rowForeign['nombre'];
                                    }
                                }
                            }
                            return $d;
                        }
                );
                $cont++;
            }
        }

        $columns[] = array(
            'db' => 'id',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {
                    return "<a href='?s={$table}-update&id={$d}' class='center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a>";
                }
        );

        $columns[] = array(
            'db' => 'id',
            'dt' => ++$cont,
            'formatter' =>
                function( $d, $row, $table ) {
                    return "<a href='?s={$table}&id={$d}' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a>";
                }
        );



        echo json_encode(Servertable::simple($_GET, $table, $primaryKey, $columns));

    }
}