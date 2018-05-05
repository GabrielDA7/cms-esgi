<?php
include "core/interfaces/ControllerInterface.php";
class VideoController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, VIDEO_CLASS_NAME);
		$this->formDelegate = new FormDelegate(VIDEO_CLASS_NAME);
	}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, VIDEO_ADD_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$view = new View($this->data);
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE);
		$this->objectDelegate->delete($params);
	}

	public function listAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, VIDEO_LIST_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$view = new View($this->data);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		if (isset($params['POST']['id'])) {
			return404View();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, VIDEO_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->pushObjectById($this->data, $params);
		$view = new View($this->data);
	}
}
?>