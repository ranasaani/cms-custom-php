<?php
	session_start();
	if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
		header("Location:admin");
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Relationship Rules | Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="controller/login.php" method="post">
			<h1>Login</h1>
			<div>
				<input type="email" placeholder="Email" required id="email" name="email" value="ranasaani@gmail.com" />
</div>
			<div>
				<input type="password" placeholder="Password" required id="password" name="password" value="123" />
			</div>
			<div>
				<input type="hidden" name="action" value="login" />
                
				<input type="hidden" name="next" value="<?php if(isset($_GET["next"])) echo $_GET["next"] ;?>" />
                
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
    <?php
    	if(isset($_GET["p"]) && $_GET["p"]=="invalid"){
			echo "<p>You have enteres invalid email or password. Try again</p>";
		}
	?>

</body>
</html>