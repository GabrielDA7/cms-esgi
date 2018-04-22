<div id="errors" class="row">
  <div class="M12">
    <div class="errors">
      <div class="wrapper-icon">
        <i onclick="closeDiv('errors')" class="fas fa-times"></i>
      </div>
      <?php foreach ($errors as $value): ?>
          <div class="M12">
            <?= $value; ?>
          </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
