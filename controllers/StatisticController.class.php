<?php
class StatisticController{

	private $authenticationDelegate;
	private $datas = array();

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
	}
	
	public function indexAction($params){
		$this->authenticationDelegate->process($this->data, $params, TRUE, STATISTIC_VIEWS);
		$view = new View($this->data);
	}

}
?>
