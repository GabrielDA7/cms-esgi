<?php
class Premium {

	protected $id = null;
	protected $startDate;
	protected $endDate;

	protected $user_Id = null;


	public function getId() 	   { return $this->id; 		  }
	public function getStartDate() { return $this->startDate; }
	public function getEndDate()   { return $this->endDate;   }
	public function getUserId()    { return $this->user_Id;   }


	public function setId($id) 				 { $this->id = $id; 			  }
	public function setStartDate($startDate) { $this->startDate = $startDate; }
	public function setEndDate($endDate) 	 { $this->endDate = $endDate; 	  }
	public function setUserId($user_Id) 	 { $this->user_Id = $user_Id; 	  }
}