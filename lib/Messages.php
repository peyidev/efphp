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


        function messageBody($top = true, $type = 'alert-info', $icon = 'pe-7s-info', $title = 'Importante'){


            if($top)
                return "<div class='alert {$type} alert-dismissable'>
							<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
							<div class='media'>
								<figure class='pull-left alert--icon'>
									<i class='{$icon}'></i>
								</figure>
								<div class='media-body'>
									<h3 class='alert--title'>{$title}</h3>
									<p class='alert--text'>";


            else
                return "</p></div></div></div>";
        }

        function getError($msg){

            $final = $this->messageBody(true,"alert-danger","pe-7s-close-circle","Hubo un error");

            switch($msg){

                case "1":
                    $final.= "Error desconocido";
                    break;

                default:
                    $final.= $msg;
                    break;

            }

            $final .= $this->messageBody(false);
            return $final;

        }

        function getMsj($msg){
            $final = $this->messageBody(true,"alert-info","pe-7s-info","Importante");

            switch($msg){

                case "1":
                    $final.= "Operación realizada correctamente";
                    break;

                default:
                    $final.= $msg;
                    break;

            }

            $final .= $this->messageBody(false);
            return $final;

        }


    }