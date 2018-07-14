<?php
class VideoController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $statisticViewDelegate
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, VIDEO_CLASS_NAME);
		$this->formDelegate = new FormDelegate(VIDEO_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(VIDEO_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(VIDEO_CLASS_NAME);
		$this->statisticViewDelegate = new StatisticViewDelegate(VIDEO_CLASS_NAME);
	}

	public function indexAction($params) {
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, VIDEO_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, VIDEO_FOLDER_NAME);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if(!isset($params['POST']['id']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, VIDEO_EDIT_VIEWS);
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
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->userDelegate->delete($params, "", VIDEO_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, VIDEO_LIST_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, VIDEO_VIDEO_VIEWS);
		$this->objectDelegate->getById($this->data, $params);
		$this->statisticViewDelegate->processAdd($params['GET']);
		$view = new View($this->data);
	}
}
