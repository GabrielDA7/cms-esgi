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
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || $_SESSION['admin'] !== TRUE) {
			return404View();
		}
		$this->authenticationDelegate->process($data, $params, TRUE);
		$this->objectDelegate->delete($params, VIDEO_CLASS_NAME);
		header(LOCATION . DIRNAME . USER_LIST_BACK_LINK);
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, VIDEO_LIST_FRONT_VIEW, FRONT_TEMPLATE, VIDEO_LIST_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		if (isset($params['POST']['submit'])) {
			$this->objectDelegate->pushObjectsByParameters($data, $params, VIDEO_CLASS_NAME);
		} else {
			$this->objectDelegate->pushAllObjects($data, $params, VIDEO_CLASS_NAME);
		}
		$view = new View($data);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, VIDEO_FRONT_VIEW, FRONT_TEMPLATE, VIDEO_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		if (isset($params['POST']['submit'])) {
			$this->objectDelegate->pushObjectById($data, $params, VIDEO_CLASS_NAME);
		}
		$view = new View($data);
	}
}
?>