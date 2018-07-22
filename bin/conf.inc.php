<?php
define("INSTALLATION_DONE", TRUE);

define("LANGUAGE","fr");
define("INSTALLATION_TEMPLATE", "installation");
define("FRONT_TEMPLATE", "defaultFront");
define("BACK_TEMPLATE", "defaultBack");
define("LOGIN_BACK_TEMPLATE", "loginDashboard");

define("PAYPAL_CLIENT_ID", "AaQZwovZxW8pepqI1pOYSFOBt6QVadSls7cjwQ8Y3cTOZffIiM19Vb1SgnkNHIWsGl87o4bz31M4Rb7y"); 
define("PAYPAL_SECRET", "EEuXx0qx4z9skUVQ_g99f9bp486j0SIyaqUqrtm1lO1ipiBjknjDW0KgPm9u37CtlNwCqLICQNctso2A"); 

define("DBUSER","root");
define("DBPWD","");
define("DBHOST","localhost");
define("DBNAME","uteach");
define("DBPORT","3306");

define("PAYPAL_CLIENT_ID", "AaQZwovZxW8pepqI1pOYSFOBt6QVadSls7cjwQ8Y3cTOZffIiM19Vb1SgnkNHIWsGl87o4bz31M4Rb7y");
define("PAYPAL_SECRET", "EEuXx0qx4z9skUVQ_g99f9bp486j0SIyaqUqrtm1lO1ipiBjknjDW0KgPm9u37CtlNwCqLICQNctso2A");

define("DS", "/");
$scriptName=(dirname($_SERVER["SCRIPT_NAME"]) == DS)?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);
