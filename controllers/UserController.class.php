<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $datas = array();

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
	}

	public function indexAction($params) {}

	public function userAction($params) {
		if(!isset($params['POST']['id']) && !isset($_SESSION['userId'])) {
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($datas, USER_EDIT_BACK_VIEW, USER_EDIT_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$this->objectDelegate->pushObjectById($datas, $params, USER_CLASS_NAME);
		$view = new View($datas['view'], $datas['template']);
		$view->assign("user", $datas['object']);
	}

	public function addAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_ADD_BACK_VIEW, USER_ADD_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);

		$config = User::configFormAdd();
		$errors = [];
		if(isset($params['POST']['submit'])) {
			$errors = Validate::checkForm($config, $params["POST"]);
			if(empty($errors)) {
				$this->objectDelegate->add($params, USER_CLASS_NAME);
			}
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("config", $config);
		$view->assign("errors", $errors);
	}

	public function editAction($params) {
		if(!isset($params['POST']['submit'])) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$this->objectDelegate->update($params, USER_CLASS_NAME);
		header(LOCATION . DIRNAME . (isset($url[2]) && $url[2] === "back") ? USER_LIST_BACK_LINK : "");
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$this->objectDelegate->delete($params, USER_CLASS_NAME);
		header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_LIST_BACK_VIEW, USER_LIST_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params, TRUE);
		if(isset($params['POST']['submit']) && !ViewUtils::isEmptyPost($params['POST'])) {
			$this->objectDelegate->pushObjectsByParameters($datas, $params, USER_CLASS_NAME);
		} else {
			$this->objectDelegate->pushAllObjects($datas, $params, USER_CLASS_NAME);
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("users", $datas['objects']);
	}

	public function loginAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, USER_LOGIN_BACK_VIEW, USER_LOGIN_FRONT_VIEW, LOGIN_BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		if (isset($params['POST']['submit'])) {
			$this->objectDelegate->login($datas, $params);
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("wrongPassword", (isset($datas['wrongPassword']) ? $datas['wrongPassword'] : FALSE));
	}

	public function disconnectAction($params) {
		if (!isset($_SESSION['userId'])) {
			return404View();
		}
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$this->objectDelegate->disconnect($datas, $params);
		header(LOCATION . DIRNAME);
	}
}
?>
