<?php
require_once('../common/config.php');


	$message =@$_POST['message'];
	$name =@$_POST['name'];
	$from =@$_POST['email'];
	$action =@$_POST['action'];
	if($action=="contactus") $to = CONTAC_US_EMAIL ;
	elseif($action=="sendrule") $to = SEND_RULE_EMAIL;
	else die('error');
	print_r($message);
	print_r($message);
	print_r($message);
	
if(!empty($name) && !empty($name)&& !empty($from)){	
	
		require_once('../PHPMailer_v5.1/class.phpmailer.php');
		
			$mail = new PHPMailer(true);	
			$mail->Subject  = $subject;
			$mail->IsSMTP();                           // tell the class to use SMTP
		    $mail->SMTPAuth   = $SMTP_CONFIG['auth'] ; // enable SMTP authentication
			$mail->Port       = $SMTP_CONFIG['port'];  
			$mail->Host       = $SMTP_CONFIG['host'] ; 
			$mail->Username   = $SMTP_CONFIG['smtp_user'];  //
			$mail->Password   = $SMTP_CONFIG['smtp_password'];   
			$mail->AddReplyTo($from);		
			$mail->From       = $from;
			$mail->FromName   = $name;
					
			$mail->MsgHTML($message);
			$mail->IsHTML(true); // send as HTML				
			$mail->SMTPSecure=$SMTP_CONFIG['smtp_secure'];


   			$mail->AddAddress($to);
		   if($mail->send());{
			   $mail->ClearAllRecipients(); 
			   header('location:../index.php?m=ssuccess');
	  		}
   	

}else die('error');




?>


<?php include"../footer.php";?>