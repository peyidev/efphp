<?php

    class Medios extends Administrador{

        public $module;
        public $db;
        public $util;
        public $dbo;
        public $user;

        function __construct($module){

            $this->db = Database::connect();
            $this->util = new Utils();
            $this->dbo = new Dbo();
            $this->user = new User();
            $this->module = $module;

        }


        /*
         * PARA FORMULARIOS
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
                case "lead":
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
         * PARA GRID
         * */


        function filterDataGrid($columns,$cont){

            return $this->factoryDataGrid($columns,$cont);

        }


        function factoryDataGrid($columns = array(),$cont = 1){

            if(!empty($this->module['module']))
                $module = $this->module['module'];
            else
                $module = $this->module;

            switch($module){
                case "lead":
                    $data = $this->dataGridLeads($columns,$cont);
                    break;
            }
            return $data;

        }



        /*
         * Para grid genérico
         * */

        function filterDataGridBase($columns){

            $c = $this->factoryDataGrid();

            foreach($c as $column){

                $columns .= "<th>" . ($column['column_name']) . "</th>";


            }

            return $columns;

        }

        /*
         * Módulos particulares
         * */

        function dataFormLeads($data){

            $remove = array('fecha_solicitud','fecha_revision');
            return $this->removeDataFields($data,$remove);

        }

        function dataGridLeads($columns = array(),$cont = 1){


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Detalles',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='?s=detalle_lead&id={$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                    }
            );



            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Actividades',
                'db' => 'id',
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {
                        return "<a href='?s=actividad_lead&id={$d}' class='actividad_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                    }
            );



            return $columns;

        }


    }