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

            if(!is_object($this->module) && !empty($this->module['module']))
                $module = $this->module['module'];
            else
                $module = $this->module;

            switch($module){
                case "leadInner":
                    $data = $this->dataFormLeads($data);
                    break;
                case "establecimientoInner":
                    $data = $this->dataFormEstablecimiento($data);
                    break;
                case "sucursalInner":
                    $data = $this->dataFormSucursal($data);
                    break;
                case "establecimientoClasificacionInner":
                    $data = $this->dataFormEstablecimientoClasificacion($data);
                    break;
                case "establecimientoServicioInner":
                    $data = $this->dataFormEstablecimientoServicio($data);
                    break;
                case "establecimientoComidaInner":
                    $data = $this->dataFormEstablecimientoComida($data);
                    break;
                case "establecimientoMusicaInner":
                    $data = $this->dataFormEstablecimientoMusica($data);
                    break;
                case "establecimientoPagoInner":
                    $data = $this->dataFormEstablecimientoPago($data);
                    break;
                case "establecimientoVestimentaInner":
                    $data = $this->dataFormEstablecimientoVestimenta($data);
                    break;
                case "establecimientoIdealInner":
                    $data = $this->dataFormEstablecimientoIdeal($data);
                    break;
                case "establecimientoOportunidadInner":
                    $data = $this->dataFormEstablecimientoOportunidad($data);
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

                case "leadInner":
                    $data = $this->dataGridLeads($columns,$cont);
                    break;
                case "establecimientoInner":
                    $data = $this->dataGridEstablecimiento($columns,$cont);
                    break;
                case "sucursalInner":
                    $data = $this->dataGridSucursal($columns,$cont);
                    break;
                case "sucursalBienvenidaInner":
                    $data = $this->dataGridSucursalBienvenida($columns,$cont);
                    break;
                default:
                case "llamadaSeguimientoInner":
                    $data = $this->dataGridLlamadaSeguimiento($columns,$cont);
                    break;
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

        function createAjaxViewLlamada($params){

            $include = BASE_PATH . ADMINURL . "vistas/llamadaseguimientodetail.php";
            include($include);
        }

        function dataGridLlamadaSeguimiento($columns = array(),$cont = 1){



            $remove = array('id','Editar','Eliminar','id_tipo_llamada','id_motivo','fecha_llamada','id_tarjeta','id_admin','apellido_paterno','apellido_materno','Teléfono','bool_iscelular1','telefono_1','Marca','visita','id_donde_promocion','marca','id_marca');
            $this->customColumns = $remove;
            $columns = $this->deleteColumnsFromArray($columns,$remove);

            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Seguimiento',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $id = $d;

                        return "<a href='../lib/Execute.php?e=Medios/createAjaxViewLlamada/llamada_seguimiento/id_llamada/{$row['id_llamada']}&title=Crear registro' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus fa-fw fa-2x'></i></a>";
                    }
            );

            $columns = $this->arrangeColumns($columns);

            $main = !empty($_GET['mainValue']) ? $this->util->limpiar($_GET['mainValue']) : "";

            if($main != -1){
                $columns['where'] = 'llamada.id_proyecto=' . $main;
            }



            return $columns;

        }

        /*
         * INICIO SUCURSAL
         * */
        function dataFormSucursal($data){

            $remove = array('fecha_solicitud','fecha_revision','bool_aprobado','Editar','Eliminar','bool_contrato','id');
            $this->customColumns = $remove;
            return $this->removeDataFields($data,$remove);

        }

        function dataGridSucursal($columns = array(),$cont = 1){


            $main = !empty($_GET['mainValue']) ? $this->util->limpiar($_GET['mainValue']) : "";
            $columns['where'] = 'id_establecimiento=' . $main;

            return $columns;

        }

        function dataGridSucursalBienvenida($columns = array(),$cont = 1){

// Manejar el filtro
//            $main = !empty($_GET['mainValue']) ? $this->util->limpiar($_GET['mainValue']) : "";
//            $columns['where'] = 'id_establecimiento=' . $main;


            $remove = array('Editar','Eliminar','latitud','longitud','calle','no_exterior','no_interior','precios','horarios','img_logochico','img_logogrande','fachada','resena','id_zona','id_colonia_ajax','id_establecimiento');
            $this->customColumns = $remove;
            $columns = $this->deleteColumnsFromArray($columns,$remove);


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Estado',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                       return $d;
                    }
            );

            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Municipio',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        return $d;
                    }
            );


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Llamada bienvenida',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        //queryArray

                        $db = Database::connect();
                        $dbo = new Dbo();
                        $u = new Utils();

                        $sql = $dbo->select("telemarketing_bienvenida","id_sucursal={$d} AND bool_activa = 1");
                        $query = $db->query($sql);
                        $res = $u->queryArray($query);

                        if(!empty($res)){
                            if($res[0]['bool_efectiva'] == 1){

                                return "<i class='fa fa fa-check fa-fw si-style'></i></a>";
                            }else{

                                return "<i class='fa fa fa-close fa-fw no-style'></i></a>";
                            }


                        }else{
                            return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/telemarketing_bienvenida/id_sucursal/{$d}/bool_activa/1' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                        }

                    }
            );



            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Geolocalización',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {


                        $db = Database::connect();
                        $dbo = new Dbo();
                        $u = new Utils();

                        $sql = $dbo->select("sucursal","id={$d}");
                        $query = $db->query($sql);
                        $res = $u->queryArray($query);


                        if( !empty($res[0]['calle']) &&
                            !empty($res[0]['no_exterior']) &&
                            !empty($res[0]['latitud']) &&
                            !empty($res[0]['longitud']) &&
                            !empty($res[0]['id_zona']) &&
                            !empty($res[0]['id_colonia_ajax'])
                        ){

                            return "<i class='fa fa fa-check fa-fw si-style'></i></a>";

                        }else{

                            $id_marca = !empty($res[0]['id_marca']) ? $res[0]['id_marca'] : -1;
                            $nombre = !empty($res[0]['nombre']) ? $res[0]['nombre'] : -1;
                            $id_establecimiento = !empty($res[0]['id_establecimiento']) ? $res[0]['id_establecimiento'] : -1;
                            $telefono = !empty($res[0]['telefono']) ? $res[0]['telefono'] : -1;
                            $precios = !empty($res[0]['precios']) ? $res[0]['precios'] : -1;
                            $resena = !empty($res[0]['resena']) ? $res[0]['resena'] : -1;

                            return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/sucursal/id/{$d}/id_marca/{$id_marca}/nombre/{$nombre}/id_establecimiento/{$id_establecimiento}/telefono/{$telefono}/precios/{$precios}/resena/{$resena}&id={$d}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-plus-square fa-fw fa-2x'></i></a>";
                        }


                    }
            );



            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Subió promoción',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        return $d;
                    }
            );

            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Sucursal WP',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        return $d;
                    }
            );



            $columns = $this->arrangeColumns($columns);
            return $columns;

        }
        /*
         * FIN SUCURSAL
         * */



        /*
         * INICIO LEADS
         * */
        function dataFormLeads($data){

            $remove = array('fecha_solicitud','fecha_revision','bool_aprobado','Editar','Eliminar','bool_contrato','id');
            $this->customColumns = $remove;
            return $this->removeDataFields($data,$remove);

        }

        function dataGridLeads($columns = array(),$cont = 1){

            $remove = array('fecha_solicitud','fecha_revision','bool_aprobado','Editar','Eliminar','numero_sucursales','Fecha de revisión','Fecha de solicitud','Aprobado','Número de sucursales','bool_contrato','id');
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
                'dt' => ++$cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        $id = $d;

                        $db = Database::connect();
                        $dbo = new Dbo();


                        $sql = $dbo->select("actividad","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $canContrato = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $canContrato = $rowForeign['id_cat_estatus_actividad'];
                        }

                        if($canContrato >= 4  && $canContrato != 8){

                            $sql = $dbo->select("contrato_lead","id_lead={$d} ORDER BY id DESC LIMIT 1");
                            $query = $db->query($sql);
                            $res = "";

                            while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                                $res = $rowForeign['id'];
                            }

                            if(!empty($res)){

                                return "<a href='?s=contrato_lead-update&id={$res}' class='detalle_lead-admin center-data'><i class='fa fa-check fa-fw fa-2x'></i></a>";

                            }else{

                                return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/contrato_lead/id_lead/{$id}' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-close fa-fw fa-2x'></i></a>";
                            }

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


                        $id = $d;

                        $db = Database::connect();
                        $dbo = new Dbo();


                        $sql = $dbo->select("contrato_lead","id_lead={$d} ORDER BY id DESC LIMIT 1");
                        $query = $db->query($sql);
                        $contrato = "";

                        while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                            $contrato = $rowForeign['id'];
                        }

                        if(!empty($contrato)){

                            $sql = $dbo->select("establecimiento","id_lead={$d} ORDER BY id DESC LIMIT 1");
                            $query = $db->query($sql);
                            $res = "";

                            while($rowForeign = $query->fetch_array(MYSQL_ASSOC) ) {
                                $res = $rowForeign['id'];
                            }

                            if(!empty($res)){

                                return "<a href='?s=establecimiento-update&id={$res}' class='detalle_lead-admin center-data'><i class='fa fa-check fa-fw fa-2x'></i></a>";

                            }else{

                                $idMarca = $row['id_marca'];

                                return "<a href='../lib/Execute.php?e=Administrador/createAjaxInsert/establecimiento/id_lead/{$id}/id_marca/{$idMarca}&title=Crear registro' class='detalle_lead-admin center-data popup-admin'><i class='fa fa-close fa-fw fa-2x'></i></a>";
                            }

                        }

                    }
            );

            $columns = $this->arrangeColumns($columns);

            $columns['where'] = 'bool_aprobado=1';

            return $columns;

        }
        /*
         * FIN LEADS
         * */


        /*
         * INICIO ESTABLECIMIENTO
         * */
        function dataFormEstablecimientoClasificacion($data){

            $remove = array('id_serialized_establecimiento_clasificacion');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoServicio($data){

            $remove = array('id_serialized_establecimiento_servicio');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoComida($data){

            $remove = array('id_serialized_establecimiento_comida');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoMusica($data){

            $remove = array('id_serialized_establecimiento_musica');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoPago($data){

            $remove = array('id_serialized_establecimiento_pago');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoVestimenta($data){

            $remove = array('id_serialized_establecimiento_vestimenta');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoIdeal($data){

            $remove = array('id_serialized_establecimiento_ideal');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimientoOportunidad($data){

            $remove = array('id_serialized_establecimiento_oportunidad');
            $this->customColumns = $remove;
            return $this->onlyDataFields($data,$remove);
        }

        function dataFormEstablecimiento($data){
            $remove = array('Editar','Clasificaciones','Comida','Tipo de pago','Ideal para','Oportunidades','Vestimenta','Servicios','Música');
            $this->customColumns = $remove;
            return $this->removeDataFields($data,$remove);

        }

        function dataGridEstablecimiento($columns = array(),$cont = 1){

            $remove = array('Editar','Música','Eliminar','id','id_lead','rfc','bool_iscelular1','telefono_2','bool_iscelular2','id_colonia_ajax','calle','no_exterior','no_interior','referencia','latitud','longitud','bool_calidad','¿Actividad de Calidad?','id_serialized_actividad_calidad','Actividad de calidad','nombre_contacto','telefono_1','¿Es celular?','comentario','Clasificaciones','Comida','Tipo de pago','Ideal para','Oportunidades','Vestimenta','Actividad de calidad','Servicios','id_serialized_establecimiento_clasificacion','id_serialized_establecimiento_comida','id_serialized_establecimiento_tipo','id_serialized_establecimiento_ideal','id_serialized_establecimiento_musica','id_serialized_establecimiento_servicio','id_serialized_establecimiento_pago',
'id_serialized_establecimiento_oportunidad','id_serialized_establecimiento_vestimenta','bool_calidad','id_serialized_actividad_calidad','comentario');
            $this->customColumns = $remove;
            $columns = $this->deleteColumnsFromArray($columns,$remove);


            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Detalles',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {

                        return "<a href='?s=establecimiento-vista-detail&id={$d}' class='center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a>";
                    }
            );

            $columns[] = array(
                'db' => 'id',
                'column_name' => 'Eliminar',
                'dt' => $cont,
                'formatter' =>
                    function( $d, $row, $table ) {


                        return "<a href='?s=establecimiento&id={$d}' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a>";
                    }
            );

            $columns = $this->arrangeColumns($columns);
            return $columns;

        }
        /*
        * FIN ESTABLECIMIENTO
        * */


        /*
         * INICIO CALLCENTER
         * */

        function insertLlamada(){

            if(!empty($_POST['rand']))
                unset($_POST['rand']);


            if(!empty($_POST['folio'])){

                $sql = $this->dbo->select("llamada","folio={$_POST['folio']}");
                $query = $this->db->query($sql);
                $row = $this->util->queryArray($query);
                $id = "";

                if(empty($row)){

                    $sql = $this->dbo->insert("llamada",$_POST);
                    $query = $this->db->query($sql);

                    if(!$query){
                        echo "Hubo un error al insertar, verifica tus datos";
                        return;
                    }else{

                        $id = $this->db->insert_id;
                        $sql = $this->dbo->select("llamada","folio={$_POST['folio']}");
                        $query = $this->db->query($sql);
                        $row = $this->util->queryArray($query);
                    }

                }else{
                    $id = $row[0]['id'];
                    $sql = $this->dbo->update("llamada",$_POST,$id);
                    $query = $this->db->query($sql);

                    $sql = $this->dbo->select("llamada","folio={$_POST['folio']}");
                    $query = $this->db->query($sql);
                    $row = $this->util->queryArray($query);


                    if(!$query){
                        echo "Hubo un error al insertar, verifica tus datos";
                        return;
                    }

                }

                $sql = $this->dbo->select("motivo","id={$row[0]['id_motivo']}");
                $query = $this->db->query($sql);
                $table_form = $this->util->queryArray($query);
                $table = $table_form[0]['tabla'];
                $title = $table_form[0]['nombre'];

                $preselected = array();
                $preselected['id_llamada'] = $id;
                $this->createGenericForm($table,$id,"preselected",$preselected," Insertar " . $title,"","insert");

            }
        }


        /*
         * FIN CALLCENTER
         * */

    }