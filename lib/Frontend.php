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

    function moveinReport(){

        $data = $_GET;
        $newData = array();
        $mFront = new Messages();

        $newData['first_name']  = $data['fname'];
        $newData['last_name']   = $data['lname'];
        $newData['location']    = $data['property_of_interest'];
        $newData['apt']         = $data['apt_number'];
        $newData['hereby_name'] = $data['hereby_name'];
        $newData['date']        = $data['date'];
        $newData['status']      = 'Submitted';
        $newData['updated_at']  = date("Y/m/d");


        unset($data['fname'],$data['lname'],$data['property_of_interest'],$data['apt_number'],$data['hereby_name'],$data['date'],$data['e'],$data['rand']);

        $newData['request_condition'] = json_encode($this->fixDataArray($data));

        $sql = $this->dbo->insert('movein_report',$newData);
        $this->db->query($sql);

        $mFront->setMessage("message:" . "Thank you. <br>Your Request has been sent to our staff. <br>For faster service please call our office hotline at <strong>(217) 337-8852</strong>.");
        return;
    }
    private function fixDataArray($data){
        $newDataArray = array();
        foreach($data as $x => $item)
        {
            $indexLabel = explode('-txt', $x);

            if(count($indexLabel) == 1)
                $newDataArray[$indexLabel[0]]['checkbox'] = $item;
            else
                $newDataArray[$indexLabel[0]]['info'] = $item;
        }

        return $newDataArray;
    }

}