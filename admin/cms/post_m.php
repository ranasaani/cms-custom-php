<?php 
require_once("../header.php");
require_once('../model/post.php');
require_once('../model/categories.php');
if ( !isset($_GET['type']) ){
	$title = $post_type = 'post';
}
elseif ( isset($_GET['type']) && ($_GET['type'] == 'page'|| $_GET['type'] == 'post') ){
	$title = $post_type = $_GET['type'];
}
else
	die('Invalid post type');

if (isset($_REQUEST['post_parent_id']) && $_REQUEST['post_parent_id']!=0 ){
	$post_parent_id = $_REQUEST['post_parent_id'];
    $post_rule_title=' rules ';
    $post_button_title='Next Rules';
    $post_button_cancel='Finish';
    $is_parent = 0;
}else{
    $post_parent_id = 0;
    $post_rule_title='';
    $post_button_title='Save';
    $post_button_cancel='Cancel';
    $is_parent = 1;
    
}


$_obj = new Post();
$cat_obj= new Category();
$id=@$_REQUEST['id'];
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();

$params1 = array('id'=> $data['cat_id']);
    $cat_obj->map($params1);
    $cat_list=$cat_obj->get_cat_list();
if($is_parent!=1) {  
?>

<script src="../../js/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,cut,copy,paste,pastetext,|,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect",
		theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,cleanup,help,code,|,insertdate,inserttime,preview",
		theme_advanced_buttons3 : "charmap,emotions,iespell,advhr,|,print,|,fullscreen,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
<?php  }?>

<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href=""><?php echo $title; echo $post_rule_title;?> form</a></h1>
            <div class="subheader">
            <a href="post.php"><button class="button icon-reply-1" >Back to <?php echo $title; ?>s </button></a>
            </div>
          
 <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="post.php?type=<?php echo $title; ?> "><?php echo $title; ?> </a></li>
                <li class="current" ><a href="#"><?php echo $title; echo $post_rule_title ;?>   Management</a></li>
            </ul>
            
            
<div class="clear"></div>

<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="../controller/post.php" onsubmit="return post_form()">
	<fieldset>
    <legend>Fields Mark with * are required</legend>
     <div class="row">
      <div class="large-12 columns">
        <label><?php echo $title; ?> title *</label>
        <input type="text" value="<?php echo $data['post_name'];?>" name="post_name" id="post_name" required="required"/>
      </div>
    </div>
        
       
        <div class="row">
      <div class="large-12 columns">
        <label><?php echo $title; ?> Content *</label>
			<textarea id="elm1" name="post_content" style=" height:450px;" required="required"> <?php echo $data['post_content'];?></textarea>     
      </div>
    </div>

<div class="row">
      <div class="large-3 columns">
        <label><?php echo $title; ?> Status</label>
        <div class="switch round">
          <input id="z" name="post_status" type="radio" value="Publish" <?php if($data['post_status']=='Publish'){echo 'checked';}?> >
          <label for="z" onclick="">Publish</label>
        
          <input id="z1" name="post_status" type="radio" value="Draft" <?php if($data['post_status']=='Publish'){echo 'Draft';}?>>
          <label for="z1" onclick="">Draft</label>
                    <span></span>

        
        </div>

      </div>
      <div class="large-3 columns">
        <label>Comments</label>
        <div class="switch round">
          <input id="z2" name="comment_status" type="radio" value="On" <?php if($data['comment_status']=='On'){echo 'checked';}?>>
          <label for="z2" onclick="">On</label>
        
          <input id="z3" name="comment_status" type="radio" value="Off" <?php if($data['comment_status']=='Off'){echo 'checked';}?>>
          <label for="z3" onclick="">Off</label>
                  <span></span>

        </div>

      </div>
      <div class="large-3 columns">
        <label>Is Featured *</label>
        
        <div class="switch round">
          <input id="z4" name="is_featured" type="radio" checked value="0" <?php if($data['is_featured']==0){echo 'checked';}?>>
          <label for="z4" onclick="">No</label>
        
          <input id="z5" name="is_featured" type="radio" value="1" <?php if($data['is_featured']==1){echo 'checked';}?>>
          <label for="z5" onclick="">Yes</label>
                  <span></span>

        </div>
      </div>
  <?php $display  = 'block' ; if($post_type=='page') $display  = 'none'?>    
      <div class="large-3 columns" style="display:<?php echo $display?>">
        <label>Chose Caegory *</label>
        	<div class="custom dropdown"> 
                <select name="cat_id" id="cat_id"  class="medium">
              <?php echo $cat_list;?>
              </select> 
           </div>                  
      </div>
    </div>
<?php    
					if(isset($id)){?>
            <div class="row">
                  <div class="large-12 columns">
            <label>Post Image *</label>
			<img src="../../files/<?php echo $data['image_name'];?>" width="50" height="50"/></span>';
            </div>
        </div>
            
             <div class="row">
                  <div class="large-12 columns">
            <label>Post thumb Image *</label>
			<img src="../../files/thumb/<?php echo $data['image_name_thumb'];?>" width="50" height="50"/></span>';
            </div>
        </div>

<?php 	} ?>    
             <div class="row">
                  <div class="large-12 columns">
            <label>Upload image  *</label>
			<input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file" class="addedInput"  <?php if($data['id']==0){echo 'required="required"';}?> accept="image/*"/>
            </div>
        </div>


 <div class="row">
                  <div class="large-12 columns">
            <label>Upload thumb image  *</label>
			<input id="fileInputBox1" style="margin-bottom: 5px;" type="file"  name="file_thumb" class="addedInput"  <?php if($data['id']==0){echo 'required="required"';}?> accept="image/*"/>
            </div>
        </div>                    <input type="hidden" name="is_parent" id="is_parent" value="<?php echo $is_parent;?>"/>
                    <input type="hidden" name="post_type" id="id" value="<?php echo $post_type;?>"/>
                    <input type="hidden" name="post_parent_id" id="post_parent_id" value="<?php echo $post_parent_id;?>"/>
                    <input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>"/>
                    <input type="hidden" name="task" value="save_record"/>
                    
                    <input type="submit" title="<?php  echo $post_button_title;?>" class="button small" value="<?php  echo $post_button_title;?>" />
 	                
                     
                     <a href="post.php">
                    <input type="button" value="<?php  echo $post_button_cancel;?>" title="<?php  echo $post_button_cancel;?>" class="button small secondary"/></a>
					<span class="small">In order to replace the post image please upload a new image otherwise leave it  .</span>
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


