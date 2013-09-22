<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/ads.php');
$obj = new Ads();
$task = $_REQUEST['task'];
switch ($task) {
	case 'save_record':
		ob_start();
			$params = array('code' => $_POST['code'],'id' => $_POST['id'],'status' => $_POST['status'],'position' => $_POST['position']);
			$obj->map($params);
			$response=$obj->manageRecord();
			if($response){
			header("location:../cms/ads.php");
	}else{
		     header("location:../cms/ads.php");
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