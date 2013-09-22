<?php include"session.php";?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">

<title>Admin Panel</title>
<link rel="stylesheet" href="../css/foundation.css">

<link rel="stylesheet" href="../css/relationshiprules.css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="../css/relationshiprules-ie7.css"><![endif]-->
</head>

<nav class="top-bar hide-for-small" style="">
      <ul class="title-area">
        <!-- Title Area -->
        <li class="name">
          <h1><a href="">Relation Rules | Admin Panel</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      
    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="divider"></li>
          <li class=""><a href="cms/menus.php">Menus</a></li>
          <li class="divider"></li>
          <li class=""><a href="cms/pages.php">Pages</a></li>
          <li class="divider"></li>
          <li class=""><a href="cms/categories.php">Categories</a></li>
          <li class="divider"></li>
          <li class=""><a href="cms/posts/">Posts</a></li>
          <li class="divider"></li>
          <li> <a href="">Hello <?php echo $_SESSION['user']['name']?> </a></li>
          <li class="has-form">
          	<form method="post" action="../controller/login.php">
            	<input type="hidden" name="action" value="logout">
            	<input type="submit" class="button icon-logout-1" value="Logout">
            </form>
          </li>
        </ul>
      </section></nav>
      
      <body>
