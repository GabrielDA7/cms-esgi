<?php

class BaseSql extends QueryConstructorSql {

	protected $table;
	protected $db;
	protected $columns;	

	public function __construct() {
		QueryConstructorSql::__construct();
		$this->table = get_called_class();
		try {
			$this->db=new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
		} catch(Exception $e) {
			return404View();
		}
	}
	
	public function createDatabase($fileContent) {
		$query = $this->db->prepare($fileContent);
		$query->execute();
	}

	public function insert() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructInsertQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		
	}

	public function update() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructUpdateQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
	}

	public function delete() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructDeleteQuery($this->table);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
	}

	public function getAll() {
		$queryString = $this->constructSelectQuery($this->table);
		$query = $this->db->prepare($queryString);
		$query->execute();
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getWithParameters() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
		$response = $query->fetchAll();
		$objectList = $this->createObjectsListFromDBResponse($response);
		return $objectList;
	}

	public function getById() {
		$this->columns = ClassUtils::removeUnsusedColumns($this, get_class_vars(get_class()));
		$queryString = $this->constructSelectQuery($this->table, $this->columns);
		$query = $this->db->prepare($queryString);
		$query->execute($this->columns);
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

	protected function hasResult($query) {
		return $response = $query->fetch();
	}
}
?>