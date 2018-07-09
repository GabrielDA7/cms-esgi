<section id="front-list-trainning" class="container-fluid">

	<div class="row">
      <div class="front-title">
        <h2><?= $trainning->getTitle(); ?></h2>
      </div>
  </div>

	<section class="container">

		<div class="row M--center">
			<div class="M3">
				<img class="img main-img" src="<?= DIRNAME . $trainning->getImage(); ?>" alt="image du cours#1" title="image du cours#1" >
			</div>
		</div>

		<section id = "content-head">
			<div class="row">
				<div class="M3">
					<p class="title-separator">Description</p>
				</div>
				<div class="M12">
					<div class="full-hr-separation"></div>
				</div>
			</div>

			<div class="row">
					<div class="M12">
						<p class="content-text-under-title">
							<?= $trainning->getDescription(); ?>
						</p>
					</div>
			</div>

			<div class="row M--center">
				<div class="M2 M--center X12 X--center wrap-flex">
					<a href="#" class="btn btn-filled-orange btn-small">Begin</a>
				</div>
			</div>
		</section>

		<section id="content-main">
			<div class="row M--center">
				<div class="M6">
					<?php foreach ($trainning->getChapters() as $chapter): ?>
						<div class="row chapter">
					    <div class="M12">
					    	<a class="content-title" href="<?= DIRNAME . CHAPTER_CHAPTER_FRONT_LINK . '?id=' . $chapter->getId();?>"><?=  $chapter->getNumber(). ". " . $chapter->getTitle(); ?></a>
					    </div>
					   </div>
						<?php endforeach ?>
				</div>
			</div>
			</section>

			<section id="comments">
				<div class="row">
						<div class="M3">
							<p class="title-separator">Commentaires</p>
						</div>
						<div class="M12">
							<div class="full-hr-separation"></div>
						</div>
				</div>

				<form method="POST" action="<?= DIRNAME ?>comment/add">
					<input type="hidden" name="user_id" value="<?= $_SESSION['userId'] ?>">
					<input type="hidden" name="trainning_id" value="<?= $trainning->getId() ?>">
					<div class="row">
						<div class="M12 X12">
									<textarea id="comment-text" class="input" name="content" placeholder="Enter a comment here"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="M3 X12 M--offset9 wrapper-flex M--end">
									<input type="submit" id="comment-button" class="input-btn btn-filled-blue btn-icon" value="Commenter">
						</div>
					</div>
				</form>

				<div class="row M--center">
					<div class="M12">
						<p>No comments</p>
					</div>
				</div>
			</section>


	</section>
</section>
