<?php
class View {

	private $view;
	private $template;
	private $data = [];

	public function __construct($view=HOME_VIEW, $template=DEFAULT_TEMPLATE) {
		$this->view = $view . VIEW_EXTENSION;
		$this->template = $template . TEMPLATE_EXTENSION;
		$viewPath = searchFile(array(VIEWS_FOLDER_NAME), $this->view);
		$templatePath = searchFile(array(VIEWS_TEMLATES_FOLDER_NAME), $this->template);
		if (!isset($viewPath) || !isset($templatePath)) {
			return404View();
		}
		$this->assign("viewPath", $viewPath);
		$this->assign("templatePath", $templatePath);
	}

	public function __destruct() {
		extract($this->data);
		include $templatePath;
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}
}