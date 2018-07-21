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

	public static function getUser($id) {
		$user = new User();
		return $user->getById($id);
	}

	public static function getRoleUser($val) {
		if($val == 1) {
			return 'premium';
		} else if($val == 0) {
			return 'member';
		} else {
			return 'admin';
		}
	}
}
