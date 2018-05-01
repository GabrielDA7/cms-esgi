<section id="dashboard-list-tranning">

  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>List of trainings</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="row row-tools">
    <div class="M4">
      <div class="wrapper-icon">
          <i class="fas fa-search icon-left"></i>
          <input class="input-medium input-icon" type="text" oninput="searchTable('trainning', 'dashboard-list-tranning', 'list-trainning');">
      </div>
    </div>
    <div class="M2 M--offset6">
      <a class="btn-extra-small btn-filled-orange btn btn-icon" href="<?= DIRNAME . TRAINNING_ADD_BACK_LINK; ?>">Add<i class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="row M--center X--center">
    <div class="M12">
      <?php $this->addModal("table", $config, $errors); ?>
    </div>

  </div>

  <div class="row row-pagination">
    <div class="M4">
      <p>Showing 1 to
      <select class="pagination-selector" name="pagination" id="listTrainningSelect" onchange="listTrainningSelectChange()">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">50</option>
        <option value="30">100</option>
      </select>
      of X entries</p>
    </div>
    <div class="M4">
      <div id="div_pagination">
        <input type="hidden" id="txt_rowid" value="0">
        <input type="hidden" id="txt_allcount" value="0">
        <input type="button" class="button" value="Previous" id="but_prev" />

        <input type="button" class="button" value="Next" id="but_next" />
      </div>
    </div>
  </div>

</section>
