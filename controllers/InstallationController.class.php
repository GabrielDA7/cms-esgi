<?php
class InstallationController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
		$this->formDelegate = new FormDelegate();
		$this->fileDelegate = new FileDelegate();
	}

	public function indexAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, INSTALLATION_INDEX_VIEWS, INSTALLATION_TEMPLATES);
		$view = new View($data);
	}

	public function settingAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, INSTALLATION_SETTING_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($data, $params, INSTALLATION_CLASS_NAME);
		$this->fileDelegate->setting($data, $params['POST'], INSTALLATION_CLASS_NAME, INSTALLATION_DATABASE_LINK);
		$view = new View($data);
	}

	public function databaseAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, INSTALLATION_DATABASE_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($data, $params, INSTALLATION_CLASS_NAME);
		$this->fileDelegate->setting($data, $params, INSTALLATION_CLASS_NAME, INSTALLATION_CREATE_DATABASE_LINK);
		$view = new View($data);
	}

	public function adminAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, INSTALLATION_ADMIN_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($data, $params, INSTALLATION_CLASS_NAME);
		$this->objectDelegate->add($data, $params, USER_CLASS_NAME);
		$this->fileDelegate->setting($data, $params, INSTALLATION_CLASS_NAME, USER_LOGIN_BACK_LINK);
		$view = new View($data);
	}

	public function createdatabaseAction() {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->fileDelegate->createdatabase();
	}
}
?>