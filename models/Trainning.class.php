<?php
class Trainning extends BaseSql {

	protected $id = null;
	protected $title;
	protected $description;
	protected $dateInserted;
	protected $lessons = array();


	public function getId() 		  { return $this->id; 			}
  	public function getTitle() 		  { return $this->title; 		}
  	public function getDescription()  { return $this->description; 	}
  	public function getDateInserted() { return $this->dateInserted; }
  	public function getLessons() 	  { return $this->lessons; 		}


	public function setId($id) 					   { $this->id = $id; 					  }
  	public function setTitle($title) 			   { $this->title = $title; 			  }
  	public function setDescription($description)   { $this->description = $description;   }
  	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; }
  	public function setLessons($lessons) 		   { $this->lessons = $lessons; 	 	  }
}
?>