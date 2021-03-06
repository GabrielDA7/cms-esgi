<section id="front-login-user" class="heightVh">
  <?php ViewUtils::getErrors($errors); ?>
  <div class="row">
      <div class="front-title">
        <h2>Sign in</h2>
      </div>
  </div>
    <div class="row M--center M--middle section-container">
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
