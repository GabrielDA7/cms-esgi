<?php
class FileDelegate {

	private $objectName;

	public function __construct($objectName) {
		$this->objectName = $objectName;
	}

	public function process(&$data, &$params, $folderName) {
		if (!empty($params['FILES'])) {
			$this->manageFiles($data[lcfirst($this->objectName)], $params['FILES'], $folderName);
		}
	}

	public function setting(&$data, $columns, $redirect = null) {
		if ($data['errors'] === FALSE) {
			$installation = ClassUtils::constructObjectWithParameters($columns, $this->objectName);
			$this->setConfData($installation);
			if (isset($redirect))
				RedirectUtils::redirect($redirect);
		}
	}

	private function manageFiles(&$object, $files, $folderName) {
		$filesUrl = $this->uploadFiles($files, $folderName);
		ClassUtils::setObjectColumns($object, $filesUrl);
	}

	public function createDatabase() {
		$fileContent = $this->getContentFromConfFile("install/uteach.sql");
		$BaseSql = new BaseSql();
		if ($BaseSql->createDatabase($fileContent))
			RedirectUtils::redirect(INSTALLATION_SETTING_LINK);
		RedirectUtils::redirect(INSTALLATION_DATABASE_LINK);	
	}

	private function setConfData($installation) {
		$fname = "bin/conf.inc.php";
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
				if (defined(strtoupper($key)))
					$content = str_replace(constant(strtoupper($key)), $value, $content);
			}
		}
	}

	private function uploadFiles($files, $folderName) {
		$filesUrl = [];
		foreach ($files as $key => $value) {
			if ($value['error'] == UPLOAD_ERR_OK) {
				$tempName = $value["tmp_name"];
				$fileName = basename($value["name"]);
				$path = IMAGE_FOLDER_NAME . "/" . $folderName;
				$this->createFolderIfNotExists($path);
				$filesUrl += [$key => $path."/".$fileName];
				move_uploaded_file($tempName, $path."/".$fileName);
				$tempUrl = DIRNAME . $filesUrl[$key];
				$filesUrl[$key] = $tempUrl;
			}
		}
		return $filesUrl;
	}

	private function createFolderIfNotExists($path) {
		if (!is_dir($path))
		    mkdir($path);
	}


	public function getObjectName() { return $this->objectName; }
	public function setObjectName($objectName) { $this->objectName = $objectName; }
}
