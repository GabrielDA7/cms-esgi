<?php
class ViewUtils {

	public static function getErrors($errors) {
		if (isset($errors) && !empty($errors)) {
			include_once VIEWS_FOLDER_NAME . "/errors.view.php";
		}
	}

	public static function findImage($imgPath) {
		if (isset($imgPath)) {
			return DIRNAME . $imgPath;
		}
		return DIRNAME . "public/img/default.jpg";
	}
}
