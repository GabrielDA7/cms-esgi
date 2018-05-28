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
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}

	public function listAction($params) {
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
	}
}