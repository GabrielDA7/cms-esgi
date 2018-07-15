<?php
class ViewUtils {

	public static function getErrors($errors) {
		if (isset($errors) && is_array($errors)) {
			include_once MODALS_FOLDER_NAME . "/errors.mdl.php";
		}
	}

	public static function getSuccess($errors) {
		if (isset($errors) && $errors == FALSE) {
			include_once MODALS_FOLDER_NAME . "/success.mdl.php";
		}
	}

	public static function findImage($imgPath) {
		if (isset($imgPath)) {
			return DIRNAME . $imgPath;
		}
		return DIRNAME . "public/img/default.jpg";
	}
}
