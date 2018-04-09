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


	public function getId() { return $this->id; }
  	public function getUser() { return $this->user; }
  	public function getDate() { return $this->date; }
  	public function getContent() { return $this->content; }
  	public function getResponses() { return $this->responses; }
  	public function getLessonId() { return $this->lesson_Id; }
  	public function getTrainningId() { return $this->trainning_Id; }
  	public function getVideoId() { return $this->video_Id; }
  	public function getCommentId() { return $this->comment_Id; }


	public function setId($id) { $this->id = $id; }
  	public function setUser($user) { $this->user = $user; }
  	public function setDate($date) { $this->date = $date; }
  	public function setContent($content) { $this->content = $content; }
  	public function setResponses($responses) { $this->responses = $responses; }
  	public function setLessonId($lesson_Id) { $this->lesson_Id = $lesson_Id; }
  	public function setTrainningId($trainning_Id) { $this->trainning_Id = $trainning_Id; }
  	public function setVideoId($video_Id) { $this->video_Id = $video_Id; }
  	public function setCommentId($comment_Id) { $this->comment_Id = $comment_Id; }
}
?>