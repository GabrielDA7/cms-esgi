<?php
include "core/interfaces/ControllerInterface.php";
class ChapterController implements ControllerInterface{

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $tableDelegate;
	private $listDisplayDataDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, CHAPTER_CLASS_NAME);
		$this->formDelegate = new FormDelegate(CHAPTER_CLASS_NAME);
		$this->emailDelegate = new EmailDelegate();
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(CHAPTER_CLASS_NAME);
	}

	public function indexAction($params) {
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, CHAPTER_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, CHAPTER_EDIT_BACK_VIEWS);
		$this->objectDelegate->pushObjectById($this->data, $params['GET']['id']);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params, "", CHAPTER_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->objectDelegate->delete($params, "", CHAPTER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, CHAPTER_LIST_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function chapterAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, CHAPTER_CHAPTER_VIEWS);
		$this->objectDelegate->pushObjectById($this->data, $params['GET']['id'], [PART_CLASS_NAME]);
		$view = new View($this->data);
	}
}
?>
