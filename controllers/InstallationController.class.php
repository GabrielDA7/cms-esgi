<?php
class InstallationController {

	public function indexAction($params) {
		if (!INSTALLATION_DONE) {
			$view = new View(INSTALLATION_INDEX_VIEW, INSTALATION_TEMPLATE);
		} else {
			return404View();
		}
	}

	public function settingAction($params) {
		if (!INSTALLATION_DONE || !$_SESSION['admin']) {
			if (isset($params['POST']['submit'])) {
				$this->setConfData($params['POST']);
				header(LOCATION . DIRNAME . INSTALLATION_DATABASE_LINK);
			}
			$view = new View(INSTALLATION_SETTING_VIEW, INSTALATION_TEMPLATE);
		} else {
			return404View();
		}
	}

	public function databaseAction($params) {
		if (!INSTALLATION_DONE || !$_SESSION['admin']) {
			if (isset($params['POST']['submit'])) {
				$this->setConfData($params['POST']);
				$this->createDatabase();
				header(LOCATION . DIRNAME . INSTALLATION_DATABASE_LINK);
			}
			$view = new View(INSTALLATION_DATABASE_VIEW, INSTALATION_TEMPLATE);
		} else {
			return404View();
		}
	}

	public function adminAction($params) {
		if (!INSTALLATION_DONE) {
			if (isset($params['POST']['submit'])) {
				$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
				$user->generateToken();
				$user->insert();
				header(LOCATION . DIRNAME . STATISTIC_INDEX_BACK_LINK);
			}
			$view = new View(INSTALLATION_ADMIN_VIEW, INSTALATION_TEMPLATE);
		} else {
			return404View();
		}
	}

	private function setConfData($data) {
		$fname = "conf.inc.php";
		$content = $this->getContentFromConfFile($fname);
		$this->replaceData($content, $data);
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

	private function replaceData(&$content, $data) {
		if (isset($data['language'])) {
			$content = str_replace(LANGUAGE, $data['language'], $content);
		}
		if (isset($data['templateFront'])) {
			$content = str_replace(FRONT_TEMPLATE, $data['templateFront'], $content);
		}
		if (isset($data['templateBack'])) {
			$content = str_replace(BACK_TEMPLATE, $data['templateBack'], $content);
		}
		if (isset($data['user'])) {
			$content = str_replace(DBUSER, $data['user'], $content);
		}
		if (isset($data['pwd'])) {
			$content = str_replace(DBPWD, $data['pwd'], $content);
		}
		if (isset($data['name'])) {
			$content = str_replace(DBNAME, $data['name'], $content);
		}
		if (isset($data['port'])) {
			$content = str_replace(DBPORT, $data['port'], $content);
		}
		if (isset($data['installation'])) {
			$content = str_replace(INSTALLATION_DONE, TRUE, $content);
		}
	}

	private function createDatabase() {
		$fileContent = $this->getContentFromConfFile("install/projet_annuel.sql");
		$BaseSql = new BaseSql(); 
		$BaseSql->createDatabase($fileContent);
	}
}
?>