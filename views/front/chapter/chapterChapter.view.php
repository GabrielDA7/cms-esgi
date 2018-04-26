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
		<div class="row">
			<div class="M3">
				<p class="content-subtitle"> <?= $part->getNumber() . ". " . $part ->getTitle(); ?></p>
			</div>
			<div class="M2 M--offset7">
				<a href="javascript:void(0);" class="expand-div btn-icon subtitle-icon"><i class="fas fa-chevron-down"></i></a>
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
		</div>
	<?php endforeach ?>
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

		<form action="#comments" method="post">
			<div class="row">
				<div class="M12 X12">
							<textarea class="input" name="textarea" placeholder="Enter a comment here"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="M3 X12 M--offset9 wrapper-flex M--end">
							<input type="submit" class="input-btn btn-filled-blue btn-icon" name="" value="Commenter">
				</div>
			</div>
		</form>

		<div class="row M--center">
			<?php // foreach comments ?>
			<div class="M12">
				<p>No comments</p>
			</div>
		</div>
	</section>
</section>
