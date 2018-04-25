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
}
?>