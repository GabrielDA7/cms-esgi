<?php
class PremiumofferController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $listDisplayDataDelegate;
	private $siteInfosDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, PREMIUMOFFER_CLASS_NAME);
		$this->formDelegate = new FormDelegate(PREMIUMOFFER_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(PREMIUMOFFER_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, PREMIUMOFFER_ADD_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, PREMIUMOFFER_EDIT_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params, "", PREMIUMOFFER_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->objectDelegate->delete($params, "", CHAPTER_LIST_BACK_LINK);
	}

	public function publishAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE);
		$this->data['errors'] = FALSE;
		$this->objectDelegate->update($this->data, $params, null);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);
	}


	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, PREMIUMOFFER_LIST_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}
}
