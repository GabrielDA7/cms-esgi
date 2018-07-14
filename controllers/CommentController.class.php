<?php
class CommentController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, COMMENT_CLASS_NAME);
	}

	public function responseAction($params) {
		if (!isset($params['POST']['comment_id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->data['errors'] = FALSE;
		$this->objectDelegate->add($this->data, $params);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);
	}

	public function addAction($params) {
		$this->data['errors'] = FALSE;
		$this->objectDelegate->add($this->data, $params);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);
	}

	public function editAction($params) {
	}

	public function reportAction($params) {
		if (!isset($params['POST']['id'])) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->data['errors'] = FALSE;
		$this->objectDelegate->update($this->data, $params);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);		
	}

	public function deleteAction($params) {
	}
}
