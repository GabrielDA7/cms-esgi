<?php
class Validate{

	public static function checkForm($config, $data){

		$errorsMsg = [];

		foreach ($config["input"] as $name => $attributs) {
			if(isset($attributs["confirm"]) && $data[$name] != $data[$attributs["confirm"]]){
				$errorsMsg[]= $name ." ne correspond pas à ".$attributs["confirm"];
			}else if( !isset($attributs["confirm"]) ){
				if($attributs["type"]=="email" && !self::checkEmail($data[$name]) ){
					$errorsMsg[]= "Format de l'email incorrect";
				}else if ($attributs["type"]=="password" && !self::checkPwd($data[$name]) ){
					$errorsMsg[]= "Mot de passe incorrect(Maj, Min, Chiffre, entre 6 et 32)";
				}else if ($attributs["type"]=="number" && !self::checkNumber($data[$name]) ){
					$errorsMsg[]= $name ." n'est pas correct";
				}
			}

			if(isset($attributs["maxString"]) && !self::maxString($data[$name], $attributs["maxString"])){
					$errorsMsg[]= $name ." doit faire moins de ".$attributs["maxString"]." caractères" ;
			}

			if(isset($attributs["minString"]) && !self::minString($data[$name], $attributs["minString"])){
					$errorsMsg[]= $name ." doit faire plus de ".$attributs["minString"]." caractères" ;
			}

			if(isset($attributs["maxNum"]) && !self::maxNum($data[$name], $attributs["maxNum"])){
					$errorsMsg[]= $name ." doit être inférieur à ".$attributs["maxNum"];
			}

			if(isset($attributs["minNum"]) && !self::minNum($data[$name], $attributs["minNum"])){
					$errorsMsg[]= $name ." doit être supérieur à ".$attributs["minNum"];
			}

		}
		return $errorsMsg;
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
		return preg_match("(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{6,32}$", $pwd);
	}

	public static function checkNumber($number){
		return is_numeric(trim($number));
	}

}
