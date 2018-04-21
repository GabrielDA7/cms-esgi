<?php
class ViewUtils {

	public static function setPossiblesViewsTemplates(&$datas, $frontOfficeView, $frontOfficeTemplate, $backOfficeView = null, $backOfficeTemplate = null) {
		$datas['backView'] = $backOfficeView;
		$datas['frontView'] = $frontOfficeView;
		$datas['frontTemplate'] = $frontOfficeTemplate;
		$datas['backTemplate'] = $backOfficeTemplate;
	}

	public static function getErrors($errors) {
		if($errors != null): ?>
			<div id="errors" class="row">
				<div class="M12">
					<div class="errors">
						<div class="wrapper-icon">
							<i onclick="closeDiv('errors')" class="fas fa-times"></i>
						</div>
						<?php foreach ($errors as $value): ?>
								<div class="M12">
									<?= $value; ?>
								</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif;

	}
}
?>
