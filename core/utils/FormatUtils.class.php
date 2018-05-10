<?php
class FormatUtils {

	public static function formatToJson($array) {
		return json_encode($array, JSON_UNESCAPED_SLASHES);
	}

	public static function formatDataToArray($data) {
		$array = [];
		foreach ($data as $key => $values) {
			$tempArray = [];
			foreach ($values as $index => $value) {
				if (is_object($value)) {
				    $tempArray[] = self::formatObjectColumnsToArray($value);
				} else {
					$tempArray[$index] = $value;
				}
			}
			$array[$key] = $tempArray;
		}
		return $array;
	}

	public static function formatObjectColumnsToArray($object) {
		$array = [];
		$columns = $object->getColumns();
	    foreach ($columns as $name => $val) {
	    	if (is_object($val) && get_class($val) != 'PDO') {
	    		$columns[$name] = self::formatDataToArray([$val]);
	    	}
	    }
	    return $columns;
	}
}
?>
