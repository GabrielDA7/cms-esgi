<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
		$this->formDelegate = new FormDelegate();
	}

	public function indexAction($params) {}

	public function addAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, USER_ADD_FRONT_VIEW, FRONT_TEMPLATE, USER_ADD_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->add($params, USER_CLASS_NAME);
		$view = new View($data);
	}

	public function editAction($params) {
		if(!isset($params['POST']['submit']) && !isset($params['POST']['id']) && !isset($_SESSION['userId'])) {
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, USER_EDIT_FRONT_VIEW, FRONT_TEMPLATE, USER_EDIT_BACK_VIEW , BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->update($data, $params, USER_CLASS_NAME, "", USER_LIST_BACK_LINK);
		$view = new View($data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, USER_CLASS_NAME);
		header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, USER_LIST_FRONT_VIEW, FRONT_TEMPLATE, USER_LIST_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->list($data, $params, USER_CLASS_NAME);
		$view = new View($data);
	}

	public function loginAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, USER_LOGIN_FRONT_VIEW, FRONT_TEMPLATE, USER_LOGIN_BACK_VIEW, LOGIN_BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->login($data, $params);
		$view = new View($data);
	}

	public function disconnectAction($params) {
		if (!isset($_SESSION['userId'])) {
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->disconnect($datas, $params);
		header(LOCATION . DIRNAME);
	}
}
?>
