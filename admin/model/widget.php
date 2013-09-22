<?php 
class Widget{
	private $table = 'widgets';
	private $id;
	private $code;
	private $widget_status;
    private $name;

	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
        $this->name = (array_key_exists('name',$params)) ? $params['name'] : null;
		$this->code = (array_key_exists('code',$params)) ? $params['code'] : null;
		$this->widget_status = (array_key_exists('widget_status',$params)) ? $params['widget_status'] : null;
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
			 $data['id']='0'; $data['code']='';  $data['name']=''; $data['widget_status']='Publish';
	           }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array('code'=>$this->code,'widget_status'=>$this->widget_status,'name'=>$this->name);
		       $response = $db->insert($this->table,$data);
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
                $data = array('code'=>$this->code,'widget_status'=>$this->widget_status,'name'=>$this->name);
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


}//end of class
?>