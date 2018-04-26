<section id="front-list-chapter" class="container">
  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>List of lessons</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="row M--between row-padding">
    <?php foreach ($chapters as $chapter): ?>
      <div class="M2 X12">
        <a href="<?= DIRNAME . CHAPTER_CHAPTER_FRONT_LINK . '?id=' . $chapter->getId();?>" class="card">
            <div class="card-image">
              <img src="<?= DIRNAME;?>public/img/home/logo-react.png" alt="Avatar">
            </div>
            <div class="card-separation"></div>
            <div class="card-content">
              <p class="card-content-title"><?= $trainning->getTitle() ?></p>
              <p class="card-content-author"><?= $trainning->getAuthor() ?></p>
            </div>
        </a>
      </div>
    <?php endforeach;?>
  </div>

</section>
