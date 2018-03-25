<?php
class IndexController {

	public function indexAction($params) {
		$view = new View("home","front");
	}

	public function errorAction($params) {
		$view = new View("404","front");
	}
}
?>