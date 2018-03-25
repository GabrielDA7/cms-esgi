<?php
class Comment extends BaseSql {

	protected $id 			= null;
	protected $user;
	protected $date;
	protected $content;
	protected $response 	= array();
	
	protected $Lesson_Id 	= null;
	protected $Trainning_Id = null;
	protected $Video_Id 	= null;
	protected $Comment_Id 	= null;
}
?>