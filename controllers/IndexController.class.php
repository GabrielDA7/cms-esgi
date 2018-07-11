<?php
class IndexController {

	private $authenticationDelegate;
	private $data = [];
	private $chapterDelegate;
	private $trainningDelegate;
	private $videoDelegate;

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->chapterDelegate = new ObjectDelegate($this->data, CHAPTER_CLASS_NAME);
		$this->trainningDelegate = new ObjectDelegate($this->data, TRAINNING_CLASS_NAME);
		$this->videoDelegate = new ObjectDelegate($this->data, VIDEO_CLASS_NAME);	
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

}