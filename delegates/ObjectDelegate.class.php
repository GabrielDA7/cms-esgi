<?php
class ObjectDelegate {

	public function __construct() {}

	public function add($params, $objectName) {
		$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
		if ($objectName == USER_CLASS_NAME) {
			$object->generateToken();
		}
		$object->insert();
	}

	public function pushObjectById(&$datas, $params, $objectName) {
		if ($objectName == USER_CLASS_NAME) {
			$params['POST']['id'] = (isset($params['POST']['id'])) ? $params['POST']['id'] : $_SESSION['userId'];
		}
		$object = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$object = $object->getById();
		$datas['object'] = $object;
	}

	public function pushObjectsByParameters(&$datas, $params, $objectName) {
		$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
		$objects = $object->getWithParameters();
		$datas['objects'] = $objects;
	}

	public function pushAllObjects(&$datas, $params, $objectName) {
		$object  = new $objectName();
		$objects = $object->getAll();
		$datas['objects'] = $objects;
	}

	public function update($params, $objectName) {
		$objects = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
		if ($objectName == USER_CLASS_NAME) {
			$objects->unsetRoleIfNotAdmin();
		}
		$objects->update();
	}

	public function delete($params, $objectName) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$objects->delete();
	}

	public function login(&$datas, $params) {
		$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
		$datas['wrongPassword'] = $user->login();
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
	}
}
?>