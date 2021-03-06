<?php
class Trainning extends BaseSql {

	protected $id = null;
	protected $title;
	protected $description;
	protected $image;
	protected $dateInserted;
	protected $status;
	protected $premium;

	protected $chapters = array();

	protected $user_id;
	protected $user;

	public function __construct() {
		BaseSql::__construct();
	}

	public function __destruct() {

	}

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getColumnsToSearch() {
		return ["title", "user_id"];
	}

	public function unsetColumn($key) {
		unset($this->$key);
	}

	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.TRAINNING_ADD_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Save", "submitClass"=>"input-btn btn-filled-orange btn-icon"],
					"input"=>
							[
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>"Title",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input"
											],
								"description"=>
											[
												"type"=>"textarea",
												"placeholder"=>"Description",
												"class"=>"form-group input"
											],
								"image"=>
											[
														 "name"=>"image",
										         "type"=>"file",
												 	 	 "class"=>"form-group",
										         "maxSize" => 1000000,
										         "extension" =>
										                   [
											                    "jpg",
											                    "png",
											                    "jpeg"
										                    ]
								       		],
							"premium"=> [
														"id"=>"only-premium",
														"type"=>"checkbox",
														"text"=>"Only for premium",
														"checked"=>"checked",
														"class"=>"row form-group",
														"value"=>1
													]
						]

				];
	}

	public static function configEditForm($data){
		$trainning = $data['trainning'];
		$trainningId = $trainning->getId();
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.TRAINNING_EDIT_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Update", "submitClass"=>"input-btn btn-filled-orange btn-icon"],
					"input"=>
							[
								"title"=>
											[
												"value"=>$trainning->getTitle(),
												"type"=>"text",
												"placeholder"=>"Title",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input"
											],
								"description"=>
											[
												"value"=>$trainning->getDescription(),
												"type"=>"textarea",
												"placeholder"=>"Description",
												"class"=>"form-group input"
											],
								"image"=>[
																	 "name"=>"image",
																	 "class"=>"upload-button",
																	 "title"=>$trainning->getImage(),
																	 "value"=>$trainning->getImage(),
																	 "label" => "Upload image :",
																	 "type"=>"file",
																	 "maxSize" => 1000000,
																	 "extension" =>
																						 [
																								".jpg",
																								".png",
																								".jpeg"
																							]
												],
							"premium"=> [
													"id"=>"only-premium",
													"type"=>"checkbox",
													"text"=>"Only for premium",
													"checked"=>(($trainning->getPremium() == 1) ? "checked" : ""),
													"name"=>"premium",
													"class"=>"row form-group",
													"value"=>$trainning->getPremium(),
												],
							"id"=>[
																"type"=>"hidden",
																"placeholder"=>$trainning->getId(),
																"value"=>$trainning->getId(),
																"required"=>true,
										],
						]

				];
	}

	public static function configTable(){
		return 	[
					"config"=>["id"=>"pagination_data", "class"=>"table_responsive"],
					"cells"=>
							[
								"title"=>
											[
												"name"=>"Title",
											],
								"user"=>
											[
												 "name"=>"Author",
								     		],
								"status"=>
											[
												"name"=>"Status",
											],
								"premium"=>
											[
												"name"=>"Premium",
											],
								"id"=>
											[
												"name"=>"Actions",
											]
						]

				];
	}

	public function getId() 		  { return $this->id; 			    }
	public function getTitle() 		  { return $this->title; 		    }
	public function getDescription()  { return $this->description; 		}
	public function getImage()  	  { return $this->image; 		    }
	public function getAuthor()       { return $this->author; 	   		}
	public function getDateInserted() { return $this->dateInserted; 	}
	public function getChapters() 	  { return $this->chapters; 		}
    public function getUserId()		  { return $this->user_id;		    }
    public function getUser()	      { return $this->user;			    }
    public function getStatus()       { return $this->status;           }
    public function getPremium() 	  { return $this->premium;          }

	public function setId($id) 					   { $this->id = $id; 					  }
	public function setTitle($title) 			   { $this->title = $title; 			  }
	public function setDescription($description)   { $this->description = $description;   }
	public function setImage($image)   			   { $this->image = $image;  			  }
	public function setAuthor($author) 			   { $this->author = $author; 			  }
	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; }
	public function setChapters($chapters) 		   { $this->chapters = $chapters; 	 	  }
    public function setUserId($user_id)			   { $this->user_id = $user_id;			  }
    public function setUser($user)				   { $this->user = $user;			      }
    public function setStatus($status) 		       { $this->status = $status; 		      }
    public function setPremium($premium) 	       { $this->premium = $premium; 		  }
}
