<section id="dashboard-user-edit">
  <section class="container-fluid">
    <?php ViewUtils::getErrors($errors); ?>
		<div class="row">
			<div class="M4">
				<div class="back-title">
					<h1>My account</h1>
					<div class="hr-separation"></div>
				</div>
			</div>
		</div>
  </section>

  <section class="container user-edit-container">
    <div class="row M--center">
        <div class="M12 X12">
            <?php $this->addModal("form", $config, $errors); ?>
        </div>
    </div>
  </section>
</section>
