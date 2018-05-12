<section id="front-login-user" class="container-fluid container">
  <div class="row">
      <div class="front-title">
        <h2>Sign in</h2>
      </div>
  </div>
    <?php ViewUtils::getErrors($errors) ?>
    <div class="row center-container M--center M--middle">
      <div class="M6 X12 login-container">
        <div class="M12 X12">
          <?php $this->addModal("form", $config, $errors); ?>
          <div class="row M--reverse">
            <a class="forgot-password" href="<?= DIRNAME . USER_PASSWORD_RESET_EMAIL_LINK; ?>">Forgot your password?</a>
          </div>
        </div>
      </div>
    </div>
</section>
