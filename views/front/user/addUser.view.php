<section id="front-add-user" class="container-fluid">
  <div class="row">
      <div class="front-title">
        <h2>Sign up</h2>
      </div>
  </div>
  <div class="container main-section">
    <?php ViewUtils::getErrors($errors) ?>
    <div class="row">
      <div class="M6 X12 login-container">
        <div class="M12 X12">
          <?php $this->addModal("form", $config, $errors); ?>
        </div>
      </div>
      <div class="M6 X12">
        <h3>Why should you register ?</h3>
        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
  </div>
</section>
