<?php
class ViewUtils {

	public static function getErrors($errors) {
		if (isset($errors) && !empty($errors)) {
			include_once VIEWS_FOLDER_NAME . "/errors.view.php";
		}
	}
}