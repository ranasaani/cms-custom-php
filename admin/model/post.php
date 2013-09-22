<?php 
class Post{
	private $table = 'posts';
    private $post_rules_table = 'post_rules';
	private $id;
	private $author;
	private $post_name;
	private $post_content;
	private $post_status;
	private $comment_status;
	private $post_type;
	private $is_featured;
	private $updated_at;
	private $image_name;
    private $cat_id;
    private $post_parent_id;
    private $is_parent;
      private $image_name_thumb;
    
	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
		$this->author = (array_key_exists('author',$params)) ? $params['author'] : null;
		$this->post_name = (array_key_exists('post_name',$params)) ? $params['post_name'] : null;
		$this->post_content = (array_key_exists('post_content',$params)) ? $params['post_content'] : null;
		$this->post_status = (array_key_exists('post_status',$params)) ? $params['post_status'] : null;
		$this->comment_status = (array_key_exists('comment_status',$params)) ? $params['comment_status'] : null;
		$this->post_type = (array_key_exists('post_type',$params)) ? $params['post_type'] : null;
		$this->is_featured = (array_key_exists('is_featured',$params)) ? $params['is_featured'] : null;
		$this->image_name = (array_key_exists('image_name',$params)) ? $params['image_name'] : null;
        $this->cat_id = (array_key_exists('cat_id',$params)) ? $params['cat_id'] : null;
        $this->post_parent_id = (array_key_exists('post_parent_id',$params)) ? $params['post_parent_id'] : null;
        $this->is_parent = (array_key_exists('is_parent',$params)) ? $params['is_parent'] : null;
          $this->image_name_thumb = (array_key_exists('image_name_thumb',$params)) ? $params['image_name_thumb'] : null;
	}//end of function
	

//to get all records

	function get_all_parents_records(){
		global $db;
		$sql="SELECT * FROM $this->table WHERE post_type = ? and is_parent=1 order by id asc ";
		$db->query($sql, array($this->post_type));
		$row=$db->fetch_assoc_all();
        return $row;
        }
//to get all records
	function get_all_records(){
		global $db;
		$sql="SELECT * FROM $this->table WHERE post_type = ? and is_parent=1 order by id asc ";
		$db->query($sql, array($this->post_type));
		$row=$db->fetch_assoc_all();
        
                    $filter_data_array= array();
						$index = 0;
						 
                     
                     $filter_data_array1= array();
						$index1 = 0;
                            
                         
             foreach($row as $data){
							 $filter_data_array[$index]['id']=$data['id']; 
							 $filter_data_array[$index]['post_name']=$data['post_name']; 
							 $filter_data_array[$index]['post_content']=$data['post_content']; 
							 $filter_data_array[$index]['post_status']=$data['post_status'];
                             
                             $filter_data_array[$index]['post_type']=$data['post_type']; 
							 $filter_data_array[$index]['is_featured']=$data['is_featured']; 
							 $filter_data_array[$index]['image_name']=$data['image_name'];
							 $filter_data_array[$index]['comment_status']=$data['comment_status'];
						     
                             
                             $this->id =$data['id'];
                             $all_childs=$this->get_all_child_records();
                             
                         foreach($all_childs as $child_data){
                            
                                    $this->id =$child_data['post_child_id'];
                                    $child_record=$this->get_data_by_id();
                                    
        							 $filter_data_array1[$index1]['id']=$child_record['id']; 
        							 $filter_data_array1[$index1]['post_name']=$child_record['post_name']; 
        							 $filter_data_array1[$index1]['post_content']=$child_record['post_content']; 
        							 $filter_data_array1[$index1]['post_status']=$child_record['post_status'];
                                     
                                     $filter_data_array1[$index1]['post_type']=$child_record['post_type']; 
        							 $filter_data_array1[$index1]['is_featured']=$child_record['is_featured']; 
        							 $filter_data_array1[$index1]['image_name']=$child_record['image_name'];
                                     $filter_data_array[$index]['comment_status']=$data['comment_status'];
        							 $index1++;
        						     
                             
                             }//loop
                          $filter_data_array[$index]['child_records']=$filter_data_array1;   
                             
             $index++;
           }//most outer loop
        
        
		return $filter_data_array;
	}//end of fucntion 	


//to get all records
	function get_all_child_records(){
		global $db;
		$sql="SELECT * FROM $this->post_rules_table WHERE post_parent_id = ?";
		$db->query($sql, array($this->id));
		$row=$db->fetch_assoc_all();
		return $row;
	}//end of fucntion 
    	
	//to get the record by id 
	function get_data_by_id(){
		global $db;
		$data=array();
		if($this->id!=''){
			$sql="SELECT * FROM $this->table where id = ? ";
			$db->query($sql, array($this->id));
			$data=$db->fetch_assoc();
			}else{
			 $data['id']='0'; $data['author']='';  $data['post_name']='';$data['post_content']='';$data['post_status']='Publish';$data['comment_status']='On';$data['post_type']='';$data['image_name']='';$data['is_featured']=0; $data['cat_id']='';
	           $data['image_name_thumb']='';
               
               }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array('author'=>$this->author,'post_name'=>$this->post_name,
               'post_content'=>$this->post_content,'post_status'=>$this->post_status,
               'comment_status'=>$this->comment_status,'post_type'=>$this->post_type,
               'is_featured'=>$this->is_featured,'image_name'=>$this->image_name,
               'cat_id'=>$this->cat_id,'is_parent'=>$this->is_parent,'image_name_thumb'=>$this->image_name_thumb);
			   $response = $db->insert($this->table,$data);
               $this->id=$db->insert_id();//set the offer id 
                    if($this->post_parent_id!=''){
                        
                        $this->make_post_child();
                    }
               
               
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
        $date=date('Y-m-d H:i:s', time());
		$data = array('author'=>$this->author,'post_name'=>$this->post_name,'post_content'=>$this->post_content,
        'post_status'=>$this->post_status,'comment_status'=>$this->comment_status,
        'post_type'=>$this->post_type,'is_featured'=>$this->is_featured,'updated_at'=>$date,
        'cat_id'=>$this->cat_id,'is_parent'=>$this->is_parent,'image_name_thumb'=>$this->image_name_thumb);

		$ImageName=   preg_replace('/\s+/', '', $_FILES['file']['name']) ;
		if($ImageName!=''){
		$image_anme= $this->get_data_by_id();
		unlink ('../../files/'.$image_anme['image_name']);
		$this->insert_image();
        $data['image_name']=$this->image_name;

		}

      $ImageNamethumb=   preg_replace('/\s+/', '', $_FILES['file_thumb']['name']) ;
		if($ImageNamethumb!=''){
		   	$image_anme1= $this->get_data_by_id();
	    	unlink ('../../files/thumb/'.$image_anme1['image_name_thumb']);
				      $this->insert_image_thumb();
                      $data['image_name_thumb']=$this->image_name_thumb;
		}
        
				$response = $db->update($this->table,$data,"id = $this->id");
		return $response;
	}//end of function
		
	//to delete record
	public function delete(){
		global $db;
		$response = array('success' => false);
		$response['success']=$db->delete($this->table, "id = $this->id");
		
		$image_anme= $this->get_data_by_id();
		unlink ('../../files/'.$image_anme['image_name']);
		unlink ('../../files/thumb/'.$image_anme['image_name_thumb']);
        
        
		
	    return $response;
	}
	
public function manageRecord(){
		global $db;
		if($this->id==0){
		$this->insert_image();
        $this->insert_image_thumb();
			   $result= $this->insertRecord();
			}else{
				 $result=$this->updateRecord();
				}//else
				
	 return $result;
	}//end of function

function insert_image(){
$target="../../files/";
						// some information about image we need later.
						$ImageName=   preg_replace('/\s+/', '', $_FILES['file']['name']) ;
						$ImageSize =$_FILES['file']['size'];
						$TempSrc =$_FILES['file']['tmp_name'];
						$ImageType =$_FILES['file']['type'];			
							$ImageName_=$ImageName;
							$imageFinalName=uniqid().$ImageName_;	    
							$target1111 = $target . basename($imageFinalName);
					
																	$target22 = $target .'thumb/'. basename($imageFinalName);
																
														
					$result=move_uploaded_file($TempSrc, $target1111);									
				 	       $this->image_name=$imageFinalName;
					

}	


function insert_image_thumb(){
$target="../../files/thumb/";
						// some information about image we need later.
						$ImageName=   preg_replace('/\s+/', '', $_FILES['file_thumb']['name']) ;
						$ImageSize =$_FILES['file_thumb']['size'];
						$TempSrc =$_FILES['file_thumb']['tmp_name'];
						$ImageType =$_FILES['file_thumb']['type'];			
							$ImageName_=$ImageName;
							$imageFinalName=uniqid().$ImageName_;	    
							$target1111 = $target . basename($imageFinalName);
																			
				        	$result=move_uploaded_file($TempSrc, $target1111);									
				 	       $this->image_name_thumb=$imageFinalName;
					

}
	
	//to check the image extension
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }//end of function 
 
 //to get post list 
	public function get_post_list(){
	global $db;    
		$row=$this->get_all_parents_records();
       $post_list_options='';

		if(!empty($row)){
			foreach($row as $data){
		$post_list_options.='<option ';
		$post_list_options.=($data['id']==$this->id)? ' selected=selected ' : '' ;
		$post_list_options.='value="'.$data['id'].'">'.$data['post_name'].'</option>';
				}//loop
			}//if
		return $post_list_options;
	}//end of function
    
 function make_post_child(){
    global $db;
               $data = array('post_parent_id'=>$this->post_parent_id,'post_child_id'=>$this->id);
			   $response = $db->insert($this->post_rules_table,$data);
               return $response;
    
 }//end of function   
    
    
 
}//end of class
?>