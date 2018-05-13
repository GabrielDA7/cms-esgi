<section id="emailConfirm" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Reset password</h2>
      </div>
  </div>
  <div class="row center-container M--center M--middle">
    <div class="M8 login-container">
        <?php if ($errors === TRUE): ?>
          <p>An error is occured</p>
        <?php else : ?>
          <p>An email has been sent to '<?= $user->getEmail(); ?>'. Please check your inbox and click on the link to reset the password.</p>
        <?php endif; ?>
        <form action="<?= DIRNAME . USER_PASSWORD_RESET_LINK ?>" method="POST">
          <input type="hidden" name="email" value="<?= $user->getEmail() ?>">
          <input type="submit" name="Resend email" value="Resend email">
        </form>
    </div>
  </div>
</section>
