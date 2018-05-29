<?php
class Comment extends BaseSql {

	protected $id = null;
	protected $user;
	protected $date;
	protected $content;
	protected $responses = [];
	
	protected $lesson_id 	= null;
	protected $trainning_id = null;
	protected $video_id 	= null;
	protected $comment_id 	= null;


	public function getId() 		 { return $this->id; 		   }
	public function getUser() 		 { return $this->user; 		   }
	public function getDate() 		 { return $this->date; 		   }
	public function getContent() 	 { return $this->content; 	   }
	public function getResponses() 	 { return $this->responses;    }
	public function getLessonId() 	 { return $this->lesson_id;    }
	public function getTrainningId() { return $this->trainning_id; }
	public function getVideoId() 	 { return $this->video_id; 	   }
	public function getCommentId() 	 { return $this->comment_id;   }


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setUser($user) 				  { $this->user = $user; 				 }
	public function setDate($date) 				  { $this->date = $date; 				 }
	public function setContent($content) 		  { $this->content = $content; 			 }
	public function setResponses($responses) 	  { $this->responses = $responses; 		 }
	public function setLessonId($lesson_id) 	  { $this->lesson_id = $lesson_id; 		 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
	public function setVideoId($video_id) 		  { $this->video_id = $video_id; 		 }
	public function setCommentId($comment_id) 	  { $this->comment_id = $comment_id; 	 }
}