<?php

class Mhmproperties extends Administrador{

    public $module;
    public $db;
    public $util;
    public $dbo;
    public $user;
    public $customColumns;

    function __construct($module){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();
        $this->module = $module;
        $this->customColumns = array();

    }

    function getBuildingResume(){

        $sql = $this->dbo->select('building');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);

        $howmany =  count($rows);
        $leased = 0;
        foreach($rows as $buildings){

            foreach($buildings as $key => $val){

                //echo $key . "->" . $val . "<br />";
                if($key == 'fromfee'){
                    if($val == 'LEASED'){
                        $leased++;

                    }
                }

            }
        }

        echo "<div class='container'><h5>We have <strong>{$howmany}</strong> buildings, <strong>{$leased}</strong> are leased.</h5></div>";
        echo "<div class='container'><h5>We have <strong style='color:red;'>0</strong> recent contact/form messages.</h5></div>";

    }

    /*
     * PARA formularios de abc
     * */

    function filterDataForm($data){

        return $this->factoryDataForm($data);

    }

    function factoryDataForm($data){

        if(!is_object($this->module) && !empty($this->module['module']))
            $module = $this->module['module'];
        else
            $module = $this->module;

        switch($module){
            case "buildingInner":
                $data = $this->dataFormBuilding($data);
                break;
        }
        return $data;

    }

    function onlyDataFields($data, $remove){

        $result = array();

        foreach($data as $key => $row){

            foreach($row as $i){

                if(!in_array($i,$remove)){
                    unset($data[$key]);
                }else{
                    break;
                }

            }

        }
        return $data;

    }

    function removeDataFields($data, $remove){

        foreach($data as $key => $row){

            foreach($row as $i){

                if(in_array($i,$remove)){
                    unset($data[$key]);
                    break;
                }

            }

        }
        return $data;
    }


    /*
     * funciones para grid informativo
     * */


    function filterDataGrid($columns,$cont, $extra = null){

        return $this->factoryDataGrid($columns,$cont, $extra);

    }

    function factoryDataGrid($columns = array(),$cont = 1, $extra = null){

        if(!empty($this->module['module']))
            $module = $this->module['module'];
        else
            $module = $this->module;

        if(!empty($extra))
            $module = $extra;

        switch($module){

            case "buildingInner":
                $data = $this->dataGridBuilding($columns,$cont);
                break;
        }


        return !empty($data) ? $data : $columns;

    }

    function deleteColumnsFromTh($th){

        $toremove = array();
        foreach($this->customColumns as $column){
            $toremove[] = "<th>" . $column . "</th>";
        }
        $res = str_replace($toremove,"",$th);
        return $res;

    }

    function deleteColumnsFromArray($columns,$remove){

        foreach($columns as $key => $val){
            if(in_array($columns[$key]['db'],$remove) || (!empty($columns[$key]['column_name']) && in_array($columns[$key]['column_name'],$remove))){
                unset($columns[$key]);
            }
        }

        return $columns;
    }

    function arrangeColumns($columns){

        $cont = 0;
        $res = array();

        foreach($columns as $key => $val){
            $columns[$key]['dt'] = $cont;
            $res[]  = $columns[$key];
            $cont++;
        }

        return $res;

    }

    /*
     * función para grid base (esqueleto de tablas)
     * */

    function filterDataGridBase($columns){

        $c = $this->factoryDataGrid();

        if(!empty($c['where'])){
            unset($c['where']);
        }
        $columns = $this->deleteColumnsFromTh($columns);

        foreach($c as $column){
            $columns .= "<th>" . ($column['column_name']) . "</th>";
        }

        return $columns;

    }


    function dataGridBuilding($columns = array(),$cont = 1){

        $remove = array('Editar','Eliminar','id','video','nombre','address','id_buildingtype','cms_description','fromfee','bool_featured','bool_mainfeatured','id_serialized_amenitie','Building type','Name','Address','Start Price  (Red label)','Description','Featured','Main Featured (Home)','Video Name','id_serialized_nerbyamenitie', 'Amenities','Nearby', 'Edit', 'Delete','updated_at');
        $this->customColumns = $remove;
        $columns = $this->deleteColumnsFromArray($columns,$remove);

        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Building',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    $db = Database::connect();
                    $dbo = new Dbo();

                    $sql = $dbo->select("gallery_building","id_building={$d} ORDER BY order_img ASC LIMIT 1");
                    $query = $db->query($sql);
                    $res = "";

                    while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                        $res = $rowForeign['img_building'];
                    }



                    return !empty($res) ?  "<img style='width:200px;' src='../$res' />" : "No picture";

                }
        );

      $columns[] = array(
        'db' => 'id_buildingtype',
        'column_name' => 'Building Type',
        'dt' => $cont,
        'formatter' =>
          function( $d, $row, $table ) {

            $db = Database::connect();
            $dbo = new Dbo();

            $sql = $dbo->select("buildingtype","id={$d} LIMIT 1");
            $query = $db->query($sql);
            $res = "";

            while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
              $res = $rowForeign['nombre'];
            }


            return !empty($res) ?  $res : "No type";

          }
      );

        $columns[] = array(
            'db' => 'nombre',
            'column_name' => 'Name',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return $d;

                }
        );


        $columns[] = array(
            'db' => 'address',
            'column_name' => 'Address',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return $d;

                }
        );

        $columns[] = array(
            'db' => 'fromfee',
            'column_name' => 'From',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<span style='color:red;'>" . $d . "</span>";

                }
        );



        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Rooms type',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a  class='edit-places center-data' id='{$d}' href='?s=place-admin&amp;id={$d}'><i class='fa fa-home fa-fw fa-2x'></i></a>";

                }
        );




        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Gallery',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a class='edit-gallery center-data' id='{$d}' href='?s=building-update&amp;id={$d}' class='center-data'><i class='fa fa-picture-o fa-fw fa-2x'></i></a>";

                }
        );


        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Floorplans',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a class='edit-floorplans center-data' id='{$d}' href='?s=building-update&amp;id={$d}' class='center-data'><i class='fa fa-picture-o fa-fw fa-2x'></i></a>";

                }
        );

        $columns[] = array(
            'db' => 'updated_at',
            'column_name' => 'updated at',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return $d;

                }
        );

        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Edit',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a href='?s=building-update-vista&id={$d}' class='center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a>";

                }
        );



        if($_SESSION['nombre'] == "Administrador"){
            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Delete',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {


                        return "<a href='?s=building&amp;id={$d}' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a>";

                    }
            );
        }




        $columns = $this->arrangeColumns($columns);


        return $columns;

    }

    function dataFormBuilding($data){

        return $data;

    }


    function getPlacesUpdateAdmin($val){

        $vars = explode('-',$val);
        $building = $vars[0];
        $place = $vars[1];
        $this->getPlacesAdmin($building,$place,true);
    }

    function getPlacesAdmin($val, $place = "", $update = false){

        $sql = $this->dbo->select("place","id_building = {$val}",'*','id DESC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);

        $admin = new Administrador();

        ob_start(); //Start output buffer
        if(!$update){
            $admin->createGenericForm('place');
        }else{
            $admin->createGenericForm('place',$place,"update");
        }

        $output = ob_get_contents(); //Grab output
        ob_end_clean(); //Discard output buffer

        $res = array();
        $res['result'] = $output;
        $res['rows'] = $rows;

        echo $this->util->safe_json_encode($res);

    }

    function uploadFloorplans($id){
        $this->uploadGallery($id, "gallery_floorplans");
    }

    function uploadGallery($id,$type = "gallery_building"){

        $id = $this->util->limpiarParams($id);
        $name = $this->util->handleImages($_FILES,'gallery');

        if(!empty($name)){

            $building = $this->dbo->select('building',"id = {$id}");
            $queryBuilding = $this->db->query($building);
            $buildingData = $this->util->queryArray($queryBuilding);
            $seo = $buildingData[0]['nombre'];


            $next = $this->dbo->select($type,"id_building = {$id}",'max(order_img) as order_img_next');
            $queryNext = $this->db->query($next);
            $nextItem = $this->util->queryArray($queryNext);
            $nextItem = $nextItem[0]['order_img_next'];
            $nextItem++;

            $insert = array();
            $insert['seotitle'] = $seo;
            $insert['seoalt'] = $seo;



            $insert['id_building'] = $id;
            $insert['img_building'] = 'media/img/' . $name;
            $insert['order_img'] = $nextItem;
            $sql = $this->dbo->insert($type,$insert);
            $this->db->query($sql);
        }

    }

    function updateOrderPlans($reorder){

        $this->updateOrder($reorder,"gallery_floorplans");

    }

    function updateOrder($reorder,$type = "gallery_building"){

        $reorder = $this->util->limpiarParams($reorder);

        $_reorder = explode('|',$reorder);

        $new = explode('img-',$_reorder[0])[1];
        $next = explode('img-',$_reorder[1])[1];
        $idBuilding = $_reorder[2];

        $sql = $this->dbo->select($type,"id='{$next}'",'order_img');
        $query = $this->db->query($sql);
        $order = $this->util->queryArray($query);
        $order = $order[0]['order_img'];

        if($order <= 0)
            $order = 1;

        $sql = "UPDATE {$type} SET order_img = '{$order}' WHERE id = '{$new}'";
        $this->db->query($sql);

        $sql = "UPDATE {$type} SET order_img = (order_img + 1) WHERE id_building = '{$idBuilding}' AND order_img >= {$order} AND id <> {$new} ";
        $this->db->query($sql);

        $sql = $this->dbo->select($type,"id_building='{$idBuilding}'",'min(order_img) as order_img');
        $query = $this->db->query($sql);
        $order = $this->util->queryArray($query);
        $order = $order[0]['order_img'];
        $substract = 0;
        if($order > 1)
            $substract = ($order - 1);

        if($substract <= 0)
            $substract = 0;

        $sql = "UPDATE {$type} SET order_img = (order_img - {$substract}) WHERE id_building = '{$idBuilding}' AND order_img > {$substract}";
        $this->db->query($sql);


    }


    function getBuildings($val = "",$type = ""){

        $extra = "";

        switch($type){

            case "featured":
                $extra = " bool_featured = 1 ";
                break;
            case "type":
                $extra = " bt.nombre = '{$val}' ";
                break;
            default:
                $extra = " 1 = 1 ";
                break;
        }

        $sql = $this->dbo->select("building
                    JOIN (SELECT
                              min(order_img) AS order_img,
                              id_building
                            FROM gallery_building
                            GROUP BY id_building) AS tmp_gallery
                        ON building.id = tmp_gallery.id_building
                      JOIN gallery_building AS gb ON gb.id_building = building.id AND gb.order_img = tmp_gallery.order_img
                      JOIN buildingtype AS bt ON bt.id = building.id_buildingtype","$extra","building.*,gb.img_building, UCASE(bt.nombre) as buildingtype");

        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);
        $rooms = array();


        foreach($rows as $k => $row){

            $rows[$k]['rooms'] = $this->getPlaces($rows[$k]['id'],false);

            foreach($rows[$k]['rooms']  as $room){

                $rooms[] = $room['nombre'];

            }

            foreach($row as $key => $val){

                $foreignSerialized = explode("id_serialized_",$key);
                $foreign = explode("id_",$key);
                $d = "";

                if(count($foreignSerialized) > 1) {

                    $repeatedForeign = explode("__",$foreign[1]);

                    if(count($repeatedForeign) > 1){
                        $foreign[1] = $repeatedForeign[0];
                    }


                    $multiple = false;
                    if(!empty($foreignSerialized[1])){

                        $foreign[1] = $foreignSerialized[1];
                        $multiple = true;
                    }

                    if ($this->dbo->tableExist($foreign[1])) {

                        if($multiple){

                            $data = @unserialize($val);
                            $res = array();

                            if(is_array($data)){
                                foreach($data as $v){

                                    $sqlForeign = $this->dbo->select($foreign[1],"id = '{$v}'");
                                    $queryForeign = $this->db->query($sqlForeign);

                                    while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                        $res[] = $rowForeign['nombre'];
                                    }

                                }

                            }

                            $rows[$k][$key] = $res;


                        }


                    }
                }

            }



        }

        if($type != "featured"){
            $rooms = array_unique($rooms);
            $rows['roomfilter'] = $rooms;
        }


        return $rows;
    }


    function getHomeGallery(){

        $sql = $this->dbo->select("gallery_home",'','*','position ASC');
        $query = $this->db->query($sql);
        $gallery = $this->util->queryArray($query);


       echo $this->util->safe_json_encode($gallery);


    }

    function getBuildingByType($val = ""){

        $rows = $this->getBuildings($val,'type');
        echo $this->util->safe_json_encode($rows);
    }

    function getBuildingsFeatured($val = ""){


        $rows = $this->getBuildings($val,'featured');
        echo $this->util->safe_json_encode($rows);

    }

    function getGallery($val,$json = true){

        $val = $this->util->limpiarParams($val);
        $sql = $this->dbo->select("gallery_building","id_building = {$val}",'*','order_img ASC');
        $query = $this->db->query($sql);
        $gallery = $this->util->queryArray($query);


        if($json)
            echo $this->util->safe_json_encode($gallery);
        else
            return $gallery;

    }

    function getPlans($val,$json = true){

        $val = $this->util->limpiarParams($val);
        $sql = $this->dbo->select("gallery_floorplans","id_building = {$val}",'*','order_img ASC');
        $query = $this->db->query($sql);
        $gallery = $this->util->queryArray($query);


        if($json)
            echo $this->util->safe_json_encode($gallery);
        else
            return $gallery;

    }

    function getPlaces($val,$json = true){

        $sql = $this->dbo->select("place","id_building = {$val}",'*','order_place ASC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);

        if($json)
            echo $this->util->safe_json_encode($rows);
        else
            return $rows;

    }

    function getBuildingDetail($val){
        $id = $this->util->limpiarParams($val);
        $sql = $this->dbo->select('building',"id={$id}");
        $query = $this->db->query($sql);
        $building = $this->util->queryArray($query);


        foreach($building as $k => $row){


            foreach($row as $key => $val){

                $foreignSerialized = explode("id_serialized_",$key);
                $foreign = explode("id_",$key);
                $d = "";

                if(count($foreignSerialized) > 1) {

                    $repeatedForeign = explode("__",$foreign[1]);

                    if(count($repeatedForeign) > 1){
                        $foreign[1] = $repeatedForeign[0];
                    }


                    $multiple = false;
                    if(!empty($foreignSerialized[1])){

                        $foreign[1] = $foreignSerialized[1];
                        $multiple = true;
                    }

                    if ($this->dbo->tableExist($foreign[1])) {

                        if($multiple){

                            $data = @unserialize($val);
                            $res = array();

                            if(is_array($data)){
                                foreach($data as $v){

                                    $sqlForeign = $this->dbo->select($foreign[1],"id = '{$v}'");
                                    $queryForeign = $this->db->query($sqlForeign);

                                    while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                                        $res[] = $rowForeign['nombre'];
                                    }

                                }

                            }

                            $building[$k][$key] = $res;


                        }

                    }
                }

            }

        }

        $building['places'] = $this->getPlaces($id,false);
        $building['gallery'] = $this->getGallery($id,false);
        $building['floorplans'] = $this->getPlans($id,false);

        echo $this->util->safe_json_encode($building);

    }






    function getAllMoveInReports(){

        $sql = $this->dbo->select("movein_report","",'*','id DESC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);
        echo json_encode($rows);
    }
    function getMoveInReportsFilter(){

        $sql = $this->dbo->select("movein_report","status='Pending' and repair_status='Pending'",'*','id DESC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);
        echo json_encode($rows);
    }

    function updateReportById($request){

        $data = $_GET;

        $newData = array();
        $idUpdate = $data['id'];
        $repairStatus = null;

        unset($data['e'],$data['id']);

        if($data['repair']){
            $repairStatus = 'Pending';
            unset($data['repair']);
        }

        $newData['report_condition'] = json_encode($this->fixDataArray($data));
        $newData['status'] = 'Pending';




        $sql = "UPDATE movein_report SET status = '{$newData['status']}', updated_at = now(), report_condition = '{$newData['report_condition']}', repair_status = '{$repairStatus}' WHERE id = '{$idUpdate}'";
        $this->db->query($sql);

        print 'OK';

        return;

    }
    private function fixDataArray($data){

        $newDataArray = array();
        foreach($data as $x => $item)
        {
            $indexLabel = explode('-comment', $x);
            if(count($indexLabel) == 1){
                $indexLabel2 = explode('-who', $indexLabel[0]);
                if(count($indexLabel2) == 1){
                    $indexLabel3 = explode('-yesno', $indexLabel2[0]);
                    if(count($indexLabel2) == 1){
                        $newDataArray[$indexLabel3[0]]['yesno'] = $item;
                    }
                }
                else
                {
                    $newDataArray[$indexLabel2[0]]['who'] = $item;
                }
            }
            else
                $newDataArray[$indexLabel[0]]['comment'] = $item;
        }
        return $newDataArray;
    }


}




























