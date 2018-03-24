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
	}

	public function setUserName($userName) {
		$this->userName = $userName;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = ucfirst(strtolower($name));
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = ucfirst(strtolower($firstName));
	}

	public function getPwd() {
		return $this->pwd;
	}

	public function setPwd($pwd) {
		$this->pwd = sha1($pwd);
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = strtolower(trim($email));
	}

	public function getAge() {
		return $this->age;
	}

	public function setAge($age) {
		$this->age = $age;
	}

	public function getToken() {
		return $this->token;
	}

	public function setToken($token) {
		$this->token = $token;
	}

	public function getDateInserted() {
		return $this->date_inserted;
	}

	public function setDateInserted($dateInserted) {
		$this->dateInserted = $dateInserted;
	}

	public function getDateUpdated() {
		return $this->dateUpdated;
	}

	public function setDateUpdated($dateUpdated) {
		$this->dateUpdated = $dateUpdated;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
}
?>