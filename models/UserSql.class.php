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
			$this->setIdUser($user['idUser']);
			$queryString = "SELECT * FROM User u, Premium p WHERE p.User_idUser=u.idUser AND u.idUser=:id AND p.end_date>NOW()";
			$query = $this->db->prepare($queryString);
			$query->execute(array(":id" => $this->getIdUser()));
			if($response = $query->fetch()) {
				if($response['premium'] == false) {
					$this->setPremium(true);
					$this->save();
					$user['premium'] = true;
					die(var_dump($user));
				}
			} else {	
				$user['premium'] = false;
			}
		}

		private function setPremiumStatus() {

		}
	}
?>