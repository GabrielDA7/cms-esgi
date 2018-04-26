<?php
class AjaxController {

	private $objectDelegate;
	private $data = [];

	public function __construct() {
		$this->objectDelegate = new ObjectDelegate();
	}

	public function searchAction($params) {
		if (empty($params['GET']) || !isset($params['GET']['object'])) {
			return FormatUtils::formatToJson([]);
		}
		return FormatUtils::formatToJson($this->objectDelegate->search($params, $params['GET']['object']));
	}

	public function filterAction($params) {
		if (empty($params['GET']) || !isset($params['GET']['object'])) {
			return FormatUtils::formatToJson([]);
		}
		return FormatUtils::formatToJson($this->objectDelegate->search($params, $params['GET']['object']));
	}

	public function listAction($params) {
		if (empty($params['GET']) || !isset($params['GET']['object'])) {
			return FormatUtils::formatToJson([]);
		}
		$json = FormatUtils::formatToJson($this->objectDelegate->getAll($params, $params['GET']['object']));
		die(var_dump($json));
	}
}
?>
