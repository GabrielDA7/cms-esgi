<?php
class Lesson extends BaseSql {

	protected $id = null;
	protected $chapter;
	protected $part;
	protected $title;
	protected $content;
	protected $author;

	protected $videos = [];

	protected $trainning_id = null;
	
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

	public function getId() 		 { return $this->id; 		   }
	public function getChapter() 	 { return $this->chapter; 	   }
	public function getPart() 	     { return $this->part; 	       }
	public function getTitle() 		 { return $this->title; 	   }
	public function getContent() 	 { return $this->content; 	   }
	public function getAuthor() 	 { return $this->author; 	   }
	public function getVideos() 	 { return $this->videos; 	   }
	public function getTrainningId() { return $this->trainning_id; }


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setChapter($chapter) 		  { $this->chapter = $chapter; 			 }
	public function setPart($part) 		 		  { $this->part = $part; 			 	 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setContent($content) 		  { $this->content = $content; 			 }
	public function setAuthor($author) 			  { $this->author = $author; 			 }
	public function setVideos($videos) 			  { $this->videos = $videos; 			 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
}
?>