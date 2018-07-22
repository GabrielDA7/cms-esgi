<section id="dashboard-add-premium">
  <?php ViewUtils::getErrors($errors); ?>
  <?php ViewUtils::getSuccess($errors); ?>
  <div class="row">
    <div class="M8">
      <div class="back-title">
        <h1>Edit premium offer</h1>
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
