<?php
class InstallationController {

	private $authenticationDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $userDelegate;
	private $objectDelegate;
	private $siteInfosDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->formDelegate = new FormDelegate(INSTALLATION_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(INSTALLATION_CLASS_NAME);
		$this->objectDelegate = new ObjectDelegate($this->data, INSTALLATION_CLASS_NAME);
		$this->userDelegate = new UserDelegate($this->data);
		$this->siteInfosDelegate = new SiteInfosDelegate();
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
		$this->objectDelegate->add($this->data, $params, INSTALLATION_ADMIN_LINK);
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
		$this->userDelegate->addAdmin($this->data, $params);
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

	public function parametersAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, INSTALLATION_PARAMETER_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getAll($this->data, $params);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params);
		$view = new View($this->data);
	}

	public function editdatabaseAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, INSTALLATION_EDIT_DATABASE_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST']);
		$view = new View($this->data);
	}
}
