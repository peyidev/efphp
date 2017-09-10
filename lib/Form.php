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
                $this->mailForm($_POST);
                $this->db->query($sql);
                $message = new Messages();
                $cms = new Cms();
                $message->setMessage("enviado");
            }

        }

        public function mailForm($data){

            $to = 'info@exaktgas.com, peyi.god@gmail.com';
            $subject = 'Contacto Formulario Exakt';

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


            $message = "<div><strong>Nombre:</strong></div>";
            $message .= "<p>{$data['nombre']}</p>";

            $message .= "<div><strong>Mail:</strong></div>";
            $message .= "<p>{$data['mail']}</p>";

            $message .= "<div><strong>Mensaje:</strong></div>";
            $message .= "<p>{$data['mensaje']}</p>";

            mail($to, $subject, $message, $headers);

        }

    }