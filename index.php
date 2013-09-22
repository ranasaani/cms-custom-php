<?php include "header.php";?>

  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="large-9 columns featured_posts" role="content">
      <?php 
	  if(SHOW_FEATURED_POSTS){
		?>
        <section style="margin-bottom:50px">
            <div class="section_title">
              <div >Featured Posts</div>
              <div class="icon-heart"></div>
          </div>
		 <ul class="large-block-grid-4">
		<?php
              $obj->map(array('post_type' => 'post', 'from'=>0,'to'=> 4));
              $featured_posts = $obj->get_all_featured_records();
              foreach ($featured_posts as $row){
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

			  <?php
	  	}
	  
	  ?>
     

            
       <section> 
          <div class="section_title">
              <div>ARTICLES BY US</div>
              <div class="icon-heart"></div>
          </div>

          <?php
		  	  $show_posts = 4;
			  $from = 0;
			  if(isset($_GET['page']) && $_GET['page']!='' && $_GET['page'] >= 0){$from = $_GET['page'] * $show_posts;}
              $obj->map(array('post_type' => 'post', 'from'=>$from,'to'=> $show_posts));
              $article_posts = $obj->get_all_parents_records();
              
              foreach ($article_posts as $row){
                  ?>
                  <article>
                  	<div class="row">
                              <div class=" large-4 columns image thumbs"><img src="files/thumb/<?php echo $row['image_name_thumb']?>" /></div>
                              <div class=" large-8 columns post_title">
                              	<div class="title">
							  		<h3><?php echo $row['post_name'];?></h3>
                                 </div>
                                 <div class="description">
                                 	<p>
										<?php echo substr( $row['post_content'], 0,420)." ...."; ?>
                                     </p>
                                     <a href="post.php?id=<?php echo $row['id']?>" class="button">Read More </a>
                                    
                                 </div>
                                 
                                </div>
                         
                      </div>
                  </article>
          <?php
              }
			  $total_posts = $obj->get_all_posts_count();
			  $pages = (integer)($total_posts['count']/$show_posts)+1;
			  for ($i = 0 ; $i <$pages; $i++ ){
				  ?>
				  <a href="index.php?page=<?php echo $i?>" class="navigation button"><?php echo $i+1?></a>
				  <?php
			  }
			  
              
          ?>
       
       
       </section>      

    </div>

    <!-- End Main Content -->
	<?php include "widgets.php";?>
 </div>

  <!-- End Main Content and Sidebar -->

	<?php include"footer.php";?>
 </body>
</html>
