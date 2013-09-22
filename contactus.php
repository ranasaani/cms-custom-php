<?php include "header.php";?>

  <!-- Main Page Content and Sidebar -->

  <div class="row">

    <!-- Main Blog Content -->
    <div class="large-9 columns page" role="content">
            
       <section> 
          <div class="section_title">
              <div>Contact Us</div>
              <div class="icon-heart"></div>
          </div>

		<div>
        	<div class="text">Contact the team behind Relationship Rules. For general queries, suggestions and generally
anything.</div>	
           <div>
             <form action="controller/send_email.php" method="post">
              <div class="row">
                <div class="large-2 column">
                  <h3>Name:</h3>
                </div>
            
                <div class="large-10 column ">
                  <input type="text" name="name" required>
                </div>
          </div>
          <div class="row">
                <div class="large-2 column">
                  <h3>Email:</h3>
                </div>
            
                <div class="large-10 column ">
                  <input type="text" name="email" required>
                </div>
          </div>
          <div class="row">
                <div class="large-2 column">
                  <h3>Message:</h3>
                </div>
            
                <div class="large-10 column ">
                  <textarea  name="message" required></textarea>
                </div>
          </div>
          <div class="row">
                <div class="large-2 column ">
                </div>
                <div class="large-10 column">
                	<input type="hidden" name="action" value="contactus" />
                	<input type="submit" value="Send" class="button large-12 large " />
        	<div class="text">If you hate filling forms, email us on the email address below:</div>
            <a href="mailto:contact@relationshiprules.co" class="text"><span class="title">contact</span>@relationshiprules.co</a>
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
