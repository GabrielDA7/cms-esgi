<?php
class InstallationController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, INSTALLATION_CLASS_NAME);
		$this->formDelegate = new FormDelegate(INSTALLATION_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(INSTALLATION_CLASS_NAMEs);
	}

	public function indexAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, INSTALLATION_INDEX_VIEWS, INSTALLATION_TEMPLATES);
		$view = new View($this->data);
	}

	public function settingAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, INSTALLATION_SETTING_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST'], INSTALLATION_DATABASE_LINK);
		$view = new View($this->data);
	}

	public function this->databaseAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, INSTALLATION_DATABASE_VIEWS, INSTALLATION_TEMPLATES);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params, INSTALLATION_CREATE_DATABASE_LINK);
		$view = new View($this->data);
	}

	public function adminAction($params) {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, INSTALLATION_ADMIN_VIEWS, INSTALLATION_TEMPLATES);
		$this->setClassNameToUserToAddAdmin();
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$this->fileDelegate->setting($this->data, $params, USER_LOGIN_BACK_LINK);
		$view = new View($this->data);
	}

	public function createthis->databaseAction() {
		if (INSTALLATION_DONE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->fileDelegate->createthis->database();
	}

	private function setClassNameToUserToAddAdmin() {
		$this->formDelegate->setObjectName(USER_CLASS_NAME);
		$this->objectDelegate->setObjectName(USER_CLASS_NAME);
	}
}
?>
