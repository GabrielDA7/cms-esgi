<?php
class View {

	private $view;
	private $template;
	private $data = [];

	public function __construct($data = []) {
		$this->data = $data;
		$this->view = $this->data['view'] . VIEW_EXTENSION;
		$this->template = $this->data['template'] . TEMPLATE_EXTENSION;
		$viewPath = searchFile(array(VIEWS_FOLDER_NAME), $this->view);
		$templatePath = searchFile(array(VIEWS_TEMLATES_FOLDER_NAME), $this->template);
		if (!isset($viewPath) || !isset($templatePath)) {
			RedirectUtils::redirect404();
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

	public function addModal($modal, $config, $errors = []) {
		include MODALS_FOLDER_NAME . "/" . $modal.".mdl.php";
	}
}
