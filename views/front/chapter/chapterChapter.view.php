<section id="front-chapter" class="container main-section">

	<section id ="content-head">
		<div class="row">
			<div class="M12">
				<a class="trainning-title" href="<?= DIRNAME . TRAINNING_TRAINNING_FRONT_LINK . '?id=' . $chapter->getTrainningId(); ?>"> Trainning name : <?= $chapter->getTitle(); ?></a>
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
		<span class="content-hidden"><?= $chapter->getId(); ?></span>
		<span class="content-hidden">chapter</span>
		<div class="row">
				<div class="M3">
					<p class="title-separator">Commentaires</p>
				</div>
				<div class="M12">
					<div class="full-hr-separation"></div>
				</div>
		</div>
		<?php if (isLogged()) : ?>
			<form method="POST" action="<?= DIRNAME ?>comment/add">
				<input type="hidden" name="user_id" value="<?= $_SESSION['userId'] ?>">
				<input type="hidden" name="chapter_id" value="<?= $chapter->getId() ?>">
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
		<?php endif ?>

		<div id="comments-result" class="row M--center">
			<div class="M12">
				<p>No comments</p>
			</div>
		</div>
	</section>
</section>
