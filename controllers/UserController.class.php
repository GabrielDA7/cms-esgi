<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, USER_CLASS_NAME);
		$this->formDelegate = new FormDelegate(USER_CLASS_NAME);
		$this->emailDelegate = new EmailDelegate();
		$this->fileDelegate = new FileDelegate(USER_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(USER_CLASS_NAME);
	}

	public function indexAction($params) {}

	public function userAction($params) {
		if (!isset($params['POST']['id']) && !isset($_SESSION['userId'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_USER_VIEWS);
		$this->objectDelegate->getById($this->data, $params['POST']['id']);
		$view = new View($this->data);
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if((!isset($params['POST']['id']) || !$_SESSION['admin'])  && !isset($_SESSION['userId'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, USER_EDIT_VIEWS);
		$this->objectDelegate->getById($this->data, $params);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params, "", USER_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->objectDelegate->delete($params, "", USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, USER_LIST_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function loginAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_LOGIN_VIEWS, LOGIN_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->login($this->data, $params);
		$view = new View($this->data);
	}

	public function disconnectAction($params) {
		if (!isset($_SESSION['userId'])) {
			RedirectUtils::redirect404();
		}
		$this->objectDelegate->disconnect($this->data, $params);
	}

	public function emailConfirmAction($params) {
		if (!isset($params['GET']['id']) || !isset($params['GET']['emailConfirm']) || !isset($params['GET']['email'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		if (isset($params['GET']['id']) && isset($params['GET']['emailConfirm'])) {
			$this->emailDelegate->checkEmailConfirmation($params);
		} else {
			$this->emailDelegate->sendEmailConfirmation();
		}
	}

	public function passwordResetAction($params) {
		if (!isset($params['GET']['passwordReset']) || !isset($params['POST']['email']) || !isset($params['POST']['pwd'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		if (isset($params['POST']['email'])) {
			$this->emailDelegate->sendPasswordReset($data);
			$this->objectDelegate->update($this->data, $params, "", USER_LOGIN_FRONT_LINK);
		} else if (isset($params['POST']['idUser'])) {
			$this->formDelegate->process($this->data, $params);
			$this->emailDelegate->checkPasswordReset($data);
		} else {
			$this->authenticationDelegate->process($this->data, $params, FALSE, USER_PASSWORD_RESET_VIEWS);
			$view = new View($this->data);
		}
	}
}
?>
