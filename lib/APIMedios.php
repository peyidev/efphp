<?php

require_once 'Configuracion.php';

class MyAPI extends API
{
    protected $User;
    protected $db;
    protected $util;
    protected $dbo;
    protected $user;
    protected $responseData;

    public function __construct($request, $origin)
    {
        parent::__construct($request);
        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();
        $this->responseData = array();

    }


    public function getZona($zona){

        $sql = $this->dbo->select('zona',"id = '{$zona}'");
        $query = $this->db->query($sql);
        $data = $this->util->queryArray($query);

        if(!empty($data))
            return $data[0]['id'];

    }

    public function comidas(){

        $sql = $this->dbo->select('especialidad',"nombre='Comida'");
        $query = $this->db->query($sql);
        $data = $this->util->queryArray($query);

        $id = $data[0]['id'];
        $sql = $this->dbo->select('marca_especialidad',"id_especialidad={$id} GROUP BY valor");

        return $this->requestSimple('marca_especialidad',$sql);

    }

    public function especialidades(){

        $sql = $this->dbo->select('especialidad');
        return $this->requestSimple('especialidad',$sql);

    }

    public function establecimientosIds(){

        $sql = $this->dbo->select('marca','','id,nombre');
        return $this->requestSimple('marca',$sql);

    }

    public function establecimientos(){

        $zona = $this->util->limpiar(!empty($_GET['zona']) ? $_GET['zona'] : "");
        $comida = $this->util->limpiar(!empty($_GET['comida']) ? $_GET['comida'] : "");
        $precio = $this->util->limpiar(!empty($_GET['precio']) ? $_GET['precio'] : "");
        $nombre = $this->util->limpiar(!empty($_GET['nombre']) ? $_GET['nombre'] : "");

        $where = "WHERE 1=1";

        if(!empty($zona)){
            $zona = " JOIN zona AS z
                        ON (z.id = s.id_zona AND z.id = '{$zona}')";
        }


        if(!empty($comida)){
            $comida = " JOIN marca_especialidad AS me
                        ON (m.id = me.id_marca AND me.valor = '{$comida}')";
        }

        if(!empty($nombre)){
            $where .= " AND m.nombre LIKE '%{$nombre}%'";
        }


        if(!empty($precio)){

            $where .= " AND m.id_precio = '{$precio}'";
        }


        $sql = "SELECT m.id
                    FROM
                      marca AS m
                      LEFT JOIN sucursal AS s
                        ON m.id = s.id_marca
                     {$zona}
                     {$comida}
                     {$where}
                        GROUP BY m.id;";


        $query = $this->db->query($sql);
        $data = $this->util->queryArray($query);


        $ids = array();

        foreach($data as $i){
            $ids[] = $i['id'];
        }

        $inQuery = implode(',',$ids);

        if(!empty($inQuery))
            $inQuery = " marca.id IN({$inQuery}) ";
        else
            $inQuery = " marca.id IS NULL";


        if(empty($zona))
            return $this->establecimientos2($inQuery);
        else
            return $this->zonaEstablecimiento($inQuery);


    }

    public function estados(){

        $sql = $this->dbo->select('estado','','id,nombre');
        return $this->requestSimple('marca',$sql);

    }

    public function zonas(){

        $sql = $this->dbo->select('zona','','id,nombre');
        return $this->requestSimple('zona',$sql);

    }

    public function categorias(){
        $sql = $this->dbo->select('categoria','','id,nombre');
        return $this->requestSimple('categoria',$sql);

    }

    public function zonaEstablecimiento($in = ""){


       // $obj = '{"marca":{"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';
        $obj = '{"marca":{"marca_especialidad":{},"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';


        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");
        $order = $this->util->limpiar(!empty($_GET['order']) ? $_GET['order'] : "");
        $zona = $this->util->limpiar(!empty($_GET['zona']) ? $_GET['zona'] : "");

        if(!empty($zona)){
            $idZona = $this->getZona($zona);
            $deepWhere['where'] = " s.id_zona = {$idZona}";
            $deepWhere['deep'] = " id_zona = {$idZona}";
            $deepWhere['join'] = "";

        }else{
            $deepWhere['where'] = "";
            $deepWhere['join'] = "";
            $deepWhere['deep'] = "";
        }


        return $this->request($obj,"","",$searchType,$count,$page,$order,$deepWhere,$in);


    }

    public function establecimientos2($in = ""){

        $obj = '{"marca":{"marca_especialidad":{},"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';

        $column = $this->util->limpiar(!empty($_GET['column']) ? $_GET['column'] : "");
        $query = $this->util->limpiar(!empty($_GET['query']) ? $_GET['query'] : "");
        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");
        $order = $this->util->limpiar(!empty($_GET['order']) ? $_GET['order'] : "");


        return $this->request($obj,$column,$query,$searchType,$count,$page,$order,"",$in);


    }

    private function requestSimple($table,$sql){


        $res = array();

        //$id = $param1[1];

        $res['status'] = "ok";


        $query = $this->db->query($sql);


        $cuantos = $this->dbo->countRows();
        $cuantos = $this->db->query($cuantos);
        $cuantosTotal = $this->util->queryArray($cuantos);
        $cuantosTotal = $cuantosTotal[0]['howmany'];

        $res['count'] = $cuantosTotal;

        $data = $this->util->queryArray($query);

        foreach($data as $k => $v){

            $res[$table][] = $v;

        }



        return $res;

    }

    private function request($obj, $column = "", $cond = "", $type = "", $howmany = "", $page = "", $order = "",$deepWhere = "",$in = "",$fields = "") {

        $obj        = json_decode($obj);
        $type       = ($type == "k") ? "LIKE" : "=";
        $where      = "";
        $join_ = "";

        if(!empty($column)){
            if($type == "LIKE"){
                $where = "{$column} {$type} '%{$cond}%'";
            }else{
                $where = "{$column} {$type} '{$cond}'";
            }
        }

        if(!empty($deepWhere['where'])){
            $join_ = $deepWhere['join'];
        }


        if(!empty($in)){

            if(!empty($where)){

                $where.= " AND {$in}";

            }else{

                $where.= $in;

            }


        }


        if(!empty($howmany)){
            if(!empty($page)){
                $page = $howmany * ($page - 1);
            }else{
                $page = 0;
            }
        }

        $obj = $this->object_to_array($obj);
        $res = array();

        //$id = $param1[1];

        $res['status'] = "ok";

        foreach($obj as $key => $val){

            $this->responseData[$key] = "id_" . $key;


            if(empty($fields))
                $fields = $key.".*";

            $sql = $this->dbo->select($key . $join_,"$where",$fields,$order,$howmany,$page);
            $query = $this->db->query($sql);


            $cuantos = $this->dbo->countRows();
            $cuantos = $this->db->query($cuantos);
            $cuantosTotal = $this->util->queryArray($cuantos);
            $cuantosTotal = $cuantosTotal[0]['howmany'];

            $res['count'] = $cuantosTotal;

            $data = $this->util->queryArray($query);

            foreach($data as $k => $v){

                $res[$key][] = $this->recursiveData($val,$key,$v,$deepWhere);

            }
        }


        return $res;

    }

    protected function recursiveData($structure,$k,$d,$deepWhere=""){

        foreach($structure as $key => $val){

            if(empty($val)){
                $id = $d['id'];
                $kk = "id_" . $k;
                $where = "";
                if(!empty($deepWhere)){
                    $where = " AND " . $deepWhere['deep'];
                }
                $sql = $this->dbo->select($key,"{$kk}=$id");
                $query = $this->db->query($sql);
                $data = $this->util->queryArray($query);
                foreach($data as $l => $w){
                    if (is_array($w)) {
                        foreach ($w as $_k => $_w) {
                            $foreign = explode("id_", $_k);
                            if (count($foreign) > 1) {
                                if ($this->dbo->tableExist($foreign[1])) {

                                    if(!empty($deepWhere)){
                                        $where = " AND " . $deepWhere['deep'];
                                    }

                                    $s = $this->dbo->select($foreign[1], "id={$w[$_k]} {$where}");
                                    $q = $this->db->query($s);
                                    $add = $this->util->queryArray($q);

                                    if (!empty($add) && !in_array($_k,$this->responseData)){
                                        $w[$_k] = $add;
                                    }

                                }
                            }
                        }
                    }

                    $d[$key][] = $w;
                }
                continue;
            }else{
                $id = $d['id'];
                $kk = "id_" . $k;
                $where = "";
                if(!empty($deepWhere)){
                    $where = " AND " . $deepWhere['deep'];
                }

                $sql = $this->dbo->select($key,"{$kk}=$id {$where}");
                $query = $this->db->query($sql);
                $data = $this->util->queryArray($query);
                foreach($data as $l => $w){
                    //$d[$k][$key][] = $this->recursiveData($val,$key,$w);
                    $d[$key][] = $this->recursiveData($val,$key,$w);
                }
            }
        }

        return $this->convertDataForeign($d);

    }

    public function convertDataForeign($data){


        foreach($data as $key => $val){

            $foreign = explode("id_", $key);
            if (count($foreign) > 1) {
                if ($this->dbo->tableExist($foreign[1])) {
                    $s = $this->dbo->select($foreign[1], "id={$data[$key]}");
                    $q = $this->db->query($s);
                    $add = $this->util->queryArray($q);

                    if (!empty($add) && !in_array($key,$this->responseData)){
                        $data[$key] = $add;
                    }

                }
            }


        }

        return $data;

    }

    public function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        }
        else $new = $obj;
        return $new;
    }


}


if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
