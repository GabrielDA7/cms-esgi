<section id="front-user-user">
  <section class="container-fluid">
    <?php ViewUtils::getErrors($errors); ?>
    <?php $user = ViewUtils::getUser($_GET['id']) ?>
    <div class="row">
        <div class="front-title">
          <h2><?= $user->getUsername(); ?>'s profile</h2>
        </div>
    </div>
  </section>

  <section class="container user-edit-container">
    <div class="row M--center">
        <div class="M12 X12">
          <?php if(isset($_SESSION['admin'])): ?>
            <form method="POST" action="<?= DIRNAME ?>user/edit" enctype='multipart/form-data'>
			           <image class="avatar-img-edition" src="<?= $user->getAvatar(); ?>" alt="avatar image"/>
						     <input type='file' name="avatar">
                 <label class="form-label-top form-group " for="role">Status</label>
                 <select class="input-medium" name="role">
                   <option value="0" <?php if($user->getRole() == 0) echo 'selected' ?>>Member</option>
                   <option value="1" <?php if($user->getRole() == 1) echo 'selected' ?>>Premium</option>
                   <option value="2" <?php if($user->getRole() == 2) echo 'selected' ?>>Admin</option>
                 </select>
								<label class="form-label-top form-group" for="userName">Username</label>
								<input class='input' type='text' name="userName" value='<?= $user->getUsername() ?>'>
								<label class="form-label-top form-group" for="firstName">First name</label>
								<input class='input' type='text' name="firstName" value='<?= $user->getFirstname(); ?>'>
								<label class="form-label-top form-group" for="lastName">Last name</label>
								<input class='input' type='text' name="lastName" value='<?= $user->getLastname(); ?>'>
								<label class="form-label-top form-group" for="email">Email</label>
								<input class='input' type='email' name="email" value='<?= $user->getEmail(); ?>'>
					      <input class="btn form-group btn-filled-orange btn-small align-right form-group-bottom" type="submit" name="submit" value="Save">
            </form>
          <?php else: ?>
              <image class="avatar-img-edition form-group" src="<?= $user->getAvatar(); ?>" alt="avatar image"/>
              <p class="form-group"><strong>Username :</strong> <?= $user->getUsername(); ?></p>
              <p class="form-group"><strong>Status :</strong> <?= ViewUtils::getRoleUser($user->getRole()); ?></p>
              <p class="form-group"><strong>First name :</strong> <?= $user->getFirstname(); ?></p>
              <p class="form-group"><strong>Last name :</strong> <?= $user->getLastname(); ?></p>
              <p class="form-group"><strong>Email :</strong> <?= $user->getEmail(); ?></p>
          <?php endif; ?>
        </div>
    </div>
  </section>
</section>
