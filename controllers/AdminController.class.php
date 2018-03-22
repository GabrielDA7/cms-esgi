<?php

/* processes administrator authentication and login view */
class AdminController{

  /* Display login view */
	public function indexAction($params){
		  $v = new View("loginAdmin","dashboardLogin");
	}

  public function loginAction($params){

  }

}
