<?php
include "core/interfaces/ControllerInterface.php";
class TrainningController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $emailDelegate;
	private $fileDelegate;
	private $listDisplayDataDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, TRAINNING_CLASS_NAME);
		$this->formDelegate = new FormDelegate(TRAINNING_CLASS_NAME);
		$this->emailDelegate = new EmailDelegate();
		$this->fileDelegate = new FileDelegate(TRAINNING_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(TRAINNING_CLASS_NAME);
	}

	public function indexAction($params) {
	}

	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRAINNING_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
		if(!isset($params['GET']['id']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRAINNING_EDIT_VIEWS);
		$this->objectDelegate->pushObjectById($this->data, $params['GET']['id']);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->update($this->data, $params, "", TRAINNING_LIST_BACK_LINK);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->objectDelegate->delete($params, "", TRAINNING_LIST_BACK_LINK);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, TRAINNING_LIST_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function trainningAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, TRAINNING_TRAINNING_VIEWS);
		$this->objectDelegate->getById($this->data, $params);
		$view = new View($this->data);
	}

	/**
	 * Get the asssocieted lessons at the current trainning
	 */
	public function lessonsAction($params) {
	}
}
?>
