<?php
	
	if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
		
		include "../db_connect.php";
		
		switch($_REQUEST["action"]){
			
			case "Add":
				$query = "INSERT INTO `stores`(`name`, `address`, `city`, `country`, `long`, `lat`, `contact_person`, `contact_no`, `contact_email`) VALUES ('"
						.@$_REQUEST["name"]."','"
						.@$_REQUEST["address"]."','"
						.@$_REQUEST["city"]."','"
						.@$_REQUEST["country"]."','"
						.@$_REQUEST["long"]."','"
						.@$_REQUEST["lat"]."','"
						.@$_REQUEST["contact_person"]."','"
						.@$_REQUEST["contact_no"]."','"
						.@$_REQUEST["contact_email"]."')";
						
				if(print_r(mysqli_query($con, $query))){
					header("Location: ../dashboard.php");
				}else{
					header("Location: ../add_new.php?p=error");
				}
				
			break;

			case "Update":
				$query = "UPDATE `stores` SET"
						."`name`			='".@$_REQUEST["name"]
						."',`address`		='".@$_REQUEST["address"]
						."',`city`			='".@$_REQUEST["city"]
						."',`country`		='".@$_REQUEST["country"]
						."',`long`			='".@$_REQUEST["long"]
						."',`lat`			='".@$_REQUEST["lat"]
						."',`contact_person`='".@$_REQUEST["contact_person"]
						."',`contact_no`	='".@$_REQUEST["contact_no"]
						."',`contact_email`	='".@$_REQUEST["contact_email"]
						."' WHERE `id`		= ".@$_REQUEST["id"];
				if(mysqli_query($con, $query)==1){
					header("Location: ../dashboard.php");
				}else{
					header("Location: ../add_new.php?p=error");
				}
				
			break;

			case "edit":
				$id = $_REQUEST["id"];
				
				$query = "SELECT * FROM stores WHERE id ='$id'";
		
				$result = mysqli_query($con,$query);
		
			if($result->num_rows>0){
			
				$row = mysqli_fetch_array($result);
				
				$arr = array();
				
				$arr["id"] 				= $row["id"];
				$arr["name"]			= $row["name"];
				$arr["address"]			= $row["address"];
				$arr["city"] 			= $row["city"];
				$arr["country"] 		= $row["country"];
				$arr["long"] 			= $row["long"];
				$arr["lat"] 			= $row["lat"];
				$arr["contact_person"] 	= $row["contact_person"];
				$arr["contact_no"] 		= $row["contact_no"];
				$arr["contact_email"] 	= $row["contact_email"];
				$arr["created_at"] 		= $row["created_at"];	
							
				session_start();
				
				$_SESSION["store_location"] = $arr;		
				header("Location: ../add_new.php?action=edit");
					
			}else{
				
				header("Location: index.php?p=invalid");
			}

			break;
			case "delete":
			if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="delete"){
				$query = "DELETE FROM `stores` WHERE `id`=".@$_REQUEST["id"];
				if(mysqli_query($con, $query)==1){
					header("Location: ../dashboard.php");
				}else{
					header("Location: ../dashboard.php?p=error");
				}

			}

			break;
			case "check_existence":	
			$response = array();
			$response['success']=false;
			if(isset($_REQUEST["city"]) && $_REQUEST["action"]!=''){
				$query = "SELECT  `id`,  `name` , `address`  ,`city` , `country` , `long`  ,`lat`  FROM  `stores` WHERE  `city` =  '".@$_REQUEST["city"]."'";
				$result = mysqli_query($con,$query);
				$i=0;
				if($result->num_rows>0){
					
					while($row = mysqli_fetch_assoc($result)){
						
						$response['data'][$i]=$row;
						$i++;
					}
					
					$row = mysqli_fetch_assoc($result);
					
					$response['success']=true;
					
					
												
				}else{
					
					
				}
				
				echo json_encode($response);
			}

		}
	}else{
		header("Location: ../index.php");
	}

  
  
  
?>