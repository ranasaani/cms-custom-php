<?php 
require_once("../header.php");
require_once('../model/menus.php');
$_obj = new Menus();
$data=$_obj->get_all_records();
?>
<script type="text/javascript"> 
function delete_record(id){
	if(confirm("Do you want to delete this record ?")){
var url= "../controller/menus.php";
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
							$('#adminlist').append('<tr><td colspan="4" class="no_record">No record found</td></tr>');
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
          <h1 class="header"><a href="">Menu</a></h1>

            <div class="subheader">
            <a href="menus_m.php"><button class="button icon-plus-circle" >Add new link</button></a>
            </div>

          <ul class="breadcrumbs">
             <li class="" ><a href="../index.php">Dashboard</a></li>
              <li class="current" ><a href="#">Menus</a></li>
            </ul>
 

<table width="100%" cellspacing="1" cellpadding="1" class="adminlist" id="adminlist">
	<thead>
	<tr>
           <th width="3%">Id</th>
           <th width="20%">Name</th>
           <th width="20%">URL</th>
           <th width="20%">Description</th>
           <th width="10%">Type</th>
           <th width="7%">Order</th>
           <th width="10%">Actions</th>
   </tr>
    </thead>
    <tbody>
    <?php
	 if (empty ($data)){
	?> <td colspan="4" class="no_record"> <?php echo "No record found";
	 }else{ ?> </td> 
	 <?php
	    $n = 1; $i = $k = 0;
 foreach ($data as $row){?>
	<tr class="row<?php echo $k;?>" id="<?php echo $row['id'];?>">
    	<td ><?php echo $row['id']; ?>	</td>
         <td><a href="menus_m.php?id=<?php echo $row['id'];?>"><?php  echo $row['link_name'] ; ?></a> </td>
         <td><?php  echo $row['link_url'] ; ?></td>
         <td><?php  echo $row['link_description'] ; ?></td>
         <td><?php  echo $row['link_type'] ; ?></td>
         <td><?php  echo $row['order'] ; ?></td>
         <td width="8%" align="center">
         <a href="menus_m.php?id=<?php echo $row['id'];?>"><span class="icon-edit"></span></a> 
		 
		 <?php 
echo'<a  onclick="delete_record('.$row['id'].')"><span class="icon-trash" title=" Delete this record"></span></a>';
 ?> </td> 
       </tr>
	<?php
	$n++; $k = 1 - $k;
	 }//loop

 }//else 
	?>
    </tbody>
</table>
</div>
      </div>

<?php include"../footer.php";?>