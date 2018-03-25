<?php
class View {

	private $v;
	private $t;
	private $data = [];

	public function __construct($v="default", $t="front") {
		$this->v = $v.".view.php";
		$this->t = $t.".tpl.php";
		$viewPath = searchFile(array('views'), $this->v);
		$templatePath = searchFile(array('views/templates'), $this->t);
		if (!isset($viewPath)) {
			return404View();
		}
		if (!isset($templatePath)) {
			return404View();
		}
		$this->assign("viewPath", $viewPath);
	}

	public function __destruct() {
		extract($this->data);
		include "views/templates/".$this->t;
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}
}