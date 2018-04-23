<?php
class Module {
	
	protected $id = null;
	protected $title;
	protected $content;
	protected $author;
	protected $dateInserted;

	protected $lesson_id = null;

	public function getId() 	  { return $this->id; 		 }
	public function getTitle() 	  { return $this->title; 	 }
	public function getContent()  { return $this->content; 	 }
	public function getAuthor()   { return $this->author; 	 }
	public function getLessonId() { return $this->lesson_id; }


	public function setId($id) 				{ $this->id = $id; 				 }
	public function setTitle($title) 		{ $this->title = $title; 		 }
	public function setContent($content) 	{ $this->content = $content; 	 }
	public function setAuthor($author) 		{ $this->author = $author; 		 }
	public function setModules($modules)    { $this->modules = $modules; 	 }
	public function setLessonId($lesson_id) { $this->lesson_id = $lesson_id; }
}
?>