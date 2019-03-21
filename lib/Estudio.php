<?php

class Estudio{

    public $db;
    public $util;
    public $dbo;

    function __construct()
    {

        $this->db = Database::connect();
        $this->dbo = new Dbo();
        $this->util = new Utils();

    }

    public function gallery(){

        $sql = $this->dbo->select('galeria','','*','orden ASC');
        $query = $this->db->query($sql);
        $data = Utils::queryArray($query);

        $response = array();

        foreach($data as $d){

            $tmpData = array();
            $tmpData['image_src'] = $d['img_banner'];
            $tmpData['name'] = $d['nombre'];
            $tmpData['property_extra'] = $d['orden'];
            $response[] = $tmpData;
        }

        echo $this->util->safe_json_encode($response);
        return;
    }

}