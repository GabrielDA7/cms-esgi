<?php
class IndexController {

	private $authenticationDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $statisticViewDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->formDelegate = new FormDelegate(INSTALLATION_CLASS_NAME);
		$this->fileDelegate = new FileDelegate(INSTALLATION_CLASS_NAME);
		$this->statisticViewDelegate = new StatisticViewDelegate();
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

	public function searchAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, SEARCH_VIEWS);
		$view = new View($this->data);
	}

	public function parametersAction($params) {
		$this->authenticationDelegate->process($this->data, $params, TRUE, PARAMETERS_VIEWS);
		$this->formDelegate->process($this->data, $params);
		$this->fileDelegate->setting($this->data, $params['POST']);
		$view = new View($this->data);
	}

	public function statisticAction($params){
		$this->authenticationDelegate->process($this->data, $params, TRUE, STATISTIC_VIEWS);
		$this->statisticViewDelegate->processGet($this->data);
		$view = new View($this->data);
	}

}