<?php
class AuthenticationDelegate {

	public function __construct() {}

	public function process(&$data, $params, $checkToken, $views = [], $templates = DEFAULT_TEMPLATES) {
		if ($checkToken || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
      		$this->checkTokenValidity(); 
    	}
    	if (!empty($views)) { 
      		$this->getViewTemplateNames($data, $params['URL'], $views, $templates); 
   	 	} else {
   	 		$this->setDefaultViewTemplateNames($data); 
   	 	}
	}

	private function checkTokenValidity() {
		if (!isset($_SESSION['userId']) || !isset($_SESSION['token'])) {
			return404View();
		}
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user = $user->getById();
		if ($user->getToken() != $_SESSION['token']) {
			header(LOCATION . DIRNAME . USER_DISCONNECT_LINK . "?disconnect=1");
			exit();
		}
		$_SESSION['token'] = $user->generateToken();
		$user->setPwd(null);
		$user->update();
	}

	private function getViewTemplateNames(&$data, $url, $views, $templates) {
		if ($this->checkBackOfficeViewPermission($url)) {
			$data['view'] = $views['back'];
			$data['template'] = $templates['back'];
		} else {
			$data['view'] = $views['front'];
			$data['template'] = $templates['front'];
		}
	}

	private function checkBackOfficeViewPermission($url) {
		if (isset($url[2]) && $url[2] === "back" || isset($url[1]) && $url[1] === "login") {
			if (isset($_SESSION['admin']) && $_SESSION['admin']) {
				return TRUE;
			}
		} 
		return FALSE;
	}

	private function setDefaultViewTemplateNames(&$data) {
		$data['view'] = HOME_VIEW;
		$data['template'] = FRONT_TEMPLATE;
	}
}
?>