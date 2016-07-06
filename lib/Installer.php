<?php
/*Archivo inicial*/
try{

    require_once(realpath("Configuracion.php"));
    $installer = new Installer();
    $installer->run();

}catch(Exception $e){

    echo $e->getMessage(), "\n";

}


class Installer{


    protected $db;
    protected $util;
    protected $dbo;


    public function __construct(){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();

    }

    public function run(){

        $sql = "ALTER TABLE sucursal
                  ADD reservacion_restorando VARCHAR(500);";
        $this->db->query($sql);


        $sql = "ALTER TABLE sucursal
                  ADD reservacion_restaurantes VARCHAR(500);";
        $this->db->query($sql);

        echo "Actualizado correctamente";

    }

}