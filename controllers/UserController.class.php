<?php
include "core/ControllerInterface.php";
class UserController implements ControllerInterface {

	public function __construct() {}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		$viewName = ControllerUtils::isBackOfficeView($params['URL'], USER_ADD_BACK_VIEW, USER_ADD_FRONT_VIEW);
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
		}
		$view = new View($viewName, DEFAULT_TEMPLATE);
	}

	public function editAction($params) {
		if(isset($params['POST']['edit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->update();
			header(LOCATION . DIRNAME . USER_LIST_LINK);		
		} else if(isset($params['POST']['id'])) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user = $user->getById();
			$view = new View(USER_EDIT_FRONT_VIEW, DEFAULT_TEMPLATE);
			$view->assign("user" ,$user);
		} else {
			return404View();
		}
	}

	public function deleteAction($params) {
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user->delete();	
			header(LOCATION . DIRNAME . USER_LIST_LINK);
		} else {
			return404View();
		}
	}

	public function listAction($params) {
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$view = new View(USER_LIST_FRONT_VIEW, DEFAULT_TEMPLATE);
		$view->assign("users" ,$users);
	}

	public function loginAction($params) {
		$wrongPassword = false;
		if (isset($params['POST']['submit'])) {
			extract($params['POST']);
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$view = new View(USER_LOGIN_FRONT_VIEW, DEFAULT_TEMPLATE);
		$view->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		session_destroy();
		header(LOCATION . DIRNAME);
	}
}
?>