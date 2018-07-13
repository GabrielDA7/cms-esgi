<div class="error-msg">
  <div class="bar-error-msg"></div>
  <div class="msg-content">
    <?php foreach ($errors as $value): ?>
        <div class="M12">
          <?= $value; ?>
        </div>
    <?php endforeach; ?>
  </div>
  <i onclick="closeDiv('errors')" class="fas fa-times"></i>
</div>

<!--
<div id="errors" class="row">
  <div class="M12">
    <div class="errors">
      <div class="wrapper-icon">
        <i onclick="closeDiv('errors')" class="fas fa-times"></i>
      </div>

    </div>
  </div>
</div>
-->
