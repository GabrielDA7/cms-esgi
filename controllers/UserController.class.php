<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	public function __construct() {}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_ADD_BACK_VIEW, USER_ADD_FRONT_VIEW, DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
		}
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
	}

	public function editAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_EDIT_BACK_VIEW, USER_EDIT_FRONT_VIEW, DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		if(isset($params['POST']['edit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->unsetRoleIfNotAdmin();
			$user->update();
			header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);		
		} else if(isset($params['POST']['id']) || isset($_SESSION['userId'])) {
			$id = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
			$user = ClassUtils::constructObjectWithId($id, USER_CLASS_NAME);
			$user = $user->getById();
			$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
			$view->assign("user", $user);
		} else {
			return404View();
		}
	}

	public function deleteAction($params) {
		if(isset($params['POST']['submit']) && $_SESSION['admin'] === TRUE) {
			$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
			$user->delete();	
			header(LOCATION . DIRNAME . USER_LIST_LINK);
		} else {
			return404View();
		}
	}

	public function listAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_LIST_BACK_VIEW, USER_LIST_FRONT_VIEW, DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		if(isset($params['POST']['submit']) && !ViewUtils::isEmptyPost($params['POST'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$users = $user->getWithParameters();
		} else {
			$user  = new User();
			$users = $user->getAll();
		}
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
		$view->assign("users", $users);
	}

	public function userAction($params) {
	}

	public function loginAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_LOGIN_BACK_VIEW, USER_LOGIN_FRONT_VIEW, LOGIN_DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		$wrongPassword = false;
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
		$view->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
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