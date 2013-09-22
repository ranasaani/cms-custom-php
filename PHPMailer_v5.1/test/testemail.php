<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id: testemail.php,v 1.1 2010/12/20 10:10:42 sarfraz Exp $
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	//$body             = file_get_contents('contents.html');
	//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
	
	$body='This is test';
	
	$mail->IsSMTP();                           // tell the class to use SMTP
	//$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "relay-hosting.secureserver.net"; // SMTP server
	
	//$mail->Username   = "name@domain.com";     // SMTP server username
	//$mail->Password   = "password";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("no-reply@pepper.pk","no-reply@pepper.pk");

	$mail->From       = "no-reply@pepper.pk";
	$mail->FromName   = "Pepper.pk";

	$to = "sarfraz.sadiq@fiveriverstech.com";

	$mail->AddAddress($to);

	$mail->Subject  = "Pepper mailer";

	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	//$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>