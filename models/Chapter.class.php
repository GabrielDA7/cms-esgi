<?php
class Chapter extends BaseSql {

	protected $id = null;
	protected $number;
	protected $title;
	protected $image;

	protected $parts = [];

	protected $trainning_id = null;
	protected $trainning;

	public function __construct() {
		BaseSql::__construct();
	}

	public function __destruct() {

	}

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getColumnsToSearch() {
		return ["title", "trainning_id"];
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
								"trainning_id"=>
													[
														"type"=>"select",
														"class"=>"form-group row select-formation input-medium",
														"option"=>
																	[
																		"" => "Pas de formation"
																	],
														"value"=>(isset($_POST["trainning"])? $_POST["trainning"] : "Pas de formation")
													],
								"number"=>
												[
													"type"=>"number",
													"class"=>"form-group row input-small input",
													"required"=>true,
													"value"=>(isset($_POST["number"])? $_POST["number"] : ""),

												],
								"author"=>
											[
										         "type"=>"hidden",
												 	 	 "class"=>"form-group",
										         "value" => $_SESSION['userName']
								      ],
								"parts"=>
											[
												"id"=>"addChapterPart",
												"type"=>"button",
												"class"=>"input-btn btn-filled-blue form-group row",
												"value"=>"Add part",
												"onclick"=>"addChapterSubpart();"
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

				                "category"=>
				                      [
				                        "name"=>"Category"
				                      ],
				                "author"=>
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


	public function setId($id) 					  { $this->id = $id; 					 }
	public function setNumber($number) 		  	  { $this->number = $number; 			 }
	public function setTitle($title) 			  { $this->title = $title; 				 }
	public function setImage($image) 			  { $this->image = $image; 				 }
	public function setParts($parts) 			  { $this->parts = $parts; 			 	 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
	public function setTrainning($trainning) 	  { $this->trainning = $trainning;       }
}