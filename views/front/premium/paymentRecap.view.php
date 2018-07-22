<section id="front-recap-premium">
  <div class="container-fluid">
    <div class="row">
        <div class="front-title">
          <h2>Recap</h2>
        </div>
    </div>
  </div>

  <div class="container premium-offers">
    <div class="row M--center">
      <div class='M2'>
        <div class='offer'>
          <div class='row M--end'>
            <span class='time-offer'><?= $premiumoffer->getDuration() ?> month</span>
          </div>
          <div class='row M--center'>
            <p class='price-offer-premium'><?= $premiumoffer->getPrice() ?> $</p>
          </div>
          <div class='row options-offer-premium'>
            <div class='M12 option-offer-premium'>
              Premium chapters
            </div>
            <div class='M12 option-offer-premium'>
              Premium trainnings
            </div>
            <div class='M12 option-offer-premium option-offer-premium-last'>
              Premium videos
            </div>
          </div>
          <div class='row M--center'>
            <div id="paypal-button"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->addScript(2, "https://www.paypalobjects.com/api/checkout.js"); ?>
<?php $this->addScript(3, DIRNAME.PAIEMENT_PATH, ["dirname" => DIRNAME, "idOffer" => $premiumoffer->getId()]); ?>
