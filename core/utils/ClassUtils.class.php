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
				if (!is_numeric($column)) {
					self::removeUnderScoreFromForeignKeyColumn($column);
					$setter = 'set'.ucfirst($column);
					if (method_exists($object, $setter)) {
						$object->$setter($value);
					}
				}
			}
		}
	}

	public static function setObjectColumnsWithFilesUrlAndMoveFile(&$object, $files) {
		$filesUrl = [];
		foreach ($files as $key => $value) {
			if ($value['error'] == UPLOAD_ERR_OK) {
				$tmp_name = $value["tmp_name"];
				$name = basename($value["name"]);
				$filesUrl += [$key => IMAGE_FOLDER_NAME."/".$name];
				move_uploaded_file($tmp_name, IMAGE_FOLDER_NAME."/".$name);
			}
		}
		self::setObjectColumns($object, $filesUrl);
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
			return $columns;
		}	
		self::unsetColumns($object, $columnsExclude);
	}

	public static function removeNullColumns(&$columns) {
		foreach ($columns as $key=>$value) {
			if (is_null($value) || $value == "" || empty($value)) {
				unset($columns[$key]);
			}
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
			if (strpos($key, 'id') && strlen($key) > 2) {
				$foreignKeyColumns[$key] = $value;
			}
		}
		return $foreignKeyColumns;
	}

	private function setReferencedObjectsColumns($othersObjectsColumns, &$object) {
		$foreignKeyOfParentObject = [lcfirst(get_class($object)) . "_id"  => $object->getId()];
	    foreach ($othersObjectsColumns as $objectName) {
	      	$objectWithForeignKeyValue = ClassUtils::constructObjectWithParameters($foreignKeyOfParentObject, $objectName);
	      	$referencedObjects = $objectWithForeignKeyValue->getWithParameters();
	      	$setColumn = "set" . ucfirst($objectName) . "s";
	      	if (method_exists($object, $setter)) {
	      		$object->$setColumn($referencedObjects);
	    	}
	    }
  	}
}
?>