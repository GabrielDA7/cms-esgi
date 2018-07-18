<section id="front-user-edit">
  <section class="container-fluid">
    <?php ViewUtils::getErrors($errors); ?>
    <div class="row">
        <div class="front-title">
          <h2>My account</h2>
        </div>
    </div>
  </section>

  <section class="container user-edit-container">
    <div class="row M--center">
        <div class="M12 X12">
            <?php $this->addModal("form", $config, $errors); ?>
        </div>
    </div>
  </section>
</section>
