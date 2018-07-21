<?php
class User extends UserSql {

	protected $id = null;
	protected $userName;
	protected $lastName;
	protected $firstName;
	protected $pwd;
	protected $pwdReset;
	protected $email;
	protected $emailConfirm;
	protected $avatar;
	protected $token;

	protected $dateInserted;
	protected $dateUpdated;
	protected $status;
	protected $role;

	public function __construct() {
		UserSql::__construct();
	}

	public function __destruct() {

	}

	public function getColumns() {
		return get_object_vars($this);
	}

	public function getColumnsToSearch() {
		return ["userName", "lastName", "firstName", "email", "dateInserted", "dateUpdated", "status"];
	}

	public function generateToken() {
		$this->token = $this->randomCode();
		return $this->token;
	}

	public function generateEmailConfirm() {
		$this->emailConfirm = $this->randomCode();
		return $this->emailConfirm;
	}

	public function generatePwdReset() {
		$this->pwdReset = $this->randomCode();
		return $this->pwdReset;
	}

	public function randomCode() {
		return base_convert(hash('sha256', time() . mt_rand()), 16, 36);
	}

	public function unsetColumn($key) {
		unset($this->$key);
	}

	/**
	* Security for XSS
	*/
	public function unsetRoleIfNotAdmin() {
		if (!isAdmin()) {
			$this->setRole(null);
		}
	}

	/**
	* Configuration of the add form user
	*/
	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . USER_ADD_FRONT_LINK, "submit"=>"Sign up", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
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
								"emailConfirmation"=>
											[
												"type"=>"email",
												"placeholder"=>"Email confirmation",
												"required"=>true,
												"confirm"=>"email",
												"class"=>"form-group input"
											],
								"pwd"=>
											[
												"type"=>"password",
												"placeholder"=>"Password",
												"required"=>true,
												"class"=>"form-group input"
											],
								"pwdConfirmation"=>
											[
												"type"=>"password",
												"placeholder"=>"Password confirmation",
												"required"=>true,
												"confirm"=>"pwd",
												"class"=>"form-group input"
											],
							]
				];
	}

	/**
	* Configuration of the login form user
	*/
	public static function configLoginForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . USER_LOGIN_FRONT_LINK, "submit"=>"Sign in", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"userName"=>
											[
												"type"=>"text",
												"placeholder"=>"Pseudo",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true,
												"class"=>"form-group input"
											],
								"pwd"=>
											[
												"type"=>"password",
												"placeholder"=>"Mot de passe",
												"maxString"=>255,
												"minString"=>6,
												"required"=>true,
												"class"=>"form-group input"
											]
							]
				];
	}

	/**
	* Configuration of the login form user
	*/
	public static function configEditForm($data) {
		$user = $data['user'];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_EDIT_FRONT_LINK, "enctype" => "multipart/form-data", "submit"=>"Save","submitClass" => "btn-filled-orange btn-small align-right form-group-bottom"],
					"input"=>
							[
								"avatar"=>[
														"image"=>$user->getAvatar(),
														"type"=>"file",
														"maxSize" => 1000000,
														"extension" =>[
																						 "jpg",
																						 "png",
																						 "jpeg"
																					]
													],
								"role"=>[
												"type"=>"plainText",
												"value"=>$user->getRole(),
								],
								"userName"=>
											[
												"label"=>"Username",
												"type"=>"text",
												"value"=>$user->getUserName(),
												"maxString"=>100,
												"minString"=>2,
												"class"=>"input"
											],
								"firstName"=>
											[
												"label"=>"First name",
												"type"=>"text",
												"value"=>$user->getFirstName(),
												"maxString"=>255,
												"minString"=>2,
												"class"=>"input"
											],
								"lastName"=>
											[
												"label"=>"Last name",
												"type"=>"text",
												"value"=>$user->getLastName(),
												"maxString"=>255,
												"minString"=>2,
												"class"=>"input"
											],
								"email"=>
											[
												"label"=>"Email",
												"type"=>"email",
												"value"=>$user->getEmail(),
												"class"=>"input"
											],
							]
				];
	}

	public static function configPasswordResetEmailForm($data) {
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . USER_PASSWORD_RESET_LINK, "submit"=>"Send", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"email"=>
											[
												"type"=>"email",
												"placeholder"=>"Email",
												"required"=>true,
												"class"=>"form-group input"
											]
							]
				];
	}

	public static function configPasswordResetForm($data) {
		$user = $data['user'];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME . USER_PASSWORD_RESET_LINK, "submit"=>"Send", "submitClass" => "btn-filled-orange btn-full-width form-group-bottom"],
					"input"=>
							[
								"id"=>
											[
												"type"=>"hidden",
												"value"=>$user->getId()
											],
								"pwdReset"=>
											[
												"type"=>"hidden",
												"value"=>$user->getPwdReset()
											],
								"pwd"=>
											[
												"type"=>"password",
												"placeholder"=>"Password",
												"required"=>true,
												"class"=>"form-group input"
											],
								"pwdConfirmation"=>
											[
												"type"=>"password",
												"placeholder"=>"Password confirmation",
												"required"=>true,
												"confirm"=>"pwd",
												"class"=>"form-group input"
											],
							]
				];
	}

	public static function configListForm($data){
		$user = $data['user'];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_LIST_BACK_LINK, "submit"=>"Edit"],
					"input"=>
							[
								"userName"=>
											[
												"type"=>"text",
												"placeholder"=>"UserName",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true
											],
								"firstName"=>
											[
												"type"=>"text",
												"placeholder"=>"First Name",
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"lastName"=>
											[
												"type"=>"text",
												"placeholder"=>"Last Name",
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"email"=>
											[
												"type"=>"email",
												"placeholder"=>"Email",
												"required"=>true
											]
							]
				];
	}

	public static function configTable(){
		return 	[
					"config"=>["id"=>"pagination_data", "class"=>"table_responsive"],
					"cells"=>
										[
												"userName"=>
															[
																"name"=>"Username"
															],

												"lastName"=>
															[
																"name"=>"Lastname"
															],
												"firstName"=>
															[
																 "name"=>"Firstname"
															],
												"email"=>
															[
																	"name"=>"Email"
															],
												"role"=>
															[
																"name"=>"Role"
															],
												"id"=>
															[
																"name"=>"Actions"
															]
										]
				];
	}

	public function getId() 		  { return $this->id; 			 }
    public function getLastName() 	  { return $this->lastName;		 }
    public function getFirstName() 	  { return $this->firstName; 	 }
    public function getUserName() 	  { return $this->userName; 	 }
    public function getPwd() 		  { return $this->pwd; 			 }
    public function getPwdReset() 	  { return $this->pwdReset; 	 }
    public function getEmail() 		  { return $this->email;   		 }
    public function getEmailConfirm() { return $this->emailConfirm;  }
    public function getAvatar()		  { return $this->avatar; 		 }
    public function getToken() 		  { return $this->token; 		 }
    public function getDateInserted() { return $this->date_inserted; }
    public function getDateUpdated()  { return $this->dateUpdated;   }
    public function getStatus()		  { return $this->status; 		 }
    public function getRole()		  { return $this->role; 		 }



    public function setId($id) 					   { $this->id = $id; 								  	 }
	public function setLastName($lastName) 		   { $this->lastName = ucfirst(strtolower($lastName)); 	 }
	public function setFirstName($firstName) 	   { $this->firstName = ucfirst(strtolower($firstName)); }
	public function setUserName($userName) 		   { $this->userName = $userName; 						 }
	public function setPwd($pwd) 			 	   { $this->pwd = (isset($pwd))? sha1($pwd) : null; 	 }
	public function setPwdReset($pwdReset) 		   { $this->pwdReset = $pwdReset; 						 }
	public function setEmail($email) 			   { $this->email = strtolower(trim($email)); 			 }
	public function setEmailConfirm($emailConfirm) { $this->emailConfirm = $emailConfirm;				 }
	public function setAvatar($avatar) 			   { $this->avatar = $avatar; 							 }
	public function setToken($token) 			   { $this->token = $token; 							 }
	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; 				 }
	public function setDateUpdated($dateUpdated)   { $this->dateUpdated = $dateUpdated; 				 }
	public function setStatus($status) 			   { $this->status = $status; 							 }
	public function setRole($role) 			   	   { $this->role = $role; 							 	 }
}
