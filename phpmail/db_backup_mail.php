<?php


$toemail='jahidur.rahman@viyellatexgroup.com' ;
$toname='Group service desk';
$fromemail='jahidur.rahman@viyellatexgroup.com';




	if($_GET['files'])
{
$attach=$_GET['files'];
$attach="../backup/backup/" . $attach . '.sql';
$fromname='VIYELLATEX database';
$mail->Subject    = "VIYELLATEX GROUP SERVICE DESK Database";
}

	if($_GET['filez'])
{
$attach=$_GET['filez'];
$attach="../backup/backup/" . $attach;
$fromname='VIYELLATEX project';
$mail->Subject    = "VIYELLATEX GROUP SERVICE DESK project";
}

//$attach='images/phpmailer.gif';

include_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();
$body             = $mail->getFile('contents.php');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.viyellatexgroup.com"; // SMTP server

$mail->From       = "$fromemail";
$mail->FromName   = "$fromname";



$mail->AltBody    = "."; // optional, comment out and test

//To view the message, please use an HTML compatible email viewer!

$mail->MsgHTML($body);

$mail->AddAddress("$toemail", "$toname");

$mail->AddAttachment($attach);             // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
