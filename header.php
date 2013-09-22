<?php
	require_once('common/config.php');
	require_once 'common/db_connect.php';
	require_once('controller/functions.php');
	$obj = new Functions();
?>

<!DOCTYPE html>
<!--[if IE 8]>    
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title><?php $obj->get_site_title() ?></title>

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/presentation.css">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/relationshiprules.css">

  <link rel="stylesheet" href="css/custom.css">



</head>
<body>

  <!-- Nav Bar -->

  <div class="row">
    <div class="large-12 columns">
      
      
      <nav class="top-bar">
      <ul>
        <!-- Title Area -->
        <li class="name">
          <h1>
            <a href="index.php">
              Relationship Rules
            </a>
          </h1>
        </li>
        <li class="toggle-topbar"><a href="#"></a></li>
      </ul>

      <section>
        <!-- Left Nav Section -->
        <ul class="left">
          <li class="divider hide-for-small"></li>
        </ul>

        <!-- Right Nav Section -->
        <ul class="right">
        	<?php 
				$menu_items = $obj->get_all_menu_records();
				
				foreach ($menu_items as $row) {
					
					?>
                    <li><a href="<?php echo $row['link_url'];?>"><?php echo $row['link_name'];?></a></li>
					<?php
				}
				
			
			?>
          
           
        </ul>
      </section>
    </nav>
    </div>
  </div>

  <!-- End Nav -->

