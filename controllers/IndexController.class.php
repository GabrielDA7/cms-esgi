<?php
class IndexController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
	}

	public function indexAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, HOME_VIEWS);
		$view = new View($data);
	}

	public function contactAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, CONTACT_VIEWS);
		$view = new View($data);
	}

	public function errorAction($params) {
		$this->authenticationDelegate->process($data, $params, FALSE, NOT_FOUND_VIEWS);
		$view = new View($data);
	}
}
?>