<?php
class IndexController {

	public function indexAction($params) {
		$v = new View("home","front");
	}

	public function errorAction($params) {
		$v = new View("404","front");
	}
}
?>