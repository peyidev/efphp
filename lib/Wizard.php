<?php

    class Wizard{

        public $db;
        public $util;

        function __construct(){

            $this->db = Database::connect();
            $this->util = new Utils();

        }

        function init(){

            if(!$this->util->tableExist('admin')){

                $this->createRolTable();
                $this->createAdminTable();
                $this->createBasicUsers();
                $this->createMenu();
                $this->createItemMenu();

            }

        }

        function createBasicUsers(){

            $sql = "INSERT INTO rol VALUES(null,'ADMINISTRADOR')";
            $this->db->query($sql);
            $id = $this->db->insert_id;
            $psw = md5("admin");

            $sql = "INSERT INTO admin VALUES(null,'admin@efphp.com','{$psw}',{$id},'Administrador')";
            $this->db->query($sql);

        }

        function createAdminTable(){

            $table = "CREATE TABLE `admin` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `email` varchar(255) DEFAULT NULL COMMENT 'Email-mail',
                              `password` varchar(255) DEFAULT NULL COMMENT 'Password-text',
                              `id_rol` int(11) NOT NULL COMMENT 'Rol',
                              `nombre` varchar(255) NOT NULL COMMENT 'Nombre-text',
                              PRIMARY KEY (`id`),
                              KEY `fk_id_rol` (`id_rol`),
                              CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8";

            $this->createTable($table);

        }

        function createRolTable(){

            $table = "CREATE TABLE `rol` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `nombre` varchar(255) NOT NULL,
                              PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8";

            $this->createTable($table);

        }

        function createMenu(){

            $table = "CREATE TABLE `menu` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `id_menu` int(11) DEFAULT NULL,
                          `nombre` varchar(255) DEFAULT NULL,
                          `url` varchar(255) DEFAULT NULL,
                          `posicion` int(11) DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `id_men` (`id_menu`),
                          CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8";
            $this->createTable($table);

        }

        function createItemMenu(){
            $sql = "INSERT INTO menu VALUES(null,null,'Main_Category','#',1)";
            $this->db->query($sql);
        }

        function createTable($sql){

            $query = $this->db->query($sql);
            $message = new Messages();

            if(!$query)
                $message->setMessage("error:" . "No es posible crear tu tabla");
            else
                $message->setMessage("message:1");


        }

    }