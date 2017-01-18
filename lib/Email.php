<?php

require_once __DIR__.'/phpmailer/PHPMailerAutoload.php';

class Email{


        function test(){
            $emailSettings = array();
            $emailSettings['from-name'] = 'Test';
            $emailSettings['from-email'] = 'peyi.god@gmail.com';
            $emailSettings['message'] = 'test';
            $emailSettings['subject'] = "my test";
            $this->sendEmail($emailSettings);

        }

        function sendEmail($emailSettings){

        $smtp_server = 'smtp.gmail.com';
        $smtp_port = 587;
        $smtp_username = 'mhm-website-email@mhmproperties.com';
        $smtp_password = 'Ch@mp@ign2016';

//        $to_emails = ['Web Request'       => 'webrequest@mhmproperties.com',
//                      'Contact'           => 'contact@mhmproperties.com',
//                      'Farzad Moeinzadeh' => 'farzad@mhmproperties.com',
//                      'Management'        => 'management@mhmproperties.com'];
          $to_emails =['Web Request' => 'pablo@silverip.com','Farzad Moeinzadeh' => 'farzad@mhmproperties.com'];

            require_once(__DIR__.'/phpmailer/class.pop3.php');
            require_once(__DIR__.'/phpmailer/class.phpmailer.php');
            require_once(__DIR__.'/phpmailer/class.smtp.php');

            $mail = new PHPMailer();

        $from_name  = $emailSettings['from-name'];
        $from_email = $emailSettings['from-email'];
        $message    = $emailSettings['message'];
        $subject    = $emailSettings['subject'];

        // Configuring SMTP server settings
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $smtp_server;
        $mail->Port = $smtp_port;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;

        // Email Sending Details
        $mail->setFrom($from_email, $from_name);
        $mail->addReplyTo($from_email, $from_name);
        foreach($to_emails as $to_name => $to_email){
            $mail->addAddress($to_email, $to_name);
        }

        $mail->Subject = $subject;
        $mail->msgHTML($message);


        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';


        // Success or Failure
        if (!$mail->send()) {
            error_log('email-sender.php::sendEmail(): Mailer Error: ' . $mail->ErrorInfo);
            return false;
        }
        else {
            error_log('email-sender.php::sendEmail(): Email request from '.$from_email .' <' . $from_name . '> was sent successfully');
            return true;
        }
    }


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

    }


    function setMailTemplate($message){

        $template = "<div>{$message}</div>";
        return $template;
    }



}