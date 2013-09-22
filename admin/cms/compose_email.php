<?php 
require_once("../header.php");
require_once('../model/subscribers.php');
$_obj = new Subscriber();
$params = array('id'=> @$_REQUEST['id']);
$_obj->map($params);
$data=$_obj->get_data_by_id();
$to = "All subscribers";
$to_id = '';
if(isset($data['email']) && !empty($data['email']))
{
	$to_id = $to = $data['email'];
}
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

<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href="">Send Email</a></h1>
            <div class="subheader">
				<a href="subscribers.php"><button class="button  icon-reply-1" >Back to Subscribers Page</button></a>
            </div>
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="" ><a href="subscribers.php">Subscribers</a></li>
               <li class="current" ><a href="#">Send Email</a></li>
            </ul>
            
<div id="stylized" class="myform">
 <form name="file_form" id="file_form" method="post" enctype="multipart/form-data" action="send_email.php">

  <fieldset>
    <legend>Fields Mark with * are required</legend>
     <div class="row">
      </div>
     <div class="row">
      <div class="large-12 columns">
        <label class="label">To: <?php echo $to;?></label>
        <label>Subject *</label>
        <input type="text" name="subject" id="subject" required="required"/>
      </div>
    </div>
     <div class="row">
      <div class="large-12 columns">
        <label> Message *</label>
			<textarea id="elm1" name="message" style=" height:400px;"></textarea>     
      </div>
    </div>
              <input type="hidden" name="to" id="to" value="<?php echo $to_id;?>"/>
                   
                    <input type="submit" title="Send" class="button small" value="Send" />
 	                <a href="subscribers.php">
                    <input type="button" value="Cancel" title="cancel" class="button small secondary"/></a>
  </fieldset>
</form>

</div>


<?php include"../footer.php";?>