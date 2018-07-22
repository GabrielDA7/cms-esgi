<h1>Offre premium : <?= $premiumoffer->getTitle() ?></h1>
<h2><?= $premiumoffer->getDuration() ?> Month</h2>
<h2><?= $premiumoffer->getPrice() ?> €</h2>

<div id="paypal-button"></div>

<?php $this->addScript(2, "https://www.paypalobjects.com/api/checkout.js"); ?>
<?php $this->addScript(3, DIRNAME.PAIEMENT_PATH, ["dirname" => DIRNAME, "idOffer" => $premiumoffer->getId()]); ?>