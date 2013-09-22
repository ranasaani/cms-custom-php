<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/categories.php');
$obj = new Category();
$task = $_REQUEST['task'];
switch ($task) {
	case 'save_record':
		ob_start();
			$params = array('cat_name' => $_POST['cat_name'],'id' => $_POST['id'],'cat_description' => $_POST['cat_description']);
			$obj->map($params);
			$response=$obj->manageRecord();
			if($response){
			header("location:../cms/categories.php");
	}else{
		     header("location:../cms/categories_m.php");
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