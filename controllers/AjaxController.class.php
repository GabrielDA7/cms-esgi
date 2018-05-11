<?php
class AjaxController {

	private $objectDelegate;
	private $listDisplayDataDelegate;
	private $data = [];

	public function __construct() {
		if (!isset($_GET['object']) || !defined(strtoupper($_GET['object']."_CLASS_NAME")) || (strcasecmp(USER_CLASS_NAME, $_GET['object']) === 0 && !isAdmin())) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$_GET['object'] = ucfirst($_GET['object']);
		$this->objectDelegate = new ObjectDelegate($this->data, $_GET['object']);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate($_GET['object']);
	}

	public function searchAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->search($this->data, $params);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}

	public function filterAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->filter($this->data, $params);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson();
	}

	public function listAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->getAll($this->data, $params);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}
}
?>
