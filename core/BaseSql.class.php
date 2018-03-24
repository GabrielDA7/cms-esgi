<?php

class BaseSql {

	protected $table;
	protected $db;
	protected $columns;	

	public function __construct() {
		$this->table = get_called_class();
		try {
			$this->db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
		} catch(Exception $e) {
			die("Erreur SQL ".$e->getMessage());
		}
	}

	public function removeUnsusedColumns() {
		$columnsExclude=get_class_vars(get_class());
		$this->columns=array_diff_key(get_object_vars($this), $columnsExclude);
		$this->columns = $this->removeNullValues($this->columns);
	}
	
	public function insert() {
		$this->removeUnsusedColumns();
		unset($this->columns['id']);
		$query = $this->db->prepare("INSERT INTO ".$this->table."(".implode(',', array_keys($this->columns)).")
			VALUES (:".implode(',:', array_keys($this->columns)).")");
		$query->execute($this->columns);
		
	}

	public function update() {
		$this->removeUnsusedColumns();
		$request = "UPDATE " . $this->table . " SET " . $this->constructConditionedQuery($this->columns, TRUE) . " WHERE id=:id";
		$query = $this->db->prepare($request);
		$query->execute($this->columns);
	}

	public function delete() {
		$this->removeUnsusedColumns();
		$query = $this->db->prepare("DELETE FROM ".$this->table." WHERE id=:id");
		$query->execute(array(":id" => $this->getId()));
	}

	public function getAll() {
		$this->removeUnsusedColumns();
		$query = $this->db->prepare("SELECT * FROM ".$this->table);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->getObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters() {
		$this->removeUnsusedColumns();
		$request = "SELECT * FROM " . $this->table . " WHERE " . $this->constructConditionedQuery($this->columns, FALSE);
		$query = $this->db->prepare($request);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->getObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById() {
		$this->removeUnsusedColumns();
		$request = "SELECT * FROM " . $this->table . " WHERE id=:id";
		$query = $this->db->prepare($request);
		$query->execute(array(":id" => $this->getId()));
		$response = $query->fetch();
		$object = $this->getObjectFromDBResponse($response);
		return $object;
	}

	private function getObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $value) {
			$object = new $this->table();
			foreach ($value as $objectKey => $objectValue) {
				if (!is_numeric($objectKey)) {
					$objectKey = removeUdnerScoreFromForeignKeyColum($objectKey);
					$setter = 'set'.ucfirst($objectKey);
					$object->$setter($objectValue);
				}
			}
			array_push($objectList, $object);
		}
		return $objectList;
	}

	private function getObjectFromDBResponse($response) {
		foreach ($response as $key => $value) {
			$object = new $this->table();
			if (!is_numeric($key)) {
				$objectKey = removeUdnerScoreFromForeignKeyColum($objectKey);
				$setter = 'set'.ucfirst($key);
				$object->$setter($value);
			}
		}
		return $object;
	}

	private function constructConditionedQuery($columns, $update) {
		$numberOfItems = count($this->columns);
		$i = 0;
		$request = "";
		foreach ($this->columns as $key => $value) {
			// skip id
			if($i === 0) {
				$i++;
				continue;
			}
			$request .= $key."=:".$key;
			// !last index
			if(!(++$i === $numberOfItems)) {
				if ($update) {
	    			$request .= ",";
				} else {
					$request .= " AND ";
				}
	  		}
		}	
		return $request;
	}

	private function removeNullValues(&$columns) {
		array_filter($columns,'strlen');
	}

	public function removeUdnerScoreFromForeignKeyColum(&$objectKey) {
		str_replace('_', '', $objectKey);
	}
}
?>