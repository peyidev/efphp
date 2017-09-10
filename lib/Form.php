<?php



    class Form{

        public $db;
        public $util;
        public $dbo;
        public $user;

        function __construct(){

            $this->db = Database::connect();
            $this->util = new Utils();
            $this->dbo = new Dbo();
            $this->user = new User();

        }

        public function send(){

            if(!empty($_POST)){

                $sql = $this->dbo->insert('mail',$_POST);
                $this->db->query($sql);
            }

        }

    }