<?php
class User extends UserSql {

	protected $id = null;
	protected $userName;
	protected $lastName;
	protected $firstName;
	protected $pwd;
	protected $email;
	protected $emailConfirm;
	protected $age;
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

	public function generateToken() {
		$this->token = $this->randomCode();
		return $this->token;
	}

	public function generateEmailConfirm() {
		$this->emailConfirm = $this->randomCode();
		return $this->emailConfirm;
	}

	public function randomCode() {
		return base_convert(hash('sha256', time() . mt_rand()), 16, 36);
	}

	/**
	* Security for XSS
	*/
	public function unsetRoleIfNotAdmin() {
		if ($_SESSION['admin'] === FALSE) {
			$this->setRole(null);
		}
	}

	/**
	* Configuration of the add form user
	*/
	public static function configAddForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_ADD_FRONT_LINK, "submit"=>"S'inscrire"],
					"input"=>
							[
								"firstName"=>
											[
												"type"=>"text",
												"placeholder"=>"Prénom",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2
											],
								"lastName"=>
											[
												"type"=>"text",
												"placeholder"=>"Nom",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2
											],
								"age"=>
											[
												"type"=>"number",
												"placeholder"=>"Age",
												"required"=>true,
												"maxNum"=>100,
												"minNum"=>10
											],
								"userName"=> 
											[
												"type"=>"text",
												"placeholder"=>"Pseudo",
												"required"=>true,
												"maxString"=>100,
												"minString"=>2
											],
								"email"=>	
											[
												"type"=>"email",
												"placeholder"=>"Email",
												"required"=>true
											],
								"emailConfirmation"=>
											[
												"type"=>"email",
												"placeholder"=>"Confirmation de l'email",
												"required"=>true,
												"confirm"=>"email"
											],
								"pwd"=>		
											[
												"type"=>"password",
												"placeholder"=>"Mot de passe",
												"required"=>true
											],
								"pwdConfirmation"=>
											[
												"type"=>"password",
												"placeholder"=>"Confirmation du mot de passe",
												"required"=>true,
												"confirm"=>"pwd"
											],
							]
				];
	}

	/**
	* Configuration of the login form user
	*/
	public static function configLoginForm($data){
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_LOGIN_FRONT_LINK, "submit"=>"Se connecter"],
					"input"=>
							[
								"userName"=> 
											[
												"type"=>"text",
												"placeholder"=>"Pseudo",
												"maxString"=>100,
												"minString"=>2,
												"required"=>true
											],
								"pwd"=>		
											[
												"type"=>"password",
												"placeholder"=>"Mot de passe",
												"maxString"=>255,
												"minString"=>6,
												"required"=>true
											],
							]
				];
	}

	/**
	* Configuration of the login form user
	*/
	public static function configEditForm($data){
		$user = $data['user'];
		return 	[
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_EDIT_FRONT_LINK, "submit"=>"Edit"],
					"input"=>
							[
								"id"=> 
											[
												"type"=>"hidden",
												"value"=>$user->getId(),
												"required"=>true
											],
								"userName"=> 
											[
												"type"=>"text",
												"placeholder"=>$user->getUserName(),
												"maxString"=>100,
												"minString"=>2,
												"required"=>true
											],
								"firstName"=>		
											[
												"type"=>"password",
												"placeholder"=>$user->getFirstName(),
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"lastName"=>		
											[
												"type"=>"password",
												"placeholder"=>$user->getLastName(),
												"maxString"=>255,
												"minString"=>2,
												"required"=>true
											],
								"age"=>
											[
												"type"=>"number",
												"placeholder"=>$user->getAge(),
												"required"=>true,
												"maxNum"=>100,
												"minNum"=>10
											],
								"email"=>	
											[
												"type"=>"email",
												"placeholder"=>$user->getEmail(),
												"required"=>true
											],
							]
				];
	}

	public function getUserName() 	  { return $this->userName; 	 }
	public function getId() 		  { return $this->id; 			 }
    public function getLastName() 	  { return $this->lastName;		 }
    public function getFirstName() 	  { return $this->firstName; 	 }
    public function getPwd() 		  { return $this->pwd; 			 }
    public function getEmail() 		  { return $this->email;   		 }
    public function getEmailConfirm() { return $this->emailConfirm;  }
    public function getAge() 		  { return $this->age; 			 }
    public function getToken() 		  { return $this->token; 		 }
    public function getDateInserted() { return $this->date_inserted; }
    public function getDateUpdated()  { return $this->dateUpdated;   }
    public function getStatus()		  { return $this->status; 		 }
    public function getRole()		  { return $this->role; 		 }


    public function setUserName($userName) 		   { $this->userName = $userName; 						 }
    public function setId($id) 					   { $this->id = $id; 								  	 }
	public function setLastName($lastName) 		   { $this->lastName = ucfirst(strtolower($lastName)); 	 }
	public function setFirstName($firstName) 	   { $this->firstName = ucfirst(strtolower($firstName)); }
	public function setPwd($pwd) 			 	   { $this->pwd = (isset($pwd))? sha1($pwd) : null; 	 }
	public function setEmail($email) 			   { $this->email = strtolower(trim($email)); 			 }
	public function setEmailConfirm($emailConfirm) { $this->emailConfirm = $emailConfirm;				 }
	public function setAge($age) 				   { $this->age = $age; 								 }
	public function setToken($token) 			   { $this->token = $token; 							 }
	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; 				 }
	public function setDateUpdated($dateUpdated)   { $this->dateUpdated = $dateUpdated; 				 }
	public function setStatus($status) 			   { $this->status = $status; 							 }
	public function setRole($role) 			   	   { $this->role = $role; 							 	 }
}
?>
