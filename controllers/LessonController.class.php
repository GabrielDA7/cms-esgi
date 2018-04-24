<?php
include "core/interfaces/ControllerInterface.php";
class LessonController implements ControllerInterface{

	public function indexAction($params) {
	}
	
	public function addAction($params) {
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}

	public function listAction($params) {
	}

	/**
	 * Get the lesson by id or by parameters
	 */
	public function lessonAction($params) {
		if (!isset($params['GET']['id'])) {
			LogsUtils::process(LogsUtils::LOGS_FILE, "Attempt access", "Access denied");
			return404View();
		}
		ViewUtils::setPossiblesViewsTemplates($data, LESSON_LESSON_FRONT_VIEW, FRONT_TEMPLATE, LESSON_LESSON_BACK_VIEW, BACK_TEMPLATE);
		$this->authenticationDelegate->process($data, $params);
		$this->objectDelegate->pushObjectByParameters($data, ["chapter"=>$params['GET']['id']], LESSON_CLASS_NAME, [VIDEO_CLASS_NAME]);
		$view = new View($data);
	}
}
?>