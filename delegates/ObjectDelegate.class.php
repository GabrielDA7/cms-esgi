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
		if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function pushAllObjects(&$data, $objectName) {
		$object  = new $objectName();
		$objects = $object->getAll();
		if (!empty($othersTablesColumns)) {
			$this->setReferencedObjectsColumns($othersTablesColumns, $objectName, $id, $object);
		}
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function add(&$data, $params, $objectName) {
		if ($data['errors'] === FALSE) {
			$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$object->generateToken();
				$object->generateEmailConfirm();
			}
			if (!empty($params['FILES'])) {
				$this->manageFiles($object, $params['FILES']);
			}
			$data[lcfirst($objectName)] = $object->insert();
		}
	}

	public function update(&$data, $params, $objectName, $redirectFront, $redirectBack) {
		if ($data['errors'] === FALSE) {
			$objects = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$objects->unsetRoleIfNotAdmin();
			}
			$objects->update();
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
		if ($data['errors'] === FALSE) {
			$this->pushObjectsByParameters($data, $params['POST'], $objectName);
		} else {
			$this->pushAllObjects($data, $objectName);
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
		header(LOCATION . DIRNAME);
		exit;
	}

	public function setting(&$data, $params, $objectName, $redirect) {
		if ($data['errors'] === FALSE) {
			$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
			$this->setConfData($installation);
			header(LOCATION . DIRNAME . $redirect);
			exit;
		}
	}

	public function createdatabase() {
		$fileContent = $this->getContentFromConfFile("install/uteach.sql");
		$BaseSql = new BaseSql(); 
		$BaseSql->createDatabase($fileContent);
		header(LOCATION . DIRNAME . INSTALLATION_ADMIN_LINK);
		exit;
	}



	private function setConfData($installation) {
		$fname = "conf.inc.php";
		$content = $this->getContentFromConfFile($fname);
		$this->replaceData($content, $installation);
		$this->overwriteContentFromConfFile($fname, $content);
	}

	private function getContentFromConfFile($fname) {
		$fhandle = fopen($fname,"r");
		$content = fread($fhandle,filesize($fname));
		fclose($fhandle);
		return $content;
	}

	private function overwriteContentFromConfFile($fname, $content) {
		$fhandle = fopen($fname,"w");
		fwrite($fhandle,$content);
		fclose($fhandle);
	}

	private function replaceData(&$content, $installation) {
		if ($installation->getInstallationDone()) {
			$content = str_replace("FALSE", "TRUE", $content);
		} else {
			$columns = ClassUtils::removeUnsusedColumns($installation, get_class_vars(get_class()));
			foreach ($columns as $key => $value) {
				$content = str_replace(constant(strtoupper($key)), $value, $content);
			}
		}
	}

	private function manageFiles($object, $files) {
		$filesUrl = $this->uploadFiles($files);
		ClassUtils::setObjectColumns($object, $filesUrl);
	}

	private function uploadFiles($files) {
		$filesUrl = [];
		foreach ($files as $key => $value) {
		    if ($value['error'] == UPLOAD_ERR_OK) {
		        $tmp_name = $value["tmp_name"];
		        $name = basename($value["name"]);
		        $filesUrl += [$key => IMAGE_FOLDER_NAME."/".$name];
		        move_uploaded_file($tmp_name, IMAGE_FOLDER_NAME."/".$name);
		    }
		}
		return $filesUrl;
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