<?php //(isset($_REQUEST['task'])) ? $_REQUEST['task'] : die('Not Direct access');
require_once('../../common/config.php');
require_once '../../common/db_connect.php';
require_once('../model/post.php');
$obj = new Post();
$task = $_REQUEST['task'];
switch ($task) {
	case 'save_record':
		ob_start();
		session_start();
			$params = array('post_name' => $_POST['post_name'],'id' => $_POST['id'],
            'post_status' => $_POST['post_status'],'comment_status' => $_POST['comment_status'],
            'post_type' => $_POST['post_type'],'is_featured' => $_POST['is_featured'],
            'post_content' => $_POST['post_content'],'author' => $_SESSION['user']['id'],
            'cat_id' => @$_POST['cat_id'],'post_parent_id' => @$_POST['post_parent_id'],'is_parent' => @$_POST['is_parent']);
			$obj->map($params);
			$response=$obj->manageRecord();
            
			if($response){
			 
                    if(isset($_POST['post_parent_id']) && $_POST['post_parent_id']!=0){
                        header("location:../cms/post_m.php?type=".$_POST['post_type']."&post_parent_id=".$_POST['post_parent_id']);
                     }
                     else{
			            header("location:../cms/post.php?type=".$_POST['post_type']);
	                  }
              
              }else{
                        if(isset($_POST['post_parent_id']) && $_POST['post_parent_id']!=0){
                          header("location:../cms/post_m.php?type=".$_POST['post_type']."&post_parent_id=".$_POST['post_parent_id']);
                        }
                          else{
			              header("location:../cms/post_m.php?type=".$_POST['post_type']);
	                    }
    
		    }
	ob_get_clean();
	break;
	
   case 'delete_record':
	$params = array('id'=> $_POST['id']);
	$obj->map($params);
	$response_data=$obj->delete();
     
     $child_records=$obj->get_all_child_records();
           if(!empty($child_records)){
                   
                    foreach($child_records as $data){
                      $params1 = array('id'=> $data['post_child_id']);
                 	$obj->map($params1);
                	$obj->delete();
                        }//loop
            
            
            
           }//if there is some child post
   
           
	$response=json_encode($response_data);
	echo $response;
	break;
    
       case 'delete_child_record':
	$params = array('id'=> $_POST['id']);
	$obj->map($params);
	$response_data=$obj->delete();
           
	$response=json_encode($response_data);
	echo $response;
	break;
    
	default:  
   
	
    
	
	
	
	        /*echo '<pre>';
			print_r($params);
			exit;*/
} 
?>