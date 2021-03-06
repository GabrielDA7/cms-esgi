<?php
class UserDelegate extends ObjectDelegate {
	
	public function __construct(&$data) {
		ObjectDelegate::__construct($data, USER_CLASS_NAME);
	}

	public function getById(&$data, $params, $othersTablesColumns = []) {
		$user = $data['user'];
		$id = (isset($params['id'])) ? $params['id'] : $_SESSION['userId'];
		$user->setId($id);
		$user = $user->getById();
		$data['user'] = $user;
	}

	public function add(&$data, $params, $redirect = TRUE) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			if ($user->getAvatar() == null)
				$user->setAvatar(DEFAULT_AVATAR);
			$user->generateToken();
			$user->generateEmailConfirm();
			$user->setRole(DEFAULT_ROLE);
			$user->insert();
			if ($redirect)
				RedirectUtils::redirect(USER_EMAIL_CONFIRM_LINK, ["email"=>$user->getEmail()]);
		}
	}

	public function addAdmin($data, $params) {
		if ($data['errors'] === FALSE) {
			$user = $data['user'];
			ClassUtils::setObjectColumns($user, $params['POST']);
			$user->setAvatar(DEFAULT_AVATAR);
			$user->generateToken();
			$user->setEmailConfirm(1);
			$user->setRole(ADMIN_ROLE);
			$user->insert();
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
		$this->getByParameters($data, $params['POST']);
		if (empty($data['users'])) {
			RedirectUtils::redirect404();
		}
		$user = $data['users'][0];
		$user->setEmailConfirm("1");
		$data['user'] = $user;
		$data['errors'] = FALSE;
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

	public function addPremiumStatus($data) {
		if ($data['errors'] === FALSE) {
			$premium = $this->computePremium($data);
			$premium->insert();
		}
	}

	private function computePremium($data) {
		$premiumoffer = $data['premiumoffer'];
		$premium = new Premium();
		$premium->setUserId($_SESSION['userId']);
		$premium->setPremiumOfferId($premiumoffer->getID());
		$today = date('Y-m-d h:i:s', time());
		$premium->setStartDate($today);
		$endDate = date('Y-m-d h:i:s', strtotime("+".$premiumoffer->getDuration()." months", strtotime($today)));
		$premium->setEndDate($endDate);
		return $premium;
	}
}