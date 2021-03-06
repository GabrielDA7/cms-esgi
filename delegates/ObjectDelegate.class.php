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
		$id = (isset($params['GET']['id'])) ? $params['GET']['id'] : $params['POST']['id'];
		$object->setId($id);
		$object = $object->getById();

		if ($this->isPremiumContentNotAuthorized() && $object->getPremium() == 1) 
			RedirectUtils::redirect($this->lowerCaseFirstObjectName . "/list");
		
		if (!empty($othersTablesColumns)) 
			ClassUtils::setReferencedObjectsColumns($othersTablesColumns, $object);
		
		$data[$this->lowerCaseFirstObjectName] = $object;
	}

	public function getByParameters(&$data, $params) {
		$object = $data[$this->lowerCaseFirstObjectName];
		ClassUtils::setObjectColumns($object, $params);
		$objects = $object->getWithParameters($data);
		$data['itemsNumber'] = $object->countItems();
		$data[$this->lowerCaseFirstObjectName."s"] = $objects;
	}

	public function getAll(&$data, $params) {
		if (!$this->isUnpublishedContentAuthorized($data, $params))
			return;
		$object  = $data[$this->lowerCaseFirstObjectName];
		$objects = $object->getAll($data);
		$data['itemsNumber'] = $object->countItems();
		$data[$this->lowerCaseFirstObjectName."s"] = $objects;
	}

	public function add(&$data, $params, $redirect = null) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
			ClassUtils::setObjectColumns($object, $params['POST']);
			$this->setUserIdWithSession($object);
			if (method_exists($data[$this->lowerCaseFirstObjectName], "setId")) 
				$data[$this->lowerCaseFirstObjectName]->setId($object->insert());
			else
				$object->insert();
			if ($arrayOfChidren = ClassUtils::getIfExistArrayFromObject($data[$this->lowerCaseFirstObjectName])) {
				$this->addChildren($data, $arrayOfChidren);
			}
			if (isset($redirect))
				RedirectUtils::redirect($redirect);
		}
	}

	private function addChildren($data, $arrayOfChidren) {
		$parentId = $data[$this->lowerCaseFirstObjectName]->getId();
		$childrenObjectName = substr_replace(key($arrayOfChidren), "", strlen(key($arrayOfChidren))-1);
		$childrenObjectName = ucfirst($childrenObjectName);
		foreach ($arrayOfChidren[key($arrayOfChidren)] as $key => $value) {
			$childObject = new $childrenObjectName();
			ClassUtils::setObjectColumns($childObject, $value);
			$setter = "set" . $this->objectName . "Id";
			$childObject->$setter($data[$this->lowerCaseFirstObjectName]->getId());
			$this->setUserIdWithSession($childObject);
			$childObject->insert();
		}
	}

	private function setUserIdWithSession($object) {
		$columns = $object->getColumns();
		if (array_key_exists("user_id", $columns) && isset($_SESSION["userId"]))
			$object->setUserId($_SESSION["userId"]);
	}

	public function update(&$data, $params, $redirectFront = null, $redirectBack = null) {
		if ($data['errors'] === FALSE) {
			$object = $data[$this->lowerCaseFirstObjectName];
			ClassUtils::setObjectColumns($object, $params['POST']);
			$object->update();
			if (isset($redirectFront) || isset($redirectBack))
				RedirectUtils::redirect((isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
		}
	}

	public function delete($params, $redirectFront, $redirectBack) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $this->objectName);
		$objects->delete();
		RedirectUtils::redirect((isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
	}

	public function search(&$data, $params) {
		$object = $data[$this->lowerCaseFirstObjectName];
		$columnsToSearch = $object->getColumnsToSearch();
		$objects = $object->getByWord($params['GET']['search'], $columnsToSearch, $data);
		$data['itemsNumber'] = $object->countItems("id", $params['GET']['search'], $columnsToSearch);
		$data[$this->lowerCaseFirstObjectName."s"] = $objects;
	}

	private function isUnpublishedContentAuthorized(&$data, $params) {
		if (isset($params['GET']['status']) && $params['GET']['status'] == PUBLISHED_CONTENT) {
			$this->getByParameters($data, $params['GET']);
			return FALSE;
		}
		return TRUE;
	}

	private function isPremiumContentNotAuthorized() {
		if ((!isset($_SESSION['premium']) || !$_SESSION['premium']) && !isAdmin()) {
			if ($this->objectName != USER_CLASS_NAME && $this->objectName != PREMIUMOFFER_CLASS_NAME)
				return TRUE;
		}
		return FALSE;
	}

	public function getObjectName() 	   		  { return $this->objectName; 		  	    }
	public function getLowerCaseFirstObjectName() { return $this->lowerCaseFirstObjectName; }

	public function setObjectName($objectName) 				 			   { $this->objectName = $objectName; 							}
	public function setLowerCaseFirstObjectName($lowerCaseFirstObjectName) { $this->lowerCaseFirstObjectName =$lowerCaseFirstObjectName;}
}
