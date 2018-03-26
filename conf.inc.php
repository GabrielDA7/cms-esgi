<?php

define("DBUSER","root");
define("DBPWD","gd78$#Ogc");
define("DBHOST","localhost");
define("DBNAME","projet_annuel");
define("DBPORT","3306");


define("DS", "/");
$scriptName=(dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
