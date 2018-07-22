<section id="emailConfirm"  class="container-fluid heightVh">
  <?php ViewUtils::getErrors($errors); ?>
  <div class="row">
      <div class="front-title">
        <h2>Password reset</h2>
      </div>
  </div>
    <div class="row M--center M--middle section-container">
      <div class="M6 X12 login-container">
        <div class="M12 X12">
          <?php if ($errors === TRUE): ?>
            <p>An error is occured</p>
          <?php else : ?>
            <p>An email has been sent to '<?= $user->getEmail(); ?>'. Please check your inbox and click on the link to reset the password.</p>
          <?php endif; ?>
          <form action="<?= DIRNAME . USER_PASSWORD_RESET_LINK ?>" method="POST">
            <input type="hidden" name="email" value="<?= $user->getEmail() ?>">
            <div class="row form-group M--center padding-bottom-sep">
              <input type="submit" class="input-btn btn btn-filled-orange" name="Resend email" value="Resend email">
            </div>
          </form>
        </div>
      </div>
    </div>
</section>
