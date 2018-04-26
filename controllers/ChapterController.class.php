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
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, CHAPTER_LIST_FRONT_VIEW, FRONT_TEMPLATE, CHAPTER_LIST_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->objectDelegate->listAll($data, $params, CHAPTER_CLASS_NAME);
		$view = new View($data);
	}

	public function chapterAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process(LogsUtils::LOGS_FILE, "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, CHAPTER_CHAPTER_FRONT_VIEW, FRONT_TEMPLATE, CHAPTER_CHAPTER_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->objectDelegate->pushObjectById($data, $params['GET']['id'], CHAPTER_CLASS_NAME, [PART_CLASS_NAME]);

		$view = new View($data);
	}
}
?>
