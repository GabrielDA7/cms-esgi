<?php
class VideoController{

	public function __construct(){}

	public function indexAction($params){
	}
	
	public function addAction($params){
	}

	public function editAction($params){
	}

	public function deleteAction($params) {
	}

	public function listAction($params){
		if(isset($params['POST']['submit'])) {
			$video = ClassUtils::constructObjectWithParameters($params['POST'], VIDEO_CLASS_NAME);
			$videos = $video->getWithParameters();
		} else {
			$video = new Video();
			$videos = $video->getAll();
		}
		$v = new View("listVideo","front");
		$v->assign("videos" ,$videos);
	}

	/**
	 * Get the video by id
	 */
	public function videoAction($params){
		if(isset($params['POST']['submit'])) {
			$video = ClassUtils::constructObjectWithId($params['POST']['id'], VIDEO_CLASS_NAME);
			$video = $video->getById();
		}
		$v = new View("video","front");
		$v->assign("video" ,$video);
	}

	/**
	 * Get the asssocieted comment at the current video 
	 */
	public function commentAction($params){
	}
}
?>