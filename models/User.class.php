<?php
class User extends UserSql {

	protected $id = null;
	protected $userName;
	protected $name;
	protected $firstName;
	protected $pwd;
	protected $email;
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
		$this->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
		return $this->token;
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
	* Configuration of the form add user
	*/
	public static function configFormAdd(){
		return [
					"config"=>["method"=>"POST", "action"=> DIRNAME.USER_ADD_FRONT_LINK, "submit"=>"Sign in"],
					"input"=>[

						"firstName"=>[
										"type"=>"text",
										"placeholder"=>"First name",
										"required"=>true,
										"maxString"=>100,
										"minString"=>2
									],
						"lastname"=>[
										"type"=>"text",
										"placeholder"=>"Name",
										"required"=>true,
										"maxString"=>100,
										"minString"=>2
									],
						"userName"=> [
										"type"=>"text",
										"placeholder"=>"Username",
										"required"=>true,
										"maxString"=>100,
										"minString"=>2
									],
						"email"=>[
										"type"=>"email",
										"placeholder"=>"Email",
										"required"=>true
									],
						"emailConfirmation"=>[
										"type"=>"email",
										"placeholder"=>"Confirmation of email",
										"required"=>true,
										"confirm"=>"email"
										],
						"pwd"=>[
										"type"=>"password",
										"placeholder"=>"Password",
										"required"=>true
									],
						"pwdConfirmation"=>[
										"type"=>"password",
										"placeholder"=>"Confirmation of password",
										"required"=>true,
										"confirm"=>"pwd"
									],
					]
		];

	}


	public function getUserName() 	  { return $this->userName; 	 }
	public function getId() 		  { return $this->id; 			 }
    public function getName() 		  { return $this->name; 		 }
    public function getFirstName() 	  { return $this->firstName; 	 }
    public function getPwd() 		  { return $this->pwd; 			 }
    public function getEmail() 		  { return $this->email;   		 }
    public function getAge() 		  { return $this->age; 			 }
    public function getToken() 		  { return $this->token; 		 }
    public function getDateInserted() { return $this->date_inserted; }
    public function getDateUpdated()  { return $this->dateUpdated;   }
    public function getStatus()		  { return $this->status; 		 }
    public function getRole()		  { return $this->role; 		 }


    public function setUserName($userName) 		   { $this->userName = $userName; 						 }
    public function setId($id) 					   { $this->id = $id; 								  	 }
	public function setName($name) 				   { $this->name = ucfirst(strtolower($name)); 			 }
	public function setFirstName($firstName) 	   { $this->firstName = ucfirst(strtolower($firstName)); }
	public function setPwd($pwd) 			 	   { $this->pwd = (isset($pwd))? sha1($pwd) : null; 	 }
	public function setEmail($email) 			   { $this->email = strtolower(trim($email)); 			 }
	public function setAge($age) 				   { $this->age = $age; 								 }
	public function setToken($token) 			   { $this->token = $token; 							 }
	public function setDateInserted($dateInserted) { $this->dateInserted = $dateInserted; 				 }
	public function setDateUpdated($dateUpdated)   { $this->dateUpdated = $dateUpdated; 				 }
	public function setStatus($status) 			   { $this->status = $status; 							 }
	public function setRole($role) 			   	   { $this->role = $role; 							 	 }
}
?>
