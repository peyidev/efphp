<?php

/**
 * Administrador
 *
 * Manejo general de backend
 *
 * Render de todas las acciones genéricas de backend
 *
 * @author Pedro Laris
 * @author http://efphp.com/
 *
 * @package Administrador
 */

class Administrador{

    /**
     * objecto con la conexión a DB
     * @var Database base de datos
     * @access protected
     */
    protected $db;

    /**
     * objeto con acceso a utilidades múltiples
     * @var Util utilidades
     * @access protected
     */
    protected $util;

    /**
     * objeto para traducción a SQL
     * @var Dbo databaseobject
     * @access protected
     */
    protected $dbo;

    function __construct(){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();

    }

    /**
     * Render del administrador, columna izquierda, derecha o custom
     *
     * @param string $title título de la página
     * @return boolean false si no se puede imprimir
     */
    function renderAdmin($title = ""){

        $tabla = "";
        $u = $this->util;

        if(!empty($_GET['s'])){

            $tabla = $_GET['s'];
            $tabla = explode("-", $tabla);

            if(!$this->dbo->tableExist($tabla[0]))
                return false;

            if(count($tabla) > 1){

                echo "<div class='admin-generic'>";
                echo "<h1 class='title-general' id='{$tabla[0]}'>{$title}</h1>";
                switch($tabla[1]){

                    case "admin":
                        echo "<!--div class='add-new-record'>Insertar nuevo registro</div-->";
                        echo "<div class='admin-left-column admin-only-left'>";
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
                                <a href='?s={$tabla[0]}-admin'>Regresar</a>
                              </div>";

                        echo "<div class='admin-left-column'>";
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

    function logo(){
        if(!empty($_SESSION['id_admin'])){
            $logo = LOGO;
            echo "<div class='main-logo' id='logo'><img src='../{$logo}' alt='' /></div>";
        }

    }

    /**
     * Imprime los controles de logout y bienvenida
     *
     */
    function welcome(){

        if(!empty($_SESSION['id_admin'])){
            $logo = LOGO;
            echo "<span class='profile__name' id='general-controls'>
                            Logged as: <span class='login-name-span'>" . $_SESSION['nombre'] . "</span>
                     <i class='pe-7s-angle-down'></i> </span>
				";

        }

    }

    function logoutControl(){


        if(!empty($_SESSION['id_admin'])){
            $logo = LOGO;
            echo "<a href='../lib/Execute.php?e=User/logout&back=1'>Salir</a>";

        }
    }

    function controles(){

        if(!empty($_SESSION['id_admin'])){
            $logo = LOGO;
            echo "
                <div id='logo'><img src='../{$logo}' alt='' /></div>
                <div id='general-controls'>
					<p class='login-name'>" . $_SESSION['nombre'] . "</p>
					<a href='../lib/Execute.php?e=User/logout&back=1'>Salir</a>
				</div>";

        }

    }


    /**
     * Imprime el menú de backend utilizando la configuración
     * en /admin/config/menu.xml
     *
     * @return string $title título de la página
     */
    function menu(){

        if(!empty($_SESSION['id_admin'])){

            $xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");

            $title = "";
            $s = !empty($_GET['s']) ? ("?s=" . $_GET['s']) : "";

            $menu = "<ul class='main-nav' id='main-menu'>";

            for($i = 0; $i < count($xml->item); $i++){

                $rolSize = count($xml->item[$i]->rol);

                if($rolSize > 0){

                    foreach($xml->item[$i]->rol as $rol){

                        if($rol == $_SESSION["rol"]){



                            if($s == $xml->item[$i]->itemLink)
                                $title = $xml->item[$i]->itemName;

                            if(count($xml->item[$i]->subitem) > 0){
                                $menu.="<li class='menu-item main-nav--collapsible'><a href='{$xml->item[$i]->itemLink}' class='menu-item-link main-nav__link'><span class='main-nav__icon'><i class='icon {$xml->item[$i]->icon}'></i></span>{$xml->item[$i]->itemName}</a>";
                                $menu.= "<ul class='main-nav__submenu'>";
                                foreach($xml->item[$i]->subitem as $subitem){

                                    if($s == $subitem->subitemLink)
                                        $title =$subitem->subitemName;

                                    $menu .= "<li class='submenu-item'><a href='{$subitem->subitemLink}' class='menu-subitem-link'>" . $subitem->subitemName . "</a></li>";

                                }
                                $menu.= "</ul>";
                            }else{

                                $menu.="<li class='menu-item'><a href='{$xml->item[$i]->itemLink}' class='menu-item-link main-nav__link'>{$xml->item[$i]->itemName}</a>";

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


    /**
     * Controlador que elimina el registro deseado de cualquier tabla
     *
     */
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


    /**
     * Controlador que actualiza el registro deseado
     * @return boolean true siempre y se muestra en pantalla el mensaje de respuesta
     */
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


    /**
     * Controlador que inserta el registro deseado
     * @return boolean true siempre y se muestra en pantalla el mensaje de respuesta
     */
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


    /**
     * Imprime el detalle de cualquier registro seleccionado
     *
     */
    function createDetail($tabla,$id){

        $sql =  $this->dbo->selectAutoJoin($tabla,$id);
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


    /**
     * Imprime tabla html con la tabla de db que se solicitó
     * @deprecated se modificó por un llenado asíncrono
     * @param string $tabla tabla de db para imprimir
     * @param boolean $report true imprime un control más en la tabla para poder ver detalle
     */
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
										<tbody>{$tbody}</tbody>
					<tfoot><tr>{$thead}{$controles}</tr></tfoot>
				</table>";

    }


    /**
     * Imprime esqueleto de la tabla html utilizando las columnas de la tabla de db
     * @param string $tabla tabla de db para imprimir
     * @param boolean $report true imprime un control más en la tabla para poder ver detalle
     */
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
                else if($columns[$i]["Field"] == "id"){
                    $thead .= "<th>Detalle</th>";
                    continue;
                }

                if($flag){
                    $description = empty($columns[$i]['Comment']) ? $columns[$i]['Field'] : $columns[$i]['Comment'];
                    $description = $this->util->transformName($description);

                    $thead .= "<th>" . $description . "</th>";
                }

            }

            $flag = false;

        }

        $tablaRender =  "<table class='table-admin table'>
                            <thead><tr>{$thead}{$controles}</tr></thead>
                            <tbody><tr>{$thead}{$controles}</tr></tbody>
                            <tfoot><tr>{$thead}{$controles}</tr></tfoot>
                        </table>";

        echo '<div class="row">
                <div class="col-md-12">
                    <article class="widget">
                        <header class="widget__header">
                            <h3 class="widget__title">Registros de ' . $tabla . '</h3>
                            <div class="widget__config">
                                <a href="#"><i class="pe-7f-refresh"></i></a>
                                <a href="#"><i class="pe-7s-close"></i></a>
                            </div>
                        </header>
                        <div class="widget__content widget__table">
                        ' . $tablaRender . '
                        </div></article>
                    </div>

                </div>';

    }


    /**
     * Imprime formulario genérico para insertar o actualizar registros
     * @param string $tabla tabla de db para obtener columnas
     * @param int $id id para cargar el registro en el formulario de edición
     * @param string $type tipo de formulario (insert | update)
     */
    function createGenericForm($tabla, $id = null, $type = "insert"){

        $extra = !empty($id) ? "&id={$id}" : "";

        $title = ($type == "insert") ? "Insertar" : "Actualizar";
        $title .= " " . $tabla;
        echo '<div class="row">
                <div class="col-md-12">
                    <article class="widget">
                        <header class="widget__header">
                            <h3 class="widget__title">' . $title . '</h3>
                            <div class="widget__config">
                                <a href="#"><i class="pe-7f-refresh"></i></a>
                                <a href="#"><i class="pe-7s-close"></i></a>
                            </div>
                        </header>
                        <div class="widget__content">';
        echo "<form class='validation-form'  action=\"../lib/Execute.php?e=Administrador/{$type}Row&table-insert={$tabla}{$extra}&back=1\" method=\"post\" enctype=\"multipart/form-data\">";

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
                                 <div class='input dropdown'><select name='{$row['Field']}' class='dropdown-select'>{$combo}</select></div>
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
	                                    <textarea name='{$row['Field']}' class='{$row['Type']} $validation textarea'>{$val}</textarea>
	                                 </p>
	                              </div>";

                    }else{

                        echo "<div class='row-abc'>
                                 <!--p class='descripcion'>{$description}</p-->
                                 <p class='input'>
                                     <input type='text' name='{$row['Field']}'
                                     class='{$row['Type']} $validation $isAjax input-text'  value='{$val}'
                                     placeholder='{$description}' />
                                  </p>
                              </div>";
                    }
                }



            }

        }

        if($type == "update")
            echo '<input type="submit" class="btn btn-light pull-right" value="Actualizar"/>';
        else
            echo '<div class="row-abc"><p class="input"><input type="submit" class="btn btn-light pull-right"  value="Insertar"/></p></div>';

        echo '</form>';

        echo '						<div class="clearfix"></div>
					</div>

				</article>
			</div>
			</div>';


    }


    /**
     * Crea forma de actualización
     * @param string $tabla tabla de db para obtener columnas
     * @param int $id id para cargar el registro en el formulario de edición
     */
    function createUpdateForm($tabla, $id){

        $this->createGenericForm($tabla,$id,"update");

    }


    /**
     * Crea forma de inserción
     * @param string $tabla tabla de db para obtener columnas
     */
    function createAdminTable($tabla){

        $this->createGenericForm($tabla);
    }


    /**
     * Invocado con ajax, imprime json con la página de la tabla solicitada por el frontend
     * @param string $table tabla de db para imprimir
     */
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
                            return "<a href='?s={$table}-detail&id={$d}' class='center-data'><img src='../css/img/consulta.png' /></a>";
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
                    return "<a href='?s={$table}-update&id={$d}' class='center-data'><img src='../css/img/editar.png' /></a>";
                }
        );

        $columns[] = array(
            'db' => 'id',
            'dt' => ++$cont,
            'formatter' =>
                function( $d, $row, $table ) {
                    return "<a href='?s={$table}&id={$d}' class='delete-admin center-data'><img src='../css/img/eliminar.png' /></a>";
                }
        );



        echo json_encode(Servertable::simple($_GET, $table, $primaryKey, $columns));

    }
}