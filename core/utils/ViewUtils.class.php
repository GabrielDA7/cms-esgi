<?php
class ViewUtils {

	public static function getErrors($errors) {
		if (isset($errors) && !empty($errors)) {
			include_once MODALS_FOLDER_NAME . "/errors.mdl.php";
		}
	}

	public static function findImage($imgPath) {
		if (isset($imgPath)) {
			return DIRNAME . $imgPath;
		}
		return DIRNAME . "public/img/default.jpg";
	}
}
