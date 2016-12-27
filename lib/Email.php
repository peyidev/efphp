<?php

class Email{

    function getRealIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function getUserAgent(){
        return $_SERVER['HTTP_USER_AGENT'];
    }


    function sendMail($title,$content){

        $message = '';

        if(is_array($content)){

            $ip = $this->getRealIp();
            $userAgent = $this->getUserAgent();

            $message = "<table>";

            $message .= "<tr><td>USER IP</td><td>{$ip}</td></tr>";
            $message .= "<tr><td>USERAGENT</td><td>{$userAgent}</td></tr>";

            foreach($content as $key => $val){

                $message .= "<tr><td>$key</td><td>$val</td></tr>";

            }

            $message .= "</table>";
        }else{

            $message = $content;

        }


        $message = $this->setMailTemplate($message);

        $to = EMAIL_SENDERS;
        $from = EMAIL_FROM;
        $subject = $title;

        $headers = "From: {$from}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }

    }


    function setMailTemplate($message){

        $template = "<div>{$message}</div>";
        return $template;
    }



}