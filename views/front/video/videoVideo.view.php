<section id="front-video">
	<section class="container-fluid">
		<div class="row">
				<div class="front-title">
					<h2><?= $video->getTitle(); ?></h2>
				</div>
		</div>

		<div class="row M--center">
			<div class="video-container">
				<video class="video-card" width="100%" height="100%">";
					<source src="<?= $video->getUrl(); ?>" type="video/mp4"/>
					<source src="<?= $video->getUrl(); ?>" type="video/mp3" />
					<source src="<?= $video->getUrl(); ?>" type="video/webm" />
				</video>
			</div>
		</div>
	</section>

	<div id="open-video" class="content-hidden">
		<div class="container-fluid">
			<div class="row M--end">
				<span class="close-video"><i style="color:white" class="fas fa-times"></i></span>
			</div>
			<div class="row fix-height M--center M--middle">
				<video class="video-card" height="50%" width="50%" controls="controls">";
					<source src="<?= $video->getUrl(); ?>" type="video/mp4"/>
					<source src="<?= $video->getUrl(); ?>" type="video/mp3" />
					<source src="<?= $video->getUrl(); ?>" type="video/webm" />
				</video>
			</div>
		</div>
	</div>

	<section class="container main-section">
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
							<?= $video->getDescription(); ?>
						</p>
					</div>
			</div>

		</section>

		<section id="content-main">
			<div class="row M--center">

			</div>
			</section>

			<section id="comments">
					<span class="content-hidden"><?=$video->getId();?></span>
					<span class="content-hidden">video</span>
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
							<input type="hidden" name="video_id" value="<?= $video->getId() ?>">
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
