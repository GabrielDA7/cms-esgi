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
		ViewUtils::setPossiblesViewsTemplates($data, INSTALLATION_INDEX_VIEW, INSTALLATION_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$view = new View($data);
	}

	public function settingAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, INSTALLATION_SETTING_VIEW, INSTALLATION_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, INSTALLATION_CLASS_NAME);
		$this->fileDelegate->setting($data, $params['POST'], INSTALLATION_CLASS_NAME, INSTALLATION_DATABASE_LINK);
		$view = new View($data);
	}

	public function databaseAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, INSTALLATION_DATABASE_VIEW, INSTALLATION_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, INSTALLATION_CLASS_NAME);
		$this->fileDelegate->setting($data, $params, INSTALLATION_CLASS_NAME, INSTALLATION_CREATE_DATABASE_LINK);
		$view = new View($data);
	}

	public function adminAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, INSTALLATION_ADMIN_VIEW, INSTALLATION_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
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