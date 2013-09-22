<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/settings.php');
$obj = new Settings();
$task = $_REQUEST['task'];
switch ($task) {
	case 'save_record':
		ob_start();
			$params = array('option_name' => $_POST['option_name'],'id' => @$_POST['id'],'value' => $_POST['value']);
			$obj->map($params);
			$response=$obj->manageRecord();
			if($response){
			header("location:../cms/settings.php");
	}else{
		     header("location:../cms/settings.php?m=error");
		}
	ob_get_clean();
	break;
	case 'save_image':
		ob_start();
			$params = array('option_name' => $_POST['option_name'],'id' => @$_POST['id'],'value' => $_FILES['value']['name'], 'is_image'=>1);
			$obj->map($params);
			$response=$obj->manageRecord();
			if($response){
			header("location:../cms/settings.php");
	}else{
		     header("location:../cms/settings.php?m=error");
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
} 
?>