<?php
class FormatUtils {

	public static function formatToJson($array) {
		return json_encode($array);
	}

	public static function formatObjectsArrayToArray($objects) {
		$result = [];
		foreach ($objects as $object) {
		    $result[] = $object->getColumns();
		}
		return $result;
	}
}
?>