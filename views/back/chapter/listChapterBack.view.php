<section id="dashboard-list-lesson" class="list-data">

  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>List of lessons</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="list-init-object">
    chapter
  </div>

  <div class="row row-tools">
    <div class="M4">
      <div class="wrapper-icon">
          <i class="fas fa-search icon-left"></i>
          <input class="input-medium input-icon" type="text" oninput="initList('chapter', 'list-data', 'search');">
      </div>
    </div>
    <div class="M2 M--offset6">
      <a class="btn-extra-small btn-filled-orange btn btn-icon" href="<?= DIRNAME . LESSON_ADD_BACK_LINK; ?>">Add<i class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="row M--center X--center">
    <div class="M12">
      <?php $this->addModal("table", $config, $errors); ?>
    </div>
  </div>

</section>
