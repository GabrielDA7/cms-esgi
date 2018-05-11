<?php
class FormatUtils {

	public static function formatToJson($array) {
		return json_encode($array, JSON_UNESCAPED_SLASHES);
	}

	public static function formatDataToArray($data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$data[$key] = self::formatDataToArray($value);
			} else if (is_object($value)) {
				$data[$key] = self::formatObjectToArray($value);
			}
		}
		return $data;
	}

	public static function formatObjectToArray($object) {
		$columns = $object->getColumns();
	    foreach ($columns as $name => $value) {
	    	if ((is_object($value) && get_class($value) != 'PDO') || is_array($value)) {
	    		$columns[$name] = self::formatDataToArray([$value]);
	    	}
	    }
	    return $columns;
	}

	public static function formatMapToQuerryString($map) {
		$queryString = "?" . self::formatMapToStringWithSeparators($map, "", "=", "&");
	}

	public static function formatMapToStringWithSeparators($array, $separatorBefore, $separatorBetween, $separatorAfter, $flagValue = TRUE, $doubleKey = FALSE) {
		$numberOfItems = count($array);
		$i = 0;
		$separedValues = "";
		foreach ($array as $key => $value) {
			$value = ($flagValue)? $value : "";
			$value = ($doubleKey)? $key : $value;
			if (!(++$i === $numberOfItems)) {
				$separedValues .= $separatorBefore . $key . $separatorBetween . $value . $separatorAfter;
	  		} else if ($value != "") {
	  			$separedValues .= $separatorBefore . $key . $separatorBetween . $value;
	  		} else {
	  			$separedValues .= $separatorBefore . $key;
	  		}
		}
		return $separedValues;
	}
}
?>
