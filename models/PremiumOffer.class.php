<?php
class Premium {

	protected $id = null;
  protected $title;
	protected $duration;
  protected $status;
  protected $price;

	public static function configEditForm($data) {
		$chapter = $data['chapter'];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_EDIT_FRONT_LINK, "enctype" => "multipart/form-data", "submit"=>"Edit"],
					"input"=>
							[
								"id"=>
											[
												"type"=>"hidden",
												"placeholder"=>$chapter->getId(),
												"value"=>$chapter->getId(),
												"required"=>true,
											],
								"title"=>
											[
												"type"=>"text",
												"placeholder"=>$chapter->getTitle(),
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											]
							]
				];
	}

  public static function configAddForm($data) {
    $chapter = $data['chapter'];
    return 	[
          "config"=>["method"=>"POST", "action"=> DIRNAME.USER_EDIT_FRONT_LINK, "enctype" => "multipart/form-data", "submit"=>"Edit"],
          "input"=>
              [
                "id"=>
                      [
                        "type"=>"hidden",
                        "placeholder"=>$chapter->getId(),
                        "value"=>$chapter->getId(),
                        "required"=>true,
                      ],
                "title"=>
                      [
                        "type"=>"text",
                        "placeholder"=>$chapter->getTitle(),
                        "maxString"=>100,
                        "minString"=>2,
                        "class"=>"form-group input"
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
												"price"=>
															[
																 "name"=>"Price"
															],
												"duration"=>
															[
																	"name"=>"Duration"
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

	public function getId() 	   { return $this->id; 		  }
  public function getTitle()  {return $this->title ;}
  public function getPrice()  {return $this->price ;}
  public function getStatus()  {return $this->status ;}
  public function getDuration()  {return $this->duration ;}



	public function setId($id) 				 { $this->id = $id; 			  }
	public function setTitle($title) { $this->title = $title; }
	public function setPrice($price) 	 { $this->price = $endDate; 	  }
  public function setStatus($status) 	 { $this->status = $status; 	  }
	public function setUserId($user_Id) 	 { $this->user_Id = $user_Id; 	  }
}
