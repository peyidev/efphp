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

        $remove = array('Editar','Eliminar','id','video','nombre','address');
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

                    $sql = $dbo->select("gallery_building","id_building={$d} ORDER BY id ASC LIMIT 1");
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
            'db' => 'id',
            'column_name' => 'Rooms type',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a href='?s=place-admin&amp;id={$d}' class='center-data'><i class='fa fa-home fa-fw fa-2x'></i></a>";

                }
        );




        $columns[] = array(
            'db' => 'id',
            'column_name' => 'Edit gallery',
            'dt' => $cont,
            'formatter' =>
                function( $d, $row, $table ) {

                    return "<a class='edit-gallery' id='{$d}' href='?s=building-update&amp;id={$d}' class='center-data'><i class='fa fa-picture-o fa-fw fa-2x'></i></a>";

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



}