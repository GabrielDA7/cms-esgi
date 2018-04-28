<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $fileDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
		$this->formDelegate = new FormDelegate();
		$this->emailDelegate = new EmailDelegate();
		$this->fileDelegate = new FileDelegate();
	}

	public function indexAction($params) {}

	public function userAction($params) {
		if (!isset($params['POST']['id']) && !isset($_SESSION['userId'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, USER_USER_VIEWS);
		$this->objectDelegate->pushObjectById($data, $params['POST']['id'], USER_CLASS_NAME);
		$view = new View($data);
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, USER_ADD_VIEWS);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->add($data, $params, USER_CLASS_NAME);
		$this->emailDelegate->sendMail($data);
		$view = new View($data);
	}

	public function editAction($params) {
		if((!isset($params['POST']['id']) || $_SESSION['admin'] !== TRUE)  && !isset($_SESSION['userId'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE, USER_EDIT_VIEWS);
		$this->objectDelegate->pushObjectById($data, $params['POST']['id'], USER_CLASS_NAME);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->fileDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->update($data, $params, USER_CLASS_NAME, "", USER_LIST_BACK_LINK);
		$view = new View($data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, USER_CLASS_NAME, "", USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($data, $params, TRUE, USER_LIST_VIEWS);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->listAll($data, $params, USER_CLASS_NAME);
		$view = new View($data);
	}

	public function loginAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, USER_LOGIN_VIEWS, LOGIN_TEMPLATES);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->login($data, $params);
		$view = new View($data);
	}

	public function disconnectAction($params) {
		if (!isset($_SESSION['userId'])) {
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->disconnect($data, $params);
	}

	public function emailAction($params) {
		if (!isset($params['GET']['id']) || !isset($params['GET']['emailConfirm'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->emailDelegate->checkEmailConfirmation($params);
	}
}
?>
