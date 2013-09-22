<?php 
class Menus{
	private $table = 'menus';
	private $id;
	private $link_name;
	private $link_url;
	private $link_description;
	private $order;
	private $link_type;

	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
		$this->link_name = (array_key_exists('link_name',$params)) ? $params['link_name'] : null;
		$this->link_url = (array_key_exists('link_url',$params)) ? $params['link_url'] : null;
		$this->link_description = (array_key_exists('link_description',$params)) ? $params['link_description'] : null;
		$this->order = (array_key_exists('order',$params)) ? $params['order'] : null;
		$this->link_type = (array_key_exists('link_type',$params)) ? $params['link_type'] : null;
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
			 $data['id']=''; $data['link_name']='';  $data['link_url']=''; $data['link_description']='';$data['link_type']='';$data['order']='';
	           }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array(
			   'link_name'=>$this->link_name,
			   'link_url'=>$this->link_url,
			   'link_description'=>$this->link_description,
			   'link_type'=>$this->link_type,
			   'order'=>$this->order);
		       $response = $db->insert($this->table,$data);
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
               $data = array(
			   'link_name'=>$this->link_name,
			   'link_url'=>$this->link_url,
			   'link_description'=>$this->link_description,
			   'order'=>$this->order,
			   'link_type'=>$this->link_type,
			   );
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