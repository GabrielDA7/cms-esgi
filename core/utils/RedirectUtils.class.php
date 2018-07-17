<?php
class RedirectUtils {

	public static function directRedirect($url = "") {
		header(LOCATION . $url);
		exit();
	}

	public static function redirect($url = "", $urlGetParameters = "") {
		if ($urlGetParameters != "") {
			$urlGetParameters = FormatUtils::formatMapToQuerryString($urlGetParameters);
		}
		header(LOCATION . DIRNAME . $url . $urlGetParameters);
		exit();
	}

	public static function redirect404() {
		header(LOCATION . DIRNAME . INDEX_ERROR_LINK);
		exit();
	}

	public static function redirectProtocoleHTTPS() {
		$httpsUrl = str_replace("http", "https", $_SERVER['HTTP_REFERER']);
		self::directRedirect($httpsUrl);
	}
}
