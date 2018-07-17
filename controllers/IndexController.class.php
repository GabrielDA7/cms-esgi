<?php
class IndexController {

	private $authenticationDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $statisticDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->formDelegate = new FormDelegate(INSTALLATION_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(INSTALLATION_CLASS_NAME);
		$this->statisticDelegate = new StatisticDelegate();
	}

	public function indexAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, HOME_VIEWS);
		$view = new View($this->data);
	}

	public function contactAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, CONTACT_VIEWS);
		$view = new View($this->data);
	}

	public function errorAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, NOT_FOUND_VIEWS);
		$view = new View($this->data);
	}

	public function searchAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, SEARCH_VIEWS);
		$view = new View($this->data);
	}

	public function parametersAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, PARAMETERS_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST']);
		$view = new View($this->data);
	}

	public function statisticAction($params){
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, STATISTIC_VIEWS);
		$this->statisticDelegate->processGet($this->data);
		$view = new View($this->data);
	}

}
