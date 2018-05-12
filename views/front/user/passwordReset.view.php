<section id="passwordReset" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Password reset</h2>
      </div>
  </div>
  <div class="container main-section">
    <?php ViewUtils::getErrors($errors) ?>
    <div class="row M--center X--center">
      <div class="M6 X12 login-container">
        <div class="M12 X12">
          <?php $this->addModal("form", $config, $errors); ?>
        </div>
      </div>
    </div>
  </div>
</section>
