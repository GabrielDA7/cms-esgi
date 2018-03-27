<?php
session_start();
require "constants.inc.php";
require "conf.inc.php";

function autoLoadExistingClass($class) {
	$classPath = searchFile(array(MODELS_FOLDER_NAME, CORE_FOLDER_NAME), $class.CLASS_EXTENSION);
	if(isset($classPath)) {
		include $classPath;
	}
}

function searchFile($dirs, $file_to_search) {
	foreach ($dirs as $dir) {
		$files = scandir($dir);
		foreach ($files as $key => $value) {
			$path = realpath($dir.DS.$value);
			if (!is_dir($path)) {
				if($file_to_search == $value) {
					return $path;
				}
			} else if ($value != DOT && $value != DOUBLE_DOT) {
				$path = searchFile(array($path), $file_to_search);
				if (isset($path)) {
					return $path;
				}
			}
		}
	}
}

function getControllerName($uriExploded) {
	$controllerName = (empty($uriExploded[0]))?INDEX_LABEL:$uriExploded[0];
	$controllerName = ucfirst(strtolower($controllerName)).CONTROLLER_LABEL;
	return $controllerName;
}

function getActionName($uriExploded) {
	$actionName = (empty($uriExploded[1]))?INDEX_LABEL:$uriExploded[1];
	$actionName = strtolower($actionName).ACTION_LABEL;
	return $actionName;
}

function getControllerAndAction($controllerName, $actionName, $params) {
	$controllerPath = searchFile(array(CONTROLLERS_FOLDER_NAME), $controllerName.CLASS_EXTENSION);
	if (isset($controllerPath)) {
		include $controllerPath;
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
	$uri = explode(QUESTION_MARK, $uri);
	$uri = str_ireplace(DIRNAME, '', urldecode($uri[0]));
	$uriExploded = explode(DS, $uri);
	return $uriExploded;
}

function return404View() {
	header(LOCATION . DIRNAME . INDEX_ERROR_LINK);
}

spl_autoload_register('autoLoadExistingClass');

$uriExploded = getUriExploded();

$controllerName = getControllerName($uriExploded);
$actionName = getActionName($uriExploded);
$uriExploded = array_values($uriExploded);

$params = ["POST" => $_POST, "GET"=>$_GET, "URL"=>$uriExploded];

getControllerAndAction($controllerName, $actionName, $params);
?>
