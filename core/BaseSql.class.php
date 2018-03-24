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

	public function getColumns() {
		return get_object_vars($this);
	}
	
	public function insert() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$query = $this->db->prepare("INSERT INTO ".$this->table."(".implode(',', array_keys($this->columns)).")
			VALUES (:".implode(',:', array_keys($this->columns)).")");
		$query->execute($this->columns);
		
	}

	public function update() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$request = "UPDATE " . $this->table . " SET " . $this->constructConditionedQuery($this->columns, TRUE) . " WHERE id=:id";
		$query = $this->db->prepare($request);
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
		$objectList = $this->getObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$request = "SELECT * FROM " . $this->table . " WHERE " . $this->constructConditionedQuery($this->columns, FALSE);
		$query = $this->db->prepare($request);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->getObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$request = "SELECT * FROM " . $this->table . " WHERE id=:id";
		$query = $this->db->prepare($request);
		$query->execute(array(":id" => $this->getId()));
		$response = $query->fetch();
		$object = ClassUtils::constructObjectWithParameters($response, $this->table);
		return $object;
	}

	private function getObjectsListFromDBResponse($response) {
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

	
}
?>