<?php include "header.php";?>

  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="large-9 columns page" role="content">
            
       <section> 
          <div class="section_title">
              <div>Subscribe</div>
              <div class="icon-heart"></div>
          </div>

		<div>
        	<div class="text">Subscribe to our newsletter and become a part of the immediate family of RR. By subscribing,
you’ll receive:</div>
			<div>
            	<ul class="text">
                	<li class="icon-heart">Daily <span class="title">Relationship Rules</span> straight in your inbox.</li>
                	<li class="icon-heart">Exclusive sneak peaks on upcoming pages.</li>
                	<li class="icon-heart">An exclusive look at the <span style="color:#009591"> “Relationship Rules Book: Vol 1”</span>.</li>
                	<li class="icon-heart"> And much more. It’s all for free.</li>
                </ul>
            </div>
            <div class="text">
            Enter your email address below to become a part of our awesome newsletter. Don’t worry, we hate spam too.
            </div>
            <div>
             <form action="admin/controller/subscribers.php" method="post">
              <div class="row collapse">
                <div class="large-12 ">
                  <input type="text" name="email" style="height:4em" >
                </div>
                <input type="hidden" value="save_record" name="task"  />
                <div class="large-12">
                  <input type="submit" class="button large large-12" value="Sign Me Up">
                </div>
            
          </div>
        </form>

            </div>
            
        </div>

       </section>      

    </div>

    <!-- End Main Content -->
	<?php include "widgets.php";?>
 </div>

  <!-- End Main Content and Sidebar -->

	<?php include"footer.php";?>
 </body>
</html>
