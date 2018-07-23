<?php
class IndexController {

	private $authenticationDelegate;
	private $formDelegate;
	private $fileDelegate;
	private $statisticDelegate;
	private $siteMapDelegate;
	private $siteInfosDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->statisticDelegate = new StatisticDelegate();
		$this->siteMapDelegate = new SiteMapDelegate();
		$this->siteInfosDelegate = new SiteInfosDelegate();
	}

	public function indexAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, HOME_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$view = new View($this->data);
		$this->siteMapDelegate->processStart();
	}

	public function errorAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, NOT_FOUND_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$view = new View($this->data);
	}

	public function searchAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, SEARCH_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$view = new View($this->data);
	}

	public function statisticAction($params){
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, STATISTIC_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->statisticDelegate->processGet($this->data);
		$view = new View($this->data);
	}

	public function crawlAction($params) {
		$this->siteMapDelegate->process($params);
	}
}
