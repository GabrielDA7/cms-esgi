<?php
class Video extends BaseSql {

	protected $id = null;
	protected $title;
	protected $url;
	protected $description;
	protected $dateInserted;
	protected $status;
	protected $premium;

	protected $part_id;
	protected $user_id;
	protected $user;

	public function __construct() {
		BaseSql::__construct();
	}

    public function getColumns() {
        return get_object_vars($this);
    }

	public function getColumnsToSearch() {
		return ["title", "user_id", "part_id"];
	}

	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.VIDEO_ADD_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Upload", "submitClass"=>"input-btn btn-filled-orange btn-icon last"],
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
								"url"=>
											[
										         "type"=>"file",
												 	 	 "class"=>"form-group",
										         "extension" =>
										                   [
											                    "mp4",
											                    "mp3",
											                    "webm",
																					"3gp",
										                    ],
														"required"=>true
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
		$video = $data['video'];
		$videoId = $video->getId();
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.VIDEO_EDIT_BACK_LINK, "enctype" => "multipart/form-data", "submit"=>"Upload", "submitClass"=>"input-btn btn-filled-orange btn-icon last"],
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
												"value"=>$video->getTitle(),
											],
								"url"=>
											[
												"class"=>"upload-button",
												"title"=>$video->getUrl(),
												"value"=>$video->getUrl(),
												"label" => "Upload image :",
												"type"=>"file",
												"maxSize" => 1000000,
												"extension" =>
																	[
																		 "mp4",
																		 "mp3",
																		 "webm",
																		 "3gp",
																	 ],
												"requied"=>true,
													],
								"premium"=> [
																			"id"=>"only-premium",
																			"type"=>"checkbox",
																			"text"=>"Only for premium",
																			"checked"=>(($video->getPremium() == 1) ? "checked" : ""),
																			"name"=>"premium",
																			"class"=>"row form-group",
																			"value"=>$video->getPremium(),
														],
							   "id"=>[
																							"type"=>"hidden",
																							"placeholder"=>$video->getId(),
																							"value"=>$video->getId(),
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
				                        "name"=>"Title"
				                      ],
				                "user"=>
				                      [
				                         "name"=>"Author"
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

    public function getId()       	 { return $this->id;          }
	public function getTitle()    	 { return $this->title;       }
	public function getDescription() { return $this->description; }
	public function getUserId()   	 { return $this->user_id;     }
    public function getUrl()      	 { return $this->url;         }
    public function getPartId() 	 { return $this->part_id;     }
    public function getUser()		 { return $this->user;	      }
    public function getDateInserted(){ return $this->dateInserted;}
    public function getStatus() 	 { return $this->status;      }
		public function getPremium() {return $this->premium; }

    public function setId($id)              	   { $this->id = $id;                    }
    public function setTitle($title)        	   { $this->title = $title;         	 }
	public function setUserId($user_id)      	   { $this->user_id = $user_id;          }
	public function setDescription($description)   { $this->description = $description;  }
    public function setUrl($url)            	   { $this->url = $url;             	 }
    public function setPartId($part_id) 		   { $this->part_id = $part_id; 		 }
    public function setUser($user) 				   { $this->user = $user;			     }
    public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted;}
    public function setStatus($status) 			   { $this->status = $status; 			 }
		public function setPremium($premium)  {$this->premium = $premium ;}
}
