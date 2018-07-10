<?php
class AjaxController {

	private $objectDelegate;
	private $listDisplayDataDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		if (!isset($_GET['object']) || !$this->isObjectExist($_GET['object']) || ($this->isUserObject($_GET['object']) && !isAdmin())) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$_GET['object'] = ucfirst($_GET['object']);
		$this->objectDelegate = new ObjectDelegate($this->data, $_GET['object']);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate($_GET['object']);
		$this->formDelegate = new FormDelegate($_GET['object']);
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
		echo FormatUtils::formatToJson($array);
	}

	public function listAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->getAll($this->data, $params);
		$this->listDisplayDataDelegate->process($this->data);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}

	public function listCommentAction($params) {
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$this->objectDelegate->getByParameters($this->data, $params);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array);
	}

	public function commentAction($params) {
		if (!$this->isForeignKeySend($params) || !isLogged()) {
			echo FormatUtils::formatToJson([]);
			exit;
		}
		$this->formDelegate->process($this->data, $params);
		$this->objectDelegate->add($this->data, $params);
		$array = FormatUtils::formatDataToArray($this->data);
		echo FormatUtils::formatToJson($array['errors']);
	}

	private function isObjectExist($objectName) {
		return defined(strtoupper($_GET['object']."_CLASS_NAME"));
	}

	private function isUserObject($objectName) {
		return strcasecmp(USER_CLASS_NAME, $_GET['object']) === 0;
	}

	private function isForeignKeySend($params) {
		return isset($params['POST']['lesson_id']) || isset($params['POST']['trainning_id']) || isset($params['POST']['video_id']) || isset($params['POST']['comment_id']);
	}
}