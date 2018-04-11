<?php
class UserSql extends BaseSql {

	public function __construct() {
		BaseSql::__construct();
	}

	public function login() {
		$user = $this->getWithParameters();
		if (!empty($user)) {
			$this->setSession($user[0]);
		} else {
			return TRUE;
		}
	}

	public function disconnect() {
		session_destroy();
		$this->setConnectedStatus($this, DISCONNECTED_STATUS);
	}

	private function setSession($user) {
		$_SESSION['userName'] = $user->getUserName();
		$_SESSION['token'] = $user->getToken();
		$_SESSION['userId'] = $user->getid();
		$_SESSION['premium'] = $this->checkPremiumDate($user->getid());
		$this->setConnectedStatus($user, CONNECTED_STATUS);
		if ($this->checkAdminStatus($user->getid()) === TRUE) {
			$_SESSION['admin'] = TRUE;
			header(LOCATION . DIRNAME . STATISTIC_INDEX_BACK_LINK);
		} else {
			header(LOCATION . DIRNAME);
		}
	}

	private function setConnectedStatus($user, $status) {
		$user->setPwd(null);
		$user->setStatus($status);
		$user->update();
	}

	private function checkPremiumDate($id) {
		$queryString = "SELECT * FROM User u, Premium p WHERE p.User_id=u.id AND u.id=:id AND p.endDate>NOW()";
		$query = $this->db->prepare($queryString);
		$query->execute(array(":id" => $id));
		return $this->hasResult($query);
	}

	private function checkAdminStatus($id) {
		$adminUser = ClassUtils::constructObjectWithParameters(array("id" => $id, "role" => ADMIN_ROLE), USER_CLASS_NAME);
		$adminUser = $adminUser->getWithParameters();
		return (!empty($adminUser)? TRUE : FALSE);
	}
}
?>