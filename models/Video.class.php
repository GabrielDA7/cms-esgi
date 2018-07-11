<?php
class Video extends BaseSql {

	protected $id = null;
	protected $title;
	protected $url;
	protected $description;
	protected $date;

	protected $part_id;
	protected $user_id;
	protected $user;

	public function __construct() {
		BaseSql::__construct();
	}

    public function getColumns() {
        return get_object_vars($this);
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
															"requied"=>true
									       		],
									"user_id"=>
												[
											         "type"=>"hidden",
													 	 	 "class"=>"form-group",
											         "value" => $_SESSION['userId']
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
						                "author"=>
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
    public function getDate() 		 { return $this->date;        }
    public function getUser()		 { return $this->user;	      }

    public function setId($id)              	 { $this->id = $id;                   }
    public function setTitle($title)        	 { $this->title = $title;         	  }
	public function setUserId($user_id)      	 { $this->user_id = $user_id;         }
	public function setDescription($description) { $this->description = $description; }
    public function setUrl($url)            	 { $this->url = $url;             	  }
    public function setPartId($part_id) 		 { $this->part_id = $part_id; 		  }
    public function setDate($date) 				 { $this->date = $date; 	 		  }
    public function setUser($user) 				 { $this->user = $user;			      }
}
