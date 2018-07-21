<?php
class PageController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $statisticDelegate;
	private $siteInfosDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, PAGE_CLASS_NAME);
		$this->formDelegate = new FormDelegate(PAGE_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(PAGE_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(PAGE_CLASS_NAME);
		$this->statisticDelegate = new StatisticDelegate(PAGE_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, PAGE_LIST_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function publishAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE);
		$this->data['errors'] = FALSE;
		$this->objectDelegate->update($this->data, $params, null);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);
	}
}
