<?php
class IndexController {

	private $authenticationDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();	
	}

	public function indexAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, HOME_VIEWS);
		$view = new View($this->data);
	}

	public function contactAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, CONTACT_VIEWS);
		$view = new View($this->data);
	}

	public function errorAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, NOT_FOUND_VIEWS);
		$view = new View($this->data);
	}
}
?>