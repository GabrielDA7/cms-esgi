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
		$this->objectDelegate = new ObjectDelegate($this->data, PREMIUM_OFFER_CLASS_NAME);
		$this->formDelegate = new FormDelegate(PREMIUM_OFFER_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(PREMIUM_OFFER_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, PREMIUM_OFFER_ADD_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, PREMIUM_OFFER_LIST_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}
}
