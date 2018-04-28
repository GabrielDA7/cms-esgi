<?php
class StatisticController{

	private $authenticationDelegate;
	private $objectDelegate;
	private $datas = array();

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate();
	}
	
	public function indexAction($params){
		$this->authenticationDelegate->process($data, $params, TRUE, STATISTIC_VIEWS);
		$view = new View($data);
	}

}
?>
