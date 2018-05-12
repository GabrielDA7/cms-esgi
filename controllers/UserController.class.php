<?php
include "core/interfaces/ControllerInterface.php";
class UserController implements ControllerInterface {

	private $authenticationDelegate;
	private $userDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->userDelegate = new UserDelegate($this->data);
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
		$this->userDelegate->getById($this->data, $params);
		$view = new View($this->data);
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->userDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if((!isset($params['POST']['id']) || !$_SESSION['admin'])  && !isset($_SESSION['userId'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, USER_EDIT_VIEWS);
		$this->userDelegate->getById($this->data, $params);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params);
		$this->userDelegate->update($this->data, $params, "", USER_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->userDelegate->delete($params, "", USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, USER_LIST_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function loginAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_LOGIN_VIEWS, LOGIN_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->userDelegate->login($this->data, $params);
		$view = new View($this->data);
	}

	public function disconnectAction($params) {
		if (!isset($_SESSION['userId'])) {
			RedirectUtils::redirect404();
		}
		$this->userDelegate->disconnect($this->data, $params);
	}

	public function emailConfirmAction($params) {
		if ((!isset($params['POST']['id']) || !isset($params['POST']['emailConfirm'])) && !isset($params['GET']['email'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		if (isset($params['POST']['id']) && isset($params['POST']['emailConfirm'])) {
			$this->userDelegate->checkEmailConfirmation($this->data, $params);
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_CONFIRMATION_EMAIL_VIEWS);
		$this->userDelegate->getByParameters($this->data, $params['GET']);
		$this->emailDelegate->sendEmailConfirmation($this->data);
		$view = new View($this->data);
	}

	public function passwordResetEmailAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, USER_PASSWORD_RESET_EMAIL_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$view = new View($this->data);
	}

	public function passwordResetAction($params) {
		if ((!isset($params['POST']['id']) || !isset($params['POST']['pwdReset'])) && !isset($params['POST']['email']) ) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		if (isset($params['POST']['email'])) {
			$this->authenticationDelegate->process($this->data, $params, FALSE, USER_CONFIRMATION_PASSWORD_RESET_EMAIL_VIEWS);
			$this->userDelegate->getByParameters($this->data, $params['POST']);
			$this->emailDelegate->sendPasswordReset($this->data);
			$this->userDelegate->update($this->data, $params);
			$view = new View($this->data);
		} else {
			$this->authenticationDelegate->process($this->data, $params, FALSE, USER_PASSWORD_RESET_VIEWS);
			$this->formDelegate->process($this->data, $params);
			$this->userDelegate->checkPasswordReset($this->data, $params);
			$view = new View($this->data);
		}
	}
}
?>
