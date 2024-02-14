<?php

//error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer; 
$mail->isHTML(true);
$mail->Host = 'localhost';
$mail->Port = 25;
//$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom('smtp@nileprojects.in', 'University PMO');

$mail->addAddress($_POST['to_mail'], $_POST['to_mail']);
$mail->Subject = $_POST['subject'] ?? 'University PMO';
$mail->Body = $_POST['body'] ?? 'University PMO';
if(!$mail->send()) {
	echo json_encode(array('flag' => false, 'message'=>"Error :- ".$mail->ErrorInfo ));
	die;
}else{
	echo json_encode(array('flag' => true, 'message'=>"Mail sended successfully."));
	die;
}
