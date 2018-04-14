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
		$this->authenticationDelegate->process($datas, $params, TRUE);
		$view = new View(STATISTIC_BACK_VIEW, BACK_TEMPLATE);
	}

}
?>
