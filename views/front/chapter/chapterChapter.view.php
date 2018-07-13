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

		<div id='comments-result' class='row'>
			<div class='row comment-card M--start'>
				<div class="M1 no-padding-right align-center">
					<img class='avatar-img-medium' src="<?= DIRNAME; ?>public/img/default.jpg" alt='avatar'>
				</div>
				<div class="M11">
					<div class="row padding-bottom-comment">
						<strong>Admin</strong><span class='grey-content'> Il y a 3 minutes</span>
					</div>
					<div class='row padding-bottom-comment'>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
					</div>
					<div class="row M--start">
						<div class="M2 no-padding">
							<a href="javascript:void(0);" class="expand-comment no-decoration"><strong>Reply(12)<i class="fas fa-chevron-down"></i></strong></a>
						</div>
						<?php if (isLogged()) : ?>
							<div class="M2 M--offset8 no-padding">
								<a href="javascript:void(0);" class="align-right grey-content answer-comment-link">Answer</a>
							</div>
							<div class="M12 no-padding answer-comment-form">
							</div>
						<?php endif ?>
						<div class="M12 no-padding comment-hidden">
								qsdsqd
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</section>
