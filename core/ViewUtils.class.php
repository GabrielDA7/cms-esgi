<?php
class ViewUtils {

	public static function isBackOfficeView($url, $backOfficeView, $frontOfficeView, $backOfficeTemplate, $frontOfficeTemplate) {
		if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
			if (isset($url[0]) && $url[0] === "back") {
				return array("view" => $backOfficeView, "template" => $backOfficeTemplate);
			}
		}
		return array("view" => $frontOfficeView, "template" => $frontOfficeTemplate);
	}

	public static function getLoginView($url, $backOfficeView, $frontOfficeView, $backOfficeTemplate, $frontOfficeTemplate) {
		if (isset($url[0]) && $url[0] === "back") {
			return array("view" => $frontOfficeView, "template" => $frontOfficeTemplate);
		}
		return array("view" => $frontOfficeView, "template" => $frontOfficeTemplate);
	}
}
?>