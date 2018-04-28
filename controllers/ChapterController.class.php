<?php
include "core/interfaces/ControllerInterface.php";
class ChapterController implements ControllerInterface{

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
		$this->formDelegate = new FormDelegate();
		$this->emailDelegate = new EmailDelegate();
	}

	public function indexAction($params) {
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($data, $params, TRUE, CHAPTER_ADD_VIEWS);
		$this->formDelegate->process($data, $params, CHAPTER_CLASS_NAME);
		$this->objectDelegate->add($data, $params, CHAPTER_CLASS_NAME);
		$view = new View($data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE, CHAPTER_EDIT_BACK_VIEWS);
		$this->objectDelegate->pushObjectById($data, $params['GET']['id'], CHAPTER_CLASS_NAME);
		$this->formDelegate->process($data, $params, CHAPTER_CLASS_NAME);
		$this->objectDelegate->update($data, $params, CHAPTER_CLASS_NAME, "", CHAPTER_LIST_BACK_LINK);
		$view = new View($data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, CHAPTER_CLASS_NAME, "", CHAPTER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, CHAPTER_LIST_VIEWS);
		$this->objectDelegate->listAll($data, $params, CHAPTER_CLASS_NAME);
		$view = new View($data);
	}

	public function chapterAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process(LogsUtils::LOGS_FILE, "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, FALSE, CHAPTER_CHAPTER_VIEWS);
		$this->objectDelegate->pushObjectById($data, $params['GET']['id'], CHAPTER_CLASS_NAME, [PART_CLASS_NAME]);
		$view = new View($data);
	}
}
?>
