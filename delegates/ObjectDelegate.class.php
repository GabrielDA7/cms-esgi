<?php
class ObjectDelegate {

	private $objectName;

	public function __construct(&$data, $objectName) {
		$this->objectName = ucfirst($objectName);
		$this->createObjectAndPutInData($data);
	}

	private function createObjectAndPutInData(&$data) {
		$data[lcfirst($this->objectName)] = ClassUtils::constructObject($this->objectName);
	}

	public function pushObjectById(&$data, $params, $othersTablesColumns = []) {
		$object = $data[lcfirst($this->objectName)];
		if ($this->objectName == USER_CLASS_NAME && isset($_SESSION['userId'])) {
			$id = $_SESSION['userId'];
		}
		if (isset($params['POST']['id'])) {
			$id = $params['POST']['id'];
		}
		$object->setId($id);
		$object = $object->getById();
		if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $id, $object);
		}
		$data[lcfirst($this->objectName)] = $object;
	}

	public function pushObjectsByParameters(&$data, $params, $othersTablesColumns = []) {
		$object = ClassUtils::constructObjectWithParameters($params, $this->objectName);
		$objects = $object->getWithParameters();
		/*if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}*/
		$data[lcfirst($this->objectName)."s"] = $objects;
	}

	public function pushAllObjects(&$data) {
		$object  = ClassUtils::constructObject($this->objectName);
		$objects = $object->getAll();
		/*if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}*/
		$data[lcfirst($this->objectName)."s"] = $objects;
	}

	public function add(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$object = $data[lcfirst($this->objectName)];
			ClassUtils::setObjectColumns($object, $params['POST']);
			if ($this->objectName == USER_CLASS_NAME) {
				$object->generateToken();
				$object->generateEmailConfirm();
			}
			$data[lcfirst($this->objectName)] = $object->insert();
		}
	}

	public function update(&$data, $params, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$object = $data[lcfirst($this->objectName)];
			ClassUtils::setObjectColumns($object, $params['POST']);
			if ($this->objectName == USER_CLASS_NAME) {
				$object->unsetRoleIfNotAdmin();
				$object->setPwd(null);
			}
			$object->update();
			header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
			exit;
		}
	}

	public function delete($params, $redirectFront, $redirectBack) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $this->objectName);
		$objects->delete();
		header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
		exit;
	}

	public function listAll(&$data, $params) {
		if (isset($data['errors']) && $data['errors'] === FALSE) {
			$this->pushObjectsByParameters($data, $params['POST']);
		} else {
			$this->pushAllObjects($data);
		}
	}

	public function search($params) {
		$object = ClassUtils::constructObject($this->objectName);
		$columnsToSearch = $object->getColumnsToSearch();
		return $object->getByWord($params['GET']['search'], $columnsToSearch);
	}

	public function getAll($params) {
		$object  = ClassUtils::constructObject($this->objectName);
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

	private function setReferencedObjectsColumns($othersTablesColumns, $id, &$object) {
		foreach ($othersTablesColumns as $table) {
			$objectWithForeignKeyValue = ClassUtils::constructObjectWithParameters([lcfirst($this->objectName)."_id" => $id], $table);
			$referencedObjects = $objectWithForeignKeyValue->getWithParameters();
			$setColumn = "set" . ucfirst($table) . "s";
			$object->$setColumn($referencedObjects);
		}
	}

	
	public function getObjectName() { return $this->objectName; }
	public function setObjectName($objectName) { $this->objectName = $objectName; }
}
?>