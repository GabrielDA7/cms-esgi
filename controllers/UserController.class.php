<?php
class UserController{

	public function __construct(){}

	public function indexAction($params){
	}
	
	public function addAction($params){
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
		}
		$v = new View("registerUser","front");
	}

	public function editAction($params){
		$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
		$user->update();	
		header('Location: list');	
	}

	public function deleteAction($params) {
		extract($params['POST']);
		$user = ClassUtils::constructObjectWithId($id, USER_CLASS_NAME);
		$user->delete();	
		header('Location: list');
	}

	public function userAction($params) {
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user = $user->getById();
		}
		$v = new View("user","front");
		$v->assign("user" ,$user);
	}

	public function listAction($params){
		if(isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$v = new View("listUsers","front");
		$v->assign("users" ,$users);
	}

	public function loginAction($params) {
		$wrongPassword = false;
		if(isset($params['POST']['submit'])) {
			extract($params['POST']);
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$v = new View("loginUser","front");
		$v->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		session_destroy();
		header('Location: '.DIRNAME);
	}
}
?>