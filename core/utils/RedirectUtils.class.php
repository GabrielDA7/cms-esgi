<?php
class RedirectUtils {
	
	public static  function redirect($url = "", $getParameters = "") {
		if ($getParameters != "") {
			$getParameters = FormatUtils::formatMapToQuerryString($getParameters);
		}
		header(LOCATION . DIRNAME . $url . $getParameters);
		exit();
	}

	public static function redirect404() {
		header(LOCATION . DIRNAME . INDEX_ERROR_LINK);
		exit();
	}
}
?>