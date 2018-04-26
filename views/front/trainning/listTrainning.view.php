<section id="front-list-trainning" class="container">

	<div class="row">
		<div class="M4">
			<div class="back-title">
				<h1>List of trainings</h1>
				<div class="hr-separation"></div>
			</div>
		</div>
	</div>

  <div class="row row-padding">
    <?php foreach ($trainnings as $trainning): ?>
      <div class="M2 X12">
        <a href="<?= DIRNAME . TRAINNING_TRAINNING_FRONT_LINK . '?id=' . $trainning->getId();?>" class="card">
            <div class="card-image">
              <img src="<?=(empty($trainning->getImage())) ? DIRNAME . 'public/img/default.jpg' : DIRNAME . $trainning->getImage(); ?>" alt="image">
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
