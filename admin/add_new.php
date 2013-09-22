<?php 
	include"session.php";
	
	$id = $name = $address = $city = $country = $long = $lat = $contact_person = $contact_no = $contact_email = '';
	$label = "Add a new store";
	$submit = "Add";
	
	if(isset($_GET["action"]) && $_GET["action"]=="edit"){
		
		$store_location = $_SESSION["store_location"];
		
		$id 			=  $store_location["id"];
		$name 			=  $store_location["name"];
		$address 		=  $store_location["address"];;
		$city 			=  $store_location["city"];
		$country 		=  $store_location["country"];
		$long 			=  $store_location["long"];
		$lat 			=  $store_location["lat"];
		$contact_person =  $store_location["contact_person"];
		$contact_no 	=  $store_location["contact_no"];
		$contact_email 	=  $store_location["contact_email"];
		$label = "Edit store information";
		$submit 		=  "Update";		
	}
	
	
	
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Location App | Add New</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
	<div class="header">
   	 <a href="dashboard.php"><button>View All Stores</button></a>
   	 <a href="?action=logout"><button> Logout</button></a>
    </div >
    
    <section id="content" style="width:auto">
    
    
		<form action="controller/stores.php" method="post">
			<h1><?php echo $label?></h1>
			<div>
				<input type="text" placeholder="Mall name" required id="name" name="name" value="<?php echo $name?>" />
			</div>
			<div>
				<input type="text" placeholder="Address" required id="address" name="address" value="<?php echo $address?>" />
			</div>
			<div class="half">
           		<input type="text" placeholder="City" required id="city" name="city" value="<?php echo $city?>" />
                
				<input type="text" placeholder="Country" required id="country" name="country" value="<?php echo $country?>" />
			</div>
			<div class="half">
				<input type="text" placeholder="Longitude" required id="long" name="long" value="<?php echo $long?>" />
                
                <input type="text" placeholder="Latitude" required id="lat" name="lat" value="<?php echo $lat?>" />
			</div>
            <div style="padding: 10px 60px 20px;text-align: left;">
            	<span>Find Longitude and Latitude at </span><a style="display:inline-block;float:none; margin:auto" href="https://maps.google.com/maps?showlabs=1">https://maps.google.com/maps?showlabs=1</a> 
            </div>
			<div>
				<input type="text" placeholder="Contact person name" id="contact_person" name="contact_person" value="<?php echo $contact_person?>" />
			</div>
            <div class="half">
				<input type="text" placeholder="Contact No" id="contact_no" name="contact_no" value="<?php echo $contact_no?>" />
                
                <input type="email" placeholder="Contact Email" id="email" name="contact_email" value="<?php echo $contact_email?>" />
			</div>
            
            <input type="hidden" value="<?php echo $id?>" name="id">

			<div>
				<input type="submit" name="action" value="<?php echo $submit?>"  />
			</div>
            
		</form><!-- form -->
    
    </section>
</div>

</body>

</html>