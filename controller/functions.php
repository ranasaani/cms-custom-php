<?php 
class Functions{
	private $table = 'posts';
    private $post_rules_table = 'post_rules';
    private $menus_table = 'menus';
    private $widgets_table = 'widgets';
    private $ads_table = 'ads';
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
    private $from;
    private $to;
    private $index;
    private $position;
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
        
        $this->from = (array_key_exists('from',$params)) ? $params['from'] : null;
        $this->to = (array_key_exists('to',$params)) ? $params['to'] : null;
        $this->index = (array_key_exists('index',$params)) ? $params['index'] : null;
        $this->position = (array_key_exists('position',$params)) ? $params['position'] : null;
	}//end of function
        
  
  //to get all menu  records
	function get_all_menu_records(){
		global $db;
		$sql="SELECT * FROM $this->menus_table order by link_name asc ";
		$db->query($sql, array($this->post_type));
		$row=$db->fetch_assoc_all();
        return $row;
        }
  
  
    //to get featured  records
	function get_all_featured_records(){
	     global $db;
		$sql="SELECT * FROM $this->table WHERE post_type = ? AND is_parent=1 AND is_featured=1 and post_status='Publish' order by id DESC  LIMIT $this->from,$this->to";
		$db->query($sql, array($this->post_type));
		$row=$db->fetch_assoc_all();
        return $row;
        }
        
                    	
//to get all records (pass post_type =post or page)
	function get_all_parents_records(){
		global $db;
		$sql="SELECT * FROM $this->table WHERE post_type = ? and is_parent=1 and post_status='Publish' order by id desc LIMIT $this->from,$this->to";
		$db->query($sql, array($this->post_type));
		$row=$db->fetch_assoc_all();
        return $row;
        }
//to get all records
	function get_all_records(){
		global $db;
		$sql="SELECT * FROM $this->table WHERE post_type = ? and is_parent=1 and post_status='Publish' order by id desc LIMIT $this->from,$this->to";
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
                              $filter_data_array[$index]['image_name_thumb']=$data['image_name_thumb'];
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
                                      $filter_data_array1[$index1]['image_name_thumb']=$child_record['image_name_thumb'];
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
$resposne=array();

 $sql="SELECT
post_rules.id,
post_rules.post_parent_id,
post_rules.post_child_id,
post_rules.created_at,
posts.post_status
FROM
post_rules
INNER JOIN posts ON post_rules.post_child_id = posts.id
WHERE
post_rules.post_parent_id = {$this->id} AND
posts.post_status <> 'Draft'
ORDER BY post_rules.id DESC";
		$db->query($sql);
		$row=$db->fetch_assoc_all();
        
        if(!empty($row)){
        
                        $parent_id=$this->id;
                        $totla_index=(count($row) - 1);
                        
                            if($this->index==0){
                                
                               $this->id=$row[$this->index]['post_child_id'];
                               $data['current_data']= $this->get_data_by_id();
                               $data['parent_id']=$parent_id; 
                               $data['next_index']= ($this->index + 1);
                               $data['rule_id']= $row[$this->index]['id'];
							        $parent_data= $this->get_data_by_p_id($parent_id);
							   $data['parent_title']=$parent_data['post_name'];
                               
                            }else{
                                
                                
                                        if($this->index==$totla_index){
                                           
                                           $this->id=$row[$this->index]['post_child_id'];
                                           $data['current_data']= $this->get_data_by_id();
                                           $data['parent_id']= $parent_id;
                                           $data['next_index']= 0;
                                           $data['rule_id']= $row[$this->index]['id'];
                                           $data['previous_index']= ($this->index - 1);
                                           $data['records']=1;
										        $parent_data= $this->get_data_by_p_id($parent_id);
							               $data['parent_title']=$parent_data['post_name'];
                                             return $data;
                                        }
                                         
                                           $this->id=$row[$this->index]['post_child_id'];
                                           $data['current_data']= $this->get_data_by_id();
                                           $data['parent_id']= $parent_id;
                                           $data['next_index']= ($this->index + 1);
                                           $data['previous_index']= ($this->index - 1);
                                           $data['rule_id']= $row[$this->index]['id'];
										         $parent_data= $this->get_data_by_p_id($parent_id);
							               $data['parent_title']=$parent_data['post_name'];
                            }
                        
                        
                  $data['records']=1;
                  
               
            }//if there are some record against parent post or page
            else{
                
                $data['records']=0;
                
            }
            
            
                        
        return $data;
        
		
	}//end of fucntion 
    	
	//to get the record by id 
	function get_data_by_id(){
		global $db;
		$data=array();
		if($this->id!=''){
			$sql="SELECT * FROM $this->table where id = ? and post_status='Publish'";
			$db->query($sql, array($this->id));
			$data=$db->fetch_assoc();
			}else{
			 $data['id']='0'; $data['author']='';  $data['post_name']='';$data['post_content']='';$data['post_status']='';$data['comment_status']='';$data['post_type']='';$data['image_name']=''; $data['cat_id']='';
	           }
            return $data;
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
	
	function get_all_posts_count(){
		global $db;
		$sql = "SELECT COUNT(*) as count FROM $this->table WHERE `post_type` = 'post' AND `post_status` = 'Publish' AND `is_parent` = 1";
		$db->query($sql);
		$row=$db->fetch_assoc();
		return $row;
		
		}
 
 
 //to get all location records
	function get_widgets_records(){
		global $db;
		$sql="SELECT * FROM $this->widgets_table where widget_status='Publish' order by id asc";
		$db->query($sql);
		$row=$db->fetch_assoc_all();
		return $row;
	}//end of fucntion 	
 
	function get_ads_by_position(){
		global $db;
		$sql="SELECT * FROM $this->ads_table where position=$this->position";
		$db->query($sql);
		$row=$db->fetch_assoc();
		return $row;
	}//end of fucntion 	
 
 
 
 	//to get the record by id 
	function get_data_by_p_id($id){
		global $db;
		$data=array();
			$sql="SELECT * FROM $this->table where id = ? and post_status='Publish'";
			$db->query($sql, array($id));
			$data=$db->fetch_assoc();
			
            return $data;
	}//end of function
	
	function get_site_title(){
		global $db;
		$sql = "SELECT value FROM settings WHERE option_name='site_title'";
		$db->query($sql);
		$result =  $db->fetch_assoc();
		echo $result ['value'];
		
	}   
 
}//end of class



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

?>