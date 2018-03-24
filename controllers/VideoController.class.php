<?php
class VideoController{

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
			$video = Video::constructWithParameters($params['POST']);
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
			extract($params['POST']);
			$video = Video::constructWithId($id);
			$video = $video->getById();
		}
		$v = new View("video","front");
		$v->assign("video" ,$video);
	}

	public function addCommentAction($params){
	}
}
?>