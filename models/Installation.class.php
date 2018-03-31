<?php
class Installation {

	private $language;
	private $front_Template;
	private $back_Template;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $dbport;
	private $installation_Done;

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getLanguage() 		  { return $this->language; 		 }
	public function getFrontTemplate() 	  { return $this->front_Template; 	 }
	public function getBackTemplate()     { return $this->back_Template; 	 }
	public function getDbuser() 		  { return $this->dbuser; 			 }
	public function getDbpwd() 			  { return $this->dbpwd; 			 }
	public function getDbname() 		  { return $this->dbname; 			 }
	public function getDbport() 		  { return $this->dbport; 			 }
	public function getInstallationDone() { return $this->installation_Done; }


 	public function setLanguage($language) 					{ $this->language = $language; 					 }
  	public function setFrontTemplate($front_Template) 		{ $this->front_Template = $front_Template; 	 	 }
  	public function setBackTemplate($back_Template) 		{ $this->back_Template = $back_Template; 		 }
  	public function setDbuser($dbuser) 						{ $this->dbuser = $dbuser; 						 }
  	public function setDbpwd($dbpwd) 						{ $this->dbpwd = $dbpwd; 						 }
  	public function setDbname($dbname) 						{ $this->dbname = $dbname; 						 }
  	public function setDbport($dbport) 						{ $this->dbport = $dbport; 						 }
  	public function setInstallationDone($installation_Done) { $this->installation_Done = $installation_Done; }
 }
?>