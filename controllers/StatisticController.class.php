<?php
class StatisticController{

	public function indexAction($params){
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], STATISTIC_BACK_VIEW, "", BACK_TEMPLATE, FRONT_TEMPLATE);
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
	}

}
?>
