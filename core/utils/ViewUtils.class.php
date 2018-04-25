<?php
class ViewUtils {

	public static function setPossiblesViewsTemplates(&$data, $frontOfficeView, $frontOfficeTemplate, $backOfficeView = null, $backOfficeTemplate = null) {
		$data['backView'] = $backOfficeView;
		$data['frontView'] = $frontOfficeView;
		$data['frontTemplate'] = $frontOfficeTemplate;
		$data['backTemplate'] = $backOfficeTemplate;
	}

	public static function getErrors($errors) {
		if (isset($errors) && !empty($errors)) {
			include_once VIEWS_FOLDER_NAME . "/errors.view.php";
		}
	}
}
?>
