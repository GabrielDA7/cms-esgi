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
		ViewUtils::setPossiblesViewsTemplates($data, STATISTIC_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params, TRUE);
		$view = new View($data);
	}

}
?>
