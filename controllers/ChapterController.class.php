<?php
class ChapterController {

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
		$this->objectDelegate = new ObjectDelegate($this->data, CHAPTER_CLASS_NAME);
		$this->formDelegate = new FormDelegate(CHAPTER_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(CHAPTER_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(CHAPTER_CLASS_NAME);
		$this->statisticDelegate = new StatisticDelegate(CHAPTER_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, CHAPTER_ADD_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, CHAPTER_IMAGES_FOLDER_NAME);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, CHAPTER_EDIT_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params, [PART_CLASS_NAME]);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params, "", CHAPTER_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE);
		$this->objectDelegate->delete($params, "", CHAPTER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, CHAPTER_LIST_VIEWS);
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

	public function chapterAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, CHAPTER_CHAPTER_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params, [PART_CLASS_NAME]);
		$this->statisticDelegate->processAdd($params['GET']);
		$view = new View($this->data);
	}
}
