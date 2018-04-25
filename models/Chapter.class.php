<?php
class Chapter extends BaseSql {

	protected $id = null;
	protected $number;
	protected $title;

	protected $parts = [];

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
	public function getNumber() 	 { return $this->number; 	   }
	public function getTitle() 		 { return $this->title; 	   }
	public function getParts() 	 	 { return $this->parts; 	   }
	public function getTrainningId() { return $this->trainning_id; }


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setNumber($number) 		  	  { $this->number = $number; 			 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setParts($parts) 			  { $this->parts = $parts; 			 	 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
}
?>