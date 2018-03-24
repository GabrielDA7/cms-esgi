<?php
class IndexController{

	public function indexAction($params){
		$v = new View("default","front");
	}

	public function errorAction($params){
		$v = new View("404","front");
	}
}
?>