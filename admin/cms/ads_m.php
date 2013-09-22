<?php 
require_once("../header.php");
require_once('../model/ads.php');
$_obj = new Ads();
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();
?>
<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Ads form</a></h1>
            <div class="subheader">
				<a href="categories.php"><button class="button  icon-reply-1" >Back to Ads Page</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="ads.php">Ads</a></li>
               <li class="current" ><a href="#">Ads Management</a></li>
            </ul>
            
<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="../controller/ads.php" onsubmit="return cat_form()">

  <fieldset>
    <legend>Fields Mark with * are required</legend>
      <div class="row">
      <div class="large-12 columns">
        <label>Ads Position</label>
        <input type="text" readonly="readonly" value="<?php echo $data['position'];?>" name="name" id="name" required="required"/></td>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <label>Code</label>
        <textarea name="code" id="code" style="height: 200px;" ><?php echo $data['code'];?></textarea>
      </div>
    </div>
    
    <div class="row">
      <div class="large-3 columns">
        <label>Status</label>
        <div class="switch round">
          <input id="z" name="status" type="radio" value="Publish" <?php if($data['status']=='Publish'){echo 'checked';}?> >
          <label for="z" onclick="">Publish</label>
        
          <input id="z1" name="status" type="radio" value="Draft" <?php if($data['status']=='Publish'){echo 'Draft';}?>>
          <label for="z1" onclick="">Draft</label>
                    <span></span>
        </div>

      </div>
	</div>

                    <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>"/>
                    <input type="hidden" name="task" value="save_record"/>
                   
                    <input type="submit" title="Save" class="button small" value="Save" />
 	                <a href="ads.php">
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