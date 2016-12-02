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
        $mFront = new Messages();

        if(empty($typeId)){
            $mFront->setMessage("error:" . "Cant send form, verify your data");
            return;
        }

        $form = $_POST;
        $message = $this->util->sanitizeForm($type,serialize($form));
        $save = array();
        $save['id_mailtype'] = $typeId;
        $save['message'] = $message['content'];

        $sql = $this->dbo->insert('mail',$save);
        $this->db->query($sql);


        $title = $save['title'];
        $this->mail->sendMail($title,$form);

        $mFront->setMessage("message:" . "Thank you");
        return;
    }

}