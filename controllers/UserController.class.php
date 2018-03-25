<?php
class UserController {

	public function __construct() {}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
		}
		$view = new View("registerUser","front");
	}

	public function editAction($params) {
		if(isset($params['POST']['edit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->update();
			header('Location:' . DIRNAME . USER_LIST_LINK);		
		} else if(isset($params['POST']['id'])) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user = $user->getById();
			$view = new View("edit","front");
			$view->assign("user" ,$user);
		} else {
			return404View();
		}
	}

	public function deleteAction($params) {
		extract($params['POST']);
		$user = ClassUtils::constructObjectWithId($id, USER_CLASS_NAME);
		$user->delete();	
		header('Location:' . DIRNAME . USER_LIST_LINK);
	}

	public function listAction($params) {
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$view = new View("listUsers","front");
		$view->assign("users" ,$users);
	}

	public function loginAction($params) {
		$wrongPassword = false;
		if (isset($params['POST']['submit'])) {
			extract($params['POST']);
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$view = new View("loginUser","front");
		$view->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		session_destroy();
		header('Location:' . DIRNAME);
	}
}
?>