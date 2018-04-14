<?php
class ViewUtils {

	public static function setPossiblesViewsTemplates(&$datas, $backOfficeView, $frontOfficeView, $backOfficeTemplate, $frontOfficeTemplate) {
		$datas['backView'] = $backOfficeView;
		$datas['frontView'] = $frontOfficeView;
		$datas['frontTemplate'] = $frontOfficeTemplate;
		$datas['backTemplate'] = $backOfficeTemplate;
	}

	public static function isEmptyPost($post) {
		foreach ($post as $key => $value) {
			if ($key != "submit" && $value != "") {
				return FALSE;
			}
		}
		return TRUE;
	}
}
?>