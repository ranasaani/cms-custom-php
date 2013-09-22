<?php 
	session_start();
	if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
	}else{
		header("Location:../login.php?next=admin");
	}
	if(isset($_GET['action']) && $_GET['action']=="logout"){
		session_destroy();
		header("Location:../index.php");
	}

?>
