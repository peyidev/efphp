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

        $remove = array('Editar','Eliminar','id','video','nombre','address','id_buildingtype','cms_description','from');
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
            'db' => 'from',
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
            'column_name' => 'Edit gallery',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a class='edit-gallery center-data' id='{$d}' href='?s=building-update&amp;id={$d}' class='center-data'><i class='fa fa-picture-o fa-fw fa-2x'></i></a>";

                }
        );

        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Edit',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a href='?s=building-update&amp;id={$d}' class='center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a>";

                }
        );


        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Delete',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {


                    return "<a href='?s=building&amp;id={$d}' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a>";

                }
        );



        $columns = $this->arrangeColumns($columns);


        return $columns;

    }

    function dataFormBuilding($data){

        return $data;

    }


    function getPlacesAdmin($val){

        $sql = $this->dbo->select("place","id_building = {$val}",'*','id DESC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);

        foreach($rows as $k => $row){

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

                                $d = implode(', ',$res);

                            }else{

                                $d = "";

                            }

                            $rows[$k][$key] = $d;


                        }


                    }
                }

            }



        }

        $admin = new Administrador();

        ob_start(); //Start output buffer
        $admin->createGenericForm('place');
        $output = ob_get_contents(); //Grab output
        ob_end_clean(); //Discard output buffer

        $res = array();
        $res['result'] = $output;
        $res['rows'] = $rows;

        echo $this->util->safe_json_encode($res);

    }

    function uploadGallery($id){

        $id = $this->util->limpiarParams($id);

        $name = $this->util->handleImages($_FILES,'gallery');
        if(!empty($name)){
            $next = $this->dbo->select('gallery_building',"id_building = {$id}",'max(order_img) as order_img_next');
            $queryNext = $this->db->query($next);
            $nextItem = $this->util->queryArray($queryNext);
            $nextItem = $nextItem[0]['order_img_next'];
            $nextItem++;

            $insert = array();
            $insert['id_building'] = $id;
            $insert['img_building'] = 'media/img/' . $name;
            $insert['order_img'] = $nextItem;
            $sql = $this->dbo->insert('gallery_building',$insert);
            $this->db->query($sql);
        }

    }


    function updateOrder($reorder){

        $reorder = $this->util->limpiarParams($reorder);

        $_reorder = explode('|',$reorder);

        $new = explode('img-',$_reorder[0])[1];
        $next = explode('img-',$_reorder[1])[1];
        $idBuilding = $_reorder[2];

        $sql = $this->dbo->select('gallery_building',"id='{$next}'",'order_img');
        $query = $this->db->query($sql);
        $order = $this->util->queryArray($query);
        $order = $order[0]['order_img'];

        if($order <= 0)
            $order = 1;

        $sql = "UPDATE gallery_building SET order_img = '{$order}' WHERE id = '{$new}'";
        $this->db->query($sql);

        $sql = "UPDATE gallery_building SET order_img = (order_img + 1) WHERE id_building = '{$idBuilding}' AND order_img >= {$order} AND id <> {$new} ";
        $this->db->query($sql);

        $sql = $this->dbo->select('gallery_building',"id_building='{$idBuilding}'",'min(order_img) as order_img');
        $query = $this->db->query($sql);
        $order = $this->util->queryArray($query);
        $order = $order[0]['order_img'];
        $substract = 0;
        if($order > 1)
            $substract = ($order - 1);

        if($substract <= 0)
            $substract = 0;

        $sql = "UPDATE gallery_building SET order_img = (order_img - {$substract}) WHERE id_building = '{$idBuilding}' AND order_img > {$substract}";
        $this->db->query($sql);




    }


    function getBuildings($val = ""){

        $sql = $this->dbo->selectAutoJoin('building',$val);
        $query = $this->db->query($sql);
        $row = $this->util->queryArray($query);

        echo $this->util->safe_json_encode($row);

    }

    function getGallery($val){

        $val = $this->util->limpiarParams($val);
        $sql = $this->dbo->select("gallery_building","id_building = {$val}",'*','order_img ASC');
        $query = $this->db->query($sql);
        $gallery = $this->util->queryArray($query);
        echo $this->util->safe_json_encode($gallery);

    }

    function getPlaces($val){

        $sql = $this->dbo->select("place","id_building = {$val}",'*','id DESC');
        $query = $this->db->query($sql);
        $rows = $this->util->queryArray($query);

        foreach($rows as $k => $row){

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

                                $d = implode(', ',$res);

                            }else{

                                $d = "";

                            }

                            $rows[$k][$key] = $d;


                        }


                    }
                }

            }



        }


        echo $this->util->safe_json_encode($rows);

    }

}