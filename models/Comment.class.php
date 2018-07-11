<?php
class Comment extends BaseSql {

	protected $id = null;
	protected $dateInserted;
	protected $content;
	protected $responses = [];

  	protected $user_id;
  	protected $user;
	protected $chapter_id;
	protected $trainning_id;
	protected $video_id;
	protected $comment_id;

	public function getColumns() {
		return get_object_vars($this);
	}

	public static function configCommentForm($data){
		return 	[
					"config"=>["method"=>"POST","submit"=>"Comment", "submitClass"=>"input-btn btn-filled-blue btn-icon"],
					"input"=>
							[
								"comment"=>
											[
												"type"=>"textarea",
												"placeholder"=>"Enter a comment here",
												"maxString"=>255,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input"
											]
						]

				];
	}

	public static function configTable(){
		return 	null;
	}


	public function getId() 		 { return $this->id; 		   }
	public function getContent() 	 { return $this->content; 	   }
	public function getResponses() 	 { return $this->responses;    }
	public function getUserId() 	 { return $this->user_id; 	   }
	public function getChapterId() 	 { return $this->chapter_id;   }
	public function getTrainningId() { return $this->trainning_id; }
	public function getVideoId() 	 { return $this->video_id; 	   }
	public function getCommentId() 	 { return $this->comment_id;   }
	public function getUser() 	 	 { return $this->user;   	   }
	public function getDateInserted(){ return $this->dateInserted; }

	public function setId($id) 					  { $this->id = $id; 					 }
	public function setContent($content) 		  { $this->content = $content; 			 }
	public function setResponses($responses) 	  { $this->responses = $responses; 		 }
	public function setUserId($user_id) 		  { $this->user_id = $user_id;			 }
	public function setChapterId($chapter_id) 	  { $this->chapter_id = $chapter_id; 	 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
	public function setVideoId($video_id) 		  { $this->video_id = $video_id; 		 }
	public function setCommentId($comment_id) 	  { $this->comment_id = $comment_id; 	 }
	public function setUser($user) 	  			  { $this->user = $user; 	 			 }
    public function setDateInserted($dateInserted){ $this->dateInserted = $dateInserted; }
}
