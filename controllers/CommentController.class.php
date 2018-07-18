<?php
class CommentController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $formDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, COMMENT_CLASS_NAME);
		$this->listDisplayDataDelegate = new ListDisplayDataDelegate(COMMENT_CLASS_NAME);
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

	public function reportListAction($params) {
		$this->authenticationDelegate->process($this->data, $params, FALSE, FALSE, COMMENT_LIST_REPORT_VIEWS);
		$this->listDisplayDataDelegate->processCommonInformations($this->data, $params);
		$view = new View($this->data);
	}

	public function deleteAction($params) {
		if(!isset($params['POST']['submit']) || !isAdmin()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, TRUE, TRUE, COMMENT_LIST_REPORT_VIEWS);
		$this->objectDelegate->delete($params, "", COMMENT_REPORT_BACK_LINK);
	}
}
