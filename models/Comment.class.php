<?php
class Comment extends BaseSql {

	protected $id = null;
	protected $user;
	protected $date;
	protected $content;
	protected $responses = array();
	
	protected $lesson_Id 	= null;
	protected $trainning_Id = null;
	protected $video_Id 	= null;
	protected $comment_Id 	= null;
}
?>