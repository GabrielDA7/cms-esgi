<?php
session_start();
require "bin/conf.inc.php";
require "bin/constants.inc.php";

/* DELETE */
function aaa($var) {
	echo '<pre>';
	var_dump($var);
	echo "</pre>";
	die();
}
function aaaa($var) {
	echo '<pre>';
	var_dump($var);
	echo "</pre>";
}

function isAdmin() {
	return isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;
}

function autoLoadExistingClass($class) {
	$classPath = searchFile(array(MODELS_FOLDER_NAME, CORE_FOLDER_NAME, DELEGATES_FOLDER_NAME), $class.CLASS_EXTENSION);
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
				LogsUtils::process("logs", "Action not found", $actionName . " in " . $controllerName);
				RedirectUtils::redirect404();
			}
		} else {
			LogsUtils::process("logs", "Class not found", $controllerName);
			RedirectUtils::redirect404();
		}
	} else {
		LogsUtils::process("logs", "Controller not found", $controllerPath);
		RedirectUtils::redirect404();
	}
}

function getUriExploded() {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = explode(QUESTION_MARK, $uri);
	$uri = str_ireplace(DIRNAME, '', urldecode($uri[0]));
	$uriExploded = explode(DS, $uri);
	return $uriExploded;
}

spl_autoload_register('autoLoadExistingClass');

$uriExploded = getUriExploded();

$controllerName = getControllerName($uriExploded);
$actionName = getActionName($uriExploded);

if (!INSTALLATION_DONE && $uriExploded[0] != INSTALLATION_INDEX_LINK) {
	$controllerName = "InstallationController";
	$actionName = "indexAction";
}

$uriExploded = array_values($uriExploded);
$params = ["POST" => $_POST, "GET" => $_GET, "FILES" => $_FILES, "URL" => $uriExploded];

getControllerAndAction($controllerName, $actionName, $params);
?>
