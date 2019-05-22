<?php

class SendPost
{
    public $manager_email;
    private $from_email = 'webmaster@holanto.com';
    
    function __construct($manager_email) 
    {
        $this->manager_email = $manager_email;
    }
    
    function sendEmail($to, $subject, $message)
    {
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        
        $headers = "From: ".$this->from_email."\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .='Reply-To: '. $this->manager_email . "\r\n" ;
        $headers .='X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers, "-f ".$this->from_email);
        
    }
    
}