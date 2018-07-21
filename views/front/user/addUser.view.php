<section id="front-add-user" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Sign up</h2>
      </div>
  </div>
  <div class="container main-section">
    <?php ViewUtils::getErrors($errors) ?>
    <div class="row">
      <div class="M6 X12 login-container">
        <div class="M12 X12">
          <?php $this->addModal("form", $config, $errors); ?>
        </div>
      </div>
      <div class="M6 X12">
        <h3>Why should you register ?</h3>
        <p class="description"><?= (isset($infos) ? $infos->getReasonRegister() : '')?></p>
      </div>
    </div>
  </div>
</section>
