<?php
class Premiumoffer extends BaseSql {

	protected $id = null;
	protected $title;
	protected $duration;
	protected $status;
	protected $price;

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getColumnsToSearch() {
		return ["title", "duration", "price", "status"];
	}

	public function unsetColumn($key) {
		unset($this->$key);
	}


	public static function configAddForm($data) {
		$chapter = $data['chapter'];
		return 	[
			"config"=>["method"=>"POST", "action"=> DIRNAME.PREMIUMOFFER_ADD_BACK_LINK,"submit"=>"Add","submitClass"=>"input-btn btn-filled-orange btn-icon last"],
			"input"=>
			[
				"title"=>
				[
					"type"=>"text",
					"placeholder"=>"Offer name",
					"maxString"=>100,
					"minString"=>2,
					"class"=>"form-group input"
				],
				"duration"=>
				[
					"label"=>"Duration (in month)",
					"type"=>"number",
					"class"=>"input-medium"
				],
				"price"=>
				[
					"label"=>"Price",
					"type"=>"number",
					"class"=>"input-medium"
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
	public function setPrice($price) 	 { $this->price = $price; 	  }
	public function setDuration($duration) 	 { $this->duration = $duration; 	  }
	public function setStatus($status) 	 { $this->status = $status; 	  }
}
