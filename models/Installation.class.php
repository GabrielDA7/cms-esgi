<?php
class Installation extends BaseSql {

	private $id;
	private $dbuser;
	private $dbpwd;
	private $dbname;
	private $dbport;
	private $siteName;
	private $reasonRegister;
	private $siteDescription;
	private $email = null;
	private $twitter = null;
	private $instagram = null;
	private $linkedin = null;
	private $facebook = null;

	private $installation_Done;

	public function getColumns() {
		return get_object_vars($this);
	}


	public static function configSettingForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_SETTING_LINK, "submit"=>"Confirm", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"siteName"=>
											[
												"label"=>"Site name",
												"type"=>"text",
												"required"=>true,
												"class"=>"form-group input"
											],
								"reasonRegister"=>
											[
												"label"=>"Why users should register ?",
												"type"=>"textarea",
												"required"=>true,
												"class"=>"form-group input"
											],
								"siteDescription"=>
											[
												"label"=>"Site description",
												"type"=>"textarea",
												"required"=>true,
												"class"=>"form-group input"
											],
								"email"=>
														[
															"label"=>"Site email",
															"type"=>"text",
															"class"=>"form-group input"
														],
								"twitter"=>
																	[
																		"label"=>"Admin twitter link",
																		"type"=>"text",
																		"class"=>"form-group input"
																	],
								"instagram"=>[
																					"label"=>"Admin instagram link",
																					"type"=>"text",
																					"class"=>"form-group input"
															],
								"linkedin"=>[
																								"label"=>"Admin linkedin link",
																								"type"=>"text",
																								"class"=>"form-group input"
																	],
								"facebook"=>[
																	"label"=>"Admin facebook link",
																	"type"=>"text",
																	"class"=>"form-group input"
														]
							]
				];
	}

	public static function configDatabaseForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_DATABASE_LINK, "submit"=>"Validate", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"dbuser"=>
											[
												"label"=>"Database username",
												"type"=>"text",
												"placeholder"=>"Nom utilisateur",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbpwd"=>
											[
												"label"=>"Database password",
												"type"=>"text",
												"placeholder"=>"Mot de passe",
												"class"=>"form-group input"
											],
								"dbhost"=>
											[
												"label"=>"Database host",
												"type"=>"text",
												"placeholder"=>"Url",
												"required"=>true,
												"maxString"=>255,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbname"=>
											[
												"label"=>"Database name",
												"type"=>"text",
												"placeholder"=>"Nom de la base",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"dbport"=>
											[
												"label"=>"Database port",
												"type"=>"number",
												"placeholder"=>"Port",
												"required"=>true,
												"class"=>"form-group input"
											]
							]
				];
	}

	public static function configAdminForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_ADMIN_LINK, "submit"=>"Validate", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"firstName"=>
											[
												"label"=>"First name",
												"type"=>"text",
												"placeholder"=>"First name",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"lastName"=>
											[
												"label"=>"Last name",
												"type"=>"text",
												"placeholder"=>"Last name",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"userName"=>
											[
												"label"=>"Username",
												"type"=>"text",
												"placeholder"=>"Username",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2,
												"class"=>"form-group input"
											],
								"email"=>
											[
												"label"=>"Email",
												"type"=>"email",
												"placeholder"=>"Email",
												"required"=>true,
												"class"=>"form-group input"
											],
								"pwd"=>
											[
												"label"=>"Password",
												"type"=>"password",
												"placeholder"=>"Password",
												"required"=>true,
												"class"=>"form-group input"
											],
								"role"=>
											[
												"type"=>"hidden",
												"value"=>ADMIN_ROLE
											],
								"installation_Done"=>
											[
												"type"=>"hidden",
												"value"=>"true"
											]
							]
				];
	}

	public static function configParametersForm($data){
		$installation = $data['installations'][0];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_PARAMETER_LINK, "submit"=>"Update", "submitClass" => "input-btn btn-filled-orange btn-icon last"],
					"input"=>
							[
								"id"=>
											[
												"type"=>"hidden",
												"value"=>$installation->getId()
											],
								"siteName"=>
											[
												"label"=>"Site name",
												"type"=>"text",
												"required"=>true,
												"value"=>$installation->getSiteName(),
												"class"=>"input"
											],
								"reasonRegister"=>
											[
												"label"=>"Why users should register ?",
												"type"=>"textarea",
												"required"=>true,
												"value"=>$installation->getReasonRegister(),
												"class"=>"input"
											],
								"siteDescription"=>
											[
												"label"=>"Site description",
												"type"=>"textarea",
												"required"=>true,
												"value"=>$installation->getSiteDescription(),
												"class"=>"input"
											],
								"email"=>
											[
												"label"=>"Site email",
												"value"=>$installation->getEmail(),
												"type"=>"text",
												"class"=>"input"
											],
								"twitter"=>
											[
												"label"=>"Admin twitter link",
												"type"=>"text",
												"value"=>$installation->getTwitter(),
												"class"=>"input"
											],
								"instagram"=>[
												"label"=>"Admin instagram link",
												"type"=>"text",
												"value"=>$installation->getInstagram(),
												"class"=>"input"
											],
								"linkedin"=>[
												"label"=>"Admin linkedin link",
												"type"=>"text",
												"value"=>$installation->getLinkedin(),
												"class"=>"input"
											],
								"facebook"=>[
												"label"=>"Admin facebook link",
												"type"=>"text",
												"value"=>$installation->getFacebook(),
												"class"=>"input"
											]

							]
				];
	}

	public static function configEditdatabaseForm($data) {
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . INSTALLATION_EDIT_DATABASE_LINK, "submit"=>"Update", "submitClass" => "input-btn btn-filled-orange btn-icon last"],
					"input"=>
							[
								"dbuser"=>
											[
												"label"=>"DB user",
												"type"=>"text",
												"value"=>DBUSER,
												"class"=>"input"
											],
								"dbpwd"=>
											[
												"label"=>"DB password",
												"type"=>"text",
												"placeholder"=>"Password",
												"class"=>"input"
											],
								"dbhost"=>
											[
												"label"=>"DB url",
												"type"=>"text",
												"value"=>DBHOST,
												"class"=>"input"
											],
								"dbname"=>
											[
												"label"=>"DB name",
												"type"=>"text",
												"value"=>DBNAME,
												"class"=>"input"
											],
								"dbport"=>
											[
												"label"=>"DB port",
												"type"=>"number",
												"value"=>DBPORT,
												"class"=>"input"
											]

							]
				];
	}

	public function getId() 		 	  { return $this->id;		 		 }
	public function getSiteName() 		  { return $this->siteName; 		 }
	public function getReasonRegister()   { return $this->reasonRegister; 	 }
	public function getSiteDescription()  { return $this->siteDescription; 	 }
	public function getEmail() 			  { return $this->email;			 }
	public function getTwitter() 		  { return $this->twitter; 			 }
	public function getInstagram()   	  { return $this->instagram; 		 }
	public function getLinkedin() 		  { return $this->linkedin;  	 	 }
	public function getFacebook() 		  { return $this->facebook; 		 }
	public function getDbuser() 		  { return $this->dbuser; 			 }
	public function getDbpwd() 			  { return $this->dbpwd; 			 }
	public function getDbname() 		  { return $this->dbname; 			 }
	public function getDbport() 		  { return $this->dbport; 			 }
	public function getInstallationDone() { return $this->installation_Done; }

	public function setId($id) 								{ $this->id = $id; 													 }
	public function setSiteName($siteName) 					{ $this->siteName = $siteName; 										 }
	public function setReasonRegister($reasonRegister) 		{ $this->reasonRegister = $reasonRegister; 							 }
	public function setSiteDescription($siteDescription) 	{ $this->siteDescription = $siteDescription; 						 }
	public function setEmail($email) 						{ $this->email = $email;											 }
	public function setTwitter($twitter) 					{ $this->twitter = $twitter; 										 }
	public function setInstagram($instagram) 				{ $this->instagram = $instagram; 									 }
	public function setLinkedin($linkedin) 					{ $this->linkedin = $linkedin; 										 }
	public function setFacebook($facebook) 				 	{ $this->facebook = $facebook; 										 }
  	public function setDbuser($dbuser) 						{ $this->dbuser = $dbuser; 						 					 }
  	public function setDbpwd($dbpwd) 						{ $this->dbpwd = $dbpwd; 						 					 }
  	public function setDbname($dbname) 						{ $this->dbname = $dbname; 						 					 }
  	public function setDbport($dbport) 						{ $this->dbport = $dbport; 						 					 }
  	public function setInstallationDone($installation_Done) { ($installation_Done == "true")?$this->installation_Done=TRUE:null; }
 }
