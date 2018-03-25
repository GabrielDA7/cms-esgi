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
	
	public function insert() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$query = $this->db->prepare("INSERT INTO ".$this->table."(".implode(',', array_keys($this->columns)).")
			VALUES (:".implode(',:', array_keys($this->columns)).")");
		$query->execute($this->columns);
		
	}

	public function update() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = "UPDATE " . $this->table . " SET " . $this->constructConditionedQuery($this->columns, TRUE) . " WHERE id=:id";
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
	}

	public function delete() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$query = $this->db->prepare("DELETE FROM ".$this->table." WHERE id=:id");
		$query->execute(array(":id" => $this->getId()));
	}

	public function getAll() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$query = $this->db->prepare("SELECT * FROM ".$this->table);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = "SELECT * FROM " . $this->table . " WHERE " . $this->constructConditionedQuery($this->columns, FALSE);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = "SELECT * FROM " . $this->table . " WHERE id=:id";
		$query = $this->db->prepare($queryString);
		$query->execute(array(":id" => $this->getId()));
		$response = $query->fetch();
		$object = ClassUtils::constructObjectWithParameters($response, $this->table);
		return $object;
	}

	private function createObjectsListFromDBResponse($response) {
		$objectList = array();
		foreach ($response as $key => $values) {
			$object = ClassUtils::constructObjectWithParameters($values, $this->table);
			array_push($objectList, $object);
		}
		return $objectList;
	}

	private function constructConditionedQuery($columns, $update) {
		$numberOfItems = count($this->columns);
		$i = 0;
		$queryString = "";
		foreach ($this->columns as $key => $value) {
			// skip id
			if ($i === 0) {
				$i++;
				continue;
			}
			$queryString .= $key."=:".$key;
			// !last index
			if (!(++$i === $numberOfItems)) {
				if ($update) {
	    			$queryString .= ",";
				} else {
					$queryString .= " AND ";
				}
	  		}
		}	
		return $queryString;
	}
}
?>