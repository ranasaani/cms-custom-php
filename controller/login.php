<?php
	require_once '../common/config.php';
	require_once '../common/db_connect.php';
	
	if(!isset($_REQUEST['action']) || $_REQUEST['action'] == ''){
		die('Access not allowed');
	}else{
		
		$action 	  = 	@$_REQUEST['action'];
		$next 		= 	@$_REQUEST['next'];
		$email 	   = 	@$_REQUEST['email'];
		$password 	= 	@$_REQUEST['password'];
		$response	= 	array('success' => false);
		$criteria 	= 	"email='$email' AND pass = '$password'";
		
		switch($action){
			case "login";
				global $db;
				$db->select(
					'id,email, name, user_type',
					'users',
					$criteria
				);
				
				$row = $db->fetch_assoc();
				if(!empty($row)){
					session_start();
					$_SESSION["user"] = $row;
					if($next==''){$next= 'admin';}
					header("Location:../".$next);
					
				}else{
					header("Location:../login.php?p=invalid");
				}
				
			break;
			case "logout":
				session_start();
				session_destroy();
				header("Location:../login.php");
			 break;
		}
		
	}
	
  
?>