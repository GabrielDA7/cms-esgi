<?php
class VideoController {

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
		$this->objectDelegate = new ObjectDelegate($this->data, VIDEO_CLASS_NAME);
		$this->formDelegate = new FormDelegate(VIDEO_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(VIDEO_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(VIDEO_CLASS_NAME);
		$this->statisticDelegate = new StatisticDelegate(VIDEO_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, VIDEO_ADD_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, VIDEO_FOLDER_NAME);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if((!isset($params['GET']['id']) || !isAdmin()) && !isset($params['POST']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, VIDEO_EDIT_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, VIDEO_FOLDER_NAME);
		$this->objectDelegate->update($this->data, $params, "", VIDEO_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE);
		$this->objectDelegate->delete($params, "", VIDEO_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, VIDEO_LIST_VIEWS);
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

	public function videoAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, VIDEO_VIDEO_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params);
		$this->statisticDelegate->processAdd($params['GET']);
		$view = new View($this->data);
	}
}
