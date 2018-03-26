<?php
class IndexController {

	public function indexAction($params) {
		$view = new View(HOME_VIEW, DEFAULT_TEMPLATE);
	}

	public function contactAction($params) {
		$view = new View(CONTACT_VIEW, DEFAULT_TEMPLATE);
	}

	public function errorAction($params) {
		$view = new View(NOT_FOUND_VIEW, DEFAULT_TEMPLATE);
	}
}
?>