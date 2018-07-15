<div class="error-msg flash-msg">
  <div class="bar-error-msg"></div>
  <div class="msg-content">
    <?php foreach ($errors as $value): ?>
        <div class="M12">
          <?= $value; ?>
        </div>
    <?php endforeach; ?>
  </div>
  <i class="fas fa-times"></i>
</div>
