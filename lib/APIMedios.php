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

    /**
     * $param1[0] = estructura de petición
     * $param1[1] = columna a buscar
     * $param1[2] = valor a buscar
     * $param1[3] = operador de búsqueda [k:LIKE, q:'=']
     * $param1[4] = Cuantos por página
     * $param1[5] = Página
     */
    protected function request($param1) {


        $obj        = json_decode($param1[0]);
        $column     = !empty($param1[1]) ?  $param1[1] : "";
        $cond       = !empty($param1[2]) ?  $param1[2] : "";
        $type       = !empty($param1[3]) ?  $param1[3] : "";
        $type       = ($type == "k") ? "LIKE" : "=";

        $howmany    = !empty($param1[4]) ?  $param1[4] : "";
        $page       = !empty($param1[5]) ?  $param1[5] : "";
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


        foreach($obj as $key => $val){
            $sql = $this->dbo->select($key,"$where","*","",$howmany,$page);
            $query = $this->db->query($sql);
            $data = $this->util->queryArray($query);

            foreach($data as $k => $v){
                $res[$key][] = $this->recursiveData($val,$key,$v);

            }

        }

        //print_r($res);
        die;
        return (json_encode($res));



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