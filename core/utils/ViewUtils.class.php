<?php
class ViewUtils {

	public static function isBackOfficeView($url, $backOfficeView, $frontOfficeView, $backOfficeTemplate, $frontOfficeTemplate) {
		if ((isset($url[2]) && $url[2] === "back") && (isset($_SESSION['admin']) && $_SESSION['admin'] || isset($url[1]) && $url[1] === "login")) {
				return array("view" => $backOfficeView, "template" => $backOfficeTemplate);
		}
		return array("view" => $frontOfficeView, "template" => $frontOfficeTemplate);
	}

	public static function setPossiblesViewsTemplates(&$datas, $backOfficeView, $frontOfficeView, $backOfficeTemplate, $frontOfficeTemplate) {
		$datas['backView'] = $backOfficeView;
		$datas['frontView'] = $frontOfficeView;
		$datas['frontTemplate'] = $backOfficeTemplate;
		$datas['backTemplate'] = $frontOfficeTemplate;

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