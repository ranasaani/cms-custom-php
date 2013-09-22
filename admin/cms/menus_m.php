<?php 
require_once("../header.php");
require_once('../model/menus.php');
$_obj = new Menus();
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();
?>
<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Menu form</a></h1>
            <div class="subheader">
				<a href="categories.php"><button class="button  icon-reply-1" >Back to Menu Page</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="menus.php">Menu</a></li>
               <li class="current" ><a href="#">Menu Management</a></li>
            </ul>
            
<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="../controller/menus.php" onsubmit="return cat_form()">

  <fieldset>
    <legend>Fields Mark with * are required</legend>
     <div class="row">
      <div class="large-12 columns">
        <label>Name *</label>
        <input type="text" value="<?php echo $data['link_name'];?>" name="link_name" id="link_name" required="required"/>
      </div>
    </div>

     <div class="row">
      <div class="large-12 columns">
        <label>URL *</label>
        <input type="text" value="<?php echo $data['link_url'];?>" name="link_url" id="link_url" required="required"/>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <label>Description</label>
        <textarea name="link_description" id="link_description" ><?php echo $data['link_description'];?></textarea>
      </div>
    </div>
      <div class="row">
      <div class="large-12 columns">
        <label>Order </label>
        <input type="text" value="<?php echo $data['order'];?>" name="order" id="order" />
      </div>
    </div>


                    <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>"/>
                    <input type="hidden" name="link_type" value="custom"/>
                    <input type="hidden" name="task" value="save_record"/>
                   
                    <input type="submit" title="Save" class="button small" value="Save" />
 	                <a href="menus.php">
                    <input type="button" value="Cancel" title="cancel" class="button small secondary"/></a>
  </fieldset>
</form>

</div>


<?php include"../footer.php";?>
<script type="text/javascript"> 
function cat_form(){
				 $('input[type="submit"]').attr('disabled','disabled');
			 return true


}//end of function
</script>