<?php
class ObjectDelegate {

	private $objectName;
	private $lowerCaseFirstObjectName;

	public function __construct(&$data, $objectName) {
		$this->lowerCaseFirstObjectName = lcfirst($objectName);
		$this->objectName = ucfirst($objectName);
		$this->createObjectAndPutInData($data);
	}

	private function createObjectAndPutInData(&$data) {
		$data[$this->lowerCaseFirstObjectName] = ClassUtils::constructObject($this->objectName);
	}

	public function getById(&$data, $params, $othersTablesColumns = []) {
		$object = $data[$this->lowerCaseFirstObjectName];
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
		$data[$this->lowerCaseFirstObjectName] = $object;
	}

	public function getByParameters(&$data, $params, $othersTablesColumns = []) {
		$object = $data[$this->lowerCaseFirstObjectName];
		$object = ClassUtils::setObjectColumns($object, $params);
		$objects = $object->getWithParameters();
		$data[$this->lowerCaseFirstObjectName."s"] = $objects;
	}

	public function getAll(&$data) {
		$object  = $data[$this->lowerCaseFirstObjectName];
		$objects = $object->getAll($data);
		$data[$this->lowerCaseFirstObjectName."s"] = $objects;
		$data['itemsNumber'] = count($data[$this->lowerCaseFirstObjectName."s"]);
	}

	public function add(&$data, $params) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
			ClassUtils::setObjectColumns($object, $params['POST']);
			if ($this->objectName == USER_CLASS_NAME) {
				$object->generateToken();
				$object->generateEmailConfirm();
			}
			$data[$this->lowerCaseFirstObjectName] = $object->insert();
		}
	}

	public function update(&$data, $params, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
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

	public function search(&$data, $params) {
		$object = $data[$this->lowerCaseFirstObjectName];
		$columnsToSearch = $object->getColumnsToSearch();
		$object = $object->getByWord($params['GET']['search'], $columnsToSearch);
		$data[$this->lowerCaseFirstObjectName] = $object;
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
	
	public function getObjectName() 	   		  { return $this->objectName; 		  	    }
	public function getLowerCaseFirstObjectName() { return $this->lowerCaseFirstObjectName; }

	public function setObjectName($objectName) 				 			   { $this->objectName = $objectName; 			  				  }
	public function setLowerCaseFirstObjectName($lowerCaseFirstObjectName) { $this->lowerCaseFirstObjectName = $lowerCaseFirstObjectName; }
}
?>