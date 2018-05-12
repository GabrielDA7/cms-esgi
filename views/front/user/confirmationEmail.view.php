<section id="emailConfirm" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Email confirmation</h2>
      </div>
  </div>
  <div class="row center-container M--center M--middle">
    <div class="M8 login-container">
        <p>An email has been sent to '<?= $user->getEmail(); ?>'. Please check your inbox and confirm the registration.</p>
        <a href="<?= DIRNAME . USER_EMAIL_CONFIRM_LINK . "?email=" . $user->getEmail();?>">Resend email</a>
    </div>
  </div>
</section>
