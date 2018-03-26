<?php
class ViewUtils {

	public static function isBackOfficeView($url, $backOfficeView, $frontOfficeView) {
		if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
			if (isset($url[0]) && $url[0] === "back") {
				return $backOfficeView;
			}
		}
		return $frontOfficeView;
	}
}
?>