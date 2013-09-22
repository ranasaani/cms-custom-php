<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/menus.php');
$obj = new Menus();
$task = $_REQUEST['task'];
switch ($task) {
	case 'save_record':
		ob_start();
			$params = array(
				'id' => $_POST['id'],
				'link_name' => $_POST['link_name'],
				'link_url' => $_POST['link_url'],
				'link_type' => $_POST['link_type'],
				'order' => $_POST['order'],
				'link_description' => $_POST['link_description']);
				
			$obj->map($params);
			$response=$obj->manageRecord();
			if($response){
			header("location:../cms/menus.php");
	}else{
		     header("location:../cms/menus.php");
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