<?php
class classUtils {
	
	public function __construct() {}

	public static function constructObjectWithParameters($columns, $objectName) {
		$object = new $objectName();
		foreach ($columns as $column => $value) {
			if (!is_numeric($column)) {
				self::removeUnderScoreFromForeignKeyColum($column);
				$setter = 'set'.ucfirst($column);
				if (method_exists($object, $setter)) {
					$object->$setter($value);
				}
			}
		}
		return $object;
	}

	public static function constructObjectWithId($id, $objectName) {
		$object = new $objectName();
		$object->setId($id);
		return $object;
	}

	public static function removeUnsusedColumns($object, $columnsExclude = null) {
		if (isset($columnsExclude)) {
			$columns  = array_diff_key($object->getColumns(), $columnsExclude);
		}
		self::removeNullColumns($columns);	
		return $columns;	
	}

	public static function removeNullColumns(&$columns) {
		foreach($columns as $key=>$value) {
		    if(is_null($value) || $value == '') {
		        unset($columns[$key]);
		    }
		}
	}

	public static function removeUnderScoreFromForeignKeyColum(&$column) {
		str_replace('_', '', $column);
	}
}
?>