<?php
class UserDelegate extends ObjectDelegate {
	
	public function __construct(&$data) {
		ObjectDelegate::__construct($data, USER_CLASS_NAME);
	}

	public function getById(&$data, $params) {
		$object = $data[$this->lowerCaseFirstObjectName];
		$id = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
		$object->setId($id);
		$object = $object->getById();
		$data[$this->lowerCaseFirstObjectName] = $object;
	}

	public function add($data, $params) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
			ClassUtils::setObjectColumns($object, $params['POST']);
			$object->generateToken();
			$object->generateEmailConfirm();
			$object->insert();
			RedirectUtils::redirect(USER_EMAIL_CONFIRM_LINK, ["email"=>$object->getEmail()]);
		}
	}

	public function update(&$data, $params, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
			ClassUtils::setObjectColumns($object, $params['POST']);
			if (ClassUtils::getCallingFunction() != "passwordResetAction") {
				$object->setPwd(null);
			}
			$object->unsetRoleIfNotAdmin();
			$object->update();
			RedirectUtils::redirect((isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
		}
	}

	public function login(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$data['wrongPassword'] = $user->login();
		}
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		RedirectUtils::redirect();
	}
}
?>