<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $datas = array();

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
	}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_ADD_BACK_VIEW, USER_ADD_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
		}
		$view = new View($datas['view'], $datas['template']);
	}

	public function editAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_EDIT_BACK_VIEW, USER_EDIT_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if(isset($params['POST']['id']) || isset($_SESSION['userId'])) {
			$id = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
			$user = ClassUtils::constructObjectWithId($id, USER_CLASS_NAME);
			$user = $user->getById();
			$view = new View($datas['view'], $datas['template']);
			$view->assign("user", $user);
		} else {
			return404View();
		}
	}

	public function updateAction($params) {
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if(isset($params['POST']['edit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->unsetRoleIfNotAdmin();
			$user->update();
			header(LOCATION . DIRNAME . (isset($url[2]) && $url[2] === "back") ? USER_LIST_BACK_LINK : "");
		} else {
			return404View();
		}
	}

	public function deleteAction($params) {
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if(isset($params['POST']['submit']) && $_SESSION['admin'] === TRUE) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user->delete();	
			header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);
		} else {
			return404View();
		}
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_LIST_BACK_VIEW, USER_LIST_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if(isset($params['POST']['submit']) && !ViewUtils::isEmptyPost($params['POST'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$users = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("users", $users);
	}

	public function userAction($params) {
	}

	public function loginAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_LOGIN_BACK_VIEW, USER_LOGIN_FRONT_VIEW, LOGIN_BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		$wrongPassword = false;
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if (isset($_SESSION['userId'])) {
			$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
			$user->disconnect();
			header(LOCATION . DIRNAME);
		} else {
			return404View();
		}
	}
}
?>