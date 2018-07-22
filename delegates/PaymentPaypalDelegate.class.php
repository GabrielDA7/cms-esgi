<?php
require 'vendor/autoload.php';

class PaymentPaypalDelegate {

	public function process($data, $params) {
		$apiContext = $this->initApi();
		$this->send($apiContext, $data['premiumoffer']);
	}

	public function processExecute(&$data, $params) {
		$apiContext = $this->initApi();
		$this->sendExecute($data, $apiContext, $params);
	}

	private function sendExecute(&$data, $apiContext, $params) {
		$payment = \PayPal\Api\Payment::get($params['paymentID'], $apiContext);

		$execution = (new \PayPal\Api\PaymentExecution())
	    	->setPayerId($params['payerID'])
	   		->addTransaction($this->createTransaction($data['premiumoffer']));
		try {
		    $payment->execute($execution, $apiContext);
		    $data['errors'] = FALSE;
		    echo 'ok';
		} catch (\PayPal\Exception\PayPalConnectionException $e) {
		    echo 'error';
		}
	}

	private function initApi() {
		$apiContext = new \PayPal\Rest\ApiContext(
		    new \PayPal\Auth\OAuthTokenCredential(
		        PAYPAL_CLIENT_ID,
		        PAYPAL_SECRET
		    )
		);
		return $apiContext;
	}

	private function send($apiContext, $premiumOffer) {
		$transaction = $this->createTransaction($premiumOffer);
		$payment = new \PayPal\Api\Payment();
		$payment->addTransaction($transaction);
		$payment->setIntent('sale');
		$redirectUrls = new \PayPal\Api\RedirectUrls();
		$redirectUrls->setReturnUrl($this->computeFullUrl(DIRNAME.PAYMENT_EXECUTE));
		$redirectUrls->setCancelUrl($this->computeFullUrl(DIRNAME.PAYMENT_RECAP_LINK."?id=".$premiumOffer->getId()));
		$payment->setRedirectUrls($redirectUrls);
		$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));

		try {
		    $payment->create($apiContext);
		    echo json_encode(["id" => $payment->getId()]);
		} catch (\PayPal\Exception\PayPalConnectionException $e) {
		    echo json_encode([]);
		}
	}

	
	private function createTransaction($premiumOffer) {
		$list = new \PayPal\Api\ItemList();
        $item = (new \PayPal\Api\Item())
            ->setName($premiumOffer->getTitle())
            ->setPrice($premiumOffer->getPrice())
            ->setCurrency('EUR')
            ->setQuantity($premiumOffer->getDuration());
        $list->addItem($item);

        $details = (new \PayPal\Api\Details())
            ->setTax(0)
            ->setSubtotal($premiumOffer->getPrice());

        $amount = (new \PayPal\Api\Amount())
            ->setTotal($premiumOffer->getPrice())
            ->setCurrency("EUR")
            ->setDetails($details);

        return (new \PayPal\Api\Transaction())
            ->setItemList($list)
            ->setDescription('Achat d\'un abonnement premium')
            ->setAmount($amount)
            ->setCustom($premiumOffer->getId());
	}

	private function computeFullUrl($url) {
		$protocole = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		return $protocole . $_SERVER['SERVER_NAME'] . $url;
	}




	

}