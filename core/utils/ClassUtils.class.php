<?php
class classUtils {

	public function __construct() {}

	public static function constructObject($objectName) {
		$object = new $objectName();
		return $object;
	}

	public static function constructObjectWithParameters($columns, $objectName) {
		$objectName = ucfirst($objectName);
		$object = new $objectName();
		self::setObjectColumns($object, $columns);
		return $object;
	}

	public static function setObjectColumns(&$object, $columns) {
		if (is_array($columns) || is_object($columns)) {
			foreach ($columns as $column => $value) {
				if (is_numeric($column)) {
					continue;
				}
				self::removeUnderScoreFromForeignKeyColumn($column);
				$setter = 'set'.ucfirst($column);
				if (method_exists($object, $setter)) {
					$object->$setter($value);
				}
			}
		}
	}

	public static function removeReferencedColumns(&$columns) {
		foreach ($columns as $key => $value) {
			if (is_object($value))
				unset($columns[$key]);
		}
	}

	public static function constructObjectWithId($id, $objectName) {
		$object = new $objectName();
		$object->setId($id);
		return $object;
	}

	public static function removeUnsusedColumns(&$object, $columnsExclude = null, $fromObject = FALSE, $removeNull = TRUE) {
		if (isset($columnsExclude)) {
			$columns  = array_diff_key($object->getColumns(), $columnsExclude);
		}
		if ($removeNull) {
			self::removeNullColumns($columns);
		}
		if (!$fromObject) {	
			self::removeArrayColumns($columns);
			return $columns;
		}
		self::unsetColumns($object, $columnsExclude);
	}

	public static function removeArrayColumns(&$columns) {
		foreach ($columns as $key=>$value) {
			if (is_array($value))
				unset($columns[$key]);
		}
	}

	public static function removeNullColumns(&$columns) {
		foreach ($columns as $key=>$value) {
			if ((is_null($value) || $value == "" || empty($value)) && $value !== 0 && $value !== "0") 
				unset($columns[$key]);
		}
	}

	public static function removeDBColumns(&$columns) {
		foreach ($columns as $key => $value) {
			if ($key == "table" || $key = "objectName" || $key == "db" || $key == "columns") 
				unset($columns[$key]);
		}
	}

	public static function removeUnderScoreFromForeignKeyColumn(&$column) {
		$column = str_replace(UNDERSCORE, "", $column);
	}

	public static function getCallingFunction() {
		$caller = debug_backtrace();
		$caller = $caller[2];
		return $caller['function'];
	}

	public static function unsetColumns(&$object, $columns) {
		foreach ($columns as $key => $value) {
			$object->unsetColumn($key);
		}
	}

	public static function getForeignKeyColumns($object) {
		$columns = $object->getColumns();
		$foreignKeyColumns = [];
		foreach ($columns as $key => $value) {
			if (strpos($key, '_id')) {
				$foreignKeyColumns[$key] = $value;
			}
		}
		return $foreignKeyColumns;
	}

	public static function setReferencedObjectsColumns($othersObjectsColumns, &$object) {
		$foreignKeyOfParentObject = [lcfirst(get_class($object)) . "_id"  => $object->getId()];
	    foreach ($othersObjectsColumns as $objectName) {
	      	$objectWithForeignKeyValue = ClassUtils::constructObjectWithParameters($foreignKeyOfParentObject, $objectName);
	      	$referencedObjects = $objectWithForeignKeyValue->getWithParameters(null);
	      	$setColumn = "set" . ucfirst($objectName) . "s";
	      	if (method_exists($object, $setColumn)) {
	      		$object->$setColumn($referencedObjects);
	    	}
	    }
  	}

  	public static function getIfExistArrayFromObject($object) {
  		$columns = $object->getColumns();
  		foreach ($columns as $key => $value) {
  			if (is_array($value) && $key != "columns")
  				return [$key => $value];
  		}
  	}

  	public static function safeGetArrayIndex($value, $index, $defaultValue = null, $dimension = 0) {
  		$key = $index[$dimension];
		if (!isset($value) || !isset($value[$key]))
			return $defaultValue;
		$dimension++;
		if (!isset($index[$dimension]))
			return $value[$key];
		return self::safeGetArrayIndex($value[$key], $index, $defaultValue, $dimension);
  	}
}
