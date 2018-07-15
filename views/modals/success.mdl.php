<div class="success-msg flash-msg">
  <div class="bar-success-msg"></div>
  <div class="msg-content">
    <?php foreach ($success as $value): ?>
        <div class="M12">
          <?= $value; ?>
        </div>
    <?php endforeach; ?>
  </div>
  <i onclick="closeDiv('errors')" class="fas fa-times"></i>
</div>
