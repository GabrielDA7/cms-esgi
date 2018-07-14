<?php
class AjaxController {

	private $objectDelegate;
	private $listDisplayDataDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		$objectName = (isset($_GET['object'])) ? $_GET['object'] : $_POST['object'];
		if (!isset($objectName) || !$this->isObjectExist($objectName) || ($this->isUserObject($objectName) && !isAdmin())) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$this->objectDelegate = new ObjectDelegate($this->data, $objectName);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate($objectName);
		$this->formDelegate = new FormDelegate($objectName);
	}

	public function searchAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->search($this->data, $params);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}

	public function listAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->getAll($this->data);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}

	public function listCommentAction($params) {
	    $this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
	    $this->objectDelegate->getByParameters($this->data, $params['GET']);
	    $array = FormatUtils::formatDataToArray($this->data);
	    echo FormatUtils::formatToJson($array);
  	}

	private function isObjectExist($objectName) {
		return defined(strtoupper($objectName."_CLASS_NAME"));
	}

	private function isUserObject($objectName) {
		return strcasecmp(USER_CLASS_NAME, $objectName) === 0;
	}

	private function isForeignKeySend($params) {
		return isset($params['POST']['chapter_id']) || isset($params['POST']['trainning_id']) || isset($params['POST']['video_id']) || isset($params['POST']['comment_id']);
	}
}
