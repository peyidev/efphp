<?php

require_once 'Configuracion.php';

class MyAPI extends API
{
    protected $User;
    protected $db;
    protected $util;
    protected $dbo;
    protected $user;

    public function __construct($request, $origin)
    {
        parent::__construct($request);
        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();

    }

    public function establecimientos(){

        $obj = '{"marca":{"marca_especialidad":{},"sucursal":{"promocion":{},"servicio_sucursal":{}}}}';

        $column = $this->util->limpiar($_GET['column']);
        $query = $this->util->limpiar($_GET['query']);
        $searchType = $this->util->limpiar($_GET['search']);
        $count = $this->util->limpiar($_GET['count']);
        $page = $this->util->limpiar($_GET['page']);


        return $this->request($obj,$column,$query,$searchType,$count,$page);


    }

    /**
     * $param1[0] = estructura de petición
     * $param1[1] = columna a buscar
     * $param1[2] = valor a buscar
     * $param1[3] = operador de búsqueda [k:LIKE, q:'=']
     * $param1[4] = Cuantos por página
     * $param1[5] = Página
     */
    private function request($obj, $column = "", $cond = "", $type = "", $howmany = "", $page = "") {
        
        $obj        = json_decode($obj);
        $type       = ($type == "k") ? "LIKE" : "=";
        $where      = "";

        if(!empty($column)){
            if($type == "LIKE"){
                $where = "{$column} {$type} '%{$cond}%'";
            }else{
                $where = "{$column} {$type} '{$cond}'";
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
            $sql = $this->dbo->select($key,"$where","*","",$howmany,$page);
            $query = $this->db->query($sql);


            $cuantos = $this->dbo->countRows();
            $cuantos = $this->db->query($cuantos);
            $cuantosTotal = $this->util->queryArray($cuantos);
            $cuantosTotal = $cuantosTotal[0]['howmany'];

            $res['count'] = $cuantosTotal;

            $data = $this->util->queryArray($query);

            foreach($data as $k => $v){
                $res[$key][] = $this->recursiveData($val,$key,$v);

            }
        }

        return $res;

    }



    protected function recursiveData($structure,$k,$d){


        foreach($structure as $key => $val){

            if(empty($val)){
                $id = $d['id'];
                $kk = "id_" . $k;
                $sql = $this->dbo->select($key,"{$kk}=$id");
                $query = $this->db->query($sql);
                $data = $this->util->queryArray($query);
                foreach($data as $l => $w){
                    $d[$key][] = $w;
                }
                continue;
            }else{
                $id = $d['id'];
                $kk = "id_" . $k;
                $sql = $this->dbo->select($key,"{$kk}=$id");
                $query = $this->db->query($sql);
                $data = $this->util->queryArray($query);
                foreach($data as $l => $w){
                    //$d[$k][$key][] = $this->recursiveData($val,$key,$w);
                    $d[$key][] = $this->recursiveData($val,$key,$w);
                }
            }
        }
        return $d;

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
