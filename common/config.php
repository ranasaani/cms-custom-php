<?php
// Switches
define("SITE_NAME", "Relation Rules");
define("DBASE_NAME", "relationrules");
define("DBASE_HOST", "localhost");
define("DBASE_PORT", 3306);
define("DBASE_USER", "root");
define("DBASE_PWD", "");
define("SHOW_FEATURED_POSTS", 0);

define("BASE_URL", "localhost/cms-custom");

define("CONTAC_US_EMAIL", "xx@abc.com");
define("SEND_RULE_EMAIL", "xx@abc.com");
define("ADMIN_EMAIL", 	"xx@abc.com");


global $SMTP_CONFIG;
$SMTP_CONFIG=array();
$SMTP_CONFIG['host']=''; // SMTP Host
$SMTP_CONFIG['smtp_user']=''; // email
$SMTP_CONFIG['smtp_password']='';// pwd
$SMTP_CONFIG['auth']= true;
$SMTP_CONFIG['port']='465';
$SMTP_CONFIG['smtp_secure']='ssl';
$SMTP_CONFIG['from_email']=''; // from address
$SMTP_CONFIG['from_name']='';// from name

?>