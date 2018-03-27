<?php
class UserSql extends BaseSql {

	public function __construct() {
		BaseSql::__construct();
	}

	public function login() {
		$columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, ALL, $columns);
		$query = $this->db->prepare($queryString);
		$query->execute($columns);
		if ($user = $query->fetch()) {
			$query->closeCursor();
			$_SESSION['userName'] = $user['userName'];
			$_SESSION['token'] = $user['token'];
			$_SESSION['premium'] = $this->checkPremiumDate($user['id']);
			header(LOCATION . DIRNAME);
		} else {
			return TRUE;
		}
	}

	private function checkPremiumDate($id) {
		$queryString = "SELECT * FROM User u, Premium p WHERE p.User_id=u.id AND u.id=:id AND p.end_date>NOW()";
		$query = $this->db->prepare($queryString);
		$query->execute(array(":id" => $id));
		if ($response = $query->fetch()) {
			return TRUE;
		} else {	
			return FALSE;
		}
	}
}
?>