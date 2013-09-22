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
$data=$_obj->get_all_records();

?>
<script type="text/javascript"> 
function delete_record(id){
	if(confirm("Do you want to delete this record ?")){
		var url= "../controller/post.php";
		var data = 'id='+id+'&task=delete_record';
        $.ajax({
            url :url,
            data: data,
            type:'POST',
            beforeSend: function(){},
            error: function(e){},
            success:function(r){
					var te=$.parseJSON(r);
					if(te.success==true){
					 $('#'+id).slideRow('up');
					 $('#'+id).remove();
					 var rowCount = $('#adminlist tr').length;
			 			if(rowCount===1){
								$('#adminlist').append('<tr><td colspan="6" class="no_record">No record found</td></tr>');
							}
                }
                else{
                    alert(te.msg);
                }//else
            },
            complete: function(){ }
        });//ajax function
		
	}
}//end of fucntion 
</script>

<div class="row">
        <div class="large-12 columns">
          <h1 class="docs header"><a href=""><?php echo $title;?> Panel</a></h1>
            <div class="subheader">
            <a href="post_m.php?type=<?php echo $title;?>"><button class="button icon-plus-circle">Create <?php echo $title;?></button></a>
            </div>
            
            
            <div class="subheader">
            <a href="post_rules.php?type=<?php echo $title;?>"><button class="button icon-plus-circle">Create <?php echo $title;?> Rules</button></a>
            </div>
            
            
          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="current" ><a href="#"><?php echo $title;?></a></li>
            </ul>
 
<div class="clear"></div>

<table width="100%" cellspacing="1" cellpadding="1" class="adminlist" id="adminlist">
	<thead>
	<tr>
            <th width="3%">Id</th>
            <th width="30%"><?php echo $title;?> Name</th>
            <th width="10%"><?php echo $title;?> Status</th>
			<th width="10%">Comments</th>
			
			<th width="10%">Is Featured</th>
            <th width="10%">Action</th>
   </tr>
    </thead>
    <tbody>
    <?php
	 if (empty ($data)){
	?> <td colspan="6" class="no_record"> <?php echo "No record found";
	 }else{ ?> </td> 
	 <?php
	    $n = 1; $i = $k = 0;
 foreach ($data as $row){
	 ?>
	<tr class="row<?php echo $k;?>"  style="background-color:#ddd" id="<?php echo $row['id'];?>">
    	<td ><?php echo $row['id']; ?>	</td>
         <td><a href="post_m.php?id=<?php echo $row['id'];?>"><?php  echo $row['post_name'] ; ?></a> </td>
         <td><?php  echo $row['post_status'] ; ?></td>
		 <td><?php  echo $row['comment_status'] ; ?>
		 <td><?php  echo $row['is_featured'] ; ?></td>
         <td width="8%" align="center">
		 <a href="post_m.php?id=<?php echo $row['id'];?>"><span class="icon-edit"></span></a> 
		 <?php
			echo'<a onclick="delete_record('.$row['id'].')"><span class="icon-trash" title=" Delete this record"></span></a>';
 ?> 		</td> 
       </tr>
	<?php
	
	foreach ($row['child_records'] as $child_row){
			?>
		<tr class="child_row"  id="<?php echo $row['id'];?>">
    	<td ><?php echo $child_row['id']; ?>	</td>
         <td><a href="post_m.php?id=<?php echo $child_row['id'];?>"><?php  echo $child_row['post_name'] ; ?></a> </td>
         <td><?php  echo $child_row['post_status'] ; ?></td>
		 <td></td>
		 <td><?php  echo $child_row['is_featured'] ; ?></td>
         <td width="8%" align="center">
		 <a href="post_m.php?id=<?php echo $child_row['id'];?>"><span class="icon-edit"></span></a> 			
		 <?php
			echo'<a onclick="delete_record('.$row['id'].')"><span class="icon-trash" title=" Delete this record"></span></a>';?> 		</td> 
       </tr>
			<?php
			
		};
	
	
	$n++; $k = 1 - $k;
	 }//loop

 }//else 
	?>
    </tbody>
</table>
</div>
      </div>

<?php include"../footer.php";?>