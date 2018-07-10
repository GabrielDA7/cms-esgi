<?php
class Video extends BaseSql {

	protected $id = null;
	protected $title;
	protected $duration;
	protected $live;
	protected $url;

	protected $chapter_Id = null;

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
									"file"=>
												[
											         "type"=>"file",
													 	 	 "class"=>"form-group",
											         "maxSize" => 1000000,
											         "extension" =>
											                   [
												                    "mp4",
												                    "mp3",
												                    "webm",
																						"3gp",
											                    ],
															"requied"=>true
									       		],
									"author"=>
												[
											         "type"=>"hidden",
													 	 	 "class"=>"form-group",
											         "value" => $_SESSION['userName']
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

    public function getId()       { return $this->id;        }
    public function getTitle()    { return $this->title;     }
    public function getDuration() { return $this->duration;  }
    public function getLive()     { return $this->live;      }
    public function getUrl()      { return $this->url;       }
    public function getChapterId() { return $this->chapter_Id; }


    public function setId($id)              { $this->id = $id;               }
    public function setTitle($title)        { $this->title = $title;         }
    public function setDuration($duration)  { $this->duration = $duration;   }
    public function setLive($live)          { $this->live = $live;           }
    public function setUrl($url)            { $this->url = $url;             }
    public function setChapterId($chapter_Id) { $this->chapter_Id = $chapter_Id; }
}
