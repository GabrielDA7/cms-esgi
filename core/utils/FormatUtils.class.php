<?php
class FormatUtils {

	public static function formatToJson($array) {
		return json_encode($array, JSON_UNESCAPED_SLASHES);
	}

	public static function formatObjectsArrayToArray($objects) {
		$result = [];
		foreach ($objects as $object) {
		    $columns = $object->getColumns();
		    foreach ($columns as $key => $value) {
		    	if (is_object($value) && get_class($value) != 'PDO') {
		    		$columns[$key] = self::formatObjectsArrayToArray([$value]);
		    	}
		    }
		    $result[] = $columns;
		}
		return $result;
	}
}
?>
