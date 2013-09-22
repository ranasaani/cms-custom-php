<?php 
require_once("../header.php");
require_once('../model/settings.php');
$obj = new Settings;
$obj->map(array("option_name"=>"background_image"));
$bg = $obj->get_data_by_option_name();
$obj->map(array("option_name"=>"site_title"));
$title = $obj->get_data_by_option_name();
?>

<div class="row">
        <div class="large-12 columns">
          <h1 class="header"><a href="">Settings </a></h1>

            <div class="subheader">
            </div>

          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="current" ><a href="#">Settings</a></li>
            </ul>
 
		<div class="panel large-12">
        <div class="large-3 columns">
        <h4>Site Title</h4>
        </div>
        <div class="large-9 columns">
        <form action="../controller/settings.php" enctype="multipart/form-data" method="post">
        
              <input type="text" name="value" value="<?php echo $title['value'];?>" />
              <input type="hidden" name="id" value="<?php echo $title["id"]?>">
               <input type="hidden" name="option_name" value="site_title">
              <input type="hidden" name="task" value="save_record">
				<div class="small-4 columns">
             	<input type="submit" class="button prefix" value="save" />
              </div>        </form>
        </div>
        </div>
		<hr />
        <div class="panel large-12">
         <div class="large-3 columns">
          <h4>Backgroud Image</h4>
          <img src="../../img/<?php echo $bg["value"]?>" />
         </div> 
        <div class="large-9 columns">
          <div class="row collapse">
          <h4>Change Backgroud</h4>
            <div class="small-10 columns">
            <form action="../controller/settings.php" enctype="multipart/form-data" method="post">

              <input type="file" name="value" value="" class="required">

              <input type="hidden" name="option_name" value="background_image">
              <input type="hidden" name="task" value="save_image">
              <input type="hidden" name="id" value="<?php echo $bg["id"]?>">
              <div class="small-4 columns">
              <input type="submit" class="button prefix" value="save" />
              </div>
            
            </form>
            </div>
          </div>

        </div>


</div>
      </div>

<?php include"../footer.php";?>