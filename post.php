<?php include "header.php";?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Francois+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "58ae3511-02ee-4460-89f6-ab695bb9345e", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

  <!-- Main Page Content and Sidebar -->

  <div class="row">
 
    <!-- Main Blog Content -->
    <div class="large-9 columns post " role="content">
      <section class="large-12">

        <?php 
    if ( isset($_GET['index']) ){
	   $index= $_GET['index'];
    }else{
        $index= 0;
    }
              $obj->map(array('index' =>$index, 'id'=>$_GET['id']));
              $child_posts = $obj->get_all_child_records();
			  $title ="No rule found";
			  $rule_title = '';
			  $child_posts = $child_posts['records'];
      ?>
      
                <?php 
				    if($child_posts){
				 		$title = $child_posts['parent_title'];
						$rule_title = @$child_posts['current_data']['post_name'];
						$rule_content = @$child_posts['current_data']['post_content'];
						}?>
                      
                    
		        <div class="header">
                	<div class="left"><?php echo  $title;?></div>
                    <div class="navigation right"><?php
					if($child_posts){
						if(isset($_GET['index']) &&  $_GET['index']!=0 ){ ?>
						
						   
						  <a href="post.php?id=<?php echo $child_posts['parent_id'];?>&index=<?php echo $child_posts['previous_index'];?>"><label class="back"></label></a>  
						  <a href="post.php?id=<?php echo $child_posts['parent_id'];?>&index=<?php echo $child_posts['next_index'];?>"><label class="next"></label></a>
						  <?php }else { ?>
						  
						  <a href="post.php?id=<?php echo $child_posts['parent_id'];?>&index=<?php echo $child_posts['next_index'];?>"><label class="next"></label></a>
						 
							<?php } 
					}
						
					
					?></div>

<div style="clear:both; padding:0">

</div>
                </div>
<div class="row ads large-12">
			<?php 
				$obj->map(array('position'=>'"top"'));
				$ads_sidebar = $obj->get_ads_by_position();
				echo($ads_sidebar['code']);
            ?>

</div>
				<div class="row">
                    	
                <div class="rule" >
                  <div class="title">
                      <?php echo $rule_title;?>
                   </div>

				<div>
                
                <span class='st_sharethis_hcount' displayText='ShareThis'></span>
                <span class='st_facebook_hcount' displayText='Facebook'></span>
                <span class='st_twitter_hcount' displayText='Tweet'></span>
                <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                <span class='st_pinterest_hcount' displayText='Pinterest'></span>
                <span class='st_email_hcount' displayText='Email'></span>

                </div>
                   <div class="description">
                    <?php if($child_posts){ echo $rule_content;?>     
                      	<img src="files/<?php print_r($child_posts['current_data']['image_name']);?>">  
                    <?php }else{echo "No rule found";}?>                  
                   </div>


                   
                  </div>
                         
             </div>	  
      
      </section>
      <div class="row ads">
			<?php 
				$obj->map(array('position'=>'"bottom"'));
				$ads_bottom = $obj->get_ads_by_position();
				echo($ads_bottom['code']);
            ?>

		</div>

     <section>
        <div class="section_title">
          <div >Recent Posts</div>
          <div class="icon-heart"></div>
      </div>
      <ul class="large-block-grid-4">
          <?php
              $obj->map(array('post_type' => 'post', 'from'=>0,'to'=> 4));
              $recent_posts = $obj->get_all_parents_records();
              
              foreach ($recent_posts as $row){
                  ?>
                  <li title="<?php echo $row['post_name']?>">
                      <a href="post.php?id=<?php echo $row['id']?>">
                          <div class="image"><img src="files/thumb/<?php echo $row['image_name_thumb']?>" /></div>
                          <div class="featured_title"><?php echo $row['post_name']?></div>
                      </a>
                  </li>
          <?php
              }
          ?>
          </ul>
      </section>

    </div>
    
    

    <!-- End Main Content -->
		<?php include "widgets.php";?>
  </div>

  <!-- End Main Content and Sidebar -->

	<?php include"footer.php";?>

</body>
</html>
