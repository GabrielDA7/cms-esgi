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
		if(!isset($params['POST']['submit'])) {
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($datas, USER_ADD_BACK_VIEW, USER_ADD_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
		$user->generateToken();
		$user->insert();
		$view = new View($datas['view'], $datas['template']);
	}

	public function editAction($params) {
		if(!isset($params['POST']['id']) && !isset($_SESSION['userId'])) {
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($datas, USER_EDIT_BACK_VIEW, USER_EDIT_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$id = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
		$user = ClassUtils::constructObjectWithId($id, USER_CLASS_NAME);
		$user = $user->getById();
		$view = new View($datas['view'], $datas['template']);
		$view->assign("user", $user);
	}

	public function updateAction($params) {
		if(!isset($params['POST']['submit'])) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
		$user->unsetRoleIfNotAdmin();
		$user->update();
		header(LOCATION . DIRNAME . (isset($url[2]) && $url[2] === "back") ? USER_LIST_BACK_LINK : "");
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$user = ClassUtils::constructObjectWithId($params['POST']['id'], USER_CLASS_NAME);
		$user->delete();	
		header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_LIST_BACK_VIEW, USER_LIST_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
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
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], USER_LOGIN_BACK_VIEW, USER_LOGIN_FRONT_VIEW, LOGIN_BACK_TEMPLATE, FRONT_TEMPLATE);
		$wrongPassword = false;
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$wrongPassword = $user->login();
		}
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
		$view->assign("wrongPassword", $wrongPassword);
	}

	public function disconnectAction() {
		if (!isset($_SESSION['userId'])) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		header(LOCATION . DIRNAME);
	}
}
?>