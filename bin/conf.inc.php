<?php
define("INSTALLATION_DONE", TRUE);

define("LANGUAGE","french");
define("INSTALLATION_TEMPLATE", "installation");
define("FRONT_TEMPLATE", "defaultFront");
define("BACK_TEMPLATE", "defaultBack");
define("LOGIN_BACK_TEMPLATE", "loginDashboard");

define("DBUSER","root");
define("DBPWD","gd78$#Ogc");
define("DBHOST","localhost");
define("DBNAME","uteach");
define("DBPORT","3306");

$scriptName=(dirname($_SERVER["SCRIPT_NAME"]) == DS)?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
?>
