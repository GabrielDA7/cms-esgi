<?php
include "core/ControllerInterface.php";
class VideoController implements ControllerInterface {

	public function __construct() {}

	public function indexAction($params) {
	}
	
	public function addAction($params) {
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}

	public function listAction($params) {
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], VIDEO_LIST_BACK_VIEW, VIDEO_LIST_FRONT_VIEW, DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		if (isset($params['POST']['submit'])) {
			$video = ClassUtils::constructObjectWithParameters($params['POST'], VIDEO_CLASS_NAME);
			$videos = $video->getWithParameters();
		} else {
			$video = new Video();
			$videos = $video->getAll();
		}
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
		$view->assign("videos" ,$videos);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params) {
		if (isset($params['POST']['submit'])) {
			$video = ClassUtils::constructObjectWithId($params['POST']['id'], VIDEO_CLASS_NAME);
			$video = $video->getById();
		}
		$view = new View(VIDEO_FRONT_VIEW, DEFAULT_TEMPLATE);
		$view->assign("video" ,$video);
	}
}
?>