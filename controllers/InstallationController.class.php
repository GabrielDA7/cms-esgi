<?php
class InstallationController {

	public function indexAction($params) {
		if (INSTALLATION_DONE) {
			return404View();
		}
		$view = new View(INSTALLATION_INDEX_VIEW, INSTALLATION_TEMPLATE);
	}

	public function settingAction($params) {
		if (!INSTALLATION_DONE) {
			return404View();
		}
		if (isset($params['POST']['submit'])) {
			$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
			$this->setConfData($installation);
			header(LOCATION . DIRNAME . INSTALLATION_DATABASE_LINK);
		}
		$view = new View(INSTALLATION_SETTING_VIEW, INSTALLATION_TEMPLATE);
	}

	public function databaseAction($params) {
		if (INSTALLATION_DONE) {
			return404View();
		}
		if (isset($params['POST']['submit'])) {
			$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
			$this->setConfData($installation);
			header(LOCATION . DIRNAME . INSTALLATION_CREATE_DATABASE_LINK);
		}
		$view = new View(INSTALLATION_DATABASE_VIEW, INSTALLATION_TEMPLATE);
	}

	public function adminAction($params) {
		if (INSTALLATION_DONE) {
			return404View();
		}
		if (isset($params['POST']['submit'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$user->generateToken();
			$user->insert();
			$installation = ClassUtils::constructObjectWithParameters($params['POST'], INSTALLATION_CLASS_NAME);
			$this->setConfData($installation);
			header(LOCATION . DIRNAME . USER_LOGIN_BACK_LINK);
		}
		$view = new View(INSTALLATION_ADMIN_VIEW, INSTALLATION_TEMPLATE);
	}

	public function createdatabaseAction() {
		if (INSTALLATION_DONE) {
			return404View();
		}
		$fileContent = $this->getContentFromConfFile("install/uteach.sql");
		$BaseSql = new BaseSql(); 
		$BaseSql->createDatabase($fileContent);
		header(LOCATION . DIRNAME . INSTALLATION_ADMIN_LINK);
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
}
?>