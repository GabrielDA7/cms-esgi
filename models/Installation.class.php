<?php
class Installation {

	private $LANGUAGE;
	private $FRONT_TEMPLATE;
	private $BACK_TEMPLATE;
	private $DBUSER;
	private $DBPWD;
	private $DBNAME;
	private $DBPORT;
	private $INSTALLATION_DONE;

	public function getColumns() {
		return get_object_vars($this);
	}
	
	public function getLANGUAGE() 		  { return $this->LANGUAGE; 		 }
	public function getFRONTTEMPLATE() 	  { return $this->FRONT_TEMPLATE; 	 }
	public function getBACKTEMPLATE()     { return $this->BACK_TEMPLATE; 	 }
	public function getDBUSER() 		  { return $this->DBUSER; 			 }
	public function getDBPWD() 			  { return $this->DBPWD; 			 }
	public function getDBNAME() 		  { return $this->DBNAME; 			 }
	public function getDBPORT() 		  { return $this->DBPORT; 			 }
	public function getINSTALLATIONDONE() { return $this->INSTALLATION_DONE; }


 	public function setLANGUAGE($LANGUAGE) 					{ $this->LANGUAGE = $LANGUAGE; 					 }
  	public function setFRONTTEMPLATE($FRONT_TEMPLATE) 		{ $this->FRONT_TEMPLATE = $FRONT_TEMPLATE; 	 	 }
  	public function setBACKTEMPLATE($BACK_TEMPLATE) 		{ $this->BACK_TEMPLATE = $BACK_TEMPLATE; 		 }
  	public function setDBUSER($DBUSER) 						{ $this->DBUSER = $DBUSER; 						 }
  	public function setDBPWD($DBPWD) 						{ $this->DBPWD = $DBPWD; 						 }
  	public function setDBNAME($DBNAME) 						{ $this->DBNAME = $DBNAME; 						 }
  	public function setDBPORT($DBPORT) 						{ $this->DBPORT = $DBPORT; 						 }
  	public function setINSTALLATIONDONE($INSTALLATION_DONE) { $this->INSTALLATION_DONE = $INSTALLATION_DONE; }
 }
?>