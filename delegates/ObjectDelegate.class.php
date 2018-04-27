<?php
class ObjectDelegate {

	public function __construct() {}
	
	public function pushObjectById(&$data, $id, $objectName, $othersTablesColumns = []) {
		if ($objectName == USER_CLASS_NAME && isset($_SESSION['userId'])) {
			$id = $_SESSION['userId'];
		}
		$object = ClassUtils::constructObjectWithId($id, $objectName);
		$object = $object->getById();
		if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}
		$data[lcfirst($objectName)] = $object;
	}

	public function pushObjectsByParameters(&$data, $params, $objectName, $othersTablesColumns = []) {
		$object = ClassUtils::constructObjectWithParameters($params, $objectName);
		$objects = $object->getWithParameters();
		/*if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}*/
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function pushAllObjects(&$data, $objectName) {
		$object  = new $objectName();
		$objects = $object->getAll();
		/*if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}*/
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function add(&$data, $params, $objectName) {
		if ($data['errors'] === FALSE) {
			$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$object->generateToken();
				$object->generateEmailConfirm();
			}
			$data[lcfirst($objectName)] = $object->insert();
		}
	}

	public function update(&$data, $params, $objectName, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$object->unsetRoleIfNotAdmin();
			}
			$object->update();
			header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
			exit;
		} else {
			$this->pushObjectById($data, $params['POST']['id'], $objectName);
		}
	}

	public function delete($params, $objectName, $redirectFront, $redirectBack) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$objects->delete();
		header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
		exit;
	}

	public function listAll(&$data, $params, $objectName) {
		if (isset($data['errors']) && $data['errors'] === FALSE) {
			$this->pushObjectsByParameters($data, $params['POST'], $objectName);
		} else {
			$this->pushAllObjects($data, $objectName);
		}
	}

	public function search($params, $objectName) {
		$objectName = ucfirst($objectName);
		$object = new $objectName();
		$columnsToSearch = $object->getColumnsToSearch();
		$object->getByWord($params['GET']['search'], $columnsToSearch);
	}

	public function getAll($params, $objectName) {
		$objectName = ucfirst($objectName);
		$object  = new $objectName();
		$response = $object->getAll(FALSE);
		return $response;
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
		header(LOCATION . DIRNAME);
		exit;
	}

	private function setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, &$object) {
		foreach ($othersTablesColumns as $table) {
			$objectWithForeignKeyValue = ClassUtils::constructObjectWithParameters([lcfirst($objectName)."_id" => $id], $table);
			$referencedObjects = $objectWithForeignKeyValue->getWithParameters();
			$setColumn = "set" . ucfirst($table) . "s";
			$object->$setColumn($referencedObjects);
		}
	}
}
?>