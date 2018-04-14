<?php
include "core/interfaces/ControllerInterface.php";
class VideoController implements ControllerInterface {

	private $authenticationDelegate;
	private $objectDelegate;
	private $datas = array();

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
	}

	public function listAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, VIDEO_LIST_BACK_VIEW, VIDEO_LIST_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		if (isset($params['POST']['submit'])) {
			$this->objectDelegate->pushObjectsByParameters($datas, $params, VIDEO_CLASS_NAME);
		} else {
			$this->objectDelegate->pushAllObjects($datas, $params, VIDEO_CLASS_NAME);
		}
		$view = new View($datas['view'], $datas['template']);
		$view->assign("videos" ,$datas['objects']);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		ViewUtils::setPossiblesViewsTemplates($datas, VIDEO_BACK_VIEW, VIDEO_FRONT_VIEW, BACK_TEMPLATE, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($datas, $params);
		if (isset($params['POST']['submit'])) {
			$this->objectDelegate->pushObjectById($datas, $params, VIDEO_CLASS_NAME);
		}
		$view = new View(VIDEO_FRONT_VIEW, FRONT_TEMPLATE);
		$view->assign("video" ,$datas['object']);
	}
}
?>