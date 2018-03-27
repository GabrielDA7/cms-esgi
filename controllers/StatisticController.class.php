<?php
class StatisticController{

	public function indexAction($params){
		$viewAndTemplateName = ViewUtils::isBackOfficeView($params['URL'], STATISTIC_BACK_VIEW, "", DASHBORD_TEMPLATE, DEFAULT_TEMPLATE);
		$view = new View($viewAndTemplateName['view'], $viewAndTemplateName['template']);
	}

}
?>
