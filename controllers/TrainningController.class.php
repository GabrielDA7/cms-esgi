<?php
include "core/interfaces/ControllerInterface.php";
class TrainningController implements ControllerInterface {

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
		ViewUtils::setPossiblesViewsTemplates($data, "", "", TRAINNING_ADD_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->formDelegate->process($data, $params, TRAINNING_CLASS_NAME);
		$this->objectDelegate->add($data, $params, TRAINNING_CLASS_NAME);
		$view = new View($data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, "", "", TRAINNING_EDIT_BACK_VIEW , BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->pushObjectById($data, $params['GET']['id'], TRAINNING_CLASS_NAME);
		$this->formDelegate->process($data, $params, TRAINNING_CLASS_NAME);
		$this->objectDelegate->update($data, $params, TRAINNING_CLASS_NAME, "", TRAINNING_LIST_BACK_LINK);
		$view = new View($data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, TRAINNING_CLASS_NAME, "", TRAINNING_LIST_BACK_LINK);
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, TRAINNING_LIST_FRONT_VIEW, FRONT_TEMPLATE, TRAINNING_LIST_BACK_VIEW, BACK_TEMPLATE); 
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, TRAINNING_CLASS_NAME);
		$this->objectDelegate->listAll($data, $params, TRAINNING_CLASS_NAME);
		$view = new View($data);
	}

	public function trainningAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process(LogsUtils::LOGS_FILE, "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, TRAINNING_TRAINNING_FRONT_VIEW, FRONT_TEMPLATE, TRAINNING_TRAINNING_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->objectDelegate->pushObjectById($data, $params['GET']['id'], TRAINNING_CLASS_NAME, [LESSON_CLASS_NAME]);
		$view = new View($data);
	}

	/**
	 * Get the asssocieted lessons at the current trainning
	 */
	public function lessonsAction($params) {
	}
}
?>
