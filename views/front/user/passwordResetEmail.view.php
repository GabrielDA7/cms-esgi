<section id="resetPasswordEmail" class="container-fluid full-height">
  <div class="row">
      <div class="front-title">
        <h2>Password reset</h2>
      </div>
  </div>
  <?php ViewUtils::getErrors($errors) ?>
  <div class="row center-container M--center M--middle section-container">
    <div class="M6 X12 login-container">
      <div class="M12 X12">
        <?php $this->addModal("form", $config, $errors); ?>
      </div>
    </div>
  </div>
</section>
