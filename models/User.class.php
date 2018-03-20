<?php
	class User extends UserSql {

		protected $id = null;
		protected $userName;
		protected $name;
		protected $firstName;
		protected $pwd;
		protected $email;
		protected $age=0;
		protected $token=12345;

		protected $dateInserted;
		protected $dateUpdated;
		protected $status=0;
		protected $premium = false;

		public function __construct($userName, $name, $firstName, $email, $age, $pwd, $premium=false, $dateInserted=null) {
			UserSql::__construct();
			$this->userName = $userName;
			$this->name = $name;
			$this->firstName = $firstName;
			$this->email = $email;
			$this->age = $age;
			$this->setPwd($pwd);
			$this->premium = $premium;
			$this->dateInserted = $dateInserted;

		}

		public function __destruct() {

		}

		public function generateToken() {
			$this->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
		}
	
		/**
	     * @param mixed $id
	     *
	     * @return self
	     */
	    public function setUserName($userName) {
	        $this->userName = $userName;
	    }

	    /**
	     * @return mixed
	     */
	    public function getUserName() {
	        return $this->userName;
	    }

	    /**
	     * @return mixed
	     */
	    public function getId() {
	        return $this->id;
	    }

	    /**
	     * @param mixed $id
	     *
	     * @return self
	     */
	    public function setId($id) {
	        $this->id = $id;
	    }

	    /**
	     * @return mixed
	     */
	    public function getName() {
	        return $this->name;
	    }

	    /**
	     * @param mixed $name
	     *
	     * @return self
	     */
	    public function setName($name) {
	        $this->name = strtoupper(ucfirst($name));
	    }

	    /**
	     * @return mixed
	     */
	    public function getFirstName(){
	        return $this->firstName;
	    }

	    /**
	     * @param mixed $firstName
	     *
	     * @return self
	     */
	    public function setFirstName($firstName) {
	        $this->firstName = strtoupper(ucfirst($firstName));
	    }

	    /**
	     * @return mixed
	     */
	    public function getPwd() {
	        return $this->pwd;
	    }

	    /**
	     * @param mixed $pwd
	     *
	     * @return self
	     */
	    public function setPwd($pwd) {
	        $this->pwd = sha1($pwd);
	    }

	    /**
	     * @return mixed
	     */
	    public function getEmail()
	    {
	        return $this->email;
	    }

	    /**
	     * @param mixed $email
	     *
	     * @return self
	     */
	    public function setEmail($email) {
	        $this->email = strtolower(trim($email));
	    }

	    /**
	     * @return mixed
	     */
	    public function getAge() {
	        return $this->age;
	    }

	    /**
	     * @param mixed $age
	     *
	     * @return self
	     */
	    public function setAge($age) {
	        $this->age = $age;
	    }

	    /**
	     * @return mixed
	     */
	    public function getToken() {
	        return $this->token;
	    }

	    /**
	     * @param mixed $token
	     *
	     * @return self
	     */
	    public function setToken($token) {
	        $this->token = $token;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDateInserted() {
	        return $this->date_inserted;
	    }

	    /**
	     * @param mixed $date_inserted
	     *
	     * @return self
	     */
	    public function setDateInserted($dateInserted) {
	        $this->dateInserted = $dateInserted;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDateUpdated() {
	        return $this->dateUpdated;
	    }

	    /**
	     * @param mixed $date_updated
	     *
	     * @return self
	     */
	    public function setDateUpdated($dateUpdated) {
	        $this->dateUpdated = $dateUpdated;
	    }

	    /**
	     * @return mixed
	     */
	    public function getStatus() {
	        return $this->status;
	    }

	    /**
	     * @param mixed $status
	     *
	     * @return self
	     */
	    public function setStatus($status) {
	        $this->status = $status;
	    }

	    /**
	     * @return mixed
	     */
	    public function getPremium() {
	        return $this->premium;
	    }

	    /**
	     * @param mixed $status
	     *
	     * @return self
	     */
	    public function setPremium($premium) {
	        $this->premium = $premium;
	    }
	}
?>