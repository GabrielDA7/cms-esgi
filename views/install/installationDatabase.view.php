<?php ViewUtils::getErrors($errors) ?>
<div class="row X--center M--center">
    <div class="M6">
      <h2 class="installation-subtitle">Database parameters</h2>
    </div>
</div>
<div class="row M--center">
  <div class="M6">
    <?php $this->addModal("form", $config, $errors); ?>
  </div>
</div>
