<div class="row X--center M--center">
    <div class="M3">
      <img src="<?= DIRNAME.LOGO_PATH;?>" alt="logo" title="logo">
    </div>
</div>

<div class="row X--center M--center">
    <div class="M3">
      <h1>Uteach</h1>
    </div>
</div>

  <div class="row X--center M--center">
      <div class="M3">

        <form action="<?= DIRNAME.USER_LOGIN_FRONT_LINK;?>" method="post">
          <div class="form-group">
              <label for="userName">Username</label>
              <input class="input" type="text" name="userName">
          </div>
          <div class="form-group">
              <label for="pwd">Password</label>
              <input class="input" type="password" name="pwd">
          </div>
          <input type="submit" class="form-group input-btn" name="submit" value="Connexion">
          </form>

      </div>
  </div>
