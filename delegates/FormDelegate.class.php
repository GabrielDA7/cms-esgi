<?php
class FormDelegate {

	private $objectName;

	public function __construct($objectName) {
		$this->objectName = $objectName;
	}

	public function process(&$data, $params) {
		$data['config'] = $this->getFormConfig($params['URL'], $data);
		$data['commentConfig'] = $this->getCommentFormConfig();
		$data['errors'] = null;
		if(isset($params['POST']['submit'])) {
			$data['errors'] = $this->checkForm($data['config'], $params["POST"], $params['FILES']);
			if ($this->objectName === USER_CLASS_NAME && ClassUtils::getCallingFunction() == "addAction") {
				$this->checkUserNameAndEmailDisponibility($data['errors'], $params["POST"]);
			}
		}
	}

	private function checkForm($config, $post, $files){
		$errorsMsg = [];
		foreach ($config["input"] as $name => $attributs) {
			if (isset($attributs["confirm"]) && $post[$name] != $post[$attributs["confirm"]]) {
				$errorsMsg[]= $name ." ne correspond pas à ".$attributs["confirm"];
			} else if (!isset($attributs["confirm"])) {
				if($attributs["type"]=="email" && !self::checkEmail($post[$name])) {
					$errorsMsg[]= "Format de l'email incorrect";
				} else if ($attributs["type"]=="password" && !self::checkPwd($post[$name])) {
					$errorsMsg[]= "Mot de passe incorrect(Maj, Min, Chiffre, entre 6 et 32)";
				} else if ($attributs["type"]=="number" && !self::checkNumber($post[$name])) {
					$errorsMsg[]= $name ." n'est pas correct";
				}
			}

			if (isset($attributs["maxString"]) && !self::maxString($post[$name], $attributs["maxString"])) {
				$errorsMsg[]= $name ." doit faire moins de ".$attributs["maxString"]." caractères" ;
			}

			if (isset($attributs["minString"]) && !self::minString($post[$name], $attributs["minString"])) {
				$errorsMsg[]= $name ." doit faire plus de ".$attributs["minString"]." caractères" ;
			}

			if (isset($attributs["maxNum"]) && !self::maxNum($post[$name], $attributs["maxNum"])) {
				$errorsMsg[]= $name ." doit être inférieur à ".$attributs["maxNum"];
			}

			if (isset($attributs["minNum"]) && !self::minNum($post[$name], $attributs["minNum"])) {
				$errorsMsg[]= $name ." doit être supérieur à ".$attributs["minNum"];
			}

			if (isset($attributs["maxSize"]) && !self::checkFileSize($files[$name], $attributs["maxSize"])) {
				$errorsMsg[]= $name ." doit être inferieur à ".$attributs["maxSize"];
			}
			if (isset($attributs["extension"]) && !self::checkFileExtension($files[$name], $attributs["extension"])) {
				$errorsMsg[]= $name ." extension n'est pas correct";
			}
		}
		if (empty($errorsMsg)) {
			return FALSE;
		}
		return $errorsMsg;
	}

	private function checkUserNameAndEmailDisponibility(&$errors, $post) {
		if (isset($post['userName'])) {
			$this->checkColumnDisponibility("userName", $errors, $post);
		}
		if (isset($post['email'])) {
			$this->checkColumnDisponibility("email", $errors, $post);
		}
	}

	private function checkColumnDisponibility($columnName, &$errors, $post) {
		$user = new User();
		$setter = "set" . ucfirst($columnName);
		$user->$setter($post[$columnName]);
		$user = $user->getWithParameters();
		if (!empty($user)) {
			$errors[] = $columnName . " est déjà utilisé";
		}
	}

	private function getFormConfig($url, $data) {
		$configName = "config" . ucfirst($url[1]) . "Form";
		return $this->objectName::$configName($data);
	}

	private function getCommentFormConfig() {
		
	}

	private function isEmptyPost($post) {
		foreach ($post as $key => $value) {
			if ($key != "submit" && $value != "") {
				return FALSE;
			}
		}
		return TRUE;
	}

	public static function maxString($string, $length){
		return strlen(trim($string))<=$length;
	}

	public static function minString($string, $length){
		return strlen(trim($string))>=$length;
	}

	public function maxNum($num, $length){
		return $num<=$length;
	}

	public function minNum($num, $length){
		return $num>=$length;
	}

	public static function checkEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function checkPwd($pwd){
		return strlen($pwd)>=6 && strlen($pwd)<=32
		&& preg_match("/[a-z]/", $pwd)
		&& preg_match("/[A-Z]/", $pwd)
		&& preg_match("/[0-9]/", $pwd);
	}

	public static function checkNumber($number){
		return is_numeric(trim($number));
	}

	public static function checkFileSize($file, $maxBits) {
		return $file['size'] <=  $maxBits;
	}

	public static function checkFileExtension($file, $fileExtension) {
		$path_parts = pathinfo($file['name']);
		if (isset($path_parts['extension'])) {
			return in_array($path_parts['extension'], $fileExtension);
		}
		return true;
	}


	public function getObjectName() { return $this->objectName; }
	public function setObjectName($objectName) { $this->objectName = $objectName; }
}