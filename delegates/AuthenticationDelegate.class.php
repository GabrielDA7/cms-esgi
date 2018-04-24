<?php
class AuthenticationDelegate {

	public function __construct() {}

	public function process(&$data, $params, $checkToken = FALSE) {
		if ($checkToken || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
      		$this->checkTokenValidity(); 
    	} 
    	if (!empty($data)) { 
      		$this->getViewTemplateNames($data, $params['URL']); 
   	 	} else {
   	 		$this->setDefaultViewTemplateNames($data); 
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

	private function getViewTemplateNames(&$data, $url) {
		if ($this->checkBackOfficeViewPermission($data, $url)) {
			$data['view'] = $data['backView'];
			$data['template'] = $data['backTemplate'];
		} else {
			$data['view'] = $data['frontView'];
			$data['template'] = $data['frontTemplate'];
		}
	}

	private function checkBackOfficeViewPermission($data, $url) {
		if (isset($data['backView'])) {
			if (isset($url[2]) && $url[2] === "back" || isset($url[1]) && $url[1] === "login") {
				if (isset($_SESSION['admin']) && $_SESSION['admin']) {
					return TRUE;
				}
			} 
		} else {
			return FALSE;
		}
	}

	private function setDefaultViewTemplateNames(&$data) {
		$data['view'] = HOME_VIEW;
		$data['template'] = FRONT_TEMPLATE;
	}
}
?>