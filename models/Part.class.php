<?php
class Part extends BaseSql {

	protected $id = null;
	protected $number;
	protected $part;
	protected $title;
	protected $content;
	protected $author;

	protected $videos = [];

	protected $chapter_id = null;
	
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
	public function getPart() 	     { return $this->part; 	     }
	public function getTitle() 		 { return $this->title; 	 }
	public function getContent() 	 { return $this->content; 	 }
	public function getAuthor() 	 { return $this->author; 	 }
	public function getVideos() 	 { return $this->videos; 	 }
	public function getChapterId() 	 { return $this->chapter_id; }


	public function setId($id) 					  { $this->id = $id; 				 }
	public function setNumber($number) 		  	  { $this->number = $number; 		 }
	public function setPart($part) 		 		  { $this->part = $part; 			 }
	public function setTitle($title) 			  { $this->title = $title; 			 }
	public function setContent($content) 		  { $this->content = $content; 		 }
	public function setAuthor($author) 			  { $this->author = $author; 		 }
	public function setVideos($videos) 			  { $this->videos = $videos; 		 }
	public function setChapterId($chapter_id) 	  { $this->chapter_id = $chapter_id; }
}
?>