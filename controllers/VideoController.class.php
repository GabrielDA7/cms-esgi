<?php
include "core/interfaces/ControllerInterface.php";
class VideoController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
	}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, VIDEO_ADD_FRONT_VIEW, FRONT_TEMPLATE, VIDEO_ADD_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, VIDEO_CLASS_NAME);
		$this->objectDelegate->add($data, $params, VIDEO_CLASS_NAME);
		$view = new View($data);
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, VIDEO_CLASS_NAME);
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, VIDEO_LIST_FRONT_VIEW, FRONT_TEMPLATE, VIDEO_LIST_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, VIDEO_CLASS_NAME);
		$this->objectDelegate->listAll($data, $params, VIDEO_CLASS_NAME);
		$view = new View($data);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		if (isset($params['POST']['id'])) {
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, VIDEO_FRONT_VIEW, FRONT_TEMPLATE, VIDEO_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->formDelegate->process($data, $params, USER_CLASS_NAME);
		$this->objectDelegate->pushObjectById($data, $params, VIDEO_CLASS_NAME);
		$view = new View($data);
	}
}
?>