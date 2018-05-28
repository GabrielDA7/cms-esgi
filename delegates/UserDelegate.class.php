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
			$user->insert();
			RedirectUtils::redirect(USER_EMAIL_CONFIRM_LINK, ["email"=>$user->getEmail()]);
		}
	}

	public function update(&$data, $params, $redirectFront = null, $redirectBack = null) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			if (isset($params['POST'])) {
				ClassUtils::setObjectColumns($user, $params['POST']);
			}
			if (ClassUtils::getCallingFunction() != "checkPasswordReset") {
				$user->setPwd(null);
			}
			$user->unsetRoleIfNotAdmin();
			$user->update();
			if (isset($redirectFront) || isset($redirectBack)) {
				RedirectUtils::redirect((isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
			}
		}
	}

	public function login(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			$data['errors'] = $user->login();
		}
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		RedirectUtils::redirect();
	}

	public function checkEmailConfirmation(&$data, $params) {
		$this->getByParameters($data, $params['GET']);
		if (empty($data['users'])) {
			RedirectUtils::redirect404();
		}
		$user = $data['users'][0];
		$user->setEmailConfirm("1");
		$data['user'] = $user;
		$this->update($data, null, USER_LOGIN_FRONT_LINK);
	}

	public function checkPasswordReset(&$data, $params) {
		if ($data['user']->getpwdReset() !==  $params['POST']['pwdReset']) {
			RedirectUtils::redirect404();
		}
		if ($data['errors'] === FALSE) {
			$data['user']->setPwdReset("1");
			$data['user']->setPwd($params['POST']['pwd']);
			$this->update($data, null, USER_LOGIN_FRONT_LINK);
		}
	}
}