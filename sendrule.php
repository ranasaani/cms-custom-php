<?php include "header.php";?>

  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="large-9 columns page" role="content">
            
       <section> 
          <div class="section_title">
              <div>SUBMIT A RULE</div>
              <div class="icon-heart"></div>
          </div>

		<div>
        	<div class="text">Submit your very own <span class="title">Relationship Rule</span> by using the nifty form below. Make sure to keep it original
to increase the chances of it being published on our page along with your name on it.</div>	
           <div>
             <form action="controller/send_email.php" method="post">
              <div class="row">
                <div class="large-2 column">
                  <h3>Name</h3>
                </div>
            
                <div class="large-10 column ">
                  <input type="text" name="name">
                </div>
          </div>
          <div class="row">
                <div class="large-2 column">
                  <h3>Email</h3>
                </div>
            
                <div class="large-10 column ">
                  <input type="text" name="email">
                </div>
          </div>
          <div class="row">
                <div class="large-2 column">
                  <h3>Message</h3>
                </div>
            
                <div class="large-10 column ">
                  <textarea  name="message"></textarea>
                </div>
          </div>
          <div class="row">
                <div class="large-2 column ">
                </div>
                <div class="large-10 column">
                	<input type="hidden" name="action" value="sendrule" />
                	<input type="submit" value="Send" class="button large-12 large " />
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
