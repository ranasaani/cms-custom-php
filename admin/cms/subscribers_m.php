<?php 
require_once("../header.php");
require_once('../model/subscribers.php');
$_obj = new Subscriber();
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();
?>
<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Subscriber form</a></h1>
            <div class="subheader">
				<a href="subscribers.php"><button class="button  icon-reply-1" >Back to Subscribers Page</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="subscribers.php">Subscribers</a></li>
               <li class="current" ><a href="#">Subscribers Management</a></li>
            </ul>
            
<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="../controller/subscribers.php" onsubmit="return cat_form()">

  <fieldset>
    <legend>Fields Mark with * are required</legend>
     <div class="row">
      <div class="large-12 columns">
        <label>Email *</label>
        <input type="text" value="<?php echo $data['email'];?>" name="email" id="email" required="required"/></td>
      </div>
    </div>

                    <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>"/>
                    <input type="hidden" name="task" value="save_record"/>
                    <input type="hidden" name="next" value="../cms/subscribers.php"/>
                   
                    <input type="submit" title="Save" class="button small" value="Save" />
 	                <a href="subscribers.php">
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