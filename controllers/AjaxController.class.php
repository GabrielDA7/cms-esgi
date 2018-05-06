<?php
class AjaxController {

	private $objectDelegate;
	private $data = [];

	public function __construct() {
		if (!isset($_GET['object'])) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$_GET['object'] = ucfirst($_GET['object']);
		$this->objectDelegate = new ObjectDelegate($this->data, $_GET['object']);
	}

	public function searchAction($params) {
		$objects = $this->objectDelegate->search($params);
		$array = FormatUtils::formatObjectsArrayToArray($objects);
		echo FormatUtils::formatToJson($array);
	}

	public function filterAction($params) {
		echo FormatUtils::formatToJson($this->objectDelegate->filter($params));
	}

	public function listAction($params) {
		$objects = $this->objectDelegate->getAll($params);
		$array = FormatUtils::formatObjectsArrayToArray($objects);
		echo FormatUtils::formatToJson($array);
	}
}
?>
