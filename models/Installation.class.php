<?php
class Installation {

	private $language;
	private $front_template;
	private $back_template;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $dbport;
	private $installation_done;

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getLanguage() 		  { return $this->language; 		 }
	public function getFronttemplate() 	  { return $this->front_template; 	 }
	public function getBacktemplate()     { return $this->back_template; 	 }
	public function getDbuser() 		  { return $this->dbuser; 			 }
	public function getDbpwd() 			  { return $this->dbpwd; 			 }
	public function getDbname() 		  { return $this->dbname; 			 }
	public function getDbport() 		  { return $this->dbport; 			 }
	public function getInstallationdone() { return $this->installation_done; }


 	public function setLanguage($language) 					{ $this->language = $language; 					 }
  	public function setFronttemplate($front_template) 		{ $this->front_template = $front_template; 	 	 }
  	public function setBacktemplate($back_template) 		{ $this->back_template = $back_template; 		 }
  	public function setDbuser($dbuser) 						{ $this->dbuser = $dbuser; 						 }
  	public function setDbpwd($dbpwd) 						{ $this->dbpwd = $dbpwd; 						 }
  	public function setDbname($dbname) 						{ $this->dbname = $dbname; 						 }
  	public function setDbport($dbport) 						{ $this->dbport = $dbport; 						 }
  	public function setInstallationdone($installation_done) { $this->installation_done = $installation_done; }
 }
?>