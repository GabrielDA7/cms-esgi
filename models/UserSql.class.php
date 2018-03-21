<?php
	
	class UserSql extends BaseSql {

		public function __construct() {
			BaseSql::__construct();
		}

		public function login() {
			$query = $this->db->prepare("SELECT * FROM User WHERE userName=:userName AND pwd=:pwd");
			$query->execute(array(":userName" => $this->getUserName(),":pwd" => $this->getPwd()));
			if($user = $query->fetch()) {
				$query->closeCursor();
				$this->checkPremiumDate($user);
				$_SESSION['userName'] = $user['userName'];
				$_SESSION['token'] = $user['token'];
				$_SESSION['premium'] = $user['premium'];
				header('Location: '.DIRNAME);
			} else {
				return true;
			}
		}

		private function checkPremiumDate(&$user) {
			$this->setId($user['id']);
			$queryString = "SELECT * FROM User u, Premium p WHERE p.User_id=u.id AND u.id=:id AND p.end_date>NOW()";
			$query = $this->db->prepare($queryString);
			$query->execute(array(":id" => $this->getId()));
			if($response = $query->fetch()) {
				if($response['premium'] == 0) {
					$this->setPremium(true);
					$this->update();
					$user['premium'] = 1;
				}
			} else {	
				$user['premium'] = 0;
			}
		}

		private function setPremiumStatus() {

		}
	}
?>