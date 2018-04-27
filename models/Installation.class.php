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

	public static function configSettingForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_SETTING_LINK, "submit"=>"Confirm", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"language"=>
											[
												"type"=>"select",
												"option"=>
														[
															"fr"=>"Francais",
															"en"=>"English"
														],
												"required"=>true,
												"class"=>"form-group input"
											],
								"front_Template"=>
											[
												"type"=>"select",
												"option"=>
														[
															"defaultFront"=>"Default",
															"templateFront1"=>"Template 1",
															"templateFront2"=>"Template 2"
														],
												"required"=>true,
												"class"=>"form-group input"
											],
								"back_Template"=>
											[
												"type"=>"select",
												"option"=>
														[
															"defaultBack"=>"Default",
															"templateBack1"=>"Template 1",
															"templateBack2"=>"Template 2"
														],
												"required"=>true,
												"class"=>"form-group input"
											]
							]
				];
	}

	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_DATABASE_LINK, "submit"=>"Valider", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"dbuser"=>
											[
												"type"=>"text",
												"placeholder"=>"Nom d'utilisateur",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbpwd"=>
											[
												"type"=>"text",
												"placeholder"=>"Mot de passe",
												"required"=>true,
												"maxString"=>255,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbhost"=>
											[
												"type"=>"text",
												"placeholder"=>"Url",
												"required"=>true,
												"maxString"=>255,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbname"=>
											[
												"type"=>"text",
												"placeholder"=>"Nom de la base",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbport"=>
											[
												"type"=>"number",
												"placeholder"=>"Port",
												"required"=>true,
												"maxNum"=>10,
												"minNum"=>2,
												"class"=>"form-group input"
											]
							]
				];
	}

	public static function configAdminForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_ADMIN_LINK, "submit"=>"Valider", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"firstName"=>
											[
												"type"=>"text",
												"placeholder"=>"First name",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"lastName"=>
											[
												"type"=>"text",
												"placeholder"=>"Last name",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"userName"=>
											[
												"type"=>"text",
												"placeholder"=>"Username",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"email"=>
											[
												"type"=>"email",
												"placeholder"=>"Email",
												"required"=>true,
												"class"=>"form-group input"
											],
								"pwd"=>
											[
												"type"=>"password",
												"placeholder"=>"Password",
												"required"=>true,
												"class"=>"form-group input"
											],
								"role"=>
											[
												"type"=>"hidden",
												"value"=>ADMIN_ROLE,
											],
								"installation_Done"=>
											[
												"type"=>"hidden",
												"value"=>"true",
											]
							]
				];
	}

	public function getLanguage() 		  { return $this->language; 		 }
	public function getFrontTemplate() 	  { return $this->front_Template; 	 }
	public function getBackTemplate()     { return $this->back_Template; 	 }
	public function getDbuser() 		  { return $this->dbuser; 			 }
	public function getDbpwd() 			  { return $this->dbpwd; 			 }
	public function getDbname() 		  { return $this->dbname; 			 }
	public function getDbport() 		  { return $this->dbport; 			 }
	public function getInstallationDone() { return $this->installation_Done; }


 	public function setLanguage($language) 					{ $this->language = $language; 					 					 }
  	public function setFrontTemplate($front_Template) 		{ $this->front_Template = $front_Template; 	 	 					 }
  	public function setBackTemplate($back_Template) 		{ $this->back_Template = $back_Template; 		 				     }
  	public function setDbuser($dbuser) 						{ $this->dbuser = $dbuser; 						 					 }
  	public function setDbpwd($dbpwd) 						{ $this->dbpwd = $dbpwd; 						 					 }
  	public function setDbname($dbname) 						{ $this->dbname = $dbname; 						 					 }
  	public function setDbport($dbport) 						{ $this->dbport = $dbport; 						 					 }
  	public function setInstallationDone($installation_Done) { ($installation_Done == "true")?$this->installation_Done=TRUE:null; }
 }
?>