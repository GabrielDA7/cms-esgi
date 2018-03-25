<?php
session_start();
require "conf.inc.php";
require "constants.inc.php";

function myAutoloader($class){
	$class = $class .".class.php";
	if( file_exists("core/".$class) ){
		include "core/".$class;
	}else if( file_exists( "models/".$class)){
		include "models/".$class;
	}
}

function getControllerName($uriExploded) {
	$controllerName = (empty($uriExploded[0]))?"index":$uriExploded[0];
	$controllerName = ucfirst(strtolower($controllerName))."Controller";
	return $controllerName;
}

function getActionName($uriExploded) {
	$actionName = (empty($uriExploded[1]))?"index":$uriExploded[1];
	$actionName = strtolower($actionName)."Action";
	return $actionName;
}

function removeActionAndControllerFromUri(&$uriExploded) {
	unset($uriExploded[0]);
	unset($uriExploded[1]);
}

function getControllerAndAction($controllerName, $actionName, $params) {
	if (file_exists("controllers/".$controllerName.".class.php")) {
		include("controllers/".$controllerName.".class.php");
		if (class_exists($controllerName)) {
			$controller = new $controllerName();
			if (method_exists($controller, $actionName)) {
				$controller->$actionName($params);
			} else {
				return404View();
			}
		} else {
			return404View();
		}
	} else {
		return404View();
	}
}

function getUriExploded() {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = explode("?", $uri);
	$uri = str_ireplace(DIRNAME, "", urldecode($uri[0]));
	$uriExploded = explode(DS, $uri);
	return $uriExploded;
}

function return404View() {
	header('Location: '.DIRNAME.'index/error');
}

spl_autoload_register('myAutoloader');

$uriExploded = getUriExploded();

$controllerName = getControllerName($uriExploded);
$actionName = getActionName($uriExploded);

$uriExploded = array_values($uriExploded);

$params = ["POST" => $_POST, "GET"=>$_GET, "URL"=>$uriExploded];

getControllerAndAction($controllerName, $actionName, $params);
?>













