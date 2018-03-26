<?php
class ControllerUtils {

	public static function isBackOfficeView($url, $backOfficeView, $frontOfficeView) {
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE && $url[0] === "back") {
			return $backOfficeView;
		} else {
			return $frontOfficeView;
		}
	}
}
?>