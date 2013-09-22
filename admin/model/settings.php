<?php 
class Settings{
	private $table = 'settings';
	private $id;
    private $option_name;
	private $value;

	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
        $this->option_name = (array_key_exists('option_name',$params)) ? $params['option_name'] : null;
		$this->value = (array_key_exists('value',$params)) ? $params['value'] : null;
		$this->is_image = (array_key_exists('is_image',$params)) ? $params['is_image'] : null;
	}//end of function
	

//to get all location records
	function get_all_records(){
		global $db;
		$sql="SELECT * FROM $this->table order by id asc";
		$db->query($sql);
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
			 $data['id']='0'; $data['option_name']='';  $data['value']='';
	           }
            return $data;
	}//end of function

	function get_data_by_option_name(){
		global $db;
		$data=array();
		if($this->option_name!=''){
			$sql="SELECT * FROM $this->table where option_name = ? ";
			$db->query($sql, array($this->option_name));
			$data=$db->fetch_assoc();
			
			}else{
			 $data['id']='0'; $data['option_name']='';  $data['value']='';
	           }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array('option_name'=>$this->option_name,'value'=>$this->value);
			   if($this->is_image){
				   $this->insert_image();
			   }
			   
		       $response = $db->insert($this->table,$data);
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
                $data = array('option_name'=>$this->option_name,'value'=>$this->value);
			   if($this->is_image){
				   $this->insert_image();
			   }
				$response = $db->update($this->table,$data,"id = $this->id");
		return $response;
	}//end of function
		
	//to delete record
	public function delete(){
		global $db;
		$response = array('success' => false);
		$response['success']=$db->delete($this->table, "id = $this->id");
	    return $response;
	}
	
public function manageRecord(){
		global $db;
		if($this->id==0){
			   $result= $this->insertRecord();
			}else{
				 $result=$this->updateRecord();
				}//else
				
	 return $result;
	}//end of function


function insert_image(){
		$target="../../img/";
		// some information about image we need later.
		$ImageName=   preg_replace('/\s+/', '', $_FILES['file']['name']) ;
		$ImageSize =$_FILES['file']['size'];
		$TempSrc =$_FILES['file']['tmp_name'];
		$ImageType =$_FILES['file']['type'];			
		$ImageName_=$ImageName;
		$imageFinalName=uniqid().$ImageName_;	    
		$final_target = $target . basename($imageFinalName);
		
		$result=move_uploaded_file($TempSrc, $final_target);
		$this->value=$imageFinalName;
					
		print_r($result);			exit;						

}	

}//end of class


?>