<?php

    class Medios extends Administrador{

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

            if(!empty($this->module['module']))
                $module = $this->module['module'];
            else
                $module = $this->module;

            switch($module){
                case "leadInner":
                    $data = $this->dataFormLeads($data);
                    break;
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

                case "leadInner":
                    $data = $this->dataGridLeads($columns,$cont);
                    break;
                default:

                default:
                    $data = $columns;
                    break;
            }
            return $data;

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

        /*
         * Módulos particulares
         * */

        function dataFormLeads($data){

            $remove = array('fecha_solicitud','fecha_revision','bool_aprobado','Editar','Eliminar');
            $this->customColumns = $remove;
            return $this->removeDataFields($data,$remove);

        }

        function dataGridLeads($columns = array(),$cont = 1){

            $remove = array('fecha_solicitud','fecha_revision','bool_aprobado','Editar','Eliminar','numero_sucursales','Fecha de revisión','Fecha de solicitud','Aprobado','Número de sucursales');
            $this->customColumns = $remove;
            $columns = $this->deleteColumnsFromArray($columns,$remove);


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Por hacer',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $db = Database::connect();
                        $dbo = new Dbo();

                        $sql = $dbo->select("actividad","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $res = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $res = $rowForeign['comentarios_fut'];
                        }

                        return $res;
                    }
            );


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Próxima actividad',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $db = Database::connect();
                        $dbo = new Dbo();

                        $sql = $dbo->select("actividad","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $res = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $res = $rowForeign['hora_fut'];
                        }

                        return $res;
                    }
            );

            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Estatus seg',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $db = Database::connect();
                        $dbo = new Dbo();

                        $sql = $dbo->select("actividad","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $res = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $res = $rowForeign['id_cat_estatus_actividad'];
                        }

                        $sqlForeign = $dbo->select("cat_estatus_actividad","id = '{$res}'");
                        $queryForeign = $db->query($sqlForeign);

                        while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ) {
                            $d = $rowForeign['nombre'];
                        }

                        return $d;
                    }
            );



            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Detalles',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='../lib/Execute.php?e=Administrador/createAjaxGrid/actividad/id_lead/{$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-search-plus fa-fw fa-2x'></i></a>";
                    }
            );


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Actividades',
                'db' => 'id',
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/actividad/id_lead/{$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                    }
            );


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Contacto',
                'db' => 'id',
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/contacto/id_lead/{$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                    }
            );



            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Contrato',
                'db' => 'id',
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $db = Database::connect();
                        $dbo = new Dbo();

                        $sql = $dbo->select("actividad","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $res = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $res = $rowForeign['id_cat_estatus_actividad'];
                        }

                        if($res == 5){

                            return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/actividad/id_lead/{$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-list-alt fa-fw fa-2x'></i></a>";

                        }else{

                            return "";

                        }


                    }
            );


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Registro',
                'db' => 'id',
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/actividad/id_lead/{$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                    }
            );


            $columns = $this->arrangeColumns($columns);

            $columns['where'] = 'bool_aprobado=1';

            return $columns;

        }


    }