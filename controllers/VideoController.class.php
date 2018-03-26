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
		if (isset($params['POST']['submit'])) {
			$video = ClassUtils::constructObjectWithParameters($params['POST'], VIDEO_CLASS_NAME);
			$videos = $video->getWithParameters();
		} else {
			$video = new Video();
			$videos = $video->getAll();
		}
		$view = new View(VIDEO_LIST_VIEW, DEFAULT_TEMPLATE);
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
		$view = new View(VIDEO_VIEW, DEFAULT_TEMPLATE);
		$view->assign("video" ,$video);
	}
}
?>