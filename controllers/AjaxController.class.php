<?php
class AjaxController {

	private $objectDelegate;
	private $data = [];

	public function __construct() {
		if (empty($_GET) || !isset($_GET['object'])) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$_GET['object'] = ucfirst($_GET['object']);
		$this->objectDelegate = new ObjectDelegate($this->data, $_GET['object']);
	}

	public function searchAction($params) {
		echo FormatUtils::formatToJson($this->objectDelegate->search($params));
	}

	public function filterAction($params) {
		echo FormatUtils::formatToJson($this->objectDelegate->filter($params));
	}

	public function listAction($params) {
		echo FormatUtils::formatToJson($this->objectDelegate->getAll($params));
	}
}
?>
