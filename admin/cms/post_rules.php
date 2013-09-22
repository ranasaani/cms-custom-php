<?php 
require_once("../header.php");
require_once('../model/post.php');

if ( !isset($_GET['type']) ){
	$title = $post_type = 'post';
}
elseif ( isset($_GET['type']) && ($_GET['type'] == 'page'|| $_GET['type'] == 'post') ){
	$title = $post_type = $_GET['type'];
}
else
	die('Invalid post type');


$_obj = new Post();

    $_obj->map(array('post_type' => $post_type));
    $post_list=$_obj->get_post_list();
    
    
?>

<div class="row">
        <div class="large-12 columns">
            <div class="subheader">
            <a href="post.php"><button class="button icon-reply-1" >Back to <?php echo $title; ?>s </button></a>
            </div>
          
 <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="post.php?type=<?php echo $title; ?> "><?php echo $title; ?> </a></li>
                <li class="current" ><a href="#"><?php echo $title; ?> Rules Management</a></li>
            </ul>
            
            
<div class="clear"></div>

<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="post_m.php" onsubmit="return post_form()">
	<fieldset>
    <legend>Fields Mark with * are required</legend>
     

   
      <div class="large-3 columns">
        <label>Select Post *</label>
        	<div class="custom dropdown"> 
                <select name="post_parent_id" id="post_parent_id"  class="medium" onchange="document.file_form.submit()">
              <?php echo $post_list;?>
              </select> 
           </div>                  
      </div>
    </div>

                    <input type="submit" title="Add rules" class="button small" value="Add rules" />
 	                <a href="post.php">
                    <input type="button" value="Cancel" title="cancel" class="button small secondary"/></a>
					<br/>

</form>

</div>


<?php include"../footer.php";?>
<script type="text/javascript"> 
function post_form(){
				 $('input[type="submit"]').attr('disabled','disabled');
			 return true


}//end of function
</script>


