<?php
class UserDelegate extends ObjectDelegate {
	
	public function __construct(&$data) {
		ObjectDelegate::__construct($data, USER_CLASS_NAME);
	}

	public function getById(&$data, $params, $othersTablesColumns = []) {
		$user = $data['user'];
		$id = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
		$user->setId($id);
		$user = $user->getById();
		$data['user'] = $user;
	}

	public function add(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			$user->generateToken();
			$user->generateEmailConfirm();
			$user->insert();
			RedirectUtils::redirect(USER_EMAIL_CONFIRM_LINK, ["email"=>$user->getEmail()]);
		}
	}

	public function update(&$data, $params, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			if (ClassUtils::getCallingFunction() != "passwordResetAction") {
				$user->setPwd(null);
			}
			$user->unsetRoleIfNotAdmin();
			$user->update();
			RedirectUtils::redirect((isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
		}
	}

	public function login(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			$data['wrongPassword'] = $user->login();
		}
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		RedirectUtils::redirect();
	}

	public function checkEmailConfirmation(&$data, $params) {
		$user = $data['user'];
		ClassUtils::setObjectColumns($user, $params['GET']);
		$user = $user->getWithParameters();
		if (empty($user)) {
			RedirectUtils::redirect404();
		}
		$user[0]->setEmailConfirm("1");
		$user[0]->update();
		RedirectUtils::redirect(USER_LOGIN_FRONT_LINK);
	}

	public function checkPasswordReset($params) {
		$user = $data['user'];
		ClassUtils::setObjectColumns($user, $params['POST']);
		$user = $user->getWithParameters();
		if (empty($user)) {
			RedirectUtils::redirect404();
		}
		$user->setPwdReset("1");
		$user->setPwd($params['POST']['newPwd']);
		$user->update();
		RedirectUtils::redirect(USER_LOGIN_FRONT_LINK);
	}
}
?>