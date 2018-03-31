<?php 
define("INSTALLATION_DONE", FALSE); 

define("LANGUAGE","french"); 
define("INSTALATION_TEMPLATE", "installation");
define("FRONT_TEMPLATE", "defaultFront");
define("BACK_TEMPLATE", "defaultBack");
define("LOGIN_DASHBORD_TEMPLATE", "loginDashboard");

define("DBUSER","root"); 
define("DBPWD",""); 
define("DBHOST","localhost"); 
define("DBNAME","projet_annuel"); 
define("DBPORT","3306"); 
 
$scriptName=(dirname($_SERVER["SCRIPT_NAME"]) == DS)?"":dirname($_SERVER["SCRIPT_NAME"]); 
define("DIRNAME", $scriptName.DS); 
?>