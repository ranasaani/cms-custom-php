<?php 
class Category{
	private $table = 'categories';
	private $id;
	private $cat_name;
	private $cat_description;

	//this function is for mapping the data 
    public function map($params){
		$this->id = (array_key_exists('id',$params)) ? $params['id'] :0;
		$this->cat_name = (array_key_exists('cat_name',$params)) ? $params['cat_name'] : null;
		$this->cat_description = (array_key_exists('cat_description',$params)) ? $params['cat_description'] : null;
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
			 $data['id']='0'; $data['cat_name']='';  $data['cat_description']='';
	           }
            return $data;
	}//end of function

//to add record
	public function insertRecord(){
		global $db;
               $data = array('cat_name'=>$this->cat_name,'cat_description'=>$this->cat_description);
		       $response = $db->insert($this->table,$data);
		return $response;	
	}//end of function

//to update record
	public function updateRecord(){
		global  $db;
               $data = array('cat_name'=>$this->cat_name,'cat_description'=>$this->cat_description);
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


//to get cat list 
	public function get_cat_list(){
	global $db;
		$row=$this->get_all_records();
		$cat_list_options='';
	
    /*	$cat_list_options.='<option ';
		$cat_list_options.=($this->id=='0')? ' selected=selected ' : '' ;
		$cat_list_options.='value="">----------------[Select one]----------------</option>';
		*/
		if(!empty($row)){
			foreach($row as $data){
		$cat_list_options.='<option ';
		$cat_list_options.=($data['id']==$this->id)? ' selected=selected ' : '' ;
		$cat_list_options.='value="'.$data['id'].'">'.$data['cat_name'].'</option>';
				}//loop
			}//if
		return $cat_list_options;
	}//end of function

	
}//end of class
?>