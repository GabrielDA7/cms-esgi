<?php
class AuthenticationDelegate {

	public function __construct() {}

	public function process(&$datas, $params, $checkToken = FALSE) {
		if ($checkToken) {
			$this->checkTokenValidity();
		}
		if (!empty($datas)) {
			$this->checkBackOfficeViewPermission($datas, $params['URL']);
		}
	}

	private function checkTokenValidity() {
		if (isset($_SESSION['userId']) && isset($_SESSION['token'])) {
			$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
			$user = $user->getById();
			if ($user->getToken() == $_SESSION['token']) {
				$_SESSION['token'] = $user->generateToken();
				$user->setPwd(null);
				$user->update();
			} else {
				return404View();
			}
		} else {
			return404View();
		}
	}

	private function checkBackOfficeViewPermission(&$datas, $url) {
		if ((isset($url[2]) && $url[2] === "back") && (isset($_SESSION['admin']) && $_SESSION['admin'] || isset($url[1]) && $url[1] === "login")) {
			$datas['view']=$datas['backView'];
			$datas['template']=$datas['backTemplate'];
		} else {
			$datas['view']=$datas['frontView'];
			$datas['template']=$datas['frontTemplate'];
		}
	}
}