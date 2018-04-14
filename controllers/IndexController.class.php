<?php
class IndexController {

	private $authenticationDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
	}

	public function indexAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, HOME_VIEW, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$view = new View($data);
	}

	public function contactAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, CONTACT_VIEW, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$view = new View($data);
	}

	public function errorAction($params) {
		ViewUtils::setPossiblesViewsTemplates($data, NOT_FOUND_VIEW, FRONT_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$view = new View($data);
	}
}
?>