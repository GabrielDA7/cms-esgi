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

	public function indexAction($params) {
	}

	public function addAction($params) {
		$this->data['errors'] = FALSE;
		$this->objectDelegate->add($this->data, $params);
		RedirectUtils::directRedirect($_SERVER['HTTP_REFERER']);
	}

	public function editAction($params) {
	}

	public function deleteAction($params) {
	}
}
