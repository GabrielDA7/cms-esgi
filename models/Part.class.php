<?php
class Part extends BaseSql {

	protected $id = null;
	protected $number;
	protected $title;
	protected $content;

	protected $videos = [];

	protected $user_id;
	protected $user;
	protected $chapter_id;
	protected $chapter;
	
	public function __construct() {
		BaseSql::__construct();
	}

	public function __destruct() {

	}

	public function getColumns() {
		return get_object_vars($this);
	}

	public function unsetColumn($key) {
		unset($this->$key);
	}

	public function getId() 		 { return $this->id; 		 }
	public function getNumber() 	 { return $this->number; 	 }
	public function getTitle() 		 { return $this->title; 	 }
	public function getContent() 	 { return $this->content; 	 }
	public function getVideos() 	 { return $this->videos; 	 }
	public function getChapterId() 	 { return $this->chapter_id; }
	public function getChapter() 	 { return $this->chapter; 	 }
    public function getUserId()		 { return $this->user_id;    }
    public function getUser()	     { return $this->user;	     }

	public function setId($id) 					  { $this->id = $id; 				 }
	public function setNumber($number) 		  	  { $this->number = $number; 		 }
	public function setTitle($title) 			  { $this->title = $title; 			 }
	public function setContent($content) 		  { $this->content = $content; 		 }
	public function setVideos($videos) 			  { $this->videos = $videos; 		 }
	public function setChapterId($chapter_id) 	  { $this->chapter_id = $chapter_id; }
	public function setChapter($chapter) 	  	  { $this->chapter = $chapter;	 	 }
    public function setUserId($user_id)			  { $this->user_id = $user_id;       }
    public function setUser($user)			      { $this->user = $user;		     }
}