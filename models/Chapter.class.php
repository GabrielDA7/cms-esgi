<?php
class Chapter extends BaseSql {

	protected $id = null;
	protected $number;
	protected $title;
	protected $image;
	protected $dateInserted;
	protected $status;
	protected $premium;

	protected $parts = [];

	protected $trainning_id;
	protected $trainning;
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
		return ["title", "user_id", "trainning_id"];
	}

	public function unsetColumn($key) {
		unset($this->$key);
	}

	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.CHAPTER_ADD_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Save", "submitClass"=>"input-btn btn-filled-orange btn-icon last"],
					"input"=>
							[
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>"Title",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input",
												"value"=>(isset($_POST["title"])? $_POST["title"] : "")
											],
								"image"=>
											[
														 "name"=>"image",
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
								"trainning_id"=>
											[
												"label"=>"Choose a trainning :",
												"type"=>"select",
												"class"=>"row select-formation input-medium",
												"option"=>
															[
																"" => "No trainning"
															],
												"value"=>(isset($_POST["trainning"])? $_POST["trainning"] : "No trainning")
											],
								"number"=>
											[
												"label" => "Number of the chapter :",
												"type"=>"text",
												"class"=>"row input-medium",
												"disabled"=>"disabled",
												"value"=>(isset($_POST["number"])? $_POST["number"] : ""),

											],
								"parts"=>
											[
												"id"=>"addChapterPart",
												"type"=>"button",
												"class"=>"input-btn btn-filled-blue form-group row",
												"value"=>"Add part",
												"onclick"=>"addChapterSubpart();"
											],
								"premium"=> [
									"id"=>"only-premium",
									"type"=>"checkbox",
									"text"=>"Only for premium",
									"checked"=>"checked",
									"class"=>"row form-group",
									"value"=>1
								],
						]

				];
	}

	public static function configEditForm($data) {
		$chapter = $data['chapter'];
		$chapterId = $chapter->getId();
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.CHAPTER_EDIT_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Update", "submitClass"=>"input-btn btn-filled-orange btn-icon last"],
					"input"=>
							[
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>"Title",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input",
												"value"=>$chapter->getTitle()
											],
								"image"=>
											[
														 "name"=>"image",
														 "class"=>"upload-button",
														 "title"=>$chapter->getImage(),
														 "value"=>$chapter->getImage(),
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
								"trainning_id"=>
											[
												"label"=>"Choose a trainning :",
												"type"=>"select",
												"class"=>"row select-formation input-medium",
												"option"=>
															[
																"" => "No trainning"
															],
												"value"=>$chapter->getTrainningId()
											],
								"number"=>
											[
												"label" => "Number of the chapter :",
												"type"=>"text",
												"class"=>"row input-medium",
												"disabled"=>"disabled",
												"value"=>$chapter->getNumber(),

											],
								"parts"=>
											[
												"id"=>"addChapterPart",
												"type"=>"button",
												"class"=>"input-btn btn-filled-blue form-group row",
												"value"=>"Add part",
												"onclick"=>"addChapterSubpart();"
											],
								"id"=>
											[
												"type"=>"hidden",
												"placeholder"=>$chapter->getId(),
												"value"=>$chapter->getId(),
												"required"=>true,
											],
								"allParts"=>[
													"type"=>"parts",
													"value"=>$chapter->getParts(),
								],
								"premium"=> [
									"id"=>"only-premium",
									"type"=>"checkbox",
									"text"=>"Only for premium",
									"checked"=>(($chapter->getPremium() == 1) ? "checked" : ""),
									"name"=>"premium",
									"class"=>"row form-group",
									"value"=>$chapter->getPremium(),
								]
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
				                        "name"=>"Title"
				                      ],
				                "user"=>
				                      [
				                         "name"=>"Author"
				                      ],
												"trainning"=>
															[
																	"name"=>"Trainning"
															],
				                "status"=>
				                      [
				                        "name"=>"Status"
				                      ],
				                "premium"=>
											[
												"name"=>"Premium",
											],
				                "id"=>
				                      [
				                        "name"=>"Actions"
				                      ]
				            ]
				];
	}

	public function getId() 		 { return $this->id; 		   }
	public function getNumber() 	 { return $this->number; 	   }
	public function getTitle() 		 { return $this->title; 	   }
	public function getImage() 		 { return $this->image; 	   }
	public function getParts() 	 	 { return $this->parts; 	   }
	public function getTrainningId() { return $this->trainning_id; }
	public function getTrainning()   { return $this->trainning;    }
    public function getUserId()      { return $this->user_id;      }
    public function getUser()	     { return $this->user;	       }
    public function getDateInserted(){ return $this->dateInserted; }
    public function getStatus() 	 { return $this->status;       }
    public function getPremium() 	 { return $this->premium;      }

	public function setId($id) 					  { $this->id = $id; 					 }
	public function setNumber($number) 		  	  { $this->number = $number; 			 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setImage($image) 			  { $this->image = $image; 				 }
	public function setParts($parts) 			  { $this->parts = $parts; 			 	 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
	public function setTrainning($trainning) 	  { $this->trainning = $trainning;       }
    public function setUserId($user_id) 		  { $this->user_id = $user_id;     		 }
    public function setUser($user) 				  { $this->user = $user;   				 }
    public function setDateInserted($dateInserted){ $this->dateInserted = $dateInserted; }
    public function setStatus($status) 		      { $this->status = $status; 		     }
    public function setPremium($premium) 	      { $this->premium = $premium; 		     }
}
