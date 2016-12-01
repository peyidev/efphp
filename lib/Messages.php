<?php
    class Messages{

        function initMessages(){
            $_SESSION['message'] = "";
        }

        function getMessage(){
            return $_SESSION['message'];
        }

        function setMessage($message){
            $_SESSION['message'] = $message;
        }


        function parseMessage($message){

            $message = explode(":",$message);


            if(count($message) <= 1)
                return false;

            $type = $message[0];
            $msg = $message[1];

            switch($type){

                case "error":
                    return $this->getError($msg);
                    break;
                case "message":
                    return $this->getMsj($msg);
                    break;

            }

        }

        function getError($msg){

            $final = "<p class='message-popup message-error'>";

            switch($msg){

                case "1":
                    $final.= "Error desconocido";
                    break;

                default:
                    $final.= $msg;
                    break;

            }

            $final .= "</p>";
            return $final;

        }

        function getMsj($msg){
            $final = "<p class='message-popup message-message'>";

            switch($msg){

                case "1":
                    $final.= "Action Success!";
                    break;

                default:
                    $final.= $msg;
                    break;

            }

            $final .= "</p>";
            return $final;

        }


    }