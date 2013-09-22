<?php
require 'zebra/Zebra_Database.php';
// create a new database wrapper object
global $db;
$db = new Zebra_Database();

// turn debugging on
$db->debug = true;
        
$db->connect(DBASE_HOST, // host
		     DBASE_USER, // user name
             DBASE_PWD, // password //pepper!
             DBASE_NAME  // database
        );	

?>