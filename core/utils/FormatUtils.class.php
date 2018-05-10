<?php
class FormatUtils {

	public static function formatToJson($array) {
		return json_encode($array, JSON_UNESCAPED_SLASHES);
	}

	public static function formatDataToArray(&$data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				aaa($value);
				self::formatDataToArray($value);
			} else if (is_object($value)) {
				$data[$key] = self::formatObjectToArray($value);
			}
		}
		aaa($data);
		return $data;
	}

	public static function formatObjectToArray($object) {
		$array = [];
		$columns = $object->getColumns();
	    foreach ($columns as $name => $value) {
	    	if (is_object($value) && get_class($value) != 'PDO') {
	    		$array[] = $value;
	    		$columns[$name] = self::formatDataToArray($array);
	    	}
	    }
	    return $columns;
	}
}
?>
