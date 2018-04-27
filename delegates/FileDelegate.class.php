<?php
class FileDelegate {

	public function process(&$params) {
		if (!empty($params['FILES'])) {
			$this->manageFiles($object, $params['FILES']);
		}
	}

	public function setting(&$data, $columns, $objectName, $redirect) {
		if ($data['errors'] === FALSE) {
			$installation = ClassUtils::constructObjectWithParameters($columns, INSTALLATION_CLASS_NAME);
			$this->setConfData($installation);
			header(LOCATION . DIRNAME . $redirect);
			exit;
		}
	}

	private function manageFiles(&$object, $files) {
		$filesUrl = $this->uploadFiles($files);
		ClassUtils::setObjectColumns($object, $filesUrl);
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
}
?>