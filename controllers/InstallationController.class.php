<?php
class InstallationController {

	private $authenticationDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $userDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->formDelegate = new FormDelegate(INSTALLATION_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(INSTALLATION_CLASS_NAME);
		$this->userDelegate = new UserDelegate($this->data);
	}

	public function indexAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, INSTALLATION_INDEX_VIEWS, INSTALLATION_TEMPLATES);
		$view = new View($this->data);
	}


	public function settingAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, INSTALLATION_SETTING_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST'], INSTALLATION_ADMIN_LINK);
		$view = new View($this->data);
	}


	public function databaseAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, INSTALLATION_DATABASE_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST'], INSTALLATION_CREATE_DATABASE_LINK);
		$view = new View($this->data);
	}

	public function adminAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, INSTALLATION_ADMIN_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->userDelegate->add($this->data, $params, FALSE);
		$this->fileDelegate->setting($this->data, $params['POST'], USER_LOGIN_BACK_LINK);
		$view = new View($this->data);
	}

	public function createdatabaseAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->fileDelegate->createDatabase();
	}
}
