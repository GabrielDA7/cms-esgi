<?php
class PaymentController {

	private $authenticationDelegate;
	private $objectDelegate;
	private $siteInfosDelegate;
	private $paymentPaypalDelegate;
	private $userDelegate;
	private $data = [];

	public function __construct() {
		$this->authenticationDelegate = new AuthenticationDelegate();
		$this->objectDelegate = new ObjectDelegate($this->data, PREMIUMOFFER_CLASS_NAME);
		$this->siteInfosDelegate = new SiteInfosDelegate();
		$this->paymentPaypalDelegate = new PaymentPaypalDelegate();
		$this->userDelegate = new UserDelegate($this->data);
	}

	public function recapAction($params) {
		if(!isset($params['GET']['id']) || !isLogged()) {
			LogsUtils::process("logs", "Attempt access", "Access denied");
			RedirectUtils::redirect404();
		}
		$this->authenticationDelegate->process($this->data, $params, FALSE, TRUE, PAYMENT_RECAP_VIEWS);
		$this->siteInfosDelegate->process($this->data);
		$this->objectDelegate->getById($this->data, $params);
		$view = new View($this->data);

	}

	public function buyAction($params) {
		if (!isset($params['POST']['id']))
			return;
		$params['GET']['id'] = $params['POST']['id'];
		$this->objectDelegate->getById($this->data, $params);
		$this->paymentPaypalDelegate->process($this->data, $params);
	}

	public function executeAction($params) {
		if (!isset($params['POST']['id']))
			return;
		$params['GET']['id'] = $params['POST']['id'];
		$this->objectDelegate->getById($this->data, $params);
		$this->paymentPaypalDelegate->processExecute($this->data, $params['POST']);
		$this->userDelegate->addPremiumStatus($this->data);
	}

}