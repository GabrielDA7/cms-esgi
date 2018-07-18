<?php
class Premium {

	protected $id = null;
	protected $startDate;
	protected $endDate;

	protected $user_Id = null;
	protected $premiumOffer_Id;

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
	public function getStartDate() { return $this->startDate; }
	public function getEndDate()   { return $this->endDate;   }
	public function getUserId()    { return $this->user_Id;   }
	public function getPremiumOfferId()    { return $this->premiumOffer_Id;   }


	public function setId($id) 				 { $this->id = $id; 			  }
	public function setStartDate($startDate) { $this->startDate = $startDate; }
	public function setEndDate($endDate) 	 { $this->endDate = $endDate; 	  }
	public function setPremiumOfferId($premiumOffer_Id) { $this->premiumOffer_Id = $premiumOffer_Id; }
	public function setUserId($user_Id) 	 { $this->user_Id = $user_Id; 	  }
}
