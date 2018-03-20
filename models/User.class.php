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

		protected $date_inserted;
		protected $date_updated;
		protected $status=0;
		protected $premium;

		public function __construct($userName=null, $name=null, $firstName=null, $email=null, $age=null, $pwd=null, $premium=null, 
			$date_inserted=null) {
			UserSql::__construct();
			$this->userName = $userName;
			$this->name = $name;
			$this->firstName = $firstName;
			$this->email = $email;
			$this->age = $age;
			$this->pwd = $pwd;
			$this->premium = $premium;
			$this->date_inserted = $date_inserted;

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
	    public function setDateInserted($date_inserted) {
	        $this->date_inserted = $date_inserted;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDateUpdated() {
	        return $this->date_updated;
	    }

	    /**
	     * @param mixed $date_updated
	     *
	     * @return self
	     */
	    public function setDateUpdated($date_updated) {
	        $this->date_updated = $date_updated;
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