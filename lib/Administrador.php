   <?php

class Administrador{

    public $db;
    public $util;
    public $dbo;
    public $user;

    function __construct(){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();

    }


    function operativeObject($pkg,$module){

        if(class_exists($pkg)){

            $ex = new stdClass();
            eval("\$ex = new {$pkg}(\$module);");

        }else{
            $ex = $this;
        }

        return $ex;
    }



    function renderAdmin($info = array()){


        $title = !empty($info['title']) ? $info['title'] : "";
        $icon = !empty($info['icon']) ? $info['icon'] : '<i class="fa fa-info-circle fa-fw"></i>';

        $tabla = "";
        $u = $this->util;

        if(!empty($_GET['s'])){
            if(!$this->user->grantRenderPermissionsFromUrl()){
                //return false;
            }


            $pkg = $this->user->grantRenderPermissionsFromUrl();
            $dynamicObj = $this->operativeObject($pkg['pkg'],$pkg['module']);

            $tabla = $_GET['s'];
            $tabla = explode("-", $tabla);

            if(!$this->dbo->tableExist($tabla[0]))
                return false;

            if(count($tabla) > 1){

                echo "<div class='admin-generic'>";
                echo "<h1 class='title-general' id='{$tabla[0]}'>{$icon} {$title}</h1>";
                switch($tabla[1]){

                    case "admin":
                        echo "<div class='add-new-record'>Add new record<i class='fa fa-plus fa-fw'></i></div>";
                        echo "<div class='admin-left-column admin-only-left well'>";
                        $dynamicObj->createAdminTable($tabla[0]);
                        echo "</div>";

                        echo "<div class='admin-right-column admin-only-right'>";
                        //$this->createGrid($tabla[0]);
                        $dynamicObj->createGridBase($tabla[0]);
                        echo "</div>";
                        break;

                    case "update":

                        $id = $_GET['id'];
                        echo "<div class='add-new-record-update'>
                                <a href='?s={$tabla[0]}-admin'>Back <i class='fa fa-rotate-left fa-fw'></i></a>
                              </div>";

                        echo "<div class='admin-left-column well'>";
                        $dynamicObj->createUpdateForm($tabla[0],$id);
                        echo "</div>";

                        echo "<div class='admin-right-column'>";
                        $dynamicObj->createGridBase($tabla[0]);
                        echo "</div>";

                        break;

                    case "report":
                        $dynamicObj->createGrid($tabla[0],"report");
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
                                $dynamicObj->createDetail($tabla[0],$id);
                            }
                        }
                        break;


                    case "vista":
                        $detail = $_GET['s'];
                        $detail = explode("-",$detail);
                        $detail = $detail[0] . (!empty($detail[2]) ? $detail[2] : "");
                        $include = BASE_PATH . ADMINURL . "vistas/{$detail}.php";
                        if(file_exists($include)){
                            include($include);
                        }else{

                            echo "<div class='well well-lg'>No hay información</div>";

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
            $module = "";

            $s = !empty($_GET['s']) ? ("?s=" . $_GET['s']) : "";


            $menu  = "<ul id='main-menu'>";
            $menu .= "<li class='menu-item profile'>
                        <div class='input-group margin-bottom-sm'>
                            <span class='input-group-addon'><i class='fa fa-angle-down fa-fw'></i></span>
                            <a href='#' class='menu-item-link'>{$_SESSION['nombre']}</a>
                        </div>
                        <ul>
                            <li class='submenu-item'><a class='menu-subitem-link' href='../lib/Execute.php?e=User/logout&back=1'>Sign Out</a></li>
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
                                            <a href='{$xml->item[$i]->itemLink}' class='menu-item-link'>{$xml->item[$i]->itemName}
                                            </a>
                                        </div>";

                            if($s == $xml->item[$i]->itemLink){
                                $title = $xml->item[$i]->itemName;
                                $ico = $icon;
                            }

                            if(count($xml->item[$i]->subitem) > 0){
                                $menu.= "<ul>";
                                foreach($xml->item[$i]->subitem as $subitem){

                                    if($s == $subitem->subitemLink){
                                        $title = $subitem->subitemName;
                                        $ico = $icon;
                                        $module = $subitem->module;
                                    }

                                    $visibility = $subitem->visibility;

                                    if(empty($visibility) || $visibility != "no")
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

            $r['title'] = (String)$title;
            $r['icon'] = (String)$ico;
            $r['module'] = (String)$module;

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

    function preselectedRow(){
        $this->insertRow();
    }


    function updateRow(){

        $table = $_GET['table-insert'];
        $u = $this->util;
        $id = $_GET['id'];
        $dbo = $this->dbo;
        $u->handleImages($_FILES,"update");


        if(!empty($_POST['_wysihtml5_mode']))
            unset($_POST['_wysihtml5_mode']);


        foreach($_POST as $key => $val){

            $tmp = explode("__disabled",$key);
            if(count($tmp) > 1){
                unset($_POST[$key]);
                continue;
            }

            if(is_array($val)){
                $_POST[$key] = serialize($val);
            }
        }

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

        if(!empty($_POST['_wysihtml5_mode']))
            unset($_POST['_wysihtml5_mode']);

        foreach($_POST as $key => $val){

            if(is_array($val)){
                $_POST[$key] = serialize($val);
            }
        }

        if($canInsert){

            $sql = $dbo->insert($table,$_POST);
            $query = $this->db->query($sql);

            if(!$query){
                $message->setMessage("error:" . "Hubo un error al insertar, verifica tus datos");

            }

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

    function createGrid($tabla,$report = false, $where = ""){

        $sql = $this->dbo->select($tabla, $where);
        $query = $this->db->query($sql);
        $columns = "";
        $tbody = "";
        $thead = "";
        $flag = true;
        $controles = "";


        if($report){
            $controles .= "<th>Consultar</th>";
        }else if($report == "grid"){
            $controles = "";
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

                    $description = empty($columns[$i]['Comment']) ? $columns[$i]['Field'] : $columns[$i]['Comment'];
                    $description = $this->util->transformName($description);

                    $thead .= "<th>" . $description . "</th>";
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

                        $repeatedForeign = explode("__",$foreign[1]);

                        if(count($repeatedForeign) > 1){
                            $foreign[1] = $repeatedForeign[0];
                        }


                        if ($this->dbo->tableExist($foreign[1])) {

                            $sqlForeign = $this->dbo->select($foreign[1],"id = '{$val}'");
                            $queryForeign = $this->db->query($sqlForeign);

                            while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                $val = !empty($rowForeign['nombre']) ? $rowForeign['nombre'] : $rowForeign['id'];
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

        echo "<table class='table-admin table-admin-render'>
					<thead><tr>{$thead}{$controles}</tr></thead>
					<tfoot><tr>{$thead}{$controles}</tr></tfoot>
					<tbody>{$tbody}</tbody>
				</table>";

    }

    function createGridBase($tabla,$report = false,$modulo = ""){

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
            $controles .= "<th>Edit</th><th>Delete</th>";
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


                $description = empty($columns[$i]['Comment']) ? $columns[$i]['Field'] : $columns[$i]['Comment'];
                $description = $this->util->transformName($description);

                if($flag){
                    $thead .= "<th>" . $description . "</th>";
                }

            }

            $flag = false;

        }


        $thead = $thead . $controles;
        $thead = $this->filterDataGridBase($thead);


        echo "<table class='table-admin table-admin-base' id='{$tabla}-tabla-{$modulo}'>
					<thead><tr>{$thead}</tr></thead>
					<tfoot><tr>{$thead}</tr></tfoot>
				</table>";

    }

    function createGenericForm($tabla, $id = null, $type = "insert", $preselected = null, $title = "",$disabled = "",$overwritetype = ""){

        $extra = !empty($id) ? "&id={$id}" : "";
        $disabled = !empty($disabled) ? " disabled " : "";
        $typeForm = ($type == "preselected") ? "update" : $type;
        $typeForm = !empty($overwritetype) ? $overwritetype : $typeForm;

        echo "<form class='validation-form'  action=\"../lib/Execute.php?e=Administrador/{$typeForm}Row&table-insert={$tabla}{$extra}&back=1\" method=\"post\" enctype=\"multipart/form-data\">";

        $iconOp = ($type == "insert") ?
            "<i class='fa fa-search-plus fa-plus-square-o'></i> Insert New Record" :
            "<i class='fa fa-search-plus fa-pencil-square-o'></i> Update Record";

        if(!empty($title)){
            $iconOp = "<i class='fa fa-search-plus fa-pencil-square-o'></i>{$title}";
        }

        echo "<p class='form-operation'>{$iconOp}</p>";

        $sql = $this->dbo->getColumns($tabla);
        $query = $this->db->query($sql);

        if(!is_object($query)){

            echo "No hay datos qué mostrar";
            return;
        }

        if($type == "update" || ($type == "preselected" && !empty($id))){
            $sqlInfo = $this->dbo->select($tabla,"id='{$id}'");
            $infoQuery = $this->db->query($sqlInfo);
            if(is_object($infoQuery)){
                $info = $infoQuery->fetch_array(MYSQL_ASSOC);
            }
        }

        $data = array();
        while ($row = $query->fetch_array(MYSQL_ASSOC)) {
            $data[] = $row;
        }

        $data = $this->filterDataForm($data);

        foreach($data as $row){

            if($row['Field'] == "id_admin"){
                echo "<input type='hidden' name='id_admin' value='{$_SESSION['id_admin']}'/>";
                continue;
            }else if($row['Field'] == "updated_at"){
                echo "<input type='hidden' name='updated_at' value='now()'/>";
                continue;
            }

            if($row['Field'] != "id"){

                $foreign = explode("id_",$row['Field']);
                $img = explode("img_",$row['Field']);
                $status = explode("status_",$row['Field']);
                $bool = explode("bool_",$row['Field']);
                $cms = explode("cms_",$row['Field']);
                $ajax = explode("_ajax",$row['Field']);
                $foreignSerialized = explode("id_serialized_",$row['Field']);
                $isAjax = "";



                $description = empty($row['Comment']) ? $row['Field'] : $row['Comment'];
                $validation = empty($row['Comment']) ? $row['Field'] : $row['Comment'];
                $serviceType = empty($row['Comment']) ? $row['Field'] : $row['Comment'];
                $subtitle = empty($row['Comment']) ? $row['Field'] : $row['Comment'];

                $description = $this->util->transformName($description);
                $validation = $this->util->getValidationType($validation);
                $serviceType = $this->util->getServiceType($serviceType);
                $subtitle = $this->util->getTitle($subtitle);

                if(!empty($subtitle))
                    echo "<h3 class='subtitle'>{$subtitle}</h3>";

                $flag = true;

                if(count($foreign) > 1){

                    $repeatedForeign = explode("__",$foreign[1]);

                    if(count($repeatedForeign) > 1){

                        $foreign[1] = $repeatedForeign[0];
                    }

                    if($this->dbo->tableExist($foreign[1]) || ( !empty($foreignSerialized[1]) && $this->dbo->tableExist($foreignSerialized[1]))){

                        $multiple = "";
                        $dataType = "";

                        if(count($foreignSerialized) > 1){

                            $foreign[1] = $foreignSerialized[1];
                            $multiple = "multiple";
                            $dataType = "[]";
                        }

                        $sqlForeign = $this->dbo->select($foreign[1]);
                        $queryForeign = $this->db->query($sqlForeign);
                        $combo = "";
                        $style = "";

                        while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ){

                            $selected = "";

                            if(count($foreignSerialized) > 1){

                                $unserialized =  @unserialize($info[$row['Field']]);

                                if(is_array($unserialized)){
                                    foreach($unserialized as $val){

                                        if($rowForeign['id'] == $val){
                                            $selected = " selected=selected";
                                        }
                                    }
                                }


                            }else{


                                if($type == "update" || $type == "preselected"){

                                    if(
                                        (!empty($info[$row['Field']]) && $rowForeign['id'] == $info[$row['Field']]) ||
                                        (!empty($preselected[$row['Field']]) && $rowForeign['id'] == $preselected[$row['Field']])
                                    ){

                                        if(!empty( $preselected[$row['Field']]) && $rowForeign['id'] == $preselected[$row['Field']]){
                                             $style = " style='display:none;' ";
                                        }
                                        $selected = " selected=selected";
                                    }
                                }

                            }

                            $name_ = !empty($rowForeign['nombre']) ? $rowForeign['nombre'] : $rowForeign['id'];

                            $combo.="<option value='{$rowForeign['id']}' {$selected}>{$name_}</option>";
                            $selected = "";

                        }


                        echo "<div class='row-abc' {$style}>
                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'><select {$multiple} class='selectpicker form-control' name='{$row['Field']}{$dataType}'>{$combo}</select></p>
                              </div>";

                        $flag = false;

                    }


                }else if(count($img) > 1){
                    echo "<div class='row-abc'>
                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'><input type='file' name='{$row['Field']}' class='{$row['Type']} $disabled' /></p>
                              </div>";
                    $flag = false;
                }


                if($flag){

                    $val = !empty($info) ? $info[$row['Field']] : "";

                    if($row['Type'] == "text"){

                        $cmsActive = "";
                        if(count($cms) > 1)
                            $cmsActive = "cms-style";

                        echo "<div class='row-abc'>
	                                 <p class='descripcion'>{$description}</p>
	                                 <p class='input'>
	                                    <textarea name='{$row['Field']}' class='$disabled {$row['Type']} $validation form-control {$cmsActive}'>{$val}</textarea>
	                                 </p>
	                              </div>";

                    }else if($row['Type'] == "datetime"){


                        echo "";

                    }else if(count($status) > 1){

                       echo $this->createSelectOptions($val,$description,$row,$type,"status",$disabled,$preselected);


                    }else if(count($bool) > 1){

                        echo $this->createSelectOptions($val,$description,$row,$type,"bool", $disabled,$preselected);


                    }else{

                        $style = "";

                        if(is_array($preselected) && array_key_exists($row['Field'],$preselected)){
                            $style = " style='display:none;' ";
                        }

                        echo "<div class='row-abc' {$style}>
	                                 <p class='descripcion'>{$description}</p>
                                 <p class='input'>
                                     <input type='text' name='{$row['Field']}'
                                     class='$disabled {$row['Type']} $validation $isAjax form-control'
                                     value='{$val}' placeholder='{$description}'/>
                                  </p>
                              </div>";
                    }
                }



            }

        }

        $type = !empty($overwritetype) ? $overwritetype : $type;


        if($type == "update" || ($type == "preselected" && !empty($id))){
            echo '<div class="row-abc"><p class="input"><button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Actualizar</button></p></div>';
        }else{
            echo '<div class="row-abc"><p class="input"><button class="btn btn-lg btn-primary btn-block login-btn" type="submit">Insert</button></p></div>';
        }


        echo '</form>';



    }

    function createSelectOptions($val, $description, $row, $type, $mode, $disabled = "",$preselected = null){

        $combo = "";
        $selected = "";

        $disabled = !empty($disabled) ? " disabled " : "";
        $style = "";
        $cont = 0;

        foreach($this->util->getIconOptions($mode) as $key => $valTmp){

            if($type == "update"  || $type == "preselected"){
                if(!empty($preselected) && !empty($preselected[$row['Field']]) && $preselected[$row['Field']] == $key){

                    $style = " style='display:none;' ";
                    $selected = " selected=selected";

                }else if($key == $val && $type != "preselected"){
                    $selected = " selected=selected";
                }
            }

            $combo .= "<option
                            {$selected}
                            data-content=\"" . $this->util->getStatusIcon($key) . "<span>{$valTmp}</span>\"
                            value='{$key}'>{$valTmp}</option>";

            $selected = "";

        }


        return "<div class='row-abc' $style>
                    <p class='descripcion'>{$description}</p>
                    <p class='input'>
                        <select class='selectpicker form-control {$disabled}'  data-selected-text-format='count'  name='{$row['Field']}'>{$combo}</select>
                    </p>
                </div>";


    }

    function createUpdateForm($tabla, $id){

        $this->createGenericForm($tabla,$id,"update");

    }

    function createAdminTable($tabla){

        $this->createGenericForm($tabla);
    }


    function createAjaxInsert($params,$type = ""){

        $params = explode(',',$params);
        $table = $params[0];
        $foreign = !empty($params[1]) ? $params[1] : "";
        $id = !empty($params[2]) ? $params[2] : "";


        $preselected = array();


        for($i = 1; $i < count($params); $i++){
            $iplus = $i + 1;
            if(!empty($params[$iplus])){
                if($i % 2 != 0){
                    $preselected[$params[$i]] = $params[$iplus];
                }
            }
        }

        //$where = "{$foreign}={$id}";
        $preselected[$foreign] = $id;

        $title = !empty($_GET['title']) ? $_GET['title'] : "";
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if(empty($type))
            $type  = !empty($_GET['type']) ? $_GET['type'] : "";

        $this->createGenericForm($table,$id,"preselected",$preselected, $title,"",$type);

    }

    function createAjaxGrid($params){

        $params = explode(',',$params);
        $table = $params[0];
        $foreign = $params[1];
        $id = $params[2];

        $where = "{$foreign}={$id}";
        $this->createGrid($table,true,$where);

    }

    function createAjaxTable($table){

        $module['module'] = $table;
        $pkg = $this->user->grantRenderPermissions($module);
        $dynamicObj = $this->operativeObject($pkg,$table);

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
                            $status = explode("status_",$field);
                            $bool = explode("bool_",$field);
                            $cms = explode("cms_",$field);
                            $foreignSerialized = explode("id_serialized_",$field);

                            if(count($foreign) > 1 || count($foreignSerialized) > 1) {

                                $repeatedForeign = explode("__",$foreign[1]);

                                if(count($repeatedForeign) > 1){
                                    $foreign[1] = $repeatedForeign[0];
                                }

                                $db = Database::connect();
                                $dbo = new Dbo();
                                $multiple = false;
                                if(!empty($foreignSerialized[1])){

                                    $foreign[1] = $foreignSerialized[1];
                                    $multiple = true;
                                }

                                if ($dbo->tableExist($foreign[1])) {


                                    if($multiple){

                                        $data = @unserialize($d);
                                        $res = array();

                                        if(is_array($data)){
                                            foreach($data as $val){

                                                $sqlForeign = $dbo->select($foreign[1],"id = '{$val}'");
                                                $queryForeign = $db->query($sqlForeign);

                                                while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                                    $res[] = $rowForeign['nombre'];
                                                }

                                            }

                                            $d = implode(', ',$res);

                                        }else{

                                            $d = "";

                                        }


                                    }else{

                                        $sqlForeign = $dbo->select($foreign[1],"id = '{$d}'");
                                        $queryForeign = $db->query($sqlForeign);


                                        while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                            $d = !empty($rowForeign['nombre']) ? $rowForeign['nombre'] : $rowForeign['id'];
                                        }

                                    }


                                }
                            }else if(count($status) > 1 || count($bool) > 1){

                                $util = new Utils();
                                $d = $util->getStatusIcon($d);

                            }else if(count($cms) > 1){

                                $d = "<a href='?s={$table}-detail&id={$row['id']}' class='center-data-unlimited'><i class='fa fa-list-alt fa-fw'></i> Preview</a>";
                            }

                            return $d;
                        }
                );
                $cont++;

            }
        }


        $cont = count($columns);

        $columns[] = array(
            'db' => 'id',
            'dt' => $cont,
            'column_name' => 'Editar',
            'formatter' =>
                function( $d, $row, $table ) {
                    return "<a href='?s={$table}-update&id={$d}' class='center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a>";
                }
        );


        $columns[] = array(
            'db' => 'id',
            'dt' => ++$cont,
            'column_name' => 'Eliminar',
            'formatter' =>
                function( $d, $row, $table ) {
                    return "<a href='?s={$table}&id={$d}' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a>";
                }
        );



        $extra = !empty($_GET['extraValue']) ? $_GET['extraValue'] : null;

        $columns = $dynamicObj->filterDataGrid($columns,$cont, $extra);
        $where = "";

        if(!empty($columns['where'])){

            $where = $columns['where'];
            unset($columns['where']);

        }


        echo $this->util->safe_json_encode(Servertable::simple($_GET, $table, $primaryKey, $columns, $where));

    }



    function filterDataForm($data){
        return $data;
    }

    function filterDataGrid($columns,$cont, $extra = null){

        return $columns;

    }

    function filterDataGridBase($columns){

        return $columns;

    }
}