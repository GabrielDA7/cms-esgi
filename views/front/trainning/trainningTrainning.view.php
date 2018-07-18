<section id="front-list-trainning" class="container-fluid">

	<div class="row">
      <div class="front-title">
        <h2><?= $trainning->getTitle(); ?></h2>
      </div>
  </div>

	<section class="container main-section">

		<div class="row M--center">
			<div class="M3">
				<img class="img main-img" src="<?= ViewUtils::findImage($trainning->getImage()) ?>" alt="image du cours#1" title="image du cours#1" >
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
					<span class="content-hidden"><?=$trainning->getId();?></span>
					<span class="content-hidden">trainning</span>
					<div class="row">
							<div class="M3">
								<p class="title-separator">Commentaires</p>
							</div>
							<div class="M12">
								<div class="full-hr-separation"></div>
							</div>
					</div>
					<?php if (isLogged()) : ?>
						<form method="POST" action="<?= DIRNAME ?>comment/add" class="row-padding">
							<input type="hidden" name="trainning_id" value="<?= $trainning->getId() ?>">
							<div class="row">
								<div class="M12 X12">
											<textarea id="comment-text" class="input" name="content" placeholder="Enter a comment here"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="M3 X12 M--offset9 wrapper-flex M--end form-group">
											<input type="submit" id="comment-button" class="input-btn btn-filled-blue btn-icon" value="Commenter">
								</div>
							</div>
						</form>
					<?php endif ?>
					<div id='comments-result' class='row'></div>
			</section>


	</section>
</section>

<!-- The Modal -->
<div id="report-comment-mdl" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
		<div class="modal-header">
		  <span class="close-mdl">&times;</span>
		  <h2>Why do you report this comment ?</h2>
		</div>
		<div class="modal-body">
			<form action="<?= DIRNAME ?>comment/report" method="post">
				<input type="hidden" name="id">
				<input type="hidden" name="report" value="1">
				<label for="reason">The reason :</label>
				<textarea class="form-group row input" name="reason"></textarea>
				<input type="submit" class="input-btn btn-filled-orange btn-icon last footer-wrapper" name="submit" value="Confirm">
			</form>
		 </div>
	</div>
</div>
