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


    public function estados(){

        $obj = '{"estado":{}}';

        $column = $this->util->limpiar(!empty($_GET['column']) ? $_GET['column'] : "");
        $query = $this->util->limpiar(!empty($_GET['query']) ? $_GET['query'] : "");
        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");

        return $this->request($obj,$column,$query,$searchType,$count,$page);

    }

    public function zonas(){

        $obj = '{"zona":{}}';

        $column = $this->util->limpiar(!empty($_GET['column']) ? $_GET['column'] : "");
        $query = $this->util->limpiar(!empty($_GET['query']) ? $_GET['query'] : "");
        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");

        return $this->request($obj,$column,$query,$searchType,$count,$page);

    }


    public function categorias(){

        $obj = '{"categoria":{}}';

        $column = $this->util->limpiar(!empty($_GET['column']) ? $_GET['column'] : "");
        $query = $this->util->limpiar(!empty($_GET['query']) ? $_GET['query'] : "");
        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");


        return $this->request($obj,$column,$query,$searchType,$count,$page);


    }

    public function zonaEstablecimiento(){

        $obj = '{"marca":{"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';


        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");
        $order = $this->util->limpiar(!empty($_GET['order']) ? $_GET['order'] : "");
        $zona = $this->util->limpiar(!empty($_GET['zona']) ? $_GET['zona'] : "");

        if(!empty($zona)){
            $deepWhere['where'] = " s.id_zona = {$zona}";
            $deepWhere['deep'] = " id_zona = {$zona}";
            $deepWhere['join'] = " JOIN sucursal as s ON s.id_marca = marca.id JOIN zona as z ON z.id = s.id_zona";

        }else{
            $deepWhere['where'] = "";
            $deepWhere['join'] = "";
            $deepWhere['deep'] = "";
        }




        return $this->request($obj,"","",$searchType,$count,$page,$order,$deepWhere);


    }

    public function establecimientos(){

        $obj = '{"marca":{"marca_especialidad":{},"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';

        $column = $this->util->limpiar(!empty($_GET['column']) ? $_GET['column'] : "");
        $query = $this->util->limpiar(!empty($_GET['query']) ? $_GET['query'] : "");
        $searchType = $this->util->limpiar(!empty($_GET['search']) ? $_GET['search'] : "");
        $count = $this->util->limpiar(!empty($_GET['count']) ? $_GET['count'] : "");
        $page = $this->util->limpiar(!empty($_GET['page']) ? $_GET['page'] : "");
        $order = $this->util->limpiar(!empty($_GET['order']) ? $_GET['order'] : "");



        return $this->request($obj,$column,$query,$searchType,$count,$page,$order);


    }

    /**
     * $param1[0] = estructura de petición
     * $param1[1] = columna a buscar
     * $param1[2] = valor a buscar
     * $param1[3] = operador de búsqueda [k:LIKE, q:'=']
     * $param1[4] = Cuantos por página
     * $param1[5] = Página
     */
    private function request($obj, $column = "", $cond = "", $type = "", $howmany = "", $page = "", $order = "",$deepWhere = "") {

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
            $where .= $deepWhere['where'];
            $join_ = $deepWhere['join'];
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
            $sql = $this->dbo->select($key . $join_,"$where",$key.".*",$order,$howmany,$page);
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
                                    $s = $this->dbo->select($foreign[1], "id={$w[$_k]} {$deepWhere}");
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


    function convertDataForeign($data){


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

    function object_to_array($obj) {
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
