<?php 
class Subscriber{
	private $table = 'subcribers';
	private $id;
	private $email;

	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
		$this->email = (array_key_exists('email',$params)) ? $params['email'] : null;
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
			 $data['id']='0'; $data['email']='';
	           }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array('email'=>$this->email);
			   $user_email = $this->chk_user_exist();
			   if(!empty($user_email)){
				   $response['m'] = 'exist';
			   }else{
				   if($db->insert($this->table,$data))
				   $response['m'] = 'success';
			   }
		       
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
               $data = array('email'=>$this->email);
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
			$item_type=1;
			   $result= $this->insertRecord();
			}else{
				$item_type=2;
				 $result=$this->updateRecord();
				}//else
				
	 return $result;
	}//end of function
	
public function chk_user_exist(){
		global $db;
		$response = array('success' => false);
		$query="SELECT * FROM $this->table where email= ? ";
		$db->query($query,array($this->email));
		$data_email=$db->fetch_assoc();
		return $data_email;
}//end of function


}//end of class

?>