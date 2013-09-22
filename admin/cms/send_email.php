<?php 
require_once("../header.php");

if(isset($_POST['message']) && $_POST['message']!=''){	
	$message =$_REQUEST['message'];
	$subject =$_REQUEST['subject'];
	if(!empty($_POST['to'])){
		
		$to_data[0]['email'] = $_POST['to'];
		
		
		}else{
			require_once('../model/subscribers.php');
			$_obj = new Subscriber();
			$to_data=$_obj->get_all_records();
		
		
	}//else


$response='';
$index=1;
require_once('../../PHPMailer_v5.1/class.phpmailer.php');
			$mail = new PHPMailer(true);	
			$mail->Subject  = $subject;
			$mail->IsSMTP();                           // tell the class to use SMTP
		    $mail->SMTPAuth   = $SMTP_CONFIG['auth'] ; // enable SMTP authentication
			$mail->Port       = $SMTP_CONFIG['port'];  
			$mail->Host       = $SMTP_CONFIG['host'] ; 
			$mail->Username   = $SMTP_CONFIG['smtp_user'];  // GMAIL username
			$mail->Password   = $SMTP_CONFIG['smtp_password'];   
			$mail->AddReplyTo($SMTP_CONFIG['from_email'],$SMTP_CONFIG['from_email']);		
			$mail->From       = $SMTP_CONFIG['from_email'];
			$mail->FromName   = $SMTP_CONFIG['from_name'];
					
			$mail->MsgHTML($message);
			$mail->IsHTML(true); // send as HTML				
			$mail->SMTPSecure=$SMTP_CONFIG['smtp_secure'];

?>
<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Send Email</a></h1>
            <div class="subheader">
				<a href="compose_email.php"><button class="button  icon-reply-1" >Compose Email</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="compose_email.php">Compose Email</a></li>
               <li class="current" ><a href="#">Send Email</a></li>
            </ul>
		</div>
 </div>
<div class="row">
        <div class="large-12 columns">
	<h2>Email Sent to following address(es)</h2>
<?php

foreach($to_data as $email){
   $mail->AddAddress($email['email']);
   print_r($mail->send());
   $mail->ClearAllRecipients(); 
   echo '<label class="label">'.$index.': '. $email['email'].'</label>';
	$index++;

}//loop
 

}//if post is set




?>
				<a href="compose_email.php"><button class="button  icon-reply-1" >Compose Email</button></a>

</div>
</div>

<?php include"../footer.php";?>