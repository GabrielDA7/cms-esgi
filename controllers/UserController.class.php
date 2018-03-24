<?php
class UserController{

	public function indexAction($params){
		
	}
	
	public function addAction($params){
		if(isset($params['POST']['submit'])) {
			extract($params['POST']);
			$date = new DateTime();
			$user = User::constructWithParameters($userName, $name, $firstName, $email, $age, $pwd, $date->format('Y-m-d H:i:s'), 0);
			$user->generateToken();
			$user->insert();
		}
		$v = new View("registerUser","front");
	}

	public function loginAction($params) {
		$wrongPassword = false;
		if(isset($params['POST']['submit'])) {
			extract($params['POST']);
			$user = new User();
			$user->setUserName($userName);
			$user->setPwd($pwd);
			$wrongPassword = $user->login();
		}
		$v = new View("loginUser","front");
		$v->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		session_destroy();
		header('Location: '.DIRNAME);
	}

	public function listAction($params){
		if(isset($params['POST']['submit'])) {
			extract($params['POST']);
			$user = User::constructWithParameters($userName, $name, $firstName, $email, $age, $pwd, $dateInserted, $status);
			$user = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$v = new View("listUsers","front");
		$v->assign("users" ,$users);
	}

	/*public function editAction($params){
		$user = new User();
		extract($params['POST']);
		$user->setId($id);
		$user->save();	
		header('Location: list');	
	}*/

	public function deleteAction($params) {
		$user = new User();
		extract($params['POST']);
		$user->setId($id);
		$user->delete();	
		header('Location: list');
	}
}
?>