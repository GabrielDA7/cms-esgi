<section id="dashboard-user-edit">
  <section class="container-fluid">
    <?php ViewUtils::getErrors($errors); ?>
		<div class="row">
			<div class="M4">
				<div class="back-title">
					<h1><?= $user->getUsername(); ?>'s profile</h1>
					<div class="hr-separation"></div>
				</div>
			</div>
		</div>
  </section>

  <section class="user-edit-container">
    <div class="row">
        <div class="M12 X12">
          <form method="POST" action="<?= DIRNAME ?>user/edit/back" enctype='multipart/form-data'>
            <?php if ($user->getAvatar() != null ) : ?>
                <image class="avatar-img-edition" src="<?= $user->getAvatar(); ?>" alt="avatar image"/>
            <?php endif; ?>
          	<input type="file" maxfilesize=1000000 extension=jpg,png,jpeg></input>
            <label class="form-label-top form-group" for="role">Role</label>
            <select class="input-medium" name="role">
              <option value="0" <?= (($user->getRole() == 0) ? "selected" : '') ?>>Member</option>
              <option value="1" <?= (($user->getRole() == 1) ? "selected" : '') ?>>Premium member</option>
              <option value="2" <?= (($user->getRole() == 2) ? "selected" : '') ?>>Admin member</option>
            </select>
          	<p class="form-group">Status : <?= ViewUtils::getRoleUser($user->getRole()); ?></p>
          	<label class="form-label-top form-group" for="userName">Username</label>
          	<input class='input' type='text' name="userName" value='<?= $user->getUsername() ?>'>
          	<label class="form-label-top form-group" for="firstName">First name</label>
          	<input class='input' type='text' name="firstName" value='<?= $user->getFirstname() ?>'>
          	<label class="form-label-top form-group" for="lastName">Last name</label>
          	<input class='input' type='text' name="lastName" value='<?= $user->getLastname() ?>'>
          	<label class="form-label-top form-group" for="email">Email</label>
          	<input class='input' type='email' name="email" value='<?= $user->getEmail() ?>'>
            <input class='input' type='hidden' name="id" value='<?= $user->getId() ?>'>
          	<input class="btn form-group btn-filled-orange btn-small align-right form-group-bottom" type="submit" name="submit" value="Save">
          </form>
        </div>
    </div>
  </section>
</section>
