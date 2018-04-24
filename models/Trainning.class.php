<?php
class Trainning extends BaseSql {

	protected $id = null;
	protected $title;
	protected $description;
	protected $author;
	protected $dateInserted;
	protected $lessons = array();

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

	public static function configListForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.TRAINNING_LIST_BACK_LINK, "submit"=>"Edit"],
					"input"=>
							[
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>"Title",
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"author"=>
											[
												"type"=>"text",
												"placeholder"=>"Author",
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"description"=>
											[
												"type"=>"text",
												"placeholder"=>"Description",
												"required"=>true
											],							
							]
				];
	}

	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_LIST_BACK_LINK, "submit"=>"Ajouter"],
					"input"=>
							[
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>"title",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true
											],
								"description"=>
											[
												"type"=>"textarea",
												"placeholder"=>"Description",
											],
							]
				];
	}

	public function getId() 		  { return $this->id; 			    }
	public function getTitle() 		  { return $this->title; 		    }
	public function getDescription()  { return $this->description; 		}
	public function getAuthor()       { return $this->author; 	   		}
	public function getDateInserted() { return $this->dateInserted; 	}
	public function getLessons() 	  { return $this->lessons; 		  	}


	public function setId($id) 					   { $this->id = $id; 					  }
	public function setTitle($title) 			   { $this->title = $title; 			  }
	public function setDescription($description)   { $this->description = $description;   }
	public function setAuthor($author) 			   { $this->author = $author; 			  }
	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; }
	public function setLessons($lessons) 		   { $this->lessons = $lessons; 	 	  }
}
?>
