<?php

class Frontend{

    public $module;
    public $db;
    public $util;
    public $dbo;
    public $user;
    public $mail;
    public $customColumns;

    function __construct($module){

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();
        $this->mail = new Email();

    }



    function saveContact($type){

        $type = $this->util->limpiarParams($type);
        $sql = $this->dbo->select('mailtype',"nombre = '{$type}'");
        $query = $this->db->query($sql);
        @$typeId = $this->util->queryArray($query)[0]['id'];
        @$title = $this->util->queryArray($query)[0]['nombre'];
        $mFront = new Messages();

        if(empty($typeId)){
//            $mFront->setMessage("error:" . "Cant send form, verify your data");
            $mFront->setMessage("error:" .
                                "We are currently experiencing technical difficulties with our automatic showing requests.<br>" .
                                "<span>Please call our office at <strong>(217) 337-8852</strong> <br>or<br> </span>" .
                                "<span>Email us at <strong>contact@mhmproperties.com</strong> with your showing requests </span>" .
                                "<span>(please include Building, How many bedrooms, Desired day/time &amp; Contact phone number). </span>"
                                );
            return;
        }

        $form = $_POST;
        $message = $this->util->sanitizeForm($type,serialize($form));
        $save = array();
        $save['id_mailtype'] = $typeId;
        $save['message'] = $message['content'];

        $sql = $this->dbo->insert('mail',$save);
        $this->db->query($sql);


        //$title = $save['title'];
        $this->mail->sendMail($title,$form);

        $mFront->setMessage("message:" . "Thank you. <br>Your Request has been sent to our staff. <br>For faster service please call our office hotline at <strong>(217) 337-8852</strong>.");
        return;
    }

}