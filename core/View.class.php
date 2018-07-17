<?php
class View {

	private $view;
	private $template;
	private $data = [];
	private $scripts = [];

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
		$this->includeScripts();
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

	public function addModal($modal, $config, $errors = []) {
		include MODALS_FOLDER_NAME . "/" . $modal.".mdl.php";
	}

	public function addScript($order, $scriptLink, $variables = null) {
		$this->scripts[$order] = [$scriptLink => $variables];
	}

	private function includeScripts() {
		for ($i = 0; $i < count($this->scripts); $i++) {
			if ($this->scripts[$i]) {
				$this->includeScript($this->scripts[$i]);
			}
		}
	}

	private function includeScript($scripts) {
		foreach ($scripts as $link => $variables) {
			if ($variables != null) {
				echo "<script type='text/javascript'>";

				foreach ($variables as $name => $value)
					printf("var %s = '%s';", $name, $value);

				echo "</script>";
			}
			echo "<script src='" . DIRNAME . $link . "'>";
			echo "</script>";
		}
	}
}
