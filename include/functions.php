<?php
function validate_email($email) {

	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
	
}// end function


//==========SANITIZING INPUT==============================//

function sanitize($input) {
      if (is_array($input)) {
	            foreach($input as $var=>$val) 
				{ 
				 $output[$var] = sanitize($val);          
				}      
		}
		else
		 {
		         if (get_magic_quotes_gpc()) 
				 {
				 $input = stripslashes($input);
				 }
				 $input  = cleanInput($input);
				 $output = mysql_real_escape_string($input);
		}
		return $output;
 } 


 function cleanInput($input) {      
 $search = array('@<script[^>]*?>.*?</script>@si',   // Strip out javascript      
 '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags      
 '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly      
 '@<![\s\S]*?--[ \t\n\r]*>@');         // Strip multi-line comments           
 $output = preg_replace($search, '', $input);
  return $output;
  } 
  

//========================================// 

function send_smtp_email($records){

global $SMTP_CONFIG;

	try{				
			require_once('../PHPMailer_v5.1/class.phpmailer.php');
			$mail = new PHPMailer(true);	
			
			$to = $records["to"];		
			$mail->AddAddress($to);

			$mail->Subject  = $records["subject"];
			$message = $records["message"];
								
			$mail->IsSMTP();                           // tell the class to use SMTP
			
			$mail->SMTPAuth   = $SMTP_CONFIG['auth'] ;                  // enable SMTP authentication
			$mail->Port       = $SMTP_CONFIG['port'];  
			$mail->Host       = $SMTP_CONFIG['host'] ; 
			$mail->Username   = $SMTP_CONFIG['smtp_user'];  //  username
			$mail->Password   = $SMTP_CONFIG['smtp_password'];   
			$mail->FromName   = $SMTP_CONFIG['from_name'];
			$mail->AddReplyTo($SMTP_CONFIG['from_email'],$SMTP_CONFIG['from_email']);		
			$mail->From       = $SMTP_CONFIG['from_email'];	
			$mail->AddCC      = $SMTP_CONFIG['ADMIN_EMAIL'];
			
			$mail->SMTPSecure=$SMTP_CONFIG['smtp_secure'];
			$mail->MsgHTML($message);
			$mail->IsHTML(true); // send as HTML				
			
			$mail->Send();

		}
		 catch(Error $e) {
			 return false;
	  }
	  
}// end function

function send_smtp_email_customized($records){

global $SMTP_CONFIG;

	try{				
			require_once('../PHPMailer_v5.1/class.phpmailer.php');
			
			$mail = new PHPMailer(true);	
			
			$to = $records["to"];		
			$mail->AddAddress($to);

			$mail->Subject  = $records["subject"];
			$message = $records["message"];
			$mail->From       = $records["from_email"];
			$mail->FromName   = $records["from_name"];
			
								
			$mail->IsSMTP();                           // tell the class to use SMTP
			
			$mail->SMTPAuth   = $SMTP_CONFIG['auth'] ;                  // enable SMTP authentication
			$mail->Port       = $SMTP_CONFIG['port'];  
			$mail->Host       = $SMTP_CONFIG['host'] ; 
			$mail->Username   = $SMTP_CONFIG['smtp_user'];  //  username
			$mail->Password   = $SMTP_CONFIG['smtp_password'];   
			$mail->AddReplyTo($SMTP_CONFIG['from_email'],$SMTP_CONFIG['from_email']);		
			$mail->AddCC      = $SMTP_CONFIG['ADMIN_EMAIL'];
			$mail->SMTPSecure=$SMTP_CONFIG['smtp_secure'];
			$mail->MsgHTML($message);
			$mail->IsHTML(true); // send as HTML				
			
			$mail->Send();

		}
		 catch(Error $e) {
			 return false;
	  }
	  
}// end function
?>