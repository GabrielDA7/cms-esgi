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
		if (!INSTALLATION_DONE || (isset($_SESSION['admin']) && !$_SESSION['admin'])) {
			if (isset($params['POST']['submit'])) {
				$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
				$this->setConfData($installation);
				header(LOCATION . DIRNAME . INSTALLATION_DATABASE_LINK);
			}
			$view = new View(INSTALLATION_SETTING_VIEW, INSTALATION_TEMPLATE);
		} else {
			return404View();
		}
	}

	public function databaseAction($params) {
		if (!INSTALLATION_DONE || (isset($_SESSION['admin']) && !$_SESSION['admin'])) {
			if (isset($params['POST']['submit'])) {
				$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
				$this->setConfData($installation);
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
		$columns = ClassUtils::removeUnsusedColumns($installation, get_class_vars(get_class()));
		foreach ($columns as $key => $value) {
			$content = str_replace(constant(strtoupper($key)), $value, $content);
		}
	}

	private function createDatabase() {
		$fileContent = $this->getContentFromConfFile("install/projet_annuel.sql");
		$BaseSql = new BaseSql(); 
		$BaseSql->createDatabase($fileContent);
	}
}
?>