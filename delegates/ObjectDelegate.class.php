<?php
class ObjectDelegate {

	public function __construct() {}
	
	public function pushObjectById(&$data, $params, $objectName) {
		if ($objectName == USER_CLASS_NAME && isset($_SESSION['userId'])) {
			$params['POST']['id'] = $_SESSION['userId'];
		}
		$object = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$object = $object->getById();
		$data[lcfirst($objectName)] = $object;
	}

	public function pushObjectsByParameters(&$data, $params, $objectName) {
		$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
		$objects = $object->getWithParameters();
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function pushAllObjects(&$data, $params, $objectName) {
		$object  = new $objectName();
		$objects = $object->getAll();
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function add($params, $objectName) {
		if (empty($data['errors'])) {
			$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$object->generateToken();
			}
			$object->insert();
		}
	}

	public function update(&$data, $params, $objectName, $redirectFront, $redirectBack) {
		if (empty($data['errors'])) {
			$objects = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$objects->unsetRoleIfNotAdmin();
			}
			$objects->update();
			header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
			exit;
		} else {
			$this->objectDelegate->pushObjectById($data, $params, $objectName);
		}
	}

	public function delete($params, $objectName, $redirectFront, $redirectBack) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$objects->delete();
		header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
	}

	public function listAll(&$data, $params, $objectName) {
		if (empty($data['errors'])) {
			$this->pushObjectsByParameters($data, $params, $objectName);
		} else {
			$this->pushAllObjects($data, $params, $objectName);
		}
	}

	public function login(&$data, $params) {
		if (empty($data['errors'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$data['wrongPassword'] = $user->login();
		}
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		header(LOCATION . DIRNAME);
	}
}
?>