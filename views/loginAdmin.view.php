<div class="row X--center M--center">
    <div class="M3">
      <img src="public/img/logo.svg" alt="logo" title="logo">
    </div>
</div>

<div class="row X--center M--center">
    <div class="M3">
      <h1>Uteach</h1>
    </div>
</div>

  <div class="row X--center M--center">
      <div class="M3">

        <form action="<?= DIRNAME;?>admin/login" method="post">
          <div class="form-group">
              <label for="user_name">Username</label>
              <input class="input" type="text" name="user_name">
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input class="input" type="password" name="password">
          </div>
          <input type="submit" class="form-group input-btn" name="sign_in" value="Sign in">
          </form>

      </div>
  </div>
