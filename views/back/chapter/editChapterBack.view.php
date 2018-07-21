<section id="dashboard-edit-chapter">
  <?php ViewUtils::getErrors($errors); ?>
  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>Edit chapter</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

    <div class="row M--center">
      <div class="M12">
        <?php $this->addModal("form", $config, $errors); ?>
      </div>
    </div>
</section>
