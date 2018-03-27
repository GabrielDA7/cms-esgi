<?php

define("DBUSER","root");
define("DBPWD","");
define("DBHOST","localhost");
define("DBNAME","projet_annuel");
define("DBPORT","3306");

$scriptName=(dirname($_SERVER["SCRIPT_NAME"]) == DS)?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
