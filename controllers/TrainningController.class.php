<?php
class TrainningController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $statisticDelegate;
	private $siteInfosDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, TRAINNING_CLASS_NAME);
		$this->formDelegate = new FormDelegate(TRAINNING_CLASS_NAME);
		$this->emailDelegate = new EmailDelegate();
		$this->fileDelegate = new FileDelegate(TRAINNING_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(TRAINNING_CLASS_NAME);
		$this->statisticDelegate = new StatisticDelegate(TRAINNING_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, TRAINNING_ADD_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, FORMATION_IMAGES_FOLDER_NAME);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if((!isset($params['GET']['id']) || !isAdmin()) && !isset($params['POST']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, TRAINNING_EDIT_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params, [CHAPTER_CLASS_NAME]);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params, FORMATION_IMAGES_FOLDER_NAME);
		$this->objectDelegate->update($this->data, $params, "", TRAINNING_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE);
		$this->objectDelegate->delete($params, "", TRAINNING_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, TRAINNING_LIST_VIEWS);
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

	public function trainningAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, TRAINNING_TRAINNING_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params, [CHAPTER_CLASS_NAME]);
		$this->statisticDelegate->processAdd($params['GET']);
		$view = new View($this->data);
	}
}
