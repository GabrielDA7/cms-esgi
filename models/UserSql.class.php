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
				$_SESSION['userName'] = $user['userName'];
				$_SESSION['token'] = $user['token'];
				$_SESSION['premium'] = $this->checkPremiumDate($user['id']);
				header('Location: '.DIRNAME);
			} else {
				return true;
			}
		}

		public function loginAdmin(){
			$query = $this->db->prepare("SELECT * FROM User WHERE userName=:userName AND pwd=:pwd AND role_id=:role_id ");
			$query->execute(array(":userName" => $this->getUserName(),":pwd" => $this->getPwd(), ":role_id" => $this->getRoleId()));
			if($user = $query->fetch()) {
				$query->closeCursor();
				$_SESSION['userName'] = $user['userName'];
				$_SESSION['token'] = $user['token'];
				//$_SESSION['premium'] = $this->checkPremiumDate($user['id']);
				header('Location: ' . DIRNAME . 'statistic');
			} else {
				return true;
			}
		}

		private function checkPremiumDate($id) {
			$queryString = "SELECT * FROM User u, Premium p WHERE p.User_id=u.id AND u.id=:id AND p.end_date>NOW()";
			$query = $this->db->prepare($queryString);
			$query->execute(array(":id" => $id));
			if($response = $query->fetch()) {
				return 1
			} else {
				return 0;
			}
		}
	}
?>
