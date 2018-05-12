<section id="emailConfirm" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Email confirmation</h2>
      </div>
  </div>
  <div class="row center-container M--center M--middle">
    <div class="M8 login-container">
        <p>An email has been sent to '<?= $user->getEmail(); ?>'. Please check your inbox and click on the link to reset the password.</p>
        <a href="<?= DIRNAME . USER_PASSWORD_RESET_LINK . "?email=" . $email;?>">Resend email</a>
    </div>
  </div>
</section>
