<section id="dashboard-list-premium" class="table-data">

  <div class="row">
    <div class="M8">
      <div class="back-title">
        <h1>List of premium offers</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="list-init-object">
    <span>premiumoffer</span>
  </div>

  <div class="row row-tools">
    <div class="M4">
      <div class="wrapper-icon">
          <i class="fas fa-search icon-left"></i>
          <input class="input-medium input-icon" type="text">
      </div>
    </div>
    <div class="M2 M--offset6">
      <a class="btn-extra-small btn-filled-orange btn btn-icon" href="<?= DIRNAME . PREMIUMOFFER_ADD_BACK_LINK; ?>">Add<i class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="row M--center X--center">
    <div class="M12">
      <?php $this->addModal("table", $tableConfig); ?>
    </div>
  </div>

</section>
