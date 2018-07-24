<section id="front-chapter" class="container main-section">
	<section id ="content-head">
		<div class="row">
			<div class="M12">
				<?php if ($chapter->getTrainning() != null): ?>
					<a class="trainning-title" href="<?= DIRNAME . TRAINNING_TRAINNING_FRONT_LINK . '?id=' . $chapter->getTrainningId(); ?>"> Trainning name : <?= $chapter->getTrainning()->getTitle(); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="row M--center">
			<div class="M3 align-center">
				<img class="img main-img" src="<?= (($chapter->getImage() != null) ? $chapter->getImage() : DIRNAME.'public/img/default.jpg'); ?>" alt="image chapter" title="image chapter" >
			</div>
		</div>

		<div class="row M--center">
			<div class="M3 align-center">
				<h3><?= $chapter->getTitle() ?></h3>
			</div>
		</div>

		<div class="row">
				<div class="M12">
					<p class="content-text-under-title">
					</p>
				</div>
		</div>
	</section>

<section id="content-main">
	<?php foreach($chapter->getParts() as $part): ?>
		<div class="row expand-div">
			<div class="M3">
				<p class="content-subtitle"> <?= $part->getNumber() . ". " . $part ->getTitle(); ?></p>
			</div>
			<div class="M2 M--offset7">
				<a href="javascript:void(0);" class="btn-icon"><i class="fas fa-chevron-down"></i></a>
			</div>
		</div>
		<div class="content-hidden">
			<div class="row">
				<div class="M12">
					<p class="content-text">
						<?= $part->getContent(); ?>
					</p>
				 </div>
			</div>
		</div>
	<?php endforeach ?>
</section>

	<section id="comments">
			<span class="content-hidden"><?=$chapter->getId();?></span>
			<span class="content-hidden">chapter</span>
			<div class="row">
					<div class="M3">
						<p class="title-separator">Comments</p>
					</div>
					<div class="M12">
						<div class="full-hr-separation"></div>
					</div>
			</div>
			<?php if (isLogged()) : ?>
				<form method="POST" action="<?= DIRNAME ?>comment/add" class="padding-comment">
					<input type="hidden" name="chapter_id" value="<?= $chapter->getId() ?>">
					<div class="row">
						<div class="M12 X12">
									<textarea id="comment-text" class="input" name="content" placeholder="Enter a comment here"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="M3 X12 M--offset9 wrapper-flex M--end form-group">
									<input type="submit" id="comment-button" class="input-btn btn-filled-blue btn-icon" value="Comment">
						</div>
					</div>
				</form>
			<?php endif; ?>
			<div id='comments-result' class='row'></div>
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
