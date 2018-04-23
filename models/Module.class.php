<?php
class Module {
	
	protected $id = null;
	protected $title;
	protected $content;
	protected $autor;
	protected $dateInserted;

	protected $lesson_id = null;

	public function getId() 		 { return $this->id; 		   }
	public function getTitle() 		 { return $this->title; 	   }
	public function getContent() 	 { return $this->content; 	   }
	public function getAutor() 		 { return $this->autor; 	   }
	public function getLessonId() { return $this->lesson_id; }


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setContent($content) 		  { $this->content = $content; 			 }
	public function setAutor($autor) 			  { $this->autor = $autor; 				 }
	public function setModules($modules) 		  { $this->modules = $modules; 			 }
	public function setLessonId($lesson_id) { $this->lesson_id = $lesson_id; }
}
?>