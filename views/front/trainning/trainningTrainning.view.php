<section id="front-list-trainning" class="container-fluid">

	<div class="row">
      <div class="front-title">
        <h2><?= $trainning->getTitle(); ?></h2>
      </div>
  </div>

	<section class="container">

		<div class="row M--center">
			<div class="M3">
				<img class="img main-img" src="<?= DIRNAME; ?>public/img/home/logo-react.png" alt="image du cours#1" title="image du cours#1" >
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
				<div class="M2 M--center X12 X--center">
					<a href="#" class="btn btn-filled-orange btn-small ">Begin</a>
				</div>
			</div>
		</section>

		<section id="content-main">
			<?php foreach ($trainning->getChapters() as $chapter): ?>
			<div class="row chapter">
		    <div class="M3">
		    	<p class="content-title"><?= $chapter->getTitle(); ?></p>
		    </div>
		    <div class="M2 M--offset7 M--end">
		    	<a href="javascript:void(0);" class="expand-div"><i class="fas fa-chevron-down"></i></a>
		    </div>
		    <div class="M12">
		    	<div class="full-hr-separation"></div>
		    </div>
		    <div class="content-hidden">
		    	<div class="row">
		      	<div class="M12">
		        	<p class="content-text">
		                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
		                              magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		                              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
		                              magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		                              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.
		          </p>
		         </div>
		     	</div>

		      <div class="row">
		      	<div class="M3">
		        	<p class="content-subtitle">Sous titre</p>
		        </div>
		      </div>

		      <div class="row">
		      	<div class="M12">
		        	<p class="content-text">
		                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
		                              magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		                              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
		                              magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		                              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.
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
</section>
