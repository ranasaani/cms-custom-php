<?php 
require_once("../header.php");
require_once('../model/categories.php');
$_obj = new Category();
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();
?>
<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Category form</a></h1>
            <div class="subheader">
				<a href="categories.php"><button class="button  icon-reply-1" >Back to Category Page</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="categories.php">Category</a></li>
               <li class="current" ><a href="#">Category Management</a></li>
            </ul>
            
<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="../controller/categories.php" onsubmit="return cat_form()">

  <fieldset>
    <legend>Fields Mark with * are required</legend>
     <div class="row">
      <div class="large-12 columns">
        <label>Name *</label>
        <input type="text" value="<?php echo $data['cat_name'];?>" name="cat_name" id="cat_name" required="required"/></td>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <label>Description *</label>
        <textarea name="cat_description" id="cat_description" ><?php echo $data['cat_description'];?></textarea>
      </div>
    </div>

                    <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>"/>
                    <input type="hidden" name="task" value="save_record"/>
                   
                    <input type="submit" title="Save" class="button small" value="Save" />
 	                <a href="categories.php">
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