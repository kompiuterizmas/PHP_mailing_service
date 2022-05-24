<?php
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Headers : POST');
date_default_timezone_set('Europe/Vilnius');
// receiving DATA
$entityBody = file_get_contents('php://input');
if(!empty($entityBody)){
    // converting DATA from JSON object
    $obj = json_decode($entityBody, true);

    // checking DATA for manufacturing if needed
    // print_r($obj);

    // distributing DATA to variables
    $name=$obj['name'];
    $email=$obj['email'];
    // PHP_EOL - means "PHP end of line", used to format message
    $message = $obj['phone'].PHP_EOL.$obj['comment'].PHP_EOL.$obj['data'].PHP_EOL;

    // setting receiver of message
    $to = 'owner@mail.com';

    // setting mail subject
    $subject = 'This mail is from website, sent on date: '.date('Y-m-d H:i');

    // setting Headers for mail
    $headers = "From: person ".$name." and/or email - ".$email."\r\n";
    $headers .= "Reply-To: ".$email."\r\n";
    $headers .= "Content-type: text/plain;charset=utf-8\r\n";

    // sending mail
    mail($to, $subject, $message, $headers);

    // setting log file for all mails sent
    $fp = fopen("mails_log.txt","a+");
    fwrite($fp,$name.PHP_EOL.$email.PHP_EOL.$subject.PHP_EOL.$message.PHP_EOL);
    fclose($fp);

    // below you can set desired response to POST data sender
    // echo $subject;
    // or
    // echo $message;
    // or
    // echo $obj['data'];
    // or anything else
    // echo "Anything else for response";
}
