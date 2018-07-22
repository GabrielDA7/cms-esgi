<?php
class Premium extends BaseSql{

	protected $id = null;
	protected $startDate;
	protected $endDate;

	protected $user_Id;
	protected $premiumOffer_Id;


	public function __construct() {
		BaseSql::__construct();
	}

	public function getColumns() {
		return get_object_vars($this);
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
