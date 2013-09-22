<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/subscribers.php');
$obj = new Subscriber();
$task = @$_REQUEST['task'];
switch ($task) {
	case 'save_record':
			ob_start();
			$next = "../../index.php";
			if( isset($_POST['next']) &&  $_POST['next']!=''){$next=$_POST['next'];}
			if( isset($_POST['email']) &&  $_POST['email']!=''){
				if(validate_email($_POST['email'])){
					$params = array('email' => $_POST['email'],'id' => @$_POST['id']);
					$obj->map($params);
					$response=$obj->manageRecord();
					if($response['m']=='exist'){
						header("location:$next?m=exist");
					}elseif($response['m']=='success'){
						header("location:$next?m=success");
					}else{
						header("location:$next?m=not_added");
					}
				}else{
					header("location:$next?m=invalid");
				}
			}else{
				header("location:$next?m=invalid");
			}
	ob_get_clean();
	break;
	
   case 'delete_record':
	$params = array('id'=> $_POST['id']);
	$obj->map($params);
	$response_data=$obj->delete();
	$response=json_encode($response_data);
	echo $response;
	break;
	
	default:
	header("location:../../index.php");
} 



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


?>