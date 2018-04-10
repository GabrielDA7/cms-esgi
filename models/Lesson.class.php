<?php
class Lesson extends BaseSql {

	protected $id = null;
	protected $title;
	protected $content;
	protected $autor;
	protected $videos = array();
	
	protected $trainning_Id = null;



	public function getId() 		 { return $this->id; 		   }
	public function getTitle() 		 { return $this->title; 	   }
	public function getContent() 	 { return $this->content; 	   }
	public function getAutor() 		 { return $this->autor; 	   }
	public function getVideos() 	 { return $this->videos; 	   }
	public function getTrainningId() { return $this->trainning_Id; }


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setContent($content) 		  { $this->content = $content; 			 }
	public function setAutor($autor) 			  { $this->autor = $autor; 				 }
	public function setVideos($videos) 			  { $this->videos = $videos; 			 }
	public function setTrainningId($trainning_Id) { $this->trainning_Id = $trainning_Id; }
  }
?>