<?php
class ViewUtils {

	public static function setPossiblesViewsTemplates(&$datas, $frontOfficeView, $frontOfficeTemplate, $backOfficeView = null, $backOfficeTemplate = null) {
		$datas['backView'] = $backOfficeView;
		$datas['frontView'] = $frontOfficeView;
		$datas['frontTemplate'] = $frontOfficeTemplate;
		$datas['backTemplate'] = $backOfficeTemplate;
	}

	public static function getErrors($errors) {
		if(isset($errors) && !empty($errors)){
			include_once VIEW_FOLDER_NAME . "/errors.view.php";
		}
	}
}
?>
